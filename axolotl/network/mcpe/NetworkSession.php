<?php

declare(strict_types=1);

namespace axolotl\network\mcpe;

use axolotl\meta\AxolotlPatch;
use axolotl\meta\PatchType;
use axolotl\network\mcpe\convert\TypeConverter;
use InvalidArgumentException;
use pocketmine\network\mcpe\compression\Compressor;
use pocketmine\network\mcpe\convert\TypeConverter as TypeConverterPM;
use pocketmine\network\mcpe\EntityEventBroadcaster;
use pocketmine\network\mcpe\NetworkSession as NetworkSessionPM;
use pocketmine\network\mcpe\PacketBroadcaster;
use pocketmine\network\mcpe\PacketSender;
use pocketmine\network\mcpe\protocol\PacketDecodeException;
use pocketmine\network\mcpe\protocol\PacketPool;
use pocketmine\network\NetworkSessionManager;
use pocketmine\network\PacketHandlingException;
use pocketmine\Server;
use Throwable;
use UnexpectedValueException;

class NetworkSession extends NetworkSessionPM{
	public function __construct(Server $server, NetworkSessionManager $manager, PacketPool $packetPool, PacketSender $sender, PacketBroadcaster $broadcaster, EntityEventBroadcaster $entityEventBroadcaster, Compressor $compressor, TypeConverterPM $typeConverter, string $ip, int $port){
		parent::__construct($server, $manager, $packetPool, $sender, $broadcaster, $entityEventBroadcaster, $compressor, $typeConverter = new TypeConverter(), $ip, $port);
		$typeConverter->setNetworkSession($this);
	}

	/**
	 * @param string $payload
	 *
	 * @return void
	 */
	#[AxolotlPatch(
		type: PatchType::OVERRIDE,
		reason: "Multi-tiered packet error handling to prevent server crashes, safely ignore minor invalid data, and kick only on severe protocol faults.",
		upstreamVersion: "5.49.2"
	)]
	public function handleEncoded(string $payload) : void{
		try {
			parent::handleEncoded($payload);
		} catch (InvalidArgumentException | UnexpectedValueException $e) {
			$this->getLogger()->debug("Ignored invalid packet data from " . $this->getIp() . ": " . $e->getMessage());
		} catch (PacketHandlingException $e) {
			$this->getLogger()->warning("Packet handling error from " . $this->getIp() . ": " . $e->getMessage());
		} catch (PacketDecodeException $e) {
			$this->getLogger()->debug("Packet decode failed for " . $this->getIp() . ": " . $e->getMessage());
			$this->disconnect("Packet decode error");
		} catch (Throwable $e) {
			$this->getLogger()->error("Critical error while handling packet from " . $this->getIp() . ": " . $e->getMessage());
			$this->getLogger()->logException($e);

			$this->disconnect("Internal server error");
		}
	}
}
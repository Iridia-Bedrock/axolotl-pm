<?php

declare(strict_types=1);

namespace axolotl\network\mcpe\convert;

use axolotl\item\ItemWrapper;
use axolotl\meta\AxolotlPatch;
use axolotl\meta\PatchType;
use axolotl\network\mcpe\NetworkSession;
use pocketmine\item\Item;
use pocketmine\lang\Translatable;
use pocketmine\network\mcpe\convert\TypeConverter as TypeConverterPM;
use pocketmine\network\mcpe\protocol\types\GameMode as ProtocolGameMode;
use pocketmine\network\mcpe\protocol\types\inventory\ItemStack;
use pocketmine\player\GameMode;

class TypeConverter extends TypeConverterPM{
	private ?NetworkSession $networkSession = null;

	/**
	 * @return NetworkSession|null
	 */
	public function getNetworkSession() : ?NetworkSession{
		return $this->networkSession;
	}

	/**
	 * @param NetworkSession|null $networkSession
	 */
	public function setNetworkSession(?NetworkSession $networkSession) : void{
		$this->networkSession = $networkSession;
	}

	/**
	 * @param GameMode $gamemode
	 *
	 * @return int
	 */
	#[AxolotlPatch(
		type: PatchType::OVERRIDE,
		reason: "Properly maps the core Spectator game mode to the client protocol instead of falling back to a creative viewer.",
		upstreamVersion: "5.49.2"
	)]
	public function coreGameModeToProtocol(GameMode $gamemode) : int{
		return match ($gamemode) {
			GameMode::SURVIVAL => ProtocolGameMode::SURVIVAL,
			GameMode::SPECTATOR => ProtocolGameMode::SPECTATOR,
			GameMode::CREATIVE => ProtocolGameMode::CREATIVE,
			GameMode::ADVENTURE => ProtocolGameMode::ADVENTURE,
		};
	}

	/**
	 * @param int $gameMode
	 *
	 * @return GameMode|null
	 */
	#[AxolotlPatch(
		type: PatchType::OVERRIDE,
		reason: "Properly maps client spectator protocol game modes back to the core Spectator game mode.",
		upstreamVersion: "5.49.2"
	)]
	public function protocolGameModeToCore(int $gameMode) : ?GameMode{
		return match ($gameMode) {
			ProtocolGameMode::SURVIVAL => GameMode::SURVIVAL,
			ProtocolGameMode::CREATIVE => GameMode::CREATIVE,
			ProtocolGameMode::ADVENTURE => GameMode::ADVENTURE,
			ProtocolGameMode::SPECTATOR, ProtocolGameMode::SURVIVAL_VIEWER, ProtocolGameMode::CREATIVE_VIEWER => GameMode::SPECTATOR,
			default => null,
		};
	}

	/**
	 * @param Item $itemStack
	 *
	 * @return ItemStack
	 */
	#[AxolotlPatch(
		type: PatchType::OVERRIDE,
		reason: "Translates Translatable lore lines into the player's language before sending the item over the network.",
		upstreamVersion: "5.49.2"
	)]
	public function coreItemStackToNet(Item $itemStack) : ItemStack{
		if($this->networkSession === null || !$this->networkSession->isConnected() || ($player = $this->networkSession->getPlayer()) === null){
			return parent::coreItemStackToNet($itemStack);
		}

		if(!$itemStack->isNull()){
			$lore = ItemWrapper::getLore($itemStack);

			if(!empty($lore)){
				$itemStack = clone $itemStack;
				$translatedLore = [];

				foreach($lore as $line){
					if($line instanceof Translatable){
						$translatedLore[] = $player->getLanguage()->translate($line);
					}else{
						$translatedLore[] = $line;
					}
				}

				$itemStack->setLore($translatedLore);
			}
		}

		return parent::coreItemStackToNet($itemStack);
	}
}
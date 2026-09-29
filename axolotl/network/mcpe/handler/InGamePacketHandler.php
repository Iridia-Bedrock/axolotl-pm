<?php

namespace axolotl\network\mcpe\handler;

use axolotl\meta\AxolotlPatch;
use axolotl\meta\PatchType;
use pocketmine\math\Vector3;
use pocketmine\network\mcpe\handler\InGamePacketHandler as InGamePacketHandlerPM;
use pocketmine\network\mcpe\InventoryManager;
use pocketmine\network\mcpe\NetworkSession;
use pocketmine\network\mcpe\protocol\types\BlockPosition;
use pocketmine\network\mcpe\protocol\types\PlayerAction;
use pocketmine\player\Player;

class InGamePacketHandler extends InGamePacketHandlerPM{
	public function __construct(
		private Player $player,
		private NetworkSession $session,
		private InventoryManager $inventoryManager
	){
		parent::__construct($player, $session, $inventoryManager);
	}

	#[AxolotlPatch(
		type: PatchType::OVERRIDE,
		reason: "Improves client-side prediction handling for block breaking, fixing latency issues and enhancing anti-cheat checks.",
		upstreamVersion: "5.49.2"
	)]
	public function handlePlayerActionFromData(int $action, BlockPosition $blockPosition, int $face) : bool{
		$pos = new Vector3($blockPosition->getX(), $blockPosition->getY(), $blockPosition->getZ());

		switch($action){
			case PlayerAction::CREATIVE_PLAYER_DESTROY_BLOCK:
				if(!$this->player->isCreative()) {
					$this->session->getLogger()->debug("Ignored CREATIVE_PLAYER_DESTROY_BLOCK on $pos: Player is not in creative mode");
					$this->syncBlocksNearby($pos, $face);
					break;
				}

				if(!$this->player->breakBlock($pos)){
					$this->syncBlocksNearby($pos, $face);
				}
				break;

			case PlayerAction::PREDICT_DESTROY_BLOCK:
				self::validateFacing($face);

				if($this->player->isCreative()) {
					$this->session->getLogger()->debug("Ignored PREDICT_DESTROY_BLOCK on $pos: Player is in creative mode");
					break;
				}

				if($this->lastBlockAttacked === null){
					$this->session->getLogger()->debug("Ignored PREDICT_DESTROY_BLOCK on $pos: No tracked block being broken");
					$this->syncBlocksNearby($pos, $face);
					break;
				}

				if($pos->distanceSquared($this->player->getLocation()) > 10000){
					$this->session->getLogger()->debug("Ignored PREDICT_DESTROY_BLOCK on $pos: Target block is extremely far away");
					break;
				}

				$target = $this->player->getWorld()->getBlock($pos);
				$breakHandler = $this->player->blockBreakHandler;
				$breaksInstantly = $target->getBreakInfo()->breaksInstantly();

				if($breakHandler === null && !$breaksInstantly){
					$this->session->getLogger()->debug("Ignored PREDICT_DESTROY_BLOCK on $pos: No BlockBreakHandler active for a hard block");
					$this->syncBlocksNearby($pos, $face);
					break;
				}

				if($breakHandler !== null && !$breaksInstantly){
					// Latency compensation: The client might send the predict packet slightly
					// before the server ticks the final break progress. We forcefully update it by 1 tick.
					$breakHandler->update();

					$progress = $breakHandler->getBreakProgress();
					if($progress < 1.0) {
						// The block is not ready to be broken yet server-side.
						$percentage = round($progress * 100);
						$this->session->getLogger()->debug("Ignored PREDICT_DESTROY_BLOCK on $pos: Break progress is incomplete ({$percentage}%)");
						$this->syncBlocksNearby($pos, $face);
						break;
					}
				}

				if(!$this->player->breakBlock($pos)){
					$this->syncBlocksNearby($pos, $face);
				}

				$this->lastBlockAttacked = null;
				break;

			default:
				return parent::handlePlayerActionFromData($action, $blockPosition, $face);
		}

		$this->player->setUsingItem(false);
		return true;
	}
}
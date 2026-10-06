<?php

declare(strict_types=1);

namespace axolotl\network\mcpe\convert;

use axolotl\item\ItemWrapper;
use axolotl\meta\AxolotlPatch;
use axolotl\meta\PatchType;
use axolotl\network\mcpe\NetworkSession;
use pmmp\encoding\ByteBufferWriter;
use pocketmine\item\Item;
use pocketmine\lang\Translatable;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\ListTag;
use pocketmine\network\mcpe\convert\ItemTranslator;
use pocketmine\network\mcpe\convert\TypeConverter as TypeConverterPM;
use pocketmine\network\mcpe\protocol\types\GameMode as ProtocolGameMode;
use pocketmine\network\mcpe\protocol\types\inventory\ItemStack;
use pocketmine\network\mcpe\protocol\types\inventory\ItemStackExtraData;
use pocketmine\network\mcpe\protocol\types\inventory\ItemStackExtraDataShield;
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
		if($itemStack->isNull() || $this->networkSession === null || !$this->networkSession->isConnected() || ($player = $this->networkSession->getPlayer()) === null){
			return parent::coreItemStackToNet($itemStack);
		}

		$itemStack = clone $itemStack;

		$customName = ItemWrapper::getCustomName($itemStack);
		if($customName instanceof Translatable){
			$itemStack->setCustomName($player->getLanguage()->translate($customName));
		}

		$lore = ItemWrapper::getLore($itemStack);
		if(!empty($lore)){
			$translatedLore = [];

			foreach($lore as $key => $line){
				if($line instanceof Translatable){
					$translatedLore[$key] = $player->getLanguage()->translate($line);
				}else{
					$translatedLore[$key] = $line;
				}
			}

			$itemStack->setLore($translatedLore);
		}

		$stack = parent::coreItemStackToNet($itemStack);

		$extraData = $this->deserializeItemStackExtraData($stack->getRawExtraData(), $stack->getId());
		if ($extraData instanceof ItemStackExtraDataShield){
			return $stack;
		}

		$tag = $extraData->getNbt() ?? new CompoundTag();
		if (ItemWrapper::isFoil($itemStack)){
			if (!$tag->getTag(Item::TAG_ENCH)){
				$tag->setTag(Item::TAG_ENCH, new ListTag());
			}
		}

		$extraData = new ItemStackExtraData($tag, $itemStack->getCanPlaceOn(), $itemStack->getCanDestroy());

		$extraDataSerializer = new ByteBufferWriter();
		$extraData->write($extraDataSerializer);

		return new ItemStack(
			$stack->getId(),
			$stack->getMeta(),
			$stack->getCount(),
			$stack->getBlockRuntimeId(),
			$extraDataSerializer->getData(),
		);
	}
}
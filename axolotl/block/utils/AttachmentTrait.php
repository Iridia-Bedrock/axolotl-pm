<?php

namespace axolotl\block\utils;

use pocketmine\data\runtime\RuntimeDataDescriber;

trait AttachmentTrait{
	private Attachment $attachment = Attachment::SIDE;

	protected function describeAttachment(RuntimeDataDescriber $w) : void{
		$w->enum($this->attachment);
	}

	public function getAttachment() : Attachment{
		return $this->attachment;
	}

	public function setAttachment(Attachment $attachment) : void{
		$this->attachment = $attachment;
	}
}

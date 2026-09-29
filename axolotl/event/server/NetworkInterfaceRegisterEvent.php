<?php

namespace axolotl\event\server;

use pocketmine\event\server\NetworkInterfaceRegisterEvent as NetworkInterfaceRegisterEventPM;
use pocketmine\network\NetworkInterface;

class NetworkInterfaceRegisterEvent extends NetworkInterfaceRegisterEventPM{
	public function setInterface(NetworkInterface $network) : void{
		$this->interface = $network;
	}
}
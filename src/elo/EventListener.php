<?php

namespace elo;

use pocketmine\event\Listener;
use elo\Elo;
use pocketmine\utils\TextFormat as TF;
use pocketmine\event\player\PlayerDeathEvent;

Class EventListener implements Listener{

    private $deathloss;
    private $main;
	
	public function __construct(Elo $main) {
		$this->main = $main;
                $this->deathloss = $this->main->getConfig()->get("Death-Elo-Loss");
         }

     public function onDeath(PlayerDeathEvent $ev){
}

    public function onJoin(PlayerDeathEvent $ev){
}
}

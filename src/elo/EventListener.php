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
         if($this->main->config->get("Lose-Elo-onDeath") === true){
             $eloloss = $this->main->config->get("Death-Elo-Loss");
             $this->main->removeElo($ev->getPlayer()->getName(), $eloloss);
         }
     }

    public function onJoin(PlayerDeathEvent $ev){
        if(!($this->main->eloyaml->Elo->exists($ev->getPlayer()->getName()))){
            $this->main->createDataFor($ev->getPlayer()->getName());
        }
    }
}

<?php

namespace elo;

use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Listener;
use elo\Coins;
use pocketmine\Player;
use pocketmine\utils\TextFormat as TF;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerJoinEvent;

Class EventListener implements Listener{

    private $deathloss;
    private $main;

	public function __construct(Coins $main) {
		$this->main = $main;
                $this->deathloss = $this->main->getConfig()->get("Death-Coins-Loss");
    }

     public function onDeath(PlayerDeathEvent $ev){
         if($this->main->config->get("Lose-Coins-onDeath") === true){
             $coinsloss = $this->main->config->get("Death-Coins-Loss");
             $this->main->removecoins($ev->getPlayer()->getName(), $coinsloss);
         }
         if($this->main->config->get("Get-Coins-On-Kill") === true){
             $cause = $ev->getPlayer()->getLastDamageCause();
             if($cause instanceof EntityDamageByEntityEvent and $cause->getDamager() instanceof Player){
              $killername = $cause->getDamager()->getName();
                 $coins = $this->main->config->get("Coins-On-Kill");
                 $this->main->addCoins($killername, $coins);
             }
         }
     }

    public function onJoin(PlayerJoinEvent $ev){
        if(!($this->main->coinsyaml->exists($ev->getPlayer()->getName()))){
            $this->main->createDataFor($ev->getPlayer()->getName());
        }
    }
}

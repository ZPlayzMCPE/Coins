<?php

namespace elo;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use elo\commands\CoinsCommand;
use elo\commands\AddCoinsCommand;
use elo\commands\TopCoinsCommand;
use elo\commands\SeeCoinsCommand;
use elo\commands\RemoveCoinsCommand;
use pocketmine\utils\TextFormat as TF;
use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\Player;
use pocketmine\plugin\Plugin;
use elo\EventListener;

Class Coins extends PluginBase implements Listener{
 
 CONST prefix = TF::RED.TF::BOLD."Coins ".TF::RESET;
    /** @var Config $coinsyaml */
 public $coinsyaml;
    /** @var Config $config */
 public $config;

   public function onEnable(){
     // Config start
    if(!file_exists($this->getDataFolder())){
         @mkdir($this->getDataFolder());
      }
             $this->saveDefaultConfig();
               $this->config = $this->getConfig();
              	$this->coinsyaml = new Config($this->getDataFolder() ."coins.json", Config::JSON);
     if(!($this->coinsyaml->exists("Steve"))){
    $this->coinsyaml->set("Steve", $this->config->get("Starting-coins"));
    $this->coinsyaml->save();
         $this->coinsyaml->reload();
}
    // Config end
   // Commands start
   $server = $this->getServer();
    $server->getCommandMap()->register("coins", new CoinsCommand($this, "coins"));
    $server->getCommandMap()->register("topcoins", new TopCoinsCommand($this, "topcoins"));
    $server->getCommandMap()->register("seecoins", new SeeCoinsCommand($this, "seecoins"));
    $server->getCommandMap()->register("addcoins", new AddCoinsCommand($this, "addcoins"));
    $server->getCommandMap()->register("removecoins", new RemoveCoinsCommand($this, "removecoins"));
  //Commands end
     $server->getPluginManager()->registerEvents(new EventListener($this), $this);
   }

  public function addCoins(String $playername, int $coins){
   if($this->coinsyaml->exists($playername)){
   $currentcoins = $this->coinsyaml->get($playername);
   $setcoins = $currentcoins + $coins;
    $this->coinsyaml->set($playername, $setcoins);
     $this->coinsyaml->save();
       $this->coinsyaml->reload();
 }
}

   public function removeCoins(String $playername, int $coins){
    if($this->coinsyaml->exists($playername)){
     $currentcoins = $this->coinsyaml->get($playername);
     $setcoins = $currentcoins - $coins;
      $this->coinsyaml->set($playername, $setcoins);
        $this->coinsyaml->save();
        $this->coinsyaml->reload();
   }
}

   public function getCoins(String $playername){
    if($this->coinsyaml->exists($playername)){
      $coins = $this->coinsyaml->get($playername);
        return $coins;
    }
return null;
}

  public function sendTopCoinsTo($player, int $amount){
   $array = $this->coinsyaml->getAll();
    arsort($array);
       $arraykeys = array_keys($array);
       $arrayvalues = array_values($array);
    $player->sendMessage(self::prefix);
     for($i = 0; $i < $amount; $i++){
       $player->sendMessage(TF::RED.($i + 1.)." ".TF::YELLOW.$arraykeys[$i].": ".$arrayvalues[$i]." Coins");
   }
}

   public function resetCoins(String $playername){
    if($this->coinsyaml->exists($playername)){
     $this->coinsyaml->set($playername, 0);
     $this->coinsyaml->save();
        $this->coinsyaml->reload();
    }
}

  public function createDataFor(String $playername){
   if(!($this->coinsyaml->exists($playername))){
       $this->coinsyaml->set($playername, $this->config->get("Starting-coins"));
   }
  }
}

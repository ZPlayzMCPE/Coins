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
 
 CONST prefix = TF::GREEN.TF::BOLD."Balance ".TF::RESET;
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
    $this->coinsyaml->set("Steve", $this->config->get("Starting-Money"));
    $this->coinsyaml->save();
         $this->coinsyaml->reload();
}
    // Config end
   // Commands start
   $server = $this->getServer();
    $server->getCommandMap()->register("bal", new CoinsCommand($this, "bal"));
    $server->getCommandMap()->register("baltop", new TopCoinsCommand($this, "baltop"));
    $server->getCommandMap()->register("seebal", new SeeCoinsCommand($this, "seebal"));
    $server->getCommandMap()->register("addbal", new AddCoinsCommand($this, "addbal"));
    $server->getCommandMap()->register("removebal", new RemoveCoinsCommand($this, "removebal"));
  //Commands end
     $server->getPluginManager()->registerEvents(new EventListener($this), $this);
   }

  public function addBal(String $playername, int $money){
   if($this->coinsyaml->exists($playername)){
   $currentcoins = $this->coinsyaml->get($playername);
   $setBal = $currentBal + $money;
    $this->coinsyaml->set($playername, $setcoins);
     $this->coinsyaml->save();
       $this->coinsyaml->reload();
 }
}

   public function removeBal(String $playername, int $money){
    if($this->coinsyaml->exists($playername)){
     $currentbal = $this->coinsyaml->get($playername);
     $setcoins = $currentcoins - $coins;
      $this->coinsyaml->set($playername, $setcoins);
        $this->coinsyaml->save();
        $this->coinsyaml->reload();
   }
}

   public function getBal(String $playername){
    if($this->coinsyaml->exists($playername)){
      $coins = $this->coinsyaml->get($playername);
        return $money;
    }
return null;
}

  public function sendTopBalTo($player, int $amount){
   $array = $this->coinsyaml->getAll();
    arsort($array);
       $arraykeys = array_keys($array);
       $arrayvalues = array_values($array);
    $player->sendMessage(self::prefix);
     for($i = 0; $i < $amount; $i++){
       $player->sendMessage(TF::GREEN.($i + 1.)." ".TF::YELLOW.$arraykeys[$i].": ".$arrayvalues[$i]." Balance");
   }
}

   public function resetBal(String $playername){
    if($this->coinsyaml->exists($playername)){
     $this->coinsyaml->set($playername, 0);
     $this->coinsyaml->save();
        $this->coinsyaml->reload();
    }
}

  public function createDataFor(String $playername){
   if(!($this->coinsyaml->exists($playername))){
       $this->coinsyaml->set($playername, $this->config->get("Starting-Money"));
   }
  }
}

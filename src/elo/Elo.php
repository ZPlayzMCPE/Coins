<?php

namespace elo;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use elo\commands\EloCommand;
use elo\commands\AddEloCommand;
use elo\commands\TopEloCommand;
use elo\commands\SeeEloCommand;
use elo\commands\RemoveEloCommand;
use pocketmine\utils\TextFormat as TF;
use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\Player;
use pocketmine\plugin\Plugin;
use elo\EventListener;

Class Elo extends PluginBase implements Listener{
 
 CONST prefix = TF::RED.TF::BOLD."Elo".TF::RESET;
 public $eloyaml;
 public $config;

   public function onEnable(){
     // Config start
    if(!file_exists($this->getDataFolder())){
         @mkdir($this->getDataFolder());
      }
             $this->saveDefaultConfig();
               $this->config = $this->getConfig();
              	$this->eloyaml = new Config($this->getDataFolder() ."elo.yml", Config::YAML);

    if(!($this->eloyaml->exists("Elo"))){
         $this->eloyaml->set("Elo" , []);
           $this->eloyaml->save();
            $this->eloyaml->reload();
    }
     if(!($this->eloyaml->Elo->exists("Steve"))){
    $this->eloyaml->Elo->set("Steve", $this->config->get("Starting-Elo"));
    $this->eloyaml->save();
         $this->eloyaml->reload();
}
    // Config end
   // Commands start
   $server = $this->getServer();
    $server->getCommandMap()->register("elo", new EloCommand($this, "elo"));
    $server->getCommandMap()->register("topelo", new TopEloCommand($this, "topelo"));
    $server->getCommandMap()->register("seeelo", new SeeEloCommand($this, "seeelo"));
    $server->getCommandMap()->register("addelo", new AddEloCommand($this, "addelo"));
    $server->getCommandMap()->register("removeelo", new RemoveEloCommand($this, "removeelo"));
  //Commands end
     $server->getPluginManager()->registerEvents(new EventListener($this), $this);
   }

  public function addElo(String $playername, Integer $elo){
   if($this->eloyaml->Elo->exists($playername)){
   $currentelo = $this->eloyaml->Elo->get($playername);
   $setelo = $currentelo + $elo;
    $this->eloyaml->Elo->set($playername, $setelo);
     $this->eloyaml->save();
       $this->eloyaml->reload();
 }
}

   public function removeElo(String $playername, Integer $elo){
    if($this->eloyaml->Elo->exists($playername)){
     $currentelo = $this->eloyaml->Elo->get($playername);
     $setelo = $currentelo - $elo;
      $this->eloyaml->Elo->set($playername, $setelo);
        $this->eloyaml->save();
        $this->eloyaml->reload();
   }
}

   public function getElo(String $playername){
    if($this->eloyaml->Elo->exists($playername)){
      $elo = $this->eloyaml->Elo->get($playername);
        return $elo;
    }
return null;
}

  public function sendTopEloTo(Player $player){
   $array = $this->eloyaml->get("Elo");
    arsort($array);
    $player->sendMessage(self::prefix);
     for($i = 0; $i < 10; $i++){
       $arraykeys = array_keys($array);
       $arrayvalues = array_values($array);
       $player->sendMessage(TF::RED.($i + 1.)." ".TF::YELLOW.$arraykeys[$i].": ".$arrayvalues[$i]." Elo");
   }
}

   public function resetElo(String $playername){
    if($this->eloyaml->Elo->exists($playername)){
     $this->eloyaml->Elo->set($playername, 0);
     $this->eloyaml->save();
        $this->eloyaml->reload();
    }
}

  public function createDataFor(String $playername){

  }
}

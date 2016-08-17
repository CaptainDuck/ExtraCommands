<?php

namespace ExtraCommands;

use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\Player;
use pocketmine\level\Level;
use pocketmine\Server;
use pocketmine\permission\Permission;
use pocketmine\event\Listener;
use pocketmine\math\Vector3;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as C;

class Main extends PluginBase implements Listener{
    
    public function onEnable(){
        $this->getLogger()->info("ExtraCommands by CaptainDuck enabled!");
        $this->saveDefaultConfig();
        $this->getServer()->getPluginManager()->registerEvents($this,$this);
        $this->saveResource("config.yml");
    }
    public function onDisable(){
        $this->getLogger()->info("ExtraCommands by CaptainDuck disabled! :o");
    }
    public function onLoad(){
        $this->getLogger()->info("Loading ExtraCommands by CaptainDuck!");
    }
    public function onCommand(CommandSender $sender,Command $cmd,$label,array $args){
        
        $message = str_replace("{X}", round($sender->getX()), $message);
        $message = str_replace("{Y}", round($sender->getY()), $message);
        $message = str_replace("{Z}", round($sender->getZ()), $message);
        $message = str_replace("{NAME}", $sender->getName(), $message);
        $message = str_replace("{WORLD}", $sender->getLevel()->getName(), $message);
        $message = str_replace("{N}", "\n", $message);
        $message = str_replace("{PLAYERS}", count($this->getServer()->getOnlinePlayers()), $message);
        $message = str_replace("{MAXPLAYERS}", $this->getServer()->getMaxPlayers(), $message);
        $prefix = $this->getConfig()->get("msgprefix");
        switch($cmd->getName()){
            case "website":
                if($sender->hasPermission("ec.website")){
                    $sender->sendMessage(C::BLUE. $prefix . $this->getConfig()->get("wmsg1"),$message);
                    $sender->sendMessage(C::BLUE. $prefix . $this->getConfig()->get("wmsg2"),$message);
                    return true;
                    break;
                }
            case "ranks":
                if($sender->hasPermission("ec.ranks")){
                    $sender->sendMessage(C::RED. $this->getConfig()->get("ranksmainmsg"),$message);
                    $sender->sendMessage(C::BLUE. "1. ". $this->getConfig()->get("rank1"). " > " . $this->getConfig()->get("rank1price"),$message);
                    $sender->sendMessage(C::BLUE. "2. ". $this->getConfig()->get("rank2"). " > ". $this->getConfig()->get("rank2price"),$message);
                    $sender->sendMessage(C::BLUE. "3. ". $this->getConfig()->get("rank3"). " > ". $this->getConfig()->get("rank3price"),$message);
                    $sender->sendMessage(C::BLUE. "4. ". $this->getConfig()->get("rank4"). " > ". $this->getConfig()->get("rank4price"),$message);
                    $sender->sendMessage(C::RED. "5. ".  $this->getConfig()->get("rank5"). " > ". $this->getConfig()->get("rank5price"),$message);
                    return true;
                    break;
                }
            case "shop":
                if($sender->hasPermission("ec.shop")){
                    $sender->sendMessage(C::BLUE. $prefix . $this->getConfig()->get("shopmsg1"),$message);
                    $sender->sendMessage(C::BLUE. $prefix . $this->getConfig()->get("shopmsg2"),$message);
                    return true;
                    break;
                }
            case "links":
                if($sender->hasPermission("ec.links")){
                    $sender->sendMessage(C::GRAY. $this->getConfig()->get("linksmainmsg"),$message);
                    $sender->sendMessage(C::BLUE. $prefix . $this->getConfig()->get("linksmsg1"),$message);
                    $sender->sendMessage(C::WHITE. $prefix . $this->getConfig()->get("linksmsg2"),$message);
                    return true;
                    break;
                }
            case "rules":
                if($sender->hasPermission("ec.rules")){
                    $sender->sendMessage(C::RED. $this->getConfig()->get("rulesmainmsg"),$message);
                    $sender->sendMessage(C::GRAY. $prefix . "1. ". $this->getConfig()->get("rule1"),$message);
                    $sender->sendMessage(C::GRAY. $prefix . "2. ". $this->getConfig()->get("rule2"),$message);
                    $sender->sendMessage(C::GRAY. $prefix . "3. ". $this->getConfig()->get("rule3"),$message);
                    $sender->sendMessage(C::GRAY. $prefix . "4. ". $this->getConfig()->get("rule4"),$message);
                    $sender->sendMessage(C::BLUE. $prefix . "5. ". $this->getConfig()->get("rulemsg"),$message);
                    return true;
                    break;
                }
            case "info":
                if($sender->hasPermission("ec.info")){
                    $sender->sendMessage(C::GRAY. $this->getConfig()->get("infomainmsg"),$message);
                    $sender->sendMessage(C::BLUE. $prefix . "Online: ". $this->getConfig()->get("onlinemsg"),$message);
                    $sender->sendMessage(C::WHITE. $prefix . "Server IP: ". $this->getConfig()->get("ServerIP"),$message);
                    $sender->sendMessage(C::WHITE. $prefix . "You're playing on ". $this->getConfig()->get("ServerName"),$message);  
                    return true;
                    break;
                }
            case "broadcast":
                if($sender->hasPermission("ec.broadcast")){
                    $msg = implode(" ", $args);
                    $this->getServer()->broadcastMessage($msg, $message);
                    return true;
                    break;
                }
        }
    }
}

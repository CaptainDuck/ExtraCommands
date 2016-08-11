<?php

namespace ExtraCommands;

use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\permission\Permission;
use pocketmine\event\Listener;
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
    public function formatMessage($message, CommandSender $sender){
        $message = str_replace("{X}", round($sender->getX()), $message);
        $message = str_replace("{Y}", round($sender->getY()), $message);
        $message = str_replace("{Z}", round($sender->getZ()), $message);
        $message = str_replace("{NAME}", $sender->getName(), $message);
        $message = str_replace("{WORLD}", $sender->getLevel()->getName(), $message);
        $message = str_replace("{N}", "\n", $message);
        $message = str_replace("{PLAYERS}", count($this->getServer()->getOnlinePlayers()), $message);
        $message = str_replace("{MAXPLAYERS}", $this->getServer()->getMaxPlayers(), $message);
    }
    public function onCommand(CommandSender $sender,Command $cmd,$label,array $args){
        switch($cmd->getName()){
            case "website":
                if($sender->hasPermission("ec.website")){
                    $sender->sendMessage(C::BLUE. $this->getConfig()->get("wmsg1"));
                    $sender->sendMessage(C::BLUE. $this->getConfig()->get("wmsg2"));
                    return true;
                    break;
                }
            case "ranks":
                if($sender->hasPermission("ec.ranks")){
                    $sender->sendMessage(C::RED.">Ranks<");
                    $sender->sendMessage(C::BLUE. $this->getConfig()->get("rank1"). " > " . $this->getConfig()->get("rank1price"));
                    $sender->sendMessage(C::BLUE. $this->getConfig()->get("rank2"). " > ". $this->getConfig()->get("rank2price"));
                    $sender->sendMessage(C::BLUE. $this->getConfig()->get("rank3"). " > ". $this->getConfig()->get("rank3price"));
                    $sender->sendMessage(C::BLUE. $this->getConfig()->get("rank4"). " > ". $this->getConfig()->get("rank4price"));
                    $sender->sendMessage(C::RED. $this->getConfig()->get("rank5"). " > ". $this->getConfig()->get("rank5price"));
                    return true;
                    break;
                }
            case "shop":
                if($sender->hasPermission("ec.shop")){
                    $sender->sendMessage(C::BLUE. $this->getConfig()->get("shopmsg1"));
                    $sender->sendMessage(C::BLUE. $this->getConfig()->get("shopmsg2"));
                    return true;
                    break;
                }
            case "links":
                if($sender->hasPermission("ec.links")){
                    $sender->sendMessage(C::GRAY.">Links<");
                    $sender->sendMessage(C::BLUE. $this->getConfig()->get("linksmsg1"));
                    $sender->sendMessage(C::WHITE. $this->getConfig()->get("linksmsg2"));
                    return true;
                    break;
                }
            case "rules":
                if($sender->hasPermission("ec.rules")){
                    $sender->sendMessage(C::RED."> Rules <");
                    $sender->sendMessage(C::GRAY."1. ". $this->getConfig()->get("rule1"));
                    $sender->sendMessage(C::GRAY."2. ". $this->getConfig()->get("rule2"));
                    $sender->sendMessage(C::GRAY."3. ". $this->getConfig()->get("rule3"));
                    $sender->sendMessage(C::GRAY."4. ". $this->getConfig()->get("rule4"));
                    $sender->sendMessage(C::BLUE."5. ". $this->getConfig()->get("rulemsg"));
                    return true;
                    break;
                }
            case "info":
                if($sender->hasPermission("ec.info")){
                    $sender->sendMessage(C::GRAY."Server Info");
                    $sender->sendMessage(C::BLUE."Online: ". $this->getConfig()->get("OnlineMessage"));
                    $sender->sendMessage(C::WHITE."Server IP: ". $this->getConfig()->get("ServerIP"));
                    $sender->sendMessage(C::WHITE."You're playing on ". $this->getConfig()->get("ServerName"). "!");  
                    return true;
                    break;
                }
            case "broadcast":
                if($sender->hasPermission("ec.broadcast")){
                    $msg = implode(" ", $args);
                    $this->getServer()->broadcastMessage($msg);
                    return true;
                    break;
                }
        }
    }
}

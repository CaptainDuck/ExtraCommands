<?php

namespace ExtraCommands;

use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
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
        $this->getLogger()->info("ExtraCommands by CaptainDuck disaled! :o");
    }
    public function onLoad(){
        $this->getLogger()->info("Loading ExtraCommands by CaptainDuck!");
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
                    $sender->sendMessage(C::RED.">Rules<");
                    $sender->sendMessage(C::GRAY."1. ". $this->getConfig()->get("rule1"));
                    $sender->sendMessage(C::GRAY."2. ". $this->getConfig()->get("rule2"));
                    $sender->sendMessage(C::GRAY."3. ". $this->getConfig()->get("rule3"));
                    $sender->sendMessage(C::GRAY."4. ". $this->getConfig()->get("rule4"));
                    $sender->sendMessage(C::BLUE."5. ". $this->getConfig()->get("rulemsg"));
                    return true;
                    break;
                }
            case "server":
                if($sender instanceof Player){
                    if($sender->hasPermisssion("ec.server")){
                        $sender->sendMessage(C::GRAY. $this->getConfig()->get("srvrmsg1"));
                        $sender->sendMessage(C::BLUE. $this->getConfig()->get("srvrmsg2"));
                        return true;
                        break;
                    }
                }
        }
    }
}

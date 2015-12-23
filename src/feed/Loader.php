<?php
namespace feed;
    
use pocketmine\plugin\PluginBase;
use feed\commands\feed;
use pocketmine\Server;


class Loader extends PluginBase{
    
    public function onEnable() {
        $this->getLogger()->notice("Endlich keine Hungersnot mehr!");
        
        //commands
        $this->getServer()->getCommandMap()->register("feed", new feed($this));
    }                    
}

<?php
namespace feed\commands;
use pocketmine\command as cmd;
use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\utils\TextFormat;
use feed\Loader;

class feed extends cmd\Command implements cmd\PluginIdentifiableCommand{
  private $plugin;
  public function __construct(Loader $plugin){
    parent::__construct("feed", "Jemanden fuettern!", "/feed (player)", ["food", "eat"]);
    $this->setPermission("feedme.feed");
    $this->plugin = $plugin;
  }
    public function getPlugin(){
    return $this->plugin;
  }
  public function execute(cmd\CommandSender $sender, $label, array $args){
    if ($sender instanceof Player) {
        if (count($args) != 0) {
            if ($sender->hasPermission("feedme.other")) {
                $name = $args[0];
                $player = $this->plugin->getServer()->getPlayer($name);
                if($player instanceof Player){ 
                    // Send some pointless messeges
                    $sender->sendMessage(TextFormat::BLUE . "Der Spieler ".$name." wurde gefuettert!");
                    $player->sendMessage(TextFormat::BLUE . $sender->getName()." hat dich gefuettert!");
                    // set food to 20
                    $player->setFood(20);
                    return true;
                } else{ $sender->sendMessage(TextFormat::BLUE . "Spieler ist nicht online!"); return true; }  
            } else { $sender->sendMessage(TextFormat::DARK_RED . "Du hast nicht die Berechtigung zum fuettern!"); return true; }
        } else { // If args is missing set your own food to 20
            $sender->sendMessage(TextFormat::BLUE . "Du wurdest gefuettert!");
            $sender->setFood(20);
            return true;   
        }
    } else { $sender->sendMessage(TextFormat::DARK_RED . "Du kannst die Konsole nicht füttern!"); return true; }
  }
}

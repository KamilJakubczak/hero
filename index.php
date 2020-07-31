<?php

require_once realpath('vendor/autoload.php');

use HERO\game\Game;

$game = new Game();
$game->displayStatistics();
$game->displayFirst();
while(!$game->isFinished()){
    $game->displayRound();
    $game->displayAction();
    $game->attact();
    // $game->displayStatistics();
}
$game->displayResult();







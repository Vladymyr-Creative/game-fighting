<?php
require_once "./Player.php";

class Game
{
    private $players;

    public function __construct()
    {
        $this->players = $this->createPlayers();
        $this->startFighting();
    }

    private function startFighting()
    {
        do {
            $this->move();
            sleep(1);
        } while ($this->everybodyIsAlive());

    }

    private function createPlayers()
    {
        return [
            new Player("User"),
            new Player("Computer", 'computer')
        ];

    }

    private function everybodyIsAlive()
    {
        foreach ($this->players as $player) {
            if ($player->getHealth() <= 0) {
                vd("Game Over! {$player->getName()} is die.");
                return false;
            }
        }
        return true;
    }

    private function getEnemyFor($currentPlayer)
    {
        $enemy = $this->getRandomPlayer();
        if ($enemy == $currentPlayer) {
            $enemy = $this->getEnemyFor($currentPlayer);
        }
        return $enemy;
    }

    private function getRandomPlayer()
    {
        return getRandomElem($this->players);
    }


    private function move()
    {
        $players = $this->players;
        $this->getInformation();
        $currentPlayer = $this->getRandomPlayer();
        $enemy = $this->getEnemyFor($currentPlayer);

        $players[$currentPlayer]->makeAction($players[$enemy]);
        $this->healthInformation();
    }

    private function getInformation()
    {
        $this->stepCountInformation();
        $this->healthInformation();
    }

    private function healthInformation()
    {
        foreach ($this->players as $player) {
            vd($player->getName(), $player->getHealth());
        }
        vd('--------------------------');
    }

    private function stepCountInformation()
    {
        static $step = 1;
        vd('====================================================================================================');
        vd("Step " . $step++);
        vd('====================================================================================================');
    }
}




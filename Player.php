<?php
require_once "PlayersOptions.php";

class Player extends PlayersOptions
{
    private $name;
    private $playerType;

    public function __construct(string $name = 'Player', string $playerType = "player")
    {
        $this->setName($name);
        $this->setPlayerType($playerType);
    }

    private function getPlayerType(): string
    {
        return $this->playerType;
    }

    private function setPlayerType($playerType)
    {
        $this->playerType = $playerType;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getHealth(): int
    {
        return $this->health;
    }

    public function setHealth(int $health)
    {
        if ($health < self::MIN_HEALTH) {
            $this->health = self::MIN_HEALTH;
        } elseif ($health > self::MAX_HEALTH) {
            $this->health = self::MAX_HEALTH;
        } else {
           $this->health = $health; 
        }
    }

    public function makeAction($enemy)
    {
        if ($this->getPlayerType() == 'computer' and $this->getHealth() < self::CRITICAL_HEALTH) {
            $currentAction = getRandomElem($this->skills, self::HEALING, self::INCREASED_PROBABILITY);
        } else {
            $currentAction = getRandomElem($this->skills);
        }

        $damageValue = $this->getDamageValue($this->skills[$currentAction]);

        switch ($currentAction) {
            case self::LIGHT_KICK:
            case self::HARD_KICK:
                $enemyHealth = $enemy->getHealth();
                $enemyHealth -= $damageValue;
                $enemy->setHealth($enemyHealth);
                break;
            case self::HEALING:
                $selfHealth = $this->getHealth();
                $selfHealth += $damageValue;
                $this->setHealth($selfHealth);
                break;
            default:
                die("This action has not yet been implemented!");
                break;
        }

        vd("{$this->getName()} does {$currentAction} ({$damageValue}).");
    }

    private function getDamageValue(array $range): int
    {
        return random_int($range[0], $range[1]);
    }
}


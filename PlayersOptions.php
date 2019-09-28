<?php

class PlayersOptions
{
    const LIGHT_KICK = 'light kick';
    const HARD_KICK = 'hard kick';
    const HEALING = 'healing';
    const MAX_HEALTH = 100;
    const MIN_HEALTH = 0;
    const CRITICAL_HEALTH_RATE = 0.35;
    const INCREASED_PROBABILITY = 0.45;
    const CRITICAL_HEALTH = self::CRITICAL_HEALTH_RATE * self::MAX_HEALTH;

    protected $health = self::MAX_HEALTH;

    protected $skills = [
        self::HEALING => [18, 25],
        self::LIGHT_KICK => [18, 25],
        self::HARD_KICK => [10, 35],
    ];
}


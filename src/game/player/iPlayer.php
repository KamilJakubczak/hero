<?php

namespace HERO\game\player;

interface iPlayer {

    public function getName(): string;
    public function getLuck(): int;
    public function getSpeed(): int;
    public function getStrength(): int;
    public function getHealth(): float;
    public function getDamage(): int;

}

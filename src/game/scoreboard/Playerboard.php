<?php

namespace HERO\game\scoreboard;

class Playerboard {

    private array $statistics = [];

    public function __construct(array $statistics) {
        $statistics = [];
        foreach($statistics as $name=>$value) {
            $statistics[$name] = $value;
        }
        $this->statistics = sort($statistics);
    }
}
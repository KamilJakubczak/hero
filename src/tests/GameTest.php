<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use HERO\game\Game;
use HERO\game\player\Orderus;
use HERO\game\player\WildBeast;

final class GameTest extends TestCase {
    
    public object $game;
        
    /**
     * setUp
     *
     * @return void
     */
    public function setUp(): void {
        $this->game = new Game();
    }

    /**
     * Call protected/private method of a class.
     *
     * @param object &$object    Instantiated object that we will run method on.
     * @param string $methodName Method name to call
     * @param array  $parameters Array of parameters to pass into method.
     *
     * @return mixed Method return.
     */
    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
    
    /**
     * testLuckTrue
     *
     * @return void
     */
    public function testLuckTrue(): void {
        $params = [
            'luck'=>20,
            'generatedLuck'=>18
        ];
        $result = $this->invokeMethod($this->game, 'checkLuck', $params);
        $this->assertTrue($result);
    }
    
    /**
     * testLuckFalse
     *
     * @return void
     */
    public function testLuckFalse(): void {
        $params = [
            'luck'=>20,
            'generatedLuck'=>50
        ];
        $result = $this->invokeMethod($this->game, 'checkLuck', $params);
        $this->assertFalse($result);
    }
    
    /**
     * testMissTrue
     *
     * @return void
     */
    public function testMissTrue(): void {
        $params = [
            'luck'=>20,
            'generatedLuck'=>18
        ];
        $result = $this->invokeMethod($this->game, 'miss', $params);
        $this->assertTrue($result);
    }
    
    /**
     * testMissFalse
     *
     * @return void
     */
    public function testMissFalse(): void {
        $params = [
            'luck'=>20,
            'generatedLuck'=>40
        ];
        $result = $this->invokeMethod($this->game, 'miss', $params);
        $this->assertFalse($result);
       
    }
    
    /**
     * testMissNotfication
     *
     * @return void
     */
    public function testMissNotfication(): void {
        $properties = [
            'health'=>[
                'min'=>70,
                'max'=>100
            ],
            'strength'=>[
                'min'=>70,
                'max'=>80
            ],
            'defence'=>[
                'min'=>45,
                'max'=>55
            ],
            'speed'=>[
                'min'=>0,
                'max'=>0
            ],
            'luck'=>[
                'min'=>100,
                'max'=>100
            ]
        ];
        $orderus = new Orderus($properties);
        $game = new Game();
        $game->setOrderus($orderus);
        $game->setFirst();
        $game->attact();

        $this->expectOutputString('Miss');
    }
    
    /**
     * testSetFirstAttackerBasedOnSpeed
     *
     * @return void
     */
    public function testSetFirstAttackerBasedOnSpeed(): void {
        $properties = [
            'health'=>[
                'min'=>70,
                'max'=>100
            ],
            'strength'=>[
                'min'=>70,
                'max'=>80
            ],
            'defence'=>[
                'min'=>45,
                'max'=>55
            ],
            'speed'=>[
                'min'=>100,
                'max'=>100
            ],
            'luck'=>[
                'min'=>100,
                'max'=>100
            ]
        ];
        $properties2 = [
            'health'=>[
                'min'=>70,
                'max'=>100
            ],
            'strength'=>[
                'min'=>70,
                'max'=>80
            ],
            'defence'=>[
                'min'=>45,
                'max'=>55
            ],
            'speed'=>[
                'min'=>0,
                'max'=>0
            ],
            'luck'=>[
                'min'=>100,
                'max'=>100
            ]
        ];

        $orderus = new Orderus($properties);
        $enemy = new WildBeast($properties2);
        $game = new Game();
        $game->setOrderus($orderus);
        $game->setEnemy($enemy);
        $game->setFirst();
        $result = $game->getAttacker();
        $name = $result->getName();
        $this->assertEquals('Orderus', $name);

    }
        
    /**
     * testSetFirstAttackerBasedOnLuck
     *
     * @return void
     */
    public function testSetFirstAttackerBasedOnLuck(): void {
        $properties = [
            'health'=>[
                'min'=>70,
                'max'=>100
            ],
            'strength'=>[
                'min'=>70,
                'max'=>80
            ],
            'defence'=>[
                'min'=>45,
                'max'=>55
            ],
            'speed'=>[
                'min'=>100,
                'max'=>100
            ],
            'luck'=>[
                'min'=>0,
                'max'=>0
            ]
        ];
        $properties2 = [
            'health'=>[
                'min'=>70,
                'max'=>100
            ],
            'strength'=>[
                'min'=>70,
                'max'=>80
            ],
            'defence'=>[
                'min'=>45,
                'max'=>55
            ],
            'speed'=>[
                'min'=>100,
                'max'=>100
            ],
            'luck'=>[
                'min'=>100,
                'max'=>100
            ]
        ];

        $orderus = new Orderus($properties);
        $enemy = new WildBeast($properties2);
        $game = new Game();
        $game->setOrderus($orderus);
        $game->setEnemy($enemy);
        $game->setFirst();
        $result = $game->getAttacker();
        $name = $result->getName();
        $this->assertEquals('Wild Beast', $name);

    }
        
    /**
     * testSetFirstAttackerWhenDraw
     *
     * @return void
     */
    public function testSetFirstAttackerWhenDraw(): void {
        $properties = [
            'health'=>[
                'min'=>70,
                'max'=>100
            ],
            'strength'=>[
                'min'=>70,
                'max'=>80
            ],
            'defence'=>[
                'min'=>45,
                'max'=>55
            ],
            'speed'=>[
                'min'=>100,
                'max'=>100
            ],
            'luck'=>[
                'min'=>0,
                'max'=>0
            ]
        ];
        $properties2 = [
            'health'=>[
                'min'=>70,
                'max'=>100
            ],
            'strength'=>[
                'min'=>70,
                'max'=>80
            ],
            'defence'=>[
                'min'=>45,
                'max'=>55
            ],
            'speed'=>[
                'min'=>100,
                'max'=>100
            ],
            'luck'=>[
                'min'=>0,
                'max'=>0
            ]
        ];

        $orderus = new Orderus($properties);
        $enemy = new WildBeast($properties2);
        $game = new Game();
        $game->setOrderus($orderus);
        $game->setEnemy($enemy);
        $game->setFirst();
        $result = $game->getAttacker();
        $name = $result->getName();
        $this->assertEquals('Orderus', $name);

    }
    
    /**
     * testIsWinner
     *
     * @return void
     */
    public function testIsWinner(): void {
        $properties = [
            'health'=>[
                'min'=>70,
                'max'=>100
            ],
            'strength'=>[
                'min'=>70,
                'max'=>80
            ],
            'defence'=>[
                'min'=>45,
                'max'=>55
            ],
            'speed'=>[
                'min'=>100,
                'max'=>100
            ],
            'luck'=>[
                'min'=>0,
                'max'=>0
            ]
        ];
        $properties2 = [
            'health'=>[
                'min'=>0,
                'max'=>0
            ],
            'strength'=>[
                'min'=>70,
                'max'=>80
            ],
            'defence'=>[
                'min'=>45,
                'max'=>55
            ],
            'speed'=>[
                'min'=>100,
                'max'=>100
            ],
            'luck'=>[
                'min'=>0,
                'max'=>0
            ]
        ];
        
        $orderus = new Orderus($properties);
        $enemy = new WildBeast($properties2);
        $game = new Game();
        $game->setOrderus($orderus);
        $game->setEnemy($enemy);
        $game->setFirst();
        $result = $game->isWinner   ();
        $winner = $game->getWinner()->getName();
        $this->assertTrue($result);
        $this->assertEquals($winner, 'Orderus');

        $orderus = new Orderus($properties2);
        $enemy = new WildBeast($properties);
        $game = new Game();
        $game->setOrderus($orderus);
        $game->setEnemy($enemy);
        $game->setFirst();
        $result = $game->isWinner();
        $winner = $game->getWinner()->getName();
        $this->assertTrue($result);
        $this->assertEquals($winner, 'Wild Beast');
    }
    
    /**
     * testIsFinished
     *
     * @return void
     */
    public function testIsFinished(): void {
        $properties = [
            'health'=>[
                'min'=>70,
                'max'=>100
            ],
            'strength'=>[
                'min'=>70,
                'max'=>80
            ],
            'defence'=>[
                'min'=>45,
                'max'=>55
            ],
            'speed'=>[
                'min'=>100,
                'max'=>100
            ],
            'luck'=>[
                'min'=>0,
                'max'=>0
            ]
        ];
        $properties2 = [
            'health'=>[
                'min'=>0,
                'max'=>0
            ],
            'strength'=>[
                'min'=>70,
                'max'=>80
            ],
            'defence'=>[
                'min'=>45,
                'max'=>55
            ],
            'speed'=>[
                'min'=>100,
                'max'=>100
            ],
            'luck'=>[
                'min'=>0,
                'max'=>0
            ]
        ];
        
        $orderus = new Orderus($properties);
        $enemy = new WildBeast($properties2);
        $game = new Game();
        $game->setOrderus($orderus);
        $game->setEnemy($enemy);
        $game->setFirst();
        $result = $game->isFinished();
        $this->assertTrue($result);

        
    }
    
    /**
     * testIsFinishedBasedOnRoundCount
     *
     * @return void
     */
    public function testIsFinishedBasedOnRoundCount(): void {
        $this->game->setRoundCounter(21);
        $result = $this->game->isFinished();
        $this->assertTrue($result);

    }
}
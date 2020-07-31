<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use HERO\game\player as player;

final class PlayerTest extends TestCase {

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
    // public function setUp(): void {
    //     $this->orderus = new O
    // }

    public function testGettingHit(): void {
        $properties = [
            'health'=>[
                'min'=>100,
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
        $player = new player\WildBeast($properties);
        $player->hit(50);
        $this->assertEquals(50, $player->getHealth());

    }

}
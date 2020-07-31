<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use HERO\game\player as player;

final class OrderusTest extends TestCase {

    public object $orderus;
    
    public function setUp(): void {
        $this->orderus = new player\Orderus();
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

    public function testMagicShield(): void {
        $player = new player\Orderus();
        $result = $this->invokeMethod($player, 'magicShield', array(50));
        $this->assertEquals(25, $result);

    }

    public function testRapidStrike(): void {
        $properties = [
            'health'=>[
                'min'=>100,
                'max'=>100
            ],
            'strength'=>[
                'min'=>50,
                'max'=>50
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
        $player = new player\Orderus($properties);
        $result = $this->invokeMethod($player, 'rapidStrike');
        $this->assertEquals(50, $result);

    }

    public function testisSkillUsableTrue(): void {
        $params = [
            'luck'=>20,
            'chance'=>20
        ];
        $result =  $this->invokeMethod($this->orderus, 'isSkillUsable', $params);
        $this->assertTrue($result);
    }

    public function testisSkillUsableFalse(): void {
        $params = [
            'luck'=>21,
            'chance'=>20
        ];
        $result =  $this->invokeMethod($this->orderus, 'isSkillUsable', $params);
        $this->assertFalse($result);
    }
}
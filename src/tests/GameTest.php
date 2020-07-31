<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use HERO\game\Game;
use HERO\game\player\Orderus;
use HERO\game\player\WildBeast;

final class GameTest extends TestCase {
    
    public object $game;
    
    public function setUp(): void {
        $this->game = new Game();
        // $this->orderus = new Orderus();
        // $this->wildBeast = new WildBeast();
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

    public function testLuckTrue(): void {
        $params = [
            'luck'=>20,
            'generatedLuck'=>18
        ];
        $result = $this->invokeMethod($this->game, 'checkLuck', $params);
        $this->assertTrue($result);
    }

    public function testLuckFalse(): void {
        $params = [
            'luck'=>20,
            'generatedLuck'=>50
        ];
        $result = $this->invokeMethod($this->game, 'checkLuck', $params);
        $this->assertFalse($result);
    }

    public function testMissTrue(): void {
        $params = [
            'luck'=>20,
            'generatedLuck'=>18
        ];
        $result = $this->invokeMethod($this->game, 'miss', $params);
        $this->assertTrue($result);
    }

    public function testMissFalse(): void {
        $params = [
            'luck'=>20,
            'generatedLuck'=>40
        ];
        $result = $this->invokeMethod($this->game, 'miss', $params);
        $this->assertFalse($result);
    }
}
<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use HERO\game\player as player;

final class PlayerTest extends TestCase {

    private object $orderus;
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

    // public function checkOrderusGotLuckyMiss(): void {
    //     $generatedLuck = 20;
    //     $damage = 20;
    //     $orderus = new player\Orderus();
    //     $result = $this->invokeMethod($orderus, 'gotLucky,')
    //     $this->AssertEquals()
    // }
}
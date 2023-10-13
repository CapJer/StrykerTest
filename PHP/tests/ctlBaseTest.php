<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
require_once(__DIR__ . "/../src/base/ctlBase.php");

final class ctlBaseTest extends TestCase
{
    public function testNewNotEmpty(): void
    {
        $ctl = new ctlBase();
        $this->assertNotNull($ctl);
    }
}

<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
require_once(__DIR__ . "/../src/providers/provWebController.php");

final class provWebControllerTest extends TestCase
{
    public function testNewNotEmpty(): void
    {
        $ctl = new provWebController();
        $this->assertNotNull($ctl);
    }

    public function testValidURL(): void
    {
        $ctl = new provWebController();
        $this->assertTrue($ctl->ValidURL("Projects"));
    }

    public function testInvalidURL(): void
    {
        $ctl = new provWebController();
        $this->assertFalse($ctl->ValidURL("NotAValidURL"));
    }
}

<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
require __DIR__ . "/../src/base/doBase.php";

final class doBaseTest extends TestCase
{
    public function testNewNotEmpty(): void
    {
        $obj = new doBase();
        $this->assertNotNull($obj);
    }

    public function testIsValidArray(): void
    {
        $obj = new doBase();
        $this->assertIsArray($obj->AsJSONObject());
    }
}

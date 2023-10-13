<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
require_once(__DIR__ . "/../src/base/tblBase.php");

final class tblBaseTest extends TestCase
{
    /**
     * @dataProvider myProvider
     */
    public function testNewNotEmpty($className): void
    {
        $tbl = new tblBase($className);
        $this->assertNotNull($tbl);
    }

    public static function myProvider(): array
    {
        return [
            ['Name']
        ];
    }
}
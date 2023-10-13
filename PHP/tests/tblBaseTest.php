<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
require __DIR__ . "/../src/base/tblBase.php";

final class tblBaseTest extends TestCase
{
    /**
     * @dataProvider myProvider
     */
    public function testNewNotEmpty($db, $className): void
    {
        $tbl = new tblBase($db, $className);
        $this->assertNotNull($tbl);
    }

    public static function myProvider(): array
    {
        return [
            ['valueOfA-0', 'valueOfExpected-0'],
            ['valueOfA-1', 'valueOfExpected-1'],
            ['valueOfA-2', 'valueOfExpected-2'],
            ['valueOfA-3', 'valueOfExpected-3']
        ];
    }
}
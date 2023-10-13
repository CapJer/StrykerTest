<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
require_once(__DIR__ . "/../src/base/doProperty.php");

final class doPropertyTest extends TestCase
{
    /**
     * @dataProvider myProvider
     */
    public function testNewNotEmpty($db, $api, $defaultValue, $valType): void
    {
        $prop = new doProperty($db, $api, $defaultValue, $valType);
        $this->assertNotNull($prop);
    }

    /**
     * @dataProvider myProvider
     */
    public function testCorrectTypeSet($db, $api, $defaultValue, $valType): void
    {
        $prop = new doProperty($db, $api, $defaultValue, $valType);
        $this->assertSame($valType, $prop->GetType());
    }

    /**
     * @dataProvider myProvider
     */
    public function testIfDefaultCorrect($db, $api, $defaultValue, $valType): void
    {
        $prop = new doProperty($db, $api, $defaultValue, $valType);
        $this->assertSame($defaultValue, $prop->GetValue());
    }

    /**
     * @dataProvider myProvider
     */
    public function testSetValue($db, $api, $defaultValue, $valType): void
    {
        $prop = new doProperty($db, $api, $defaultValue, $valType);
        $newVal = $defaultValue;

        if ($valType === \PDO::PARAM_STR) {
            $newVal = 'test';
        }

        if ($valType === \PDO::PARAM_INT) {
            $newVal = 1;
        }

        if ($valType === \PDO::PARAM_BOOL) {
            $newVal = true;
        }

        $prop->SetValue($newVal);

        $this->assertNotSame($defaultValue, $prop->GetValue());
        $this->assertSame($newVal, $prop->GetValue());
    }

    public static function myProvider(): array
    {
        return [
            ['NAME', 'Name', '', \PDO::PARAM_STR],
            ['ID', 'ID', -1, \PDO::PARAM_INT],
            ['IS_SET', 'IsSet', false, \PDO::PARAM_BOOL]
        ];
    }
}

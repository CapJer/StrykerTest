<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
require __DIR__ . "/../src/providers/provDatabase.php";

final class provDatabaseTest extends TestCase
{
    public function testNewNotEmpty(): void
    {
        $db = new provDatabase();
        $this->assertNotNull($db);
    }
}

<?php

namespace Tests\Database;

use PHPUnit\Framework\TestCase;
use Home\Solid\Database\Connection;
use PDO;
class ConnectionTest extends TestCase
{
    public function testConnection()
    {
        $pdo = Connection::getConnection();
        $this->assertInstanceOf(PDO::class, $pdo);
    }
}
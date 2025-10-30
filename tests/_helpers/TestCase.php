<?php
declare(strict_types=1);

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    /** @var \PDO */
    protected $pdo;

    protected function setUp(): void
    {
        parent::setUp();

        $dsn = sprintf(
            'mysql:host=%s;port=%d;dbname=%s;charset=utf8mb4',
            TEST_DB_HOST,
            TEST_DB_PORT,
            TEST_DB_NAME
        );

        $this->pdo = new \PDO($dsn, TEST_DB_USER, TEST_DB_PASS, [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        ]);

        // Transacción para aislar cada test
        $this->pdo->beginTransaction();
    }

    protected function tearDown(): void
    {
        if ($this->pdo && $this->pdo->inTransaction()) {
            $this->pdo->rollBack();
        }
        parent::tearDown();
    }

    protected function pathUploads(): string
    {
        return TEST_UPLOADS_PATH;
    }
    protected function pathMailbox(): string
    {
        return TEST_MAILBOX_PATH;
    }

    protected function fakeUpload(string $filename, string $contents = 'img'): string
    {
        $dest = rtrim($this->pathUploads(), '/') . '/' . $filename;
        file_put_contents($dest, $contents);
        return $dest;
    }
}

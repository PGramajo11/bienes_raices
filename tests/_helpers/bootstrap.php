<?php
// silenciar deprecations (como E_STRICT) para no ensuciar la salida de PHPUnit
error_reporting(E_ALL & ~E_DEPRECATED);
ini_set('display_errors', '0');

// 1) Autoload de Composer (DEBE ser lo primero)
$composer = __DIR__ . '/../../vendor/autoload.php';
if (!file_exists($composer)) {
    fwrite(STDERR, "ERROR: Falta vendor/autoload.php. Ejecuta 'composer install'.\n");
    exit(1);
}
require $composer;

// 2) Cargar variables de entorno (.env.test)
$envFile = __DIR__ . '/../../.env.test';
if (!file_exists($envFile)) {
    fwrite(STDERR, "ERROR: Falta el archivo .env.test en la raíz del proyecto.\n");
    exit(1);
}
$ENV = parse_ini_file($envFile, false, INI_SCANNER_TYPED);

// 3) Constantes de entorno para pruebas
define('TEST_DB_HOST', $ENV['DB_HOST'] ?? '127.0.0.1');
define('TEST_DB_PORT', (int) ($ENV['DB_PORT'] ?? 3306));
define('TEST_DB_NAME', $ENV['DB_NAME'] ?? 'bienes_test');
define('TEST_DB_USER', $ENV['DB_USER'] ?? 'root');
define('TEST_DB_PASS', $ENV['DB_PASS'] ?? '');

define('TEST_UPLOADS_PATH', $ENV['UPLOADS_PATH'] ?? 'storage/testing/uploads');
define('TEST_MAILBOX_PATH', $ENV['MAILBOX_PATH'] ?? 'storage/testing/mailbox');
define('TEST_MAIL_TRANSPORT', $ENV['MAIL_TRANSPORT'] ?? 'dummy');

// 4) Asegurar carpetas de testing
@mkdir(TEST_UPLOADS_PATH, 0777, true);
@mkdir(TEST_MAILBOX_PATH, 0777, true);

// 5) Limpiar carpetas
function rrmdir($path)
{
    if (!is_dir($path))
        return;
    $items = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS),
        RecursiveIteratorIterator::CHILD_FIRST
    );
    foreach ($items as $item) {
        $item->isDir() ? rmdir($item) : unlink($item);
    }
}
rrmdir(TEST_UPLOADS_PATH);
@mkdir(TEST_UPLOADS_PATH, 0777, true);
rrmdir(TEST_MAILBOX_PATH);
@mkdir(TEST_MAILBOX_PATH, 0777, true);

// 6) Autoload simple para tu MVC (si no usas PSR-4 propio)
spl_autoload_register(function ($class) {
    $paths = ['controllers', 'models', 'src', 'includes'];
    foreach ($paths as $p) {
        $file = __DIR__ . "/../../$p/" . str_replace('\\', '/', $class) . ".php";
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// 7) (AHORA sí) Carga explícita de helpers de test
require_once __DIR__ . '/TestCase.php';
require_once __DIR__ . '/MailFake.php';

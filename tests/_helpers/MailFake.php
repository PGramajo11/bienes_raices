<?php
declare(strict_types=1);

final class MailFake
{
    public static function send(string $to, string $subject, string $body): bool
    {
        if (TEST_MAIL_TRANSPORT === 'dummy') {
            $ts = date('Ymd_His');
            $file = rtrim(TEST_MAILBOX_PATH, '/') . "/mail_{$ts}.txt";
            $content = "TO: $to\nSUBJECT: $subject\nBODY:\n$body\n";
            return (bool) file_put_contents($file, $content);
        }

        // En caso de usar envío real (SMTP) se podría integrar PHPMailer aquí.
        return false;
    }

    public static function lastMessage(): ?string
    {
        $files = glob(rtrim(TEST_MAILBOX_PATH, '/') . '/*.txt');
        if (!$files)
            return null;
        usort($files, fn($a, $b) => filemtime($b) <=> filemtime($a));
        return file_get_contents($files[0]);
    }
}

#!/usr/bin/php -q
<?php
require('PHPMailer/src/PHPMailer.php');
require('PHPMailer/src/SMTP.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

define('ON_SECOND', true); // 準時寄出(false)、準時收到(true)

define('SMTP_USERNAME', 'username@gmail.com');
define('SMTP_PASSWORD', 'email_password');
define('FROM_NAME',     'username');
define('FROM_MAIL',     'username@gmail.com');
define('TO_MAIL',       'sendto@example.com');
define('TO_NAME',       'sendto_username');

mb_internal_encoding('UTF-8');

$mail = new PHPMailer();
if (!is_object($mail) || !$mail) {
    echo "Mail initial error\n";
    exit;
}

$mail->IsSMTP();

// $mail->SMTPDebug = 1;
$mail->Port       = 587; // 465 or 578
$mail->SMTPSecure = 'tls'; // ssl or tls
$mail->Host       = 'smtp.gmail.com'; // ssl://smtp.gmail.com
$mail->Encoding   = 'base64';
$mail->CharSet    = 'utf-8';
$mail->SMTPAuth   = true;
$mail->Username   = SMTP_USERNAME;
$mail->Password   = SMTP_PASSWORD;
$mail->WordWrap   = 70;

$mail->setFrom(FROM_MAIL, FROM_NAME);

$mail->AddAddress(TO_MAIL, TO_NAME);
// $mail->AddAddress(TO_MAIL2, TO_NAME2); // add more email

// $mail->AddAttachment('path/filename'); // Attachment

$mail->IsHTML(true);
$mail->Subject = '標題-測試';
$mail->Body    = "內容：<br>\r\n測試<br>\r\n<a href=\"http://example.com\">Test</a>Test<br>\r\n";

if (ON_SECOND) {
    // crontab 設定需要提前一分鐘
    while (1) {
        if (date('s') < 56) { // SMTP process need 4 secs
            sleep(1);
            continue;
        }

        if ($mail->Send()) {
            echo date('Y-m-d H:i:s') . " mail sent\n";
            exit;
        } else {
            echo $mail->ErrorInfo;
            exit;
        }
    }
} else {
    if ($mail->Send())
        echo date('Y-m-d H:i:s') . " mail sent\n";
    else
        echo $mail->ErrorInfo;
}
?>

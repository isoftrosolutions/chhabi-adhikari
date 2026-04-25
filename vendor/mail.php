<?php
require_once __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendEmail(array $options): bool {
    $defaults = [
        'to' => '',
        'subject' => '',
        'body' => '',
        'altBody' => '',
    ];
    $opts = array_merge($defaults, $options);

    if (empty($opts['to']) || empty($opts['subject']) || empty($opts['body'])) {
        return false;
    }

    try {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = getSetting('smtp_host', 'smtp.gmail.com');
        $mail->SMTPAuth = true;
        $mail->Username = getSetting('smtp_username', '');
        $mail->Password = getSetting('smtp_password', '');
        
        $enc = getSetting('smtp_encryption', 'tls');
        if ($enc === 'ssl') {
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        } elseif ($enc === 'tls') {
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        }
        
        $mail->Port = (int)getSetting('smtp_port', '587');
        $mail->CharSet = 'UTF-8';

        $fromName = getSetting('smtp_from_name', 'D-School System');
        $fromEmail = getSetting('smtp_username', '');
        $mail->setFrom($fromEmail, $fromName);
        $mail->addAddress($opts['to']);
        $mail->addReplyTo($fromEmail, $fromName);

        $mail->isHTML(true);
        $mail->Subject = $opts['subject'];
        $mail->Body = $opts['body'];
        $mail->AltBody = $opts['altBody'] ?: strip_tags($opts['body']);

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log('Mail error: ' . $e->getMessage());
        return false;
    }
}

function sendReplyEmail(array $message, string $replyText): bool {
    $subject = 'Re: D-School System - Thank you for your message';
    $body = '
    <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px;">
        <div style="background: linear-gradient(135deg, #0f1e38, #1a2f5a); padding: 24px; text-align: center; border-radius: 12px 12px 0 0;">
            <h1 style="color: #fff; margin: 0; font-size: 24px;">D-School System</h1>
            <p style="color: #F5A623; margin: 8px 0 0;">Nepal\'s Leading NLP Institute</p>
        </div>
        <div style="background: #fff; padding: 30px; border: 1px solid #e2e8f0; border-top: none; border-radius: 0 0 12px 12px;">
            <p style="margin: 0 0 20px;">Dear ' . htmlspecialchars($message['name']) . ',</p>
            <p style="margin: 0 0 20px;">Thank you for reaching out to D-School System. We have received your message and wanted to respond personally.</p>
            <div style="background: #f8fafc; border-left: 4px solid #F5A623; padding: 16px 20px; margin: 20px 0; border-radius: 0 8px 8px 0;">
                <p style="margin: 0; font-style: italic; color: #333; line-height: 1.6;">' . nl2br(htmlspecialchars($replyText)) . '</p>
            </div>
            <p style="margin: 20px 0;">If you have any further questions, please don\'t hesitate to reply to this email or contact us directly.</p>
            <p style="margin: 20px 0 0;">Warm regards,<br><strong>Chhabi Adhikari & Team</strong><br>D-School System</p>
        </div>
        <div style="text-align: center; padding: 16px; font-size: 12px; color: #999;">
            <p style="margin: 0;">This is an automated response. Please do not reply directly to this email if you want to continue the conversation.</p>
        </div>
    </div>';

    return sendEmail([
        'to' => $message['email'],
        'subject' => $subject,
        'body' => $body,
    ]);
}
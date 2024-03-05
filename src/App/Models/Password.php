<?php

namespace App\App\Models;

use App\Config\Database;
use PDOException;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// require_once __DIR__ . "/../../config/mailer.php";


class Password
{
    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function sendLink()
    {
        $errors = [];
        if (isset($_POST['sendLink'])) {
            $email = $_POST['email'];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Неправильная почта';
            }

            try {
                $sql = "SELECT * FROM users WHERE email = :email";
                $stmt = $this->db->getConnection()->prepare($sql);
                $stmt->bindParam(':email', $email);
                $stmt->execute();
                $result = $stmt->fetch();

                if ($result) {
                    $token = bin2hex(random_bytes(16));
                    $token_hash = hash("sha256", $token);

                    $expire = date("Y-m-d H:i:s", time() + 60 * 30);

                    $sql = "UPDATE users SET reset_token_hash = :token_hash, reset_token_expires_at = :expire WHERE email = :email";

                    $stmt = $this->db->getConnection()->prepare($sql);
                    $stmt->bindParam(':token_hash', $token_hash);
                    $stmt->bindParam(':expire', $expire);
                    $stmt->bindParam(':email', $email);
                    $stmt->execute();

                    $mail = new PHPMailer(true);

                    $mail->CharSet = "utf-8"; // set charset to utf8
                    $mail->SMTPAuth = true; // Enable SMTP authentication
                    $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted

                    $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
                    $mail->Port = 587; // TCP port to connect to
                    $mail->SMTPOptions = array(
                        'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                        )
                    );
                    $mail->isHTML(true); // Set email format to HTML
                    $mail->Username = 'wowcool2001@mail.ru'; // SMTP username
                    $mail->Password = 'w3kc1Gsigkau0BdDqzkH'; // SMTP password

                    $mail->setFrom('wowcool2001@mail.ru');
                    $mail->addAddress($email);

                    $mail->isHTML(true);
                    $mail->Subject = 'Восстановление доступа';
                    $mail->Body    = <<<END
                        
                        Нажмить <a href="http://edu-portal/verify?token=$token">здесь</a> чтобы восстановить пароль
                        
                        END;

                    try {
                        $mail->send();
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                    $errors['success'] = "На $email отправлено письмо для восстановления!";
                } else {
                    $errors['no-exist'] = "Такая почта не зарегистрирована или не существует";
                }
            } catch (PDOException $e) {
                $errors['db_error'] = "Ошибка базы данных:" . $e->getMessage();;
            }
        }
        return $errors;
    }

    public function resetPassword()
    {
    }
}

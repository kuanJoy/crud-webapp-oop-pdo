<?php

namespace App\App\Models;

use App\Config\Database;
use PDOException;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


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
                $sql = "SELECT * FROM users WHERE email = ?";
                $stmt = $this->db->getConnection()->prepare($sql);
                $stmt->bindParam(1, $email);
                $stmt->execute();
                $result = $stmt->fetch();

                if ($result) {
                    $token = bin2hex(random_bytes(16));
                    $token_hash = hash("sha256", $token);

                    $expire = date("Y-m-d H:i:s", time() + 60 * 30);

                    $sql = "UPDATE users SET reset_token_hash = :token_hash, reset_token_expires_at = :expire WHERE email = :email";

                    $stmt = $this->db->getConnection()->prepare($sql);
                    $stmt->bindParam(1, $token_hash);
                    $stmt->bindParam(1, $expire);
                    $stmt->bindParam(1, $email);
                    $stmt->execute();

                    $mail = new PHPMailer(true);

                    try {
                        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                        $mail->isSMTP();                                            //Send using SMTP
                        $mail->Host       = 'smtp.mail.ru';                     //Set the SMTP server to send through
                        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                        $mail->Username   = 'hjejssdsdssdsd@mail.ru';                     //SMTP username
                        $mail->Password   = 'JHwnUkyJ7AXeFizL81xT';                               //SMTP password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                        $mail->setFrom('noreply@mail.ru', 'Mailer');
                        $mail->addAddress($email);     //Add a recipient
                        $mail->addReplyTo('info@example.com', 'Information');
                        $mail->addCC('cc@example.com');
                        $mail->addBCC('bcc@example.com');

                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = 'Восстановление доступа';
                        $mail->Body    = <<<END
                        
                        
                        END;

                        $mail->send();
                        $errors['success'] =  'Ссылка на восстановление была отправлена!';
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                }
            } catch (PDOException $e) {
                $errors['db_error'] = "Ошибка базы данных:" . $e->getMessage();;
            }
        }
        return $errors;
    }
}

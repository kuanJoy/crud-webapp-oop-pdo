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

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function sendLink()
    {
        $errors = [];
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

                $expire = date("Y-m-d H:i:s", strtotime("+12 hours"));

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

                $mail->Host = 'mail.bigidea.edu.kg'; // Specify main and backup SMTP servers
                $mail->Port = 465; // TCP port to connect to
                $mail->Username = 'bigidea.edu.kg@bigidea.edu.kg'; // SMTP username
                $mail->Password = 'gasagyjaz228LOVE'; // SMTP password
                $mail->setFrom('bigidea.edu.kg@bigidea.edu.kg');


                // $mail->Host = 'smtp.mail.ru'; // Specify main and backup SMTP servers
                // $mail->Port = 587; // TCP port to connect to
                // $mail->Username = 'wowcool2001@mail.ru'; // SMTP username
                // $mail->Password = 'w3kc1Gsigkau0BdDqzkH'; // SMTP password
                // $mail->setFrom('wowcool2001@mail.ru');

                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
                $mail->isHTML(true); // Set email format to HTML

                $mail->addAddress($email);

                $mail->isHTML(true);
                $mail->Subject = 'Восстановление доступа';

                //                 $mail->Body    = <<<END

                //                         Нажмить <a href="http://bigidea.edu.kg/reset?token=$token">здесь</a> чтобы восстановить пароль

                // END;
                $mail->Body    = <<<END
                        Нажмить <a href="http://big-idea/reset?token=$token">здесь</a> чтобы восстановить пароль
END;
                try {
                    $mail->send();
                    $_SESSION['email_temp'] = $email;
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: " . $mail->ErrorInfo;
                }
                $errors['success'] = "На $email отправлено письмо для восстановления!";
            } else {
                $errors['no-exist'] = "Такая почта не зарегистрирована или не существует";
            }
        } catch (PDOException $e) {
            $errors['db_error'] = 'Ошибка базы данных: ' . $e->getMessage();
        }
        return $errors;
    }

    // ================== RESET PASSWORD ===============
    public function checkToken()
    {
        $errors = [];
        try {
            $tokenCheck = "SELECT * FROM users WHERE reset_token_hash = :reset_token_hash";
            $stmt = $this->db->getConnection()->prepare($tokenCheck);
            $stmt->bindParam(':reset_token_hash', hash("sha256", $_GET['token']));
            $stmt->execute();
            $result = $stmt->fetch();

            if ($result) {
                if (strtotime($result['reset_token_expires_at']) <= time()) {
                    $errors['expired'] = "Срок ссылки истёк";
                    // закинем еще раз для переотправки нового токена. если срок истек, на случай если зашел в другого устройства
                    $_SESSION['email_temp'] = $result['email'];
                } else {
                    $errors['success'] = true;
                }
            } else {
                $errors['not-found'] = "Ссылка недействительна";
            }
        } catch (PDOException $e) {
            $errors['db_error'] = "Ошибка базы данных:" . $e->getMessage();
        }
        return $errors;
    }

    public function resetPassword()
    {
        $errors = [];
        try {
            $password = $_POST['pass'];
            $repass = $_POST['repass'];
            $token = $_POST['token'];

            var_dump($_POST);

            if (empty($password)) {
                $errors['pass'] = "Введите пароль";
            }

            if (empty($repass)) {
                $errors['repass'] = "Повторите пароль";
            }

            if (!preg_match('/^(?=.*\d)[0-9a-zA-Z]{6,15}$/', $password)) {
                $errors["length-pass"] = "Длина пароля должна быть от 6 до 15 символов. Пароль должен содержать как минимум одну цифру.";
            }

            if ($password !== $repass) {
                $errors['pass-match'] = "Пароли не совпадают";
            }

            $sql = "SELECT * FROM users WHERE reset_token_hash = :reset_token_hash";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->bindParam(":reset_token_hash", hash("sha256", $token));
            $stmt->execute();

            $user = $stmt->fetch();
            if (isset($user)) {
                $hashedPass = password_hash($password, PASSWORD_DEFAULT);
                $sql = "UPDATE users SET password = :hashedPass, 
                password_reset_at = :password_reset_at, 
                reset_token_hash = NULL, 
                reset_token_expires_at = NULL
                WHERE id = :id";
                $stmt = $this->db->getConnection()->prepare($sql);
                $stmt->bindParam(":hashedPass", $hashedPass);
                $stmt->bindParam(":password_reset_at", date("Y-m-d H:i:s"));
                $stmt->bindParam(":id", intval($user['id']));

                if ($stmt->execute()) {
                    $_SESSION['success-reset'] = "Пароль успешно обновлён";
                    header("Location: /login");
                }
            }
        } catch (PDOException $e) {
            $errors['db_error'] = "Ошибка базы данных:" . $e->getMessage();
        }
        return $errors;
    }
}

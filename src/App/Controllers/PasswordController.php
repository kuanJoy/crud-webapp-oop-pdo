<?php

namespace App\App\Controllers;

use App\App\Models\Password;
use App\Config\Database;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class PasswordController
{
    protected $password;

    public function __construct()
    {
        $db = new Database();
        $this->password = new Password($db);
    }

    public function sendLink()
    {
        if (isset($_POST['sendLink'])) {
            if (!isset($_SESSION['cooldown_time']) || $_SESSION['cooldown_time'] < time()) {
                $email = $_POST['email'];
                $user = $this->password->findUserByEmail($email);

                if ($user) {
                    $token = bin2hex(random_bytes(16));
                    $token_hash = hash("sha256", $token);
                    $expire = date("Y-m-d H:i:s", strtotime("+12 hours"));

                    if ($this->password->updateResetToken($email, $token_hash, $expire)) {
                        $_SESSION['cooldown_time'] = time() + 120;
                        return ['success' => "На $email отправлено письмо для восстановления!"];
                    } else {
                        return ['error' => "Ошибка при обновлении токена в базе данных"];
                    }
                } else {
                    return ['error' => "Пользователь с таким email не найден"];
                }
            } else {
                return ['error' => "Подождите 2 минуты перед отправкой новой ссылки"];
            }
        }
    }


    public function checkToken()
    {
        if (isset($_GET['token'])) {
            $token = $_GET['token'];
            $user = $this->password->findUserByResetToken($token);

            if ($user) {
                if (strtotime($user['reset_token_expires_at']) <= time()) {
                    return ['error' => "Срок ссылки истёк"];
                } else {
                    return ['success' => true];
                }
            } else {
                return ['error' => "Ссылка недействительна"];
            }
        }
    }

    public function resetPassword()
    {
        if (isset($_POST['resetPass'])) {
            $password = $_POST['pass'];
            $repass = $_POST['repass'];
            $token = $_POST['token'];

            if (empty($password)) {
                return ['pass' => "Введите пароль"];
            }

            if (empty($repass)) {
                return ['repass' => "Повторите пароль"];
            }

            if (!preg_match('/^(?=.*\d)[0-9a-zA-Z]{6,15}$/', $password)) {
                return ["length-pass" => "Длина пароля должна быть от 6 до 15 символов. Пароль должен содержать как минимум одну цифру."];
            }

            if ($password !== $repass) {
                return ['pass-match' => "Пароли не совпадают"];
            }

            $user = $this->password->findUserByResetToken($token);

            if ($user) {
                $hashedPass = password_hash($password, PASSWORD_DEFAULT);
                if ($this->password->resetUserPassword($user['id'], $hashedPass)) {
                    $_SESSION['success-reset'] = "Пароль успешно обновлён";
                    header("Location: /login");
                } else {
                    return ['error' => "Ошибка при обновлении пароля в базе данных"];
                }
            } else {
                return ['error' => "Пользователь не найден"];
            }
        }
    }

    // Дополнительный метод для отправки письма
    private function sendEmail($email, $token)
    {
        $mail = new PHPMailer(true);

        // Настройки PHPMailer

        try {
            // Отправка письма
            $mail->send();
            $_SESSION['email_temp'] = $email;
            return true;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: " . $mail->ErrorInfo;
            return false;
        }
    }
}

<?php

namespace App\App\Models;

use App\Config\Database;
use PDOException;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// require_once __DIR__ . "/../../config/mailer.php";


class Auth
{
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    // ============================= РЕГИСТРАЦИЯ =============================
    public function register()
    {
        session_start();
        $errors = [];

        if (isset($_POST['register'])) {
            try {
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['pass'];
                $repass = $_POST['repass'];

                if (empty($username)) {
                    $errors['username'] = "Введите имя пользователя";
                }

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors['email'] = 'Неправильная почта';
                }

                if (empty($email)) {
                    $errors['email'] = "Введите почту";
                }

                if (empty($password)) {
                    $errors['pass'] = "Введите пароль";
                }

                if (empty($repass)) {
                    $errors['repass'] = "Повторите пароль";
                }

                if ($password !== $repass) {
                    $errors['pass-match'] = "Пароли не совпадают";
                }

                // Проверка на существующий емейл
                $emailCheck = "SELECT * FROM users WHERE email=?";
                $stmt = $this->db->getConnection()->prepare($emailCheck);
                $stmt->bindParam(1, $email);
                $stmt->execute();
                $result = $stmt->fetch();
                $stmt = null;

                if ($result) {
                    $errors['email'] = "Почта уже занята";
                }

                // Проверка на существующий юзернейм
                $nameCheck = "SELECT * FROM users WHERE username=?";
                $stmt = $this->db->getConnection()->prepare($nameCheck);
                $stmt->bindParam(1, $username);
                $stmt->execute();
                $result = $stmt->fetch();
                $stmt = null;

                if ($result) {
                    $errors['username'] = "Имя пользователя занято";
                }

                // Если валидация успешна
                if (count($errors) === 0) {
                    // token generator
                    // function getRandomStringUniqid($length = 12)
                    // {
                    //     $string = uniqid(rand());
                    //     $randomString = substr($string, 0, $length);
                    //     return $randomString;
                    // }

                    $hashedPass = password_hash($password, PASSWORD_DEFAULT);
                    $token = strval(rand(1000, 9999));

                    $sql = "INSERT INTO users(username, email, token, password) VALUES (?,?,?,?)";
                    $stmt = $this->db->getConnection()->prepare($sql);
                    $result_reg = $stmt->execute([$username, $email, $token, $hashedPass]);

                    if ($result_reg) {
                        $id_user = $this->db->getConnection()->lastInsertId();
                        $_SESSION['id_user'] = $id_user;
                        $_SESSION['username'] = $username;
                        $_SESSION['email'] = $email;
                        $_SESSION['role'] = 3;
                        $_SESSION['verified'] = 1;
                        $_SESSION['token'] = $token;

                        $mail = new PHPMailer(true);


                        $mail->CharSet = "utf-8"; // set charset to utf8
                        $mail->SMTPAuth = true; // Enable SMTP authentication
                        $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted

                        $mail->Host = 'mail.bigidea.edu.kg'; // Specify main and backup SMTP servers
                        $mail->Port = 465; // TCP port to connect to
                        $mail->SMTPOptions = array(
                            'ssl' => array(
                                'verify_peer' => false,
                                'verify_peer_name' => false,
                                'allow_self_signed' => true
                            )
                        );
                        $mail->isHTML(true); // Set email format to HTML
                        $mail->Username = 'bigidea.edu.kg@bigidea.edu.kg'; // SMTP username
                        $mail->Password = 'gasagyjaz228LOVE'; // SMTP password

                        $mail->setFrom('bigidea.edu.kg@bigidea.edu.kg');
                        $mail->addAddress($email);
                        $mail->isHTML(true);
                        $mail->Subject = 'Регистрация Big.Idea';
                        $mail->Body    = <<<END
                        
<h1>Ваш код подтверждения $token</h1>

END;


                        try {
                            var_dump($mail->send());
                        } catch (Exception $e) {
                            echo "Сообщение не было отправлено. Ошибка почты: " . $mail->ErrorInfo;
                        }
                    }
                }
            } catch (PDOException $e) {
                $errors['db_error'] = 'Ошибка базы данных: ' . $e->getMessage();
            }
        }
        return $errors;
    }

    // ============================= АВТОРИЗАЦИЯ =============================
    public function login()
    {
        $errors = [];
        try {
            if (isset($_POST['login'])) {
                $emailOrUsername = $_POST['loginOrEmail'];
                $pass = $_POST['pass'];

                if (empty($emailOrUsername)) {
                    $errors['emailOrUsername'] = "Введите логин или почту";
                }

                if (empty($pass)) {
                    $errors['pass'] = "Введите пароль";
                }

                $sql = "SELECT * FROM users WHERE id = :email OR username = :username";
                $stmt = $this->db->getConnection()->prepare($sql);

                $stmt->execute([
                    ":email" => $emailOrUsername,
                    ":username" => $emailOrUsername
                ]);
                $user = $stmt->fetch();

                if (empty($errors)) {
                    if ($user) {
                        if (password_verify($pass, $user['password'])) {
                            session_start();
                            $_SESSION['id_user'] = $user['id'];
                            $_SESSION['username'] = $user['username'];
                            $_SESSION['email'] = $user['email'];
                            $_SESSION['role'] = $user['role'];
                            $_SESSION['verified'] = $user['verified'];
                            $_SESSION['token'] = $user['token'];
                            header("location: /");
                        } else {
                            $errors['pass'] = "Неверный пароль";
                        }
                    } else {
                        $errors['username'] = "Пользователь не найден";
                    }
                }
            }
        } catch (PDOException $e) {
            $errors['db_error'] = "Ошибка базы данных:" . $e->getMessage();;
        }
        return $errors;
    }
}

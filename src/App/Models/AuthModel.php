<?php

namespace App\Models;

use App\Config\Database;
use PDOException;

class Auth
{
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function register()
    {
        session_start();
        if (isset($_POST['register-btn'])) {
            try {
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
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
                $stmt->bindParam('s', $email);
                $stmt->execute();
                $result = $stmt->fetch();

                if ($result) {
                    $errors['email'] = "Почта уже занята";
                }

                // Если валидация успешна
                if (count($errors) === 0) {
                    $hashedPass = password_hash($password, PASSWORD_DEFAULT);
                    $token = bin2hex(random_bytes(50));
                    $verified = 0;

                    $sql = "INSERT INTO users(username, email, verified, token, password) VALUES (?,?,?,?,?)";
                    $stmt = $this->db->getConnection()->prepare($sql);
                    $result_reg = $stmt->execute([$username, $email, $verified, $token, $hashedPass]);

                    if ($result_reg) {
                        $id_user = $this->db->getConnection()->lastInsertId();
                        $_SESSION['id'] = $id_user;
                        $_SESSION['username'] = $username;
                        $_SESSION['email'] = $email;
                        $_SESSION['verified'] = $verified;
                        $_SESSION['message'] = "Вы вошли!";
                        header('location: /login');
                    }
                }
            } catch (PDOException $e) {
                $errors['db_error'] = "Ошибка базы данных:" . $e->getMessage();;
            }
        }
    }

    public function authenticate($emailOrUsername, $password)
    {
        $sql = "SELECT * FROM users WHERE id = :email OR username = :username";
        $stmt = $this->db->getConnection()->prepare($sql);

        $stmt->execute([
            ":email" => $emailOrUsername,
            ":username" => $emailOrUsername
        ]);

        $user = $stmt->fetch();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['id_user'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                return true;
            } else {
                $_POST['error_login'] = "Неверный пароль";
                return false;
            }
        } else {
            $_POST['error_login'] = "Пользователь не найден";
            return false;
        }
    }
}

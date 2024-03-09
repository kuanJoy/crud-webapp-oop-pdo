<?php

namespace App\App\Controllers;

use App\Config\Database;
use App\App\Models\Post;

class PostController
{
    protected $postModel;

    public function __construct()
    {
        $db = new Database();
        $this->postModel = new Post($db);
    }

    public function getPosts()
    {
        return $this->postModel->getPosts();
    }

    public function getPostsForBanner()
    {
        return $this->postModel->getPostsForBanner();
    }

    public function getHashtagsForMain()
    {
        return $this->postModel->getHashtagsForMain();
    }

    public function getCategoriesForNavbar()
    {
        return $this->postModel->getCategoriesForNavbar();
    }

    public function createPost()
    {
        $errors = [];
        if (isset($_POST['createPost'])) {
            var_dump($_POST);
            if ($_SESSION['role'] !== 'админ') {
                $status = '2';
            } else {
                $status = '1';
            }

            $title = $_POST['title'];
            $description = $_POST['description'];
            $content = $_POST['content'];
            $category_id = intval($_POST['categoryId']);
            $user_id = $_SESSION['id_user'];
            $content = $_POST['content'];
            $hashtags = $_POST['hashtags'];

            if (empty($title)) {
                $errors["title"] = "Заголовок не может быть пустым";
            } elseif ((!preg_match('/^.{3,70}$/u', $title))) {
                $errors["title"] = "Длина заголовка от 3 до 70 символов";
            } else {
                $title = trim($title);
            }

            if (empty($description)) {
                $errors["description"] = "Описание не может быть пустым";
            } elseif ((!preg_match('/^.{3,100}$/u', $description))) {
                $errors["description"] = "Длина описания от 3 до 100 символов";
            } else {
                $description = trim($description);
            }

            if (empty($content)) {
                $errors["content"] = "Содержание не может быть пустым";
            } elseif ((!preg_match('/^.{3,65000}$/u', $content))) {
                $errors["content"] = "Длина содержания от 3 до 65000 символов";
            } else {
                $content = trim($content);
            }

            if ($_FILES['pic']['error'] === 4) {
                $img_upload_path = "./assets/images/upload/default_pic.jpg";
            } elseif (isset($_FILES['pic']['name'])) {
                $img_name = $_FILES['pic']['name'];
                $tmp_name = $_FILES['pic']['tmp_name'];
                $img_size = $_FILES['pic']['size']; // Получаем размер файла в байтах

                if ($_FILES['pic']['error'] === 0) {
                    if ($img_size > 2000000) {
                        $errors['pic_size'] = "Размер файла не должен превышать 2 МБ";
                    } else {
                        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                        $img_ex_to_lc = strtolower($img_ex);
                        $allowed_ex = ['jpg', 'jpeg', 'png'];

                        if (in_array($img_ex_to_lc, $allowed_ex)) {
                            $new_img_name = uniqid() . "." . "$img_ex_to_lc";
                            $img_upload_path = './assets/images/upload/' . $new_img_name;
                            move_uploaded_file($tmp_name, $img_upload_path);
                        } else {
                            $errors['pic_ex'] = "Поддерживаются только jpg, jpeg и png";
                        }
                    }
                } else {
                    $errors['pic_name'] = 'Неправильное имя фотографии';
                }
            }

            if (empty($errors)) {
                if ($this->postModel->createPost($title, $description, $content, $status, $category_id, $user_id, $img_upload_path, $hashtags)) {
                    header("Location: /");
                    exit();
                }
            } else {
                return $errors;
            }
        }
        return $errors;
    }
}

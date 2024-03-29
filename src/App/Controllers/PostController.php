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

    // ================= ЛАЙКИ / LIKES  =================
    public function sendLike()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sendLike'])) {
            $postId = basename($_SERVER['REQUEST_URI']);
            $userId = $_SESSION['id_user'];

            return $this->postModel->sendLike($postId, $userId);
            exit();
        }
    }

    public function deleteLike()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['deleteLike'])) {
            $postId = basename($_SERVER['REQUEST_URI']);
            $userId = $_SESSION['id_user'];

            return $this->postModel->deleteLike($postId, $userId);
            exit();
        }
    }



    // ================= ПОСТЫ / POSTS  =================
    public function createPost()
    {
        $errors = [];
        if (isset($_POST['createPost'])) {
            if ($_SESSION['role'] !== 'админ') {
                $status = 'скрыт';
            } else {
                $status = 'активен';
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
            } elseif ((!preg_match('/^.{3,1000}$/u', $description))) {
                $errors["description"] = "Длина описания от 3 до 1000 символов";
            } else {
                $description = trim($description);
            }

            if (empty($content)) {
                $errors["content"] = "Содержание не может быть пустым";
            } else {
                $content = trim($content);
            }

            if (empty($errors)) {
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
                if ($this->postModel->createPost($title, $description, $content, $status, $category_id, $user_id, $img_upload_path, $hashtags)) {
                    header("Location: /user/{$_SESSION['id_user']}");
                    exit();
                }
            } else {
                return $errors;
            }
        }
        return $errors;
    }

    public function deletePost()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['deletePost'])) {
            if ($_SESSION['role'] == 'админ' || $_SESSION['role'] == 'модератор' || $_SESSION['id_user'] == $_POST['postAuthor']) {
                return $this->postModel->deletePost($_POST['postId'], $_POST['pic']);
            }
        }
    }

    public function updatePost()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editPost'])) {
            $errors = [];

            $title = $_POST['title'];
            $description = $_POST['description'];
            $categoryId = $_POST['categoryId'];
            $content = $_POST['content'];
            $status = $_POST['status'];

            if (empty($title)) {
                $errors["title"] = "Заголовок не может быть пустым";
            } elseif (!preg_match('/^.{3,70}$/u', $title)) {
                $errors["title"] = "Длина заголовка от 3 до 70 символов";
            } else {
                $title = trim($title);
            }

            if (empty($description)) {
                $errors["description"] = "Описание не может быть пустым";
            } elseif (!preg_match('/^.{3,1000}$/u', $description)) {
                $errors["description"] = "Длина описания от 3 до 1000 символов";
            } else {
                $description = trim($description);
            }

            if (empty($content)) {
                $errors["content"] = "Содержание не может быть пустым";
            } else {
                $content = trim($content);
            }

            if (empty($errors)) {
                if ($_FILES['newPic']['error'] === 0) {
                    $newBannerPath = $this->handleBannerUpload($_FILES['newPic']);
                    $currentBannerPath = $_POST['pic'];

                    if ($newBannerPath !== false) {
                        $pic = $newBannerPath;
                        if (file_exists($currentBannerPath)) {
                            unlink($currentBannerPath);
                        }
                    }
                } else {
                    $pic = $_POST['pic'];
                }

                $createdTime = date('Y-m-d H:i:s');

                $postId = $_POST['postId'];
                $hashtags = $_POST['hashtags'];
                $result = $this->postModel->updatePost($postId, $title, $description, $categoryId, $content, $status, $pic, $hashtags, $createdTime);

                if ($result) {
                    header("Location: /post/$postId");
                } else {
                    echo "Не удалось обновить пост. Произошла ошибка при сохранении данных.";
                }
            } else {
                return $errors;
            }
        }
    }


    public function getPostForEdit()
    {
        $postId = basename($_SERVER['REQUEST_URI']);
        $post =  $this->postModel->getPostById($postId);
        if ($_SESSION['role'] == 'админ' || $_SESSION['role'] == 'модератор' || $_SESSION['id_user'] == $post['user_id']) {
            $hashtags = $this->postModel->getPostHashtags($postId);
            return [
                'post' => $post,
                'hashtags' => $hashtags
            ];
        } else {
            echo "<span class='err'>Доступ запрещен</span>";
            echo "<a href='/' class='auth__home'>
        <svg class='auth__icon'>
            <use href='/public/assets/images/svg/sprites.svg#back' />
        </svg>
        На главную
    </a>";
        }
    }

    public function getPostById()
    {
        $postId = basename($_SERVER['REQUEST_URI']);

        if (isset($_SESSION['id_user'])) {
            $userId = $_SESSION['id_user'];
            $likeOnPost = $this->postModel->getUserLikeOnPost($userId, $postId);
        } else {
            $likeOnPost = 'guest';
        }

        $post =  $this->postModel->getPostById($postId);
        $hashtags = $this->postModel->getPostHashtags($postId);
        $likes = $this->postModel->getPostLikesCount($postId);

        return [
            'post' => $post,
            'hashtags' => $hashtags,
            'likes' => $likes,
            'like_on_post' => $likeOnPost
        ];
    }

    public function getFavouritePosts()
    {
        $userId = intval(basename($_SERVER['REQUEST_URI']));
        return $this->postModel->getFavouritePosts($userId);
    }

    public function getUserPosts()
    {
        $userId = intval(basename($_SERVER['REQUEST_URI']));
        return $this->postModel->getUserPosts($userId);
    }

    public function getRandomPosts()
    {
        return $this->postModel->getRandomPosts();
    }

    public function getPostsByCategory()
    {
        $categoryId = basename($_SERVER['REQUEST_URI']);
        return $this->postModel->getPostsByCategory($categoryId);
    }

    public function getPostsByHashtag()
    {
        $hashtagName = urldecode(basename($_SERVER['REQUEST_URI']));
        return $this->postModel->getPostsByHashtag($hashtagName);
    }

    public function getCategoriesCount()
    {
        return $this->postModel->getCategoriesCount();
    }


    public function getPostsForBanner()
    {
        return $this->postModel->getPostsForBanner();
    }


    public function getCategoriesForNavbar()
    {
        return $this->postModel->getCategoriesForNavbar();
    }


    // =================== ХЕШТЕГИ / HASHTAGS ===================

    public function getHashtagsForMain()
    {
        return $this->postModel->getHashtagsForMain();
    }

    public function getHashtagsCount()
    {
        return $this->postModel->getHashtagsCount();
    }




    // =================== КАТЕГОРИИ / CATEGORIES ===================
    public function createCategory()
    {
        if (isset($_POST['createCat'])) {
            $errors = [];
            $category = $_POST['newCategory'];
            if (empty($category)) {
                $errors["category"] = "Категория не может быть пустой";
            } elseif (!preg_match('/^.{3,70}$/u', $category)) {
                $errors["category"] = "Длина категории от 3 до 70 символов";
            } else {
                $category = trim($category);
            }

            if ($_SESSION['role'] == 'админ' || $_SESSION['role'] == "модератор") {
                $status = 'активен';
            } else {
                $status = 'скрыт';
            }

            if (empty($errors)) {
                $result = $this->postModel->createCategory($category, $status);
                if ($result === "Категория успешно добавлена") {
                    header("Location: /create-post");
                    exit();
                }
            }

            return $errors;
        }
    }



    // ================== ФУНКЦИИ ДЛЯ АДМИНКИ ==================

    public function getAdminTables()
    {
        return [
            'posts' => $this->postModel->getPostsTable(),
            'users' => $this->postModel->getUsersTable(),
            'category' => $this->postModel->getCatTable(),
        ];
    }

    public function getCatForEdit()
    {
        if ($_SESSION['role'] == 'админ' || $_SESSION['role'] == 'модератор') {
            $id = basename($_SERVER['REQUEST_URI']);
            return $this->postModel->getCatForEdit($id);
        } else {
            return "Ошибка";
        }
    }

    public function getUserForEdit()
    {
        if ($_SESSION['role'] == 'админ' || $_SESSION['role'] == 'модератор') {
            $id = basename($_SERVER['REQUEST_URI']);
            return $this->postModel->getUserForEdit($id);
        } else {
            return "Ошибка базы данных";
        }
    }

    public function updateCat()
    {
        if ($_SESSION['role'] == 'админ' || $_SESSION['role'] == 'модератор') {
            if (isset($_POST['updateCat'])) {
                $errors = [];

                $id = $_POST['catId'];
                $name = $_POST['catName'];
                $status = $_POST['catStatus'];

                if (empty($name)) {
                    $errors["name"] = "Название не может быть пустым";
                } elseif (!preg_match('/^.{3,70}$/u', $name)) {
                    $errors["name"] = "Длина Названия от 3 до 70 символов";
                } else {
                    $name = trim($name);
                }

                if (empty($status)) {
                    $errors["status"] = "Выберите статус";
                }

                if (empty($errors)) {
                    header("Location: /admin");
                    return $this->postModel->updateCat($id, $name, $status);
                } else {
                    return $errors;
                    exit();
                }
            }
        }
    }

    public function updateUser()
    {
        if ($_SESSION['role'] == 'админ' || $_SESSION['role'] == 'модератор') {
            if (isset($_POST['updateUser'])) {
                $errors = [];

                $id = $_POST['id'];
                $role = $_POST['role'];

                if (empty($role)) {
                    $errors["role"] = "Выберите роль";
                }

                if (empty($errors)) {
                    header("Location: /admin");
                    return $this->postModel->updateUser($id, $role);
                } else {
                    return $errors;
                }
            }
        }
    }

    // GET TOP USERS FOR POPULAR
    public function getTopUsers()
    {
        return $this->postModel->getTopUsers();
    }

    protected function handleBannerUpload($file)
    {
        if (!empty($file)) {
            $img_name = $file['name'];
            $tmp_name = $file['tmp_name'];
            $img_size = $file['size'];

            if ($img_size > 2000000) {
                return false;
            }

            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_to_lc = strtolower($img_ex);
            $allowed_ex = ['jpg', 'jpeg', 'png'];

            if (!in_array($img_ex_to_lc, $allowed_ex)) {
                return false; // Недопустимое расширение файла
            }

            $new_img_name = uniqid() . "." . $img_ex_to_lc;
            $img_upload_path = './assets/images/upload/' . $new_img_name;

            if (move_uploaded_file($tmp_name, $img_upload_path)) {
                return $img_upload_path;
            } else {
                return "Ошибка при перемещении файла";
            }
        }
    }
}

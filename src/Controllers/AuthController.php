<?php

namespace App\Controllers;

use App\Controller;
use App\Models\UserModel;
use App\Models\UserSocialModel;
use App\Services\AuthRepository;
use DateTime;
use PDO;

class AuthController extends Controller
{
    private AuthRepository $authRepository;
    public function __construct()
    {
        $this->authRepository = new AuthRepository();
    }
    private function getBaseHost()
    {
        // Get the protocol (http or https)
        // Get the protocol (http or https)
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

        // Get the hostname (e.g., localhost or example.com)
        $host = $_SERVER['HTTP_HOST']; // This might already contain the port

        // Check if the port is already part of the host
        if (!strpos($host, ':')) {
            // If there's no port in the host, append it if it's non-standard
            $port = $_SERVER['SERVER_PORT'];
            if (($protocol == "http://" && $port != 80) || ($protocol == "https://" && $port != 443)) {
                $host .= ':' . $port;
            }
        }

        // Return the protocol and host (with port if necessary)
        return $protocol . $host;
    }
    private function redirectAuthenticated()
    {
        if (isset($_SESSION['user'])) return $this->redirect('/', '', 'default');
    }
    public function getLoginForm()
    {
        if (isset($_SESSION['user'])) return $this->redirectAuthenticated();
        return $this->render('login');
    }

    public function getRegisterForm()
    {
        if (isset($_SESSION['user'])) return $this->redirectAuthenticated();
        return $this->render('register');
    }
    public function postRegisterUser()
    {
        if (isset($_SESSION['user'])) return $this->redirectAuthenticated();
        try {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm-password'];

            error_log($password);
            error_log($confirm_password);
            $new_auth = UserModel::createFactory(0, $username, '', 0, '', null, 0, $email, $password, '', '', '', '');
            $is_success = $this->authRepository->createEntity($new_auth);

            if (!$is_success) {
                throw new \Exception("Can't not register user", 400);
            }
            header("Location: /login");
            exit();
        } catch (\Throwable $th) {
            echo $th->__toString();
        }
    }
    public function postLoginUser()
    {
        if (isset($_SESSION['user'])) return $this->redirectAuthenticated();
        session_regenerate_id(true);
        try {
            $email = $_POST['email'];
            $password = $_POST['password'];

            error_log($email);
            error_log($password);

            if (empty($email) || empty($password)) {
                return $this->redirect('/login', 'Please enter complete information.');
            }

            $user = $this->authRepository->getByEmail($email);

            $_SESSION['email'] = $email;

            if (empty($user)) {
                return $this->redirect('/login', 'User not found.');
            }

            $password_hash = $user['password'];

            $isSuccess = password_verify($password, $password_hash);

            if (!$isSuccess) {
                return $this->redirect('/login', 'Incorrect email or password.');
            }

            unset($user['password']);

            $_SESSION['user'] = $user;

            header("Location: /");
            exit();
        } catch (\Throwable $th) {
            echo $th->__toString();
        }
    }
    public function getLogoutUser()
    {
        try {
            session_destroy();
            header("Location: /login");
            exit();
        } catch (\Throwable $th) {
            echo $th->__toString();
        }
    }
    public function getAuthProfile($id)
    {
        try {
            $user = $this->authRepository->getById($id);
            $socials = $this->authRepository->getAll();
            if (empty($user)) {
                return $this->redirect('/', 'User not found.');
            }
            return $this->render('user_profile', ['user' => $user, 'socials' => $socials]);
        } catch (\Throwable $th) {
            echo $th->__toString();
        }
    }
    public function postUpdateAuthProfile()
    {
        try {
            $id = $_POST['id'];
            $fullname = $_POST['fullname'];
            $major = $_POST['major'];
            $phone = $_POST['phone'];
            $email = str_contains($_POST['email'], '@gmail.com') ? $_POST['email'] : $_POST['email'] . '@gmail.com';
            $facebook = $_POST['facebook'];
            $twitter = $_POST['twitter'];
            $instagram = $_POST['instagram'];
            $facebook_id = $_POST['facebookId'];
            $twitter_id = $_POST['twitterId'];
            $instagram_id = $_POST['instagramId'];

            $socials = array($facebook_id => $facebook, $twitter_id => $twitter, $instagram_id => $instagram);
            foreach ($socials as $key => $value) {
                $social = new UserSocialModel($id, $key, $value, time(), time());
                $this->authRepository->createAssociateSocial($social);
            }
            // Kiểm tra xem file có được tải lên không
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                // Lấy thông tin tệp
                $avatarTmpPath = $_FILES['avatar']['tmp_name'];
                $avatarName = $_FILES['avatar']['name'];

                // Đặt đường dẫn lưu trữ tệp
                $uploadDir = realpath('.././public/upload') . '/';
                $uniqueAvatarName = time() . '_' . basename($avatarName);
                $avatarFilePath = $uploadDir . $uniqueAvatarName;

                error_log("File: {$_FILES['avatar']}");
                error_log("File path: $avatarFilePath");

                // Di chuyển tệp đã tải lên đến thư mục đích
                if (move_uploaded_file($avatarTmpPath, $avatarFilePath)) {
                    $update_auth = UserModel::createFactory($id, '', $fullname, 0, '', '', false, $email, '', $avatarName, $this->getBaseHost() . '/upload/' . $uniqueAvatarName, $phone, $major);

                    $is_success = $this->authRepository->updateEntity($update_auth);
                    if ($is_success) {
                        return $this->redirect("/auth/profile/$id", "Updated profile successfully.");
                    } else {
                        return $this->redirect("/auth/profile/$id", "Updated profile failure.");
                    }
                } else {
                    return $this->redirect("/auth/profile/$id", "Failed upload avatar.");
                }
            } else {
                return $this->redirect("/auth/profile/$id", "No avatar uploaded or there was an error during the upload.");
            }
        } catch (\Throwable $th) {
            echo $th->__toString();
        }
    }
}

<?php

namespace App\Controllers;

use App\Controller;
use App\Models\UserModel;
use App\Services\UserRepository;

class UserController extends Controller
{
    private UserRepository $userRepository;
    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }
    public function index()
    {
        try {
            $result = $this->userRepository->getAll();
            return $this->render('user_list', ['users' => $result]);
        } catch (\Throwable $th) {
            echo $th->__toString();
        }
    }
    public function getCreateUserForm()
    {
        return $this->render('user_create');
    }
    public function postCreateUserForm(): void
    {
        try {
            $username = $_POST['username'];
            $fullname = $_POST['fullname'];
            $age = $_POST['age'];
            $address = $_POST['address'];
            $birthday = $_POST['birthday'];
            $gender = $_POST['gender'];

            $isMale = $gender === "male";

            $new_user = UserModel::createFactory(0, $username, $fullname, $age, $address, $birthday, $isMale, '', '');

            $is_success = $this->userRepository->createEntity($new_user);

            if (!$is_success) {
                throw new \Exception("Can't not create user", 400);
            }
            header("Location: /users");
            exit();
        } catch (\Throwable $th) {
            echo $th->__toString();
        }
    }
    public function deleteUser(): void
    {
        try {
            $id = $_GET['id'] ?? 0;
            if ($id != 0) {

                $is_success = $this->userRepository->deleteById($id);

                if (!$is_success) {
                    throw new \Exception("Can't not delete user", 400);
                }
            } else {
                throw new \Exception("Invalid user ID", 400);
            }
        } catch (\Throwable $th) {
            echo $th->__toString();
        }
    }
    public function getUpdateUserForm()
    {
        try {
            $user_id = $_GET['id'] ?? 0;
            if ($user_id == 0) throw new \Exception("User not found");
            $result = $this->userRepository->getById($user_id);
            return $this->render("user_edit", ["user" => $result]);
        } catch (\Throwable $th) {
            echo $th->__toString();
        }
    }
    public function postUpdateUserForm()
    {
        try {
            $id = $_POST['id'];
            $username = $_POST['username'];
            $fullname = $_POST['fullname'];
            $age = $_POST['age'];
            $address = $_POST['address'];
            $birthday = $_POST['birthday'];
            $gender = $_POST['gender'];

            $isMale = $gender === "male";

            error_log("update birthday: " . $birthday);
            error_log("update gender: " . $gender);

            $update_user = UserModel::createFactory($id, $username, $fullname, $age, $address, $birthday, $isMale, '', '');

            $is_success = $this->userRepository->updateEntity($update_user);

            if (!$is_success) {
                throw new \Exception("Can't not update user", 400);
            }
            header("Location: /users");
            exit();
        } catch (\Throwable $th) {
            echo $th->__toString();
        }
    }
}

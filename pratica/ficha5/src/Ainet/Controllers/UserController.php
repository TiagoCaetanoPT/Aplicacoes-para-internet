<?php

namespace Ainet\Controllers;

use Ainet\Models\User;

class UserController
{
    public function index()
    {
        $users = User::all();
        $title = 'List users';

        return render_view('users.list', compact('title', 'users'));
    }

    public function add()
    {
        $title = 'Add user';
        $user = new User();
        $errors = [];
        if (empty($_POST)) {
            return render_view('users.add', compact('title', 'user', 'errors'));
        }
        if (isset($_POST['cancel'])) {
            $this->home();
        }

        $user = $this->userFromInput();
        $errors = $this->validateCreate($user);
        if (count($errors) > 0) {
            return render_view('users.add', compact('title', 'user', 'errors'));
        }

        User::add($user);

        return $this->home();
    }

    public function edit()
    {
        $title = 'Edit user';
        $errors = [];
        $userId = input('user_id');
        if (is_null($userId) && isset($_GET['user_id'])) {
            $userId = $_GET['user_id'];
        }
        $user = User::find($userId);

        if (is_null($user) || isset($_POST['cancel'])) {
            return $this->home();
        }

        if (empty($_POST)) {
            return render_view('users.edit', compact('title', 'user', 'errors'));
        }

        $this->updateUserFromInput($user);
        $errors = $this->validateEdit($user);
        if (count($errors) > 0) {
            return render_view('users.edit', compact('title', 'user', 'errors'));
        }

        User::save($user);

        return $this->home();
    }

    public function delete()
    {
        $userId = input('user_id');
        if (is_null($userId)) {
            return $this->home();
        }

        User::delete($userId);

        return $this->home();
    }

    private function validateCreate(User $user)
    {
        $errors = $this->validateEdit($user);

        if (!trim($user->password)) {
            $errors['password'] = 'Password is required.';
        } elseif (strlen($user->password) < 8) {
            $errors['password'] = 'Password must have at least 8 characters.';
        }

        $passConfirmation = input('password_confirmation');

        if ($user->password && $user->password != $passConfirmation) {
            $errors['password_confirmation'] = 'Password confirmation must be equal to password.';
        }

        return $errors;
    }

    private function validateEdit(User $user)
    {
        $errors = [];

        if (!trim($user->fullname)) {
            $errors['fullname'] = 'Fullname is required.';
        } elseif (!preg_match('/^[a-zA-Z ]+$/', $user->fullname)) {
            $errors['fullname'] = 'Full name must only contain letters and spaces.';
        }

        if (is_null($user->type)) {
            $errors['user_type'] = 'Type is required.';
        } elseif ($user->type < 0 || $user->type > 2) {
            $errors['user_type'] = 'Invalid type.';
        }

        if (!trim($user->email)) {
            $errors['email'] = 'Email is required.';
        } elseif (!filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Invalid email address.';
        }

        return $errors;
    }

    private function userFromInput()
    {
        $user = new User();
        $user->email = input('email');
        $user->password = input('password');
        $user->fullname = input('fullname');
        $user->type = input('user_type');

        return $user;
    }

    private function updateUserFromInput(User $user)
    {
        $user->email = input('email');
        $user->fullname = input('fullname');
        $user->type = input('user_type');
    }

    private function home()
    {
        header('Location: user.php');
        exit(0);
    }
}

<?php
namespace Controllers;

use Models\User;
use Api\View;

class UserController
{
    public function getIndex()
    {
        $users = User::all();
        $pagetitle = "List of Users";
        return View::create('users.list', compact('users', 'pagetitle'));
    }

    public function getAdd()
    {
        $pagetitle = "Add user";
        $errors = [];
        $user = new User;
        return View::create('users.add', compact('pagetitle', 'user', 'errors'));
    }

    public function postAdd()
    {
        $pagetitle = "Add user";
        $errors = [];
        $user = new User;
        if (isset($_POST['cancel'])) {
            return $this->home();
        }
        $this->loadUserFromPost($user);
        $errors = $this->validateUser($user);
        if (count($errors) > 0) {
            return View::create('users.add', compact('pagetitle', 'user', 'errors'));
        }
        User::add($user);
        return $this->home();
    }

    public function getEdit()
    {
        $pagetitle = "Edit user";
        $errors = [];
        $id = $_GET['id'] ?? -1;

        $user = User::find($id);

        return View::create('users.edit', compact('pagetitle', 'user', 'errors'));
    }

    public function postEdit()
    {
        $pagetitle = "Edit user";
        $errors = [];
        $id = $_POST['id'] ?? -1;

        $user = User::find($id);

        if (!$user || isset($_POST['cancel'])) {
            return $this->home();
        }

        $this->loadUserFromPost($user);
        $errors = $this->validateUser($user);
        if (count($errors) > 0) {
            return View::create('users.edit', compact('pagetitle', 'user', 'errors'));
        }
        User::save($user);
        return $this->home();
    }

    public function postDelete()
    {
        $id =  $_POST['id'] ?? -1;
        if ($id == -1) {
            return $this->home();
        }

        User::delete($id);

        return $this->home();
    }

    // ------------------------------
    // Private
    // ------------------------------

    private function validateUser(User $user)
    {
        $errors = [];
        if (!trim($user->name)) {
            $errors['name'] = 'Name is required.';
        } elseif (!preg_match('/^[a-zA-Z ]+$/', $user->name)) {
            $errors['name'] = 'Name must only contain letters and spaces.';
        }

        if (!trim($user->age)) {
            $errors['age'] = 'Age is required.';
        } elseif (!filter_var($user->age, FILTER_VALIDATE_INT, array('options' => array('min_range' => 1, 'max_range' => 120)))) {
            $errors['age'] = 'Age must be a number between 1 and 120.';
        };
        return $errors;
    }

    private function loadUserFromPost(User $user)
    {
        $user->name = $_POST['name'] ?? "";
        $user->age = $_POST['age'] ?? "";
    }

    private function home()
    {
        header('Location: ' . action('user'));
        exit(0);
    }
}

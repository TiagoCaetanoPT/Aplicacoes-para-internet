<?php
namespace Controllers;

use Models\User;

class UserController
{
    public function getUsers()
    {
        $users = User::all();
        $pagetitle = "List of Users";

        // render_view is defined on support/html_helper.php
        render_view('users.list', compact('users', 'pagetitle'));
    }

    public function addUser()
    {
        $pagetitle = "Add user";
        $errors = [];
        $user = new User;

        // The first time (GET), just show the page
        if (empty($_POST)) {
            return render_view('users.add', compact('pagetitle', 'user', 'errors'));
        }
        if (isset($_POST['cancel'])) {
            return $this->home();
        }
        $this->loadUserFromPost($user);
        $errors = $this->validateUser($user);
        if (count($errors) > 0) {
            return render_view('users.add', compact('pagetitle', 'user', 'errors'));
        }
        User::add($user);
        return $this->home();
    }

    public function editUser()
    {
        $pagetitle = "Edit user";
        $errors = [];
        $id = $_GET['id'] ?? -1;
        $id = ($id == -1) ? $_POST['id'] ?? -1 : $id;

        $user = User::find($id);

        if (!$user || isset($_POST['cancel'])) {
            return $this->home();
        }

        // The first time (GET), just show the page
        if (empty($_POST)) {
            return render_view('users.edit', compact('pagetitle', 'user', 'errors'));
        }
        $this->loadUserFromPost($user);
        $errors = $this->validateUser($user);
        if (count($errors) > 0) {
            return render_view('users.edit', compact('pagetitle', 'user', 'errors'));
        }
        User::save($user);
        return $this->home();
    }

    public function deleteUser()
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
        header('Location: users.php');
        exit(0);
    }
}

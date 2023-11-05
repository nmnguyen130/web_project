<?php

namespace Controller;

defined('ROOTPATH') or exit('Access Denied!');

class Login
{
    use MainController;

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $user = new \Model\User();
            if ($user->validate($_POST)) {
                // $user->first($_POST);
                redirect('home');
            }

            $data['errors'] = $user->errors;
        }

        $this->view('login');
    }
}

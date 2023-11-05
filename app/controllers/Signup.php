<?php

namespace Controller;

defined('ROOTPATH') or exit('Access Denied!');

class Signup
{
    use MainController;

    public function index()
    {
        $data['title'] = 'Signup';

        $data['user'] = new \Model\User;
        $req = new \Core\Request;
        if ($req->posted()) {
            $data['user']->signup($_POST);
        }

        $this->view('signup', $data);
    }
}

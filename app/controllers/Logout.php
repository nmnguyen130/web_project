<?php

namespace Controller;

defined('ROOTPATH') or exit('Access Denied!');

class Logout
{
    use MainController;

    public function index()
    {
        $ses = new \Core\Session;
        $ses->logout();
        redirect('home');
    }
}

<?php

namespace Controller;

defined('ROOTPATH') or exit('Access Denied!');

class Profile
{
    use MainController;

    public function index()
    {
        $data['title'] = 'Profile';

        $this->view('profile', $data);
    }
}

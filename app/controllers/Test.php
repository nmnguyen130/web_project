<?php

namespace Controller;

defined('ROOTPATH') or exit('Access Denied!');

class Test
{
    use MainController;

    public function index()
    {
        // $user = new \Model\User;
        // $data['username'] = 'Admin';
        // $data['email'] = 'admin@gmail.com';
        // $data['role'] = 'admin';
        // $data['password'] = password_hash('password', PASSWORD_DEFAULT);
        // $data['date_created'] = date("Y-m-d H:i:s");

        // $user->insert($data);

        // $province = new \Model\Province;
        // $provinces = ["An Giang", "Cao Bằng"];
        // foreach ($provinces as $provinceName) {
        //     $province->insertCreature($provinceName, 'plant', "Không biết");
        // }

        $data['title'] = 'Test';

        $this->view('test', $data);
    }
}

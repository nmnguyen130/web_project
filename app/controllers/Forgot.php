<?php

namespace Controller;

defined('ROOTPATH') or exit('Access Denied!');

class Forgot
{
    use MainController;

    public function index()
    {
        $data['title'] = 'Forgot';
        $currentForm = isset($_GET['form']) ? $_GET['form'] : 'email';
        $data['currentForm'] = $currentForm;

        $data['user'] = new \Model\User;
        $req = new \Core\Request;
        $ses = new \Core\Session;

        if ($req->posted()) {
            if ($currentForm === 'email') {

                $user = $data['user']->checkEmail($_POST);
                if ($user) {
                    $ses->set('id', $user->id);
                    redirect('forgot?form=otp');
                }
            } elseif ($currentForm === 'otp') {

                $_POST['id'] = $ses->get('id');
                $data['user']->checkOtp($_POST);
            } elseif ($currentForm === 'password') {

                $_POST['id'] = $ses->pop('id');
                $data['user']->changePassword($_POST, false);
                redirect('login');
            }
        }

        $this->view('forgot', $data);
    }
}

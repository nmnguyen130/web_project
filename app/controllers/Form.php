<?php

namespace Controller;

defined('ROOTPATH') or exit('Access Denied!');

class Form
{
    use MainController;

    public function index()
    {
        $data['title'] = 'Form';

        $req = new \Core\Request;
        $ses = new \Core\Session;
        $form = new \Model\Form;

        if ($req->posted()) {
            $data = $req->post();
            $data['user_id'] = $ses->user('id');
            $data['submission_date'] = date("Y-m-d H:i:s");

            $form->insert($data);

            $ses->set('form_submission_success', true);

            redirect('form');
        }

        $this->view('form', $data);
    }
}

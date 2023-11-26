<?php

namespace Controller;

defined('ROOTPATH') or exit('Access Denied!');

class Profile
{
    use MainController;

    public function index()
    {
        $data['title'] = 'Profile';
        $data['active_tab'] = 'account-general';

        $data['user'] = new \Model\User;
        $req = new \Core\Request;
        $ses = new \Core\Session;

        if ($req->post()) {
            $_POST['id'] = $ses->user('id');
            if (isset($_POST['username'])) {

                $data['user']->changeUsername($_POST);
                $ses->set('profile_submission_success', true);
            } elseif (isset($_POST['current_pass'])) {

                $data['user']->changePassword($_POST);
                if (!$data['user']->getError('password')) {
                    $ses->set('profile_submission_success', true);
                }
                $data['active_tab'] = 'account-change-password';
            }
        }

        $form = new \Model\Form;
        $user_id = $ses->user('id');

        $data['total'] = $form->getTotalForms($user_id);
        $data['approved'] = $form->getTotalForms($user_id, "approved");
        $data['nameCreature'] = $form->getAllNameInForm($user_id);

        $this->view('profile', $data);
    }
}

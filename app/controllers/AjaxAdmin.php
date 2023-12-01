<?php

namespace Controller;

defined('ROOTPATH') or exit('Access Denied!');

class AjaxAdmin
{
    use MainController;

    public function index()
    {
        $req = new \Core\Request;
        $form = new \Model\Form;

        $info = null;

        if ($req->posted()) {
            $post_data = $req->post();

            if ($post_data['value'] === 'edit') {
            } else if ($post_data['value'] === 'approve') {
                $data['status'] = 'approved';
                $form->update($post_data['postId'], $data);
            } else if ($post_data['value'] === 'delete') {
            } else {
                $info['infor_form'] = $form->getFormById($post_data['postId'])[0];
            }
        }

        header('Content-Type: application/json');
        echo json_encode($info);
    }
}

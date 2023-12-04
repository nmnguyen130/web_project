<?php

namespace Controller;

defined('ROOTPATH') or exit('Access Denied!');

class AjaxProfile
{
    use MainController;

    public function index()
    {
        $req = new \Core\Request;
        $form = new \Model\Form;

        $info = null;

        if ($req->posted()) {
            $post_data = $req->post();

            $result = $form->getFormById($post_data['id'])[0];
            if ($result)
                $result->provinces = json_decode($result->provinces, true);
            $info['infor_creature'] = $result;
        }

        header('Content-Type: application/json');
        echo json_encode($info);
    }
}

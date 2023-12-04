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

            if (isset($post_data['value'])) {
                if ($post_data['value'] === 'edit') {
                } else if ($post_data['value'] === 'approve') {
                    $data['status'] = 'approved';
                    $form->update($post_data['postId'], $data);
                } else if ($post_data['value'] === 'reject') {
                    $data['status'] = 'rejected';
                    $form->update($post_data['postId'], $data);
                } else {
                    $info['infor_form'] = $form->getFormById($post_data['postId'])[0];
                }
            }

            if (isset($post_data['status'])) {
                $status = $post_data['status'] === 'all' ? null : $post_data['status'];
                $info['table_form'] = $form->getPosts(null, $status);
            }

            if (isset($post_data['type'])) {
                $type = $post_data['type'];
                if ($type === 'animal') {
                    $animal = new \Model\Animal;
                    $info['creatures'] = $animal->getAllAnimal();
                } elseif ($type === 'plant') {
                    $plant = new \Model\Plant;
                    $info['creatures'] = $plant->getAllPlant();
                }
            }
        }

        header('Content-Type: application/json');
        echo json_encode($info);
    }
}

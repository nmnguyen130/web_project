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
            $data['image'] = "";

            $files = $req->files();
            if (!empty($files['image']['name'])) {
                $folder = 'forms/';
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                    file_put_contents($folder . 'index.html', "");
                }

                $allowed = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];

                if (in_array($files['image']['type'], $allowed)) {
                    $data = $req->post();

                    $data['user_id'] = $ses->user('id');
                    $data['submission_date'] = date("Y-m-d H:i:s");

                    $data['image'] = $folder . time() . '_' . $files['image']['name'];
                    move_uploaded_file($files['image']['tmp_name'], $data['image']);

                    $image = new \Model\Image;
                    $image->resize($data['image'], 1000);

                    $form->insertWithProvince($data);

                    $ses->set('form_submission_success', true);
                    redirect('form');
                } else {
                    $form->errors['image'] = "The only allowed file types are JPEG, JPG, PNG, and WebP.";
                }
            }
        }
        $data['form'] = $form;

        $this->view('form', $data);
    }
}

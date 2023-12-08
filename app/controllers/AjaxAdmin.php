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

            // Check postId in Form
            if (isset($post_data['value'])) {
                $postId = $post_data['postId'] ?? null;

                switch ($post_data['value']) {
                    case 'approve':
                        $this->updateFormStatus($form, $postId, 'approved');
                        break;
                    case 'reject':
                        $this->updateFormStatus($form, $postId, 'rejected');
                        break;
                    case 'delete':
                        $scientificName = $post_data['scientificName'];
                        $type = $post_data['creatureType'];

                        $creatureModel = ($type === 'Animal') ? new \Model\Animal : new \Model\Plant;
                        $creatureModel->delete($scientificName, $creatureModel->primaryKey);

                        $info['creatures'] = $creatureModel->getAllCreatures();
                        $info['total'] = $creatureModel->getTotal();
                        break;
                    default:
                        $result = $form->getFormById($postId)[0] ?? null;
                        if ($result) {
                            $result->provinces = json_decode($result->provinces, true);
                            $info['infor_form'] = $result;
                        }
                        break;
                }
            }

            // Toggle status Form
            if (isset($post_data['status'])) {
                $status = $post_data['status'] === 'all' ? null : $post_data['status'];
                $info['table_form'] = $form->getPosts(null, $status);
            }

            if (isset($post_data['type'])) {
                $type = $post_data['type'];
                $creatureModel = ($type === 'animal') ? new \Model\Animal : new \Model\Plant;

                if (isset($post_data['scientificName'])) {
                    $scientificName = $post_data['scientificName'];
                    $provinces = array_column($creatureModel->getAllProvinceHas($scientificName), 'name');

                    $info['creature'] = $creatureModel->getCreatureByName($scientificName);
                    $info['creature']->provinces = $provinces;
                } else {
                    $info['creatures'] = $creatureModel->getAllCreatures();
                }
            }
        }

        header('Content-Type: application/json');
        echo json_encode($info);
    }

    private function updateFormStatus($form, $postId, $status)
    {
        $data['status'] = $status;
        $form->update($postId, $data);
    }
}

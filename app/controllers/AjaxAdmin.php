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
            } elseif (isset($post_data['status'])) { // Toggle status Form
                $status = $post_data['status'] === 'all' ? null : $post_data['status'];
                $info['table_form'] = $form->getPosts(null, $status);
            } elseif (isset($post_data['type'])) {
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
            } elseif (isset($post_data['name'])) { // Check Form submit
                $oldScientificName = $post_data['oldName'];
                $scientific_name = $post_data['scientific_name'];
                $provinces = explode(', ', $post_data['province']);;
                $type = $post_data['directory'];

                $data = [
                    'name' => $post_data['name'],
                    'scientific_name' => $scientific_name,
                    'characteristic' => $post_data['characteristic'],
                    'habitat' => $post_data['habitat'],
                    'update_date' => date('Y-m-d H:i:s')
                ];

                $file = $req->files();
                if (!empty($file['image']['name'])) {
                    $file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                    $new_filename = str_replace(' ', '_', $scientific_name) .  '.' . $file_extension;

                    $folder = "creature/" . $type . "/";

                    if (file_exists($folder . $new_filename)) {
                        unlink($folder . $new_filename);
                    }

                    move_uploaded_file($file['image']['tmp_name'], $folder . $new_filename);
                    $data['image'] = $folder . $new_filename;
                }
                // Update in DB
                if ($type === 'animal') {
                    $creatureModel = new \Model\Animal;
                    $data['behavior'] = $post_data['behavior'];
                } elseif ($type === 'plant') {
                    $creatureModel = new \Model\Plant;
                }

                $creatureModel->update($scientific_name, $data, $creatureModel->primaryKey);

                $province = new \Model\Province;
                foreach ($provinces as $provinceName) {
                    $province->changeScientificName($provinceName, $type, $oldScientificName, $scientific_name);
                }

                $info['creatures'] = $creatureModel->getAllCreatures();
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

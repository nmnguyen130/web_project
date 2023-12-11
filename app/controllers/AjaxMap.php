<?php

namespace Controller;

defined('ROOTPATH') or exit('Access Denied!');

class AjaxMap
{
    use MainController;

    public function index()
    {
        $req = new \Core\Request;
        $province = new \Model\Province;

        $info = null;

        if ($req->posted()) {
            $post_data = $req->post();

            if (isset($post_data['selectedItem'])) {
                $animal = new \Model\Animal;
                $plant = new \Model\Plant;
                $type = $post_data['selectedItem'];

                $info['result'] = ($type === "animal")
                    ? $animal->getAllCreatures($type)
                    : (
                        ($type === "plant")
                        ? $plant->getAllCreatures($type)
                        : array_merge($animal->getAllCreatures("animal"), $plant->getAllCreatures("plant"))
                    );
            } elseif (isset($post_data['searchText'])) {
                $scientificName = $post_data['searchText'];
                $type = $post_data['type'];

                $info['provinces'] = $province->getAllProvinceHas($scientificName, $type);

                $creatureModel = ($type === 'animal') ? new \Model\Animal : new \Model\Plant;
                $info['creature_detail'] = $creatureModel->getCreatureByName($scientificName, $type);
            } elseif (isset($post_data['creatureType'])) {
                $type = $post_data['creatureType'];
                $function = $post_data['functionType'];
                $creatureModel = ($type === 'animal') ? new \Model\Animal : new \Model\Plant;

                if ($function == "getCreatureOfProvince") {
                    $provinceName = $post_data['provinceName'];

                    $info['creature_info'] = $province->randomCreature($provinceName, $type)[0];
                    $scientificName = $info['creature_info']->scientific_name;

                    $info['creature_province'] = $creatureModel->getAllProvinceHas($scientificName, $type);
                    $info['creature_list'] = $province->getCreaturesExcept($provinceName, $scientificName, $type);
                } elseif ($function == "getDetailCreature") {
                    $info['creature_detail'] = $creatureModel->getCreatureByName($post_data['scientificName'], $type);
                }
            }
        }

        header('Content-Type: application/json');
        echo json_encode($info);
    }
}

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
        $animal = new \Model\Animal;
        $plant = new \Model\Plant;

        $info = null;

        if ($req->posted()) {
            $post_data = $req->post();

            if (isset($post_data['selectedItem'])) {
                $selectedItem = $post_data['selectedItem'];

                if ($selectedItem === "animal") {
                    $info['result'] = $animal->getAllCreatures();
                } else if ($selectedItem === "plant") {
                    $info['result'] = $plant->getAllCreatures();
                } else {
                    $info['result'] = array_merge(
                        $animal->getAllCreatures(),
                        $plant->getAllCreatures()
                    );
                }
            } elseif (isset($post_data['searchText'])) {
                $scientificName = $post_data['searchText'];
                $type = $post_data['type'];

                $info['provinces'] = $province->getAllProvinceHas($scientificName, $type);

                if ($type === "animal") {
                    $info['creature_detail'] = $animal->getCreatureByName($scientificName);
                } else if ($type === "plant") {
                    $info['creature_detail'] = $plant->getCreatureByName($scientificName);
                }
            } elseif (isset($post_data['creatureType'])) {
                $creatureType = $post_data['creatureType'];

                if ($creatureType == "animal") {
                    $info = $this->handleAnimalRequest($post_data, $province, $animal);
                } elseif ($creatureType == "plant") {
                    $info = $this->handlePlantRequest($post_data, $province, $plant);
                }
            }
        }

        header('Content-Type: application/json');
        echo json_encode($info);
    }

    private function handleAnimalRequest($postData, $province, $animal)
    {
        $info = [];
        $type = "animal";

        if ($postData['functionType'] == "getCreatureOfProvince") {
            $animalInfo = $province->randomCreature($postData['provinceName'], $type);
            $info['creature_info'] = $animalInfo[0];
            $info['creature_province'] = $animal->getAllProvinceHas($info['creature_info']->scientific_name);
            $info['creature_list'] = $province->getCreaturesExcept($postData['provinceName'], $info['creature_info']->scientific_name, $type);
        } elseif ($postData['functionType'] == "getDetailCreature") {
            $info['creature_detail'] = $animal->getAnimalByName($postData['scientificName']);
        }

        return $info;
    }

    private function handlePlantRequest($postData, $province, $plant)
    {
        $info = [];
        $type = "plant";

        if ($postData['functionType'] == "getCreatureOfProvince") {
            $plantInfo = $province->randomCreature($postData['provinceName'], $type);
            $info['creature_info'] = $plantInfo[0];
            $info['creature_province'] = $plant->getAllProvinceHas($info['creature_info']->scientific_name);
            $info['creature_list'] = $province->getCreaturesExcept($postData['provinceName'], $info['creature_info']->scientific_name, $type);
        } elseif ($postData['functionType'] == "getDetailCreature") {
            $info['creature_detail'] = $plant->getPlantByName($postData['scientificName']);
        }

        return $info;
    }
}

<?php

namespace Model;

defined('ROOTPATH') or exit('Access Denied!');

class Plant
{
    use Model;

    protected $table = 'plant';
    protected $primaryKey = 'scientific_name';

    protected $allowedColumns = [
        'scientific_name',
        'name',
        'image_url',
        'red_list',
        'characteristic',
        'habitat'
    ];

    public function getAllProvinceHasPlant($scientific_name)
    {
        $query = "SELECT DISTINCT name FROM province
        WHERE JSON_CONTAINS(plant_list, JSON_ARRAY(:scientific_name), '$')";

        $data  = array(':scientific_name' => $scientific_name);

        return $this->query($query, $data);
    }

    public function getPlantByName($scientific_name)
    {
        $query = "SELECT * FROM $this->table WHERE scientific_name = :scientific_name";

        $data = array(':scientific_name' => $scientific_name);

        return $this->query($query, $data);
    }
}

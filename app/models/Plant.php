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
        'image',
        'red_list',
        'characteristic',
        'habitat',
        'update_date'
    ];

    public function getAllPlant()
    {
        $query = "SELECT *, 'plant' as type FROM $this->table";

        return $this->query($query);
    }

    public function getAllProvinceHasPlant($scientific_name)
    {
        $query = "SELECT DISTINCT name FROM province
        WHERE JSON_CONTAINS(plant_list, JSON_ARRAY(:scientific_name), '$')";

        $data  = array(':scientific_name' => $scientific_name);

        return $this->query($query, $data);
    }

    public function getPlantByName($scientific_name)
    {
        $query = "SELECT *, 'plant' as type FROM $this->table WHERE scientific_name = :scientific_name";

        $data = array(':scientific_name' => $scientific_name);

        return $this->query($query, $data)[0];
    }

    public function getTotalPlant()
    {
        $query = "SELECT COUNT(*) as total FROM $this->table";

        $result = $this->query($query);

        return isset($result[0]->total) ? $result[0]->total : 0;
    }
}

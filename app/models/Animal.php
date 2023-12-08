<?php

namespace Model;

defined('ROOTPATH') or exit('Access Denied!');

class Animal
{
    use Model;

    protected $table = 'animal';
    public $primaryKey = 'scientific_name';

    protected $allowedColumns = [
        'scientific_name',
        'name',
        'image',
        'red_list',
        'characteristic',
        'behavior',
        'habitat',
        'update_date'
    ];

    public function getAllCreatures()
    {
        $query = "SELECT *, 'animal' as type FROM $this->table";

        return $this->query($query);
    }

    public function getAllProvinceHas($scientific_name)
    {
        $query = "SELECT DISTINCT name FROM province
        WHERE JSON_CONTAINS(animal_list, JSON_ARRAY(:scientific_name), '$')";

        $data  = array(':scientific_name' => $scientific_name);

        return $this->query($query, $data);
    }

    public function getCreatureByName($scientific_name)
    {
        $query = "SELECT *, 'animal' as type FROM $this->table WHERE scientific_name = :scientific_name";

        $data = array(':scientific_name' => $scientific_name);

        return $this->query($query, $data)[0];
    }

    public function getTotal()
    {
        $query = "SELECT COUNT(*) as total FROM $this->table";

        $result = $this->query($query);

        return isset($result[0]->total) ? $result[0]->total : 0;
    }
}

<?php

namespace Model;

defined('ROOTPATH') or exit('Access Denied!');

class Animal
{
    use Model;

    protected $table = 'animal';
    protected $primaryKey = 'scientific_name';

    protected $allowedColumns = [
        'scientific_name',
        'name',
        'image_url',
        'red_list',
        'characteristic',
        'behavior',
        'habitat'
    ];

    public function getAllProvinceHasAnimal($scientific_name)
    {
        $query = "SELECT DISTINCT name FROM province
        WHERE JSON_CONTAINS(animal_list, JSON_ARRAY(:scientific_name), '$')";

        $data  = array(':scientific_name' => $scientific_name);

        return $this->query($query, $data);
    }

    public function getAnimalByName($scientific_name)
    {
        $query = "SELECT * FROM $this->table WHERE scientific_name = :scientific_name";

        $data = array(':scientific_name' => $scientific_name);

        return $this->query($query, $data);
    }
}

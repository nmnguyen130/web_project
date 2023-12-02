<?php

namespace Model;

defined('ROOTPATH') or exit('Access Denied!');

class Province
{
    use Model;

    protected $table = 'province';
    protected $primaryKey = 'province_id';

    protected $allowedColumns = [
        'name',
        'region_id',
        'description',
        'animal_list',
        'plant_list'
    ];

    public function getAllAnimal($name)
    {
        $query = "
        SELECT a.*
        FROM $this->table AS p
        JOIN animal AS a ON JSON_CONTAINS(p.animal_list, JSON_ARRAY(a.scientific_name))
        WHERE p.name = :name;
    ";

        $data = array(':name' => $name);

        return $this->query($query, $data);
    }

    public function getAllPlant($name)
    {
        $query = "
        SELECT a.*
        FROM $this->table AS p
        JOIN plant AS a ON JSON_CONTAINS(p.plant_list, JSON_ARRAY(a.scientific_name))
        WHERE p.name = :name;
    ";

        $data = array(':name' => $name);

        return $this->query($query, $data);
    }

    public function getAnimalsExcept($name, $scientific_name)
    {
        $query = "
        SELECT a.name, a.scientific_name, a.image_url
        FROM $this->table AS p
        JOIN animal AS a ON JSON_CONTAINS(p.animal_list, JSON_QUOTE(a.scientific_name))
        WHERE p.name = :name
        AND a.scientific_name <> :scientific_name;
        ";

        $data = [
            ':name' => $name,
            ':scientific_name' => $scientific_name
        ];

        return $this->query($query, $data);
    }

    public function getPlantsExcept($name, $scientific_name)
    {
        $query = "
        SELECT a.name, a.scientific_name, a.image_url
        FROM $this->table AS p
        JOIN plant AS a ON JSON_CONTAINS(p.plant_list, JSON_QUOTE(a.scientific_name))
        WHERE p.name = :name
        AND a.scientific_name <> :scientific_name;
        ";

        $data = [
            ':name' => $name,
            ':scientific_name' => $scientific_name
        ];

        return $this->query($query, $data);
    }

    public function randomAnimal($name)
    {
        $query = $query = "
        SELECT a.*
        FROM $this->table AS p
        JOIN animal AS a ON JSON_CONTAINS(p.animal_list, JSON_ARRAY(a.scientific_name))
        WHERE p.name = :name
        ORDER BY RAND()
        LIMIT 1;
    ";

        $data = array(':name' => $name);

        return $this->query($query, $data);
    }

    public function randomPlant($name)
    {
        $query = $query = "
        SELECT a.*
        FROM $this->table AS p
        JOIN plant AS a ON JSON_CONTAINS(p.plant_list, JSON_ARRAY(a.scientific_name))
        WHERE p.name = :name
        ORDER BY RAND()
        LIMIT 1;
    ";

        $data = array(':name' => $name);

        return $this->query($query, $data);
    }

    public function getAllProvinceHas($scientificName)
    {
        $query = "
        SELECT p.name
        FROM $this->table AS p
        WHERE JSON_CONTAINS(p.animal_list, JSON_ARRAY(:scientific_name))
           OR JSON_CONTAINS(p.plant_list, JSON_ARRAY(:scientific_name));
    ";

        $data = [':scientific_name' => $scientificName];

        return $this->query($query, $data);
    }
}

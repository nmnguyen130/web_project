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

    public function randomProvince()
    {
        $query = "SELECT name FROM $this->table ORDER BY RAND() LIMIT 1";

        return $this->query($query)[0];
    }

    public function getProvinces()
    {
        $query = "SELECT name FROM $this->table";

        return $this->query($query);
    }

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
        SELECT a.name, a.scientific_name, a.image
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
        SELECT a.name, a.scientific_name, a.image
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

    public function randomAnimal($name, $limit = 1)
    {
        $query = $query = "
        SELECT a.*
        FROM $this->table AS p
        JOIN animal AS a ON JSON_CONTAINS(p.animal_list, JSON_ARRAY(a.scientific_name))
        WHERE p.name = :name
        ORDER BY RAND()
        LIMIT $limit;
    ";

        $data = array(':name' => $name);

        return $this->query($query, $data);
    }

    public function randomPlant($name, $limit = 1)
    {
        $query = $query = "
        SELECT a.*
        FROM $this->table AS p
        JOIN plant AS a ON JSON_CONTAINS(p.plant_list, JSON_ARRAY(a.scientific_name))
        WHERE p.name = :name
        ORDER BY RAND()
        LIMIT $limit;
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

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
        FROM province AS p
        JOIN animal AS a ON JSON_CONTAINS(p.animal_list, JSON_ARRAY(a.scientific_name))
        WHERE p.name = :name;
    ";

        $data = array(':name' => $name);

        return $this->query($query, $data);
    }

    public function getAnimalsExcept($name, $scientific_name)
    {
        $query = "
        SELECT a.name, a.scientific_name, a.image_url
        FROM province AS p
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

    public function randomAnimal($name)
    {
        $query = $query = "
        SELECT a.*
        FROM province AS p
        JOIN animal AS a ON JSON_CONTAINS(p.animal_list, JSON_ARRAY(a.scientific_name))
        WHERE p.name = :name
        ORDER BY RAND()
        LIMIT 1;
    ";

        $data = array(':name' => $name);

        return $this->query($query, $data);
    }
}

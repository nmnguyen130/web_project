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

    public function insertCreature($provinceName, $type, $scientific_name)
    {
        $existingList = $this->getScientificNameList($provinceName, $type);
        $existingList[count($existingList)] = $scientific_name;

        $query = "UPDATE $this->table SET {$type}_list = :newScientificName WHERE name = :provinceName;";

        $data = [
            ':newScientificName' => json_encode($existingList),
            ':provinceName' => $provinceName
        ];

        return $this->query($query, $data);
    }

    public function changeScientificName($provinceName, $type, $old_scientific_name, $scientific_name)
    {
        $existingList = $this->getScientificNameList($provinceName, $type);
        // Check if the scientific name already exists
        $key = array_search($old_scientific_name, $existingList);
        $existingList[$key !== false ? $key : count($existingList)] = $scientific_name;

        $query = "UPDATE $this->table SET {$type}_list = :newScientificName WHERE name = :provinceName;";

        $data = [
            ':newScientificName' => json_encode($existingList),
            ':provinceName' => $provinceName
        ];

        return $this->query($query, $data);
    }

    public function getAllCreature($name, $type)
    {

        $query = "
        SELECT a.* FROM $this->table AS p 
        JOIN $type AS a ON JSON_CONTAINS(p.{$type}_list, JSON_ARRAY(a.scientific_name)) 
        WHERE p.name = :name;";
        $data = [':name' => $name];

        return $this->query($query, $data);
    }

    public function getCreaturesExcept($name, $scientific_name, $type)
    {
        $query = "
        SELECT a.name, a.scientific_name, a.image
        FROM $this->table AS p
        JOIN {$type} AS a ON JSON_CONTAINS(p.{$type}_list, JSON_QUOTE(a.scientific_name))
        WHERE p.name = :name
        AND a.scientific_name <> :scientific_name;
        ";

        $data = [
            ':name' => $name,
            ':scientific_name' => $scientific_name
        ];

        return $this->query($query, $data);
    }

    public function randomCreature($name, $type, $limit = 1)
    {
        $query = $query = "
        SELECT a.*
        FROM $this->table AS p
        JOIN {$type} AS a ON JSON_CONTAINS(p.{$type}_list, JSON_ARRAY(a.scientific_name))
        WHERE p.name = :name
        ORDER BY RAND()
        LIMIT $limit;
    ";

        $data = array(':name' => $name);

        return $this->query($query, $data);
    }

    public function getAllProvinceHas($scientificName, $type)
    {
        $query = "
        SELECT p.name
        FROM $this->table AS p
        WHERE JSON_CONTAINS(p.{$type}_list, JSON_ARRAY(:scientific_name));
    ";

        $data = [':scientific_name' => $scientificName];

        return $this->query($query, $data);
    }

    private function getScientificNameList($provinceName, $type)
    {
        $query = "
        SELECT {$type}_list
        FROM $this->table
        WHERE name = :provinceName
    ";

        $data = [
            ':provinceName' => $provinceName,
        ];

        $result = $this->query($query, $data);

        if ($result && isset($result[0]->{$type . '_list'})) {
            return json_decode($result[0]->{$type . '_list'}, true);
        }

        return [];
    }
}

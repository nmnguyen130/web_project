<?php

class Province
{
    use Model;

    protected $table = 'province';

    protected $allowedColumns = [
        'name',
        'region_id',
        'description',
        'animal_list',
        'plant_list'
    ];

    protected $limit = 7;
    protected $offset = 0;
    protected $order_type = "asc";
    protected $order_column = "province_id";

    public function getAnimalOfProvince($name)
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
}

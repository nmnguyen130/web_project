<?php

class Animal
{
    use Model;

    protected $table = 'animal';

    protected $allowedColumns = [
        'name',
        'scientific_name',
        'image_url',
        'red_list',
        'characteristic',
        'behavior',
        'habitat'
    ];

    protected $limit = 7;
    protected $offset = 0;
    protected $order_type = "asc";
    protected $order_column = "animal_id";
}

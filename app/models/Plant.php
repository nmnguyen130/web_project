<?php

class Plant
{
    use Model;

    protected $table = 'plant';

    protected $allowedColumns = [
        'name',
        'scientific_name',
        'image_url',
        'red_list',
        'characteristic',
        'habitat'
    ];

    protected $limit = 7;
    protected $offset = 0;
    protected $order_type = "asc";
    protected $order_column = "plant_id";
}

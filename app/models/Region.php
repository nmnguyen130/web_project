<?php

class Region
{
    use Model;

    protected $table = 'region';

    protected $allowedColumns = [
        'name',
        'description'
    ];

    protected $limit = 7;
    protected $offset = 0;
    protected $order_type = "asc";
    protected $order_column = "region_id";
}

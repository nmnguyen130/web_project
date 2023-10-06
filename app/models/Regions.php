<?php

class Regions
{
    use Model;

    protected $table = 'regions';

    protected $allowedColumns = [
        'RegionName',
        'Description'
    ];
}

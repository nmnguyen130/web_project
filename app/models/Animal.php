<?php

namespace Model;

defined('ROOTPATH') or exit('Access Denied!');

class Animal extends Creature
{
    protected $table = 'animal';
    public $primaryKey = 'scientific_name';
    protected $allowedColumns = [
        'scientific_name',
        'name',
        'image',
        'red_list',
        'characteristic',
        'behavior',
        'habitat',
        'update_date'
    ];
}

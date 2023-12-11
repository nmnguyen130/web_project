<?php

namespace Model;

defined('ROOTPATH') or exit('Access Denied!');

class Plant extends Creature
{
    protected $table = 'plant';
    public $primaryKey = 'scientific_name';
}

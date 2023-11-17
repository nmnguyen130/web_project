<?php

namespace Model;

defined('ROOTPATH') or exit('Access Denied!');

class Form
{
    use Model;

    protected $table = 'form';
    protected $primaryKey = 'id';

    protected $allowedColumns = [
        'user_id',
        'type',
        'scientific_name',
        'name',
        'image_url',
        'characteristic',
        'behavior',
        'habitat',
        'submission_date',
        'status'
    ];
}

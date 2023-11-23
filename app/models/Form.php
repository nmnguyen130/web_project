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

    public function getTotalForms($user_id, $status = null)
    {
        $query = "SELECT count(*) as total from form where user_id = :user_id";

        $data = [':user_id' => $user_id];

        if ($status !== null) {
            $query .= " and status = :status";
            $data[':status'] = $status;
        }

        $result = $this->query($query, $data);

        return isset($result[0]->total) ? $result[0]->total : 0;
    }

    public function getAllNameInForm($user_id)
    {
        $query = "SELECT id, name, scientific_name from form where user_id = :user_id";

        $data = array(':user_id' => $user_id);

        return $this->query($query, $data);
    }

    public function getFormById($id)
    {
        $query = "SELECT * from form where id = :id";

        $data = array(':id' => $id);

        return $this->query($query, $data);
    }
}

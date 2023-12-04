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
        'provinces',
        'image_url',
        'characteristic',
        'behavior',
        'habitat',
        'submission_date',
        'status'
    ];

    public function insertWithProvince($data)
    {
        if (isset($data['provinces']) && is_array($data['provinces'])) {
            $data['provinces'] = json_encode($data['provinces'], JSON_UNESCAPED_UNICODE);
        }

        return $this->insert($data);
    }

    public function getTotalForms($user_id = null, $status = null)
    {
        $query = "SELECT count(*) as total from form";

        $data = [];

        if ($user_id !== null) {
            $query .= " where user_id = :user_id";
            $data[':user_id'] = $user_id;
        }

        if ($status !== null) {
            $query .= ($user_id !== null) ? " and status = :status" : " where status = :status";
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

    public function getPosts($limit = null, $status = null)
    {
        $query = "
        SELECT f.*, u.username
        FROM $this->table AS f
        JOIN user AS u ON f.user_id = u.id
    ";

        if ($status !== null) {
            $query .= " WHERE f.status = :status";
        }

        $query .= " ORDER BY submission_date DESC";

        if ($limit !== null) {
            $query .= " LIMIT $limit";
        }

        $data = [];

        if ($status !== null) {
            $data = array(':status' => $status);
        }

        return $this->query($query, $data);
    }
}

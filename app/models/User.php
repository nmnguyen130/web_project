<?php

namespace Model;

defined('ROOTPATH') or exit('Access Denied!');

class User
{
    use Model;

    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $loginUniqueColumn = 'email';

    protected $allowedColumns = [
        'username',
        'email',
        'role',
        'password'
    ];

    /*****************************
     * 	rules include:
		required
		alpha
		email
		numeric
		unique
		symbol
		longer_than_8_chars
		alpha_numeric_symbol
		alpha_numeric
		alpha_symbol
     * 
     ****************************/

    protected $onInsertValidationRules = [

        'email' => [
            'email',
            'unique',
            'required',
        ],
        'username' => [
            'alpha',
            'required',
        ],
        'role' => [
            'alpha',
            'required',
        ],
        'password' => [
            'not_less_than_8_chars',
            'required',
        ],
    ];

    protected $onUpdateValidationRules = [

        'email' => [
            'email',
            'unique',
            'required',
        ],
        'username' => [
            'alpha',
            'required',
        ],
        'role' => [
            'alpha',
            'required',
        ],
        'password' => [
            'not_less_than_8_chars',
            'required',
        ],
    ];

    public function signup($data)
    {
        if ($this->validate($data)) {
            //add extra user columns here
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            $data['role'] = 'user';
            $data['date_created'] = date("Y-m-d H:i:s");

            $this->insert($data);
            redirect('login');
        }
    }

    public function login($data)
    {
        $row = $this->first([$this->loginUniqueColumn => $data[$this->loginUniqueColumn]]);

        if ($row) {
            //confirm password
            if (password_verify($data['password'], $row->password)) {
                $ses = new \Core\Session;
                $ses->auth($row);

                switch ($row->role) {
                    case 'admin':
                        redirect('admin');
                        break;
                    case 'user';
                        redirect('home');
                        break;
                    default:
                        redirect('home');
                        break;
                }
            } else {
                $this->errors[$this->loginUniqueColumn] = "Wrong $this->loginUniqueColumn or password";
            }
        } else {
            $this->errors[$this->loginUniqueColumn] = "Wrong $this->loginUniqueColumn or password";
        }
    }
}
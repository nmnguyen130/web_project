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
        'password',
        'otp',
        'otp_generated_at',
        'otp_expires_at',
        'date_created'
    ];

    /*****************************
     * 	rules include:
		required
		alpha
		email
		numeric
		unique
		symbol
		longer_than_6_chars
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
            'not_less_than_6_chars',
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
            'not_less_than_6_chars',
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

            message("Your account was created! Please login to continue");
            redirect('login');
        }
    }

    public function login($data)
    {
        $row = $this->getUserByLoginColumn($data[$this->loginUniqueColumn]);

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

    public function changeUsername($data)
    {
        $row = $this->getUserByLoginColumn($data['id']);

        if ($row) {
            $new['username'] = $data['username'];
            $row->username = $data['username'];

            $this->update($row->id, $new);

            $ses = new \Core\Session;
            $ses->auth($row);
        }
    }

    public function changePassword($data, $check = true)
    {
        $row = $this->getUserByLoginColumn($data['id']);

        if ($row) {
            if ($check && !password_verify($data['current_pass'], $row->password)) {
                $this->errors['password'] = "Sai mật khẩu!";
            } else {
                $new['password'] = password_hash($data['new_pass'], PASSWORD_DEFAULT);
                $this->update($row->id, $new);

                if (!$check) {
                    message('Password updated successfully!');
                } else {
                    $ses = new \Core\Session;
                    $ses->auth($row);
                }
            }
        }
    }

    public function checkEmail($data)
    {
        $row = $this->getUserByLoginColumn($data['email']);

        if ($row) {
            $mail = new Mail();
            $mail->generateAndSendOTP($row);

            message("Your OTP has been sent to your email address.");
            return $row;
        } else {
            $this->errors['email'] = "Email không tồn tại!";
            return null;
        }
    }

    public function updateOtp($userId, $otp)
    {
        $expiresAt = date("Y-m-d H:i:s", strtotime("+5 minutes"));

        $data = [
            'otp' => $otp,
            'otp_generated_at' => date("Y-m-d H:i:s"),
            'otp_expires_at' => $expiresAt,
        ];

        $this->update($userId, $data);
    }

    public function checkOtp($data)
    {
        $row = $this->getUserByLoginColumn($data['id']);

        $enteredOtp = $data['otp'];

        if ($this->isValidOtp($row, $enteredOtp)) {
            $this->update($row->id, ['otp' => null, 'otp_generated_at' => null, 'otp_expires_at' => null]);

            message('Please enter your new password.');
            redirect('forgot?form=password');
        } else {
            $this->errors['otp'] = "Invalid OTP. Please try again.";
        }
    }

    private function getUserByLoginColumn($value)
    {
        $column = filter_var($value, FILTER_VALIDATE_EMAIL) ? 'email' : 'id';
        return $this->first([$column => $value]);
    }

    private function isValidOtp($user, $enteredOtp)
    {
        return $user->otp === $enteredOtp && strtotime($user->otp_expires_at) > time();
    }
}

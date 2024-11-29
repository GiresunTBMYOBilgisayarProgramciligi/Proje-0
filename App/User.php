<?php

namespace App;

use App\userController;

class User
{

    public $id = null;
    public $username = null;
    public $name = null;
    public $lastname = null;
    public $email = null;
    public $password = null;
    public $role = null;
    public $created_at = null;

    public function fillUser($data = [])
    {
        foreach ($this as $k => $v) {
            if (!is_null($data[$k])) $this->$k = $data[$k];
        }
    }

    public function getFullName()
    {
        return $this->name . " " . $this->lastname;
    }

    public function getGravatarURL($size = 50)
    {
        $default = "/admin/dist/img/avatar.png";
        return "https://www.gravatar.com/avatar/" . md5(strtolower(trim($this->email))) . "?d=" . urlencode($default) . "&s=" . $size;
    }
}
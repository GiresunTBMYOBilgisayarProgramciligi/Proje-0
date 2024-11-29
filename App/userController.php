<?php

namespace App;

use App\databaseController;
use Exception;
use Config;
class userController
{
    private $DB;

    public function __construct()
    {
        $this->DB = (new databaseController())->instance;
    }

    /**
     * @param $id
     * @return User|void
     */
    public function getUser($id)
    {
        if (!is_null($id)) {
            try {
                $u = $this->DB->query("select * from users where id={$id}");
                if ($u) {
                    $u = $u->fetch(\PDO::FETCH_ASSOC);
                    $user = new User();
                    $user->fillUser($u);

                    return $user;
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
    }

    /**
     *
     * @return User|false|null
     */
    public function getCurrentUser()
    {
        $u=false;
        if (isset($_SESSION[Config::$SESSION_KEY])) {
            $u=$this->getUser($_SESSION[Config::$SESSION_KEY]);
        }
        elseif (isset($_COOKIE[Config::$COOKIE_KEY])) {
            $u=$this->getUser($_COOKIE[Config::$COOKIE_KEY]);
        }
        return $u;
    }

    /**
     * todo düzenlenecek
     * @return mixed
     */
    public function getUsers()
    {
        return $this->DB->query("select * from user", PDO::FETCH_OBJ)->fetchAll();
    }

    /**
     * todo düzenlenecek
     * @param User $newUser
     * @return string[]|void
     */
    public function saveNewUser(User $newUser)
    {
        $q = $this->DB->prepare("INSERT INTO user(userName, mail, password, name, lastName, createdDate) values  (:userName,:mail,:password,:name,:lastName,:createdDate)");
        if ($q) {
            $newUser = (array)$newUser;
            unset($newUser["db"]);
            unset($newUser['id']);
            $newUser["password"] = password_hash($newUser["password"], PASSWORD_DEFAULT);
            $newUser["createdDate"] = date("Y.m.d H:i:s");
            $q->execute($newUser);
            if ($q) {
                return ['success' => 'Slide eklendi'];
            } else {
                return ['error' => "Slide eklenemedi"];
            }
        }
    }

    /**
     * todo düzenlenecek
     * @param User $user
     * @return string[]
     */
    public function updateUser(User $user)
    {
        if ($user->password == "") {
            unset($user->password);
        } else {
            $user->password = password_hash($user->password, PASSWORD_DEFAULT);
        }
        foreach ($user as $k => $v) {
            if (is_null($user->$k)) unset($user->$k);
        }
        $numItem = count((array)$user) - 1;// id sorguya kalıtmadığı için 1 çıkartıyorum
        $i = 0;

        $query = "UPDATE user SET ";
        foreach ($user as $k => $v) {
            if ($k !== 'id') {
                if (++$i === $numItem) $query .= $k . "='" . $v . "' "; else $query .= $k . "='" . $v . "', ";
            }
        }
        $query .= " WHERE id=" . $user->id;

        $u = $this->DB->query($query);
        if ($u) {
            return ['success' => 'Kullanıcı güncellendi'];
        } else {
            //return ['error' => "Slide güncellenemedi"];
            return ['error' => $query];

        }
    }

    /**
     * todo düzenlenecek
     * @param $id
     * @return string[]
     */
    public function deleteUser($id = null)
    {
        if (is_null($id)) return ['error' => "ID boş"];
        if ($id == 1) return ['error' => "Yönetici Silinemez"];
        $this->DB->query("DELETE FROM user WHERE id=:id")->execute(array(":id" => $id));
        return ['success' => "Kullanıcı silindi"];
    }

    /**
     * @return bool
     */
    public function isLoggedIn()
    {
        if (isset($_COOKIE[Config::$SESSION_KEY]) || isset($_SESSION[Config::$SESSION_KEY])) return true; else
            return false;
    }

    /**
     *
     * @param array $arr
     * @return void
     * @throws Exception
     */
    public function login(array $arr)
    {

        $arr = (object)$arr;
        $user = $this->DB->query("Select * from users where email='$arr->email'", \PDO::FETCH_OBJ);
        if ($user) {
            $user = $user->fetch();
            if ($user) {
                if (password_verify($arr->password, $user->password)) {
                    var_dump($arr);
                    if (!$arr->remember_me){
                        $_SESSION[Config::$SESSION_KEY] = $user->id;
                    }else{
                        setcookie(Config::$COOKIE_KEY, $user->id, time() + (86400 * 30));
                    }
                } else throw new \Exception("Şifre Yanlış");
            } else throw new \Exception("Kullanıcı kayıtlı değil");
        } else throw new \Exception("Hiçbir kullanıcı kayıtlı değil");

    }
}
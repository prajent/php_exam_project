<?php

namespace classes;

class User
{

    public $con;
    public $id;
    public $first_name;
    public $last_name;
    public $profile_picture;

    public function __construct()
    {
        require_once 'Connection.php';

        $connection = new Connection();
        $this->con  = $connection->pdo;

    }


    public function getAllUsers()
    {
        //fetch except sensitive data like password
        $query = 'SELECT id, first_name, last_name, profile_picture , email from `users` ';

        $stmt = $this->con->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();
    }


    public function logout()
    {
        session_destroy();
        header('Location:/login');
        exit();
    }

    public function deleteUser($password)
    {
        //fetch user password from database

        $currentHashedPassword = $this->getUserPassword($this->id);

        if (password_verify($password, $currentHashedPassword)) {
            //delete user
            $this->delete($this->id);

            return true;

        }

        return false;

    }

    public function delete($id)
    {
        $query = "DELETE FROM `users` where id=:id";
        $stmt  = $this->con->prepare($query);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);

        $stmt->execute();

        return true;
    }

    public function setLoggedInUser($user)
    {
        $this->id = $user['id'];

        $this->first_name = $user['first_name'];

        $this->last_name = $user['last_name'];

        $this->profile_picture = $user['profile_picture'];
    }

    public function tryToLogin($email, $password)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        $query = "SELECT * from `users` WHERE email = :email;";
        $stmt  = $this->con->prepare($query);
        $stmt->bindValue(':email', $email, \PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch();

        //USER NOT FOUND IN DB
        if (empty($user)) {
            return false;
        }

        $hashPassword = $user['password'];


        if (password_verify($password, $hashPassword)) {
            $_SESSION['userId'] = $user['id'];
            return true;
        }
        //PASSWORD DID NOT MATCH

        return false;
    }

    public function register($email, $password, $firstName, $lastName)
    {
        $password = password_hash($password, PASSWORD_BCRYPT); //use this for password request

        $query = "INSERT INTO `users` (email, password, first_name, last_name) VALUES (:email, :password, :first_name, :last_name)";

        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':email', $email, \PDO::PARAM_STR);
        $stmt->bindValue(':password', $password, \PDO::PARAM_STR);
        $stmt->bindValue(':first_name', $firstName, \PDO::PARAM_STR);
        $stmt->bindValue(':last_name', $lastName, \PDO::PARAM_STR);

        $stmt->execute();

    }

    public function update($email, $firstName, $lastName)
    {
        $query = "UPDATE `users` SET email=:email, first_name=:first_name, last_name=:last_name where id=:id";

        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':email', $email, \PDO::PARAM_STR);
        $stmt->bindValue(':first_name', $firstName, \PDO::PARAM_STR);
        $stmt->bindValue(':last_name', $lastName, \PDO::PARAM_STR);
        $stmt->bindValue(':id', $this->id, \PDO::PARAM_INT);

        $stmt->execute();

    }


    public function updatePassword($password)
    {
        $password = password_hash($password, PASSWORD_BCRYPT);

        $query = "UPDATE `users` SET password=:password where id=:id";

        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':password', $password, \PDO::PARAM_STR);
        $stmt->bindValue(':id', $this->id, \PDO::PARAM_INT);

        $stmt->execute();
    }


    public function uploadProfilePicture($file)
    {
        if (getimagesize($file["tmp_name"])) {
            //get image extension
            $imageImage = $file['name'];
            $array      = explode('.', $imageImage);
            $extension  = end($array);

            //generate unique name
            $name = uniqid('profile_', true);

            $file_name = $name.'.'.$extension;

            $target = 'images/'.$file_name;

            if (move_uploaded_file($file["tmp_name"], $target)) {
                $query = "UPDATE `users` SET profile_picture=:profile_picture where id=:id";

                $stmt = $this->con->prepare($query);
                $stmt->bindValue(':profile_picture', $target, \PDO::PARAM_STR);
                $stmt->bindValue(':id', $this->id, \PDO::PARAM_INT);

                $stmt->execute();
            }
        }
        return false;
    }

    public function getUserById($id)
    {
        //fetch except sensitive data like password
        $query = 'SELECT id, first_name, last_name, profile_picture , email from `users` where id= :id;';

        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch();

    }


    public function getUserPassword($id)
    {
        //fetch except sensitive data like password
        $query = 'SELECT password from `users` where id= :id;';

        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();

        $user = $stmt->fetch();

        return $user['password'];

    }


    private function uploadImage($tmp_name)
    {
        $check = getimagesize($tmp_name);
        if ($check) {
            $array      = explode('.', $_FILES['profile_picture']['name']);
            $extension  = end($array);
            $randomName = uniqid('profile_', false);
            $targetFile = "images/$randomName.$extension";

            if (move_uploaded_file($tmp_name, $targetFile)) {
                return $targetFile;
            }
        }
        return false;
    }
}
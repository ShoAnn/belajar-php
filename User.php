<?php

class User
{
    public $name;
    public $email;
    public $phone;
    public $group;
    public $username;
    protected $password;

    public function __construct($name, $phone, $email, $username, $password, $group)
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->group = $group;
    }

    public function register()
    {
        require_once "dbconfig.php";
        $stmt = $mysqli->prepare("INSERT INTO users (name, email, phone_number, username, password, group_id) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssi", $this->name, $this->email, $this->phone, $this->username, $this->$password, $this->group);
        if ($stmt->execute()) {
            $stmt->close();
            $mysqli->close();
            return true;
        } else {
            $stmt->close();
            $mysqli->close();
            return false;
        }
    }
};

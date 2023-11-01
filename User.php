<?php

class User
{
    public $name;
    public $phone;
    public $email;
    public $group;
    public $username;
    protected $password;

    // public function __construct($name, $phone, $email, $group)
    // {
    //     $this->name = $name;
    //     $this->phone = $phone;
    //     $this->email = $email;
    //     $this->group = $group;
    // }


    public function register($name, $phone, $email, $group, $username, $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->group = $group;
        $this->username = $username;
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        require_once "dbconfig.php";
        $stmt = $mysqli->prepare("INSERT INTO users (name, email, phone_number, username, password, group_id) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssi", $this->name, $this->email, $this->phone, $this->username, $this->password, $this->group);
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

    public function login($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
        require_once "dbconfig.php"; // Include your database configuration
        // Check if the user with the given username exists
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("s", $this->username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $userRow = $result->fetch_assoc();
            // Verify the provided password against the hashed password in the database
            if (password_verify($this->password, $userRow['password'])) {
                // Password matches, set up the user's session and log them in
                session_start();
                $_SESSION['user_id'] = $userRow['user_id'];
                $_SESSION['username'] = $userRow['username'];
                $stmt->close();
                return true;
            }
        }

        $stmt->close();
        return false;
    }
};

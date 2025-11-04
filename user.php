<?php
class User {
    private $conn;
    private $table_name = "users";

    public $id;
    public $fullname;
    public $email;
    public $phone;
    public $password;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create user
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                SET fullname=:fullname, email=:email, phone=:phone, password=:password";
        
        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->fullname = htmlspecialchars(strip_tags($this->fullname));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->phone = htmlspecialchars(strip_tags($this->phone));

        // Bind values
        $stmt->bindParam(":fullname", $this->fullname);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":phone", $this->phone);
        $stmt->bindParam(":password", $this->password);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Check if email exists
    public function emailExists() {
        $query = "SELECT id, fullname, password FROM " . $this->table_name . " 
                WHERE email = ? LIMIT 0,1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->email);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id = $row['id'];
            $this->fullname = $row['fullname'];
            $this->password = $row['password'];
            return true;
        }
        return false;
    }

    // Check if phone exists
    public function phoneExists() {
        $query = "SELECT id FROM " . $this->table_name . " 
                WHERE phone = ? LIMIT 0,1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->phone);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    // Login user
    public function login($username, $password) {
        // Check if username is email or phone
        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $query = "SELECT id, fullname, password FROM " . $this->table_name . " 
                    WHERE email = ? LIMIT 0,1";
        } else {
            $query = "SELECT id, fullname, password FROM " . $this->table_name . " 
                    WHERE phone = ? LIMIT 0,1";
        }
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $username);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            // Verify password
            if (password_verify($password, $row['password'])) {
                $this->id = $row['id'];
                $this->fullname = $row['fullname'];
                return true;
            }
        }
        return false;
    }
}
?>
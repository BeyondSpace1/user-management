<?php
class User {
    private $id;
    private $name;
    private $email;
    private $password; // hashed password
    private $created_at;

    public function __construct($id, $name, $email, $password, $created_at = null) {
        $this->id = $id;
        $this->setName($name);
        $this->setEmail($email);
        $this->setPassword($password, true); // true means hash if not hashed
        $this->created_at = $created_at ?? date("d-m-Y");
    }

    // Getters
    public function getId() { return $this->id; }
    public function getName() { return $this->name; }
    public function getEmail() { return $this->email; }
    public function getPassword() { return $this->password; }
    public function getCreatedAt() { return $this->created_at; }

    // Setters
    public function setName($name) {
        $this->name = htmlspecialchars(trim($name));
    }

    public function setEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format");
        }
        $this->email = strtolower($email);
    }

    public function setPassword($password, $hash = false) {
        if (strlen($password) < 6 && !$hash) {
            throw new Exception("Password must be at least 6 characters");
        }
        $this->password = $hash ? password_hash($password, PASSWORD_DEFAULT) : $password;
    }

    // Convert to array for JSON storage
    public function toArray() {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "password" => $this->password,
            "created_at" => $this->created_at
        ];
    }
}
?>

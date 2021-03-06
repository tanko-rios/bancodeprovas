<?php

namespace App\Models;

use PDO;

class User {
    private $pdo;
    protected $table = "users";
    private $id;
    private $name;
    private $email;
    private $password;
    private $image;
    private $score;
    private $birthdate;
    private $level;
    private $courses_id;
    private $token;
    private $active;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function all () { //Mostra todos os usuários
        $query = "SELECT * FROM {$this->table}";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor();
        return $result;
    }

    public function findById($id) { // Procura usuário pelo id
        $query = "SELECT * FROM {$this->table} WHERE id=:id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch();
        $stmt->closeCursor();
        return $result;
    }

    public function findByName($name) { // Procura usuário pelo nome
        $query = "SELECT * FROM {$this->table} WHERE name=:name";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":name", $name);
        $stmt->execute();
        $result = $stmt->fetch();
        $stmt->closeCursor();
        return $result;
    }

    public function findByCourse($courses_id) { // Procura usuário pelo id do curso
        $query = "SELECT * FROM {$this->table} WHERE courses_id=:courses_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":name", $name);
        $stmt->execute();
        $result = $stmt->fetch();
        $stmt->closeCursor();
        return $result;
    }

    public function create($name, $email, $password, $image = null, $birthdate, $courses_id, $token) { //criando usuário
        $query = "INSERT INTO {$this->table} (name, email, password, image, birthdate, level, courses_id, token) VALUES (:name, :email, :password, :image, :birthdate, 1, :courses_id, :token)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":name", $name);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":password", $password);
        $stmt->bindValue(":image", $image);
        $stmt->bindValue(":birthdate", $birthdate);
        $stmt->bindValue(":courses_id", $courses_id);
        $stmt->bindValue(":token", $token);
        $result = $stmt->execute();
        $stmt->closeCursor();
        return $result;
    }

    public function update($id, $name, $email, $password, $image, $birthdate, $courses_id) { //atualizando o usuário
        $query = "UPDATE {$this->table} SET name=:name, email=:email, password=:password, image=:image, birthdate=:birthdate, courses_id=:courses_id WHERE id=:id";
        $stmt =$this->pdo->prepare($query);
        $stmt->bindValue(":id", $id);
        $stmt->bindValue(":name", $name);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":password", $password);
        $stmt->bindValue(":image", $image);
        $stmt->bindValue(":birthdate", $birthdate);
        $stmt->bindValue(":courses_id", $courses_id);
        $result=$stmt->execute();
        $stmt->CloseCursor();
        return $result;
    }
    public function updatePointsExam($idpoint){
    $query = "UPDATE {$this->table} SET score = score + 5 WHERE id=:idpoint";
    $stmt = $this->pdo->prepare($query);
    $stmt->bindValue(":idpoint", $idpoint);
    $result = $stmt->execute();
    $stmt->closeCursor();
    return $result;
    }

    public function delete($id) { //excluindo usuário
        $query = "DELETE FROM {$this->table} WHERE id =:id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":id",$id);
        $result = $stmt->execute();
        $stmt->closeCursor();
        return $result;
    }

    public function where($email) {
        $query = "SELECT * FROM {$this->table} WHERE email=:email";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":email", $email);
        $stmt->execute();
        $result = $stmt->fetch();
        $stmt->closeCursor();
        return $result;
    }

    public function activityUpdate($token, $active){
        $query = "UPDATE {$this->table} SET active=:active WHERE token=:token ";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":active", $active);
        $stmt->bindValue(":token", $token);
        $result = $stmt->execute();
        $stmt->closeCursor();
        return $result;
    }
}

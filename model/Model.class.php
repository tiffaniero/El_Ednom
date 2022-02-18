<?php

abstract class Model{

    protected $db;
    protected $table;

    public function __construct(){
        $this->db = Database::getInstance();
    }

    public function getAll(): array
    {
        $query = $this->db->prepare("SELECT * FROM $this->table");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOneById($id) : array
    {
        $query = $this->db->prepare("SELECT * FROM $this->table WHERE $this->id = ?");

        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function delete($id){
        $query = $this->db->prepare("DELETE FROM $this->table WHERE $this->id = ?");
        $query->execute([$id]);
    }

    abstract function insert(array $data);

    abstract function update(array $data);
}
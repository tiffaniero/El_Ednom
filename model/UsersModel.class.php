<?php

namespace model;

class UsersModel extends Model{
    
    protected $table = TABLE_USERS;
    protected $id = 'id_' . TABLE_USERS;

    public function getUserByPseudo($pseudo){
        $query = $this->db->prepare("SELECT * FROM users WHERE pseudo = ?");
        $query->execute([$pseudo]);
        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    public function insert(array $data){

    }

    public function update(array $data){

    }

}
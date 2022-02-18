<?php

class NewsModel extends Model{

    protected $table = TABLE_NEWS;
    protected $id = 'id_' . TABLE_NEWS;
    
    public function getAllNewsFromUser($id){
        $query = $this->db->prepare("SELECT * FROM $this->table 
                                    INNER JOIN users ON $this->table.id_users = users.id_users
                                    WHERE $this->table.id_users = ?");
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert(array $data){
        $query = $this->db->prepare("INSERT INTO $this->table SET title = ?, content = ?, id_users = ?");
        $query->execute($data);
        return $this->db->lastInsertId();
    }

    public function update(array $data){
        $query = $this->db->prepare("UPDATE $this->table SET title = ?, content = ? WHERE $this->id = ?");
        $query->execute($data);
        return $this->db->lastInsertId();
    }
}
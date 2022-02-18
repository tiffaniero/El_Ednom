<?php

class Users{

    public function __contruct(){

    }

    public function showLogInForm(){
        $headerTemplate = "view/frontOffice/header.phtml";
        $mainTemplate = "view/frontOffice/logInForm.phtml";
        require "view/layout.phtml";
    }

    public function showDashboard(){
        session_start();
        var_dump($_POST);
        if(isset($_SESSION)){
            $user = $this->getCurrentUser($_SESSION['id_user']);
            $headerTemplate = "view/backOffice/header.phtml";
        } else {
            header('Location: index.php');
        }
    }

    public function connexionControl(){
        
        if(isset($_POST['pseudo']) && isset($_POST['password'])){

            $usersModel = new UsersModel();

             //Est-ce que le user existe
            $user = $usersModel->getUserByPseudo($_POST['pseudo']);

            //Est-ce le mot de passe correspond
            if(password_verify($_POST['password'], $user['password'])){    
                $this->sessionInit($user['id_users']);
                header('Location: index.php?route=5');
            } else {
                header("Location: index.php?route=3&info=errorLogin");
            }
        }
        
    }

    public function createNewUser(){

    }

    private function sessionInit($id){
        session_start();
        $_SESSION['id_user'] = $id;
        $_SESSION['time'] = date('Y m d H:i:s');
    }

    public function getCurrentUser($id){

        $usersModel = new UsersModel();
        return $usersModel->getOneById($id);

    }

}
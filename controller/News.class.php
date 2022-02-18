<?php

namespace controller;

class News{

    public function __contruct(){

    }

    public function showHome(){
        
        $newsModel = new \model\NewsModel();
        $newsList = $newsModel->getAll();

        $headerTemplate = "view/frontOffice/header.phtml";
        $mainTemplate = "view/frontOffice/newsList.phtml";
        require "view/layout.phtml";
    }
    
    public function showOneNews($id){
        $newsModel = new \model\NewsModel();
        $newsDetails = $newsModel->getOneById($id);

        $headerTemplate = "view/frontOffice/header.phtml";
        $mainTemplate = "view/frontOffice/newsDetails.phtml";
        require "view/layout.phtml";
    }

    //Dashboard
    public function showAllNewsFromCurrentUser(){
        session_start();
        $newsList = $this->getAllNewsFromCurrentUser();
        $user = $this->getCurrentUser();

        $headerTemplate = "view/backOffice/header.phtml";
        $mainTemplate = "view/backOffice/dashboard.phtml";
        require "view/layout.phtml";
    }

    //!\\ A déplacer !!
    public function getCurrentUser(){

        $usersModel = new \model\UsersModel();
        return $usersModel->getOneById($_SESSION['id_user']);

    }

    public function getAllNewsFromCurrentUser(){
        
        $newsModel = new \model\NewsModel();
        return $newsModel->getAllNewsFromUser($_SESSION['id_user']);
    }

    public function showOneNewsFromCurrentUser($id){
        session_start();
        $newsModel = new \model\NewsModel();
        $newsDetails = $newsModel->getOneById($id);

        $user = $this->getCurrentUser();

        $headerTemplate = "view/backOffice/header.phtml";
        $mainTemplate = "view/frontOffice/newsDetails.phtml";
        require "view/layout.phtml";
    }


    public function showAddNews(){
        session_start();

        $user = $this->getCurrentUser();

        $headerTemplate = "view/backOffice/header.phtml";
        $mainTemplate = "view/backOffice/addNews.phtml";
        require "view/layout.phtml";
    }

    public function addNews(){
        session_start();
        $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
        if(!$post['title']){
            throw new Exception("Le titre doit être obligatoirement rempli");
        }
        $data = array_values($post);
        array_push($data, $_SESSION['id_user']);

        $newsModel = new \model\NewsModel();
        $newsModel->insert($data);

        header('Location: index.php?route=5');
        exit();
    }

    public function showUpdateNews($id){
        session_start();

        $user = $this->getCurrentUser();

        $newsModel = new \model\NewsModel();
        $newsToUpdate = $newsModel->getOneById($id);

        if($_SESSION['id_user'] == $newsToUpdate['id_users']){
            $headerTemplate = "view/backOffice/header.phtml";
            $mainTemplate = "view/backOffice/updateNews.phtml";
            require "view/layout.phtml";
        } else {
            http_response_code(404);
            include('view/error404.phtml');
            die();
        }
    }

    public function updateNews(){

        $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
        if(!$post['title'] || empty($_POST['title'])){
            throw new Exception("Le titre doit être obligatoirement rempli");
        }
        $data = [
            $_POST['title'],
            $_POST['content'],
            $_POST['id_news']
        ];

        $newsModel = new \model\NewsModel();
        $newsModel->update($data);

        header('Location: index.php?route=5');
        exit();
    }

    public function delete(){
        session_start();

        $newsModel = new \model\NewsModel();
        $newsToDelete = $newsModel->getOneById(intval($_GET['id']));

        if($_SESSION['id_user'] == $newsToDelete['id_users']){
            $newsModel->delete(intval($_GET['id']));
            header('Location: index.php?route=5');
        } else {
            http_response_code(404);
            include('view/error404.phtml');
            die();
        }
    }
}

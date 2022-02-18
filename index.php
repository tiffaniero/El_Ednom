<?php

declare(strict_types=1);

require "config.php";
require "Database.php";
require "model/Model.class.php";
require "model/NewsModel.class.php";
require "model/UsersModel.class.php";
require "controller/News.class.php";
require "controller/Users.class.php";


//App routing
$route = 1;


if(isset($_GET['route']) && !ctype_digit($_GET['route'])){
    http_response_code(404);
    include('view/error404.phtml');
    die();
} 

if (isset($_GET['route'])) {
    $route = intval($_GET['route']);
}

switch($route){

    case 2 :
        if(isset($_GET['id']) && !ctype_digit($_GET['id'])){
            http_response_code(404);
            include('view/error404.phtml');
            die();
        } else {
            $news = new News();
            $news->showOneNews(intval($_GET['id']));
        }
        break;
    
    case 3 :
        $user = new Users();
        $user->showLogInForm();
        break;

    case 4 : 
        $user = new Users();
        $user->connexionControl();
        break;

    case 5 : 
        $news = new News();
        $news->showAllNewsFromCurrentUser();
        break;

    case 6 :
        if(isset($_GET['id']) && !ctype_digit($_GET['id'])){
            http_response_code(404);
            include('view/error404.phtml');
            die();
        } else {
            $news = new News();
            $news->showOneNewsFromCurrentUser(intval($_GET['id']));
        }
        break;
    
    case 7 :
        if(isset($_GET['id']) && !ctype_digit($_GET['id'])){
            http_response_code(404);
            include('view/error404.phtml');
            die();
        } else {
            $news = new News();
            $news->showAddNews();
        }
        break;

    case 8 :
        $news = new News();
        $news->addNews();
        break;

    case 9 :
        if(isset($_GET['id']) && !ctype_digit($_GET['id'])){
            http_response_code(404);
            include('view/error404.phtml');
            die();
        } else {
            $news = new News();
            $news->showUpdateNews(intval($_GET['id']));
            break;
        }
        
    case 10 :
        $news = new News();
        $news->updateNews();
        break;

    case 11 :
        $news = new News();
        $news->delete();
        break;

    default : 
        $news = new News();
        $news->showHome();
}


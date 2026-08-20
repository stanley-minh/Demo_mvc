<?php
//CONTROLLER

function displayUsers(){
    //Creation d'un objet ModelUser
    $modelUser = new ModelUser(connect());

    //Appel du model pour récupération des données
    $data = $modelUser->findAll();

    //Appel de la view pour effectuer l'affichage
    $title = "Mes Utilisateurs";
    include('./view/viewHeader.php');
    include('./view/viewUser.php');
    include('./view/viewFooter.php');
}
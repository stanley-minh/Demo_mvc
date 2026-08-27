<?php
//CONTROLLER
//Indication de l'espace de nom possédant la class ControllerUser
namespace Controller;
use Model\ModelUser;
use View\ViewUser;

/*Bonne pratique des namespaces :
- utiliser un namespace identique au nom du dossier
- La première lettre de chaque lettre d'un namespace commence par une Majuscule
=> le nom du dossier doit commencer par une Majuscule
- Le nom du fichier doit être identique au nom de la class, majuscule comprise
*/

use Controller\Controller;

class ControllerUser extends Controller{
    //ATTRIBUTS

    //CONSTRUCTEUR
     public function __construct(ModelUser $model, ViewUser $view){
        parent::__construct($model, $view);
    }

    //GETTER ET SETTER

    //METHODS

    //Affichage de la liste des utilisateurs
      public function render(): void{
        // Apell du model pour rcupérer les deonées des utilisateurs
        $data = $this->getModel()->findAll();
        // passage des data à la View et affichage
         $this->getView()
             ->setData($data)
             ->launchBuffer()
             ->display();
    }
    // Affichage initial du formulaire de connexion (GET)
     public function renderLogin(): void{
        $this->getView()
             ->setMessage('')
             ->launchBufferLogin()
             ->display();
    }
    // Traitement de la tentaive de connexion (POST)
    public function login(): void{
    // On confie l'email soumis au model
    $this->getModel()->setEmail($_POST['email']);
    //Récupéraion du compte correspondant (ou Null)
    $user = $this->getModel()->findByEmail();
    //Verification : le compte existe ET le mot de passe correspond au hash stocké
    if ($user && password_verify($_POST['password'], $user['password'])) {
         //Succès : ouverture de session
            $_SESSION['user'] = $user;
            }else{
            //Échec : on réaffiche le formulaire avec un message d'erreur
            $this->getView()
                 ->setMessage("Email ou mot de passe incorrect")
                 ->launchBufferLogin()
                 ->display();
        }
    }     
            }



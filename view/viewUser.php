<?php
namespace View;

use View\View;

class ViewUser extends View{
    //ATTRIBUT
 private ?string $message=null;
    //CONSTRUCTEUR

    //GETTER ET SETTER
       public function setMessage(string $message): self{
        $this->message = $message;
        return $this;
    }

    public function getMessage(): ?string{
        return $this->message;
    }
    //METHODS
    //Mise en mémoire tampon - liste des utilisateurs
    public function launchBuffer():self{
        //1. traitement des données pour affichage 
        // foreach($this->dataUsers as $row){
        //         $this->listUsers .="<li>Pseudo :".$row['pseudo']." - Email : ".$row['email']." - Role :".$row['role']."</li>";
        // };

        ob_start();
?>
            <main>
                <h1>Liste des utilisateurs</h1>
                <ul>
<?php  
                // inclusion de la boucle foreach effectuer en 1. (plus haut) au sein du template HTML mis en buffer
                foreach($this->getData() as $row){
?>
                    <li>Pseudo : <?= $row['pseudo'] ?> - Email : <?= $row['email'] ?> - Role : <?= $row['role'] ?></li>
<?php    
                }
?>
                </ul>
            </main>
<?php
        //Récupération du buffer dans la propriété $this->buffer
        $this->setBuffer(ob_get_clean());
        return $this;
    }



//Mise en mémoire tampon - Formulaire de connexion 
    public function launchBufferLogin():self{
        ob_start();
?>
            <main>
                <h1>Connexion</h1>
                <form action="?page=user&action=login" method="post">
                    <label for="email">Email :</label>
                    <input type="email" name="email" id="email" required>

                    <label for="password">Mot de passe :</label>
                    <input type="password" name="password" id="password" required>

                    <button type="submit">Se connecter</button>
                </form>
                <p><?= $this->getMessage() ?></p>
            </main>
<?php
        $this->setBuffer(ob_get_clean());
        return $this;
    }
}

<?php
//Class ModelUser
namespace Model;

use Model\Model;
use PDO;
use PDOExecption;

//extends : la propriété pour l'héritage. Ici ModelUser hérite de la class Model
class ModelUser extends Model{
    //ATTRIBUTS
    //les attributs d'un model doivent correspondrent aux champs de la table correspondante en BDD
    private ?int $id; // le ? signifie que l'attribut a le droit d'être null
    private ?string $pseudo;
    private ?string $email;
    private ?string $password;
    private ?string $createdAt;
    private ?string $role;

    //CONSTRUCTEUR

    //GETTER ET SETTER
public function setEmail(string $email): self{
        $this->email = $email;
        return $this;
    }
      public function getEmail(): ?string{
        return $this->email;
    }

    //METHODS
    public function findAll():?array{
        try{
            // Préparer une requête pour SELECT les utilisateurs
            //On utilise l'objet PDO stocké dans l'attribut bdd de notre model ($this->bdd)
            $req = $this->getBDD()->prepare('SELECT u.id, u.pseudo, u.email, u.password, u.created_at, r.role FROM user u INNER JOIN role r ON r.id = u.role_id');

            // Exécution de la requête
            $req->execute();

            // Return des données utilisateurs
            return $req->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOEXCEPTION $error){
            die($error->getMessage());
        }
    }
public function findByEmail():?array {
    try{
         // Préparer une requête paramétrée (WHERE email = :email)
            $req = $this->getBDD()->prepare('SELECT u.id, u.pseudo, u.email, u.password, u.created_at, r.role FROM user u INNER JOIN role r ON r.id = u.role_id WHERE u.email = :email');
         // Lier la valeur stockée dans l'objet à l'espace réservé :email
            $req->bindParam(':email', $this->email);
        // Exécution de la requête 
        $req-> execute();
         // Un seul enregistrement attendu → fetch(), pas fetchAll()
            return $req->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $error){
            die($error->getMessage());
        }
    }  
}

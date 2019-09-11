<?php	
require "connexion_bdd.php"; // Inclusion de notre bibliothèque de fonctions	
$db = connexionBase(); // Appel de la fonction de connexion	


if(isset($_POST['verifRef'])){
    $verifRef=htmlspecialchars($_POST['verifRef']);
    $requete = "SELECT pro_ref FROM produits WHERE pro_ref = :verifRef";		
    $result = $db->prepare($requete);
    $result->bindValue(':verifRef',$verifRef,PDO::PARAM_STR);
    $result->execute();	

    $row=$result->fetch(PDO::FETCH_OBJ);
    if($row != false){
        $data = 1;
    }else{
        $data = 0;
    }
    echo $data;
                 
}                

?>
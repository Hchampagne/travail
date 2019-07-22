<h3>Réception du formulaire ajout</h3>

<?php

$categorie=htmlentities($_POST['pro_cat_id']);
$reference=htmlentities($_POST['pro_ref']);
$libelle=htmlentities($_POST['pro_libelle']);
$descript=htmlentities($_POST['pro_description']);
$prix=htmlentities($_POST['pro_prix']);
$stock=htmlentities($_POST['pro_stock']);
$couleur=htmlentities($_POST['pro_couleur']);
$photo=htmlentities($_POST['pro_photo']);
$ajout=htmlentities($_POST['pro_d_ajout']);
$modif=null;
$bloque=htmlentities($_POST['pro_bloque']);

require "connexion_bdd.php"; // Inclusion de notre bibliothèque de fonctions	
$db = connexionBase(); // Appel de la fonction de connexion

try{
$requete=$db->prepare("INSERT INTO produits (pro_cat_id,pro_ref,pro_libelle,pro_description,pro_prix,pro_couleur,pro_photo,pro_d_ajout,pro_d_modif,pro_bloque)
VALUES(:categorie,:reference,:libelle,:descript,:prix,:stock,:couleur,:photo,:ajout,:modif,:bloque)");

$requete->bindValue(':categorie',$categorie);
$requete->bindValue(':reference',$reference);
$requete->bindValue(':libelle',$libelle);
$requete->bindValue(':descript',$descript);
$requete->bindValue(':prix', $prix);
$requete->bindValue(':stock',$stock);
$requete->bindValue(':couleur',$couleur);
$requete->bindValue(':photo',$photo);
$requete->bindValue(':ajout',$ajout);
$requete->bindValue(':modif',$modif);
$requete->bindValue(':bloque', $bloque);
$requete->execute();
$requete->closecursor[];
echo "cool";

} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage() . '<br />';
    echo 'N° : ' . $e->getCode();
    die('Fin du script');
}

//header("location:liste_detail.php");

?>
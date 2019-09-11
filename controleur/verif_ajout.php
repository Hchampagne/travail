<?php
//connection base de données et execution de la requete
require "connexion_bdd.php"; // Inclusion de notre bibliothèque de fonctions	
$db = connexionBase(); // Appel de la fonction de connexion

// regex
$regLibelle = '/^[\ \/_ \-A-Za-z0-9êéèçàäëï]*$/';
$regRef = '/^[\ \/_ \-A-Za-z0-9êéèçàäëï]*$/';
$regPrix = '/^[0-9]{1,6}(.[0-9]{2})$/';
$regStock = '/^[0-9]{1,11}$/';
$regCouleur = '/^[\ \/_ \-A-Za-z0-9êéèçàäëï]*$/';
$regDescrip = '/^[^<>\/]+[\w\W]{1,999}$/';

// messages erreurs
$A = "champs vide";
$B = "saisie incorrecte";
$C = "trop long";
$messError["pro_ref"] ="&nbsp";
$messError["pro_libelle"] = "&nbsp";
$messError["pro_prix"] = "&nbsp";
$messError["pro_stock"] = "&nbsp";
$messError["pro_couleur"] = "&nbsp";
$messError["pro_descrip"] = "&nbsp";
$messError['photo'] = "&nbsp";
$error = 0;

//refresh la page sur click effacer
if(isset($_POST['effacer'])){
    header('Refresh: 0','url=form_ajout.php');
}

// Vérif du formulaire
if (isset($_POST['ajouter'])){

    $error = 0;

    // REQUETE DB verif ref déjà utiliser
    $pro_ref = htmlspecialchars($_POST['pro_ref']);
    $req = $db->prepare("SELECT pro_ref FROM produits WHERE  pro_ref= :proref"); //prep. requete 
    //liaison position variable
    $req->bindValue(':proref',$pro_ref, PDO::PARAM_STR);
    $req->execute(); 
    $verifref = $req->fetch(PDO::FETCH_OBJ); //si la ref n'existe pas dans la Db l'objet retourné contient false
    $req->closecursor(); 
    
    // champ pro_ref
    if ($_POST['pro_ref'] == '') {$messError['pro_ref'] = $A;} 
    else if (!preg_match($regRef, ($_POST['pro_ref']))) {
        $messError['pro_pro_ref'] = $B;}
    else if (strlen($_POST['pro_ref']) > 10  ){
        $messError['por_ref'] = $C;
    }
    else if ( $verifref != false){
        $messError['pro_ref'] = "Dejà utilisée";
    }
    else {$messError['pro_ref'] = "";}

    //champ pro_libelle
    if ($_POST['pro_libelle'] == '') {
        $messError['pro_libelle'] = $A;
    } else if (!preg_match($regLibelle, ($_POST['pro_libelle']))) {
        $messError['pro_libelle'] = $B;
    } else if (strlen($_POST['pro_libelle']) > 200) {
        $messError['por_libelle'] = $C;
    } else {
        $messError['pro_libelle'] = "";
    }

    //champ pro_prix
    if ($_POST['pro_prix'] == '') {
        $messError['pro_prix'] = $A;
    } else if (!preg_match($regPrix, ($_POST['pro_prix']))) {
        $messError['pro_prix'] = $B;
    } else if (strlen($_POST['pro_prix']) > 9){
        $messError['pro_prix'] = $C;
    } else {
        $messError['pro_prix'] = "";
    }

    //champ pro_stock
    if ($_POST['pro_stock'] == '') {
        $messError['pro_stock'] = $A;
    } else if (!preg_match($regStock, ($_POST['pro_stock']))) {
        $messError['pro_stock'] = $B;
    } else if (strlen($_POST['pro_stock']) > 11) {
        $messError['pro_stock'] = $C;
    } else {
        $messError['pro_stock'] = "";
    }

    //champ pro_couleur
    if ($_POST['pro_couleur'] == '') {
        $messError['pro_couleur'] = $A;
    } else if (!preg_match($regCouleur, ($_POST['pro_couleur']))) {
        $messError['pro_couleur'] = $B;
    } else if (strlen($_POST['pro_couleur']) > 30) {
        $messError['pro_couleur'] = $C;
    } else {
        $messError['pro_couleur'] = "";
    }

    //champ pro_description
    if ($_POST['pro_descrip'] == '') {
        $messError['pro_descrip'] = $A;
    } else if (!preg_match($regDescrip, ($_POST['pro_descrip']))) {
        $messError['pro_descrip'] = $B;
    } else if (strlen($_POST['pro_descrip']) > 999) {
        $messError['pro_descrip'] = $C;
    } else {
        $messError['pro_descrip'] = "";
    }

   //Controle telechargement photo	
    if (!empty($_FILES['fichier']['tmp_name'])) {
        $messError['photo'] = "";
        $aMimeTypes = array("image/gif", "image/jpeg", "image/pjpeg", "image/png", "image/x-png", "image/tiff"); // On met les types autorisés dans un tableau (ici pour une image)		
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimetype = finfo_file($finfo, $_FILES["fichier"]['tmp_name']);    // On extrait le type du fichier via l'extension FILE_INFO 
        finfo_close($finfo);
    if (!in_array($mimetype, $aMimeTypes)){   // Le type n'est pas autorisé, donc ERREUR 
        $messError['photo']="Type de fichier non autorisé"; 
    }         
         
    else {
        $messError['photo'] = ""	;               
    } 
    }else{ $messError['photo'] = "Photo absente";}
}

    //compteur erreur
    foreach ($messError as $key => $value) {
        if ($value == '') {
            $error = $error + 1;
        }   
    }

    // requete insertion et photo rename/deplace
    if ($error == 7){
        // recup des valeur du POST formulaire ajout
        $categorie = htmlspecialchars($_POST['pro_cat_id']);
        $reference = htmlspecialchars($_POST['pro_ref']);
        $libelle = htmlspecialchars($_POST['pro_libelle']);
        $descript = htmlspecialchars($_POST['pro_descrip']);
        $prix = htmlspecialchars($_POST['pro_prix']);
        $stock = htmlspecialchars($_POST['pro_stock']);
        $couleur = htmlspecialchars($_POST['pro_couleur']);
        $bloque = htmlspecialchars($_POST['pro_bloque']);

        // date ajout généré par le système
        date_default_timezone_set('Europe/Paris');
        $date = new datetime();
        $ajout = $date->format('Y-m-d');

        //prepare la requete
        $requete = $db->prepare("INSERT INTO produits (pro_cat_id,pro_ref,pro_libelle,pro_description,pro_prix,pro_stock,pro_couleur,pro_d_ajout,pro_bloque)
        VALUES(:categorie,:reference,:libelle,:descript,:prix,:stock,:couleur,:ajout,:bloque)"); 

        //liaison position variable
        $requete->bindValue(':categorie', $categorie, PDO::PARAM_INT);
        $requete->bindValue(':reference', $reference, PDO::PARAM_STR);
        $requete->bindValue(':libelle', $libelle, PDO::PARAM_STR);
        $requete->bindValue(':descript', $descript, PDO::PARAM_STR);
        $requete->bindValue(':prix', $prix, PDO::PARAM_STR);
        $requete->bindValue(':stock', $stock, PDO::PARAM_INT);
        $requete->bindValue(':couleur', $couleur, PDO::PARAM_STR);
        $requete->bindValue(':ajout', $ajout, PDO::PARAM_STR);
        $requete->bindValue(':bloque', $bloque, PDO::PARAM_STR);
        $requete->execute();
        $requete->closecursor();

        //renome et deplace la photo ds assets/images/
        $lastId = $db->lastInsertId();
        $extention = substr(strrchr($_FILES['fichier']['name'], '.'), 1);              //Extention vérifier on renome la photo
        $photo = $lastId . '.' . $extention;                                             //concatenation " pro_id.extention "
        move_uploaded_file($_FILES['fichier']['tmp_name'], '../assets/images/' . $photo);  // deplace la photo dans dossier assets/images
            


        header('location: ../form_liste_detail.php'); //redirection liste_detail  
    
  
}















    
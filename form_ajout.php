<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>formulaire ajout</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>détail</title>
</head>

<body>




    <div class="container">
        <p>
            <h3>Formulaire Ajout</h3>
        </p>
        <form name="formulaire" action="ajout.php" method="post" id="formulaire">               

                    <?php // liste select pour pro_cat_id <=>cat_id
                    echo " <Div class=form-group>";
                    echo "<label for=pro_cat_id>Catégorie</label>";
                    echo "<select name=pro_cat_id>";
                    require "connexion_bdd.php"; // Inclusion de notre bibliothèque de fonctions	
                    $db = connexionBase(); // Appel de la fonction de connexion	
                    $requete = "SELECT cat_id  FROM categories ORDER BY cat_id asc";
                    $result = $db->query($requete);
                    if (!$result) {
                        $tableauErreurs = $db->errorInfo();
                        echo $tableauErreur[2];
                        die("Erreur dans la requête");
                    }
                    if ($result->rowCount() == 0) {
                        // Pas d'enregistremen	
                        die("La table est vide");
                    }
                    $acategorie = $result->fetchAll(PDO::FETCH_OBJ);
                    foreach ($acategorie as $categorie) {              //balayage du tableau
                        $cat = $categorie->cat_id;                  
                    echo "<option value=" . $cat . ">" . $cat . "</option>";                   
                    }
                    $db=null;
                    echo "</select>";
                    echo "</div>";
                    ?>

            <div class="form-group">
                <label for=pro_ref>Référence produit</label>
                <input class="form-control" type='text' name='pro_ref' placeholder="Référence produit /10">
            </div>

            <div class="form-group">
                <label for=pro_libelle>Nom du produit</label>
                <input class="form-control" type='text' name='pro_libelle' placeholder="Nom du produit /200">
            </div>

            <div class="form-group">
                <label for=pro_description>Description</label>
                <textarea class="form-control" id="story" name="pro_description" rows="4" cols="50">Description... /1000</textarea>
            </div>

            <div class="form-group">
                <label for=pro_prix>Prix</label>
                <input class="form-control" type='text' name='pro_prix' placeholder="prix xx.xx">
            </div>

            <div class="form-group">
                <label for=pro_stock>Stock</label>
                <input class="form-control" type='text' name='pro_stock'  placeholder="nombre /11">
            </div>


            <div class="form-group">
                <label for=pro_couleur>Couleur</label>
                <input class="form-control" type='text' name='pro_couleur'  placeholder="couleur /30">
            </div>

            <div class="form-group">
                <label for=pro_photo>Extension de la photo</label>
                <input class="form-control" type='text' name='pro_photo' placeholder="extention /4">
            </div>

            <div class="form-group">
                <label for=pro_d_ajout>Date ajout</label>
                <input class="form-control" type='text' name='pro_d_ajout' placeholder="yyyy-mm-dd">
            </div>

            <p>Produit bloqué :
                <label for="pro_bloque">oui</label>
                <input type="radio" name="pro_bloque" value='1'>
                <label for="pro_bloque">non</label>
                <input type="radio" name="pro_bloque" value='0' checked="checked" ;>
            </p>

            <INPUT type="submit" name="modifier" value="ajouter">

        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>
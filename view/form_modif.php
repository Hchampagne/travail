<?php
include '../controleur/verif_modif.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Formulaire de modification</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/CSS/style.css">
        <title>détail</title>
</head>

<body>

<div class="container">
        <p>
            <h3>Formulaire de modification</h3>
        </p>
        <form name="formulaire" action="#" method="post" id="formulaire" enctype="multipart/form-data">

<div class="row">


    
    <div class="col-md-1">
        <div class=" form-group">
            <label for='gpro_id'>Id</label>
            <input class="form-control" type="txt" name="gpro_id" value="<?= $pro_id ?>" disabled>
            <input type="hidden" name="pro_id" value="<?= $pro_id ?>">
        </div>   
    </div>



    <div class="col-md-4">
            <Div class=form-group>
                <label for=pro_cat_id>Catégorie</label>
                <select class='form-control' name='pro_cat_id'>
                    <?php
                    //liste déroulante référence
                    $requete = "SELECT cat_id,cat_nom  FROM categories ORDER BY cat_id asc";
                    $result1 = $db->query($requete);                    
                    $acategorie = $result1->fetchAll(PDO::FETCH_OBJ);
                    foreach ($acategorie as $categorie) {                                   
                    ?>
                    <option value="<?= $categorie->cat_id ?>"><?= $categorie->cat_nom ?></option>
                    <?php
                    }
                    ?>
                        <!-- choix du detail pour référece -->
                    <option selected="<?= $categorie2->cat_id ?>" value="<?= $categorie2->cat_id ?>"><?= $categorie2->cat_nom ?></option>
                
                </select>
                <span>&nbsp</span>
            </div>
    </div>

    <div class="col-md-4">
            <div class="form-group">
                <label for=pro_ref>Référence produit</label>
                <input class="form-control" type='text' name='pro_ref'  id="pro_ref" value="<?= isset($_POST['pro_ref']) ? $_POST['pro_ref'] : $produit->pro_ref; ?>">
                <span id="alertRef" >&nbsp<?= $messError['pro_ref'] ?></span>
            </div>
    </div>
    <div class="col-md-3">

            <div class="form-group">
                <label for=pro_libelle>Nom du produit</label>
                <input class="form-control" type='text' name='pro_libelle' id="pro_libelle" value="<?= isset($_POST['pro_libelle']) ? $_POST['pro_libelle'] : $produit->pro_libelle; ?>">
                <span id="alertLibelle">&nbsp<?= $messError['pro_libelle'] ?></span>
            </div>
    </div>
</div>
<div class="row center">   
    <div class="col-md-4">
            <div class="form-group">
                <label for=pro_prix>Prix</label>
                <input class="form-control" type='text' name='pro_prix' id="pro_prix" value="<?= isset($_POST['pro_prix']) ? $_POST['pro_prix'] : $produit->pro_prix; ?>">
                <span id="alertPrix">&nbsp<?= $messError['pro_prix'] ?></span>
            </div>
    </div>
    <div class="col-md-4">
            <div class="form-group">
                <label for=pro_stock>Stock</label>
                <input class="form-control" type='text' name='pro_stock' id="pro_stock" value="<?= isset($_POST['pro_stock']) ? $_POST['pro_stock'] : $produit->pro_stock; ?>">
                <span id="alertStock">&nbsp<?= $messError['pro_stock'] ?></span>
            </div>
    </div>
    <div class="col-md-4">
            <div class="form-group">
                <label for=pro_couleur>Couleur</label>
                <input class="form-control" type='text' name='pro_couleur' id="pro_couleur" value="<?= isset($_POST['pro_couleur']) ? $_POST['pro_couleur'] : $produit->pro_couleur; ?>">
                <span id="alertCouleur">&nbsp<?= $messError['pro_couleur'] ?></span>
            </div>
    </div>       
</div>
            
            <div class="form-group">
                <p>Produit bloqué :
                    <label for="pro_bloque">oui</label>
                    <input type="radio" name="pro_bloque" value='1' <?= $produit->pro_bloque == 1 ? "checked=\"checked\"":""; ?>>
                    <label for="pro_bloque">non</label>
                    <input type="radio" name="pro_bloque" value='0' <?= $produit->pro_bloque == 0 ? "checked=\"checked\"":""; ?>> 

                </p>
                <span>&nbsp</span>
            </div>
<div class="row">            
    <div class="col-md-5">              
            <div class="form-group">
                <label class='control-label' for="file">Fichier photo</label>
                <input class='file-style' type='file' name='fichier'>
                <p class="span">&nbsp<?= $messError['photo']; ?></p> 
            </div>					
			<div>
				<img src="<?php echo "./assets/images/".$produit->pro_id.".".$produit->pro_photo ?>" class="img-responsive" height="250" width="250">
			</div>                           
    </div>
    <div class="col-md-7">
            <div class="form-group">
                <label for=pro_descrip>Description</label>
                <textarea class="form-control" id="pro_descrip" name="pro_descrip" rows="10" cols="50" value=""><?= isset($_POST['pro_descrip']) ? $_POST['pro_descrip'] : $produit->pro_description; ?></textarea>
                <span id="alertDescrip">&nbsp<?= $messError['pro_descrip']; ?></span>
            </div>
    </div>
</div>
                

                <div clas="form-group">
                    <button type="submit" name="modifier" value="modifier">Modifier</button>
                    <button type="submit" name="effacer" value="effacer">Effacer</button>
                    <button><a class="button" href="../form_liste_detail.php" value="Retour">Retour</a></button>
                </div>

        </form>
</div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="../assets/JS/ctrl_form.js"></script> 
</body>

</html
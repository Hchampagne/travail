<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<title>HTML</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<title>détail</title>
</head>

<body>
	<div class="container">
		<?php
		require "connexion_bdd.php"; // Inclusion de notre bibliothèque de fonctions
		$db = connexionBase(); // Appel de la fonction de connexion
		$pro_id = $_GET["pro_id"];
		$requete = "SELECT * FROM produits WHERE pro_id=" . $pro_id;
		$result = $db->query($requete);
		// Renvoi de l'enregistrement sous forme d'un objet
		$produit = $result->fetch(PDO::FETCH_OBJ);
		?>

		<form>

			<div class=" form-group">
				<label for='pro_id'>ID</label>
				<input class=form-control type="txt" name="pro_id" value="<?php echo $produit->pro_id; ?>" disabled>
			</div>

			<div class="form-group">
				<label for='pro_cat_id'>Catégorie</label>
				<input class=form-control type="txt" name="pro_cat_id" value="<?php echo $produit->pro_cat_id; ?>">
			</div>


			<div class="form-group">
				<label for='pro_ref'>Référence</label>
				<input class=form-control type="txt" name="pro_ref" value="<?php echo $produit->pro_ref; ?>">
			</div>

			<div class="form-group">
				<label for='pro_libelle'>Libellé</label>
				<input class=form-control type="txt" name="pro_libelle" value="<?php echo $produit->pro_libelle; ?>">
			</div>

			<div class="form-group">
				<label for='pro_description'>Description</label>
				<input class=form-control type="txt" name="pro_description" value="<?php echo $produit->pro_description; ?>">
			</div>

			<div class="form-group">
				<label for='pro_prix'>Prix</label>
				<input class=form-control type="txt" name="pro_prix" value="<?php echo $produit->pro_prix; ?>">
			</div>

			<div class="form-group">
				<label for='pro_stock'>Stock</label>
				<input class=form-control type="txt" name="pro_stock" value="<?php echo $produit->pro_stock; ?>">
			</div>	

			<div class="form-group">
					<label for='pro_couleur'>Couleur</label>
					<input class=form-control type="txt" name="pro_couleur" value="<?php echo $produit->pro_couleur; ?>">
			</div>

				
				<p>Produit bloqué :
				<label for="bloque">oui</label>
				<input type="radio" name="bloque" value='1'<?php if($produit->pro_bloque==1){echo "checked=\"checked\"";}?>>
				<label for="bloque">non</label>
				<input type="radio" name="bloque" value='0' <?php if($produit->pro_bloque==0){echo "checked=\"checked\"";}?>;>
				</p>	
			
				<p>Date d'ajout : <?php echo date("d/m/Y",strtotime($produit->pro_d_ajout)); ?><p>
				<p>Date de modification : <?php if ($produit->pro_d_modif!=0){echo date("d/m/Y H:i:s",strtotime($produit->pro_d_modif));} ?>

		</form>
		<nav class="nav">
		 <a class="navbar-brand" href="liste_detail.php">RETOUR</a>
		 <?php echo "<a class=\"navbar-brand\" href=suppression.php?pro_id=".$produit->pro_id.">SUPPRIMER</a></td>"; ?>
         <?php echo "<a class=\"navbar-brand\" href=modification.php?pro_id=".$produit->pro_id.">MODIFIER</a></td>"; ?>
		 
		</nav>

		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>
<!DOCTYPE html>	
<html lang="fr">	
<head>	
<meta charset="UTF-8">	
<title>Liste_détail</title>	
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>	
<body> 	

<div class="container">
    <div class="row">
        <div class="col table-responsive">
            <table class="table table-bordered table-striped">
                <?php	
                    require "connexion_bdd.php"; // Inclusion de notre bibliothèque de fonctions	
                    $db = connexionBase(); // Appel de la fonction de connexion	
                    $requete = "SELECT * FROM produits  ORDER BY pro_id asc";		
                    $result = $db->query($requete);		
                    if (!$result) 	
                {	
                    $tableauErreurs = $db->errorInfo();	
                    echo $tableauErreur[2]; 	
                    die("Erreur dans la requête");	
                }		
                    if ($result->rowCount() == 0) 	
                {	
                    // Pas d'enregistremen	
                    die("La table est vide");	
                }	

    
       
            
                echo "<thead>";
                    echo"<tr>"	;
                    echo"<td>"."photo"."</td>";
                    echo"<td>"."Id"."</td>";
                    echo"<td>"."Référence"."</td>";
                    echo"<td>"."Libellé"."</td>";
                    echo"<td>"."prix"."</td>";
                    echo"<td>"."Stock"."</td>";
                    echo"<td>"."couleur"."</td>";
                    echo"<td>"."Date ajout"."</td>";
                    echo"<td>"."Date modif"."</td>";
                    echo"<td>"."Prd bloqué"."</td>";
                    echo"</tr>";
                echo "</thead>";
                echo "<tbody>";
                    while ($row = $result->fetch(PDO::FETCH_OBJ))	
                {	

                    echo"<tr>";	
                    echo"<td>".$row->pro_photo."</td>";
                    echo"<td>".$row->pro_id."</td>";	
                    echo"<td>".$row->pro_ref."</td>";	
                    echo"<td><a href=\"detail.php?pro_id=".$row->pro_id."\" title=\"".$row->pro_libelle."\">$row->pro_libelle</a></td>";
                    echo"<td>".$row->pro_prix."</td>";
                    echo"<td>".$row->pro_stock."</td>";	
                    echo"<td>".$row->pro_couleur."</td>";
                    echo"<td>".$row->pro_d_ajout."</td>";
                    echo"<td>".$row->pro_d_modif."</td>";
                    echo"<td>".$row->pro_bloque."</td>";
                    echo"</tr>";	
                }
                Echo "</tbody>";            	
?>
            </table>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>	
</html> 
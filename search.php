<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Test</title>
    </head>
    <body>
		<h1> Rechercher un élève</h1>
		
		 <form name="Rechercher" method="post" action="search.php">
            Classe : <input type="text" name="classe"/> <br/>
            Nom :	<input type="text" name="nom" /><br/>
            Prénom : <input type="text" name="prenom"/><br/>
            <input type="submit" name="valider" value="OK"/>
        </form>
			
			<?php
			try
			{
				$bdd = new PDO('mysql:host=localhost;dbname=seleve;charset=utf8', 'root', '');
			}
			catch (Exception $e)
			{			
				die('Erreur : ' . $e->getMessage());
			}


			$reponse = $bdd->prepare('SELECT * FROM liste_eleve WHERE classe = ? OR nom = ? OR prenom = ?');
			
			$reponse->execute(array($_POST['classe'], $_POST['nom'],$_POST['prenom']));
			
			echo '<ul>';
			while ($donnees = $reponse->fetch())
			{
				 echo '<li>' . $donnees['classe'] . '' . $donnees['nom'] . ' ' . $donnees['prenom'] . '</li>';  
			}
			echo '</ul>';

			$reponse->closeCursor();

			?>
			
			
			
        </form>
    </body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Upload App</title>
    <link rel="stylesheet" href="./style.css"/>
</head>

<body>
    <div class="container">
        <!-- Formulaire simple d'upload de fichier -->
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <h1>
                Formulaire d'envoi de fichier :
            </h1>
            <div class="action">
              <input type="file" name="monfichier" id="monfichier" /><br />
              <input type="submit" value="Envoyer le fichier" name="submit" />
            </div>
            
        </form>

        <!-- Liste des fichiers -->
        <h2>Liste des fichiers</h2>
        <ul>
            <?php
            // Connexion à la base de données (à ajuster selon tes paramètres)
            $serveur = "localhost";
            $utilisateur = "root";
            $motdepasse = "root";
            $basededonnees = "upfile";

            $connexion = new mysqli($serveur, $utilisateur, $motdepasse, $basededonnees);

            // Vérification de la connexion
            if ($connexion->connect_error) {
                die("Échec de la connexion à la base de données : " . $connexion->connect_error);
            }

            // Récupération des fichiers depuis la base de données
            $requeteSelect = "SELECT * FROM fichiers";
            $resultat = $connexion->query($requeteSelect);

            // Affichage des fichiers dans le HTML
            while ($row = $resultat->fetch_assoc()) {
                echo "<li><a href='" . $row['path'] . "' target='_blank'>" . $row['name'] . "</a></li>";
            }

            // Fermeture de la connexion
            $connexion->close();
            ?>
        </ul>
    </div>
</body>

</html>
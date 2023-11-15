<?php

// Connexion à la base de données (à ajuster selon tes paramètres)
$serveur = "10.95.135.84";
$utilisateur = "root";
$motdepasse = "rIrH~&um?a5(0,i?KgHs";
$basededonnees = "upfile";

$connexion = new mysqli($serveur, $utilisateur, $motdepasse, $basededonnees);

// Vérification de la connexion
if ($connexion->connect_error) {
    die("Échec de la connexion à la base de données : " . $connexion->connect_error);
}

// Vérification si le formulaire a été soumis
if (isset($_POST['submit'])) {
    $nomFichier = $_FILES['monfichier']['name'];
    $typeFichier = $_FILES['monfichier']['type'];
    $tailleFichier = $_FILES['monfichier']['size'];
    $cheminTemporaire = $_FILES['monfichier']['tmp_name'];

    // Stockage du fichier dans le répertoire de destination (à ajuster)
    $destination = "uploads/" . $nomFichier;
    move_uploaded_file($cheminTemporaire, $destination);

    // Insertion des informations dans la base de données
    $requete = "INSERT INTO fichiers (nom, type, taille, chemin) VALUES ('$nomFichier', '$typeFichier', $tailleFichier, '$destination')";
    if ($connexion->query($requete) === TRUE) {
        echo "Fichier ajouté avec succès à la base de données.";
    } else {
        echo "Erreur : " . $requete . "<br>" . $connexion->error;
    }
}

// Récupération des fichiers depuis la base de données
$requeteSelect = "SELECT * FROM fichiers";
$resultat = $connexion->query($requeteSelect);

// Affichage des fichiers dans le HTML
echo "<ul>";
while ($row = $resultat->fetch_assoc()) {
    echo "<li><a href='" . $row['chemin'] . "' target='_blank'>" . $row['nom'] . "</a></li>";
}
echo "</ul>";

// Fermeture de la connexion
$connexion->close();

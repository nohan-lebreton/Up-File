<?php

require_once "vendor/autoload.php";

use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Common\ServiceException;
use MicrosoftAzure\Storage\Blob\Models\ContainerACL;
use MicrosoftAzure\Storage\Blob\Models\PublicAccessType;
use MicrosoftAzure\Storage\Blob\Models\CreateBlockBlobOptions;


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

// Vérification si le formulaire a été soumis
if (isset($_POST['submit'])) {
    $nomFichier = $_FILES['monfichier']['name'];
    $typeFichier = $_FILES['monfichier']['type'];
    $tailleFichier = $_FILES['monfichier']['size'];
    $cheminTemporaire = $_FILES['monfichier']['tmp_name'];

    $accountKey = "DoDQegJiK8Oxk0ThSSoz1+K/HaiRd0ktJbGnnojv1psqhackHmbKD3L4moKP1WmIEwOIHbHUmG2/+ASt8lEN9A==";
    $accountName = "groupepoiron";
    $blobClient = BlobRestProxy::createBlobService(
        "DefaultEndpointsProtocol=https;AccountName=$accountName;AccountKey=$accountKey"
    );
   
    $containerName = "groupepoiron";
    $blobName = $nomFichier;
    $content = file_get_contents($cheminTemporaire);

    // Options de configuration pour l'envoi du fichier
    $options = new CreateBlockBlobOptions();

    $acl = new ContainerACL();
    $acl->setPublicAccess(PublicAccessType::CONTAINER_AND_BLOBS);
    $blobClient->setContainerACL("groupepoiron", $acl);

    $blobClient->createBlockBlob($containerName, $blobName, $content, $options);
    $blobUrl = $blobClient->getBlobUrl($containerName, $blobName);
    
    // Insertion des informations dans la base de données
    $requete = "INSERT INTO fichiers (name, size, path) VALUES ('$nomFichier', $tailleFichier, '$blobUrl')";
    if ($connexion->query($requete) === TRUE) {
        echo "Fichier ajouté avec succès à la base de données.";
    } else {
        echo "Erreur : " . $requete . "<br>" . $connexion->error;
    }
}

// Récupération des fichiers depuis la base de données
$requeteSelect = "SELECT * FROM fichiers";
$resultat = $connexion->query($requeteSelect);


header('Location: /');
exit();

//clé : DoDQegJiK8Oxk0ThSSoz1+K/HaiRd0ktJbGnnojv1psqhackHmbKD3L4moKP1WmIEwOIHbHUmG2/+ASt8lEN9A==
//chaine connexion : DoDQegJiK8Oxk0ThSSoz1+K/HaiRd0ktJbGnnojv1psqhackHmbKD3L4moKP1WmIEwOIHbHUmG2/+ASt8lEN9A==

//clé 2 : v9xifT1kCalDmZzAC74MGS55PawlS888q6HRZQ90WaOUWEmfDVuY0QOVoOHQllMfhCP2k4XAAMR7+AStshNgSg==
//chaine connexion : DefaultEndpointsProtocol=https;AccountName=groupepoiron;AccountKey=v9xifT1kCalDmZzAC74MGS55PawlS888q6HRZQ90WaOUWEmfDVuY0QOVoOHQllMfhCP2k4XAAMR7+AStshNgSg==;EndpointSuffix=core.windows.net


// Fermeture de la connexion
$connexion->close();

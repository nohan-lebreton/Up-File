<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Upload App</title>
  <link rel="stylesheet" href="./style.css" />
</head>

<body>
  <!-- Formulaire simple d'upload de fichier -->
  <form action="upload.php" method="post" enctype="multipart/form-data">
    <p>
      Formulaire d'envoi de fichier :<br />
      <input type="file" name="monfichier" id="monfichier" /><br />
      <input type="submit" value="Envoyer le fichier" name="submit" />
    </p>
  </form>
</body>

</html>
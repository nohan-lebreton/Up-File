<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Upload App</title>
  <!-- <link rel="stylesheet" href="./style.css" /> -->
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 800px;
      margin: 20px auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    form {
      margin-bottom: 20px;
    }

    form p {
      margin-bottom: 10px;
    }

    input[type="file"] {
      display: none;
    }

    label {
      background-color: #3498db;
      color: #fff;
      padding: 10px 15px;
      border-radius: 5px;
      cursor: pointer;
    }

    input[type="submit"] {
      background-color: #2ecc71;
      color: #fff;
      padding: 10px 15px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #27ae60;
    }

    ul {
      list-style-type: none;
      padding: 0;
    }

    ul li {
      margin-bottom: 10px;
    }

    a {
      text-decoration: none;
      color: #3498db;
      font-weight: bold;
    }

    a:hover {
      text-decoration: underline;
    }
  </style>
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
<?php
  // Démarage de la session
  session_start();

  //
  if($_POST){
    if(isset($_POST['produit']) && !empty($_POST['produit'])
    && isset($_POST['prix']) && !empty($_POST['prix'])
    && isset($_POST['nombre']) && !empty($_POST['nombre'])){

      // Connexion à la base de données
      require_once('connect.php');

      // Nettoyage des données envoyées
      $produit = strip_tags($_POST['produit']);
      $prix = strip_tags($_POST['prix']);
      $nombre = strip_tags($_POST['nombre']);

      // On insert les informations produit dans la base de données
      $sql = 'INSERT INTO `liste` (`produit`, `prix`, `nombre`) VALUES (:produit, :prix, :nombre);';

      $query = $db->prepare($sql);

      $query->bindValue(':produit', $produit, PDO::PARAM_STR);
      $query->bindValue(':prix', $prix, PDO::PARAM_STR);
      $query->bindValue(':nombre', $nombre, PDO::PARAM_INT);

    $query->execute();

    // Message de confirmation de l'ajout du produit dans la base de données
    $_SESSION['message'] = "Produit ajouté avec succès !";

    // Déconnexion de la base de données
    require_once('close.php');

    header('Location: index.php');
  }else{
      $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
  }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ajouter un produit</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
  <main class="container border mt-5 shadow-lg">
    <div class="row">
      <section class="col12 mt-2">
      <?php
          if(!empty($_SESSION['erreur'])){
            echo '<div class="alert alert-warning mt-2" role="alert">
                    '. $_SESSION['erreur'].'
                  </div>';
                  $_SESSION['erreur'] = "";
          }
        ?>
      <h1>Ajouter un produit</h1>
      <form method="post">
        <div class="form-group">
          <label for="produit">Produit</label>
          <input type="text" id="produit" name="produit" class="form-control mb-2">
        </div>
        <div class="form-group">
          <label for="prix">Prix</label>
          <input type="text" id="prix" name="prix" class="form-control mb-2">
        </div>
        <div class="form-group">
          <label for="nombre">Quantité</label>
          <input type="number" id="nombre" name="nombre" class="form-control mb-2">
        </div>
        <button class="btn btn-success my-4">Envoyer</button>
        <p><a href="index.php" class="btn btn-primary">Retour à la liste</a></p>
      </form>
      </section>
    </div>
  </main>
  <script src="https://kit.fontawesome.com/0f3ecde558.js" crossorigin="anonymous"></script>
</body>
</html>
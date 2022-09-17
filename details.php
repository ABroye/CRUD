<?php
  // Démarage de la session
  session_start();

  // Vérification de l'existance de l'ID dans l'URL
  if(isset($_GET['id']) && !empty($_GET['id'])){
    require_once('connect.php');

    // Nettoyage de l'ID
    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM `liste` WHERE `id` = :id;';

    // Préparation de la requête
    $query = $db->prepare($sql);

    // Accrochage des paramètres de l'ID
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // Execution de la requête
    $query->execute();

    // Récupération du produit
    $produit = $query->fetch();

    // Vérification de la présence du produit
    if(!$produit){
      $_SESSION['erreur'] = "Ce produit n'existe pas !";
      header('Location: index.php');
    }

  }else{
    $_SESSION['erreur'] = "URL invalide !";
    header('Location: index.php');
  }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Détails du produit</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
  <main class="container">
    <div class="row">
      <section class="col12">
        <div class="card mt-5">
          <div class="card-header">
            <h1>Détails du produit <?= $produit['produit'] ?></h1>
          </div>
          <div class="card-body">
            <p>ID : <?= $produit['id'] ?></p>
            <p>Nom : <?= $produit['produit'] ?></p>
            <p>Prix : <?= $produit['prix'] ?> €</p>
            <p>Quantité : <?= $produit['nombre'] ?></p>
          </div>
          <div class="card-footer pt-4">
            <p><a href="index.php" class="btn btn-primary">Retour à la liste</a> <a class="btn btn-success" href="edit.php?id=<?= $produit['id'] ?>">Modifier</a></p>
          </div>
        </div>
      </section>
    </div>
  </main>

</body>
</html>
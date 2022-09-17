<?php
  // Démarage de la session
  session_start();

  // Connexion à la base de données
  require_once('connect.php');

  // On écrit notre requête
  $sql = 'SELECT * FROM `liste`';

  // Préparation de la requête
  $query = $db->prepare($sql);

  // Exécution de la requête
  $query->execute();

  // Stockage du résultat dans un tableau associatif
  $result = $query->fetchAll(PDO::FETCH_ASSOC);

  // Déconnexion de la base de données
  require_once('close.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liste des produits</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
  <main class="container border mt-5 shadow-lg">
    <div class="row">
      <section class="col12">
        <?php
          if(!empty($_SESSION['erreur'])){
            echo '<div class="alert alert-danger mt-2" role="alert">
                    '. $_SESSION['erreur'].'
                  </div>';
                  $_SESSION['erreur'] = "";
          }
        ?>
        <?php
          if(!empty($_SESSION['message'])){
            echo '<div class="alert alert-success mt-2" role="alert">
                    '. $_SESSION['message'].'
                  </div>';
                  $_SESSION['message'] = "";
          }
        ?>
        <h1>Liste des produits</h1>
        <table class="table">
          <thead>
            <th>ID</th>
            <th>Produit</th>
            <th>Prix</th>
            <th>Nombre</th>
            <th>Actions</th>
          </thead>
          <tbody>
            <?php
            // Boucle sur la variable result
            foreach($result as $produit){
            ?>
              <tr>
                <td><?= $produit['id'] ?></td>
                <td><?= $produit['produit'] ?></td>
                <td><?= $produit['prix'] ?> €</td>
                <td><?= $produit['nombre'] ?></td>
                <td>
                  <a href="details.php?id=<?= $produit['id'] ?>"><i class="fa-regular fa-eye" alt="Voir"></i></a>
                  <a href="edit.php?id=<?= $produit['id'] ?>"><i class="fa-regular fa-pen-to-square"></i></a>
                  <a href="delete.php?id=<?= $produit['id'] ?>"><i class="fa-regular fa-trash-can"></i></a>
                </td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
        <a href="add.php" class="btn btn-primary mb-3 shadow-md">Ajouter un produit</a>
      </section>
    </div>
  </main>
  <script src="https://kit.fontawesome.com/0f3ecde558.js" crossorigin="anonymous"></script>
</body>
</html>
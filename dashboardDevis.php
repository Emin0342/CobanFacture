<?php
require_once 'config.php';

// Vérifier si le formulaire de suppression a été soumis
if (isset($_POST['delete_sid'])) {
    $delete_sid = $_POST['delete_sid'];
    $delete_sql = "DELETE FROM devis WHERE SID = $delete_sid";
    $result = mysqli_query($con, $delete_sql);
    if (!$result) {
        echo "Erreur lors de la suppression du devis. Veuillez réessayer plus tard.";
    } else {
        echo "Le devis a été supprimée avec succès.";
    }
}

// Récupérer toutes les lignes de la table invoice
$sql = "SELECT * FROM devis ORDER BY SID DESC";
$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des devis</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.1/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript" src="script.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-0 py-3">
  <div class="container-xl">
    <!-- Navbar toggle -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Collapse -->
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <!-- Nav -->
      <div class="navbar-nav mx-lg-auto">
        <a class="nav-item nav-link" href="dashboardDevis.php">Devis</a>
        <a class="nav-item nav-link" href="index.php">Facture</a>
      </div>
    </div>
     <!-- Search box. -->
   <input type="text" id="search" placeholder="Search" />
  </div>
</nav>

<div class="container mt-4" id="couleur">
<h1 style="text-align: center;">LISTE DES DEVIS</h1>
    <a href="indexDevis.php" class="btn btn-primary">YENI DEVIS</a>
    <div id="display"></div>
    <table class="table">
        <thead>
        <tr>
            <th>Numéro du devis</th>
            <th>Date du devis</th>
            <th>Client</th>
            <th>Adresse</th>
            <th>Ville</th>
            <th>Montant total</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['DEVIS_NO']; ?></td>
                <td><?php echo $row['DEVIS_DATE']; ?></td>
                <td><?php echo $row['CNAME']; ?></td>
                <td><?php echo $row['CADDRESS']; ?></td>
                <td><?php echo $row['CCITY']; ?></td>
                <td><?php echo $row['GRAND_TOTAL']; ?> €</td>
                <td>
                    <a href="printDevis.php?id=<?php echo $row['SID']; ?>" class="btn btn-primary" target="_BLANK">Télécharger</a>
                    <form method="POST">
                        <input type="hidden" name="delete_sid" value="<?php echo $row['SID']; ?>">
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette facture ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>
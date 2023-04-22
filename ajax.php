<?php
//Including Database configuration file.
include "config.php";
//Getting value of "search" variable from "script.js".
if (isset($_POST['search'])) {
//Search box value assigning to $Name variable.
   $Name = $_POST['search'];
//Search query.
   $Query = "SELECT * FROM invoice WHERE CNAME LIKE '%$Name%' LIMIT 5";
//Query execution
   $ExecQuery = MySQLi_query($con, $Query);
//Creating unordered list to display result.
   echo '

   ';
   //Fetching result from database.
   while ($row = MySQLi_fetch_array($ExecQuery)) {
       ?>
<table class="table">
        <thead>
        <tr>
            <th>Numéro de facture</th>
            <th>Date de facture</th>
            <th>Client</th>
            <th>Adresse</th>
            <th>Ville</th>
            <th>Montant total</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = mysqli_fetch_assoc($ExecQuery)) { ?>
            <tr>
                <td><?php echo $row['INVOICE_NO']; ?></td>
                <td><?php echo $row['INVOICE_DATE']; ?></td>
                <td><?php echo $row['CNAME']; ?></td>
                <td><?php echo $row['CADDRESS']; ?></td>
                <td><?php echo $row['CCITY']; ?></td>
                <td><?php echo $row['GRAND_TOTAL']; ?> €</td>
                <td>
                    <a href="print.php?id=<?php echo $row['SID']; ?>" class="btn btn-primary" target="_BLANK">Télécharger</a>
                    <form method="POST">
                        <input type="hidden" name="delete_sid" value="<?php echo $row['SID']; ?>">
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette facture ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
   <?php
}


}
?>


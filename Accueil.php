
<?php
include 'connect.php';

$sql = "SELECT * FROM items";
$var = $conn->prepare($sql);
$var->execute();

$rows_produits = $var->fetchAll(PDO::FETCH_ASSOC);

?>


<h2>Produits</h2>
<table border="1px">
<thead>
    <tr>
        <th>References</th>
        <th>ItemFront</th>
        <th>ItemBack</th>
        <th>ItemLabel</th>
        <th>ItemPrice</th> 
        <th>Action</th>
    </tr>
</thead>
<tbody>
<?php foreach ($rows_produits as $rows): ?>
        <tr>
            <td><?php echo $rows['Reference']; ?></td>
            <td><img src="<?php echo $rows['ItemFront'];?>" alt=""></td>
            <td><img src="<?php echo $rows['ItemBack'];?>" alt=""></td>
            <td><?php echo $rows['ItemLabel']; ?></td>
            <td><?php echo $rows['ItemPrice']; ?>DH</td>
            <td>
                <a href="modifier.php?Reference=<?php echo $rows['Reference']; ?>"><img src="./images/MicrosoftTeams-image (4).png" alt="modifier" style="margin: 10px; height: 10px;"></a>
                <a href="supprimer.php?reference=<?php echo $rows['Reference']; ?>"><img src="./images/MicrosoftTeams-image (6).png" alt="supprimer" style="margin: 10px; height: 10px;"></a>

            </td>
        </tr> 
        <?php endforeach;?>
        <tr></tr>
    </tbody>
</table>
<?php
include 'config.php';


if(isset($_GET['sup'])){
    $id = $_GET['sup'];
    $sql2= "DELETE FROM `memoires` WHERE id='$id'";
    $stmt = $pdo->prepare($sql2);
    $stmt->execute();
    
}
?>

<!--
if ($domaine_filter) {
    $stmt->execute([$domaine_filter]);
} else {
   -->

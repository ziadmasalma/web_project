<?php
    include('db.php');
    $pdo=db_connect();
    $id=$_GET['id'];
    $sql = "DELETE FROM player WHERE TeamID = :teamID";
    $stm = $pdo->prepare($sql); 
    $stm->bindValue(':teamID', $id, PDO::PARAM_INT);
    $stm->execute();
    $sql = "DELETE FROM team WHERE TeamID = :teamID";
    $stm = $pdo->prepare($sql); 
    $stm->bindValue(':teamID', $id, PDO::PARAM_INT);
    $stm->execute();
    header("Location: dashbord.php");
?>
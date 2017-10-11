<?php
include "../include/connect_db.php";

$percent = $_POST['q'];

$sql = "UPDATE article SET saleAll=$percent";
$sth = $pdo->prepare($sql);
$sth->execute();
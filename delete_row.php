<?php
$connection = new PDO('mysql:host=localhost;dbname=classteacher;charset=utf8','root','root');
$connection->query("DELETE FROM groupevent WHERE pk_event=" . $_POST['pk'])->fetchAll(PDO::FETCH_ASSOC);
?>
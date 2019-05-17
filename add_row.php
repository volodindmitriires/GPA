<?php
$connection = new PDO('mysql:host=localhost;dbname=classteacher;charset=utf8','root','root');
$result = $connection->query("CALL add_event('','','" . $_POST['date'] . "',1,1,'',0);")->fetchAll(PDO::FETCH_ASSOC);
echo $result[0]["pk"]
?>
<!DOCTYPE html>

<?php
$connection = new PDO('mysql:host=localhost;dbname=classteacher;charset=utf8','root','root');
?>

<html lang="ru" >

<head>
  <meta charset="UTF-8">
  <title>Мероприятие</title>
</head>

<body>
<?php
echo "Дата проведения:<input name=\"c-date\" id=\"date\" value=\"" . $_GET["date"] . "\"><br/>";
echo "Место проведения:<input name=\"c-address\" id=\"address\" value=\"" . $_GET["address"] . "\"><br/>";
echo "Название мероприятие:<input name=\"c-name\" id=\"name\" value=\"" . $_GET["name"] . "\"><br/>";
echo "Уровень:<label name=\"c-level\" id=\"level\" value=\"" . $_GET["level"] . "\"><br/>";
echo "Результат участия:<input type=\"number\" maxlength=\"3\" name=\"c-prizePlace\" id=\"prizePlace\" value=\"" . $_GET["prizePlace"] . "\"><br/>";
// echo "Грамоты и дипломы:<input name=\"c-image\" id=\"image\" value=\"" . $_GET["image"] . "\"><br/>";
?>
<input type=submit name="Submit" value="Изменить">
</body>

</html>

<?php
if (isset($_POST["Submit"]))
{
  $pk = trim(htmlspecialchars($_GET["fk_level"]));
  $pk = trim(htmlspecialchars($_GET["pk"]));
  $date = trim(htmlspecialchars($_POST["c-date"]));
  $address = trim(htmlspecialchars($_POST["c-address"]));
  $name = trim(htmlspecialchars($_POST["c-name"]));
  $level = trim(htmlspecialchars($_POST["c-level"]));
  $prizePlace = trim(htmlspecialchars($_POST["c-prizePlace"]));
  // $image = trim(htmlspecialchars($_POST["c-image"]));

  $connection->query("UPDATE groupevent SET $pk,$name,$address,$date,@fk_level WHERE pk_event=$pk;")->fetchAll(PDO::FETCH_ASSOC);
  // $connection->query("UPDATE group_has_groupevent SET $prizePlace WHERE fk_group=@fk_group and fk_level=@fk_level;")->fetchAll(PDO::FETCH_ASSOC);
}
?>
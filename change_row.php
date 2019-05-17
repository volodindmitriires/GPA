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
<form action="change_row.php" method="post">
<?php
echo "<input name=\"c-pk\" id=\"pk\" value=\"" . $_GET["pk"] . "\" hidden>";
// echo "<input name=\"c-fk_level\" id=\"fk_level\" value=\"" . $_GET["fk_level"] . "\" hidden>";
echo "Дата проведения:<input name=\"c-date\" id=\"date\" value=\"" . $_GET["date"] . "\"><br/>";
echo "Место проведения:<input name=\"c-address\" id=\"address\" value=\"" . $_GET["address"] . "\"><br/>";
echo "Название мероприятие:<input name=\"c-name\" id=\"name\" value=\"" . $_GET["name"] . "\"><br/>";
?>
Уровень:<select name="c-fk_level">
  <option <?php if($_GET["fk_level"]==1) echo "selected";?> value="1">Областной</option>
  <option <?php if($_GET["fk_level"]==2) echo "selected";?> value="2">Международный</option>
  <option <?php if($_GET["fk_level"]==3) echo "selected";?> value="3">Городской</option>
  <option <?php if($_GET["fk_level"]==4) echo "selected";?> value="4">Федеральный</option>
</select><br/>
<?php
// echo "Уровень:<input name=\"c-level\" id=\"level\" value=\"" . $_GET["level"] . "\"><br/>";
echo "Результат участия:<input type=\"number\" maxlength=\"3\" name=\"c-prizePlace\" id=\"prizePlace\" value=\"" . $_GET["prizePlace"] . "\"><br/>";
// echo "Грамоты и дипломы:<input name=\"c-image\" id=\"image\" value=\"" . $_GET["image"] . "\"><br/>";
?>
<input type=submit name="Submit" value="Изменить">
</body>

</html>

<?php
if (isset($_POST["Submit"]))
{
  $fk_level = trim(htmlspecialchars($_POST["c-fk_level"]));
  $pk = trim(htmlspecialchars($_POST["c-pk"]));
  $date = trim(htmlspecialchars($_POST["c-date"]));
  $address = trim(htmlspecialchars($_POST["c-address"]));
  $name = trim(htmlspecialchars($_POST["c-name"]));
  $level = trim(htmlspecialchars($_POST["c-level"]));
  $prizePlace = trim(htmlspecialchars($_POST["c-prizePlace"]));
  // $image = trim(htmlspecialchars($_POST["c-image"]));
  $connection->query("UPDATE groupevent SET pk_event=$pk,name='$name',address='$address',date='$date',fk_level=$fk_level WHERE pk_event=$pk;")->fetchAll(PDO::FETCH_ASSOC);
  $connection->query("UPDATE group_has_groupevent SET prizePlace=$prizePlace WHERE fk_group=1 and fk_event=$pk;")->fetchAll(PDO::FETCH_ASSOC);
  echo "<script>window.location.href = \"index.php\"</script>";
}
?>

<!-- comm.CommandText = "UPDATE groupevent SET pk_event=@pk_event,name=@name,address=@address,date=@date,fk_level=@fk_level WHERE pk_event=@pk_event;";
comm.Parameters.Add("@pk_event", MySqlDbType.UInt32).Value = dr["pk_event"];
comm.Parameters.Add("@name", MySqlDbType.VarString).Value = dr["name"];
comm.Parameters.Add("@address", MySqlDbType.VarString).Value = dr["address"];
comm.Parameters.Add("@date", MySqlDbType.Date).Value = dr["date"];
comm.Parameters.Add("@fk_level", MySqlDbType.UInt32).Value = dr["fk_level"];
comm.ExecuteNonQuery();

comm.CommandText = "UPDATE group_has_groupevent SET prizePlace=@prizePlace WHERE fk_group=@fk_group and fk_level=@fk_level;";
comm.Parameters.Add("@prizePlace", MySqlDbType.UByte).Value = dr["prizePlace"];
comm.ExecuteNonQuery(); -->
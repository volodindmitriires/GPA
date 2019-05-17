<!DOCTYPE html>

<?php
$connection = new PDO('mysql:host=localhost;dbname=classteacher;charset=utf8','root','root');
?>

<html lang="ru" >

<head>
  <meta charset="UTF-8">
  <title>Мероприятия</title>




</head>

<body>

<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th>Номер</th>
			<th>Дата проведения</th>
			<th>Место проведения</th>
			<th>Название мероприятия</th>
			<th>Уровень</th>
			<th>Результат участия</th>
			<th>Грамоты и дипломы</th>
			<th>fk_level</th>
			<th style="text-align:center;width:100px;">Добавить запись<button type="button" data-func="dt-add" class="btn btn-success btn-xs dt-add">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
				</button></th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach($connection->query("SELECT groupevent.pk_event, groupevent.fk_level, groupevent.name, groupevent.address, groupevent.date, level.name as 'level_name', group_has_groupevent.prizePlace
			FROM groupevent INNER JOIN group_has_groupevent
			ON groupevent.pk_event = group_has_groupevent.fk_event
			INNER JOIN level ON groupevent.fk_level = level.pk_level
			WHERE group_has_groupevent.fk_group = 1")->fetchAll(PDO::FETCH_ASSOC) as $row)
			{
				echo "<tr>";
				echo "<td>" . $row['pk_event'] . "</td>";
				echo "<td>" . $row['date'] . "</td>";
				echo "<td>" . $row['address'] . "</td>";
				echo "<td>" . $row['name'] . "</td>";
				echo "<td>" . $row['level_name'] . "</td>";
				echo "<td>" . $row['prizePlace'] . "</td>";
				echo "<td></td>";
				echo "<td>" . $row['fk_level'] . "</td>";
				echo "<td>";
				echo "	<button type=\"button\" class=\"btn btn-primary btn-xs dt-edit\" style=\"margin-right:16px;\">";
				echo "		<span class=\"glyphicon glyphicon-pencil\" aria-hidden=\"true\"></span>";
				echo "	</button>";
				echo "	<button type=\"button\" class=\"btn btn-danger btn-xs dt-delete\">";
				echo "		<span class=\"glyphicon glyphicon-remove\" aria-hidden=\"true\"></span>";
				echo "	</button>";
				echo "</td>";
				echo "</tr>";
			}
		?>
	</tbody>
</table>

<!-- Modal -->
<!--<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">-->

    <!-- Modal content-->
    <!--<div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Информация</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
      </div>
    </div>

  </div>
</div>-->

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/autofill/2.3.3/css/autoFill.bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/colreorder/1.5.0/css/colReorder.bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/3.2.5/css/fixedColumns.bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.4/css/fixedHeader.bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/keytable/2.5.0/css/keyTable.bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.2/css/responsive.bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowgroup/1.1.0/css/rowGroup.bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.4/css/rowReorder.bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/scroller/2.0.0/css/scroller.bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.0/css/select.bootstrap.min.css"/>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/autofill/2.3.3/js/dataTables.autoFill.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/autofill/2.3.3/js/autoFill.bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/colreorder/1.5.0/js/dataTables.colReorder.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.2.5/js/dataTables.fixedColumns.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.4/js/dataTables.fixedHeader.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/keytable/2.5.0/js/dataTables.keyTable.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.2/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.2/js/responsive.bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/rowgroup/1.1.0/js/dataTables.rowGroup.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/rowreorder/1.2.4/js/dataTables.rowReorder.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/scroller/2.0.0/js/dataTables.scroller.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>



		<script src="js/date.format.js"></script>
    <script  src="js/index.js"></script>




</body>

</html>


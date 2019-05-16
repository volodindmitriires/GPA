$(document).ready(function() {
		//Only needed for the filename of export files.
		//Normally set in the title tag of your page.document.title = 'Simple DataTable';
		//Define hidden columns
		var hCols = [0];
		// DataTable initialisation
		$('#example').DataTable({
			"dom": "<'row'<'col-sm-4'B><'col-sm-2'l><'col-sm-6'p<br/>i>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-12'p<br/>i>>",
			"paging": true,
			"autoWidth": true,
			"columnDefs": [{
				"visible": false,
				"targets": hCols
			}],
			"language": {
				"lengthMenu": "Отображено _MENU_ записей на страницу",
				"zeroRecords": "Ничего не найдено",
				"info": "Показана страница _PAGE_ из _PAGES_",
				"infoEmpty": "Записи не найдены",
				"infoFiltered": "(отфильтровано _MAX_ всего записей)",
				"decimal": ",",
				"thousands": "."
			},
			"buttons": [{
				extend: 'colvis',
				collectionLayout: 'three-column',
				text: function() {
					var totCols = $('#example thead th').length;
					var hiddenCols = hCols.length;
					var shownCols = totCols - hiddenCols;
					return 'Колонок (' + shownCols + ' из ' + totCols + ')';
				},
				prefixButtons: [{
					extend: 'colvisGroup',
					text: 'Показать все',
					show: ':hidden'
				}, {
					extend: 'colvisRestore',
					text: 'Восстановить'
				}]
			}, {
				extend: 'collection',
				text: 'Экспорт',
				buttons: [{
						text: 'Excel',
						extend: 'excelHtml5',
						footer: false,
						exportOptions: {
							columns: ':visible'
						}
					}, {
						text: 'CSV',
						extend: 'csvHtml5',
						fieldSeparator: ';',
						exportOptions: {
							columns: ':visible'
						}
					}, {
						text: 'PDF Portrait',
						extend: 'pdfHtml5',
						message: '',
						exportOptions: {
							columns: ':visible'
						}
					}, {
						text: 'PDF Landscape',
						extend: 'pdfHtml5',
						message: '',
						orientation: 'landscape',
						exportOptions: {
							columns: ':visible'
						}
					}]
				}]
			,oLanguage: {
		oPaginate: {
			sNext: '<span class="pagination-default">&#x276f;</span>',
			sPrevious: '<span class="pagination-default">&#x276e;</span>'
		}
	}
		,"initComplete": function(settings, json) {
			// Adjust hidden columns counter text in button -->
			$('#example').on('column-visibility.dt', function(e, settings, column, state) {
				var visCols = $('#example thead tr:first th').length;
				//Below: The minus 2 because of the 2 extra buttons Show all and Restore
				var tblCols = $('.dt-button-collection li[aria-controls=example] a').length - 4;
				$('.buttons-colvis[aria-controls=example] span').html('Columns (' + visCols + ' of ' + tblCols + ')');
				e.stopPropagation();
			});
		}
	});
	//Add row button
	$('.dt-add').each(function () {
		$(this).on('click', function(evt){
			//Create some data and insert it
			var rowData = [];
			var table = $('#example').DataTable();
			//Store next row number in array
			var info = table.page.info();
			rowData.push(info.recordsTotal+1);
			var date = new Date();
			rowData.push(date);
			rowData.push('');
			rowData.push('');
			rowData.push('');
			rowData.push('');
			rowData.push('');
			rowData.push('<button type="button" class="btn btn-primary btn-xs dt-edit" style="margin-right:16px;"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button><button type="button" class="btn btn-danger btn-xs dt-delete"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>');
			//Looping over columns is possible
			//var colCount = table.columns()[0].length;
			//for(var i=0; i < colCount; i++){			}

			//INSERT THE ROW
			table.row.add(rowData).draw( false );
		});
	});
	//Edit row buttons
	$('.dt-edit').each(function () {
		$(this).on('click', function(evt){
			$this = $(this);
			var dtRow = $this.parents('tr');
			$('div.modal-body').innerHTML='';
			for(var i=0; i < dtRow[0].cells.length; i++){
				$('div.modal-body').append(dtRow[0].cells[i].innerHTML+'<br/>');
			}
			$('#myModal').modal('show');
		});
	});
	//Delete buttons
	$('.dt-delete').each(function () {
		$(this).on('click', function(evt){
			$this = $(this);
			var dtRow = $this.parents('tr');
			var table = $('#example').DataTable();
			$.ajax({
				data: 'pk=' + table.data()[dtRow[0].rowIndex-1][0],
				url: 'delete_row.php',
				method: 'POST', // or GET
				success: function(msg) {
					alert(msg);
					table.row(dtRow[0].rowIndex-1).remove().draw( false );
				}
			});
		});
	});
	$('#myModal').on('hidden.bs.modal', function (evt) {
		$('.modal .modal-body').empty();
	});
});
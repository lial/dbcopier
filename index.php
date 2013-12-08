<?php
/******
 * DB table fields Copier v.1.0
 * @Autor: Alex Lifantyev
 * @Email: al@arte.kz
 * This script can help you to transfer data between DBs with incompatible structures,
 * when you need to migrate from old version to new with semi-manual comparing mode.
 *****/

require_once('./config.php');

?>

<!DOCTYPE html>
<html>
<head>
	<title>DB table fields copier</title>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="row"><div class="col-sm-8 col-md-8 col-lg-8 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
			<div id="msg_error" class="alert alert-danger">
				<button class="close" aria-hidden="true" data-dismiss="alert" type="button">&times;</button>
			</div></div>
		</div>
		<form role="form"><div class="row">

<?php
$query = 'SHOW DATABASES';

// SOURCE
echo '<div class="col-sm-6 col-md-6 col-lg-6">';
echo '<h3>Source:</h3>';

$result = $mysqli->query($query);
$select = '';

echo '<div class="form-group"><label for="source_db">Select database</label><select id="source_db" class="form-control">';
if ($result) {
	while ($row = $result->fetch_array()) {
		$select = $select.'<option value="'.$row[0].'">'.$row['Database'].'</option>';
	}
} else {
	$select = '<option>User '.$db['user'].' has no privileges for databases</option>';
}
echo $select;
echo '</select></div>'; //form-group

echo '<div id="source_tables" class="form-group"><label for="source_table">Select table</label><select id="source_table" class="form-control">';
echo '</select></div>'; //form-group

echo '<div id="source_columns" class="form-group"><label for="source_column">Select column</label><select name="cs" id="source_column" class="form-control">';
echo '</select><button id="add" class="btn btn-default glyphicon glyphicon-plus"></button></div>'; //form-group
echo '</div>';


// DESTINATION
echo '<div class="col-sm-6 col-md-6 col-lg-6">';
echo '<h3>Destination:</h3>';

echo '<div class="form-group"><label for="destination_db">Select database</label><select id="destination_db" class="form-control">';

echo $select;
echo '</select></div>'; //form-group

echo '<div id="destination_tables" class="form-group"><label for="destination_table">Select table</label><select id="destination_table" class="form-control">';
echo '</select></div>'; //form-group

echo '<div id="destination_columns" class="form-group"><label for="destination_column">Select column</label><select name="ds" id="destination_column" class="form-control">';
echo '</select></div>'; //form-group
echo '</div>';

if ($mysqli) $mysqli->close();
?>
			</div> <!-- row -->
			<hr>
			<div class="row"><button id="submit" type="submit" class="btn btn-primary btn-lg">Copy from Source to Destination</button></div>
		</form>
	</div> <!-- container -->
	
	<script>
		$(function(){
			$('#source_tables, #source_columns, #destination_tables, #destination_columns, #msg_error').hide();
		});

		$('#msg_error').ajaxError(function(event, request, settings){
			$(this).apend('Error requesting page ' + settings.url);
		});
		
		$('button[type=submit]').click(function(b){b.preventDefault(); ajax_copy();});
		
		$('button#add').click(function(b){
			b.preventDefault();
			var $curr = $('button#add');
			$curr = $curr.prev();
			$curr.clone(true).insertBefore(this);
		});

		function row_copy(button) {
			var sel = button.clone(true);
			sel.insertAfter(button);
			//alert(this+'+ clicked')

		}

		function ajax_copy() {
			var b = $('button[type=submit]');
			b.prop('disabled', true);
			var dbs = $('#source_db option:selected').val();
			var dbd = $('#destination_db option:selected').val();
			var tbs = $('#source_table option:selected').val();
			var tbd = $('#destination_table option:selected').val();
			var cs = [];

			var columns = $('select[name=cs] option:selected');
			columns.each(function(i, el){
				cs.push(this.value);
			 });

			$.ajax({
				type: 'POST',
				cache: false,
				url: 'copy.php',
				data: {
					dbs: dbs, 
					dbd: dbd,
					tbs: tbs,
					tbd: tbd,
					cs: cs,
				},
				async: false,
				success: function(data){alert(data);
				}
				});
			b.prop('disabled', false);
		}

		//SOURCE
		$('#source_table').bind('change keydown', function(){
			$('#source_columns').show();
			var db = $('#source_db option:selected').val();
			var table = $('#source_table option:selected').val();
			var html = $.ajax({
  				url: 'query.php?db='+db+"&table="+table,
  				async: false
 				}).responseText;
			$('#source_column').html(html);
		});

		$('#source_db').bind('change keydown', function(){
			$('#source_tables').show();
			$('#source_column').empty();
			$('#source_columns').hide();
			var db = $('#source_db option:selected').val();
			$.ajax({
  				url: 'query.php?db='+db,
  				async: false,
  				success: function(data){$('#source_table').html(data);},
  				//error: function(data){$('#msg_error').prepend(data.responseText);$('#msg_error').removeClass('hidden');}
 				});
		});

		//DESTINATION
		$('#destination_table').bind('change keydown', function(){
			$('#destination_columns').show();
			var db = $('#destination_db option:selected').val();
			var table = $('#destination_table option:selected').val();
			var html = $.ajax({
  				url: 'query.php?direction=destination&db='+db+"&table="+table,
  				async: false
 				}).responseText;
			$('#destination_column').html(html);
		});

		
		$('#destination_db').bind('change keydown', function(){
			$('#destination_tables').show();
			$('#destination_column').empty();
			$('#destination_columns').hide();
			var db = $('#destination_db option:selected').val(); 
			var html = $.ajax({
  				url: 'query.php?direction=destination&db='+db,
  				async: false
 				}).responseText;
			$('#destination_table').html(html);
		});
	</script>
</body>
</hml>
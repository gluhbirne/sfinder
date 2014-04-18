<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>StoreFinder - Admin</title>
<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</head>

<body>
<?php
require_once('includes/php/database.php');
$connect = new StoreFinder\Database();
$result = $connect->get_stores();
if (count($result)) {
	echo '<table class="table table-hover" style="width:80%">';
	echo '<tr><td><strong>Name</strong></td><td><strong>Address</strong></td><td><strong>Commands</strong></td>';
	foreach($result as $row) {
	
		echo '<tr>';
		echo '<td>'.$row['name'].'</td>';
		echo '<td>'.$row['address'].'</td>';
		echo '<td>';
		echo '<a href="" class="btn btn-warning">Edit</a>';
		echo '&nbsp;&nbsp;';
		echo '<a href="" class="btn btn-danger">Delete</a>';
		echo '</td>';	
		echo '</tr>';
		
	}
	echo '</table>';
}
?>
</body>
</html>
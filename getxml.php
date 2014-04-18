<?php
namespace StoreFinder;

require_once('includes/php/database.php');

$connect = new Database();

// Get parameters from URL
if (isset($_GET) && !empty($_GET)) {
	$center_lat = $_GET["lat"];
	$center_lng = $_GET["lng"];
	$radius = $_GET["radius"];
}

// Start XML file, create parent node
$dom = new \DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

$result = $connect->get($center_lat,$center_lng,$radius);

if (count($result)) {
	header("Content-type: text/xml");
	foreach($result as $row) {
		$node = $dom->createElement("marker");
	    $newnode = $parnode->appendChild($node);
	    $newnode->setAttribute("name", $row['name']);
	    $newnode->setAttribute("address", $row['address']);
	    $newnode->setAttribute("lat", $row['lat']);
	    $newnode->setAttribute("lng", $row['lng']);
	    $newnode->setAttribute("distance", $row['distance']);
	}
	echo $dom->saveXML();
} 

?>
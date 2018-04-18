<?php
$username="root";
$password="";
$database="location";

function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}

// Start XML file, create parent node
$doc = new DOMDocument("1.0", "utf-8");
$node = $doc->createElement("markers");
$parnode = $doc->appendChild($node);


//Connect to database
try {
  $pdo = new PDO("mysql:host=localhost;dbname=restaurant", "root", "");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die($e->getMessage());
}

// Select all the rows in the markers table
$query = "SELECT * FROM store_locations WHERE 1";
$result = $pdo->query($query);

header("Content-type: text/xml");

// Start XML file, echo parent node
echo '<markers>';

// Iterate through the rows, printing XML nodes for each
while ($row = $result->fetch()){
  // Add to XML document node
  echo '<marker ';
  echo 'id="' . $row['StoreNumber'] . '" ';
  echo 'name="Three Guys" ';
  echo 'address="' . parseToXML($row['Address']) . '" ';
  echo 'lat="' . $row['Latitude'] . '" ';
  echo 'lng="' . $row['Longitude'] . '" ';
  echo 'type="r" ';
  echo '/>';
}

// End XML file
echo '</markers>';

?>

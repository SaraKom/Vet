<?php
	require "menu.php";

  require_once 'connect.php';
//12.

$sql = "SELECT jelleg, SUM(kezeles.dij) FROM kezelestipus INNER JOIN kezeles ON kezeles.kezelestipusId = kezelestipus.id GROUP BY jelleg ORDER BY SUM(kezeles.dij) DESC LIMIT 3 ";
$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
  echo "<table><tr><th>Kezelés tipus</th><th>Összesen</th></tr>";
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>".$row["jelleg"]."</td><td>".$row["SUM(kezeles.dij)"]."</td></tr>";
  }
  echo "</table>";
} else {
  echo "0 results";

  $result->free();

}

?>
  </main> 
<?php
	require "footer.php";
?>
<?php
	require "menu.php";

  require_once 'connect.php';
//14.
    $sql = "SELECT DISTINCT jelleg, ROUND(AVG(dij), 0) FROM kezelestipus INNER JOIN kezeles ON kezeles.kezelestipusId = kezelestipus.id GROUP BY jelleg ORDER BY jelleg ";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
      echo "<table><tr><th>Kezelés tipus</th><th>Átlagos díj</th></tr>";
      // output data of each row
      while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["jelleg"]."</td><td>".$row["ROUND(AVG(dij), 0)"]."</td></tr>";
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
<?php
	require "menu.php";

  require_once 'connect.php';
//13.
    $sql = "SELECT DISTINCT jelleg, dij FROM kezelestipus INNER JOIN kezeles ON kezeles.kezelestipusId = kezelestipus.id ORDER BY jelleg, dij";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
      echo "<table><tr><th>Kezelés tipus</th><th>Díj</th></tr>";
      // output data of each row
      while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["jelleg"]."</td><td>".$row["dij"]."</td></tr>";
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
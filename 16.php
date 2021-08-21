<?php
	require "menu.php";

  require_once 'connect.php';

//16.
    $sql = "SELECT nev, ROUND(AVG(dij), 0) FROM gazda INNER JOIN kutya ON kutya.gazdaId = gazda.id INNER JOIN kezeles ON kezeles.kutyaId = kutya.id GROUP BY gazda.id ORDER BY ROUND(AVG(dij), 0) ASC ";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
      echo "<table><tr><th>Gazda neve</th><th>Átlagos díj</th></tr>";
      // output data of each row
      while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["nev"]."</td><td>".$row["ROUND(AVG(dij), 0)"]."</td></tr>";
      }
      echo "</table>";
    } else {
      echo "0 results";
    
      $result->free();
    
    }

  $conn->close();
?>
  </main> 
<?php
	require "footer.php";
?>
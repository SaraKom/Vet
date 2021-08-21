<?php
	require "menu.php";

  require_once 'connect.php';
//15.

    $sql = "SELECT fajtanev, ROUND(AVG(dij), 0) FROM fajta INNER JOIN kutya ON kutya.fajtaId = fajta.id INNER JOIN kezeles ON kezeles.kutyaId = kutya.id GROUP BY fajtanev ORDER BY fajtanev";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
      echo "<table><tr><th>Kutyafajta</th><th>Átlagos díj</th></tr>";
      // output data of each row
      while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["fajtanev"]."</td><td>".$row["ROUND(AVG(dij), 0)"]."</td></tr>";
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
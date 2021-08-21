<?php
	require "menu.php";
  require_once 'connect.php';
    //4. feladat

    $sql = "SELECT COUNT(*), jelleg FROM kezeles INNER JOIN kezelestipus ON kezelestipus.id = kezeles.kezelestipusId GROUP BY kezelestipusId ORDER BY jelleg";
    $result = mysqli_query($conn, $sql);
    
    if ($result->num_rows > 0) {
      echo "<table><tr><th>Kezelés jellege</th><th>Darab</th></tr>";
      
      while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["jelleg"]."</td><td>".$row["COUNT(*)"]."</td></tr>";
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
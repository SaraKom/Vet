<?php
	require "menu.php";

  require_once 'connect.php';
//7. Melyik fajtára költöttek a legtöbbet? pl.:
  $sql ="SELECT fajtanev, COUNT(*), SUM(kezeles.dij) FROM fajta INNER JOIN kutya ON kutya.fajtaId = fajta.id INNER JOIN kezeles ON kezeles.kutyaId = kutya.id GROUP BY fajtanev ORDER BY SUM(kezeles.dij) DESC ";
  $result = mysqli_query($conn, $sql);
  
  if ($result->num_rows > 0) {
    echo "<table><tr><th>Fajta</th><th>Kezelések száma</th><th>Összesen</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "<tr><td>".$row["fajtanev"]."</td><td>".$row["COUNT(*)"]."</td><td>".$row["SUM(kezeles.dij)"]."</td></tr>";
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
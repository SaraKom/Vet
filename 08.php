<?php
	require "menu.php";

  require_once 'connect.php';
//8. Melyik gazda költötte a legtöbbet, legyen a lista az összegre rendezve?
  $sql="SELECT nev, SUM(kezeles.dij) FROM kutya INNER JOIN gazda ON gazda.id = kutya.gazdaId INNER JOIN kezeles ON kezeles.kutyaId = kutya.id GROUP BY gazdaId ORDER BY SUM(kezeles.dij) DESC ";
  $result = mysqli_query($conn, $sql);
  
  if ($result->num_rows > 0) {
    echo "<table><tr><th>Név</th><th>Összesen</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "<tr><td>".$row["nev"]."</td><td>".$row["SUM(kezeles.dij)"]."</td></tr>";
    }
    echo "</table>";
  } else {
    echo "0 results";

    $result->free();
  } 

  
require "footer.php";
?>
<?php
	require "index.php";

  require_once 'connect.php';
  //10.

  $sql = "SELECT nev, fajtanev FROM gazda INNER JOIN kutya ON kutya.gazdaId = gazda.id INNER JOIN fajta ON fajta.id = kutya.fajtaId ORDER BY nev ";
  $result = mysqli_query($conn, $sql);
    
  if ($result->num_rows > 0) {
    echo "<table><tr><th>Név</th><th>Kutya fajta</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "<tr><td>".$row["nev"]."</td><td>".$row["fajtanev"]."</td></tr>";
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
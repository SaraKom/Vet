<?php
	require "menu.php";
  require_once 'connect.php';

// 2. feladat

  $sql = "SELECT id, kezdet, veg, dij FROM `kezeles`";
  $result = mysqli_query($conn, $sql);


  if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Kezdet</th><th>Vég</th><th>Díj</th></tr>";
    
    while($row = $result->fetch_assoc()) {
      echo "<tr><td>".$row["id"]."</td><td>".$row["kezdet"]."</td><td>".$row["veg"]."</td><td>".$row["dij"]."</td></tr>";
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
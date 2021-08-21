<?php
	require "index.php";

  require_once 'connect.php';
   // 6.feladat 
  $name = $_POST['name'];

  $sql = "SELECT nev, COUNT(*), SUM(kezeles.dij) FROM gazda INNER JOIN kutya ON kutya.gazdaId = gazda.id INNER JOIN kezeles ON kezeles.kutyaId = kutya.id WHERE nev LIKE '$name%' GROUP BY nev ORDER BY SUM(kezeles.dij) DESC";
  $result = mysqli_query($conn, $sql);
    
    if ($result->num_rows > 0) {
      echo "<table><tr><th>Név</th><th>Kezelések száma</th><th>Összesen</th></tr>";
      
      while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["nev"]."</td><td>".$row["COUNT(*)"]."</td><td>".$row["SUM(kezeles.dij)"]."</td></tr>";
      }
      echo "</table>";
    } else {
      echo "<h4>Nincs ilyen nevű gazdánk.</h4>";;

      $result->free();
    } 
?> 
  </main>
<?php
	require "footer.php";
?>
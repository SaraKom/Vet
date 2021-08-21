<?php
	require "menu.php";
  
  require_once 'connect.php';
   //3. feladat !
  $dist = $_POST['dist'];
  $dist = filter_var ($dist,FILTER_VALIDATE_INT);
  if (filter_var($dist,FILTER_VALIDATE_INT) === FALSE) {
    echo "<h4>Nem jól adtad meg a kerület számát! Arab számokat használj!</h4>";
  }
  else{
  $sql = "SELECT * FROM `gazda` WHERE gazda.kerulet = $dist ORDER BY gazda.nev";
  $result = mysqli_query($conn, $sql);
 
   if ($result->num_rows > 0) {
     echo "<table><tr><th>Id</th><th>Gazda neve</th><th>Kerület</th></tr>";
     // output data of each row
     while($row = $result->fetch_assoc()) {
       echo "<tr><td>".$row["id"]."</td><td>".$row["nev"]."</td><td>".$row["kerulet"]."</td></tr>";
     }
     echo "</table>";
   } else {
     echo "<h4>A(z) $dist. kerületben egy gazdi sem lakik.</h4>";
 
     $result->free();
   }
  }
?>

</main> 
<?php
	require "footer.php";
?>
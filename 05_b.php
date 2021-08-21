<?php
	require "menu.php";
  ?>


  <?php
  require_once 'connect.php';

// 5.feladat
$date1 = $_POST['date1'];
$date2 = $_POST['date2'];

if ($date1 > $date2) {
  echo "<h4>Nem jól adta meg az időpontokat. Próbálja újra!</h4>";
}
else{
$sql = "SELECT kezelestipus.jelleg, kezeles.kezdet, kezeles.veg FROM kezeles INNER JOIN kezelestipus ON kezelestipus.id = kezeles.kezelestipusId WHERE kezdet >= '$date1' AND veg <= '$date2' AND jelleg LIKE '%gyógy%'";


$result = mysqli_query($conn, $sql);
 
 if ($result->num_rows > 0) {
   echo "<table><tr><th>Kezelés jellege</th><th>Kezdete</th><th>Vége</th></tr>";
   // output data of each row
   while($row = $result->fetch_assoc()) {
     echo "<tr><td>".$row["jelleg"]."</td><td>".$row["kezdet"]."</td><td>".$row["veg"]."</td></tr>";
   }
   echo "</table>";
 } else {
   echo "<h4>A megadott időszakban nem volt ilyen típusú beavatkozás.</h4>";

   $result->free();
 } 
}
 ?>

 </main> 
 <?php
	require "footer.php";
?>
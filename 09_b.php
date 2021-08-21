<?php
	require "menu.php";

  require_once 'connect.php';

//9. Bekérés nélkül! Be kell kérni a kutyák számát aminél többet dob ki! Hibakezelés: nem szám, nincs senkinek sem annyi kutyája

  $num = $_POST['num'];
  $num = filter_var ($num,FILTER_VALIDATE_INT);
  if (filter_var($num,FILTER_VALIDATE_INT) === FALSE) {
    echo "<h4>Nem jól adta meg a számot! Kérem, arab számokat használjon!</h4>";
  }
  else{
  $sql="SELECT nev, COUNT(gazdaId) FROM gazda INNER JOIN kutya ON kutya.gazdaId = gazda.id GROUP BY gazda.nev HAVING COUNT(gazdaId) > $num ORDER BY COUNT(gazdaId) DESC ";
  $result = mysqli_query($conn, $sql);
    
  if ($result->num_rows > 0) {
    echo "<table><tr><th>Név</th><th>Kutyák száma</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "<tr><td>".$row["nev"]."</td><td>".$row["COUNT(gazdaId)"]."</td></tr>";
    }
    echo "</table>";
  } else {
    echo "<h4>Ááá nincs senkinek sem $num-nál több kutyája. Adjon meg egy kisebb számot</h4>";

    $result->free();
  } 
}
?>

</main> 
<?php
	require "footer.php";
?>
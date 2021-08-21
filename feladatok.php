<?php
  require_once 'connect.php';

// 2. feladat SELECT id, kezdet, veg, dij FROM `kezeles` 

  $sql = "SELECT id, kezdet, veg, dij FROM `kezeles`";
  $result = mysqli_query($conn, $sql);


  if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Kezdet</th><th>Vég</th><th>Díj</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "<tr><td>".$row["id"]."</td><td>".$row["kezdet"]."</td><td>".$row["veg"]."</td><td>".$row["dij"]."</td></tr>";
    }
    echo "</table>";
  } else {
    echo "0 results";

    $result->free();
  }


  //3. feladat !!!! Bekérés nélkül! Be kell kérni a kerületet ! Hibakezelés: nem szám, nincs olyan kerület....

  $sql = "SELECT * FROM `gazda` WHERE gazda.kerulet = 10 ORDER BY gazda.nev";
  $result = mysqli_query($conn, $sql);

  if ($result->num_rows > 0) {
    echo "<table><tr><th>Id</th><th>Gazda neve</th><th>Kerület</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "<tr><td>".$row["id"]."</td><td>".$row["nev"]."</td><td>".$row["kerulet"]."</td></tr>";
    }
    echo "</table>";
  } else {
    echo "0 results";

    $result->free();
  }
  

  //4. feladat

  $sql = "SELECT COUNT(*), kezeles.kezelestipusId, jelleg FROM kezeles INNER JOIN kezelestipus ON kezelestipus.id = kezeles.kezelestipusId GROUP BY kezelestipusId";
  $result = mysqli_query($conn, $sql);
  
  if ($result->num_rows > 0) {
    echo "<table><tr><th>Id</th><th>Kezelés jellege</th><th>Darab</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "<tr><td>".$row["kezelestipusId"]."</td><td>".$row["jelleg"]."</td><td>".$row["COUNT(*)"]."</td></tr>";
    }
    echo "</table>";
  } else {
    echo "0 results";

    $result->free();
  }

  // 5.feladat Bekérés nélkül! Be kell kérni a dátumokat ! Hibakezelés: megfelelők legyenek a dátumok

 $sql = "SELECT kezelestipus.jelleg, kezeles.kezdet, kezeles.veg FROM kezeles INNER JOIN kezelestipus ON kezelestipus.id = kezeles.kezelestipusId WHERE kezdet >= '2017-10-10' AND veg <= '2017-11-10' AND jelleg LIKE '%gyógy%'";
 $result = mysqli_query($conn, $sql);
  
  if ($result->num_rows > 0) {
    echo "<table><tr><th>Kezelés jellege</th><th>Kezdete</th><th>Vége</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "<tr><td>".$row["jelleg"]."</td><td>".$row["kezdet"]."</td><td>".$row["veg"]."</td></tr>";
    }
    echo "</table>";
  } else {
    echo "0 results";

    $result->free();
  } 
  
 // 6.feladat Bekérés nélkül! Be kell kérni a dátumokat ! Hibakezelés: megfelelők legyenek a dátumokuuuuuuuu
 $sql = "SELECT nev, COUNT(*), SUM(kezeles.dij) FROM gazda INNER JOIN kutya ON kutya.gazdaId = gazda.id INNER JOIN kezeles ON kezeles.kutyaId = kutya.id WHERE nev LIKE 'Medgyessy%' GROUP BY nev ORDER BY SUM(kezeles.dij) DESC ";
 $result = mysqli_query($conn, $sql);
  
 if ($result->num_rows > 0) {
   echo "<table><tr><th>Név</th><th>Kezelések száma</th><th>Összesen</th></tr>";
   // output data of each row
   while($row = $result->fetch_assoc()) {
     echo "<tr><td>".$row["nev"]."</td><td>".$row["COUNT(*)"]."</td><td>".$row["SUM(kezeles.dij)"]."</td></tr>";
   }
   echo "</table>";
 } else {
   echo "0 results";

   $result->free();
 } 


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
  //echo'<pre>';
  //print_r($result);

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

//9. Bekérés nélkül! Be kell kérni a kutyák számát aminél többet dob ki! Hibakezelés: nem szám, nincs senkinek sem annyi kutyája

$sql="SELECT nev, COUNT(gazdaId) FROM gazda INNER JOIN kutya ON kutya.gazdaId = gazda.id GROUP BY gazda.nev HAVING COUNT(gazdaId) > 4 ORDER BY COUNT(gazdaId) DESC ";
$result = mysqli_query($conn, $sql);
  
if ($result->num_rows > 0) {
  echo "<table><tr><th>Név</th><th>Kutyák száma</th></tr>";
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>".$row["nev"]."</td><td>".$row["COUNT(gazdaId)"]."</td></tr>";
  }
  echo "</table>";
} else {
  echo "0 results";

  $result->free();
} 

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

//11,
$sql="SELECT jelleg, COUNT(kezeles.id) FROM kezelestipus INNER JOIN kezeles ON kezeles.kezelestipusId = kezelestipus.id GROUP BY jelleg ORDER BY COUNT(kezeles.id) DESC LIMIT 3";
$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
  echo "<table><tr><th>Kezelés tipus</th><th>összesen</th></tr>";
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>".$row["jelleg"]."</td><td>".$row["COUNT(kezeles.id)"]."</td></tr>";
  }
  echo "</table>";
} else {
  echo "0 results";

  $result->free();

}

//12.

  $sql = "SELECT jelleg, SUM(kezeles.dij) FROM kezelestipus INNER JOIN kezeles ON kezeles.kezelestipusId = kezelestipus.id GROUP BY jelleg ORDER BY COUNT(kezeles.dij) DESC LIMIT 3 ";
  $result = mysqli_query($conn, $sql);

  if ($result->num_rows > 0) {
    echo "<table><tr><th>Kezelés tipus</th><th>Összesen</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "<tr><td>".$row["jelleg"]."</td><td>".$row["SUM(kezeles.dij)"]."</td></tr>";
    }
    echo "</table>";
  } else {
    echo "0 results";
  
    $result->free();
  
  }

  //13.
    $sql = "SELECT DISTINCT jelleg, dij FROM kezelestipus INNER JOIN kezeles ON kezeles.kezelestipusId = kezelestipus.id ORDER BY jelleg, dij";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
      echo "<table><tr><th>Kezelés tipus</th><th>Díj</th></tr>";
      // output data of each row
      while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["jelleg"]."</td><td>".$row["dij"]."</td></tr>";
      }
      echo "</table>";
    } else {
      echo "0 results";
    
      $result->free();
    
    }

    //14.
    $sql = "SELECT DISTINCT jelleg, ROUND(AVG(dij), 0) FROM kezelestipus INNER JOIN kezeles ON kezeles.kezelestipusId = kezelestipus.id GROUP BY jelleg ORDER BY jelleg ";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
      echo "<table><tr><th>Kezelés tipus</th><th>Átlagos díj</th></tr>";
      // output data of each row
      while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["jelleg"]."</td><td>".$row["ROUND(AVG(dij), 0)"]."</td></tr>";
      }
      echo "</table>";
    } else {
      echo "0 results";
    
      $result->free();
    
    }

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

//16.
    $sql = "SELECT nev, ROUND(AVG(dij), 0) FROM gazda INNER JOIN kutya ON kutya.gazdaId = gazda.id INNER JOIN kezeles ON kezeles.kutyaId = kutya.id GROUP BY gazda.id ORDER BY `gazda`.`id` ASC ";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
      echo "<table><tr><th>Gazda neve</th><th>Átlagos díj</th></tr>";
      // output data of each row
      while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["nev"]."</td><td>".$row["ROUND(AVG(dij), 0)"]."</td></tr>";
      }
      echo "</table>";
    } else {
      echo "0 results";
    
      $result->free();
    
    }

  $conn->close();
?>



<?php
	require "menu.php";
?>



<form action="05_b.php" method="POST">
Adja meg a kezelés kezdetének és végének dátumát: <br> <input type="date" name="date1"><br> <input type="date" name="date2"><br>
<button type="submit">Küldés</button>
</form>
</main>


<?php
	require "footer.php";
?>
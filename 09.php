<?php
	require "menu.php";
?>



<form action="09_b.php" method="POST">
Adja meg, hogy mennyinél több kutyával rendelkező gazdákra kiváncsi: <input type="int" name="num"><br>
<button type="submit">Küldés</button>
</form>

<?php
require "footer.php";
?>
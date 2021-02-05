<?php

$id = $_GET['pes'];

$pes = $spravce->vyberPodleId($id);

$matka = $spravce->najdiMatku($id);

$otec = $spravce->najdiOtce($id);

?>

<div class="gallery">

<h2 class="text-center"><?= $pes['jmeno'] . " " . $pes['stanice']; ?></h2>
<ul type="none">
<li><p class="description"><strong>Výška: </strong><?= $pes['vyska']; ?> cm</p> </li>
<li><p class="description"><strong>Otec: </strong><?= $otec['jmeno'] . " " . $otec['stanice']; ?> </p> </li>
<li><p class="description"><strong>Matka: </strong><?= $matka['jmeno'] . " " . $matka['stanice']; ?> </p> </li>
<li><p class="description"><strong>Bonitační kód: </strong><?= $pes['bonitacni_kod']; ?> </p> </li>
</ul>

<div>
<img id="hlava"  src="images/<?= $id ?>_hlava.jpg" alt="hlava psa">
<img id="postoj" src="images/<?= $id ?>_postoj.jpg" alt="postoj psa">
</div>

<a onClick="history.back()" class="submit-button text-center" style="text-decoration:none; margin:2.125rem auto 0 auto; width:100%">Zpět</a>   

<a href="index.php" class="submit-button text-center" style="text-decoration:none; margin:2.125rem auto 0 auto; width:100%">Nové hledání</a>   
</div>

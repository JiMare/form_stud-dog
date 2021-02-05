
<div class="gallery">

    <?php  

    $spravce->vypisNepribuznePsy($fena->getPredci());
   
    $spravce->finalniFiltr($vyskaFeny, $okoFeny, $skusFeny, $zubyFeny, $whiteFeny, $povahaFeny, $dkkFeny, $dlkFeny, $stavbaFeny, $fena->getPredci());

    ?>

    <br><hr>

    <a onClick="history.back()" class="submit-button text-center" style="text-decoration:none; margin:2.125rem auto 0 auto; width:100%">Zpět</a>   

    <a href="index.php" class="submit-button text-center" style="text-decoration:none; margin:2.125rem auto 0 auto; width:100%">Nové hledání</a> 
    
</div>


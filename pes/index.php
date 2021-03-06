<?php
 
 function nactiTridu($trida){
     require "tridy/$trida.php";
 }

 spl_autoload_register('nactiTridu');

 Databaze::pripoj('localhost', 'root', '', 'psi');

 $spravce = new SpravcePsu();

 if($_POST){
     $jmeno = htmlspecialchars($_POST['jmeno']);
     $staniceFeny = htmlspecialchars($_POST['staniceFeny']);
     $vyskaFeny = htmlspecialchars($_POST['vyska']);
     $okoFeny = $_POST['barva-oka'];
     $skusFeny = $_POST['skus'];
     $zubyFeny = $_POST['zuby'];
     $stavbaFeny = $_POST['stavba'];
     $whiteFeny = $_POST['white'];
     $povahaFeny = $_POST['povaha'];
     $dkkFeny = $_POST['dkk'];
     $dlkFeny = $_POST['dlk'];

     $fena = new Fena(htmlspecialchars($_POST['otec']),htmlspecialchars($_POST['matka']),
                      htmlspecialchars($_POST['staniceOtce']), htmlspecialchars($_POST['staniceMatky']));
 }

?>

<!DOCTYPE html>
<html lang="cz">

<?php require 'formPage/head.php'; ?>

<body>
<div class="container">

  <?php if(!$_POST){
     if(isset($_GET['pes'])){
      require 'kartaPage/header.php';
      require 'kartaPage/kartaPsa.php';
     }else{
      require 'formPage/header.php';
      require 'formPage/form.php';
     }
   }else{
    require 'filterPage/header.php';
    require 'filterPage/psi.php';
   } ?>  

</div>

</body>
</html>

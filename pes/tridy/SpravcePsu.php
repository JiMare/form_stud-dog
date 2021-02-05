<?php

class SpravcePsu{

    //vytvoří pole Id všech psů
    public function getIdVsechPsu(){
        $vysledek = Databaze::dotaz('
        SELECT `kryci_psi_id` FROM `kryci_psi`
        ');
        $data = $vysledek->fetchAll();
        for($i = 0; $i < count($data);$i++){
            $idPsu[] = $data[$i]['kryci_psi_id']; 
        }
        return $idPsu;
    }

    //vybere psa podle jeho Id
    public function vyberPodleId($id){
        $vysledek = Databaze::dotaz('SELECT * FROM `kryci_psi` WHERE `kryci_psi_id`=?',
        array($id));
        $data = $vysledek->fetch();
        return $data;
    }


    //funkce s tematikou rodokmenů
    //vytvoří pole Id nepříbuzných psů
    public function vyberNepribuzne($predciIdFeny){
        $idPsu = $this->getIdVsechPsu();
        if($predciIdFeny){
        for($i=0; $i < count($idPsu);$i++){
            $predciIdPsa = $this->getPredciPsa($idPsu[$i]);
            if(!array_intersect($predciIdPsa, $predciIdFeny)){
                $nepribuzniPsi[] = $idPsu[$i];
            }
        }
        return $nepribuzniPsi;
        }
        else{
            return $idPsu;
        }   
    }

    //vypíše nepříbuzné psy
    public function vypisNepribuznePsy($predciIdFeny){
    
        if($predciIdFeny){
        echo '<h3 class="text-center">Všichni nepříbuzní psi:</h3>';
        }
        else{
            echo '<h3 class="text-center">Předci vaší feny nebyli nalezeni v databázi, výběr tak bude probíhat ze všech psů v databázi: </h3>';
        }
        foreach($this->vyberNepribuzne($predciIdFeny) as $id){
            echo '<p class="text-center">' . $this->vyberPodleId($id)['jmeno'] . " " . $this->vyberPodleId($id)['stanice'] .'</p>';
        }
        
        echo '<br><hr>';
    }

    //vybere Id předků ze strany matky včetně matky
    public function getrodokmenMatkyPsa($id){
        $vysledek = Databaze::dotaz('WITH RECURSIVE ancestors AS (
        SELECT * FROM `predci` WHERE `predci_id`=?
        UNION SELECT p.* FROM `predci` AS p, ancestors AS a WHERE
        p.`predci_id` = a.`otec_id` OR p.`predci_id` = a.`matka_id` )
        SELECT `predci_id` FROM ancestors', array($this->najdiMatku($id)['predci_id']));
        $data = $vysledek->fetchAll();
        return $data;
    }

    //vybere Id předků ze strany otce včetně otce
    public function getrodokmenOtcePsa($id){
        $vysledek = Databaze::dotaz('WITH RECURSIVE ancestors AS (
        SELECT * FROM `predci` WHERE `predci_id`=?
        UNION SELECT p.* FROM `predci` AS p, ancestors AS a WHERE
        p.`predci_id` = a.`otec_id` OR p.`predci_id` = a.`matka_id` )
        SELECT `predci_id` FROM ancestors', array($this->najdiOtce($id)['predci_id']));
        $data = $vysledek->fetchAll();
        return $data;
    }

    //spojí pole předků obou rodičů a vrací jejich Id
    public function getPredciPsa($id){
        $predci = array_merge($this->getrodokmenMatkyPsa($id), $this->getRodokmenOtcePsa($id));
        for($i=0;$i < count($predci);$i++){
            $predciId[] = $predci[$i]['predci_id'];
        }
        return $predciId;
    }

    public function najdiMatku($id){
        $vysledek = Databaze::dotaz('
        SELECT * FROM `kryci_psi` JOIN `predci` ON `predci`.`predci_id` = `kryci_psi`.`matka_id` WHERE `kryci_psi_id`=?
        ', array($id));
        $matka = $vysledek->fetch();
        return $matka;
    }

    public function najdiOtce($id){
        $vysledek = Databaze::dotaz('
        SELECT * FROM `kryci_psi` JOIN `predci` ON `predci`.`predci_id` = `kryci_psi`.`otec_id` WHERE `kryci_psi_id`=?
        ', array($id));
        $otec = $vysledek->fetch();
        return $otec;
    }

    
    //finkce, které filtrují podle zadaných kriterií 
    public function vyberPodleStavby($stavbaFeny){
        if(count($stavbaFeny) == 1 && $stavbaFeny[0] == 'A'){
            $vysledek = Databaze::dotaz('SELECT * FROM `kryci_psi`');  
        }   
    else{
        if(count($stavbaFeny) == 2){
        $vysledek = Databaze::dotaz('SELECT * FROM `kryci_psi` WHERE `stavba` NOT LIKE "%' . $stavbaFeny[1] . '%"');
        }
        else{
            for($i = 1; $i < count($stavbaFeny); $i++){
            $dotaz[] = 'SELECT `kryci_psi_id` FROM `kryci_psi` WHERE `stavba` NOT LIKE "%' . $stavbaFeny[$i] . '%"';
                }
                
            for($i = 0; $i < count($dotaz); $i++){
            $vysledekId[$i] = Databaze::dotaz($dotaz[$i]); 
            $dataId[$i] = $vysledekId[$i]->fetchAll(); 
                }

                for($j=0;$j < count($dataId);$j++){  
                for($i=0; $i < count($dataId[$j]); $i++){
                    $psiId[$j][$i] =  $dataId[$j][$i]['kryci_psi_id'];
                }
                }  
    
                $psi = array_intersect($psiId[0], $psiId[1]);  
                if(count($psiId) == 2){
                    $vysledek = Databaze::dotaz('SELECT * FROM `kryci_psi` WHERE `kryci_psi_id` IN (' . implode(",", $psi) . ')');
                }
                else{
                for($i = 2; $i < count($psiId); $i++){
                        $psi = array_intersect($psi, $psiId[$i]);
                    }
                    if($psi){
                    $vysledek = Databaze::dotaz('SELECT * FROM `kryci_psi` WHERE `kryci_psi_id` IN (' . implode(",", $psi) . ')');
                    }
                }  
            } 
        }
        if(isset($vysledek)){
        $data = $vysledek->fetchAll();
        return $data;
        }
    }

    public function vyberPodleVysky($vyskaFeny){
        if($vyskaFeny <= 63){
        $vysledek = Databaze::dotaz('
        SELECT * FROM `kryci_psi` WHERE `vyska` >= 68');
        }
        elseif($vyskaFeny > 66){
            $vysledek = Databaze::dotaz('
            SELECT * FROM `kryci_psi` WHERE `vyska` < 69');
        }
        else{
            $vysledek = Databaze::dotaz('
        SELECT * FROM `kryci_psi` WHERE `vyska` >= 65 AND `vyska` <= 72');
        }
    $data = $vysledek->fetchAll();
    return $data;
        
    }

    public function vyberPodleBarvyOka($okoFeny){
        if($okoFeny >= 4 && $okoFeny <=6){
            $okoPsa = implode(",",range(0,3));
        }
        else{
            $okoPsa = implode("," , range(0,6));
        
        }
        $vysledek = Databaze::dotaz('
        SELECT * FROM `kryci_psi` WHERE `barva_oka` IN (' . $okoPsa . ')');
        $data = $vysledek->fetchAll();
        return $data;
    }

    public function vyberPodleSkusu($skusFeny){
        if($skusFeny > 5){
            $dotaz = 'SELECT * FROM `kryci_psi` WHERE `skus`< 6';
        }
        elseif($skusFeny == 4){
            $dotaz = 'SELECT * FROM `kryci_psi` WHERE `skus` > 4';
        }
        else{
            $dotaz = 'SELECT * FROM `kryci_psi`';
        }
        $vysledek = Databaze::dotaz($dotaz);
        $data = $vysledek->fetchAll();
        return $data;
    }

    public function vyberPodleChybejicichzubu($zubyFeny){
        if($zubyFeny == 0){
            $dotaz = 'SELECT * FROM `kryci_psi`';
        }
        else{
            $dotaz = 'SELECT * FROM `kryci_psi` WHERE `chybi_zuby` = 0';
        } 
        $vysledek = Databaze::dotaz($dotaz);
        $data = $vysledek->fetchAll();
        return $data;
    }

    public function vyberPodleBile($whiteFeny){
        if($whiteFeny == 2 || $whiteFeny == 3){
            $dotaz = 'SELECT * FROM `kryci_psi` WHERE `bile_znaky` IN (5,6,7)';
        }
        elseif($whiteFeny == 4){
            $dotaz = 'SELECT * FROM `kryci_psi` WHERE `bile_znaky` IN (4,5,6,7)';
        }
        elseif($whiteFeny == 5){
            $dotaz = 'SELECT * FROM `kryci_psi` WHERE `bile_znaky` IN (4,5,6)';
        }
        else{
            $dotaz = 'SELECT * FROM `kryci_psi` WHERE `bile_znaky` IN (2,3,4,5)';
        }
        $vysledek = Databaze::dotaz($dotaz);
        $data = $vysledek->fetchAll();
        return $data;
    }

    public function vyberPodlePovahy($povahaFeny){
        if($povahaFeny < 5){
            $dotaz = 'SELECT * FROM `kryci_psi` WHERE `povaha` IN (5,6,7,8)';
        }
        elseif($povahaFeny > 6){
            $dotaz = 'SELECT * FROM `kryci_psi` WHERE `povaha` IN (4,5,6)';
        }
        else{
            $dotaz = 'SELECT * FROM `kryci_psi` WHERE `povaha` IN (4,5,6,7)';
        }
        $vysledek = Databaze::dotaz($dotaz);
        $data = $vysledek->fetchAll();
        return $data;
    }

    public function vyberPodleDkk($dkkFeny){
        if($dkkFeny == 'C'){
            $dotaz = 'SELECT * FROM `kryci_psi` WHERE `dkk` = A';
        }
        elseif($dkkFeny == 'B'){
            $dotaz = 'SELECT * FROM `kryci_psi` WHERE `dkk` IN (A,B)';
        }
        else{
            $dotaz = 'SELECT * FROM `kryci_psi`';
        }
        $vysledek = Databaze::dotaz($dotaz);
        $data = $vysledek->fetchAll();
        return $data;
    }

    public function vyberPodleDlk($dlkFeny){
        if($dlkFeny > 0){
            $dotaz = 'SELECT * FROM `kryci_psi` WHERE `dlk` = 0';
        }
        else{
            $dotaz = 'SELECT * FROM `kryci_psi`';
        }
        $vysledek = Databaze::dotaz($dotaz);
        $data = $vysledek->fetchAll();
        return $data;
    }
    
    //vybere kombinaci podle všech filtrů
    public function filtruj($vyskaFeny, $okoFeny, $skusFeny, $zubyFeny, $whiteFeny, $povahaFeny, $dkkFeny, $dlkFeny, $stavbaFeny, $predciFeny){

    // vytvářím pole Id psů vybraných podle daných filtrů

        $psiFiltrVyska = $this->vyberPodleVysky($vyskaFeny);
        for($i=0; $i < count($psiFiltrVyska); $i++){
            $psiFiltrVyskaId[] = $psiFiltrVyska[$i]['kryci_psi_id'];
        }
        $psiFiltrBarvaOka = $this->vyberPodleBarvyOka($okoFeny);
        for($i=0; $i < count($psiFiltrBarvaOka); $i++){
            $psiFiltrBarvaOkaId[] = $psiFiltrBarvaOka[$i]['kryci_psi_id'];
        }
        $psiFiltrSkus = $this->vyberPodleSkusu($skusFeny);
        for($i=0; $i < count($psiFiltrSkus); $i++){
            $psiFiltrSkusId[] = $psiFiltrSkus[$i]['kryci_psi_id'];
        }
        $psiFiltrZuby = $this->vyberPodleChybejicichzubu($zubyFeny);
        for($i=0; $i < count($psiFiltrZuby); $i++){
            $psiFiltrZubyId[] = $psiFiltrZuby[$i]['kryci_psi_id'];
        }
        $psiFiltrBila = $this->vyberPodleBile($whiteFeny);
        for($i=0; $i < count($psiFiltrBila); $i++){
            $psiFiltrBilaId[] = $psiFiltrBila[$i]['kryci_psi_id'];
        }
        $psiFiltrPovaha = $this->vyberPodlePovahy($povahaFeny);
        for($i=0; $i < count($psiFiltrPovaha); $i++){
            $psiFiltrPovahaId[] = $psiFiltrPovaha[$i]['kryci_psi_id'];
        }
        $psiFiltrDkk = $this->vyberPodleDkk($dkkFeny);
        for($i=0; $i < count($psiFiltrDkk); $i++){
            $psiFiltrDkkId[] = $psiFiltrDkk[$i]['kryci_psi_id'];
        }
        $psiFiltrDlk = $this->vyberPodleDlk($dlkFeny);
        for($i=0; $i < count($psiFiltrDlk); $i++){
            $psiFiltrDlkId[] = $psiFiltrDlk[$i]['kryci_psi_id'];
        }
        $psiFiltrStavba = $this->vyberPodleStavby($stavbaFeny);
        for($i=0; $i < count($psiFiltrStavba); $i++){
            $psiFiltrStavbaId[] = $psiFiltrStavba[$i]['kryci_psi_id'];
        }
        
        //filtruji průniky polí Id psů 

        $psi = $this->vyberNepribuzne($predciFeny);
        $psi = array_intersect($psi, $psiFiltrVyskaId);
        $psi = array_intersect($psi, $psiFiltrBarvaOkaId);
        $psi = array_intersect($psi, $psiFiltrSkusId);
        $psi = array_intersect($psi, $psiFiltrZubyId);
        $psi = array_intersect($psi, $psiFiltrBilaId);
        $psi = array_intersect($psi, $psiFiltrPovahaId);
        $psi = array_intersect($psi, $psiFiltrDkkId);
        $psi = array_intersect($psi, $psiFiltrDlkId);
        $psi = array_intersect($psi, $psiFiltrStavbaId);
        
        //pokud je nějaký výsledek, vybírám z databáze
        if($psi){
        $psi  = implode(",", $psi);

        $vysledek = Databaze::dotaz('SELECT * FROM `kryci_psi` WHERE `kryci_psi_id` IN (' . $psi .')');
        $data = $vysledek->fetchAll();
        return $data;
        }
    }
   
    //vypíše výsledek kombinace vššech filtrů nebo informuje o neúspěšném hledání
    public function finalniFiltr($vyskaFeny, $okoFeny, $skusFeny, $zubyFeny, $whiteFeny, $povahaFeny, $dkkFeny, $dlkFeny, $stavbaFeny, $predciFeny){
        if($this->filtruj($vyskaFeny, $okoFeny, $skusFeny, $zubyFeny, $whiteFeny, $povahaFeny, $dkkFeny, $dlkFeny, $stavbaFeny, $predciFeny)){
            echo '<h3 class="text-center" style="margin: 5 auto">Finální výběr:</h3>';
            foreach($this->filtruj($vyskaFeny, $okoFeny, $skusFeny, $zubyFeny, $whiteFeny, $povahaFeny, $dkkFeny, $dlkFeny, $stavbaFeny, $predciFeny) as $pes){
                echo '<a class="submit-button text-center" style="text-decoration:none; margin:2.125rem auto 0 auto; width:100%" href="index.php?pes=' . $pes['kryci_psi_id']  . '">' . $pes['jmeno'] . " " . $pes['stanice']  ."</a>";       
            }
        
            }else{
                echo '<p class="text-center">Na základě důkladné analýzy chytrý formulář bohužel v naší databázi nenašel žádného vhodného kandidáta ke krytí vaší fenky. 
                Vyberte dle svého uvážení z nepříbuzných psů nebo se poohlédněte jinde.</p>';
            }
        }

}
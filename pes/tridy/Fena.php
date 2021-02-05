<?php

class Fena{

    /** @var string */
    public $jmenoMatky;
    
    /** @var string */
    public $jmenoOtce;

    /** @var string */
    public $staniceMatky;

    /** @var string */
    public $staniceOtce;

    public function __construct(string $jmenoOtce, string $jmenoMatky, string $staniceOtce, string $staniceMatky){
        $this->jmenoOtce = $jmenoOtce;
        $this->jmenoMatky = $jmenoMatky;
        $this->staniceOtce = $staniceOtce;    
        $this->staniceMatky = $staniceMatky;
    }

    public function getIdMatky(){
      $vysledek = Databaze::dotaz('SELECT `predci_id` FROM `predci` WHERE CONCAT (`jmeno`, `stanice`) = CONCAT (?, ?)',
      array($this->jmenoMatky, $this->staniceMatky));
      $data = $vysledek->fetch();
      if($data){
      return $data['predci_id'];
      }
    }

    public function getIdOtce(){
        $vysledek = Databaze::dotaz('SELECT `predci_id` FROM `predci` WHERE CONCAT (`jmeno`, `stanice`) = CONCAT (?, ?)',
        array($this->jmenoOtce, $this->staniceOtce));
        $data = $vysledek->fetch();
        if($data){
        return $data['predci_id'];
        }
      }

    public function getRodokmenMatky(){
        $vysledek = Databaze::dotaz('WITH RECURSIVE ancestors AS (
          SELECT * FROM `predci` WHERE `predci_id`=?
          UNION SELECT p.* FROM `predci` AS p, ancestors AS a WHERE
          p.`predci_id` = a.`otec_id` OR p.`predci_id` = a.`matka_id` )
          SELECT `predci_id` FROM ancestors', array($this->getIdMatky()));
          $data = $vysledek->fetchAll();
        return $data;
      }

    public function getRodokmenOtce(){
        $vysledek = Databaze::dotaz('WITH RECURSIVE ancestors AS (
          SELECT * FROM `predci` WHERE `predci_id`=?
          UNION SELECT p.* FROM `predci` AS p, ancestors AS a WHERE
          p.`predci_id` = a.`otec_id` OR p.`predci_id` = a.`matka_id` )
          SELECT `predci_id` FROM ancestors', array($this->getIdOtce()));
          $data = $vysledek->fetchAll();
        return $data;
      }
      
    public function getPredci(){
        $predci = array_merge($this->getRodokmenMatky(), $this->getRodokmenOtce());
        $predciId = [];
        for($i=0;$i < count($predci);$i++){
          $predciId[] = $predci[$i]['predci_id'];
        } 
      return $predciId;
      }

}
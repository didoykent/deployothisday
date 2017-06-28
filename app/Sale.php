<?php

 namespace App;

 class Sale{

public $saleItems = null;
public $getPercent = null;
public $withsale = null;

   public function saleItems( $sale, $zodiac){

  $this->saleItems = $sale;

  $this->withsale = $this->saleItems / 100;

  $this->getPercent = $zodiac * $this->withsale;




   }


 }

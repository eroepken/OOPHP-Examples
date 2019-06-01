<?php

/**
 * House can now only be extended; it cannot be instantiated.
 */
abstract class House {
  protected $marketVal;
  protected $beds;
  protected $baths;
  protected $floors;
  protected $isForSale;
  /**
   * New property that's being overridden in children.
   */
  protected $niceName = 'house';

  public function __construct(float $marketVal, int $floors, int $beds, float $baths) {
    $this->marketVal = $marketVal;
    $this->floors = $floors;
    $this->beds = $beds;
    $this->baths = $baths;
  }

  public function setMarketVal(float $marketVal) {
    $this->marketVal = $marketVal;
  }

  public function listForSale() {
    $this->isForSale = true;
  }

  public function showHouse() {
    printf("This %s has %s floor(s), %d bedroom(s), and %.2f bathroom(s). ", $this->niceName, $this->floors, $this->beds, $this->baths);

    if ($this->isForSale) {
      print "It is for sale! ";
    }

    printf("The market value is $%s.", number_format($this->marketVal));
    print "\n\n";
  }
}

final class Ranch extends House {
  /**
   * Overriding the default $niceName.
   */
  protected $niceName = 'ranch';

  /**
   * Overriding the default constructor, because we can assume a Ranch style house has one floor.
   */
  public function __construct(float $marketVal, int $beds, float $baths) {
    parent::__construct($marketVal, 1, $beds, $baths);
  }

  public function buildUp(int $addBeds = 0, int $addBaths = 0) {
    $this->floors++;
    $this->beds += $addBeds;
    $this->baths += $addBaths;
    $addValue = 50000 + ($addBeds * 10000) + ($addBaths * 5000);
    $this->setMarketVal($this->marketVal + $addValue);
  }
}

final class HighRanch extends House {
  /**
   * Overriding the default $niceName.
   */
  protected $niceName = 'high ranch';

  /**
   * Overriding the default constructor, because we can assume a High Ranch style house has two
   * floors.
   */
  public function __construct(float $marketVal, int $beds, float $baths) {
    parent::__construct($marketVal, 2, $beds, $baths);
  }
}

$my_house = new Ranch(500000, 3, 1.75);
$my_house->showHouse();

$neighboring_house = new HighRanch(650000, 4, 2);
$neighboring_house->listForSale();
$neighboring_house->showHouse();

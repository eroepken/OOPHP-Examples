<?php

/**
 * Our base House class again, which can still be extended or instantiated.
 */
class House {
  /**
   * Protected, so these are now inherited by child classes.
   * (See: https://www.php.net/manual/en/language.oop5.visibility.php)
   */
  protected $marketVal;
  protected $beds;
  protected $baths;
  protected $floors;
  protected $isForSale;

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
    printf("This house has %s floor(s), %d bedroom(s), and %.2f bathroom(s). ", $this->floors, $this->beds, $this->baths);

    if ($this->isForSale) {
      print "It is for sale! ";
    }

    printf("The market value is $%s.", number_format($this->marketVal));
    print "\n\n";
  }
}

/**
 * A new type of house, Ranch that's inheriting properties and functionality from House.
 * (See: https://www.php.net/manual/en/language.oop5.inheritance.php)
 */
class Ranch extends House {
  public function buildUp(int $addBeds = 0, int $addBaths = 0) {
    $this->floors++;
    $this->beds += $addBeds;
    $this->baths += $addBaths;
    $addValue = 50000 + ($addBeds * 10000) + ($addBaths * 5000);
    $this->setMarketVal($this->marketVal + $addValue);
  }
}

$my_house = new Ranch(500000, 1, 3, 1.75);
$my_house->buildUp(2, 1);
$my_house->listForSale();
$my_house->showHouse();

$neighboring_house = new House(650000, 2, 4, 2);
$neighboring_house->listForSale();
$neighboring_house->showHouse();

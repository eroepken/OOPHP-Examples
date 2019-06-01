<?php

/**
 * House can now only be extended; it cannot be instantiated.
 */
abstract class House {
  /**
   * Protected, because if we use private here, they'd be unusable.
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
 * Ranch is a kind of house, so we're going to extend it.
 */
final class Ranch extends House {
  /**
   * Method to add a floor and market value depending on how many bedrooms or bathrooms.
   */
  public function buildUp(int $addBeds = 0, int $addBaths = 0) {
    $this->floors++;
    $this->beds += $addBeds;
    $this->baths += $addBaths;
    $addValue = 50000 + ($addBeds * 10000) + ($addBaths * 5000);
    $this->setMarketVal($this->marketVal + $addValue);
  }
}

/**
 * My house object, now built up, worth more, and for sale.
 */
$my_house = new Ranch(500000, 1, 3, 1.75);
$my_house->buildUp(2, 1);
$my_house->listForSale();
$my_house->showHouse();

/**
 * These lines throw a fatal error because House is not allowed to be instantiated.
 * (See: https://www.php.net/manual/en/language.oop5.abstract.php)
 */
// $neighboring_house = new House(650000, 2, 4, 2);
// $neighboring_house->listForSale();
// $neighboring_house->showHouse();

/**
 * This will also throw a fatal error because Ranch cannot be extended any further.
 * (See: https://www.php.net/manual/en/language.oop5.final.php)
 */
// class ExpandedRanch extends Ranch {
// }

<?php

/**
 * Our base House class, which can be extended or instantiated.
 * (See: https://www.php.net/manual/en/language.oop5.basic.php)
 */
class House {
  /**
   * These are not inherited by children or accessible by any other classes/objects.
   * (See: https://www.php.net/manual/en/language.oop5.visibility.php)
   */
  private $marketVal;
  private $beds;
  private $baths;
  private $floors;
  private $isForSale;

  /**
   * This is a magic method that runs on object creation.
   * (See: https://www.php.net/manual/en/language.oop5.decon.php)
   */
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
 * My house object.
 */
$my_house = new House(500000, 1, 3, 1.75);
$my_house->showHouse();

/**
 * My neighbor's house object.
 */
$neighboring_house = new House(650000, 2, 4, 2);
$neighboring_house->listForSale();
$neighboring_house->showHouse();

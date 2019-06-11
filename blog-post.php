<?php
abstract class BlogEntry {
  protected $created_time;
  protected $published_time;
  protected $content;

  function __construct() {
    $this->created_time = new DateTime();
  }

  public function getCreatedTime() {
    return $this->created_time;
  }

  public function setPublishedTime(DateTime $published) {
    $this->published_time = $published;
  }

  public function getPublishedTime() {
    return $this->published_time;
  }

  public function setContent($content) {
    $this->content = $content;
  }

  abstract public function printEntry();
}

final class StandardEntry extends BlogEntry {
  public $title;

  public function printEntry() {
		print "\"$this->title\" (" . $this->published_time->format('F j, Y') . ") — \n" . $this->content . "\n\n";
	}
}

final class StatusEntry extends BlogEntry {
  public $mood;

  public function printEntry() {
		print "Mood: $this->mood (" . $this->published_time->format('F j, Y') . ") —\n " . $this->content . "\n\n";
	}
}

final class ReviewEntry extends BlogEntry {
  public $title;
  private $rating;

  public function setRating(int $rating) {
    if ($rating < 1 || $rating > 5) {
      throw new Error('Rating value is invalid');
      return;
    }

    $this->rating = $rating;
  }

  public function getRating() {
    return str_repeat('🌟', $this->rating);
  }

  public function printEntry() {
		print "\"$this->title\" (" . $this->published_time->format('F j, Y') . ") — \n" . $this->content . "\n\n";
	}
}

$todays_entry = new StandardEntry();
$todays_entry->title = 'Back on my Ish: Object-Oriented PHP Part 1';
$todays_entry->setPublishedTime(new DateTime('April 30, 2019 12:00 PM'));
$todays_entry->setContent('You just came from there!');
$todays_entry->printEntry();

$todays_status = new StatusEntry();
$todays_status->mood = 'happy';
$todays_status->setPublishedTime(new DateTime('April 30, 2019 12:00 PM'));
$todays_status->setContent('I\'m going to see Avengers tonight!');
$todays_status->printEntry();

$tomorrows_entry = new ReviewEntry();
$tomorrows_entry->title = 'Avengers: Endgame';
$tomorrows_entry->setPublishedTime(new DateTime('May 1, 2019 12:00 PM'));
$tomorrows_entry->setRating(5);
$tomorrows_entry->setContent('Spoiler Warning: This movie was great.');
$tomorrows_entry->printEntry();

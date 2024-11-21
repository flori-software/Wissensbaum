<?php
include "mariko_sama.php";
include "human_android_comunicator.php";

$mysqli = MyDatabase();
/*

$abfrage = "SELECT * from `TheLostInTimeProblem` where `ID` = 83";
if($result = $mysqli->query($abfrage)) {
   while($row = $result->fetch_object()) {
      $algorithm = c3po::lesen($row->algorithm);
      echo $algorithm.'<br>';
   }
}
*/
/*
$teststring = "Der Mensch lebt nicht nur vom Brot ellein sondern von jedem Wort das aus Gottes Mund stammt.";
echo $teststring.'<br>';
$r2d2 = new r2d2();
$test = $r2d2->verschluesseln($teststring);

$test = $r2d2->entschluesseln(paket: $test["paket"], iv: $test["iv"]);
echo 'Ergebnis der Entschlüsselung:<br>';
echo $test.'<br>';
*/
/*
$r2d2 = new r2d2();
$alphabet = array("alpha", "beta", "charlie", "delta", "echo", "foxtrott", "germany", "halo", "india", "juliett", "kilo", "lima", "mike", "november", "oscar", "papa", "quebec", "romeo", "sierra", "tango", "uniform", "victor", "whiskey", "xray", "yankee", "zulu");
$ergebnis = $r2d2->verschluesseln(paket: $alphabet);
echo 'Verschlüsselung:<br>';
echo '<pre>', print_r($ergebnis), '</pre>';

$ergebnis = $r2d2->entschluesseln(paket: $ergebnis["paket"], iv: $ergebnis["iv"]);
echo 'Entschlüsselung:<br>';
echo '<pre>', print_r($ergebnis), '</pre>';

*/ 

class testauto {
   public $marke;
   public $modell;
   public $baujahr;
   public $leistung;
   public $farbe;

   public function __construct($marke, $modell, $baujahr, $leistung, $farbe) {
      $this->marke = $marke;
      $this->modell = $modell;
      $this->baujahr = $baujahr;
      $this->leistung = $leistung;
      $this->farbe = $farbe;
   }
}


// Es fehlt noch die Iteration durch ein ganzes Objekt ohne des Arrays mit Keys
?>
<?php
class Fortbildung {
    public $ID;
    public $titel;
    public $beschreibung;
    public $datum;
    public $ort;

    public $punkte;

    public $profil;
    public $profil_unserialized;

    public function formular_stammdaten() {
        $hoehe_feld = $_SESSION["font_size"] * 1.4;
        $hoehe_textarea = $_SESSION["font_size"] * 6;
        echo '<form action="uebersicht.php?aktion=neue_fobi_speichern" method="post">
        Titel:<br>
        <input type="text" name="titel" id="titel" style="width: 100%; height: '.$hoehe_feld.'px;"><br>
        Beschreibung:<br>
        <textarea name="beschreibung" id="beschreibung" style="width: 100%; height: '.$hoehe_textarea.'px;"></textarea><br>
        Datum:<br>
        <input type="date" name="datum" id="datum" style="width: 100%; height: '.$hoehe_feld.'px;"><br>
        Ort:<br>
        <input type="text" name="ort" id="ort" style="width: 100%; height: '.$hoehe_feld.'px;"><br>
        Wachstumspunkte:<br>
        <input type="number" name="punkte" id="punkte" style="width: 100%; height: '.$hoehe_feld.'px;"><br>
        Die Fortbildung ist für folgende Profile geeignet:<br>';
        Profile::formular_profile(objekt: $this);
        echo '<p><input type="submit" value="Speichern" style="width: 100%; height: '.$hoehe_feld.'px;"></p>
        </form>';
        
    }

    public function formular_stammdaten_lesen() {
        $this->titel = PostMyVar("titel", "");
        $this->beschreibung = PostMyVar("beschreibung", "");
        $this->datum = PostMyVar("datum", "");
        $this->ort = PostMyVar("ort", "");
        $this->punkte = PostMyVar("punkte", "");
        $this->profil = Profile::formular_profile_lesen();
    }

    public function speichern() {
        $mysqli = MyDatabase();
        $abfrage = "INSERT INTO fobi (titel, beschreibung, datum, ort, punkte, profil) VALUES ('$this->titel', '$this->beschreibung', '$this->datum', '$this->ort', '$this->punkte', '$this->profil')";
        $this->ID = standard_sql($abfrage, "Fortbildung speichern");
    }

    public function bearbeiten() {

    }

    public function lesen() {

    }
}










?>
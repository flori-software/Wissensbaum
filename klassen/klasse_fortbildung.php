<?php
class Fortbildung {
    public $ID;
    public $titel;
    public $beschreibung;
    public $datum;
    public $ort;
    public $profil;
    public $profil_unserialized;

    public function formular_stammdaten() {
        $hoehe_feld = $_SESSION["font_size"] * 1.4;
        $hoehe_textarea = $_SESSION["font_size"] * 6;
        echo '<form action="meine_fobi.php?aktion=speichern" method="post">
        Titel:<br>
        <input type="text" name="titel" id="titel" style="width: 100%; height: '.$hoehe_feld.'px;"><br>
        Beschreibung:<br>
        <textarea name="beschreibung" id="beschreibung" style="width: 100%; height: '.$hoehe_textarea.'px;"></textarea><br>
        Datum:<br>
        <input type="date" name="datum" id="datum" style="width: 100%; height: '.$hoehe_feld.'px;"><br>
        Ort:<br>
        <input type="text" name="ort" id="ort" style="width: 100%; height: '.$hoehe_feld.'px;"><br>
        Profil:<br>';
        Profile::formular_profile(objekt: $this);
        echo '<p><input type="submit" value="Speichern" style="width: 100%; height: '.$hoehe_feld.'px;"></p>
        </form>';
        
    }

    public function formular_stammdaten_lesen() {

    }

    public function speichern() {

    }

    public function bearbeiten() {

    }
}










?>
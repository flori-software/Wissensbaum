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
        $mysqli = MyDatabase();
        $abfrage = "SELECT * FROM fobi WHERE ID = $this->ID";
        $ergebnis = $mysqli->query($abfrage);
        while($row = $ergebnis->fetch_assoc()) {
            $this->titel               = $row["titel"];
            $this->beschreibung        = $row["beschreibung"];
            $this->datum               = $row["datum"];
            $this->ort                 = $row["ort"];
            $this->punkte              = $row["punkte"];
            $this->profil_unserialized = unserialize($row["profil"]);
        }
    }

    public static function alle_lesen() {
        $mysqli = MyDatabase();
        $abfrage = "SELECT * FROM fobi ORDER BY datum DESC";
        $ergebnis = $mysqli->query($abfrage);
        $fortbildungen = array();
        while($row = $ergebnis->fetch_assoc()) {
            $fortbildung = new Fortbildung();
            $fortbildung->ID = $row["ID"];
            $fortbildung->lesen();  
            $fortbildungen[] = $fortbildung;
        }
        return $fortbildungen;
    }

    public function zeige_fobi($angemeldet = 0) {
        echo '<div style="font-family: QuicksandLight;
        font-size: '.$_SESSION["font_size"].'px;
        font-weight: lighter;">';
        echo '<p><h2>'.$this->titel.'</h2></p>';
        echo '<p>'.$this->beschreibung.'</p>';
        echo '<p>'.date_to_datum($this->datum).'&nbsp'.$this->ort.'</p>';
        #echo '<p>'.$this->ort.'</p>';
        echo '<p>Punkte für Ihren Wissensbaum: '.$this->punkte.'</p>';
        echo '<p>'.$this->profil.'</p>';
        // Nur wenn jemand eingeloggt ist, kann er sich auch anmelden:
        if(isset($_SESSION["id_benutzer"]) && $angemeldet == 0) {
            echo '<p><a href="meine_fobi.php?aktion=anmelden&id_fortbildung='.$this->ID.'">Zur Fortbildung Anmelden</a><p>';
        } elseif(!isset($_SESSION["id_benutzer"])) {
            echo '<p style="color: olivedrab;">Bitte loggen Sie sich ein, um sich für die Fortbildung anzumelden.</p>';
        }
        
        echo '</div><hr>';
    }

    public function anmelden($ID_person) {
        $mysqli = MyDatabase();
        $abfrage = "INSERT INTO fobi_buchungen (`id_mitarbeiter`, `id_fobi`) VALUES ('".$_SESSION["id_benutzer"]."', '".$this->ID."')";
        $mysqli->query($abfrage);
        // Hinzufügen der Punkte
        $benutzer = new Benutzer($_SESSION["id_benutzer"]);
        $benutzer->add_points($this->punkte);
    }
}










?>
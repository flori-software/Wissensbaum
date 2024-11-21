<?php
class Budget {
    public int $jahr;
    public array $kostenstellen;

    public function __construct($jahr = 0) {
        if($jahr == 0) {
            $heute      = heute_datum();
            $this->jahr = jahr_aus_datum($heute);
        } else {
            $this->jahr = $jahr;
        }
    }

}

class Kostenstelle {
    public int $ID;
    public string $kostenstelle;
    public int $einnahmen; // Hier geht es um die Art - Einnahmen (1) oder Ausgaben (0)

    public function __construct($id = 0) {
        if($id != 0) {
            $this->ID = $id;
        }
    }

    public function lesen() {
        $mysqli = MyDatabase();
        $abfrage = "SELECT * FROM `kostenstellen` WHERE `ID`=".$this->ID;
        if($result = $mysqli->query($abfrage)) {
           while($row = $result->fetch_object()) {
              $this->kostenstelle = $row->kostenstelle;
              $this->einnahmen    = $row->einnahmen;
           }
        }
    }

    

    public static function get_alle_kostenstellen() {
        $kostenstellen = array();
        $mysqli = MyDatabase();
        $abfrage = "SELECT * FROM `kostenstellen`";
        if($result = $mysqli->query($abfrage)) {
            while($row = $result->fetch_object()) {
                $kostenstelle = new Kostenstelle($row->ID);
                $kostenstelle->lesen();
                $kostenstellen[] = $kostenstelle;
            }
        }
        return $kostenstellen;
    }
}



?>
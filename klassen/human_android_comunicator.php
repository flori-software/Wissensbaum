<?php

class c3po {
    public $paket;
    
    private $zahlen;     // Array

    public function __construct($paket) {
        $this->zahlen = Array();
        $this->paket = $paket;

    }

    public function coden() {
        $this->algorithmA();
        return $this->paket;
    } 

    public function decoden() {
        // Entschlüsselung der 2. Stufe
        // NULL muss in String umgewandelt werden
        if(is_null($this->paket)) {$this->paket = "";}
        $ergebnis = str_replace("W", "CI", $this->paket);

        // Entschlüsselung der Komplikationen
        $ergebnis = str_replace("E", "%x", $ergebnis);
        $ergebnis = str_replace("G", "%j", $ergebnis);
        $ergebnis = str_replace("O", "p)", $ergebnis);
        $ergebnis = str_replace("M", "}%", $ergebnis);
        $ergebnis = str_replace("I", "+w", $ergebnis);
        $ergebnis = str_replace("R", "{s", $ergebnis);
        $ergebnis = str_replace("C", "%<", $ergebnis);
        $ergebnis = str_replace("A", "%>", $ergebnis);
        $ergebnis = str_replace("L", "%}", $ergebnis);

        // Entschlüsselung zum Hexadezimalen Code
        $ergebnis = str_replace("§", "f", $ergebnis);
        $ergebnis = str_replace("!", "e", $ergebnis);
        $ergebnis = str_replace("j", "d", $ergebnis);
        $ergebnis = str_replace("s", "c", $ergebnis);
        $ergebnis = str_replace("p", "b", $ergebnis);
        $ergebnis = str_replace(">", "a", $ergebnis);
        $ergebnis = str_replace("x", "9", $ergebnis);
        $ergebnis = str_replace("u", "8", $ergebnis);
        $ergebnis = str_replace("w", "7", $ergebnis);
        $ergebnis = str_replace("z", "6", $ergebnis);
        $ergebnis = str_replace("$", "5", $ergebnis);
        $ergebnis = str_replace("<", "4", $ergebnis);
        $ergebnis = str_replace("-", "3", $ergebnis);
        $ergebnis = str_replace("&", "2", $ergebnis);
        $ergebnis = str_replace("+", "1", $ergebnis);
        $ergebnis = str_replace("}", "0", $ergebnis);
        $ergebnis = str_replace("{", "15", $ergebnis);
        $ergebnis = str_replace(")", "14", $ergebnis);
        $ergebnis = str_replace("(", "13", $ergebnis);
        $ergebnis = str_replace("*", "12", $ergebnis);
        $ergebnis = str_replace("#", "11", $ergebnis);
        $ergebnis = str_replace("%", "16", $ergebnis);
        
        // Array mit Buchstaben bilden
        $this->paket = "";
        while(strlen($ergebnis) > 0) {
            $piece    = substr($ergebnis, 0, 3);
            $ergebnis = substr($ergebnis, 3);
            $piece    = hexdec($piece);
            $piece    = $piece - 251;
            $this->paket .= chr($piece);
        }
        #echo "<p>Entschlüsselter Text: ".$this->paket."<p>";
        return $this->paket;
    }

    private function algorithmA() {
        $laenge = strlen($this->paket);
        for($pos = 0; $pos < $laenge; $pos++) {
            $buchstabe = substr($this->paket, $pos, 1);
            // Umwandlung in ASCII
            $this->zahlen[] = ord($buchstabe);
            // Erhöhung um 251 um immer dreistellige Ergebnisse zu bekommen
            $this->zahlen[$pos] = dechex($this->zahlen[$pos] + 251);
        }
        $ergebnis = "";
        foreach ($this->zahlen as $zahl) {
            $ergebnis .= $zahl;
        }
        // Chiffrierung des Hexadezimalen Codes
        $ergebnis = str_replace("16", "%", $ergebnis);
        $ergebnis = str_replace("11", "#", $ergebnis);
        $ergebnis = str_replace("12", "*", $ergebnis);
        $ergebnis = str_replace("13", "(", $ergebnis);
        $ergebnis = str_replace("14", ")", $ergebnis);
        $ergebnis = str_replace("15", "{", $ergebnis);
        $ergebnis = str_replace("0", "}", $ergebnis);
        $ergebnis = str_replace("1", "+", $ergebnis);
        $ergebnis = str_replace("2", "&", $ergebnis);
        $ergebnis = str_replace("3", "-", $ergebnis);
        $ergebnis = str_replace("4", "<", $ergebnis);
        $ergebnis = str_replace("5", "$", $ergebnis);
        $ergebnis = str_replace("6", "z", $ergebnis);
        $ergebnis = str_replace("7", "w", $ergebnis);
        $ergebnis = str_replace("8", "u", $ergebnis);
        $ergebnis = str_replace("9", "x", $ergebnis);
        $ergebnis = str_replace("a", ">", $ergebnis);
        $ergebnis = str_replace("b", "p", $ergebnis);
        $ergebnis = str_replace("c", "s", $ergebnis);
        $ergebnis = str_replace("d", "j", $ergebnis);
        $ergebnis = str_replace("e", "!", $ergebnis);
        $ergebnis = str_replace("f", "§", $ergebnis);
        #echo "Ergebnis der Verschlüsselung der 1. Stufe: ".$ergebnis."<p>";

        // Komplikationen
        $ergebnis = str_replace("%}", "L", $ergebnis);
        $ergebnis = str_replace("%>", "A", $ergebnis);
        $ergebnis = str_replace("%<", "C", $ergebnis);
        $ergebnis = str_replace("{s", "R", $ergebnis);
        $ergebnis = str_replace("+w", "I", $ergebnis);
        $ergebnis = str_replace("}%", "M", $ergebnis);
        $ergebnis = str_replace("p)", "O", $ergebnis);
        $ergebnis = str_replace("%j", "G", $ergebnis);
        $ergebnis = str_replace("%x", "E", $ergebnis);

        // Komplikationen 2. Stufe
        $ergebnis = str_replace("CI", "W", $ergebnis);
        
        $this->paket = $ergebnis;

    }
    
    public static function lesen($paket) {
        $paket = new c3po($paket);
        $uebersetzung = $paket->decoden();
        return $uebersetzung;
    }

    public static function verschluesseln($paket) {
        $paket = new c3po($paket);
        $uebersetzung = $paket->coden();
        return $uebersetzung;
    }
}

class r2d2 {
    private String $my_constant;
    private $iv;
    private $hex_iv;
    private $keys;  // Wenn nur ausgewählte keys eines Arrays oder Objekts bearbeitet werden sollen
    private $paket; // Kann ein String, ein Array oder ein Objekt sein
    private $pakettyp;
    private String $aktion; // coden oder decoden

    private function init($paket, $aktion, $keys = NULL, $iv = NULL) {
        
        $this->my_constant = $this->myConstant();
        $this->paket = $paket;
        $this->aktion = $aktion;
        $this->keys = $keys;
        $this->iv = $iv;
        if(is_null($this->iv)) {
            $this->iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
            $this->hex_iv = bin2hex($this->iv);
        } else {
            $this->iv = hex2bin($this->iv);
        }
        // Die Funktion kann mit einzelnen String, aber auch mit Objekten oder Arrays arbeiten, die den gleichen IV haben
        $this->get_pakettyp();
        
    }
    
    public function transform($paket, $keys = NULL, $iv = NULL, $aktion = "coden") {
        $this->init(paket: $paket, keys: $keys, iv: $iv, aktion: $aktion);
        
        switch($this->pakettyp) {
            case "String":
                if($this->aktion == "coden") {
                    $this->paket = $this->coden($this->paket);
                } elseif($this->aktion == "decoden") {
                    $this->paket = $this->decoden($this->paket);
                } 
            break;
            case "Array":
                foreach($this->paket as $key=>$element) {
                    if(is_string($element)) {
                        if($this->aktion == "coden") {
                            $element = $this->coden($element);
                        } elseif($this->aktion == "decoden") {
                            $element = $this->decoden($element);
                        }
                        $this->paket[$key] = $element;
                    }
                }
            break;
            case "Object":
                $paket = clone $this->paket;
                // An dieser Stelle wird durch das - möglicherweise auch mehrschichtiges - Objekt iteriert
                $this->paket = $this->iterieren_durch_objekt($paket);
                
            break;
            default:
                echo "Unbekannter Pakettyp in r2d2<br>";
        }
        $ergebnis = Array();
        $ergebnis["paket"] = $this->paket;
        $ergebnis["iv"] = $this->hex_iv;
        return $ergebnis;
        
    }

    private function iterieren_durch_objekt($paket) {
        // Gesamtes Objekt
        foreach($paket as $property=>$value) {
            // Beinhaltet value "->"?
            if(is_object($value)) { 
                // Das unterobjekt wird rekursiv behandelt
                $copy_of_value = clone $value;
                $value = $this->iterieren_durch_objekt($copy_of_value); 
                $paket->$property = $value;
            } else {
                // Es wird nur kodiert, wenn es sich um einen String handelt
                if(is_string($value)) {
                    if($this->aktion == "coden") {
                        $paket->$property = $this->coden($value);
                    } elseif($this->aktion == "decoden") {
                        $paket->$property = $this->decoden($value);
                    }
                } else {
                    #echo $property." wird übersprungen<br>";
                }
            }
        }
        return $paket;
    }

    private function myConstant() {
        $mysqli = MyDatabase();
        $abfrage = "SELECT * from `TheLostInTimeProblem` where `ID` = 83";
        if($result = $mysqli->query($abfrage)) {
            while($row = $result->fetch_object()) {
                $this->my_constant = c3po::lesen($row->algorithm);
            }
        }
        return $this->my_constant;
    }

    private function get_pakettyp() {
        if(is_string($this->paket)) {
            $this->pakettyp = "String";
        } elseif(is_array($this->paket)) {
            $this->pakettyp = "Array";
        } elseif(is_object($this->paket)) {
            $this->pakettyp = "Object";
        } else {
            $this->pakettyp = "Unbekannt";
        }
    }

    private function coden($text) {
        $encrypted_text = openssl_encrypt($text, 'aes-256-cbc', $this->my_constant, 0, $this->iv);
        return $encrypted_text;
    }

    private function decoden($paket) {
        $decrypted_text = openssl_decrypt($paket, 'aes-256-cbc', $this->my_constant, 0, $this->iv);
        return $decrypted_text;
    }

}



?>
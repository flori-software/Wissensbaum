<?php

class Kontaktdaten {
	public $strasse;
	public $plz;
	public $ort;
	
	public $telefonnummer;
	public $mobil;
	public $email;

}

class Benutzer {
	public $ID;
	public $vorname;
	public $nachname;
	public $benutzername;
	public $kontakt; // Eigenständige Klasse
	public $passwort;

	// Für die Ver- und Entschlüsselung
	public $scarlet_witch; // Verschlüsselte Form des Objekts als Array mit den Keys "paket" und "iv"

	public function __construct($id = 0) {
		$this->scarlet_witch = Array();
		$this->kontakt = new Kontaktdaten;
		if ($id > 0) {
			$this->ID = $id;
			$this->stammdaten_lesen($id);
		}
	}

	public static function formular_stammdaten($benutzer) {
		// Formular für Stammdaten
		if ($_SESSION["mobile"] == "mobile") {
			// Mobile Version - gleiche Tabelleninhalte wie unten innerhalb der else{} Anweisung, nur dass jedes Element eine ganze Zeile einnimmt und die Schriftgröße 50px beträgt
			echo '<table style="width: 100%; font-size: 50px;">
			<tr><td>Benutzername: </td></tr>
			<tr><td><input type="text" name="benutzername" id="benutzername" value="'.$benutzer->benutzername.'" style="width: 100%; height: 100px; background-color: lightcoral;" placeholder="Wird automatisch ausgefüllt" onblur="validierung()"></td></tr>
			<tr><td>Vorname:</td></tr>
			<tr><td><input type="text" name="vorname" id="vorname" value="'.$benutzer->vorname.'" style="width: 100%; height: 100px; background-color: lightcoral;" onblur="validierung()"></td></tr>
			<tr><td>Nachname:</td></tr>
			<tr><td><input type="text" name="nachname" id="nachname" value="'.$benutzer->nachname.'" onblur="benutzername_automatisch_fuellen(); validierung();" style="width: 100%; height: 100px; background-color: lightcoral;" ></td></tr>
			<tr><td>Straße:</td></tr>
			<tr><td><input type="text" name="strasse" id="strasse" value="'.$benutzer->kontakt->strasse.'" style="width: 100%; height: 100px;"></td></tr>
			<tr><td>PLZ:</td></tr>
			<tr><td><input type="text" name="plz" id="plz" value="'.$benutzer->kontakt->plz.'" style="width: 40%; height: 100px;"></td></tr>
			<tr><td>Ort:</td></tr>
			<tr><td><input type="text" name="ort" id="ort" value="'.$benutzer->kontakt->ort.'" style="width: 100%; height: 100px;"></td></tr>
			<tr><td>Telefonnummer:</td></tr>
			<tr><td><input type="text" name="telefonnummer" id="telefonnummer" value="'.$benutzer->kontakt->telefonnummer.'" style="width: 100%; height: 100px; background-color: lightcoral;" onblur="validierung()"></td></tr>
			<tr><td>Mobil:</td></tr>
			<tr><td><input type="text" name="mobil" id="mobil" value="'.$benutzer->kontakt->mobil.'" style="width: 100%; height: 100px; background-color: lightcoral;" onblur="validierung()"></td></tr>
			<tr><td>Email:</td></tr>
			<tr><td><input type="text" name="email" id="email" value="'.$benutzer->kontakt->email.'" style="width: 100%; height: 100px; background-color: lightcoral;" onblur="validierung()"></td></tr>
			<tr><td>Passwort:</td></tr>
			<tr><td><input type="text" name="passwort1" id="passwort1" style="width: 100%; height: 100px; background-color: lightcoral;" onblur="validierung()"></td></tr>
			<tr><td>Wiederholung:</td></tr>
			<tr><td><input type="text" name="passwort2" id="passwort2" style="width: 100%; height: 100px; background-color: lightcoral;" onblur="validierung()"></td></tr>
			<tr><td><div style="height: 20px;"></div></td></tr>
			<tr><td><input type="submit" value="Speichern" id="speichern" style="height: 80px;" disabled></td></tr>
			<tr><td colspan="3" style="font-size: 48; color: red;" id="fehlermeldung"></td></tr>
			</table>';

		} else {
			echo '<table style="width: 100%; font-size: 20px;">
			<tr>
				<td>Benutzername: </td><td colspan="3"><input type="text" name="benutzername" id="benutzername" value="'.$benutzer->benutzername.'" style="width: 100%; background-color: lightcoral;" placeholder="Falls leer, wird das Feld automatisch mit Ihrem Namen gefüllt" onblur="validierung()"></td>
			</tr>
			<tr>
				<td>Vorname:</td><td><input type="text" name="vorname" id="vorname" value="'.$benutzer->vorname.'" style="width: 100%; background-color: lightcoral;" onblur="validierung()"></td>
				<td style="width: 10%;">Nachname:</td><td><input type="text" name="nachname" id="nachname" value="'.$benutzer->nachname.'" style="width: 100%; background-color: lightcoral;" onblur="benutzername_automatisch_fuellen(); validierung();"></td>
			</tr>
			<tr>
				<td>Straße:</td><td colspan="3"><input type="text" name="strasse" id="strasse" value="'.$benutzer->kontakt->strasse.'" style="width: 100%;"></td>
			</tr>
			<tr>
				<td>PLZ:</td><td><input type="text" name="plz" id="plz" value="'.$benutzer->kontakt->plz.'" style="width: 40%;"></td>
				<td>Ort:</td><td><input type="text" name="ort" id="ort" value="'.$benutzer->kontakt->ort.'" style="width: 100%;"></td>
			</tr>
			<tr>
				<td>Telefonnummer:</td><td><input type="text" name="telefonnummer" id="telefonnummer" style="width: 100%; background-color: lightcoral;" onblur="validierung()"></td>
				<td>Mobil:</td><td><input type="text" name="mobil" id="mobil" style="background-color: lightcoral;" style="width: 100%;" onblur="validierung()"></td>
			</tr>
			<tr>
				<td>Email:</td><td colspan="3"><input type="text" name="email" style="background-color: lightcoral;" id="email" value="'.$benutzer->kontakt->email.'" style="width: 100%;" onblur="validierung()"></td>
			</tr>
			<tr>
				<td>Passwort:</td><td><input type="text" name="passwort1" id="passwort1" value="'.$benutzer->kontakt->telefonnummer.'" style="width: 100%; background-color: lightcoral;" onblur="validierung()"></td>
				<td>Wiederholung:</td><td><input type="text" name="passwort2" id="passwort2" value="'.$benutzer->kontakt->mobil.'" style="width: 100%; background-color: lightcoral;" onblur="validierung()"></td>
			</tr>
			<tr>
				<td></td><td colspan="3" style="font-size: 18px;">Mindestens 8 Zeichen, davon 1 Großbuchstabe, 1 Kleinbuchstabe und mindestens 1 Zahl.</td>
			</tr>
			<tr>
				<td></td><td colspan="3" style="font-size: 18px;">Wir benötigen entweder Ihre Telefonnummer oder die Emailadresse, um Ihre Identität zu überprüfen.</td>
			</tr>
				<tr><td></td><td><input type="submit" id="speichern" value="Speichern" disabled></td></tr>
				<tr><td></td><td colspan="3" style="font-size: 24; color: red;" id="fehlermeldung"></td></tr>
			</table>';
		}
	}



	public function formular_stammdaten_lesen() {
		// Formular für Stammdaten lesen und ie Werte den Eigenschaften des Objekts zuordnen
		$this->benutzername 		  = $_POST["benutzername"] ?? "";
		$this->vorname 				  = $_POST["vorname"] ?? "";
		$this->nachname 			  = $_POST["nachname"] ?? "";
		$this->kontakt->strasse 	  = $_POST["strasse"] ?? "";
		$this->kontakt->plz 		  = $_POST["plz"] ?? "";
		$this->kontakt->ort 		  = $_POST["ort"] ?? "";
		$this->kontakt->telefonnummer = $_POST["telefonnummer"] ?? "";
		$this->kontakt->mobil 		  = $_POST["mobil"] ?? "";
		$this->kontakt->email 		  = $_POST["email"] ?? "";
		$this->passwort 			  = $_POST["passwort1"] ?? "";
		$paswort_test 				  = $_POST["passwort2"] ?? "";
		if ($this->passwort != $paswort_test) {
			echo "Die Passwörter stimmen nicht überein.";
		} else {
			// Verschlüsseln der sensiblen Daten
			
			$r2d2 = new r2d2();
			$keys = NULL;
			$keys = array("benutzername", "vorname", "nachname", "strasse", "plz", "ort", "telefonnummer", "mobil", "email");
			$this->scarlet_witch = $r2d2->transform(paket: $this, keys: $keys);

			// Für das Passwort wählen wir eine Verschlüsselung ohne Möglichkeit zum Entschlüsseln 
			$this->scarlet_witch["paket"]->passwort = password_hash($this->passwort, PASSWORD_DEFAULT);
			$this->scarlet_witch["iv"] = c3po::verschluesseln($this->scarlet_witch["iv"]);
			$this->speichern();
		}

	}

	public function login() {
		// Login des Benutzers
		$benutzername = $_POST["benutzername"] ?? "";
		$passwort     = $_POST["passwort"] ?? "";

		$mysqli = MyDatabase();
		$abfrage = "SELECT `ID`, `benutzername`, `passwort`, `iv` FROM `Benutzer`";
		if($result = $mysqli->query($abfrage)) {
		    while($row = $result->fetch_object()) {
				// Der Benutzername muss zunächst entschlüsselt werden
				$iv = c3po::lesen($row->iv);
				$r2d2 = new r2d2();
				$decoding_response = $r2d2->transform(paket: $row->benutzername, iv: $iv, aktion: "decoden");
				$db_benutzername = $decoding_response["paket"];
				if ($db_benutzername == $benutzername) {
					if (password_verify($passwort, $row->passwort)) {
						$_SESSION["id_benutzer"] = $row->ID;
						$this->ID = $row->ID;
						$this->stammdaten_lesen();
						$_SESSION["id_benutzer"] = $this->ID;
					}
				}
		   }
		}
	}

	public function speichern() {
		// Speichern der Daten in der Datenbank
		$sql_befehl = "INSERT INTO mitarbeiter (benutzername, vorname, nachname, strasse, plz, ort, telefonnummer, mobil, email, passwort, iv) 
		VALUES ('".$this->scarlet_witch["paket"]->benutzername."', '".$this->scarlet_witch["paket"]->vorname."', '".$this->scarlet_witch["paket"]->nachname."', '".$this->scarlet_witch["paket"]->kontakt->strasse."', '".$this->scarlet_witch["paket"]->kontakt->plz."', '".$this->scarlet_witch["paket"]->kontakt->ort."', '".$this->scarlet_witch["paket"]->kontakt->telefonnummer."', '".$this->scarlet_witch["paket"]->kontakt->mobil."', '".$this->scarlet_witch["paket"]->kontakt->email."', '".$this->scarlet_witch["paket"]->passwort."', '".$this->scarlet_witch["iv"]."')";
		#echo $sql_befehl.'<br>';
		$this->ID = standard_sql($sql_befehl, "Benutzerdaten speichern");
		$_SESSION["id_benutzer"] = $this->ID;
	}

	public function stammdaten_lesen() {
		$mysqli = MyDatabase(); // standard oder bericht
		$abfrage = "SELECT * FROM `mitarbeiter` WHERE `ID` = '".$this->ID."'";
		if($result = $mysqli->query($abfrage)) {
		   while($row = $result->fetch_object()) {
				$this->benutzername = $row->benutzername;
				$this->vorname = $row->vorname;
				$this->nachname = $row->nachname;
				$this->kontakt->strasse = $row->strasse;
				$this->kontakt->plz = $row->plz;
				$this->kontakt->ort = $row->ort;
				$this->kontakt->telefonnummer = $row->telefonnummer;
				$this->kontakt->mobil = $row->mobil;
				$this->kontakt->email = $row->email;
				$iv = c3po::lesen($row->iv);

				$r2d2 = new r2d2();
				$keys = NULL;
				$keys = array("benutzername", "vorname", "nachname", "strasse", "plz", "ort", "telefonnummer", "mobil", "email");
				$paket = $r2d2->transform(paket: $this, keys: $keys, iv: $iv, aktion: "decoden");

				$this->benutzername = $paket["paket"]->benutzername;
				$this->vorname = $paket["paket"]->vorname;
				$this->nachname = $paket["paket"]->nachname;
				$this->kontakt->strasse = $paket["paket"]->kontakt->strasse;
				$this->kontakt->plz = $paket["paket"]->kontakt->plz;
				$this->kontakt->ort = $paket["paket"]->kontakt->ort;
				$this->kontakt->telefonnummer = $paket["paket"]->kontakt->telefonnummer;
				$this->kontakt->mobil = $paket["paket"]->kontakt->mobil;
				$this->kontakt->email = $paket["paket"]->kontakt->email;
		   }
		}
		
	}

	public static function stammdaten_alle_mitglieder() {
		// Alle Mitglieder aus der Datenbank lesen
		$mysqli = MyDatabase();
		$abfrage = "SELECT `ID` FROM `mitarbeiter`";
		$benutzer = Array();
		if($result = $mysqli->query($abfrage)) {
		   while($row = $result->fetch_object()) {
				$id = $row->ID;
				// Wir wollen an dieser Stelle keine ID angeben, um aus Zeitgründen das automatische Lesen aller Eigenschaften zu verhindern
				$benutzer = new Benutzer();
				$benutzer->ID = $id;
				$benutzer->stammdaten_lesen();
				$benutzer[] = $benutzer;
		   }
		}
		return $benutzer;
	} 

	public function emailadresse_verifizieren() {
		// Verifizieren der Emailadresse
	}

	public function loeschen() {
		// Löschen des Benutzers aus der Datenbank
	}
}
?>

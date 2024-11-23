<?php
include("page_start.php");
include("klassen/mariko_sama.php");
include("klassen/klasse_personen.php");
include("klassen/human_android_comunicator.php");
include("klassen/db_functions.php");

$aktion = $_GET["aktion"] ?? "";
$feldhoehe = $_SESSION["font_size"] * 1.4;
$benutzer = new Benutzer;

switch($aktion) {
    case 'mitarbeiter_speichern':
        $benutzer->formular_stammdaten_lesen();
        echo 'Neuer Mitarbeiter gespeichert.<br>';
    break;

    case 'wahl_mitarbeiter':
        $_SESSION["id_mitarbeiter"] = $_POST["wahl_id_mitarbeiter"];
    break;

    case 'neuer_mitarbeiter':
        $_SESSION["id_mitarbeiter"] = 0;
    break;

    case 'mitarbeiter_bearbeiten':
        $benutzer->ID = $_SESSION["id_mitarbeiter"];
        $benutzer->formular_stammdaten_lesen();
        
    break;
}

if(isset($_SESSION["id_mitarbeiter"])) {
    $benutzer->ID = $_SESSION["id_mitarbeiter"];
    $benutzer->stammdaten_lesen();
}

echo '<style>
    input {
        width: 80%;
        font-size: '.$_SESSION["font_size"].'px;
        font-weight: lighter;
        height: 40px;
    }
</style>
Hier können Sie die Profile Ihrer Mitarbeiter bearbeiten oder neue Mitarbeiter anlegen:';

if($benutzer->ID > 0) {
    $aktion = "mitarbeiter_bearbeiten";
} else {
    $aktion = "mitarbeiter_speichern";
}

echo '<form action="mitarbeiter.php?aktion=wahl_mitarbeiter" method="POST">';
Benutzer::dropdown_benutzer();
echo '<input type="submit" value="Mitarbeiter auswählen">';
echo '</form>';

echo '<a href="mitarbeiter.php?aktion=neuer_mitarbeiter">Neuen Mitarbeiter anlegen</a>';

echo '<form action="mitarbeiter.php?aktion='.$aktion.'" method="POST">';
Benutzer::formular_stammdaten($benutzer);
echo '</form>';

include("page_end.php");
?>
<script>
// nach dem Laden der Seite soll die Funktion validierung aufgerufen werden
window.onload = function() {
    validierung();
}

function benutzername_automatisch_fuellen() {
	// Automatisches Füllen des Benutzernamens
	var vorname = document.getElementById("vorname").value;
    console.log("vorname: " + vorname);
    
	var nachname = document.getElementById("nachname").value;
    console.log("nachname: " + nachname);
    
	var benutzername = document.getElementById("benutzername").value;
    console.log("benutzername: " + benutzername);
    
	if (benutzername == "") {
		document.getElementById("benutzername").value = vorname + "." + nachname;
	}
    
}

function validierung() {
    // Validierung der Eingaben - PLZ muss mindestens 4 Zahlen beinhalten, die Emailadresse muss ein @-Zeichen enthalten sowie im Teil nach dem @ einen Punkt, die Telefonnummer muss mindestens 5 Zahlen beinhalten, der Benutzername muss mindestens 5 Zeichen beinhalten
    var id_mitarbeiter = document.getElementById("id_mitarbeiter").value;
    var vorname        = document.getElementById("vorname").value;
    var nachname       = document.getElementById("nachname").value;
    var benutzername   = document.getElementById("benutzername"). value;
    var email          = document.getElementById("email").value;
    var telefonnummer  = document.getElementById("telefonnummer").value;
    var mobil          = document.getElementById("mobil").value;
    var passwort1      = document.getElementById("passwort1").value;
    var passwort2      = document.getElementById("passwort2").value;

    var fehlermeldung = "";

    // Der Benutzername muss mindestens 8 Zeichen beinhalten
    if (benutzername.length < 8) {
        fehlermeldung += "Der Benutzername muss mindestens 8 Zeichen beinhalten.<br>";
        document.getElementById("benutzername").style.backgroundColor = "lightcoral";
    } else {
        document.getElementById("benutzername").style.backgroundColor = "lightgreen";
    }

    // Der Vorname muss mindestens 2 Zeichen beinhalten
    if (vorname.length < 2) {
        fehlermeldung += "Der Vorname muss mindestens 2 Zeichen beinhalten.<br>";
        document.getElementById("vorname").style.backgroundColor = "lightcoral";
    } else {
        document.getElementById("vorname").style.backgroundColor = "lightgreen";
    }

    // Der Nachname muss mindestens 2 Zeichen beinhalten
    if (nachname.length < 2) {
        fehlermeldung += "Der Nachname muss mindestens 2 Zeichen beinhalten.<br>";
        document.getElementById("nachname").style.backgroundColor = "lightcoral";
    } else {
        document.getElementById("nachname").style.backgroundColor = "lightgreen";
    }

    // Es muss entweder die Emailadresse oder die Telefonnummer oder die Handynummer angegeben werden
    if (email == "" && telefonnummer == "" && mobil == "") {
        fehlermeldung += "Bitte geben Sie entweder Ihre Emailadresse oder Ihre Telefonnummer oder Ihre Handynummer an.<br>";
        document.getElementById("email").style.backgroundColor = "lightcoral";
        document.getElementById("telefonnummer").style.backgroundColor = "lightcoral";
        document.getElementById("mobil").style.backgroundColor = "lightcoral";
    } else {
        document.getElementById("email").style.backgroundColor = "lightgreen";
        document.getElementById("telefonnummer").style.backgroundColor = "lightgreen";
        document.getElementById("mobil").style.backgroundColor = "lightgreen";
    }

    // Die beiden Passwörter müssen übereinstimmen
    // Sollten beide Passwortfelder leer sein, werden sie grau gefärbt
    
    if (passwort1 == "" && passwort2 == "") {
        document.getElementById("passwort1").style.backgroundColor = "lightgrey";
        document.getElementById("passwort2").style.backgroundColor = "lightgrey";
        if (id_mitarbeiter == "" || id_mitarbeiter == 0) {
            fehlermeldung += "Bitte geben Sie ein Passwort ein.<br>";
        }
    } else {
        if (passwort1 != passwort2) {
            fehlermeldung += "Die Passwörter stimmen nicht überein.<br>";
            document.getElementById("passwort1").style.backgroundColor = "lightcoral";
            document.getElementById("passwort2").style.backgroundColor = "lightcoral";
        } else {
            // Die Passwörter müsen mindestens 8 Zeichen beinhalten, davon mindestens 1 Großbuchstaben, 1 Kleinbuchstaben und 1 Zahl
            if(passwortValidierung(document.getElementById("passwort1").value)) {
                document.getElementById("passwort1").style.backgroundColor = "lightgreen";
                document.getElementById("passwort2").style.backgroundColor = "lightgreen";
            } else {
                fehlermeldung += "Das Passwort muss mindestens 8 Zeichen beinhalten, davon mindestens 1 Großbuchstaben, 1 Kleinbuchstaben und 1 Zahl.<br>";
                document.getElementById("passwort1").style.backgroundColor = "lightcoral";
                document.getElementById("passwort2").style.backgroundColor = "lightcoral";
            }   
        }
    }

    // Wenn die Variable Fehlermeldung leer ist, wird der Speichern-Button aktiviert, ansonsten wird die Fehlermeldung ausgegeben im DIV mit der id fehlermeldung - da ie Variable im besten Fall leer ist, wird sie immer ausgegeben
    console.log("fehlermeldung: " + fehlermeldung);
    document.getElementById("fehlermeldung").innerHTML = fehlermeldung; 
    if (fehlermeldung == "") {
        document.getElementById("speichern").disabled = false;
    } else {
        document.getElementById("speichern").disabled = true; 
    }
}

function passwortValidierung(passwort) {
    console.log("passwort: " + passwort);
    var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/;

    if (regex.test(passwort)) {
        console.log("Das Passwort ist gültig.");
        return true;
    } else {
        console.log("Das Passwort ist ungültig.");
        return false;
    }
}



</script>
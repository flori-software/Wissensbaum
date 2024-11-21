<?php
include("date_and_time.php");

function MyDatabase() {
    $servername = "localhost";
    $username = "d041fcec";
    $password = "HerrIstMeinSchwertUndSchild777";
    $dbname = "d041fcec";
    $conn = new mysqli($servername, $username, $password, $dbname);
    return $conn;
}

// $text ist nur füe die Bestätigung des Erfolgs bei der Ausführung des Befehls
function standard_sql($abfrage,$text, $datenbank = "standard") {

	$mysqli = MyDatabase();
	
	// Da MYSQL das Datumsformat "0000-00-00" nicht mehr unterstützt, muss hier eine Korrektur vorgenommen werden:
	#echo "Habe folgende Abfrage übernommen:".$abfrage."<p>";
	$abfrage = str_ireplace("'0000-00-00'", "NULL", $abfrage);
	$abfrage = str_ireplace("'NULL'", "NULL", $abfrage);
	$id_eintrag = 0;

	if (!$mysqli->query($abfrage)) {
		echo("ERROR: $text: $abfrage <p>");
	}
	else {
		$id_eintrag = $mysqli->insert_id;
		// Wenn ein UPDATE Befehl ausgeführt wurde, gibt es keine $id_eintrag -> deshalb wird die id hier festgelegt weil save_and_update_parentwindow wissen muss, ob das Speiuchern geklappt hat
		if($id_eintrag == 0) {$id_eintrag = 1000000042;}	
	}
	$mysqli->close();
	return $id_eintrag;
}

function monate() {
    $monate = array("", "Januar", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember");
    return $monate;
}


function PostMyVar($x, $leer, $unwanted_value = "") {
	$mysqli=MyDatabase();
	if (isset($_POST["$x"]) && $_POST["$x"]!=$unwanted_value) {
		$myVar=$_POST["$x"];
	}
	else {
		$myVar=$leer;
	}
	// NULL Werte sollen ohne Anführungszeichen gespeichert werden
	return $myVar;
}

function GetMyVar($x, $leer, $unwanted_value = "") {
	$mysqli=MyDatabase();
	if (isset($_GET["$x"]) && $_GET["$x"]!=$unwanted_value) {
		$myVar=$_GET["$x"];
	}
	else {
		$myVar=$leer;
	}
	// NULL Werte sollen ohne Anführungszeichen gespeichert werden
	return $myVar;
}


?>

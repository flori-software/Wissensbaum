<?php

// 5c. Aus nummerischen Werten für Stunde und Uhrzeit wird eine Stringvariable im TIME-Format gebildet

function create_time_var($stunde,$minute) {
	if ($stunde<10) {$stunde='0'.$stunde;}
	if ($minute<10) {$minute='0'.$minute;}
	$zeit=$stunde.':'.$minute.':00';
	return $zeit;
	}
	
function create_date_var($jahr, $monat, $tag){
	// Die Funktion geht davon aus, dass die übergebenen Werte INT sind
	// Für den Fall dass es Stringwerte wären, müssen die konverteiert werden
	$jahr  = intval($jahr);
	$monat = intval($monat);
	$tag   = intval($tag);
	if ($jahr < 1000) {$jahr = jahreszahl();}
	if ($monat < 10) {$monat = "0".$monat;}
	if ($tag < 10) {$tag = "0".$tag;}
	$datum = $jahr."-".$monat."-".$tag;
	return $datum;	
}
// 7. Ein normales Datum nach US Format in UNIX Timestamp konvertieren

function f_timestamp($datum) {
	$timestamp=strtotime($datum);
    return $timestamp;
	}

// 8. Ein Datum um x Tage erhöhen

function f_datum_rauf($datum, $anzahl_tage) {
    $timezone = new DateTimeZone('Europe/Berlin');
    $datetime = new DateTime($datum, $timezone);
	// Hier wird unterschieden, ob Tage dazugezählt oder abgezogen werden sollen
	if($anzahl_tage > 0) {
		$datetime->modify("+".$anzahl_tage." days");
	} else {
		$anzahl_tage = $anzahl_tage * -1;
		$datetime->modify("-".$anzahl_tage." days");
	}
    
    return $datetime->format('Y-m-d');
}

function datum_uhrzeit_rauf($datum, $uhrzeit, $minuten) {
	// Im Gegensatz zu f_datum_rauf wird hier kein Datum, sondern TIMESTAMP zurückgegeben!
	$timestamp = strtotime($datum." ".$uhrzeit);
	$sekunden  = $minuten * 60;
	$timestamp=$timestamp + $sekunden;
	return $timestamp;
}

function datum_monate_rauf($datum, $monate) {
	$das_datum = explode("-", $datum);
	$jahr      = $das_datum[0];
	$monat     = $das_datum[1];
	$tag 	   = $das_datum[2];
	$monat = intval($monat);
	$jahr  = intval($jahr);
	$monat = $monat + $monate;
	// Übergang des Datums ins nächste Jahr
	while ($monat > 12) {
		$jahr++;
		$monat = $monat - 12;
	}

	// Beim zurückgehen, wenn $monate negativ ist:
	while ($monat <= 0) {
		$jahr--;
		$monat = $monat + 12;
	}

	// Da in der Funktion create_date_var einstelligen Werten eine 0 vorgesetzt wird, muss sie hier entfernt werden, falls sie bereits da ist (sonst entsteht z.B. 001)
	$monat = intval($monat);
	$tag   = intval($tag); 
	$datum = create_date_var($jahr, $monat, $tag);
	
	while(!validateDate($datum, "Y-m-d")) {
		// Wenn ich den 31. Januar um einen Monat erhöhe, kommt ein ungültiges Datum raus
		$datum_array = array_aus_datum($datum);
		$datum_array[2]--;
		$datum = create_date_var($datum_array[0], $datum_array[1], $datum_array[2]);
	}
	
	return $datum;
}

function datum_jahr_tauschen($datum, $jahr) {
	$monat      = monat_aus_datum($datum);
	$tag 		= tag_aus_datum($datum);
	$datum = create_date_var($jahr, $monat, $tag);
	// Aufgrund der Schaltjahre muss das Datum auch hier noch validiert werden
	while(!validateDate($datum, "Y-m-d")) {
		// Wenn ich den 31. Januar um einen Monat erhöhe, kommt ein ungültiges Datum raus
		$datum_array = array_aus_datum($datum);
		$datum_array[2]--;
		$datum = create_date_var($datum_array[0], $datum_array[1], $datum_array[2]);
	}
	return $datum;
}

// Funktion übernommen von PHP.net, gibt TRUE oder FALSE zurück - herzlichen Dank!
function validateDate($date, $format = 'Y-m-d H:i:s') {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

//Ausgehend von einem vorgegebenem Datum gehen wir z.B. zum 2. Dienstag kommenden Monat
function zum_xten_wochentag_naechster_monat($datum, $wochentag, $x) {
	$datum = datum_monate_rauf($datum, 1);
	$monat = monat_aus_datum($datum);
	$jahr  = jahr_aus_datum($datum);
	$testdatum = $jahr."-".$monat."-"."01";
	$test = 0;
	do{
		if(wochentag_aus_datum($testdatum) == $wochentag) {
			$test = 1;
		}
		else {
			$testdatum = f_datum_rauf($testdatum, 1);
		}
	} while($test != 1);
	$datum = f_datum_rauf($testdatum, ($x - 1) * 7);
	return $datum;
}

// ERMITTLUNG DER JAHRESZAHL AUS EINEM DATUM
function jahr_aus_datum($datum) {
	$das_jahr=explode("-",$datum);
	$jahr=$das_jahr[0];
	return $jahr;
}

function monat_aus_datum($datum) {
	$das_jahr = explode("-", $datum);
	$monat = $das_jahr[1];
	$monat = intval($monat); // Konvertierung in INT
	return $monat;
}

function tag_aus_datum($datum) {
	$das_jahr = explode("-", $datum);
	$tag = $das_jahr[2];
	$tag = intval($tag); // Konvertierung in INT
	return $tag;
}

function array_aus_datum($datum) {
	$my_array = Array();
	$my_array[0] = jahr_aus_datum($datum);
	$my_array[1] = monat_aus_datum($datum);
	$my_array[2] = tag_aus_datum($datum);
	return $my_array;
}

function erster_des_kommenden_monats($datum) {
	$datum_array = array_aus_datum($datum);
	$datum_array[1]++;
	if($datum_array[1] > 12) {
		$datum_array[0]++;
		$datum_array[1] = $datum_array[1] - 12;
	}
	$datum_array[2] = 1;
	$datum = create_date_var($datum_array[0], $datum_array[1], $datum_array[2]);
	return $datum;
}

function erster_und_letzter_des_monats_aus_datum($datum) {
	$datum_array     = explode("-", $datum);
	$antwort         = Array();
	$antwort[0]      = $datum_array[0]."-".$datum_array[1]."-01";
	$timestamp       = strtotime($datum);
	$anzahl_der_tage = date("t", $timestamp);
	$antwort[1]      = $datum_array[0]."-".$datum_array[1]."-".$anzahl_der_tage;
	return $antwort; 
}

function letzter_tag_des_monats($jahr, $monat) {
	$datum = create_date_var($jahr, $monat, "1");
	$erster_und_letzter_des_monats = erster_und_letzter_des_monats_aus_datum($datum);
	return $erster_und_letzter_des_monats[1];
}

function wochentag_aus_datum($datum) {
	$my_timestamp = strtotime($datum);
	$nr_wochentag = date("w", $my_timestamp);
	return $nr_wochentag;   
}

function kalenderwoche_aus_datum($datum) {
	$my_timestamp  = strtotime($datum);
	$kalenderwoche = date("W", $my_timestamp);
	return $kalenderwoche;   
}

function date_to_datum($datum, $stellen_jahreszahl = 4) {
	if($datum == "" || $datum == "0000-00-00") {
		return "";
	}
	else {
		$das_datum = explode("-",$datum);
		if($stellen_jahreszahl == 2) {
			$das_datum[0] = substr($das_datum[0], 2);
		}
		if($stellen_jahreszahl == 0) {
			$neues_datum = $das_datum[2].'.'.$das_datum[1].'.';
		} else {
			$neues_datum = $das_datum[2].'.'.$das_datum[1].'.'.$das_datum[0];
		}
		
		return $neues_datum;	
	}
}

function datum_to_date($datum) {
	// Zuerst wird überprüft, ob es sich bei der übergebenen Variable überhaupt um ein Datum handelt
	if(validateDate($datum)) {
		// Umwandlung vom europäischen ins amerikanische Format
		$das_datum = explode(".",$datum);
		$datum     = "";
		if(strlen($das_datum[2]) < 4 && $das_datum[2] < 30) {
			$datum .= "20";
		} elseif(strlen($das_datum[2]) < 4) {
			$datum .= "19";
		}
		$datum .= $das_datum[2]."-".$das_datum[1]."-".$das_datum[0];
	} else {
		$datum = "NULL";
	}
	return $datum;
}

// ERMITTLUNG DER FUER DIE UNTERE FUNKTION NOTWENDIGEN JAHRESZAHL

function jahreszahl() {
	$jetzt = time();

	$aktuelles_jahr = date("Y",$jetzt);
	$jahr = GetMyVar("jahr",$aktuelles_jahr);
	return $jahr;

}

function heute_datum() {
	$jetzt = time();
	$heute = date("Y-m-d",$jetzt);
	return $heute;
}

function aktuelle_uhrzeit() {
	$uhrzeit = date("H:i:s");
	return $uhrzeit;	
}

function time_to_uhrzeit($zeit, $forced = false) {
	if(is_null($zeit)) {$zeit = "00:00:00";}
	$uhrzeit = explode(":", $zeit);
	if(count($uhrzeit) == 2 || $forced == true) {
		$neue_zeit = $uhrzeit[0].":".$uhrzeit[1];
	} else {
		$neue_zeit = $zeit;
	}
	return $neue_zeit;
}

function time_to_minutes($zeit) {
	$zeit = strval($zeit);
    $uhrzeit  = explode(":", $zeit);

	// Stunden
	if(isset($uhrzeit[0])) {
		$stunden = intval($uhrzeit[0]);
	} else {
		$stunden = 0;
	}
    
	// Stunden
	if(isset($uhrzeit[1])) {
		$minuten = intval($uhrzeit[1]);
	} else {
		$minuten = 0;
	}

    $ergebnis = $stunden * 60 + $minuten;
    return $ergebnis;
}

function datum_zeit_in_minuten($datumstring) {
    $sekunden = strtotime($datumstring);
    $minuten  = $sekunden / 60;
    return $minuten;
}

function minutenabstand_zwei_uhrzeiten($uhrzeit1, $uhrzeit2, $negativ_erlaubt = false) {
	$minuten1 = time_to_minutes($uhrzeit1);
	$minuten2 = time_to_minutes($uhrzeit2);
	$abstand = $minuten2 - $minuten1;
	if(!$negativ_erlaubt) {
		if($abstand < 0) {$abstand += 1440;} // 1440 Minuten in 24 Std.
	}
	return $abstand;
}

function minutenabstand_zwei_daten($datumstring1, $datumstring2) {
    $minuten1 = datum_zeit_in_minuten($datumstring1);
    $minuten2 = datum_zeit_in_minuten($datumstring2);
    $abstand_in_minuten = $minuten2 - $minuten1;
    return $abstand_in_minuten;
}

function minuten_in_stunden_umrechnen($minuten, $format = "dezimal") {
	$stunden = $minuten / 60;
	if($format == "dezimal") {
		return $stunden;
	} else {
		$stunden = floor($stunden);
		$minuten = $minuten - $stunden * 60;
		if($stunden < 10) {$stunden = "0".$stunden;}
		if($minuten < 10) {$minuten = "0".$minuten;}
		$ergebnis = $stunden.":".$minuten;
		return $ergebnis;
	}
}

function uhrzeiten_addieren($uhrzeiten_array, $format = "dezimal") {
	// Hier werden ausschließlich Zeiten addiert, Ergebnis wie 69 Std. ist möglich
	$minuten = Array();
	foreach ($uhrzeiten_array as $uhrzeit) {
		$minuten[] = time_to_minutes($uhrzeit);
	}
	$summe    = array_sum($minuten);
	$ergebnis = minuten_in_stunden_umrechnen($summe, $format);
	return $ergebnis;
}

function zwei_uhrzeiten_zaehlen($zeit1, $zeit2, $faktor = 1) {
	// Hier muss das Ergebnis eine gültige Uhrzeit sein (im Gegenteil zu uhrzeiten_addieren())
	// Für das addieren von zwei Uhrzeiten bleibt der Faktor 1. 
	// Subtrahieren wäre -1, sost z.B. mit Faktor -4 wäre es möglich das Vierfache einer Zeit von einer anderen abzuziehen usw.
	$minuten1 = time_to_minutes($zeit1);
	$minuten2 = time_to_minutes($zeit2) * $faktor;
	$ergebnis = $minuten1 + $minuten2;
	while($ergebnis < 0) {
		// Beim Subtrahieren von Zeiten könnte das Ergebnis negativ werden
		$ergebnis = $ergebnis + 1440;
	}
	while($ergebnis > 1440) {
		// Beim Subtrahieren von Zeiten könnte das Ergebnis negativ werden
		$ergebnis = $ergebnis - 1440;
	}
	$neue_zeit = minuten_in_stunden_umrechnen($ergebnis, "analog");
	$neue_zeit .= ":00";
	return $neue_zeit;
}


function uhrzeit_hh_mm($uhrzeit){
	$my_array = explode(":", $uhrzeit);
	$antwort  = $my_array[0].":".$my_array[1]; // Sekunden wurden rausgekürzt
	return $antwort;
}

function anzahl_tage($datum1, $datum2) {
	$diff = anzahl_uebernachtungen($datum1, $datum2);
	$diff++;
	return $diff;
}

function anzahl_tage_minutengenau($datum1, $datum2) {
	$minutenabstand = minutenabstand_zwei_daten($datum1, $datum2);
	$tage = $minutenabstand / 1440;
	return $tage;
}

function anzahl_uebernachtungen($datum1, $datum2) {
	$datetime1 = new DateTime($datum1);
	$datetime2 = new DateTime($datum2);
	$interval = $datetime1->diff($datetime2);
	$diff = $interval->format('%d');
	return $diff;
}
	
// DIESE FUNKTION ZEICHNET PFEILE ZUR AUSWAHL DES JAHRES, DAS JAHR WIRD IN DEN PFEILEN MIT DER GET - METHODE ÜBERMITTELT - WEITERE VARIABLEN WIE Z.B. KUNDE MUESSEN IM LINK DER VARIABLE LINK ENTHALTEN SEIN

function jahrespfeile($jahr,$link,$text) {
	echo '<table><tr>';
	echo '<td><span id="my_title">'.$text.'&nbsp;';
	echo $jahr.'&nbsp;&nbsp;&nbsp;&nbsp;</span></td>';
	$pfeil_l="../pics/pfeil_links.jpg";
	$pfeil_lB="../pics/pfeil_links_blau.jpg";
	$pfeil_r="../pics/pfeil_rechts.jpg";
	$pfeil_rB="../pics/pfeil_rechts_blau.jpg";
	$next_year=$jahr+1;
	$last_year=$jahr-1;
	$jsf_l='weiterleitung(\''.$link.'&jahr='.$last_year.'\')';
	$jsf_r='weiterleitung(\''.$link.'&jahr='.$next_year.'\')';
	pfeile_rechts_links($pfeil_l,$pfeil_lB,$pfeil_r,$pfeil_rB,$jsf_l,$jsf_r);
	echo '</tr></table><hr>';
}

function pfeile_rechts_links($pfeil_l,$pfeil_lB,$pfeil_r,$pfeil_rB,$jsf_l,$jsf_r) {
	echo '<td>
		  <img src="'.$pfeil_l.'"
		  name="pfeil_l"
		  onclick="'.$jsf_l.'"
		  onmouseover="f_pfeil_links_blau(\''.$pfeil_lB.'\')"
		  onmouseout="f_pfeil_links(\''.$pfeil_l.'\')"></td>';
	
	echo '<td>
		  <img src="'.$pfeil_r.'"
		  name="pfeil_r"
		  onclick="'.$jsf_r.'"
		  onmouseover="f_pfeil_rechts_blau(\''.$pfeil_rB.'\')"
		  onmouseout="f_pfeil_rechts(\''.$pfeil_r.'\')"></td>';
}

function jahrespfeile_ohne_tabelle($jahr,$link,$text) {
	echo $text.'&nbsp;';
	echo $jahr.'&nbsp;&nbsp;&nbsp;&nbsp;</span></td>';
	$pfeil_l="../pics/pfeil_links.jpg";
	$pfeil_lB="../pics/pfeil_links_blau.jpg";
	$pfeil_r="../pics/pfeil_rechts.jpg";
	$pfeil_rB="../pics/pfeil_rechts_blau.jpg";
	$next_year=$jahr+1;
	$last_year=$jahr-1;
	$jsf_l='weiterleitung(\''.$link.'&jahr='.$last_year.'\')';
	$jsf_r='weiterleitung(\''.$link.'&jahr='.$next_year.'\')';
	pfeile_rechts_links_ohne_tabelle($pfeil_l,$pfeil_lB,$pfeil_r,$pfeil_rB,$jsf_l,$jsf_r);
	
}

function pfeile_rechts_links_ohne_tabelle($pfeil_l,$pfeil_lB,$pfeil_r,$pfeil_rB,$jsf_l,$jsf_r) {
	echo '<img src="'.$pfeil_l.'"
		  name="pfeil_l"
		  onclick="'.$jsf_l.'"
		  onmouseover="f_pfeil_links_blau(\''.$pfeil_lB.'\')"
		  onmouseout="f_pfeil_links(\''.$pfeil_l.'\')">';
	
	echo '<img src="'.$pfeil_r.'"
		  name="pfeil_r"
		  onclick="'.$jsf_r.'"
		  onmouseover="f_pfeil_rechts_blau(\''.$pfeil_rB.'\')"
		  onmouseout="f_pfeil_rechts(\''.$pfeil_r.'\')">';
}

function array_monate($format = "html") {
	if($format == "html") {
		$monate = Array ("", "Januar", "Februar", "M&auml;rz", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember");
	} else {
		$monate = Array ("", "Januar", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember");
	}
	return $monate;
}

function array_wochentage() {
	
	$wochentag[0] = "Sonntag";
	$wochentag[1] = "Montag";
	$wochentag[2] = "Dienstag";
	$wochentag[3] = "Mittwoch";
	$wochentag[4] = "Donnerstag";
	$wochentag[5] = "Freitag";
	$wochentag[6] = "Samstag";
	
	return $wochentag;
}

function array_wochentage_als_datum($datum_von) {
	// Der Anfang der Woche wird hier durch das Anfangsdatum bestimmt, kann jeder beliebige Wochentag sein
	// So kann die Woche z.B. Mittwoch bis Dienstag gehen
	$wochentag = wochentag_aus_datum($datum_von);
	$datum = $datum_von;
	for($cnt = 0; $cnt < 7; $cnt++) {
		$wochentage[$wochentag] = $datum;
		$datum = f_datum_rauf($datum, 1);
		$wochentag++;
		// Wenn eine neue Woche beginnt:
		if($wochentag == 7) {$wochentag = 0;}
	}
	return $wochentage;
}

function array_wochentage_kurzform() {
	$wochentage = Array("So", "Mo", "Di", "Mi", "Do", "Fr", "Sa");
	return $wochentage;
}
?>
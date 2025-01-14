<?php
include("page_start.php");
include("klassen/mariko_sama.php");
include("klassen/klasse_personen.php");
include("klassen/klasse_fortbildung.php");
include("klassen/human_android_comunicator.php");
include("klassen/db_functions.php");

$aktion = $_GET["aktion"] ?? "";
$feldhoehe = $_SESSION["font_size"] * 1.4;
switch($aktion) {
    case 'neue_fobi':
        $fobi = new Fortbildung;
        $fobi->formular_stammdaten();
    break;

    case 'neue_fobi_speichern':
        $fobi = new Fortbildung;
        $fobi->formular_stammdaten_lesen();
        $fobi->speichern();
        echo 'Neue Fortbildung gespeichert.<br>';
    break;

    case 'zeige_fobi':
        $fobi = new Fortbildung;
        $fobi->ID = $_GET["id_fortbildung"];
        $fobi->lesen();
        $fobi->zeige_fobi();
}
echo '<style>
    input {
        width: 80%;
        font-size: '.$_SESSION["font_size"].'px;
        font-weight: lighter;
        height: 40px;
    }
</style>
<span style="font-size: '.$_SESSION["font_size"].'px; font-weight: bold;"><a href="uebersicht.php?aktion=neue_fobi">Neue Fortbildung erfassen</a></span><br>
Stöbern Sie in Ruhe durch unseren Fortbildungskatalog:';

if(isset($_SESSION["id_benutzer"])) {
    $benutzer = new Benutzer(id: $_SESSION["id_benutzer"]);
    echo '<h2>Willkommen '.$benutzer->vorname.' '.$benutzer->nachname.'!</h2>';
    echo 'Stöbern Sie in Ruhe durch den für Sie zusammengestellten Fortbildungskatalog:';
    $fortbildungen = Fortbildung::alle_lesen();
    echo '<table>';
    foreach($fortbildungen as $fobi) {
        echo '<tr>';
        echo '<td style="width: 80%; font-size: '.$_SESSION["font_size"].'px;">'.date_to_datum($fobi->datum).' '.$fobi->titel.'</td>';
        echo '<td style="width: 20%; font-size: '.$_SESSION["font_size"].'px;"><a href="uebersicht.php?aktion=zeige_fobi&id_fortbildung='.$fobi->ID.'">Details</a></td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo '<h2>Willkommen!</h2>';
    echo '<p>Bitte loggen Sie sich ein, um in einem speziell für Sie zusammengestellten Fortbildungskatalog zu stöbern.</p>';
}




include("page_end.php");
?>

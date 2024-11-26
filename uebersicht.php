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




include("page_end.php");
?>

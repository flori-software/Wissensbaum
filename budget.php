<?php
include("page_start.php");
include("klassen/mariko_sama.php");
include("klassen/klasse_budget.php");

echo '<div style="font-family: QuicksandLight;
font-size: '.$_SESSION["font_size"].'px;
font-weight: lighter;">';

echo 'Hier erfahren Sie Details über das Jahresbudget der Nachtunterkunft St. Spiridon..';
$kostenstellen = Kostenstelle::get_alle_kostenstellen();

echo 'Kostenstellen:';
echo '<pre>', print_r($kostenstellen), '</pre>';

include("page_end.php");
?>
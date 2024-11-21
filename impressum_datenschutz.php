<?php
include("page_start.php");


echo '<div style="font-family: QuicksandLight;
font-size: '.$_SESSION["font_size"].'px;
font-weight: lighter; width: 99%;">';

// Impressum
echo '
<p style="font-size: '.$_SESSION["font_size"] * 1.2.'; font-weight: bold;">Impressum</p>
<span class="normaler_text">Verantwortlich f&uuml;r diese Webseite ist:<br>
flori-software UG (haftungsbeschr&auml;nkt)<br>
Neustadter Str. 48<br>
96487 D&ouml;rfles – Esbach<br> 
Tel.: 0176 642 755 72<br>
Gesch&auml;ftsf&uuml;hrer: Arkadiusz Paluszek<br>
<p>
Die Gesellschaft ist im Handelsregister B des Amtsgerichts Coburg unter der Nr. HRB 6152 registriert.</p></span>';

// Datenschutzerklärung
echo '


<p style="font-size: '.$_SESSION["font_size"] * 1.2.'; font-weight: bold;">Datenschutzerklärung</p>

    <span style="font-size: '.$_SESSION["font_size"] * 1.1.'; font-weight: bold;">1. Verantwortliche Stelle</span>
    <p>
        Verantwortliche Stelle im Sinne der Datenschutzgesetze ist:<br>
        flori-software UG(haftungsbeschränkt)<br>
        Neustadter Str. 48<br>
        96487 Dörfles – Esbach<br>
        0176 642 755 72<br>
        a.paluszek@fortotschka.de
    </p>

    <span style="font-size: '.$_SESSION["font_size"] * 1.1.'; font-weight: bold;">2. Erhebung und Verarbeitung personenbezogener Daten</span>
    <p>
        a) Beim Registrieren als Vereinsmitglied erheben wir folgende personenbezogene Daten: Name, Vorname, Postanschrift, eine der folgenden Angaben: Festnetztelefon, Mobiltelefon oder E-Mail-Adresse sowie Zahlungsmethode für den Vereinsbeitrag.
    </p>
    <p>
        b) Die Daten werden über ein Formular auf unserer Website erhoben und für folgende Zwecke verwendet:
    </p>
    <ul>
        <li>Einzug des Vereinsbeitrags</li>
        <li>Erstellung von Spendenquittungen</li>
        <li>Kontaktaufnahme zu Mitgliedern für Einladungen zu Mitgliederversammlungen oder Informationen über das Erscheinen eines neuen Rundbriefs auf der Website.</li>
    </ul>

    <span style="font-size: '.$_SESSION["font_size"] * 1.1.'; font-weight: bold;">3. Speicherdauer der Daten</span>
    <p>
        Die Daten werden solange gespeichert, wie sie für die oben genannten Zwecke erforderlich sind. Bei Austritt eines Mitglieds werden die Daten im nächsten Jahr nach Erstellung der Spendenquittung gelöscht. Jedes Mitglied hat zudem die Möglichkeit, seine Daten über sein Benutzerkonto jederzeit selbst zu löschen.
    </p>

    <span style="font-size: '.$_SESSION["font_size"] * 1.1.'; font-weight: bold;">4. Sicherheit</span>
    <p>
        Wir treffen angemessene Sicherheitsmaßnahmen, um die personenbezogenen Daten zu schützen. Die Kommunikation zwischen Benutzer und Website sowie die Daten in der Datenbank werden verschlüsselt.
    </p>

    <span style="font-size: '.$_SESSION["font_size"] * 1.1.'; font-weight: bold;">5. Rechte der Nutzer</span>
    <p>
        Jedes Vereinsmitglied hat das Recht, seine gespeicherten Daten einzusehen, zu bearbeiten oder zu löschen. Dies kann über den Bereich "Mein Konto" auf der Website erfolgen.
    </p>

    <span style="font-size: '.$_SESSION["font_size"] * 1.1.'; font-weight: bold;">6. Weitergabe an Dritte</span>
    <p>
        Die Daten werden nicht an Dritte weitergegeben, außer an unseren Webspace-Anbieter, der statistische Daten wie die geographische Region des Website-Besuchers erheben kann.
    </p>

    <span style="font-size: '.$_SESSION["font_size"] * 1.1.'; font-weight: bold;">7. Zugriff auf die Daten</span>
    <p>
        Zugriff auf die gespeicherten Daten haben ausschließlich der Vorstand des Vereins oder von ihm beauftragte Vereinsmitglieder, die mit dem Einzug der Mitgliedsbeiträge, dem Rechnungswesen oder der Kassenprüfung betraut sind.
    </p>
    </div>

    <footer>
        Für Fragen zum Datenschutz stehen wir gerne zur Verfügung. Sie können uns unter contact@flori-software.de kontaktieren.
    </footer>

';




include("page_end.php");
?>
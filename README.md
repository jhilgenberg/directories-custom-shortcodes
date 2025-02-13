# Author Directories Display für WordPress

## Beschreibung
Dieses Plugin ermöglicht es, Directory-Einträge des aktuellen Autors mittels eines Shortcodes anzuzeigen. Die Einträge werden in einem modernen, horizontalen Slider-Layout dargestellt.

## Installation
1. Laden Sie den Plugin-Ordner in das `/wp-content/plugins/` Verzeichnis hoch
2. Aktivieren Sie das Plugin im WordPress Admin-Bereich unter "Plugins"

## Verwendung

### Basis-Shortcode 
```
[show_author_directories]
```

### Parameter
Der Shortcode kann mit verschiedenen Parametern angepasst werden:

| Parameter | Beschreibung | Standard | Beispiel |
|-----------|-------------|-----------|-----------|
| post_type | Art der anzuzeigenden Einträge | jobangebote_dir_ltg | post_type="kurse_dir_ltg" |
| title | Überschrift über dem Slider | - | title="Aktuelle Angebote" |
| days | Zeitraum in Tagen für die Anzeige | 0 (alle) | days="30" |
| posts_per_page | Anzahl der anzuzeigenden Einträge | -1 (alle) | posts_per_page="5" |
| order | Sortierreihenfolge | DESC | order="ASC" |
| hide_empty | Versteckt Element wenn keine Einträge vorhanden | no | hide_empty="yes" |
| show_date | Zeigt das Datum an (Kurstermin/Veröffentlichung) | no | show_date="yes" |

### Beispiele

#### Jobangebote der letzten 30 Tage mit Datum
```
[show_author_directories post_type="jobangebote_dir_ltg" title="Aktuelle Jobs" days="30" show_date="yes"]
```

#### Zukünftige Kurse (versteckt wenn keine vorhanden)
``` 
[show_author_directories post_type="kurse_dir_ltg" title="Kommende Kurse" hide_empty="yes"] 
```

#### News mit Überschrift (auch anzeigen wenn leer)
```
[show_author_directories post_type="news_dir_ltg" title="Aktuelle News" hide_empty="no"]
```

### Besonderheiten

#### Kurse (post_type="kurse_dir_ltg")
- Zeigt nur Kurse an, deren Starttermin in der Zukunft liegt
- Sortiert automatisch nach dem nächsten Starttermin
- Der Parameter "days" wird hier nicht berücksichtigt

#### Jobangebote und News
- Können nach Zeitraum gefiltert werden (Parameter "days")
- Werden standardmäßig nach Erstellungsdatum sortiert
- Zeigen das Veröffentlichungsdatum an

## Styling
Das Plugin kommt mit einem integrierten, responsiven Design:
- Moderne Card-Darstellung
- Horizontaler Slider mit Touch-Support
- Navigationspfeile (erscheinen nur wenn nötig)
- Responsive Layout für alle Bildschirmgrößen

## Support
Bei Fragen oder Problemen wenden Sie sich bitte an den Plugin-Autor.

## Changelog

### Version 1.1
- Neuer Parameter hide_empty zum kompletten Ausblenden leerer Elemente
- Anzeige des Veröffentlichungsdatums bei Jobs und News
- Verbesserte Slider-Navigation
- Fehlerbehebung bei der Datumsanzeige von Kursen

### Version 1.0
- Initiale Version
- Unterstützung für Jobangebote und Kurse
- Responsives Slider-Layout
- Zeitraumfilterung
- Spezielle Behandlung von Kursterminen
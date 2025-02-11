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

### Beispiele

#### Jobangebote der letzten 30 Tage
```
[show_author_directories post_type="jobangebote_dir_ltg" title="Aktuelle Jobs" days="30"]
```


#### Zukünftige Kurse
``` 
[show_author_directories post_type="kurse_dir_ltg" title="Kommende Kurse"] 
```


### Besonderheiten

#### Kurse (post_type="kurse_dir_ltg")
- Zeigt nur Kurse an, deren Starttermin in der Zukunft liegt
- Sortiert automatisch nach dem nächsten Starttermin
- Der Parameter "days" wird hier nicht berücksichtigt

#### Jobangebote und andere Post-Types
- Können nach Zeitraum gefiltert werden (Parameter "days")
- Werden standardmäßig nach Erstellungsdatum sortiert

## Styling
Das Plugin kommt mit einem integrierten, responsiven Design:
- Moderne Card-Darstellung
- Horizontaler Slider mit Touch-Support
- Navigationspfeile (erscheinen nur wenn nötig)
- Responsive Layout für alle Bildschirmgrößen

## Support
Bei Fragen oder Problemen wenden Sie sich bitte an den Plugin-Autor.

## Changelog

### Version 1.0
- Initiale Version
- Unterstützung für Jobangebote und Kurse
- Responsives Slider-Layout
- Zeitraumfilterung
- Spezielle Behandlung von Kursterminen
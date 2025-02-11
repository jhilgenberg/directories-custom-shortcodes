<?php
/*
Plugin Name: Author Directories Display
Plugin URI: 
Description: Zeigt Directory-Einträge des aktuellen Autors mittels Shortcode an
Version: 1.0
Author: Julian Hilgenberg
License: GPL v2 or later
*/

// Verhindere direkten Zugriff
if (!defined('ABSPATH')) {
    exit;
}

// Shortcode registrieren
function register_author_directories_shortcode() {
    add_shortcode('show_author_directories', 'display_author_directories');
}
add_action('init', 'register_author_directories_shortcode');

// Shortcode Funktion
function display_author_directories($atts) {
    // Standardwerte für Attribute
    $atts = shortcode_atts(array(
        'post_type' => 'jobangebote_dir_ltg', // Angepasster Post Type
        'posts_per_page' => -1,          
        'orderby' => 'date',             
        'order' => 'DESC',
        'title' => '' // Neue Option für die Überschrift
    ), $atts);

    // Hole die aktuelle Post ID
    $current_post = get_post();
    
    // Wenn kein Post gefunden wurde, return leeren String
    if (!$current_post) {
        return '';
    }

    // Hole den Autor des aktuellen Posts
    $author_id = $current_post->post_author;

    // WP_Query Argumente
    $args = array(
        'post_type' => $atts['post_type'],
        'author' => $author_id,
        'posts_per_page' => $atts['posts_per_page'],
        'orderby' => $atts['orderby'],
        'order' => $atts['order'],
        'post_status' => 'publish'
    );

    // Query ausführen
    $query = new WP_Query($args);

    // Output Buffer starten
    ob_start();

    // Überschrift anzeigen, wenn gesetzt
    if (!empty($atts['title'])) {
        echo '<div class="drts-entity-field-label drts-entity-field-label-type-custom drts-display-element-header"><span>' . esc_html($atts['title']) . '</span></div>';
    }

    // Prüfen ob Posts gefunden wurden
    if ($query->have_posts()) {
        ?>
        <div class="author-directories-container">
            <div class="author-directories-slider">
                <?php
                while ($query->have_posts()) {
                    $query->the_post();
                    ?>
                    <div class="directory-card">
                        <?php if (has_post_thumbnail()): ?>
                            <div class="directory-card-image">
                                <?php the_post_thumbnail('medium'); ?>
                            </div>
                        <?php endif; ?>
                        <div class="directory-card-content">
                            <div class="directory-card-text">
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="directory-excerpt">
                                    <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
                                </div>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="directory-card-button">
                                Mehr erfahren
                            </a>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <button class="slider-nav prev" aria-label="Vorheriger">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6 1.41-1.41z" fill="currentColor"/>
                </svg>
            </button>
            <button class="slider-nav next" aria-label="Nächster">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z" fill="currentColor"/>
                </svg>
            </button>
        </div>
        <?php
    } else {
        echo '<p>Keine Einträge gefunden.</p>';
    }

    // WordPress Reset
    wp_reset_postdata();

    // Output Buffer zurückgeben
    return ob_get_clean();
}

// Ersetze die alte CSS-Funktion mit dieser neuen Version
function add_author_directories_styles() {
    ?>
    <style>
        .author-directories-container {
            position: relative;
            max-width: 100%;
            padding: 0 40px;
            margin: 30px 0;
            background: transparent;
        }

        .author-directories-slider {
            display: flex;
            overflow-x: auto;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            -ms-overflow-style: none;
            gap: 25px;
            padding: 20px 0;
        }

        .author-directories-slider::-webkit-scrollbar {
            display: none;
        }

        .directory-card {
            flex: 0 0 280px;
            background: #ffffff;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            transition: all 0.2s ease;
            overflow: hidden;
            border: 1px solid #e5e5e5;
            display: flex;
            flex-direction: column;
        }

        .directory-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 3px 6px rgba(0,0,0,0.12);
        }

        .directory-card-image {
            width: 100%;
            height: 160px;
            overflow: hidden;
            background: #f5f5f5;
            border-bottom: 1px solid #e5e5e5;
        }

        .directory-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .directory-card-content {
            padding: 16px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            justify-content: space-between;
        }

        .directory-card-text {
            margin-bottom: 16px;
        }

        .directory-card h3 {
            margin: 0 0 8px 0;
            font-size: 1.1em;
            color: #333;
            line-height: 1.4;
        }

        .directory-card h3 a {
            text-decoration: none;
            color: #2271b1;
        }

        .directory-card h3 a:hover {
            color: #135e96;
        }

        .directory-excerpt {
            color: #555;
            font-size: 0.9em;
            line-height: 1.5;
        }

        .directory-card-button {
            display: inline-block;
            padding: 8px 16px;
            background: #2271b1;
            color: white;
            text-decoration: none;
            border-radius: 3px;
            font-size: 0.9em;
            transition: background 0.2s ease;
            text-align: center;
            margin-top: auto;
        }

        .directory-card-button:hover {
            background: #135e96;
            color: white;
        }

        .slider-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 32px;
            height: 32px;
            background: transparent;
            border: none;
            cursor: pointer;
            color: #666;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2;
            padding: 0;
            box-shadow: none;
        }

        .slider-nav svg {
            width: 24px;
            height: 24px;
        }

        .slider-nav:hover {
            background: transparent;
            color: #333;
        }

        .slider-nav.prev {
            left: 5px;
        }

        .slider-nav.next {
            right: 5px;
        }

        @media (max-width: 768px) {
            .directory-card {
                flex: 0 0 260px;
            }
            
            .author-directories-container {
                padding: 0 35px;
            }
        }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const sliders = document.querySelectorAll('.author-directories-slider');
        
        sliders.forEach(slider => {
            const container = slider.closest('.author-directories-container');
            const prevBtn = container.querySelector('.slider-nav.prev');
            const nextBtn = container.querySelector('.slider-nav.next');
            
            if (prevBtn && nextBtn) {
                // Prüfe initial, ob Scroll möglich ist
                checkScrollButtons(slider, prevBtn, nextBtn);
                
                // Scroll-Event-Listener
                slider.addEventListener('scroll', () => {
                    checkScrollButtons(slider, prevBtn, nextBtn);
                });

                prevBtn.addEventListener('click', () => {
                    slider.scrollBy({
                        left: -300,
                        behavior: 'smooth'
                    });
                });

                nextBtn.addEventListener('click', () => {
                    slider.scrollBy({
                        left: 300,
                        behavior: 'smooth'
                    });
                });
            }
        });

        // Hilfsfunktion zum Prüfen der Scroll-Möglichkeiten
        function checkScrollButtons(slider, prevBtn, nextBtn) {
            const isAtStart = slider.scrollLeft <= 0;
            const isAtEnd = slider.scrollLeft >= (slider.scrollWidth - slider.clientWidth - 5);
            
            prevBtn.style.opacity = isAtStart ? '0' : '1';
            prevBtn.style.cursor = isAtStart ? 'default' : 'pointer';
            
            nextBtn.style.opacity = isAtEnd ? '0' : '1';
            nextBtn.style.cursor = isAtEnd ? 'default' : 'pointer';
        }
    });
    </script>
    <?php
}
add_action('wp_head', 'add_author_directories_styles'); 
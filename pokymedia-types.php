<?php

/*
 * Plugin Name: POKYmedia Custom Types
 * Author: František Gič
 * Author URI: https://frantisekgic.sk
 * Description: Custom post types
 * Version: 1.0
 * License: GNU General Public License v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

// Quote
require_once WPMU_PLUGIN_DIR . '/includes/quote.php';

// Testimonial
require_once WPMU_PLUGIN_DIR . '/includes/testimonial.php';

// Event
require_once WPMU_PLUGIN_DIR . '/includes/event.php';

/**
 * Translations
 */
add_action( 'plugins_loaded', function() {
    load_plugin_textdomain( 'pokymedia' );
});

// redirect on homepage
add_action("template_redirect", function () {
    if (is_front_page()) {
        $svadobne = get_term_link('svadobne', 'event_type');
        if (false !== $svadobne) {
            return wp_redirect($svadobne);
        }
    }
});

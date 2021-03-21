<?php

/*
 * Plugin Name: SVG Support for Wordpress
 * Author: František Gič
 * Author URI: https://frantisekgic.sk
 * Description: Allow uploading and inline printing SVG files into wordpress
 * Version: 1.0
 * License: GNU General Public License v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

$svg_mimes = [
    'svg' => 'image/svg',
    'svgz' => 'image/svg+xml'
];

function is_svg($image_id)
{
    global $svg_mimes;
    $mimetype = get_post_mime_type($image_id);
    return in_array($mimetype, array_values($svg_mimes));
}

function load_inline_svg($image_id)
{
    $path = get_attached_file($image_id);

    // Check the SVG file exists
    if (file_exists($path)) {
        // Load and return the contents of the file
        return file_get_contents($path);
    }

    // Return a blank string if we can't find the file.
    return '';
}

// Add svg mimes into allowed mimes
add_filter('upload_mimes', function ($mimes) use ($svg_mimes) {
    $mimes = array_merge($mimes, $svg_mimes);
    return $mimes;
});

add_filter('get_custom_logo', function () {
    $html = '<a href="' . get_site_url() . '">';
    $custom_logo_id = get_theme_mod('custom_logo');

    // If logo is svg image, print inline contents
    if (is_svg($custom_logo_id)) {
        $html .= '<div class="fill-current">' . load_inline_svg($custom_logo_id) . '</div>';
    } else {
        $logo = wp_get_attachment_image_url($custom_logo_id);
        $html .= '<img src="'. esc_url($logo).'" alt="'.get_bloginfo('name') .'">';
    }

    $html .= '</a>';

    return $html;
});

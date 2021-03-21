<?php

/*
 * Plugin Name: POKYmedia Max Upload File Size
 * Author: František Gič
 * Author URI: https://frantisekgic.sk
 * Description: Increases maximum upload file size
 * Version: 1.0
 * License: GNU General Public License v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

const MAXIMUM_ADMIN_UPLOAD_SIZE = 20; // MB's

add_filter('upload_size_limit', function ($size) {
    if (current_user_can('manage_options')) {
        $size = 1024 * 1024 * MAXIMUM_ADMIN_UPLOAD_SIZE;
    }
    return $size;
});


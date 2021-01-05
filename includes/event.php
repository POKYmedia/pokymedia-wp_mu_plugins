<?php

// Event type taxonomy
require_once WPMU_PLUGIN_DIR . '/includes/event-type-taxonomy.php';

add_action('init', function () {
    $labels = [
        'name' => __('Events', 'pokymedia'),
        'singular_name' => __('Event', 'pokymedia'),
        'menu_name' => __('Events', 'pokymedia'),
        'name_admin_bar' => __('Event', 'pokymedia'),
        'add_new' => __('Add New', 'pokymedia'),
        'add_new_item' => __('Add New Event', 'pokymedia'),
        'new_item' => __('New Event', 'pokymedia'),
        'edit_item' => __('Edit Event', 'pokymedia'),
        'view_item' => __('View Event', 'pokymedia'),
        'all_items' => __('All Events', 'pokymedia'),
        'search_items' => __('Search Events', 'pokymedia'),
        'parent_item_colon' => __('Parent Event:', 'pokymedia'),
        'not_found' => __('No Events found.', 'pokymedia'),
        'not_found_in_trash' => __('No Events found in Trash.', 'pokymedia'),
        'archives' => __('Event archives', 'pokymedia'),
        'insert_into_item' => __('Insert into events', 'pokymedia'),
        'uploaded_to_this_item' => __('Uploaded to this movie', 'pokymedia'),
        'filter_items_list' => __('Filter events list', 'pokymedia'),
        'items_list_navigation' => __('Events list navigation', 'pokymedia'),
        'items_list' => __('Events list', 'pokymedia'),
    ];


    register_post_type('event', [
        'public' => true,
        'labels' => $labels,
        'menu_icon' => 'dashicons-camera-alt',
        'rewrite' => ['slug' => 'events'],
        'supports' => [
            'title', 'thumbnail'
        ],
        'menu_position' => 4,
        'taxonomies' => ['event_type']
    ]);
});

// Set main query post_type to events
add_action('pre_get_posts', function ($query) {
    if ($query->is_main_query() && !is_admin()) {
        $query->set('post_type', 'event');
        $query->set('posts_per_page', -1);
    };
});

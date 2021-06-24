<?php

$taxonomy_key = 'event_type';

add_action('init', function () use ($taxonomy_key) {
    $labels = [
        'name' => __('Event Types', 'pokymedia'),
        'singular_name' => __('Event Type', 'pokymedia'),
        'search_items' => __('Search Event Types', 'pokymedia'),
        'all_items' => __('All Event Types', 'pokymedia'),
        'parent_item' => __('Parent Type', 'pokymedia'),
        'parent_item_colon' => __('Parent Type:', 'pokymedia'),
        'edit_item' => __('Edit Type', 'pokymedia'),
        'update_item' => __('Update Type', 'pokymedia'),
        'add_new_item' => __('Add New Event Type', 'pokymedia'),
        'new_item_name' => __('New Event Type Name', 'pokymedia'),
        'menu_name' => __('Event Type', 'pokymedia'),
        'view_item' => __('View Event Types', 'pokymedia'),
        'popular_items' => __('Popular Event Types', 'pokymedia'),
        'separate_items_with_commas' => __('Separate Event Types with commas', 'pokymedia'),
        'add_or_remove_items' => __('Add or remove Event Types', 'pokymedia'),
        'choose_from_most_used' => __('Choose from most used Types', 'pokymedia'),
        'not_found' => __('No Event Types found.', 'pokymedia'),
        'back_to_items' => __('Back to Event Types', 'pokymedia'),
    ];

    register_taxonomy($taxonomy_key, [], [
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'publicly_queryable'=> true,
        'show_in_menu' => true,
        'show_ui' => true,
        'show_in_nav_menus' => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
       // Used for classic editor, not gutenberg
//      'meta_box_cb' => function () use ($taxonomy_key) {
//          $terms = wp_get_object_terms(get_the_ID(), $taxonomy_key);
//            wp_dropdown_categories([
//                'taxonomy' => $taxonomy_key,
//                'option_none_value' => 0,
//                'id' => $terms[0]->term_id,
//                'value_field' => 'slug',
//                'hide_empty' => 0,
//                'name' => "tax_input[$taxonomy_key][]",
//                'selected' => $terms[0]->slug,
//                'orderby' => 'name',
//                'hierarchical' => 0,
//                'show_option_none' => __('Select Event Type', 'pokymedia')
//          ]);
//       },
        'rewrite' => ['slug' => 'types']
    ]);
});

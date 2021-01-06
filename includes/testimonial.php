<?php

add_action('init', function () {
    $labels = array(
        'name' => __('Testimonials', 'pokymedia'),
        'singular_name' => __('Testimonial', 'pokymedia'),
        'menu_name' => __('Testimonials', 'pokymedia'),
        'name_admin_bar' => __('Testimonial', 'pokymedia'),
        'add_new' => __('Add New', 'pokymedia'),
        'add_new_item' => __('Add New Testimonial', 'pokymedia'),
        'new_item' => __('New Testimonial', 'pokymedia'),
        'edit_item' => __('Edit Testimonial', 'pokymedia'),
        'view_item' => __('View Testimonial', 'pokymedia'),
        'all_items' => __('All Testimonials', 'pokymedia'),
        'search_items' => __('Search Testimonials', 'pokymedia'),
        'parent_item_colon' => __('Parent Testimonial:', 'pokymedia'),
        'not_found' => __('No Testimonials found.', 'pokymedia'),
        'not_found_in_trash' => __('No Testimonials found in Trash.', 'pokymedia'),
        'featured_image' => __('Customer photo', 'pokymedia'),
        'set_featured_image' => __('Set photo', 'pokymedia'),
        'remove_featured_image' => __('Remove photo', 'pokymedia'),
        'use_featured_image' => __('Use as customer\'s photo', 'pokymedia'),
        'archives' => __('Testimonial archives', 'pokymedia'),
        'insert_into_item' => __('Insert into testimonials', 'pokymedia'),
        'uploaded_to_this_item' => __('Uploaded to this movie', 'pokymedia'),
        'filter_items_list' => __('Filter testimonials list', 'pokymedia'),
        'items_list_navigation' => __('Testimonials list navigation', 'pokymedia'),
        'items_list' => __('Testimonials list', 'pokymedia'),
    );


    register_post_type('testimonial', [
        'public' => true,
        'labels' => $labels,
        'menu_icon' => 'dashicons-testimonial',
        'has_archive' => false,
        'rewrite' => ['slug' => 'testimonials'],
        'supports' => [
            'title', 'thumbnail','editor'
        ],
        'menu_position' => 7
    ]);
});

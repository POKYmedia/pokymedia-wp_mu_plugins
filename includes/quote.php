<?php

// Register new type
add_action('init', function () {
    $labels = array(
        'name' => __('Quotes', 'pokymedia'),
        'singular_name' => __('Quote', 'pokymedia'),
        'menu_name' => __('Quotes', 'pokymedia'),
        'name_admin_bar' => __('Quote', 'pokymedia'),
        'add_new' => __('Add New Quote', 'pokymedia'),
        'add_new_item' => __('Add New Quote', 'pokymedia'),
        'new_item' => __('New Quote', 'pokymedia'),
        'edit_item' => __('Edit Quote', 'pokymedia'),
        'view_item' => __('View Quote', 'pokymedia'),
        'all_items' => __('All Quotes', 'pokymedia'),
        'search_items' => __('Search Quotes', 'pokymedia'),
        'parent_item_colon' => __('Parent Quote:', 'pokymedia'),
        'not_found' => __('No Quotes found.', 'pokymedia'),
        'not_found_in_trash' => __('No Quotes found in Trash.', 'pokymedia'),
        'featured_image' => __('Customer photo', 'pokymedia'),
        'set_featured_image' => __('Set photo', 'pokymedia'),
        'remove_featured_image' => __('Remove photo', 'pokymedia'),
        'use_featured_image' => __('Use as customer\'s photo', 'pokymedia'),
        'archives' => __('Quote archives', 'pokymedia'),
        'insert_into_item' => __('Insert into quotes', 'pokymedia'),
        'uploaded_to_this_item' => __('Uploaded to this movie', 'pokymedia'),
        'filter_items_list' => __('Filter quotes list', 'pokymedia'),
        'items_list_navigation' => __('Quotes list navigation', 'pokymedia'),
        'items_list' => __('Quotes list', 'pokymedia'),
    );


    register_post_type('quote', [
        'public' => true,
        'labels' => $labels,
        'menu_icon' => 'dashicons-format-quote',
        'has_archive' => false,
        'rewrite' => ['slug' => 'quotes'],
        'supports' => [
            'editor',
        ],
        'menu_position' => 7
    ]);
});


// Register metaboxes
class Quote_MetaBoxes
{
    public function __construct()
    {
        // render meta box html
        add_action('add_meta_boxes', function () {
            add_meta_box(
                'pokymedia-quote_meta',
                __('Quote Meta Information', 'pokymedia'),
                [$this, 'meta_box_html'],
                ['quote']
            );
        });

        // save the quote post type
        add_action('save_post_quote', [$this, 'save_quote']);
        add_filter('wp_insert_post_data', [$this, 'update_quote_title'], 10, 2);
    }

    public function meta_box_html()
    {
        $author = get_post_meta(get_the_ID(), 'pokymedia-quote_author', true);

        // nonce security field
        wp_nonce_field('save_quote', 'quote_nonce');

        ?>
        <label for="pokymedia-quote_author"><?php _e('Author', 'pokymedia') ?>:
            <input type="text" name="pokymedia-quote_author" class="all-options" value="<?php echo $author ?>">
        </label>
        <?php
    }

    public function save_quote($post_id)
    {
        // Check if nonce is set
        if (!isset($_POST['quote_nonce'])) {
            return $post_id;
        }

        if (!wp_verify_nonce($_POST['quote_nonce'], 'save_quote')) {
            return $post_id;
        }

        // Save author if exists
        $author = $_POST['pokymedia-quote_author'];
        if (isset($author) && is_string($author)) {
            $author = sanitize_text_field($author);
            update_post_meta($post_id, 'pokymedia-quote_author', $author);
        }
    }

    function update_quote_title($data, $post)
    {
        if (
            $data['post_type'] == 'quote' &&
            $data['post_status'] != 'auto-draft' &&
            $_GET['action'] != 'trash' &&
            $_GET['action'] != 'untrash'
        ) {
            $title = '';

            // Start title with author if exists
            $author = $post['pokymedia-quote_author'];
            if (isset($author) && is_string($author)) {
                $author = sanitize_text_field($author);

                // Append the author to the title if exists
                if (!empty($author)) {
                    $title .= $author . ' - ';
                }
            }

            $title .= wp_trim_words(($data['post_content']), 10);

            // save the title as post title
            $data['post_title'] = $title;
        }

        return $data;
    }
}

new Quote_MetaBoxes();




<?php
require_once 'inc/taxonomies/TopicsTaxonomy.php';

if (function_exists('wpp_fix_post_time'))
    add_filter('get_the_date', 'wpp_fix_post_time', 10, 2);


load_theme_textdomain('default', get_template_directory() . '/languages');

/**
 * load languages
 */
function setup_theme()
{
    load_theme_textdomain('default', get_template_directory() . '/languages');
    add_theme_support('title-tag');
    register_nav_menu('header-menu', __('Header Menu'));
    register_nav_menu('footer-menu', __('Footer Menu'));
}

add_action('after_setup_theme', 'setup_theme');

function parsav6_scripts()
{
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'parsav6_scripts');

// Change “Read more” link in Wordpress 4.1 to prevent scroll/remove “more-X” hash
function remove_more_link_scroll($link)
{
    $link = preg_replace('|#more-[0-9]+|', '', $link);
    return $link;
}

add_filter('the_content_more_link', 'remove_more_link_scroll');


/**
 * theme panel page
 */
function theme_settings_page()
{
    ?>
    <div class="wrap">
        <h1><?php _e('Theme Panel'); ?></h1>
        <form method="post"
              action="options.php">
            <?php
            settings_fields("section");
            do_settings_sections("theme-options");
            submit_button();
            ?>
        </form>
    </div>
    <?php
}


/**
 * Adding query string to load new version not the cache one
 */
function stylesheet_uri_versioner($stylesheet_uri)
{
    return add_query_arg(array('v' => wp_get_theme()->version), $stylesheet_uri);
}

add_filter('stylesheet_uri', 'stylesheet_uri_versioner');


/**
 * Adding query string to load new version not the cache one
 */
function locale_stylesheet_uri_versioner($localized_stylesheet_uri)
{
    return add_query_arg(array('v' => wp_get_theme()->version), $localized_stylesheet_uri);
}

add_filter('locale_stylesheet_uri', 'locale_stylesheet_uri_versioner');


/**
 * Add theme pannel to the wordpress dashboad menu
 */
function add_theme_menu_item()
{
    add_menu_page(__('Theme Panel'), __('Theme Panel'), "manage_options", "theme-panel", "theme_settings_page", null, 99);
}

add_action("admin_menu", "add_theme_menu_item");


function showing_months_in_archive()
{
    ?>
    <input type="checkbox"
           name="showing_months_in_archive"
           id="showing_months_in_archive" <?= (get_option('showing_months_in_archive')) ? 'checked' : '' ?> />
    <?= (get_option('showing_months_in_archive')) ? __('Active') : __('Deactive') ?>
    <?php
}

function showing_years_in_archive()
{
    ?>
    <input type="checkbox"
           name="showing_years_in_archive"
           id="showing_years_in_archive" <?= (get_option('showing_years_in_archive')) ? 'checked' : '' ?> />
    <?= (get_option('showing_years_in_archive')) ? __('Active') : __('Deactive') ?>
    <?php
}

function meta_tag_option()
{
    ?>
    <input type="checkbox"
           name="meta_tag_option"
           id="meta_tag_option" <?= (get_option('meta_tag_option')) ? 'checked' : '' ?> />
    <?= (get_option('meta_tag_option')) ? __('Active') : __('Deactive') ?>
    <?php
}

function showing_comments_count_in_archive()
{
    ?>
    <input type="checkbox"
           name="showing_comments_count_in_archive"
           id="showing_comments_count_in_archive" <?= (get_option('showing_comments_count_in_archive')) ? 'checked' : '' ?> />
    <?= (get_option('showing_comments_count_in_archive')) ? __('Active') : __('Deactive') ?>
    <?php
}

function display_first_header_link()
{
    ?>
    <?php _e('link'); ?> :
    <input type="text"
           name="first_header_url"
           id="first_header_url"
           value="<?php echo get_option('first_header_url'); ?>"/>
    <?php _e('text'); ?> :
    <input type="text"
           name="first_header_url_text"
           id="first_header_url_text"
           value="<?php echo get_option('first_header_url_text'); ?>"/>
    <?php
}

function display_second_header_link()
{
    ?>
    <?php _e('link'); ?> :
    <input type="text"
           name="second_header_url"
           id="second_header_url"
           value="<?php echo get_option('second_header_url'); ?>"/>
    <?php _e('text'); ?> :
    <input type="text"
           name="second_header_url_text"
           id="second_header_url_text"
           value="<?php echo get_option('second_header_url_text'); ?>"/>
    <?php
}

function display_third_header_link()
{
    ?>
    <?php _e('link'); ?> :
    <input type="text"
           name="third_header_url"
           id="third_header_url"
           value="<?php echo get_option('third_header_url'); ?>"/>
    <?php _e('text'); ?> :
    <input type="text"
           name="third_header_url_text"
           id="third_header_url_text"
           value="<?php echo get_option('third_header_url_text'); ?>"/>
    <?php
}

function display_fourth_header_link()
{
    ?>
    <?php _e('link'); ?> :
    <input type="text"
           name="fourth_header_url"
           id="fourth_header_url"
           value="<?php echo get_option('fourth_header_url'); ?>"/>
    <?php _e('text'); ?> :
    <input type="text"
           name="fourth_header_url_text"
           id="fourth_header_url_text"
           value="<?php echo get_option('fourth_header_url_text'); ?>"/>
    <?php
}

function display_fifth_header_link()
{
    ?>
    <?php _e('link'); ?> :
    <input type="text"
           name="fifth_header_url"
           id="fifth_header_url"
           value="<?php echo get_option('fifth_header_url'); ?>"/>
    <?php _e('text'); ?> :
    <input type="text"
           name="fifth_header_url_text"
           id="fifth_header_url_text"
           value="<?php echo get_option('fifth_header_url_text'); ?>"/>
    <?php
}


function display_first_footer_link()
{
    ?>
    <?php _e('link'); ?> :
    <input type="text"
           name="first_footer_url"
           id="first_footer_url"
           value="<?php echo get_option('first_footer_url'); ?>"/>
    <?php _e('text'); ?> :
    <input type="text"
           name="first_footer_url_text"
           id="first_footer_url_text"
           value="<?php echo get_option('first_footer_url_text'); ?>"/>
    <?php
}

function display_second_footer_link()
{
    ?>
    <?php _e('link'); ?> :
    <input type="text"
           name="second_footer_url"
           id="second_footer_url"
           value="<?php echo get_option('second_footer_url'); ?>"/>
    <?php _e('text'); ?> :
    <input type="text"
           name="second_footer_url_text"
           id="second_footer_url_text"
           value="<?php echo get_option('second_footer_url_text'); ?>"/>
    <?php
}

function display_third_footer_link()
{
    ?>
    <?php _e('link'); ?> :
    <input type="text"
           name="third_footer_url"
           id="third_footer_url"
           value="<?php echo get_option('third_footer_url'); ?>"/>
    <?php _e('text'); ?> :
    <input type="text"
           name="third_footer_url_text"
           id="third_footer_url_text"
           value="<?php echo get_option('third_footer_url_text'); ?>"/>
    <?php
}

function display_fourth_footer_link()
{
    ?>
    <?php _e('link'); ?> :
    <input type="text"
           name="fourth_footer_url"
           id="fourth_header_url"
           value="<?php echo get_option('fourth_footer_url'); ?>"/>
    <?php _e('text'); ?> :
    <input type="text"
           name="fourth_footer_url_text"
           id="fourth_footer_url_text"
           value="<?php echo get_option('fourth_footer_url_text'); ?>"/>
    <?php
}

function display_fifth_footer_link()
{
    ?>
    <?php _e('link'); ?> :
    <input type="text"
           name="fifth_footer_url"
           id="fifth_footer_url"
           value="<?php echo get_option('fifth_footer_url'); ?>"/>
    <?php _e('text'); ?> :
    <input type="text"
           name="fifth_footer_url_text"
           id="fifth_header_url_text"
           value="<?php echo get_option('fifth_footer_url_text'); ?>"/>
    <?php
}

function display_sixth_footer_link()
{
    ?>
    <?php _e('link'); ?> :
    <input type="text"
           name="sixth_footer_url"
           id="sixth_footer_url"
           value="<?php echo get_option('sixth_footer_url'); ?>"/>
    <?php _e('text'); ?> :
    <input type="text"
           name="sixth_footer_url_text"
           id="sixth_header_url_text"
           value="<?php echo get_option('sixth_footer_url_text'); ?>"/>
    <?php
}

function display_seventh_footer_link()
{
    ?>
    <?php _e('link'); ?> :
    <input type="text"
           name="seventh_footer_url"
           id="seventh_footer_url"
           value="<?php echo get_option('seventh_footer_url'); ?>"/>
    <?php _e('text'); ?> :
    <input type="text"
           name="seventh_footer_url_text"
           id="seventh_header_url_text"
           value="<?php echo get_option('seventh_footer_url_text'); ?>"/>
    <?php
}

function display_eighth_footer_link()
{
    ?>
    <?php _e('link'); ?> :
    <input type="text"
           name="eighth_footer_url"
           id="eighth_footer_url"
           value="<?php echo get_option('eighth_footer_url'); ?>"/>
    <?php _e('text'); ?> :
    <input type="text"
           name="eighth_footer_url_text"
           id="eighth_header_url_text"
           value="<?php echo get_option('eighth_footer_url_text'); ?>"/>
    <?php
}

function display_footer_text()
{
    ?>
    <?php _e('text'); ?> :
    <textarea
            type="text"
            name="footer_text"
            id="footer_text"><?php echo htmlentities(get_option('footer_text'), ENT_QUOTES | ENT_IGNORE, "UTF-8"); ?></textarea>
    <?php
}


/**
 * Add theme panel's field
 */
function display_theme_panel_fields()
{
    add_settings_section("section", __('All settings'), null, "theme-options");

    add_settings_field("showing_months_in_archive", __('Showing months in archive'), "showing_months_in_archive", "theme-options", "section");
    add_settings_field("showing_years_in_archive", __('Showing years in archive'), "showing_years_in_archive", "theme-options", "section");

    register_setting("section", "showing_months_in_archive");
    register_setting("section", "showing_years_in_archive");

    add_settings_field("meta_tag_option", __('Meta tag option'), "meta_tag_option", "theme-options", "section");
    register_setting("section", "meta_tag_option");

    add_settings_field("showing_comments_count_in_archive", __('Showing comments count in archive'), "showing_comments_count_in_archive", "theme-options", "section");
    register_setting("section", "showing_comments_count_in_archive");

    add_settings_field("first_header_url", "#1 " . __('Header link'), "display_first_header_link", "theme-options", "section");
    add_settings_field("second_header_url", "#2 " . __('Header link'), "display_second_header_link", "theme-options", "section");
    add_settings_field("third_header_url", "#3 " . __('Header link'), "display_third_header_link", "theme-options", "section");
    add_settings_field("fourth_header_url", "#4 " . __('Header link'), "display_fourth_header_link", "theme-options", "section");
    add_settings_field("fifth_header_url", "#5 " . __('Header link'), "display_fifth_header_link", "theme-options", "section");

    register_setting("section", "first_header_url");
    register_setting("section", "first_header_url_text");

    register_setting("section", "second_header_url");
    register_setting("section", "second_header_url_text");

    register_setting("section", "third_header_url");
    register_setting("section", "third_header_url_text");

    register_setting("section", "fourth_header_url");
    register_setting("section", "fourth_header_url_text");

    register_setting("section", "fifth_header_url");
    register_setting("section", "fifth_header_url_text");

    add_settings_field("first_footer_url", "#1 " . __('Footer link'), "display_first_footer_link", "theme-options", "section");
    add_settings_field("second_footer_url", "#2 " . __('Footer link'), "display_second_footer_link", "theme-options", "section");
    add_settings_field("third_footer_url", "#3 " . __('Footer link'), "display_third_footer_link", "theme-options", "section");
    add_settings_field("fourth_footer_url", "#4 " . __('Footer link'), "display_fourth_footer_link", "theme-options", "section");
    add_settings_field("fifth_footer_url", "#5 " . __('Footer link'), "display_fifth_footer_link", "theme-options", "section");
    add_settings_field("sixth_footer_url", "#6 " . __('Footer link'), "display_sixth_footer_link", "theme-options", "section");
    add_settings_field("seventh_footer_url", "#7 " . __('Footer link'), "display_seventh_footer_link", "theme-options", "section");
    add_settings_field("eighth_footer_url", "#8 " . __('Footer link'), "display_eighth_footer_link", "theme-options", "section");

    register_setting("section", "first_footer_url");
    register_setting("section", "first_footer_url_text");

    register_setting("section", "second_footer_url");
    register_setting("section", "second_footer_url_text");

    register_setting("section", "third_footer_url");
    register_setting("section", "third_footer_url_text");

    register_setting("section", "fourth_footer_url");
    register_setting("section", "fourth_footer_url_text");

    register_setting("section", "fifth_footer_url");
    register_setting("section", "fifth_footer_url_text");

    register_setting("section", "sixth_footer_url");
    register_setting("section", "sixth_footer_url_text");

    register_setting("section", "seventh_footer_url");
    register_setting("section", "seventh_footer_url_text");

    register_setting("section", "eighth_footer_url");
    register_setting("section", "eighth_footer_url_text");


    add_settings_field("footer_text", __('Footer text') . ' (html)', "display_footer_text", "theme-options", "section");
    register_setting("section", "footer_text");
}

add_action("admin_init", "display_theme_panel_fields");


/**
 * Adding extra fields to have metas for posts.
 */
function prfx_custom_meta()
{
    if (!get_option('meta_tag_option')) {
        return;
    }
    add_meta_box('prfx_meta', __('Custom style'), 'prfx_meta_callback', 'post');
}

add_action('add_meta_boxes', 'prfx_custom_meta');


/**
 * the presentaion of custom meta boxs in new_post
 */
function prfx_meta_callback($post)
{
    wp_nonce_field(basename(__FILE__), 'prfx_nonce');
    $prfx_stored_meta = get_post_meta($post->ID);
    ?>
    <p>
        <label for="meta-price"
               class="prfx-row-title"><?php _e('Tag title') ?></label>
        <input type="text"
               name="meta-tag-title"
               id="meta-tag-title"
               value="<?php if (isset ($prfx_stored_meta['meta-tag-title'])) echo $prfx_stored_meta['meta-tag-title'][0]; ?>"/>

        <label for="meta-distance"
               class="prfx-row-title"><?php echo __('Tag color') . ' (hex, i.e: eeffdd)' ?></label>
        <input type="text"
               name="meta-tag-color"
               id="meta-tag-color"
               value="<?php if (isset ($prfx_stored_meta['meta-tag-color'])) echo $prfx_stored_meta['meta-tag-color'][0]; ?>"/>

    </p>
    <?php
}


/**
 * Saves the custom meta input
 */
add_action('save_post', 'prfx_meta_save');
function prfx_meta_save($post_id)
{
    // Checks save status
    $is_autosave = wp_is_post_autosave($post_id);
    $is_revision = wp_is_post_revision($post_id);
    $is_valid_nonce = (isset($_POST['prfx_nonce']) && wp_verify_nonce($_POST['prfx_nonce'], basename(__FILE__))) ? 'true' : 'false';

    // Exits script depending on save status
    if ($is_autosave || $is_revision || !$is_valid_nonce) {
        return;
    }

    // Checks for input and sanitizes/saves if needed
    if (isset($_POST['meta-tag-title'])) {
        update_post_meta($post_id, 'meta-tag-title', sanitize_text_field($_POST['meta-tag-title']));
    }

    if (isset($_POST['meta-tag-color'])) {
        update_post_meta($post_id, 'meta-tag-color', sanitize_text_field($_POST['meta-tag-color']));
    }
}


/**
 * Add user role label next to comments
 */
if (!class_exists('WPB_Comment_Author_Role_Label')) {
    class WPB_Comment_Author_Role_Label
    {

        public function __construct()
        {
            add_filter('get_comment_author', array($this, 'wpb_get_comment_author_role'), 10, 3);
            add_filter('get_comment_author_link', array($this, 'wpb_comment_author_role'));
        }

        // Get comment author role 
        function wpb_get_comment_author_role($author, $comment_id, $comment)
        {
            $authoremail = get_comment_author_email($comment);
            // Check if user is registered
            if (email_exists($authoremail)) {
                $commet_user_role = get_user_by('email', $authoremail);
                $comment_user_role = $commet_user_role->roles[0];
                // HTML output to add next to comment author name
                $this->comment_user_role = ' <span class="comment-author-label comment-author-label-' . $comment_user_role . '">' . __(ucfirst($comment_user_role)) . '</span>';
            } else {
                $this->comment_user_role = '';
            }
            return $author;
        }

        // Display comment author                   
        function wpb_comment_author_role($author)
        {
            return $author .= $this->comment_user_role;
        }
    }

    new WPB_Comment_Author_Role_Label;
}


// Excerpt

function mytheme_custom_excerpt_length($length)
{
    return 20;
}

add_filter('excerpt_length', 'mytheme_custom_excerpt_length', 999);

if (!function_exists('custom_wp_trim_excerpt')) {
    function custom_wp_trim_excerpt($excerpt)
    {
        global $post;
        $raw_excerpt = $excerpt;
        if ($excerpt == '') {
            $excerpt = get_the_content('');
            $excerpt = strip_shortcodes($excerpt);
            $excerpt = apply_filters('the_content', $excerpt);
            $excerpt = wp_trim_words($excerpt, 20);

            $excerpt_readmore = ' <a class="readmore" href="' . esc_url(get_permalink()) . '">read more</a>';
            $excerpt_more = apply_filters('excerpt_more', ' ' . $excerpt_readmore);

            $pos = strrpos($excerpt, '</');
            if ($pos !== false)
                $excerpt = substr_replace($excerpt, $excerpt_readmore, $pos, 0);
            else
                $excerpt .= $excerpt_readmore;

            return $excerpt;
        }
        return apply_filters('custom_wp_trim_excerpt', $excerpt, $raw_excerpt);
    }
}
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'custom_wp_trim_excerpt');


//Remove Category & Tags
function wpsnipp_remove_default_taxonomies()
{
    global $pagenow;

    register_taxonomy('post_tag', array());
    register_taxonomy('category', array());

    $tax = array('post_tag', 'category');

    if ($pagenow == 'edit-tags.php' && in_array($_GET['taxonomy'], $tax)) {
        wp_die('Invalid taxonomy');
    }
}

add_action('init', 'wpsnipp_remove_default_taxonomies');

add_action('init', function () {
    global $wp_taxonomies;
    unregister_taxonomy_for_object_type('category', 'post');
    unregister_taxonomy_for_object_type('post_tag', 'post');
    if (taxonomy_exists('category'))
        unset($wp_taxonomies['category']);
    if (taxonomy_exists('post_tag'))
        unset($wp_taxonomies['post_tag']);
    unregister_taxonomy('category');
    unregister_taxonomy('post_tag');
});


//Taxonomy
    new TopicsTaxonomy();

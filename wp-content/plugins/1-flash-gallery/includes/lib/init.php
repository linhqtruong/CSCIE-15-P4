<?php
/**
 * 
 * Provides the initialization of plugin
 * 
 */

// No direct access to this file
defined('ABSPATH') or die('Restricted access');

// initialization script
function fgallery_init() {
    global $wp_version;
    /**
     * Since register_update_hook seems not to be working properly
     * there is indeed should be another check if the database version is the latest one
     * so it is implemented here
     * I didn't want to make it on init but there is no other way possible :(
     */
    $version = get_option('fgallery_db_version', 0);
    if (version_compare($version, FGALLERY_VERSION, '<')) {
        fgallery_update();
    }
    /**
     * End updating the database
     */
    wp_register_script('uploadify', FGALLERY_PATH.'/js/upload/jquery.uploadify.v2.1.4.min.js',array('jquery'));
    wp_register_script('uploadjs', FGALLERY_PATH.'/js/upload/fgallery_upload.js',array('jquery'));
    wp_register_script('fgalleryedit', FGALLERY_PATH.'/js/pages/fgallery_edit.js',array('jquery', 'jquery-ui-sortable'));
    wp_register_script('fgalleryjs', FGALLERY_PATH.'/js/pages/fgallery.js',array('jquery'));
    wp_register_script('fgalleryimages', FGALLERY_PATH.'/js/pages/fgallery_images.js',array('jquery'));
    wp_register_script('configurator', FGALLERY_PATH.'/js/pages/configurator.js',array('jquery', 'jquery-ui-slider'));
    wp_register_script('gallery', FGALLERY_PATH.'/js/gallery/photoGallery.js',array('jquery'));
    wp_register_script('fileuploader',FGALLERY_PATH.'/js/upload/jquery.fileuploader.js', array('jquery', 'jquery-ui-button', 'jquery-ui-progressbar'));
    wp_register_script('copytoclipboard', FGALLERY_PATH.'/js/ui/ZeroClipboard.js',array('jquery'));
    wp_register_script('copypref', FGALLERY_PATH.'/js/ui/copy.js',array('jquery'));
    wp_register_script('swfhelper', FGALLERY_PATH. '/js/swfhelper.js',array('jquery'));
    wp_register_style('uploadifycss', FGALLERY_PATH. '/css/uploadify.css');
    wp_register_style('fileuploadercss', FGALLERY_PATH. '/css/fileuploader.css');
    wp_register_style('uislidercss', FGALLERY_PATH. '/css/ui/ui.slider.css');
    wp_register_style('uithemecss', FGALLERY_PATH. '/css/ui.theme.css');
    wp_register_style('uitabscss', FGALLERY_PATH. '/css/ui/ui.tabs.css');
    wp_register_style('configuratorcss', FGALLERY_PATH. '/css/configurator.css');
    wp_register_style('farbtasticcss', FGALLERY_PATH. '/css/farbtastic.css');
    wp_register_style('fgallerycss', FGALLERY_PATH. '/css/fgallery.css');
    //needed for flash embeding
    wp_enqueue_script('swfobject');
    wp_enqueue_script('thickbox');
    wp_enqueue_script('swfhelper');
    wp_enqueue_script('gallery');
    wp_enqueue_style('thickbox');
    $data = array('url' => FGALLERY_PATH,
                  'config_url' => fgallery_js_config_url(),
                  'images_url' => fgallery_js_images_url(),
                  'ajax_url' => admin_url('admin-ajax.php'),
                  'plugin_url' => FGALLERY_PATH);
    wp_localize_script('swfhelper', 'FGallery', $data);
    // building menu items
    add_action('admin_menu', 'fgallery_add_pages');
}

// calls scripts for upload page
function fgallery_upload_scripts(){
    wp_enqueue_script('jquery-ui-tabs');
    wp_enqueue_script('jquery-form');
    wp_enqueue_script('fileuploader');
    wp_enqueue_script('uploadjs');
    wp_enqueue_script('uploadify');
    $data = array('fgallery_url'=> FGALLERY_PATH,
                  'upload_url' => fgallery_upload_uploadify_get_url(),
                  'extradir' => EXTRA_DIR,
                  'cover_path' => get_option('siteurl').'/',
                  'delete_text' => __('Delete', 'fgallery'),
                  'save_text' => __('Save', 'fgallery'),
            );
    wp_localize_script('uploadjs', 'uploadifyObj', $data);
}

// calls scripts for gallery index/add/edit pages
function fgallery_admin_scripts() {
    wp_enqueue_script('jquery-form');

    if ( ( isset( $_GET['action'] ) && $_GET['action'] == 'edit' ) || ( isset( $_GET['page'] ) && $_GET['page'] == 'fgallery_add' || $_GET['page'] == 'fgallery_add_fp' ) ) {
        wp_enqueue_script('farbtastic');
        wp_enqueue_script('configurator');
        wp_enqueue_script('jquery-ui-tabs');
        wp_enqueue_script('copytoclipboard');
        wp_enqueue_script('copypref');
    }
    if ( isset( $_GET['action'] ) && $_GET['action'] == 'pref' ) {
        wp_enqueue_script('copytoclipboard');
        wp_enqueue_script('copypref');
    }
    if ( isset( $_GET['action'] ) && $_GET['action'] == 'images' ) {
        wp_enqueue_script('jquery-color');
    }

    wp_enqueue_script('fgalleryedit');
    wp_enqueue_script('fgalleryjs');
}

// calls scripts for images index/add/edit pages
function fgallery_admin_images_scripts(){
    wp_enqueue_script('jquery-form');
    wp_enqueue_script('jquery-ui-droppable');
    wp_enqueue_script('jquery-ui-draggable');
    wp_enqueue_script('fgalleryimages');
}

// calls css files for upload page
function fgallery_upload_styles() {
    wp_enqueue_style('fgallerycss');
    wp_enqueue_style('uploadifycss');
    wp_enqueue_style('uitabscss');
    wp_enqueue_style('uithemecss');
    wp_enqueue_style('fileuploadercss');
}

// calls css files for upload page
function fgallery_admin_styles() {
    wp_enqueue_style('fgallerycss');
    wp_enqueue_style('uitabscss');
    wp_enqueue_style('uithemecss');
    wp_enqueue_style('uislidercss');
    wp_enqueue_style('farbtasticcss');
    wp_enqueue_style('configuratorcss');
}

function fgallery_images_styles(){
    wp_enqueue_style('fgallerycss');
}

function fgallery_settings_styles(){
    wp_enqueue_style('fgallerycss');
}

// adding items to menu
function fgallery_add_pages() {
    $access = get_option('1_flash_gallery_access_level', 'manage_options');

    if( is_super_admin() && ! is_multisite() ) {
        $access = 'manage_options';
    }

    $pref = add_menu_page(__('1 Flash Gallery','fgallery'), __('1 Flash Gallery', 'fgallery'), $access, 'fgallery', 'fgallery_admin_albums');

    if ( function_exists('add_submenu_page') ) {
        $g_list = add_submenu_page('fgallery', __('Galleries List','fgallery'), __('Galleries List','fgallery'), $access, 'fgallery', 'fgallery_admin_albums');
        $add    = add_submenu_page('fgallery', __('Create Gallery','fgallery'), __('Create Gallery','fgallery'), $access, 'fgallery_add', 'fgallery_create_section');
        $add_fp = add_submenu_page('fgallery', __('Create Flip Page Gallery','fgallery'), __('Create Flip Page Gallery','fgallery'), $access, 'fgallery_add_fp', 'fgallery_create_fp_section');
        $images = add_submenu_page('fgallery', __('Images List','fgallery'), __('Images List','fgallery'), $access, 'fgallery_images', 'fgallery_images_page');
        $upload = add_submenu_page('fgallery', __('Upload images','fgallery'), __('Upload Images','fgallery'), $access, 'fgallery_upload', 'fgallery_upload_page');
        $settings=add_submenu_page('fgallery', __('Settings','fgallery'), __('Settings','fgallery'), $access, 'fgallery_settings', 'fgallery_settings_page');
    }

    add_action('admin_print_scripts-' . $upload, 'fgallery_upload_scripts');
    add_action('admin_print_scripts-' . $g_list, 'fgallery_admin_scripts');
    add_action('admin_print_scripts-' . $add, 'fgallery_admin_scripts');
    add_action('admin_print_scripts-' . $add_fp, 'fgallery_admin_scripts');
    add_action('admin_print_scripts-' . $images, 'fgallery_admin_images_scripts');
    add_action('admin_print_styles-' . $upload, 'fgallery_upload_styles' );
    add_action('admin_print_styles-' . $g_list, 'fgallery_admin_styles' );
    add_action('admin_print_styles-' . $add, 'fgallery_admin_styles' );
    add_action('admin_print_styles-' . $add_fp, 'fgallery_admin_styles' );
    add_action('admin_print_styles-' . $images, 'fgallery_images_styles' );
    add_action('admin_print_styles-' . $settings, 'fgallery_settings_styles' );
}
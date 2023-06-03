<?php

/**
 * Portfolio Kit Theme Customizer
 *
 * @package Portfolio Kit
 */



/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function portfolio_kit_customize_register($wp_customize)
{
    $wp_customize->get_setting('blogname')->transport         = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    //select sanitization function
    function portfolio_kit_sanitize_select($input, $setting)
    {
        $input = sanitize_key($input);
        $choices = $setting->manager->get_control($setting->id)->choices;
        return (array_key_exists($input, $choices) ? $input : $setting->default);
    }
    function portfolio_kit_sanitize_image($file, $setting)
    {
        $mimes = array(
            'jpg|jpeg|jpe' => 'image/jpeg',
            'gif'          => 'image/gif',
            'png'          => 'image/png',
            'bmp'          => 'image/bmp',
            'tif|tiff'     => 'image/tiff',
            'ico'          => 'image/x-icon'
        );
        //check file type from file name
        $file_ext = wp_check_filetype($file, $mimes);
        //if file has a valid mime type return it, otherwise return default
        return ($file_ext['ext'] ? $file : $setting->default);
    }

    $wp_customize->add_setting('portfolio_kit_site_tagline_show', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  '',
        'sanitize_callback' => 'absint',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('portfolio_kit_site_tagline_show', array(
        'label'      => __('Hide Site Tagline Only? ', 'portfolio-kit'),
        'section'    => 'title_tagline',
        'settings'   => 'portfolio_kit_site_tagline_show',
        'type'       => 'checkbox',
    ));

    $wp_customize->add_panel('portfolio_kit_settings', array(
        'priority'       => 50,
        'title'          => __('Portfolio Kit Theme settings', 'portfolio-kit'),
        'description'    => __('All Portfolio Kit theme settings', 'portfolio-kit'),
    ));
    $wp_customize->add_section('portfolio_kit_header', array(
        'title' => __('Portfolio Kit Header Settings', 'portfolio-kit'),
        'capability'     => 'edit_theme_options',
        'description'     => __('Portfolio Kit theme header settings', 'portfolio-kit'),
        'panel'    => 'portfolio_kit_settings',

    ));
    $wp_customize->add_setting('portfolio_kit_main_menu_style', array(
        'default'        => 'style1',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'portfolio_kit_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('portfolio_kit_main_menu_style', array(
        'label'      => __('Main Menu Style', 'portfolio-kit'),
        'description' => __('You can set the menu style one or two. ', 'portfolio-kit'),
        'section'    => 'portfolio_kit_header',
        'settings'   => 'portfolio_kit_main_menu_style',
        'type'       => 'select',
        'choices'    => array(
            'style1' => __('Style One', 'portfolio-kit'),
            'style2' => __('Style Two', 'portfolio-kit'),
        ),
    ));

    //portfolio-kit Home intro
    $wp_customize->add_section('portfolio_kit_intro', array(
        'title' => __('Portfolio Intro Settings', 'portfolio-kit'),
        'capability'     => 'edit_theme_options',
        'description'     => __('Portfoli Intro Settings', 'portfolio-kit'),
        'panel'    => 'portfolio_kit_settings',

    ));
    $wp_customize->add_setting('portfolio_kit_intro_show', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  '',
        'sanitize_callback' => 'absint',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('portfolio_kit_intro_show', array(
        'label'      => __('Show Portfolio Intro? ', 'portfolio-kit'),
        'section'    => 'portfolio_kit_intro',
        'settings'   => 'portfolio_kit_intro_show',
        'type'       => 'checkbox',
    ));
    $wp_customize->add_setting('portfolio_kit_intro_img', array(
        'capability'        => 'edit_theme_options',
        'default'           => get_template_directory_uri() . '/assets/img/hero.png',
        'sanitize_callback' => 'portfolio_kit_sanitize_image',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'portfolio_kit_intro_img',
        array(
            'label'    => __('Upload Profile Image', 'portfolio-kit'),
            'description'    => __('Image size should be 450px width & 460px height for better view.', 'portfolio-kit'),
            'section'  => 'portfolio_kit_intro',
            'settings' => 'portfolio_kit_intro_img',
        )
    ));
    $wp_customize->add_setting('portfolio_kit_intro_subtitle', array(
        'default' => __('Welcome To My Website', 'portfolio-kit'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('portfolio_kit_intro_subtitle', array(
        'label'      => __('Intro Subtitle', 'portfolio-kit'),
        'section'    => 'portfolio_kit_intro',
        'settings'   => 'portfolio_kit_intro_subtitle',
        'type'       => 'text',
    ));
    $wp_customize->add_setting('portfolio_kit_intro_title', array(
        'default' => __('Hi I\'m Professional', 'portfolio-kit'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('portfolio_kit_intro_title', array(
        'label'      => __('Intro Title', 'portfolio-kit'),
        'section'    => 'portfolio_kit_intro',
        'settings'   => 'portfolio_kit_intro_title',
        'type'       => 'text',
    ));
    $wp_customize->add_setting('portfolio_kit_intro_designation', array(
        'default' => __('Web Developer', 'portfolio-kit'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('portfolio_kit_intro_designation', array(
        'label'      => __('Designation', 'portfolio-kit'),
        'section'    => 'portfolio_kit_intro',
        'settings'   => 'portfolio_kit_intro_designation',
        'type'       => 'text',
    ));
    $wp_customize->add_setting('portfolio_kit_intro_desc', array(
        'default' => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'wp_kses_post',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('portfolio_kit_intro_desc', array(
        'label'      => __('Intro Description', 'portfolio-kit'),
        'section'    => 'portfolio_kit_intro',
        'settings'   => 'portfolio_kit_intro_desc',
        'type'       => 'textarea',
    ));
    $wp_customize->add_setting('portfolio_kit_btn_text_one', array(
        'default' => __('Hire me', 'portfolio-kit'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control('portfolio_kit_btn_text_one', array(
        'label'      => __('Button one text', 'portfolio-kit'),
        'section'    => 'portfolio_kit_intro',
        'settings'   => 'portfolio_kit_btn_text_one',
        'type'       => 'text',
    ));

    $wp_customize->add_setting('portfolio_kit_btn_url_one', array(
        'default' => '#',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('portfolio_kit_btn_url_one', array(
        'label'      => __('Button one url', 'portfolio-kit'),
        'description'      => __('Keep url empty for hide this button', 'portfolio-kit'),
        'section'    => 'portfolio_kit_intro',
        'settings'   => 'portfolio_kit_btn_url_one',
        'type'       => 'url',
    ));
    $wp_customize->add_setting('portfolio_kit_btn_text_two', array(
        'default'     => __('Download CV', 'portfolio-kit'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control('portfolio_kit_btn_text_two', array(
        'label'      => __('Button two text', 'portfolio-kit'),
        'section'    => 'portfolio_kit_intro',
        'settings'   => 'portfolio_kit_btn_text_two',
        'type'       => 'text',
    ));

    $wp_customize->add_setting('portfolio_kit_btn_url_two', array(
        'default' => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('portfolio_kit_btn_url_two', array(
        'label'      => __('Button two url', 'portfolio-kit'),
        'description'      => __('Keep url empty for hide this button', 'portfolio-kit'),
        'section'    => 'portfolio_kit_intro',
        'settings'   => 'portfolio_kit_btn_url_two',
        'type'       => 'text',
    ));

    //portfolio-kit blog settings
    $wp_customize->add_section('portfolio_kit_blog', array(
        'title' => __('Portfolio Kit Blog Settings', 'portfolio-kit'),
        'capability'     => 'edit_theme_options',
        'description'     => __('Portfolio Kit theme blog settings', 'portfolio-kit'),
        'panel'    => 'portfolio_kit_settings',

    ));
    $wp_customize->add_setting('portfolio_kit_blog_container', array(
        'default'        => 'container',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'portfolio_kit_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('portfolio_kit_blog_container', array(
        'label'      => __('Container type', 'portfolio-kit'),
        'description' => __('You can set standard container or full width container. ', 'portfolio-kit'),
        'section'    => 'portfolio_kit_blog',
        'settings'   => 'portfolio_kit_blog_container',
        'type'       => 'select',
        'choices'    => array(
            'container' => __('Standard Container', 'portfolio-kit'),
            'container-fluid' => __('Full width Container', 'portfolio-kit'),
        ),
    ));
    $wp_customize->add_setting('portfolio_kit_blog_layout', array(
        'default'        => 'fullwidth',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'portfolio_kit_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('portfolio_kit_blog_layout', array(
        'label'      => __('Select Blog Layout', 'portfolio-kit'),
        'description' => __('Right and Left sidebar only show when sidebar widget is available. ', 'portfolio-kit'),
        'section'    => 'portfolio_kit_blog',
        'settings'   => 'portfolio_kit_blog_layout',
        'type'       => 'select',
        'choices'    => array(
            'rightside' => __('Right Sidebar', 'portfolio-kit'),
            'leftside' => __('Left Sidebar', 'portfolio-kit'),
            'fullwidth' => __('No Sidebar', 'portfolio-kit'),
        ),
    ));
    $wp_customize->add_setting('portfolio_kit_blog_style', array(
        'default'        => 'grid',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'portfolio_kit_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('portfolio_kit_blog_style', array(
        'label'      => __('Select Blog Style', 'portfolio-kit'),
        'section'    => 'portfolio_kit_blog',
        'settings'   => 'portfolio_kit_blog_style',
        'type'       => 'select',
        'choices'    => array(
            'grid' => __('Grid Style', 'portfolio-kit'),
            'classic' => __('Classic Style', 'portfolio-kit'),
        ),
    ));
    //portfolio-kit page settings
    $wp_customize->add_section('portfolio_kit_page', array(
        'title' => __('Portfolio Kit Page Settings', 'portfolio-kit'),
        'capability'     => 'edit_theme_options',
        'description'     => __('Portfolio Kit theme blog settings', 'portfolio-kit'),
        'panel'    => 'portfolio_kit_settings',

    ));
    $wp_customize->add_setting('portfolio_kit_page_container', array(
        'default'        => 'container',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'portfolio_kit_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('portfolio_kit_page_container', array(
        'label'      => __('Page Container type', 'portfolio-kit'),
        'description' => __('You can set standard container or full width container for page. ', 'portfolio-kit'),
        'section'    => 'portfolio_kit_page',
        'settings'   => 'portfolio_kit_page_container',
        'type'       => 'select',
        'choices'    => array(
            'container' => __('Standard Container', 'portfolio-kit'),
            'container-fluid' => __('Full width Container', 'portfolio-kit'),
        ),
    ));
    $wp_customize->add_setting('portfolio_kit_page_header', array(
        'default'        => 'show',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'portfolio_kit_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('portfolio_kit_page_header', array(
        'label'      => __('Show Page header', 'portfolio-kit'),
        'section'    => 'portfolio_kit_page',
        'settings'   => 'portfolio_kit_page_header',
        'type'       => 'select',
        'choices'    => array(
            'show' => __('Show all pages', 'portfolio-kit'),
            'hide-home' => __('Hide Only Front Page', 'portfolio-kit'),
            'hide' => __('Hide All Pages', 'portfolio-kit'),
        ),
    ));




    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial(
            'blogname',
            array(
                'selector'        => '.site-title a',
                'render_callback' => 'portfolio_kit_customize_partial_blogname',
            )
        );
        $wp_customize->selective_refresh->add_partial(
            'blogdescription',
            array(
                'selector'        => '.site-description',
                'render_callback' => 'portfolio_kit_customize_partial_blogdescription',
            )
        );
    }
}
add_action('customize_register', 'portfolio_kit_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function portfolio_kit_customize_partial_blogname()
{
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function portfolio_kit_customize_partial_blogdescription()
{
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function portfolio_kit_customize_preview_js()
{
    wp_enqueue_script('portfolio-kit-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array('customize-preview'), PORTFOLIO_KIT_VERSION, true);
}
add_action('customize_preview_init', 'portfolio_kit_customize_preview_js');

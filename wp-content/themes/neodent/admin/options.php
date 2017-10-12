<?php

/**
 * Theme Options Config file
 * For full documentation, please visit: http://docs.reduxframework.com/
 */
if (!class_exists('neodent_Framework_config')) {

    class neodent_Framework_config
    {

        public $args = array();
        public $sections = array();
        public $theme;
        public $ReduxFramework;

        public function __construct()
        {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if (true == Redux_Helpers::isTheme(__FILE__)) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }
        }

        public function initSettings()
        {

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        public function setSections()
        {

            if (_USE_FUNC_FEATURED) :
                //Featured posts section

                $this->sections[] = array(
                    'title' => 'Header options',
                    'icon' => 'el-icon-cogs',
                    'heading' => 'Header section',
                    'fields' => array(
                        array(
                            'id' => 'opt-media',
                            'type' => 'media',
                            'url' => false,
                            'title' => __('Unesite vaš logo', 'redux-framework-demo'),
                            'desc' => __('Ovde kliknite i postavite ili uklonite fotografiju.', 'redux-framework-demo'),
                            'subtitle' => __('Postavite vaš logo koristeći WordPress-ovu biblioteku', 'redux-framework-demo'),
                            'default' => array(
                                'url' => 'http://s.wordpress.org/style/images/codeispoetry.png'
                            ),
                        ),
                        array(
                            'id' => 'opt-media-phone-icon',
                            'type' => 'media',
                            'url' => false,
                            'title' => __('Unesite ikonicu za kontakt', 'redux-framework-demo'),
                            'subtitle' => __('Postavite vašu ikonicu koristeći WordPress-ovu biblioteku', 'redux-framework-demo'),
                        ),
                        array(
                            'id' => 'opt-text',
                            'type' => 'text',
                            'title' => 'Unesite vaš broj telefona',
                            'desc' => __('Primer: 021123456.', 'redux-framework-demo'),
                        ),
                        array(
                            'id' => 'opt-text-2',
                            'type' => 'text',
                            'title' => 'Unesite vaš broj telefona',
                            'desc' => __('Primer: 021123456.', 'redux-framework-demo'),
                        ),
                    ),
                );

                $this->sections[] = array(
                    'title' => 'Woocommerce options',
                    'icon' => 'el-icon-shopping-cart',
                    'heading' => 'Woocommerce options',
                    'fields' => array(
                        array(
                            'id' => 'cart-text',
                            'type' => 'editor',
                            'url' => false,
                            'title' => __('Unesite dodatni text za cart stranicu', 'redux-framework-demo'),
                            'desc' => __('Ovde unesite text koji hocete da se prikazuje na cart stranici.', 'redux-framework-demo'),
                            'subtitle' => __('Postavite dodatni opis cart stranice.', 'redux-framework-demo'),
                            'default' => 'ISPORUKA BRZOM POŠTOM ZA CELU SRBIJU. PREKO 3000 DINARA POŠTARINA JE GRATIS.',
                        )
                    ),
                );

                // $this->sections[] = array(
                //     'title' => __('Footer options', 'redux-framework-demo'),
                //     'icon' => 'el-icon-wordpress',
                //     'fields' => array(
                //         array(
                //             'id' => 'opt-show-featured',
                //             'type' => 'switch',
                //             'title' => __('Show Featured Posts?', 'redux-framework-demo'),
                //             'default' => true,
                //         ),
                //         array(
                //             'id' => 'tag-name',
                //             'type' => 'text',
                //             'title' => __('Choose a featured posts tag', 'redux-framework-demo'),
                //             'desc' => sprintf(__('Use a <a href="%1$s">tag</a> to feature your posts. If no posts match the tag, <a href="%2$s">sticky posts</a> will be displayed instead.', 'wk'), esc_url(add_query_arg('tag', _x('featured', 'featured content default tag slug', 'redux-framework-demo'), admin_url('edit.php'))), admin_url('edit.php?show_sticky=1')),
                //             'default' => 'featured'
                //         ),
                //         array(
                //             'id' => 'hide-tag',
                //             'type' => 'checkbox',
                //             'title' => __('Don&rsquo;t display tag on front end.', 'redux-framework-demo'),
                //             'default' => '1'// 1 = on | 0 = off
                //         ),
                //         array(
                //             'id' => 'max-posts',
                //             'type' => 'text',
                //             'title' => __('Maximum number of featured posts to show', 'redux-framework-demo'),
                //             'default' => '2'
                //         ),
                //     )
                // );

            endif;
        }

        public function setHelpTabs()
        {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            /* $this->args['help_tabs'][] = array(
              'id'      => 'redux-help-tab-1',
              'title'   => __( 'Theme Information 1', 'redux-framework-demo' ),
              'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
              );

              $this->args['help_tabs'][] = array(
              'id'      => 'redux-help-tab-2',
              'title'   => __( 'Theme Information 2', 'redux-framework-demo' ),
              'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
              );

              // Set the help sidebar
              $this->args['help_sidebar'] = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-demo' ); */
        }

        /**
         * All the possible arguments for Redux.
         * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
         * */
        public function setArguments()
        {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name' => 'neodent_theme_settings',
                // This is where your data is stored in the database and also becomes your global variable name.
                'display_name' => $theme->get('Name'),
                // Name that appears at the top of your panel
                'display_version' => $theme->get('Version'),
                // Version that appears at the top of your panel
                'menu_type' => 'menu',
                //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu' => true,
                // Show the sections below the admin menu item or not
                'menu_title' => __('Theme Options', 'redux-framework-demo'),
                'page_title' => __('Theme Options', 'redux-framework-demo'),
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => '',
                // Must be defined to add google fonts to the typography module
                'async_typography' => false,
                // Use a asynchronous font on the front end or font string
                'admin_bar' => true,
                // Show the panel pages on the admin bar
                'global_variable' => '',
                // Set a different name for your global variable other than the opt_name
                'dev_mode' => false,
                // Show the time the page took to load, etc
                'customizer' => true,
                // Enable basic customizer support
                // OPTIONAL -> Give you extra features
                'page_priority' => null,
                // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent' => 'themes.php',
                // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions' => 'manage_options',
                // Permissions needed to access the options panel.
                'menu_icon' => '',
                // Specify a custom URL to an icon
                'last_tab' => '',
                // Force your panel to always open to a specific tab (by id)
                'page_icon' => 'icon-themes',
                // Icon displayed in the admin panel next to your menu_title
                'page_slug' => '_options',
                // Page slug used to denote the panel
                'save_defaults' => true,
                // On load save the defaults to DB before user clicks save or not
                'default_show' => false,
                // If true, shows the default value next to each field that is not the default value.
                'default_mark' => '',
                // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,
                // Shows the Import/Export panel when not used as a field.
                // CAREFUL -> These options are for advanced use only
                'transient_time' => 60 * MINUTE_IN_SECONDS,
                'output' => true,
                // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag' => true,
                // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database' => '',
                // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info' => false,
                // REMOVE
                // HINTS
                'hints' => array(
                    'icon' => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color' => 'lightgray',
                    'icon_size' => 'normal',
                    'tip_style' => array(
                        'color' => 'light',
                        'shadow' => true,
                        'rounded' => false,
                        'style' => '',
                    ),
                    'tip_position' => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect' => array(
                        'show' => array(
                            'effect' => 'slide',
                            'duration' => '500',
                            'event' => 'mouseover',
                        ),
                        'hide' => array(
                            'effect' => 'slide',
                            'duration' => '500',
                            'event' => 'click mouseleave',
                        ),
                    ),
                )
            );


            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            $this->args['share_icons'][] = array(
                'url' => 'https://www.facebook.com/ThemezKitchen',
                'title' => 'Like us on Facebook',
                'icon' => 'el-icon-facebook'
            );
            $this->args['share_icons'][] = array(
                'url' => 'https://twitter.com/themezkitchen',
                'title' => 'Follow us on Twitter',
                'icon' => 'el-icon-twitter'
            );

            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace('-', '_', $this->args['opt_name']);
                }
                $this->args['intro_text'] = __('Thank you for using Verteez premium WordPress themes. Buy more themes from us at <a href="' . esc_url('http://www.themezkitchen.com') . '">Verteez Website</a>.', 'redux-framework-demo');
            } else {
                $this->args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'redux-framework-demo');
            }

            // Add content after the form.
            $this->args['footer_text'] = __('<p>Theme options panel allows you to setup almost every aspect of your theme. Built for user in mind - your favorite Verteez WordPress themes.</p>', 'redux-framework-demo');
        }

    }

    global $reduxConfig;
    $reduxConfig = new neodent_Framework_config();
}

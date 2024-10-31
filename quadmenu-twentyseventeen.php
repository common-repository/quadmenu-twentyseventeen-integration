<?php
/**
 * Plugin Name: QuadMenu - Twenty Seventeen Mega Menu
 * Plugin URI: https://quadmenu.com
 * Description: Integrates QuadMenu with the WordPress TwentySeventeen theme.
 * Version: 1.0.2
 * Author: QuadMenu
 * Author URI: https://quadmenu.com
 * License: GPL
* License: GPLv3
 */
if (!defined('ABSPATH')) {
    die('-1');
}

if (!class_exists('QuadMenu_TwentySeventeen')) :

    final class QuadMenu_TwentySeventeen {

        function __construct() {
            add_action('admin_notices', array($this, 'required'), 10);
            //add_filter('quadmenu_developer_options', array($this, 'options'), 10);
            add_filter('quadmenu_default_themes', array($this, 'themes'), 10);
            add_filter('quadmenu_default_options', array($this, 'general'), 10);
            add_filter('quadmenu_default_options_social', array($this, 'social'), 10);
            add_filter('quadmenu_default_options_theme_twentyseventeen', array($this, 'defaults'), 10);                       
            
            //add_filter('quadmenu_locate_template', array($this, 'theme'), 10, 5);
        }

        function required() {

            $path = 'quadmenu/quadmenu.php';

            if (is_plugin_active($path)) {
                return;
            }

            $all_plugins = get_plugins();

            if (isset($all_plugins[$path])) :

                $plugin = plugin_basename($path);

                $link = '<a href="' . wp_nonce_url('plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1', 'activate-plugin_' . $plugin) . '" class="edit">' . __('activate', 'quadmenu-twentyseventeen') . '</a>';
                ?>

                <div class="updated">
                    <p>
                        <?php printf(__('QuadMenu TwentySeventeen requires QuadMenu. Please %s the QuadMenu plugin.', 'quadmenu-twentyseventeen'), $link); ?>
                    </p>
                </div>

                <?php
            else:
                ?>
                <div class="updated">
                    <p>
                        <?php printf(__('QuadMenu TwentySeventeen requires QuadMenu. Please install the QuadMenu plugin.', 'quadmenu-twentyseventeen'), $link); ?>
                    </p>
                    <p class="submit">
                        <a href="<?php echo admin_url('plugin-install.php?tab=search&type=term&s=quadmenu') ?>" class='button button-secondary'><?php _e('Install QuadMenu', 'quadmenu-twentyseventeen'); ?></a>
                    </p>
                </div>
            <?php
            endif;
        }

        function themes($themes) {

            $themes['twentyseventeen'] = 'TwentySeventeen';

            return $themes;
        }

        function general($defaults) {

            $defaults['viewport'] = 1;
            $defaults['styles'] = 1;
            $defaults['styles_normalize'] = 1;
            $defaults['styles_widgets'] = 1;
            $defaults['styles_icons'] = 'fontawesome';
            $defaults['styles_pscrollbar'] = 1;
            $defaults['gutter'] = 36;            

            $defaults['css'] = '.navigation-top .wrap {
    position: initial;
    padding-top: 0;
    padding-bottom: 0;
    min-height: 60px;
}

.navigation-top .wrap #quadmenu {
    position: absolute;
    top: 0px;
    left: 0;
    right: 0;
}

#quadmenu.quadmenu-twentyseventeen .quadmenu-navbar-toggle {
    margin-left: 36px;
    margin-right: 36px;
}

#quadmenu.quadmenu-twentyseventeen:not(.quadmenu-is-horizontal) .quadmenu-navbar-nav li.quadmenu-item .quadmenu-item-content, 
#quadmenu.quadmenu-twentyseventeen:not(.quadmenu-is-horizontal) .quadmenu-navbar-nav li.quadmenu-item .quadmenu-toggle-container {
    padding-left: 36px;
    padding-right: 36px;
}';

            return $defaults;
        }
        
        function social($social) {
            
            return array(
                array(
                    'title' => 'Facebook',
                    'icon' => 'fa fa-facebook ',
                    'url' => 'https://facebook.com/groups/quadmenu',
                ),
                array(
                    'title' => 'Twitter',
                    'icon' => 'fa fa-twitter',
                    'url' => 'https://facebook.com/groups/quadmenu',
                ),
                array(
                    'title' => 'Google',
                    'icon' => 'fa fa-google-plus',
                    'url' => 'https://facebook.com/groups/quadmenu',
                ),
                array(
                    'title' => 'RSS',
                    'icon' => 'fa fa-rss',
                    'url' => 'https://facebook.com/groups/quadmenu',
                ),
            );
            
        }

        function options($options) {

            // Locations
            // -----------------------------------------------------------------
            $options['top_integration'] = 1;
            $options['top_theme'] = 'twentyseventeen';

            // Themes
            // -----------------------------------------------------------------

            $options['twentyseventeen_theme_title'] = 'TwentySeventeen';
            //$options['twentyseventeen_layout_width_selector'] = '.wrap';
            $options['twentyseventeen_layout'] = 'collapse';
            $options['twentyseventeen_layout_sticky_divider'] = '';
            $options['twentyseventeen_layout_sticky'] = 0;
            $options['twentyseventeen_layout_sticky_offset'] = '90';
            $options['twentyseventeen_layout_divider'] = 'hide';
            $options['twentyseventeen_layout_current'] = 0;
            $options['twentyseventeen_layout_offcanvas_float'] = 'right';
            $options['twentyseventeen_layout_hover_effect'] = '';
            $options['twentyseventeen_layout_breakpoint'] = '768';

            $options['twentyseventeen_navbar_logo_bg'] = 'transparent';

            $options['twentyseventeen_sticky'] = '';
            $options['twentyseventeen_sticky_height'] = '70';
            $options['twentyseventeen_sticky_background'] = 'transparent';
            $options['twentyseventeen_sticky_logo_height'] = '25';

            return $options;
        }

        function defaults($defaults) {

            // Layout
            // -----------------------------------------------------------------
            $defaults['layout'] = 'collapse';
            $defaults['layout_offcanvas_float'] = 'left';
            $defaults['layout_align'] = 'left';
            $defaults['layout_caret'] = 'show';
            $defaults['layout_trigger'] = 'hoverintent';
            $defaults['layout_classes'] = 'wrap';
            $defaults['layout_breakpoint'] = '768';
            $defaults['layout_width_selector'] = '';
            $defaults['layout_hover_effect'] = '';
            $defaults['layout_animation'] = 'quadmenu_btt';

            // Fonts
            // -----------------------------------------------------------------
            $defaults['navbar_font'] = $defaults['font'] = array(
                'font-family' => 'Libre Franklin',
                //'google' => true,
                'font-size' => '14',
                'font-weight' => '600',
            );

            $defaults['dropdown_font'] = array(
                'font-family' => 'Libre Franklin',
                //'google' => true,
                'font-size' => '14',
                'font-weight' => '600',
            );

            // Navbar
            // -----------------------------------------------------------------

            $defaults['navbar_logo'] = array();
            $defaults['navbar_height'] = '60';
            $defaults['navbar_width'] = '260';
            $defaults['navbar_toggle_open'] = '#222222';
            $defaults['navbar_toggle_close'] = '#000000';
            $defaults['navbar_background'] = 'color';
            $defaults['navbar_background_color'] = '#ffffff';
            $defaults['navbar_background_to'] = '#ffffff';

            $defaults['navbar_background_deg'] = '17';
            $defaults['navbar_sharp'] = 'transparent';
            $defaults['navbar_text'] = '#767676';

            $defaults['navbar_logo_height'] = '24';
            $defaults['navbar_link'] = '#222222';
            $defaults['navbar_link_hover'] = '#767676';
            $defaults['navbar_link_bg'] = 'transparent';
            $defaults['navbar_link_bg_hover'] = 'transparent';
            $defaults['navbar_link_hover_effect'] = 'transparent';
            $defaults['navbar_link_margin'] = array('border-top' => '0', 'border-right' => '0', 'border-left' => '0', 'border-bottom' => '0');
            $defaults['navbar_link_radius'] = array('border-top' => '2', 'border-right' => '2', 'border-left' => '2', 'border-bottom' => '2');
            $defaults['navbar_link_transform'] = '';
            $defaults['navbar_link_icon'] = '#767676';
            $defaults['navbar_link_icon_hover'] = '#222222';
            $defaults['navbar_link_subtitle'] = '#767676';
            $defaults['navbar_link_subtitle_hover'] = '#767676';
            $defaults['navbar_button'] = '#ffffff';
            $defaults['navbar_button_hover'] = '#ffffff';
            $defaults['navbar_button_bg'] = '#222222';
            $defaults['navbar_button_bg_hover'] = '#383838';
            $defaults['navbar_badge'] = '#000000';
            $defaults['navbar_badge_color'] = '#ffffff';
            $defaults['navbar_scrollbar'] = '#fb88dd';
            $defaults['navbar_scrollbar_rail'] = '#ffffff';

            // Dropdown
            // -------------------------------------------------------------------------
            $defaults['dropdown_margin'] = 5;
            $defaults['dropdown_radius'] = 0;
            $defaults['dropdown_border'] = array('border-all' => '1', 'border-top' => '1', 'border-color' => '#bbbbbb');
            $defaults['dropdown_background'] = '#ffffff';
            $defaults['dropdown_scrollbar'] = '#222222';
            $defaults['dropdown_scrollbar_rail'] = '#eeeeee';
            $defaults['dropdown_title'] = '#222';
            $defaults['dropdown_title_border'] = array('border-all' => '1', 'border-top' => '1', 'border-color' => '#eee', 'border-style' => 'solid');
            $defaults['dropdown_link'] = '#222';
            $defaults['dropdown_link_hover'] = '#767676';
            $defaults['dropdown_link_bg_hover'] = '#eee';
            $defaults['dropdown_link_border'] = array('border-all' => '0', 'border-top' => '0', 'border-color' => '#eee', 'border-style' => 'solid');
            $defaults['dropdown_link_transform'] = '';
            $defaults['dropdown_button'] = '#ffffff';
            $defaults['dropdown_button_bg'] = '#222222';
            $defaults['dropdown_button_hover'] = '#ffffff';
            $defaults['dropdown_button_bg_hover'] = '#000000';
            $defaults['dropdown_link_icon'] = '#767676';
            $defaults['dropdown_link_icon_hover'] = '#222222';
            $defaults['dropdown_link_subtitle'] = '#767676';
            $defaults['dropdown_link_subtitle_hover'] = '#222222';

            return $defaults;
        }

        function theme($template, $template_name, $template_path, $default_path, $args) {

            if (!empty($args->theme_location) && $args->theme_location == 'top' && $template_name == 'layout/collapse.php') {
                return plugin_dir_path(__FILE__) . '/template/collapsed.php';
            }

            return $template;
        }

        static function activation() {

            update_option('_quadmenu_compiler', true);

            if (class_exists('QuadMenu')) {

                QuadMenu_Redux::add_notification('blue', esc_html__('Thanks for install QuadMenu TwentySeventeen. We have to create the stylesheets. Please wait.', 'quadmenu'));

                QuadMenu_Activation::activation();
            }
        }

    }

    endif; // End if class_exists check

new QuadMenu_TwentySeventeen();

register_activation_hook(__FILE__, array('QuadMenu_TwentySeventeen', 'activation'));

<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://anowar.net
 * @since      1.0.0
 *
 * @package    Wp_Login_Customize
 * @subpackage Wp_Login_Customize/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Login_Customize
 * @subpackage Wp_Login_Customize/admin
 * @author     Anowar Anik <anrctg@gmail.com>
 */
class Wp_Login_Customize_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
        $this->wp_login_customization_options = get_option($this->plugin_name.'-color');
        $this->wp_login_customization_options_bg = get_option($this->plugin_name.'-bg');

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Login_Customize_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Login_Customize_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

        if ( 'settings_page_wp-login-customize' == get_current_screen() -> id ) {
            // CSS stylesheet for Color Picker
            wp_enqueue_style( 'wp-color-picker' );
            // CSS stylesheet for thickbox
            wp_enqueue_style('thickbox');

            wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-login-customize-admin.css', array('wp-clor-picker', 'thickbox'), $this->version, 'all' );
        }

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Login_Customize_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Login_Customize_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

        if ( 'settings_page_wp-login-customize' == get_current_screen() -> id ) {
            wp_enqueue_media();
            wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-login-customize-admin.js', array( 'jquery', 'wp-color-picker' ), $this->version, false );
        }

	}


	/*
	 * add option menu to admin
	 */


    public function add_plugin_admin_menu() {

        add_options_page( 'WP Login Customization Setting', 'WP Login Customization', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page'));
    }

    /*
     * plugin action link
     */
    public function add_action_links( $links ) {
        /*
        *  Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
        */
        $settings_link = array(
            '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
        );
        return array_merge(  $settings_link, $links );

    }

    /**
     * Render the settings page for this plugin.
     *
     * @since    1.0.0
     */

    public function display_plugin_setup_page() {
        include_once( 'partials/wp-login-customize-admin-display.php' );


    }
//register setting for colors
    public function validate_colors($input) {
        // All checkboxes inputs
        $valid = array();


        // Login Customization
        //login bg color
        $valid['login_background_color'] = (isset($input['login_background_color']) && !empty($input['login_background_color'])) ? sanitize_text_field($input['login_background_color']) : '';

        if ( !empty($valid['login_background_color']) && !preg_match( '/^#[a-f0-9]{6}$/i', $valid['login_background_color']  ) ) { // if user insert a HEX color with #
            add_settings_error(
                'login_background_color',                     // Setting title
                'login_background_color_texterror',            // Error ID
                'Please enter a valid hex value color',     // Error message
                'error'                         // Type of message
            );
        }
        //login form color
        $valid['login_form_background_color'] = (isset($input['login_form_background_color']) && !empty($input['login_form_background_color'])) ? sanitize_text_field($input['login_form_background_color']) : '';

        if ( !empty($valid['login_form_background_color']) && !preg_match( '/^#[a-f0-9]{6}$/i', $valid['login_form_background_color']  ) ) { // if user insert a HEX color with #
            add_settings_error(
                'login_form_background_color',                     // Setting title
                'login_form_background_color_texterror',            // Error ID
                'Please enter a valid hex value color',     // Error message
                'error'                         // Type of message
            );
        }

        //button color
        $valid['login_button_primary_color'] = (isset($input['login_button_primary_color']) && !empty($input['login_button_primary_color'])) ? sanitize_text_field($input['login_button_primary_color']) : '';


        if ( !empty($valid['login_button_primary_color']) && !preg_match( '/^#[a-f0-9]{6}$/i', $valid['login_button_primary_color']  ) ) { // if user insert a HEX color with #
            add_settings_error(
                'login_button_primary_color',                     // Setting title
                'login_button_primary_color_texterror',            // Error ID
                'Please enter a valid hex value color',     // Error message
                'error'                         // Type of message
            );
        }
        //button font color
        $valid['login_button_primary_font_color'] = (isset($input['login_button_primary_font_color']) && !empty($input['login_button_primary_font_color'])) ? sanitize_text_field($input['login_button_primary_font_color']) : '';
        if ( !empty($valid['login_button_primary_font_color']) && !preg_match( '/^#[a-f0-9]{6}$/i', $valid['login_button_primary_font_color']  ) ) { // if user insert a HEX color with #
            add_settings_error(
                'login_button_primary_font_color',                     // Setting title
                'login_button_primary_font_color_texterror',            // Error ID
                'Please enter a valid hex value color',     // Error message
                'error'                         // Type of message
            );
        }
        //login_link_color
        $valid['login_link_color'] = (isset($input['login_link_color']) && !empty($input['login_link_color'])) ? sanitize_text_field($input['login_link_color']) : '';

        if ( !empty($valid['login_link_color']) && !preg_match( '/^#[a-f0-9]{6}$/i', $valid['login_link_color']  ) ) { // if user insert a HEX color with #
            add_settings_error(
                'login_link_color',                     // Setting title
                'login_link_color_texterror',            // Error ID
                'Please enter a valid hex value color',     // Error message
                'error'                         // Type of message
            );
        }
        //login_label_color
        $valid['login_label_color'] = (isset($input['login_label_color']) && !empty($input['login_label_color'])) ? sanitize_text_field($input['login_label_color']) : '';

        if ( !empty($valid['login_label_color']) && !preg_match( '/^#[a-f0-9]{6}$/i', $valid['login_label_color']  ) ) { // if user insert a HEX color with #
            add_settings_error(
                'login_label_color',                     // Setting title
                'login_label_color_texterror',            // Error ID
                'Please enter a valid hex value color',     // Error message
                'error'                         // Type of message
            );
        }

        //validate custom field
        $valid['custom_css'] = (isset($input['custom_css']) && !empty($input['custom_css'])) ? sanitize_text_field($input['custom_css']) : 0;
        //return all
        return $valid;
    }



    // setting for background images
    public function validate_bg($input) {
        // All checkboxes inputs
        $valid = array();


        //Logo image id
        $valid['login_logo_id'] = (isset($input['login_logo_id']) && !empty($input['login_logo_id'])) ? absint($input['login_logo_id']) : 0;


        //background image id
        $valid['login_bg_id'] = (isset($input['login_bg_id']) && !empty($input['login_bg_id'])) ? absint($input['login_bg_id']) : 0;
        //background size
        $valid['bg_size'] = (isset($input['bg_size']) && !empty($input['bg_size'])) ? sanitize_text_field($input['bg_size']) : '';
        //background image id of login form
        $valid['login_form_bg_id'] = (isset($input['login_form_bg_id']) && !empty($input['login_form_bg_id'])) ? absint($input['login_form_bg_id']) : 0;
        //background size of form
        $valid['form_bg_size'] = (isset($input['form_bg_size']) && !empty($input['form_bg_size'])) ? sanitize_text_field($input['form_bg_size']) : '';


        //return all
        return $valid;
    }

    public function option_update() {
        register_setting($this->plugin_name.'-color', $this->plugin_name.'-color', array($this, 'validate_color'));
        register_setting($this->plugin_name.'-bg', $this->plugin_name.'-bg', array($this, 'validate_bg'));
    }

    public function logo_size() {
        add_image_size( 'logo-size', 400, 200, false );
        add_image_size( 'bg-size', 99999,99999, false );
    }




//login background for page
    private function wp_login_customization_login_bg_css(){
        if(isset($this->wp_login_customization_options_bg['login_bg_id']) && !empty($this->wp_login_customization_options_bg['login_bg_id'])){
            $login_bg = wp_get_attachment_image_src($this->wp_login_customization_options_bg['login_bg_id'], 'bg-size');
            $login_bg_url = $login_bg[0];
            $bg_size = $this->wp_login_customization_options_bg['bg_size'];
            $login_bg_css  = "body.login{background-image: url(".$login_bg_url.");  background-size: ".$bg_size.";}";
            return $login_bg_css;
        }
    }

//login background for form
    private function wp_login_customization_login_form_bg_css(){
        if(isset($this->wp_login_customization_options_bg['login_form_bg_id']) && !empty($this->wp_login_customization_options_bg['login_form_bg_id'])){
            $login_form_bg = wp_get_attachment_image_src($this->wp_login_customization_options_bg['login_form_bg_id'], 'bg-size');
            $login_form_bg_url = $login_form_bg[0];
            $form_bg_size = $this->wp_login_customization_options_bg['form_bg_size'];
            $login_form_bg_css  = "body.login div#login form#loginform{background-image: url(".$login_form_bg_url.");  background-size: ".$form_bg_size.";}";
            return $login_form_bg_css;
        }
    }

//login logo
    private function wp_login_customization_login_logo_css(){
        if(isset($this->wp_login_customization_options_bg['login_logo_id']) && !empty($this->wp_login_customization_options_bg['login_logo_id'])){
            $login_logo = wp_get_attachment_image_src($this->wp_login_customization_options_bg['login_logo_id'], 'logo-size');
            $login_logo_url = $login_logo[0];
            $login_logo_css  = "body.login h1 a {background-image: url(".$login_logo_url.") !important; width:253px; height:102px; background-size: contain;}";
            return $login_logo_css;
        }
    }


    // Get login form background color
    private function wp_login_csutomization_login_form_background_color(){
        if(isset($this->wp_login_customization_options['login_form_background_color']) && !empty($this->wp_login_customization_options['login_form_background_color']) ){
            $login_form_background_color  = "body.login div#login form#loginform{ background-color:".$this->wp_login_customization_options['login_form_background_color']."!important;}";
            return $login_form_background_color;
        }
    }
    // login page background color
    private function wp_login_csutomization_login_background_color(){
        if(isset($this->wp_login_customization_options['login_background_color']) && !empty($this->wp_login_customization_options['login_background_color']) ){
            $background_color_css  = "body.login{ background-color:".$this->wp_login_customization_options['login_background_color']."!important;}";
            return $background_color_css;
        }
    }
    // login page link color
    private function wp_login_csutomization_login_link_color(){
        if(isset($this->wp_login_customization_options['login_link_color']) && !empty($this->wp_login_customization_options['login_link_color']) ){
            $link_color_css  = ".login #backtoblog a, .login #nav a{ color:".$this->wp_login_customization_options['login_link_color']."!important;}";
            return $link_color_css;
        }
    }
    // login page link color
    private function wp_login_csutomization_login_label_color(){
        if(isset($this->wp_login_customization_options['login_label_color']) && !empty($this->wp_login_customization_options['login_label_color']) ){
            $link_color_css  = "body.login div#login form#loginform p label{ color:".$this->wp_login_customization_options['login_label_color']."!important;}
                                    body.login input[type=checkbox]:checked:before{
                                                    color:".$this->wp_login_customization_options['login_label_color']."!important;
                                                    }
            ";
            return $link_color_css;
        }
    }
    // login custom css
    private function wp_login_csutomization_login_custom_css(){
        if(!empty($this->wp_login_customization_options['custom_css']) ){

            return $this->wp_login_customization_options['custom_css'];
        }
    }
// Get Button and links color is set and different from #00A0D2 return it's css
    private function wp_login_csutomization_button_color(){
        if(isset($this->wp_login_customization_options['login_button_primary_color']) && !empty($this->wp_login_customization_options['login_button_primary_color']) ){
            $button_color = $this->wp_login_customization_options['login_button_primary_color'];
            $links_color = $this->wp_login_customization_options['login_link_color'];
            $border_color = $this->sass_darken($button_color, 10);
            $links_hover_color = $this->sass_darken($links_color, 10);
            $message_color = $this->sass_lighten($button_color, 10);
            $button_color_css = "body.login #nav a, body.login #backtoblog a {
                                   color: ".$links_color." !important;
                  }
                  .login .message {
                   border-left: 4px solid ".$message_color.";
                  }
                  body.login #nav a:hover, body.login #backtoblog a:hover {
                        color: ". $links_hover_color." !important;
                  }

                  body.login .button-primary {
                         background: ".$button_color."; /* Old browsers */
                         background: -moz-linear-gradient(top, ".$button_color." 0%, ". $border_color.", 10%) 100%); /* FF3.6+ */
                         background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,".$button_color."), color-stop(100%, ". $border_color.", 10%))); /* Chrome,Safari4+ */
                         background: -webkit-linear-gradient(top, ".$button_color." 0%, ". $border_color.", 10%) 100%); /* Chrome10+,Safari5.1+ */
                         background: -o-linear-gradient(top, ".$button_color." 0%, ". $border_color.", 10%) 100%); /* Opera 11.10+ */
                         background: -ms-linear-gradient(top, ".$button_color." 0%, ". $border_color.", 10%) 100%); /* IE10+ */
                         background: linear-gradient(to bottom, ".$button_color." 0%, ". $border_color.", 10%) 100%); /* W3C */

                         -webkit-box-shadow: none!important;
                         box-shadow: none !important;

                         border-color:". $border_color."!important;
                    }
                    body.login .button-primary:hover, body.login .button-primary:active {
                         background: ". $border_color."; /* Old browsers */
                         background: -moz-linear-gradient(top, ". $border_color." 0%, ". $border_color.", 10%) 100%); /* FF3.6+ */
                         background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,". $border_color."), color-stop(100%,". $border_color.", 10%))); /* Chrome,Safari4+ */
                         background: -webkit-linear-gradient(top, ". $border_color." 0%,". $border_color.", 10%) 100%); /* Chrome10+,Safari5.1+ */
                         background: -o-linear-gradient(top, ". $border_color." 0%,". $border_color.", 10%) 100%); /* Opera 11.10+ */
                         background: -ms-linear-gradient(top, ". $border_color." 0%,". $border_color.", 10%) 100%); /* IE10+ */
                         background: linear-gradient(to bottom, ". $border_color." 0%,". $border_color.", 10%) 100%); /* W3C */
                    }

                  
                    body.login input[type=checkbox]:focus,
                    body.login input[type=email]:focus,
                    body.login input[type=number]:focus,
                    body.login input[type=password]:focus,
                    body.login input[type=radio]:focus,
                    body.login input[type=search]:focus,
                    body.login input[type=tel]:focus,
                    body.login input[type=text]:focus,
                    body.login input[type=url]:focus,
                    body.login select:focus,
                    body.login textarea:focus {
                    border-color: ".$button_color."!important;
                    -webkit-box-shadow: 0 0 2px ".$button_color."!important;
                    box-shadow: 0 0 2px ".$button_color."!important;
                    }";

            return $button_color_css;
        }
    }

    // login page button font color
    private function wp_login_csutomization_login_button_primary_font_color(){
        if(isset($this->wp_login_customization_options['login_button_primary_font_color']) && !empty($this->wp_login_customization_options['login_button_primary_font_color']) ){
            $login_button_primary_font_color  = "body.login .button-primary { color:".$this->wp_login_customization_options['login_button_primary_font_color']."!important;}";
            return $login_button_primary_font_color;
        }
    }
    /**
     * Lighter the button color: border , hover
     *
     * @since    1.0.0
     */

    private function sass_darken($hex, $percent) {
        preg_match('/^#?([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/i', $hex, $primary_colors);
        str_replace('%', '', $percent);
        $color = "#";
        for($i = 1; $i <= 3; $i++) {
            $primary_colors[$i] = hexdec($primary_colors[$i]);
            $primary_colors[$i] = round($primary_colors[$i] * (100-($percent*2))/100);
            $color .= str_pad(dechex($primary_colors[$i]), 2, '0', STR_PAD_LEFT);
        }

        return $color;
    }

    private function sass_lighten($hex, $percent) {
        preg_match('/^#?([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/i', $hex, $primary_colors);
        str_replace('%', '', $percent);
        $color = "#";
        for($i = 1; $i <= 3; $i++) {
            $primary_colors[$i] = hexdec($primary_colors[$i]);
            $primary_colors[$i] = round($primary_colors[$i] * (100+($percent*2))/100);
            $color .= str_pad(dechex($primary_colors[$i]), 2, '0', STR_PAD_LEFT);
        }

        return $color;
    }




    // Write the actually needed css for login customizations
    public function wp_login_custiomization_login_css(){
        if(!empty($this->wp_login_customization_options_bg['login_logo_id'])
            ||
            !empty($this->wp_login_customization_options_bg['login_bg_id'])
            ||
            !empty($this->wp_login_customization_options_bg['login_form_bg_id'])
            ||
            $this->wp_login_csutomization_login_form_background_color() != null
            ||
            $this->wp_login_csutomization_login_background_color() != null
            ||
            $this->wp_login_csutomization_login_custom_css() != null
            ||
            $this->wp_login_csutomization_login_link_color() != null
            ||
            $this->wp_login_csutomization_button_color() != null
            ||
            $this->wp_login_csutomization_login_button_primary_font_color() != null
            ||
            $this->wp_login_csutomization_login_label_color() != null )
        {
            echo '<style>';
            //login bg
            if($this->wp_login_customization_login_bg_css() != null){
                echo $this->wp_login_customization_login_bg_css();
            }
            //login form bg
            if($this->wp_login_customization_login_form_bg_css() != null){
                echo $this->wp_login_customization_login_form_bg_css();
            }
            //login logo
            if($this->wp_login_customization_login_logo_css() != null){
                echo $this->wp_login_customization_login_logo_css();
            }
            //login background color
            if($this->wp_login_csutomization_login_background_color() != null){
                echo $this->wp_login_csutomization_login_background_color();
            }
            //login form background color
            if($this->wp_login_csutomization_login_form_background_color() != null){
                echo $this->wp_login_csutomization_login_form_background_color();
            }
            //login button
            if($this->wp_login_csutomization_button_color() != null){
                echo $this->wp_login_csutomization_button_color();
            }
            //login button font color
            if($this->wp_login_csutomization_login_button_primary_font_color() != null){
                echo $this->wp_login_csutomization_login_button_primary_font_color();
            }
            //login link color
            if($this->wp_login_csutomization_login_link_color() != null){
                echo $this->wp_login_csutomization_login_link_color();
            }
            //login label color
            if($this->wp_login_csutomization_login_label_color() != null){
                echo $this->wp_login_csutomization_login_label_color();
            }
            //login button
            if($this->wp_login_csutomization_login_custom_css() != null){
                echo $this->wp_login_csutomization_login_custom_css();
            }

            echo '</style>';
        }
    }

}

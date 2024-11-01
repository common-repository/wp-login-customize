<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://anowar.net
 * @since      1.0.0
 *
 * @package    Wp_Login_Customize
 * @subpackage Wp_Login_Customize/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<?php
$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'bg_options';
if( isset( $_GET[ 'tab' ] ) ) {
    $active_tab = $_GET[ 'tab' ];
} // end if


?>

<dvi id="wrapper">


    <h2 class="nav-tab-wrapper">
        <a href="?page=wp-login-customize&tab=bg_options" class="nav-tab <?php echo $active_tab == 'bg_options' ? 'nav-tab-active' : ''; ?>">Background Options</a>
        <a href="?page=wp-login-customize&tab=color_options" class="nav-tab <?php echo $active_tab == 'color_options' ? 'nav-tab-active' : ''; ?>">Color Options & Custom CSS</a>

    </h2>



    <form method="post" name="cleanup_options" action="options.php">

        <?php







;


        ?>

        <table class="form-table">
        <!-- Login page customizations -->
        <?php
        if( $active_tab == 'bg_options' ) {

            //Grab all options
            $options = get_option($this->plugin_name.'-bg');

            //logo
            $login_logo_id = $options['login_logo_id'];
            $login_logo = wp_get_attachment_image_src( $login_logo_id,'medium' ,false);
            $login_logo_url = $login_logo[0];



            //background of page
            $login_bg_id = $options['login_bg_id'];
            $login_bg = wp_get_attachment_image_src( $login_bg_id,'medium',false);
            $login_bg_url = $login_bg[0];

            if (!empty($options['bg_size'])) {
                $login_background_size = $options['bg_size'];
            }else{
                $login_background_size = 'cover';
            }



            //background of form
            $login_form_bg_id = $options['login_form_bg_id'];
            $login_form_bg = wp_get_attachment_image_src( $login_form_bg_id,'medium',false);
            $login_form_bg_url = $login_form_bg [0];
            if (!empty($options['form_bg_size'])) {
                $login_form_background_size = $options['form_bg_size'];
            }else{
                $login_form_background_size = 'cover';
            }


            settings_fields( $this->plugin_name.'-bg' );
            do_settings_sections( $this->plugin_name.'-bg' );

            ?>

        <h2><?php _e('Add logo and Background', $this->plugin_name); ?></h2>


            <tr>
                <th scope="row"> <?php esc_attr_e('Upload Login Logo', $this->plugin_name); ?> </th>
                <td><input type="hidden" id="login_logo_id" name="<?php echo $this->plugin_name.'-bg'; ?>[login_logo_id]"
                           value="<?php echo $login_logo_id; ?>"/>
                    <input id="upload_login_logo_button" type="button" class="button"
                           value="<?php _e('Upload Logo', $this->plugin_name); ?>"/></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <div id="upload_logo_preview"
                         class="wp_cbf-upload-preview-logo <?php if (empty($login_logo_id)) echo 'hidden' ?>">
                        <br>
                        <img src="<?php echo $login_logo_url; ?>"/>
                        <button id="wp_login-delete_logo_button" class="wp_cbf-delete-image">X</button>
                    </div>
                </td>
            </tr>


            <!-- login page bg-->
            <tr>
                <th scope="row"><?php esc_attr_e('Upload Login Page Background', $this->plugin_name); ?></th>

                <td><input type="hidden" id="login_bg_id" name="<?php echo $this->plugin_name.'-bg'; ?>[login_bg_id]"
                           value="<?php echo $login_bg_id; ?>"/>
                    <input id="upload_login_bg_button" type="button" class="button"
                           value="<?php _e('Upload login background', $this->plugin_name); ?>"/></td>

            </tr>

            <tr>
                <td>&nbsp;&nbsp;</td>
                <td>
                    <div id="upload_bg_preview"
                         class="wp_cbf-upload-preview-bg <?php if (empty($login_bg_id)) echo 'hidden' ?>">
                        <br>
                        <img src="<?php echo $login_bg_url; ?>"/>
                        <button id="wp_login-delete_bg_button" class="wp_cbf-delete-image">X</button>
                    </div>
                </td>
            </tr>


            <tr>
                <th>
                    <?php _e('Page Background size ', $this->plugin_name); ?>
                </th>

                <td>
                    <input type="radio" name="<?php echo $this->plugin_name.'-bg'; ?>[bg_size]"
                           value="cover"<?php checked('cover' == $login_background_size); ?> /> Cover
                    <input type="radio" name="<?php echo $this->plugin_name.'-bg'; ?>[bg_size]"
                           value="contain"<?php checked('contain' == $login_background_size); ?> />Contain
                    <input type="radio" name="<?php echo $this->plugin_name.'-bg'; ?>[bg_size]"
                           value="auto"<?php checked('auto' == $login_background_size); ?> />Auto
                </td>
            </tr>

            <!-- login form bg-->
            <tr>
                <th scope="row"><?php esc_attr_e('Upload Login Form Background', $this->plugin_name); ?></th>

                <td>
                    <input type="hidden" id="login_form_bg_id"
                           name="<?php echo $this->plugin_name.'-bg'; ?>[login_form_bg_id]"
                           value="<?php echo $login_form_bg_id; ?>"/>
                    <input id="upload_login_form_bg_button" type="button" class="button"
                           value="<?php _e('Upload login form background', $this->plugin_name); ?>"/>
                </td>

            </tr>

            <tr>
                <td>&nbsp;&nbsp;</td>
                <td>
                    <div id="upload_form_bg_preview"
                         class="wp_cbf-upload-preview-login_form-bg <?php if (empty($login_form_bg_id)) echo 'hidden' ?>">
                        <br>
                        <img src="<?php echo $login_form_bg_url; ?>"/>
                        <button id="wp_login-delete_form_bg_button" class="wp_cbf-delete-image">X</button>
                    </div>
                </td>
            </tr>

            <tr>
                <th>
                    <?php _e('Form Background size ', $this->plugin_name); ?>
                </th>

                <td>
                    <input type="radio" name="<?php echo $this->plugin_name.'-bg'; ?>[form_bg_size]"
                           value="cover"<?php checked('cover' == $login_form_background_size); ?> /> Cover
                    <input type="radio" name="<?php echo $this->plugin_name.'-bg'; ?>[form_bg_size]"
                           value="contain"<?php checked('contain' == $login_form_background_size); ?> />Contain
                    <input type="radio" name="<?php echo $this->plugin_name.'-bg'; ?>[form_bg_size]"
                           value="auto"<?php checked('auto' == $login_form_background_size); ?> />Auto
                </td>
            </tr>

            <!-- end login form bg-->


            <?php
            }else {

            $options = get_option($this->plugin_name.'-color');
            $login_background_color = $options['login_background_color'];
            $login_form_background_color = $options['login_form_background_color'];
            $login_button_primary_color = $options['login_button_primary_color'];
            $login_button_primary_font_color = $options['login_button_primary_font_color'];
            $login_link_color = $options['login_link_color'];
            $login_label_color = $options['login_label_color'];
            $custom_css = $options['custom_css'];

            settings_fields( $this->plugin_name.'-color');
            do_settings_sections( $this->plugin_name.'-color' );

            ?>

            <tr>
                <th colspan="2"><h2><?php _e('Select Colors', $this->plugin_name); ?></h2>
                    <hr>
                </th>
            </tr>

            <tr>
                <th scope="row"><?php _e('Login Pgae Background Color', $this->plugin_name); ?></th>
                <td>
                    <input type="text" class="<?php echo $this->plugin_name; ?>-color-picker"
                           id="<?php echo $this->plugin_name.'-color'; ?>-login_background_color"
                           name="<?php echo $this->plugin_name.'-color'; ?>[login_background_color]"
                           value="<?php echo $login_background_color; ?>"/>
                </td>
            </tr>


            <tr>
                <th scope="row"><?php _e('Login Form Background Color', $this->plugin_name); ?></th>
                <td>
                    <input type="text" class="<?php echo $this->plugin_name; ?>-color-picker"
                           id="<?php echo $this->plugin_name.'-color'; ?>-login_form_background_color"
                           name="<?php echo $this->plugin_name.'-color'; ?>[login_form_background_color]"
                           value="<?php echo $login_form_background_color; ?>"/>
                </td>
            </tr>

            <tr>
                <th><?php _e('Login Button Color', $this->plugin_name); ?></th>
                <td>
                    <input type="text" class="<?php echo $this->plugin_name; ?>-color-picker"
                           id="<?php echo $this->plugin_name.'-color'; ?>-login_button_primary_color"
                           name="<?php echo $this->plugin_name.'-color'; ?>[login_button_primary_color]"
                           value="<?php echo $login_button_primary_color; ?>"/>
                </td>
            </tr>
            <tr>
                <th><?php _e('Login Button Font Color', $this->plugin_name); ?></th>
                <td>
                    <input type="text" class="<?php echo $this->plugin_name; ?>-color-picker"
                           id="<?php echo $this->plugin_name.'-color'; ?>-login_button_primary_font_color"
                           name="<?php echo $this->plugin_name.'-color'; ?>[login_button_primary_font_color]"
                           value="<?php echo $login_button_primary_font_color; ?>"/>
                </td>
            </tr>

            <tr>
                <th scope="row"><?php _e('Login  Links Color', $this->plugin_name); ?></th>
                <td>
                    <input type="text" class="<?php echo $this->plugin_name; ?>-color-picker"
                           id="<?php echo $this->plugin_name.'-color'; ?>-login_link_color"
                           name="<?php echo $this->plugin_name.'-color'; ?>[login_link_color]"
                           value="<?php echo $login_link_color; ?>"/>
                </td>
            </tr>

            <tr>
                <th scope="row"><?php _e('Label color of input fields', $this->plugin_name); ?></th>
                <td>
                    <input type="text" class="<?php echo $this->plugin_name; ?>-color-picker"
                           id="<?php echo $this->plugin_name.'-color'; ?>-login_label_color"
                           name="<?php echo $this->plugin_name.'-color'; ?>[login_label_color]"
                           value="<?php echo $login_label_color; ?>"/>
                </td>
            </tr>


            <tr>
                <th scope="row"><?php esc_attr_e( 'Custom css', $this->plugin_name ); ?></th>
                <td>  <p>Add custom css for login page (<b>don't add &lt; style &gt; tag </b>)</p>
                            <textarea cols="80" rows="10" id="<?php echo $this->plugin_name;?>-custom_css" name="<?php echo $this->plugin_name.'-color';?>[custom_css]"><?php if(!empty($custom_css)) echo $custom_css;?></textarea>
                </td>
            </tr>

            <?php
        }
        ?>

        </table>

        <!-- login buttons and links primary color-->


        <?php submit_button(__('Save all changes', $this->plugin_name), 'primary','submit', TRUE); ?>

    </form>

</dvi>
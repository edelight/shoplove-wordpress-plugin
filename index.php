<?php
/**
 * @package ShopLove Widget Wordpress
 * @version 1.0
 */
/*

Plugin Name: ShopLove Widget Wordpress
Plugin URI: https://github.com/ShopLove/shoplove-wordpress-plugin
Description: Erleichert die Einbindung von ShopLove Widgets in Wordpress Blogs
Author: ShopLove
Version: 1.0
Author URI: http://www.shoplove.com

Copyright (c) 2015 ShopLove

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.

*/

if ( is_admin() ) {
	add_action('admin_menu', 'shoplove_create_menu');
} else {
	add_action( 'wp_enqueue_scripts', 'add_shoplove_widget_script' );
}

function add_shoplove_widget_script () {
	$app_key = get_option( 'application_key' );
	wp_enqueue_script( 'shoplove-widget', 'https://ads.shoplove.com/widget.js?appKey='.$app_key );
}

function shoplove_create_menu() {
	add_menu_page('ShopLove Settings', 'ShopLove Settings', 'administrator', __FILE__, 'shoplove_settings_page' );
	add_action( 'admin_init', 'register_shoplove_settings' );
}

function register_shoplove_settings() {
	register_setting( 'shoplove-settings-group', 'application_key' );
}

function shoplove_settings_page() {
?>
<div class="wrap">
<h2>ShopLove Settings</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'shoplove-settings-group' ); ?>
    <?php do_settings_sections( 'shoplove-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Application Key</th>
        <td><input type="text" name="application_key" value="<?php echo esc_attr( get_option('application_key') ); ?>" /></td>
        </tr>
    </table>
    <?php submit_button(); ?>
</form>
</div>
<?php } ?>
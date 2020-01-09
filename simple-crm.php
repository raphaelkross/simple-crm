<?php
/**
 * Simple CRM
 *
 * @package     SimpleCRM
 * @author      Rafael Angeline
 * @copyright   2016 Rafael Angeline
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: Simple CRM
 * Plugin URI:  http://rafaelangeline.com
 * Description: Simple lead generator form.
 * Version:     1.0.0
 * Author:      Rafael Angeline
 * Author URI:  https://rafaelangeline.com
 * Text Domain: plugin-name
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

// Useful global constants.
define( 'SIMPLE_CRM_VERSION', '1.0.0' );
define( 'SIMPLE_CRM_URL', plugin_dir_url( __FILE__ ) );
define( 'SIMPLE_CRM_PATH', dirname( __FILE__ ) . '/' );
define( 'SIMPLE_CRM_INC', SIMPLE_CRM_PATH . 'includes/' );

// Include files.
require_once SIMPLE_CRM_INC . 'cpt.php';
require_once SIMPLE_CRM_INC . 'class-api.php';
require_once SIMPLE_CRM_INC . 'shortcode.php';

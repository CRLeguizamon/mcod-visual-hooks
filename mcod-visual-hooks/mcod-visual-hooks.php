<?php
/**
 * Plugin Name: MCOD Visual Hooks
 * Plugin URI: https://devcristian.com/mcod-visual-hooks
 * Description: Plugin para agregar ganchos visuales en tu sitio web mediante shortcodes. Muestra métricas como visitantes, testimonios, compradores y descuentos.
 * Version: 1.0.0
 * Author: Cristian Leguizamón - Devcristian
 * Author URI: https://devcristian.com/
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: mcod-visual-hooks
 * Domain Path: /languages
 */

// Evitar acceso directo
if (!defined('ABSPATH')) {
    exit;
}

// Definir constantes del plugin
define('MCOD_VISUAL_HOOKS_VERSION', '1.0.0');
define('MCOD_VISUAL_HOOKS_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('MCOD_VISUAL_HOOKS_PLUGIN_URL', plugin_dir_url(__FILE__));

// Constantes para assets
define('MCOD_VISUAL_HOOKS_ASSETS_URL', MCOD_VISUAL_HOOKS_PLUGIN_URL . 'assets/');
define('MCOD_VISUAL_HOOKS_IMG_URL', MCOD_VISUAL_HOOKS_ASSETS_URL . 'img/');
define('MCOD_VISUAL_HOOKS_CSS_URL', MCOD_VISUAL_HOOKS_ASSETS_URL . 'css/');
define('MCOD_VISUAL_HOOKS_JS_URL', MCOD_VISUAL_HOOKS_ASSETS_URL . 'js/');

// Incluir archivos necesarios
require_once MCOD_VISUAL_HOOKS_PLUGIN_DIR . 'includes/class-mcod-visual-hooks.php';

// Inicializar el plugin
function mcod_visual_hooks_init() {
    MCOD_Visual_Hooks::get_instance();
}
add_action('plugins_loaded', 'mcod_visual_hooks_init');

/**
 * Función de activación del plugin
 */
register_activation_hook(__FILE__, 'mcod_visual_hooks_activate');
function mcod_visual_hooks_activate() {
    // Código de activación si es necesario
}

/**
 * Función de desactivación del plugin
 */
register_deactivation_hook(__FILE__, 'mcod_visual_hooks_deactivate');
function mcod_visual_hooks_deactivate() {
    // Código de desactivación si es necesario
}

<?php
/**
 * Clase principal del plugin MCOD Visual Hooks
 *
 * Esta clase maneja la funcionalidad principal del plugin,
 * incluyendo la inicialización, hooks y shortcodes.
 *
 * @package MCOD_Visual_Hooks
 * @author Cristian Leguizamón
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Clase principal del plugin
 */
class MCOD_Visual_Hooks {
    /**
     * Instancia única de la clase
     *
     * @var MCOD_Visual_Hooks
     */
    private static $instance = null;

    /**
     * Obtiene la instancia única de la clase
     *
     * @return MCOD_Visual_Hooks
     */
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Constructor de la clase
     * 
     * Inicializa los hooks y acciones necesarias para el funcionamiento del plugin
     */
    public function __construct() {
        // Inicializar hooks
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_init', array($this, 'register_settings'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_assets'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_frontend_assets'));

        // Inicializar shortcodes
        require_once MCOD_VISUAL_HOOKS_PLUGIN_DIR . 'includes/shortcodes/class-mcod-visitors-shortcode.php';
        new MCOD_Visitors_Shortcode();
    }

    /**
     * Agrega el menú de administración
     */
    public function add_admin_menu() {
        // Menú principal
        add_menu_page(
            'Ganchos Visuales',
            'Ganchos Visuales',
            'manage_options',
            'mcod-visual-hooks',
            array($this, 'render_admin_page'),
            'dashicons-visibility',
            30
        );

        // Subpágina de Visitantes en vivo
        add_submenu_page(
            'mcod-visual-hooks',
            'Visitantes en vivo',
            'Visitantes en vivo',
            'manage_options',
            'mcod-visual-hooks-live-viewing',
            array($this, 'render_live_viewing_page')
        );
    }

    /**
     * Registra las configuraciones del plugin
     */
    public function register_settings() {
        // Grupo de configuración para visitantes en vivo
        register_setting('mcod_visual_hooks_live_viewing', 'mcod_visual_hooks_live_viewing_settings');

        // Sección de configuración
        add_settings_section(
            'mcod_visual_hooks_live_viewing_section',
            'Configuración de Visitantes en vivo',
            array($this, 'render_live_viewing_section'),
            'mcod-visual-hooks-live-viewing'
        );

        // Campo de texto para el mensaje
        add_settings_field(
            'live_viewing_text',
            'Texto de visitantes en vivo',
            array($this, 'render_live_viewing_text_field'),
            'mcod-visual-hooks-live-viewing',
            'mcod_visual_hooks_live_viewing_section'
        );

        // Campo de color
        add_settings_field(
            'text_color',
            'Color del texto y el icono',
            array($this, 'render_text_color_field'),
            'mcod-visual-hooks-live-viewing',
            'mcod_visual_hooks_live_viewing_section'
        );

        // Campo de número mínimo
        add_settings_field(
            'min_count',
            'Mínimo de visitantes',
            array($this, 'render_min_count_field'),
            'mcod-visual-hooks-live-viewing',
            'mcod_visual_hooks_live_viewing_section'
        );

        // Campo de número máximo
        add_settings_field(
            'max_count',
            'Máximo de visitantes',
            array($this, 'render_max_count_field'),
            'mcod-visual-hooks-live-viewing',
            'mcod_visual_hooks_live_viewing_section'
        );

        // Campo de intervalo de actualización
        add_settings_field(
            'update_interval',
            'Intervalo de actualización (segundos)',
            array($this, 'render_update_interval_field'),
            'mcod-visual-hooks-live-viewing',
            'mcod_visual_hooks_live_viewing_section'
        );
    }

    /**
     * Renderiza la sección de configuración
     */
    public function render_live_viewing_section() {
        echo '<p>Configura los ajustes para mostrar los visitantes en vivo en tu sitio.</p>';
    }

    /**
     * Renderiza el campo de texto para visitantes en vivo
     */
    public function render_live_viewing_text_field() {
        $options = get_option('mcod_visual_hooks_live_viewing_settings');
        $value = isset($options['live_viewing_text']) ? $options['live_viewing_text'] : '{count} personas están viendo este producto en este momento.';
        ?>
        <input type="text" name="mcod_visual_hooks_live_viewing_settings[live_viewing_text]" 
               value="<?php echo esc_attr($value); ?>" class="regular-text">
        <p class="description">Usa {count} para mostrar el número de visitantes.</p>
        <?php
    }

    /**
     * Renderiza el campo de color
     */
    public function render_text_color_field() {
        $options = get_option('mcod_visual_hooks_live_viewing_settings');
        $value = isset($options['text_color']) ? $options['text_color'] : '#000000';
        ?>
        <input type="color" name="mcod_visual_hooks_live_viewing_settings[text_color]" 
               value="<?php echo esc_attr($value); ?>">
        <p class="description">Selecciona el color para el texto y el icono del ojo.</p>
        <?php
    }

    /**
     * Renderiza el campo de número mínimo
     */
    public function render_min_count_field() {
        $options = get_option('mcod_visual_hooks_live_viewing_settings');
        $value = isset($options['min_count']) ? $options['min_count'] : 10;
        ?>
        <input type="number" name="mcod_visual_hooks_live_viewing_settings[min_count]" 
               value="<?php echo esc_attr($value); ?>" min="1">
        <p class="description">Número mínimo de visitantes en vivo para mostrar.</p>
        <?php
    }

    /**
     * Renderiza el campo de número máximo
     */
    public function render_max_count_field() {
        $options = get_option('mcod_visual_hooks_live_viewing_settings');
        $value = isset($options['max_count']) ? $options['max_count'] : 20;
        ?>
        <input type="number" name="mcod_visual_hooks_live_viewing_settings[max_count]" 
               value="<?php echo esc_attr($value); ?>" min="1">
        <p class="description">Número máximo de visitantes en vivo para mostrar.</p>
        <?php
    }

    /**
     * Renderiza el campo de intervalo de actualización
     */
    public function render_update_interval_field() {
        $options = get_option('mcod_visual_hooks_live_viewing_settings');
        $value = isset($options['update_interval']) ? $options['update_interval'] : 5;
        ?>
        <input type="number" name="mcod_visual_hooks_live_viewing_settings[update_interval]" 
               value="<?php echo esc_attr($value); ?>" min="1" max="60">
        <p class="description">Tiempo en segundos entre cada actualización del contador.</p>
        <?php
    }

    /**
     * Renderiza la página de administración principal
     */
    public function render_admin_page() {
        include MCOD_VISUAL_HOOKS_PLUGIN_DIR . 'templates/admin/admin-page.php';
    }

    /**
     * Renderiza la página de visitantes en vivo
     */
    public function render_live_viewing_page() {
        include MCOD_VISUAL_HOOKS_PLUGIN_DIR . 'templates/admin/live-viewing-page.php';
    }

    /**
     * Carga los assets necesarios para el panel de administración
     *
     * @param string $hook Nombre del hook actual
     */
    public function enqueue_admin_assets($hook) {
        // Verificar si estamos en alguna página del plugin
        if (strpos($hook, 'mcod-visual-hooks') === false) {
            return;
        }

        wp_enqueue_style(
            'mcod-visual-hooks-admin',
            MCOD_VISUAL_HOOKS_PLUGIN_URL . 'assets/css/admin.css',
            array(),
            MCOD_VISUAL_HOOKS_VERSION
        );
    }

    /**
     * Carga los assets necesarios para el frontend
     */
    public function enqueue_frontend_assets() {
        // Cargar el CSS
        wp_enqueue_style(
            'mcod-visual-hooks-public',
            MCOD_VISUAL_HOOKS_PLUGIN_URL . 'assets/css/public.css',
            array(),
            MCOD_VISUAL_HOOKS_VERSION
        );

        // Cargar el script
        wp_enqueue_script(
            'mcod-visitors-counter',
            MCOD_VISUAL_HOOKS_PLUGIN_URL . 'assets/js/visitors-counter.js',
            array('jquery'),
            MCOD_VISUAL_HOOKS_VERSION,
            true
        );

        // Localizar el script con el intervalo de actualización
        $options = get_option('mcod_visual_hooks_live_viewing_settings');
        $update_interval = isset($options['update_interval']) ? $options['update_interval'] : 5;
        
        wp_localize_script('mcod-visitors-counter', 'mcod_visitors', array(
            'update_interval' => $update_interval * 1000 // Convertir a milisegundos
        ));
    }

    /**
     * Renderiza el contador de visitantes
     *
     * @param array $atts Atributos del shortcode
     * @return string HTML del contador
     */
    public function render_visitors_counter($atts) {
        // Implementación pendiente
        return '<div class="mcod-visitors-counter">Contador de visitantes</div>';
    }

    /**
     * Renderiza los testimonios
     *
     * @param array $atts Atributos del shortcode
     * @return string HTML de los testimonios
     */
    public function render_testimonials($atts) {
        // Implementación pendiente
        return '<div class="mcod-testimonials">Testimonios</div>';
    }

    /**
     * Renderiza el contador de compradores
     *
     * @param array $atts Atributos del shortcode
     * @return string HTML del contador
     */
    public function render_buyers_counter($atts) {
        // Implementación pendiente
        return '<div class="mcod-buyers-counter">Contador de compradores</div>';
    }

    /**
     * Renderiza el mostrador de descuento
     *
     * @param array $atts Atributos del shortcode
     * @return string HTML del descuento
     */
    public function render_discount($atts) {
        // Implementación pendiente
        return '<div class="mcod-discount">Mostrador de descuento</div>';
    }
} 
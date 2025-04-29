<?php
/**
 * Template para la página de administración del plugin
 *
 * @package MCOD_Visual_Hooks
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="wrap mcod-admin-container">
    <div class="mcod-admin-header">
        <h1 class="mcod-admin-title"><?php echo esc_html(get_admin_page_title()); ?></h1>
    </div>

    <div class="mcod-admin-content">
        <div class="mcod-admin-card">
            <h3>Bienvenido a Ganchos Visuales</h3>
            <p>Este plugin te permite agregar elementos visuales atractivos a tu sitio web mediante shortcodes.</p>
        </div>

        <div class="mcod-admin-card">
            <h3>Configuración</h3>
            <p>Utiliza el menú lateral para acceder a las diferentes configuraciones del plugin.</p>
        </div>
    </div>
</div> 
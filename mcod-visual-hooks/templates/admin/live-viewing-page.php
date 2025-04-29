<?php
/**
 * Template para la página de configuración de visitantes en vivo
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
        <div class="mcod-visual-hooks-header">
            <img src="<?php echo esc_url(MCOD_VISUAL_HOOKS_IMG_URL . 'mcod-live-visitors-widget.jpg'); ?>" 
                 alt="MCOD Live Visitors Widget" 
                 style="max-width: 100%; max-height: 30px; margin: 20px 0;">
        </div>
    </div>

    <div class="mcod-admin-content">
        <form method="post" action="options.php">
            <?php
            settings_fields('mcod_visual_hooks_live_viewing');
            do_settings_sections('mcod-visual-hooks-live-viewing');
            submit_button();
            ?>
        </form>
    </div>
</div> 
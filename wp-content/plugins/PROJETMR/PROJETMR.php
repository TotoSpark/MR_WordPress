<?php
/*
Plugin Name: PROJET_PAYS
Description: Ce plugin WordPress sert à valider mon projet et mon année
Author: Romaniello
Version: 1.0
*/

if (!defined('ABSPATH'))
    exit;

define('PROJETMR_VERSION', '1.0.0.7');
define('PROJETMR_FILE', __FILE__);
define('PROJETMR_DIR', dirname(PROJETMR_FILE));
define('PROJETMR_BASENAME', pathinfo((PROJETMR_FILE))['filename']);
define('PROJETMR_PLUGIN_NAME', PROJETMR_BASENAME);

foreach (glob(PROJETMR_DIR .'/classes/*/*.php') as $filename)
    if (!preg_match('/export|cron/i', $filename))
        if (!@require_once $filename)
            throw new Exception(sprintf(__('Failed to include %s'), $filename));

register_activation_hook(PROJETMR_FILE, function() {
    $PROJETMR_Install = new PROJETMR_Install();
    $PROJETMR_Install->setup();
});

if (is_admin())
    new PROJETMR_Admin();
else
    new PROJETMR_Front();

//remove_action('wp_head', 'wp_generator');
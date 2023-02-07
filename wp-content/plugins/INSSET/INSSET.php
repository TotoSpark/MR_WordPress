<?php
/*
Plugin Name: INSSET-Romaniello
Plugin URI: https://site-du-plugin.fr
Description: Ce plugin WordPress sert à …
Author: Nom prénom ou nom de l’entreprise
Version: 1.0
Author URI: https://mon-site.fr
*/

if (!defined('ABSPATH'))
    exit;

define('INSSET_VERSION', '1.0.0.7');
define('INSSET_FILE', __FILE__);
define('INSSET_DIR', dirname(INSSET_FILE));
define('INSSET_BASENAME', pathinfo((INSSET_FILE))['filename']);
define('INSSET_PLUGIN_NAME', INSSET_BASENAME);

foreach (glob(INSSET_DIR .'/classes/*/*.php') as $filename)
    if (!preg_match('/export|cron/i', $filename))
        if (!@require_once $filename)
            throw new Exception(sprintf(__('Failed to include %s'), $filename));

register_activation_hook(INSSET_FILE, function() {
    $INSSET_Install = new INSSET_Install();
    $INSSET_Install->setup();
});

if (is_admin())
    new INSSET_Admin();
else
    new INSSET_Front();

//remove_action('wp_head', 'wp_generator');
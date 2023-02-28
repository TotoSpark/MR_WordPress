<?php
class PROJETMR_Admin
{

    public function __construct()
    {
        add_action('admin_menu', array($this, 'menu'), -1);
        return;

    }

    public function menu()
    {

        add_menu_page(
            __('projet)'),
            __('PROJET'),
            'administrator',
            'yeptrackchoicesfall_settings',
            array($this, 'yeptrackchoicesfall_settings'),
            'images/marker.png',
            1000
        );

        add_submenu_page(
            'yeptrackchoicesfall_settings',
            __('PROJET / Liste'),
            __('Liste'),
            'administrator',
            'yeptrackchoicesfall_import_forms',
            array($this, 'yeptrackchoicesfall_liste')
        );

        add_action('admin_enqueue_scripts', array($this, 'assets'), 999);
    }

    public function yeptrackchoicesfall_liste() {

        $Insset_Views_Inscrits = new PROJETMR_Views_Liste();
        return $Insset_Views_Inscrits->display();

    }

    public function assets() {

        wp_register_script('admin-js', plugins_url(PROJETMR_PLUGIN_NAME .'/AssetsJS/PROJETMR_Admin.js',PROJETMR_VERSION, true));
        wp_enqueue_script('admin-js');
        wp_localize_script('admin-js', 'adminscript', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'security' => wp_create_nonce('ajax_nonce_security')
        ));
        return;
    }

}
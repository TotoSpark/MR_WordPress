<?php
class INSSET_Admin
{

    public function __construct()
    {
        add_action('admin_menu', array($this, 'menu'), -1);
        add_action('admin_enqueue_scripts', array($this, 'assets'), 999);
        add_action('wp_enqueue_scripts', array($this, 'ajout_js'), 0);
        return;

    }

    public function menu()
    {

        add_menu_page(
            __('insset)'),
            __('INSSET'),
            'administrator',
            'yeptrackchoicesfall_settings',
            array($this, 'yeptrackchoicesfall_settings'),
            'images/marker.png',
            1000
        );

        add_submenu_page(
            'yeptrackchoicesfall_settings',
            __('INSSET / Config'),
            __('Config'),
            'administrator',
            'yeptrackchoicesfall_import_form',
            array($this, 'yeptrackchoicesfall_import_form')
        );

        add_submenu_page(
            'yeptrackchoicesfall_settings',
            __('INSSET / List'),
            __('List'),
            'administrator',
            'yeptrackchoicesfall_students',
            array($this, 'yeptrackchoicesfall_students')
        );
    }

    public function assets() {
        wp_enqueue_style('admin-style', plugins_url(INSSET_PLUGIN_NAME).'/assets/CSS/admin.css');

        //Ajouter les scripts necessaires
        wp_register_script('inssetB', plugins_url(INSSET_PLUGIN_NAME .'/assets/JS/Insset_admin.js', INSSET_PLUGIN_NAME, true));
        wp_enqueue_script('inssetB');

        //Point sécurité
        wp_localize_script('inssetB', 'inssetscript', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'security' => wp_create_nonce('ajax_nonce_security')
        ));
        return;
    }


    public function yeptrackchoicesfall_import_form() {

        $YepTrackChoicesFall_Import_Form = new Insset_Views_Config();
        return $YepTrackChoicesFall_Import_Form->display();

    }

    public function yeptrackchoicesfall_students() {

        $Insset_Views_Inscrits = new Insset_Views_Inscrits();
        return $Insset_Views_Inscrits->display();

    }

    public function ajout_js(){
        wp_register_script('insset', plugins_url(INSSET_PLUGIN_NAME .'/assets/JS/Insset_Front.js'), array("jquery-new"), INSSET_VERSION, true);
        wp_enqueue_script('insset');

        wp_localize_script('insset', 'inssetscript', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'security' => wp_create_nonce('ajax_nonce_security')
        ));
    }
}
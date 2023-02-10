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
            __('PROJET / Config'),
            __('Config'),
            'administrator',
            'yeptrackchoicesfall_import_form',
            array($this, 'yeptrackchoicesfall_import_form')
        );

    }

}
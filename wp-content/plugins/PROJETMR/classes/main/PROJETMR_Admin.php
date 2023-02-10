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
            'yeptrackchoicesfall_import_forms',
            array($this, 'listePays')
        );

    }
    public function yeptrackchoicesfall_import_forms() {

        $YepTrackChoicesFall_Import_Form = new Insset_Views_Config();
        return $YepTrackChoicesFall_Import_Form->display();

    }

    public function yeptrackchoicesfall_students() {

        $Insset_Views_Inscrits = new Insset_Views_Inscrits();
        return $Insset_Views_Inscrits->display();

    }
    public function listePays() {

        $view = new JC_ProjetLP_CountryListView();

        return false;

    }

}
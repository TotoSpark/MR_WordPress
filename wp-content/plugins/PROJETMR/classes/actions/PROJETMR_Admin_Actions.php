<?php

add_action('wp_ajax_voyagesmajeur', array('PROJETMR_Admin_Actions', 'Majeur'));
add_action('wp_ajax_updateetoiles', array('PROJETMR_Admin_Actions', 'UpdateEtoiles'));

class PROJETMR_Admin_Actions
{

    public static function Majeur()
    {
        check_ajax_referer('ajax_nonce_security', 'security');
        $crud = new PROJETMR_Crud_Index();

        if ((!isset($_REQUEST)) || sizeof(@$_REQUEST) < 1)
            exit;

        print "ok";
        var_dump($_REQUEST);

        $crud->UpdateMajeur($_REQUEST['id'], $_REQUEST['majeur']);
        $valeur = $crud->ResultMaj($_REQUEST['majeur']);

        if($valeur[0]['majeur'] == 0){
            $crud->UpdateMajeur($_REQUEST['majeur'],"1");
        }
        else {
            $crud->UpdateMajeur($_REQUEST['majeur'],"0");
        }

        exit;
    }

    static public function UpdateEtoiles(){
        check_ajax_referer('ajax_nonce_security', 'security');
        $crud = new PROJETMR_Crud_index();

        if ((!isset($_REQUEST)) || sizeof(@$_REQUEST) < 1){
            exit;
        }

        $crud->UpdatEtoiles($_REQUEST['id'], $_REQUEST['etoiles']);

        exit;
    }


}
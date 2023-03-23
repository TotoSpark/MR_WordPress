<?php

add_action('wp_ajax_inssetnews', array('PROJETMR_Front_Actions_Index', 'dothejob'));
add_action('wp_ajax_nopriv_inssetnews', array('PROJETMR_Front_Actions_Index', 'dothejob'));

class PROJETMR_Front_Actions_Index {

    public static function dothejob() {
        check_ajax_referer( "ajax_nonce_security", "security" );

        if ((!isset($_REQUEST)) || sizeof(@$_REQUEST) < 1)
            exit;

        foreach ($_REQUEST as $key => $value)
            $$key = (string) trim($value);

        $PROJETMR_Crud_Index = new PROJETMR_Crud_Index();
        $LastId = $PROJETMR_Crud_Index->ajout($_REQUEST);

        print $LastId;
        exit;

    }

}
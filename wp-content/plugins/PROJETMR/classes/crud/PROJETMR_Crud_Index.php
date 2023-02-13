<?php

class PROJETMR_Crud_Index {

    static public function getConfig() {
        global $wpdb;
        $db = $wpdb->prefix . PROJETMR_BASENAME . '_pays';
        $sql = "SELECT * FROM $db";
        $result = $wpdb->get_results($sql, 'ARRAY_A');

        return $result;
    }
}
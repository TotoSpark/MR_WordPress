<?php
class PROJETMR_Crud_Index{

    static public function setConfig($id, $valeur) {

        if(!$id && !$valeur) return;

        global $wpdb;

        return $wpdb->update($wpdb->prefix .PROJETMR_BASENAME."_pays",
            array('valeur' => $valeur),
            ['id' => $id]) ;

    }

    static public function getConfig() {
        global $wpdb;
        $db = $wpdb->prefix . PROJETMR_BASENAME . '_pays';
        $sql = "SELECT * FROM $db";
        $result = $wpdb->get_results($sql, 'ARRAY_A');

        return $result;
    }

    static public function UpdateMajeur($id, $majeur){

        global $wpdb;

        if($wpdb->update($wpdb->prefix . PROJETMR_BASENAME . '_pays', ['majeur' => $majeur], ['id' => $id])){

            return "MAJ OK !";

        }

        return "Erreur";
    }

    static public function ResultMaj($id){

        global $wpdb;

        $sql = "SELECT `majeur` from ".$wpdb->prefix . PROJETMR_BASENAME."_pays WHERE `id`=".$id;
        $result = $wpdb->get_results($sql, 'ARRAY_A');

        return $result;
    }

}

?>
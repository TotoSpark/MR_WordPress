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

    static public function UpdateEtoiles($id, $valeur){

        global $wpdb;

        $db = $wpdb->prefix . PROJETMR_BASENAME .'_pays';

        $request = $wpdb->update($db, array('etoiles' => $valeur), ['id' => $id]);

        if($request){

            return "Mise à jour faite !";

        }

        return "Error";
    }

    static public function ResultEtoiles($id){

        global $wpdb;

        $sql = "SELECT `etoiles` from ".$wpdb->prefix . PROJETMR_BASENAME."_pays WHERE `id`=".$id;
        $result = $wpdb->get_results($sql, 'ARRAY_A');

        return $result;
    }

    public function ajout($data){
        global $wpdb;
        $wpdb->insert($wpdb->prefix .PROJETMR_BASENAME.'_subscribers',['id'=>0]);
        $LastId=$wpdb->insert_id;
        foreach($data as $key=>$value)
        {
        if (!in_array($key, ['action','security']))
             $wpdb->insert( $wpdb->prefix .PROJETMR_BASENAME.'_subscribersdata', array( 'index' => 0, 'valeur' =>$value, 'cle'=>$key, 'id'=>$LastId ) );
        }
        return $LastId;
    }
}

?>
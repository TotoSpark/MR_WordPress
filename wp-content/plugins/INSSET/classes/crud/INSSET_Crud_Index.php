<?php

class INSSET_Crud_Index {

    public function ajout($data){
        global $wpdb;
        $wpdb->insert($wpdb->prefix .INSSET_BASENAME.'_subscribers',['id'=>0]);
        $LastId=$wpdb->insert_id;
        foreach($data as $key=>$value)
        {
            if (!in_array($key, ['action','security']))
                $wpdb->insert( $wpdb->prefix .INSSET_BASENAME.'_subscribersdata', array( 'index' => 0, 'valeur' =>$value, 'cle'=>$key, 'id'=>$LastId ) );
        }
        return $LastId;
    }

    public function remove($var){
        if(!$var)
            return;
        global $wpdb;

        if($wpdb->delete($wpdb->prefix .INSSET_BASENAME.'_subscribersdata',['id'=>$var]))
            if($wpdb->delete($wpdb->prefix .INSSET_BASENAME.'_subscribers',['id'=>$var]))
                return "suppression effectué";

        return "Erreur !";
    }

    static public function setConfig($id, $valeur) {

        if(!$id && !$valeur) return;

        global $wpdb;

        return $wpdb->update($wpdb->prefix .INSSET_BASENAME."_config",
            array('valeur' => $valeur),
            ['id' => $id]) ;

    }

    static public function getConfig() {
        global $wpdb;
        $db = $wpdb->prefix . INSSET_BASENAME . '_config';
        $sql = "SELECT * FROM $db";
        $result = $wpdb->get_results($sql, 'ARRAY_A');

        return $result;
    }
}
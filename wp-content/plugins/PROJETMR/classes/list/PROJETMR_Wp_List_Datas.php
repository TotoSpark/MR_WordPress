<?php

if (!class_exists('WP_List_Table')) {
    require_once(ABSPATH .'wp-admin/includes/screen.php');
    require_once(ABSPATH .'wp-admin/includes/class-wp-list-table.php');
}

class PROJETMR_Wp_List_Datas extends WP_List_Table {

    public $_tablename = 'projetmr_pays';
    public $_program;
    public $_screen;

    public function __construct() {

        //$this->_program = $program;

        $tempscreen = get_current_screen();
        $this->_screen = $tempscreen->base;

        // if ($tb)
        //   $this->_tablename = $tb;

        parent::__construct( [
            'singular' => __('Item', 'sp'),
            'plural'   => __('Items', 'sp'),
            'ajax'     => false
        ]);

    }

    public function prepare_items() {

        $columns = $this->get_columns();
        $hidden = $this->get_hidden_columns();
        $sortable = $this->get_sortable_columns();
        $this->_column_headers = array($columns, $hidden, $sortable);

        $data = $this->table_data();
        $currentPage = $this->get_pagenum();

        $perPage = 10;
        $this->set_pagination_args(array(
            'total_items' => count($data),
            'per_page'    => $perPage
        ));

        $data = array_slice($data, (($currentPage-1)*$perPage), $perPage);

        $this->items = $data;

    }

    public function get_columns($columns = array()) {


        $columns['pays'] = __('pays');
        $columns['ISO'] = __('ISO');
        $columns['etoiles'] = __('etoiles');
        $columns['majeur'] = __('disponible non majeur');
        //$columns['actif'] = __('actif');


        global $wpdb;
        $data = $wpdb->prefix . strtolower(PROJETMR_BASENAME) . '_pays';

        $sql = "SELECT DISTINCT cle FROM `$data` WHERE cle <> '';";

        $result = $wpdb->get_results($sql, 'ARRAY_A');

        foreach ($result as $col) {
            $columns[$col['cle']] = __($col['cle']);
        }
        //$columns['delete']= __('delete');
        return $columns;

    }

    public function get_hidden_columns($default = array()) {

        return $default;

    }

    public function get_sortable_columns($sortable = array())
    {
        global $wpdb;

        $sql = "SELECT DISTINCT `valeur` FROM " . $wpdb->prefix . PROJETMR_BASENAME . '_pays' . " WHERE `valeur` != ''";

        $result = $wpdb->get_results($sql, 'ARRAY_A');

        foreach ($result as $value)
            $sortable[$value["valeur"]] = array($value["valeur"], true);

        $sortable["id"] = array('id', true);
        $sortable["date"] = array('date', true);
        $sortable['etoiles'] = array('etoiles', true);

        return $sortable;
    }

    public function table_data($per_page=10, $page_number=1, $orderbydefault=false) {

        global $wpdb;

        //$sql = 'SELECT * FROM `'. $wpdb->prefix . 'insset_subscribers`' . "WHERE 1";
        $sql = "SELECT * FROM " . $wpdb->prefix . $this->_tablename;

        if (!empty($_REQUEST['orderby'])) {
            $sql .= ' ORDER BY `'. esc_sql($_REQUEST['orderby']) .'`';
            $sql .= ! empty($_REQUEST['order']) ? ' ' . esc_sql($_REQUEST['order']) : ' ASC';
        }

        $result = $wpdb->get_results($sql, 'ARRAY_A');

        return $result;

    }

    public function column_default( $item,$column_name,) {

        if(preg_match('/majeur/i',$column_name))
            return sprintf( '<input type="checkbox" name="majeur" value="%d" id="%s" %s>', $item['id'], $item['id'], $item['majeur'] == 1 ? 'checked' : '' );


        if (preg_match('/etoiles/i', $column_name)){
            return self::slider($item['etoiles'],$item['id']);
        }

        if (preg_match('/delete/i',$column_name))
            return self::getDelete($item['id']);

        return @$item[$column_name];

    }
    private function slider($value,$id){
        return sprintf(
            "<div><input type='range' min='1' max='5' value='%d' class='slider' id='%d'><span class='valEtoiles-%d' style='padding-left: 10px'>%d</span></div>",
            $value,
            $id,
            $id,
            $value
        );
    }

    //private function getDelete($id){
    //     if(!$id)
    //        return;
    //    return sprintf(
    //        '<button id="%d" class="button-secondary button-small delbtn"><span class="dashicons dashicons-trash"></span></i></button>',
    //        $id,
    //        __("Delete"));
    //}

}
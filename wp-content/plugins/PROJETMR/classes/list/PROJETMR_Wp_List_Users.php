<?php

if (!class_exists('PROJETMR_Wp_List_Users')) {
    require_once(ABSPATH .'wp-admin/includes/screen.php');
    require_once(ABSPATH .'wp-admin/includes/class-wp-list-table.php');
}

class PROJETMR_Wp_List_Users extends WP_List_Table {

    public $_tablename = '';
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


        $columns['id'] = __('Id');
        $columns['daate'] = __('daate');


        global $wpdb;
        $data = $wpdb->prefix . strtolower(INSSET_BASENAME) . '_subscribersdata';

        $sql = "SELECT DISTINCT cle FROM `$data` WHERE cle <> '';";

        $result = $wpdb->get_results($sql, 'ARRAY_A');

        foreach ($result as $col) {
            $columns[$col['cle']] = __($col['cle']);
        }
        $columns['delete']= __('delete');
        return $columns;

    }

    public function get_hidden_columns($default = array()) {

        return $default;

    }

    public function get_sortable_columns($sortable = array())
    {
        global $wpdb;

        $sql = "SELECT DISTINCT `valeur` FROM " . $wpdb->prefix . PROJETMR_BASENAME . '_subscribersdata' . " WHERE `valeur` != ''";

        $result = $wpdb->get_results($sql, 'ARRAY_A');

        foreach ($result as $value)
            $sortable[$value["valeur"]] = array($value["valeur"], true);

        $sortable["id"] = array('id', true);
        $sortable["date"] = array('date', true);

        return $sortable;
    }

    public function table_data($per_page=10, $page_number=1, $orderbydefault=false) {

        global $wpdb;

        //$sql = 'SELECT * FROM `'. $wpdb->prefix . 'insset_subscribers`' . "WHERE 1";

        $sql = "SELECT A.*, 
            (SELECT B.`valeur` FROM " . $wpdb->prefix . INSSET_BASENAME . '_subscribersdata' . " B WHERE B.`id`=A.`id` AND B.`cle`='firstname' LIMIT 1) AS 'firstname', 
            (SELECT B.`valeur` FROM " . $wpdb->prefix . INSSET_BASENAME . '_subscribersdata' . " B WHERE B.`id`=A.`id` AND B.`cle`='email' LIMIT 1) AS 'email',
            (SELECT B.`valeur` FROM " . $wpdb->prefix . INSSET_BASENAME . '_subscribersdata' . " B WHERE B.`id`=A.`id` AND B.`cle`='lastname' LIMIT 1) AS 'lastname',
            (SELECT B.`valeur` FROM " . $wpdb->prefix . INSSET_BASENAME . '_subscribersdata' . " B WHERE B.`id`=A.`id` AND B.`cle`='codepo' LIMIT 1) AS 'codepo'
            FROM " . $wpdb->prefix . INSSET_BASENAME . '_subscribers' . " A ";

        if (!empty($_REQUEST['orderby'])) {
            $sql .= ' ORDER BY `'. esc_sql($_REQUEST['orderby']) .'`';
            $sql .= ! empty($_REQUEST['order']) ? ' ' . esc_sql($_REQUEST['order']) : ' ASC';
        }

        $result = $wpdb->get_results($sql, 'ARRAY_A');

        return $result;

    }

    public function column_default( $item,$column_name ) {

        if (preg_match('/delete/i',$column_name))

            return self::getDelete($item['id']);
        return @$item[$column_name];

    }

    private function getDelete($id){
        if(!$id)
            return;
        return sprintf(
            '<button data-id="%d" class="button-secondary button-small"><i class="fa-solid fa-trash"></i></button>',
            $id,
            __("Delete"));
    }

}
<?php

class PROJETMR_Install {

    public function __construct() {

        add_action( 'admin_init', array( $this, 'setup' ) );
        return;

    }

    public function setup()
    {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();

        if (!$this->isTableBaseAlreadyCreated('_pays')) {
            $tablepays = '
        CREATE TABLE IF NOT EXISTS `'. $wpdb->prefix . PROJETMR_BASENAME . '_pays' .'` (
                `pays` varchar(255) NOT NULL,
                `ISO` varchar(3) NOT NULL,
                `etoiles` int(1) NOT NULL,
                `majeur` int(1) NOT NULL,
                PRIMARY KEY  (ISO)
            ) ENGINE=InnoDB '. $charset_collate;
            dbDelta($tablepays);
        }
    }

    public function isTableBaseAlreadyCreated($table) {

        global $wpdb;

        $sql = 'SHOW TABLES LIKE \'%'. $wpdb->prefix . PROJETMR_BASENAME . $table .'%\'';
        return $wpdb->get_var($sql);

    }

}

?>
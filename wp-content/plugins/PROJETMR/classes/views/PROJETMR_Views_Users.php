<?php

class PROJETMR_Views_Users {

    public function display() {

        global $wpdb;
        $ListUsers = new PROJETMR_Wp_List_Users('`'.$wpdb->prefix . PROJETMR_BASENAME .'_users_pays`');

        $tempscreen = get_current_screen();
        $this->_screen = $tempscreen->base;

        ?>
        <div class="wrap" id="pl_param_update">
            <h1 class="wp-heading-inline"><?php print get_admin_page_title(); ?></h1>
            <?php //if (!$msg): $msg = true; ?>
            <div class="notice notice-info notice-alt is-dismissible hidden update-message">
                <p><?php _e('Mise à jour effectué !'); ?></p>
            </div>
            <?php //endif; ?>
            <table class="wp-list-table widefat fixed striped">
                <div class="wrap" id="list-table">
                    <form id="list-table-form" method="post">
                        <?php
                        $page  = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_STRIPPED );
                        $paged = filter_input( INPUT_GET, 'paged', FILTER_SANITIZE_NUMBER_INT );
                        printf('<input type="hidden" name="page" value="%s" />', $page);
                        printf('<input type="hidden" name="paged" value="%d" />', $paged);
                        $ListUsers->prepare_items();
                        $ListUsers->display();
                        ?>
                    </form>
                </div>
            </table>
        </div>

        <?php

    }

}

?>
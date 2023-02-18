<?php

class PROJETMR_Views_Liste {

    public function display()
    {

        $Wp_List = new PROJETMR_Wp_List_Datas();
        $tempscreen = get_current_screen();
        $this->_screen = $tempscreen->base;


        ?>
        <div class="wrap">
            <h1 class="wp-heading-inline"><?php print get_admin_page_title(); ?></h1>
            <hr class="wp-header-end" />
            <div class="notice notice-info notice-alt is-dismissible hide delete-confirmation">
                <p><?php _e('Updated done!'); ?></p>
            </div>
            <div class="wrap" id="list-table">
                <form id="list-table-form" method="post">
                    <?php
                    $page  = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRIPPED);
                    $paged = filter_input(INPUT_GET, 'paged', FILTER_SANITIZE_NUMBER_INT);
                    printf('<input type="hidden" name="page" value="%s" />', $page);
                    printf('<input type="hidden" name="paged" value="%d" />', $paged);
                    $Wp_List = new PROJETMR_Wp_List_Datas();
                    $Wp_List->prepare_items();
                    $Wp_List->display();
                    ?>
                </form>
            </div>
        </div>
        <?php
    }
}
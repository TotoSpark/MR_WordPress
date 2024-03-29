<?php

class PROJETMR_Views_Liste {

    public function display()
    {
        $configs = PROJETMR_Crud_Index::getConfig();
        $Wp_List = new PROJETMR_Wp_List_Datas();
        $tempscreen = get_current_screen();
        $this->_screen = $tempscreen->base;
        $toolbar = $this->toolbar();


        ?>
        <div class="wrap">
            <h1 class="wp-heading-inline"><?php print get_admin_page_title(); ?></h1>
            <hr class="wp-header-end" />
            <div class="notice notice-info notice-alt is-dismissible hide delete-confirmation">
                <p><?php _e('Updated done!'); ?></p>
            </div>
            <?php //if (sizeof($toolbar)) self::toolbar($toolbar); ?>
            <div class="wrap" id="list-table">
                <form id="list-table-form" method="post">
                    <?php
                    $page  = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRIPPED);
                    $paged = filter_input(INPUT_GET, 'paged', FILTER_SANITIZE_NUMBER_INT);
                    printf('<input type="hidden" name="page" value="%s" />', $page);
                    printf('<input type="hidden" name="paged" value="%d" />', $paged);
                    $Wp_List = new PROJETMR_Wp_List_Datas();
                    $Wp_List->prepare_items();
                    $Wp_List->display();?>
                </form>
            </div>
        </div>
        <?php

    }

    private function toolbar() {
        ?>
        <div>
            <form action="<?php print admin_url('admin-post.php');?>" method="post">
                <table>
                    <tbody>
                    <tr>
                        <?php if (defined('PROJETMR_PLUGIN_NAME')) : ?>
                            <td>
                                <a class="button button-secondary" href="<?php print plugins_url(PROJETMR_PLUGIN_NAME . '/classes/export/PROJETMR_Export_XML.php'); ?>">
                                    <i class="fas fa-save"></i> XML
                                </a>
                            </td>
                        <?php endif ?>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
        <?php
    }
}

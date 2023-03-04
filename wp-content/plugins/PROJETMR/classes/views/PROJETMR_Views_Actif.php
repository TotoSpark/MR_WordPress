<?php

class PROJETMR_Views_Actif {

    public function __construct() {

        return;

    }

    public function display() {

        global $wpdb;

        $db_pays = $wpdb->prefix . PROJETMR_BASENAME .'_pays';

        $sql = "SELECT * FROM $db_pays";
        $result = $wpdb->get_results($sql, 'ARRAY_A');

        $tempscreen = get_current_screen();
        $this->_screen = $tempscreen->base;


        ?>
            <div class="wrap">
                <h1 class="wp-heading-inline"><?php print get_admin_page_title(); ?></h1>
                <hr class="wp-header-end" />
                <div class="notice notice-info notice-alt is-dismissible hidden confirm-message">
                    <p><?php _e('Updated !'); ?></p>
                </div>
                <label for="pays">Selectionnez vos pays :</label>
                <div class="wrap" id="list-table">
                    <select name="pays" id="pays" multiple>
                        <?php

                            foreach ($result as $pays) :

                                if ($pays['isactive']){ ?>

                                    <option value=<?php echo $pays['id'] ?> selected><?php echo $pays['pays']?></option>

                                <?php } else { ?>

                                    <option value=<?php echo $pays['id'] ?>><?php echo $pays['pays'] ?></option> <?php }

                            endforeach; ?>

                    </select>
                    <br><br>
                </div>
            <div>
        <?php

    }

}
<?php

add_shortcode('FORMULAIRE_CHOIX', array('PROJETMR_Shortcodes_Choix', 'display'));

class PROJETMR_Shortcodes_Choix {

    static function display($atts) {

        global $wpdb;

        $db = $wpdb->prefix . PROJETMR_BASENAME . '_pays';

        $sql_data = "SELECT id, pays FROM `$db` WHERE actif = 1;";

        $result = $wpdb->get_results($sql_data, 'ARRAY_A');

        $pays = "";

        foreach ($result as $valeur) {

            $pays .= "<option value=" . $valeur['id'] . ">" . $valeur['pays'] . "</option>";

        }

        return "
        <form id=\"choix\" method=\"POST\">
            <fieldset>
                    <select id=\"choix1\" required>
                        <option value=\"Choix\">Choix 1</option>". $pays ."
                    </select>
                    <select id=\"choix2\" disabled>
                        <option value=\"Choix\">Choix 2</option>". $pays ."
                    </select>
                    <select id=\"choix3\" disabled>
                        <option value=\"Choix\">Choix 3</option>". $pays ."
                    </select>
                    <select id=\"choix4\" disabled>
                        <option value=\"Choix\">Choix 4</option>". $pays ."
                    </select>
                    <select id=\"choix5\" disabled>
                        <option value=\"Choix\">Choix 5</option>". $pays ."
                    </select>
                </fieldset>
            <button id=\"submit\" type=\"submit\">bouton</button>
        </form>";
    }
}

?>
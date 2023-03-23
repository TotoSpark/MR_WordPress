<?php

add_shortcode('FORMULAIRE_CHOIX', array('PROJETMR_Shortcodes_Choix', 'display'));

class PROJETMR_Shortcodes_Choix {

    static function display($atts) {

        return "
        <form id=\"choix\" method=\"POST\">
            <fieldset>
                    <select id=\"choix1\" required>
                        <option value=\"Choix\">Choix 1</option>
                    </select>
                    <select id=\"choix2\" disabled>
                        <option value=\"Choix\">Choix 2</option>
                    </select>
                    <select id=\"choix3\" disabled>
                        <option value=\"Choix\">Choix 3</option>
                    </select>
                    <select id=\"choix4\" disabled>
                        <option value=\"Choix\">Choix 4</option>
                    </select>
                    <select id=\"choix5\" disabled>
                        <option value=\"Choix\">Choix 5</option>
                    </select>
                </fieldset>
            <button id=\"submit\" type=\"submit\">bouton</button>
        </form>";
    }
}

?>
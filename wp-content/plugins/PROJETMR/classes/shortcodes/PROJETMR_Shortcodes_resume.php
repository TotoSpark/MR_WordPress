<?php

add_shortcode('FORMULAIRE_RESUME', array('PROJETMR_Shortcodes_resume', 'display'));

class PROJETMR_Shortcodes_resume {

    static function display($atts) {

        return "
        <form id=\"resume\" method=\"POST\">
            <fieldset>
                    <h1>Résumé de vos choix</h1>
                    <ul>
                        <li value='Choix1'>Choix 1</li>
                        <li value='Choix2'>Choix 2</li>
                        <li value='Choix3'>Choix 3</li>
                        <li value='Choix4'>Choix 4</li>
                        <li value='Choix5'>Choix 5</li>
                    </ul>
                </fieldset>
            <button id=\"submit\" type=\"submit\">bouton</button>
        </form>";
    }
}

?>
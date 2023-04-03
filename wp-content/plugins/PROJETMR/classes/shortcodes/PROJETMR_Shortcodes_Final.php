<?php

add_shortcode('FORMULAIRE_FINAL', array('PROJETMR_Shortcodes_Final', 'display'));

class PROJETMR_Shortcodes_Final {

    static function display($atts) {

        $html = "";

        $html .= "<script src=\"https://cdn.jsdelivr.net/npm/handlebars@latest/dist/handlebars.js\"></script>
        <script id=\"Script_Modal\" type=\"text/x-handlebars-template\" src=\"".plugins_url(PROJETMR_PLUGIN_NAME."/AssetsJS/handlebar/PROJETMR.hbs")."\"></script>
        <form id=\"formulaire_final\">
            <body>
         TEST <h1>TEST</h1>
            </body>
        </form>";

        return $html;
    }
}

?>
<?php

add_shortcode('FORMULAIRE', array('PROJETMR_Shortcodes_Form', 'display'));

class PROJETMR_Shortcodes_Form
{

    static function display($atts)
    {
        ?>
        <form id="projetmr_form_user">
        <fieldset>
            <legend><?php _e("Your coords") ?></legend>
            <div>
                <select id=\"civilite\" name=\"civilite\">
                    <option value=\"Homme\"> M </option>
                    <option value=\"Femme\"> Mme </option>
                </select>
                <label for="firstname"></label>
                <input type="text" id="firstname" name="firstname" placeholder="Prenom">
                <label for="lastname"></label>
                <input type="text" id="lastname" name="lastname" placeholder="Nom">
                <label for="date"></label>
                <input type="text" id="date" name="date" placeholder="Date de naissance">
            </div>
        </fieldset>
        <button id="btn">Envoyer</button>
    </form>
        <?php
    }

}

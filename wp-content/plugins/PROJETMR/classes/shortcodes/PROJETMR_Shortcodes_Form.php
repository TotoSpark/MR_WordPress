<?php

add_shortcode('FORMULAIRE', array('PROJETMR_Shortcodes_Form', 'display'));

class PROJETMR_Shortcodes_Form
{

    static function display($atts)
    {
        $date = date('Y-m-d');

        return '
        <form id="robert" xmlns="http://www.w3.org/1999/html">
        <fieldset>
            <legend><?php _e("Your coords") ?></legend>
            <div>
                <label for="civilite">civilite</label>
                <select id="civilite" name="civilite">
                    <option value="M">Homme</option>
                    <option value="Mme">Femme</option>
                </select>
                <label for="nom">nom</label>
                <input type="text" id="nom" name="nom">
                <label for="prenom">prenom</label>
                <input type="text" id="prenom" name="prenom">
                <label for="email">email</label>
                <input type="text" id="email" name="email">
                <label for="date">Date de naissance</label>
                <input type="date" id="date-naissance" name="date-naissance" value="'.$date.'" max="'.$date.'">
            </div>
        </fieldset>
        <button id="btn">bouton</button>
    </form>
    ';
    }

}
?>
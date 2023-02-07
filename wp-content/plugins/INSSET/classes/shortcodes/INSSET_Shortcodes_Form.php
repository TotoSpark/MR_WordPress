<?php

add_shortcode('FORMULAIRE', array('INSSET_Shortcodes_Form', 'display'));

class INSSET_Shortcodes_Form
{

    static function display($atts)
    {
        $Insset_Helper_Index = new Insset_Helper_Index();
        $isOpen = $Insset_Helper_Index->isOpen();
        if (!$isOpen)
            return __("Module Ferme");
       // return '<button id="btn"> Bouton</button>';
?>      <form id="robert">
                 <fieldset>
                 <legend><?php _e("Your coords") ?></legend>
                    <div>
                        <label for="firstname"></label>
                        <input type="text" id="firstname" name="firstname">
                        <label for="lastname"></label>
                        <input type="text" id="lastname" name="lastname">
                        <label for="email"></label>
                        <input type="text" id="email" name="email">
                        <label for="codepo"></label>
                        <input type="text" id="codepo" name="codepo">
                    </div>
                </fieldset>
                <button id="btn">bouton</button>
        </form>
<?php
    }

}

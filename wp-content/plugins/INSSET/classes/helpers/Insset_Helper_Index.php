<?php

class Insset_Helper_Index
{
    public function isOpen() {

        $configs = INSSET_Crud_Index::getConfig();

        foreach ($configs as $config)
            if ($id = $config['id'])
                $$id = $config['valeur'];

       if (!@$dateOuverture || !@$dateFermeture)
            return false;

		$start_at = strtotime($dateOuverture);
        $end_at = strtotime($dateFermeture);
        $now = strtotime(date('Y-m-d H:i'));

        return ($now >= $start_at) && ($now <= $end_at);

	}

}
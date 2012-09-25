<?php    function formulaires_annonce_charger_dist(){
            $valeurs = array('id_annonce'=>'', 'titre'=>'', 'contenu'=>'', 'tel' => '', 'prix' => '');
            return $valeurs;
    }
        function formulaires_annonce_verifier_dist(){
            $erreurs = array();
            // verifier que les champs obligatoires sont bien la :
            foreach(array('titre','contenu') as $obligatoire)
            if (!_request($obligatoire)) $erreurs[$obligatoire] = 'Ce champ est obligatoire';
           
            // verifier que si un email a été saisi, il est bien valide :
            include_spip('inc/filtres');
            if(!preg_match("/^0[1-79][0-9]{8}$/i", _request('tel')) && _request('tel') != "")
                    $erreurs['tel'] = 'Votre téléphone n\'est pas valide';

            if(!preg_match("/^[0-9]{1,11}$/i", _request('prix')) && _request('prix') != "")
                    $erreurs['prix'] = 'Votre prix n\'est pas valide';

            return $erreurs;
    }
    function formulaires_annonce_traiter_dist(){
            include_spip('base/abstract_sql');
        	/*sql_insertq('spip_annonces_i', array(
                            'id_annonce' => '',
							'titre' => _request('titre'),
							'contenu' => _request('contenu'),
							'tel' => _request('tel'),
                            'prix' => _request('prix')
						));*/

            echo "Bravo";
    }


?>
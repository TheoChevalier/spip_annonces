<?php   
    function formulaires_connexion_charger_dist(){
        $valeurs = array('login'=>'', 'mdp'=>'');
        return $valeurs;
    }
    function formulaires_connexion_verifier_dist(){
        $erreurs = array();
        foreach(array('login','mdp') as $obligatoire)
            if (!_request($obligatoire)) $erreurs[$obligatoire] = 'Ce champ est obligatoire';

        include_spip('inc/filtres');
        if(!preg_match("/^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/i", _request('login')))
        $erreurs['login'] = 'Votre mail n\'est pas valide';

        include_spip('base/abstract_sql');
        $inscrit = sql_fetsel('*', 'spip_annonces_inscription', 'email='.sql_quote(_request('login')));
        if($inscrit)
        {
            if($inscrit['mdp'] != _request('mdp'))

        }
        else
        {
            $erreurs[$invalide] = 'Email non valide';
        }

        return $erreurs;
    }
    function formulaires_connexion_traiter_dist(){
        include_spip('base/abstract_sql');
        

        echo "Bravo";
    }
?>

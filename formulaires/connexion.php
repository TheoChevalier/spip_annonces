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
        if(!preg_match("/^.{4,32}$/i", _request('login')))
        $erreurs['nom'] = 'Votre nom doit être composé de 4 à 32 caractères';

        include_spip('base/abstract_sql');
        $inscrit = sql_fetsel('*', 'spip_annonces_inscription', 'nom='.sql_quote(_request('login')));
        if($inscrit)
        {
          if($inscrit['mdp'] != _request('mdp')) {
            $erreurs[$invalide] = 'Mauvais mot de passe';
          }
        }
        else
        {
            $erreurs[$invalide] = 'Email non valide';
        }

        return $erreurs;
    }
    function formulaires_connexion_traiter_dist(){
        include_spip('base/abstract_sql');
        $GLOBALS['mail'] = _request('login');
    }
?>

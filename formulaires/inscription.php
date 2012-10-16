<?php
function formulaires_inscription_charger_dist(){
  $valeurs = array('email'=>'','nom'=>'', 'mdp' => '');
  if (isset($GLOBALS['visiteur_session']['email']))
    $valeurs['email'] = $GLOBALS['visiteur_session']['email'];
  return $valeurs;
}

function formulaires_inscription_verifier_dist(){
  $erreurs = array();
  // verifier que les champs obligatoires sont bien la :
  foreach(array('email','nom', 'mdp') as $obligatoire)
  if (!_request($obligatoire)) $erreurs[$obligatoire] = 'Ce champ est obligatoire';
 
  // verifier que si un email a été saisi, il est bien valide :
  include_spip('inc/filtres');
  if (_request('email') AND !email_valide(_request('email')))
    $erreurs['email'] = 'Cet email n\'est pas valide';
  
  if(!preg_match("/^.{4,32}$/i", _request('mdp')))
    $erreurs['mdp'] = 'Votre mot de passe n\'est pas valide';
    
    if(!preg_match("/^.{4,32}$/i", _request('nom')))
    $erreurs['nom'] = 'Votre nom doit être composé de 4 à 32 caractères';
  
  if (count($erreurs))
    $erreurs['message_erreur'] = 'Votre saisie contient des erreurs !';
  return $erreurs;
}

function formulaires_inscription_traiter_dist(){
  include_spip('base/abstract_sql');
  $inscrit = sql_fetsel('*', 'spip_annonces_inscription', 'email='.sql_quote(_request('email')));
  if(!$inscrit) {
      sql_insertq('spip_annonces_inscription', array(
      'email' => _request('email'),
      'nom' => _request('nom'),
      'mdp' => _request('mdp'),
      'key' => md5(microtime(TRUE)*100000),
    ));

      include_spip('inc/mail');

      $t = "Confirmation inscription";
      $titre = nettoyer_titre_email($t);
      $message = nettoyer_caracteres_mail($_request('message'));
      $headers  = 'MIME-Version: 1.0' . $passage_ligne;
      $headers .= 'Content-type: text/html; charset=utf-8' . $passage_ligne;
      $headers .= 'http://"' . $_SERVER['HTTP_HOST'] . '" <no-reply@' . $_SERVER['HTTP_HOST'] . '>' . $passage_ligne;
      envoyer_mail_dist($_request('email'), $titre, $message, $GLOBALS['meta']['email_webmaster'], $headers);

      return array('message_ok'=>'Votre inscription a bien été pris en compte. Vous recevrez prochainement un mail !');
  }
  else
  {
    return array('message_ok'=>'Vous êtes déjà inscrit !');
  }
  
  
}

?>
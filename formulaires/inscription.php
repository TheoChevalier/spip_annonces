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
  }
  $email_to = $GLOBALS['meta']['email_webmaster'];
  $email_from = _request('email');
  $sujet = 'Formulaire de contact';
  $message = _request('message');
  $envoyer_mail($email_to,$sujet,$message,$email_from);
  return array('message_ok'=>'Votre message a bien été pris en compte. Vous recevrez prochainement une réponse !');
}


?>

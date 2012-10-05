<?php
function annonces_declarer_tables_interfaces($interface){
  $interface['table_des_tables']['inscription'] = 'inscription';
  $interface['table_des_tables']['moderation'] = 'moderation';
  return $interface;
}

function annonces_declarer_tables_principales($tables_principales){
  $new_inscription = array(
          "email" => "VARCHAR(100) NOT NULL",
          "nom" => "VARCHAR(100) NOT NULL",
          "mdp" => "VARCHAR(32) NOT NULL",
          "key" => "VARCHAR(50) NOT NULL",
          "confirm" => "BOOLEAN NOT NULL"
  );

  $new_inscription_cles = array(
          "PRIMARY KEY" => "email"
  );
  
  $new_moderation = array(
          "id_annonce" => "INT(11) NOT NULL AUTO_INCREMENT",
          "email" => "VARCHAR(100) NOT NULL",
          "titre" => "VARCHAR(300) NOT NULL",
          "contenu" => "TEXT NOT NULL",
          "tel" => "VARCHAR(10)",
          "prix" => "INT(11)",
          "publier" => "BOOLEAN NOT NULL"
  );

  $new_moderation_cles = array(
          "PRIMARY KEY" => "id_annonce"
  );

  $tables_principales['spip_inscription'] = array(
          'field' => &$new_inscription,
          'key' => &$new_inscription_cles
  );
  $tables_principales['spip_moderation'] = array(
          'field' => &$new_moderation,
          'key' => &$new_moderation_cles
  );
  
  return $tables_principales;
}

?>

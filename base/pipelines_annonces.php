<?php
 function prefixplugin_init_tables_principales($tables_principales){
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
        
        $new_inscription_join = array(
                "email" => "email"
        );
        
        $new_moderation = array(
                "id_annonce" => "INT(11) NOT NULL AUTO_INCREMENT"
                "titre" => "VARCHAR(300) NOT NULL",
                "contenu" => "TEXT NOT NULL",
                "tel" => "VARCHAR(10)",
                "prix" => "INT(11)",
        );

        $new_inscription_cles = array(
                "PRIMARY KEY" => "email"
        );
        
        $new_inscription_join = array(
                "email" => "email"
        );

        $tables_principales['spip_annonces_inscription'] = array(
                'field' => &$new_inscription,
                'key' => &$new_inscription_cles,
                'join' => &$new_inscription_join
        );
        $tables_principales['spip_annnces_moderation'] = array(
                'field' => &$new_moderation,
                'key' => &$new_moderation_cles,
                'join' => &$new_moderation_join
        );
        
        return $tables_principales;
}
?>

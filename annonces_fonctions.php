 <?php   function annonces_insert_head_css($flux) {
        $css = find_in_path('css/formulaire.css');
        $flux .= "<link rel='stylesheet' type='text/css' media='all' href='$css' />\n";
        return $flux;
    }
?>

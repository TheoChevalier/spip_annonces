<?php
annonces_install () {
  include_spip('base/create');
  creer_base($connect='');
  maj_tables('spip_annonces_inscription');
  maj_tables(array('email','nom', 'mdp', 'key', 'confirm'));
}
annonces_maj_tables () {
  include_spip('base/create');
  maj_tables('spip_annonces_inscription');
  maj_tables(array('email','nom', 'mdp', 'key', 'confirm'));
}
?>

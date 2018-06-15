<?php
global $wpdb;

$table = $wpdb->prefix . "form";
$charset_collate = $wpdb->get_charset_collate();
$sql = "CREATE TABLE IF NOT EXISTS $table (
    `id` mediumint(9) NOT NULL AUTO_INCREMENT,
    `nom` text NOT NULL,
    `prenom` text NOT NULL,
    `email` text NOT NULL,
    `message` text NOT NULL,
UNIQUE (`id`)
) $charset_collate;";
require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql );

if ( isset( $_POST["submit_form"] ) && ($_POST["nom"] != "") && ($_POST["prenom"] != "") && ($_POST["email"] != "") && ($_POST["message"] != "")) {
  $table = $wpdb->prefix."form";

  $nom = strip_tags($_POST["nom"], "");
  $prenom = strip_tags($_POST["prenom"], "");
  $email = strip_tags($_POST["email"], "");
  $message = strip_tags($_POST["message"], "");

  $wpdb->insert(
    $table,
    array(
      'nom' => $nom,
      'prenom' => $prenom,
      'email' => $email,
      'message' => $message
    )
  );
  $html = "<p>Your name <strong>$nom</strong> was successfully recorded. Thanks!!</p>";

  echo $html;
}
// if the form is submitted but the name is empty
if ( isset( $_POST["submit_form"] ) && $_POST["nom"] == "" || $_POST["prenom"] == "" || $_POST["email"] == "" || $_POST["message"] == "")
  $html .= "<p>You need to fill the required fields.</p>";
?>

<form id="pose" method="post">
  <div class="form-group">
    <label for="nom">Nom</label>
    <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom">
  </div>
  <div class="form-group">
    <label for="prenom">Prenom</label>
    <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prenom">
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
  </div>
  <div class="form-group">
    <label for="meassage">Message</label>
    <input type="text" class="form-control" id="message" name="message" placeholder="Message">
  </div>
  <input type="submit" name="submit_form" class="btn btn-default" value="submit"/>
</form>

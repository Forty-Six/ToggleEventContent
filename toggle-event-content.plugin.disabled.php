<?php
/*
@name Toggle Event Content
@author Forty-Six <Forty-Six>
@link https://github.com/Forty-Six
@licence CC by nc sa http://creativecommons.org/licenses/by-nc-sa/2.0/fr/
@version 0.5.1
@description Ce plugin ajoute un bouton à chaque article pour en afficher ou non le contenu
*/

// Fonction d'ajout du bouton
function FS_toggleEventContent_AddButton(&$event) {

	$toggle = FS_toggleEventContent_getDefault();

	echo '<div onClick="FS_toggleEventContent(this);" class="pointer FS_toggleEventContent_Button" alt="Toggle the content" title="Toggle the content">'.(($toggle == 1) ? _t('P_TOGGLEEVENTCONTENT_BUTTON_ON') : _t('P_TOGGLEEVENTCONTENT_BUTTON_OFF')).'</div>';
}

// Fonction d'ajout d'un lien dans le menu de gestion
function FS_toggleEventContent_SettingLink(&$myUser) {

	echo '<li><a class="toggle" href="#toggleEventContent">'._t('P_TOGGLEEVENTCONTENT_TITLE').'</a></li>';
}

// Fonction d'affichage du formulaire de gestion
function FS_toggleEventContent_SettingForm(&$myUser) {
	
	$toggle = FS_toggleEventContent_getDefault();
	?>
	<section class="toggleEventContent" id="toggleEventContent" name="toggleEventContent">
		<h2><?php echo _t('P_TOGGLEEVENTCONTENT_TITLE') ?></h2>
		<form action="action.php?action=toggleEventContent_update" method="post">
			<fieldset>
				<legend><?php echo _t('P_TOGGLEEVENTCONTENT_DEFAULT_LEGEND') ?></legend>
				<input type="radio" <?php if ($toggle == 0) echo 'checked="checked"'; ?> value="0" id="toggleEventContent_default_on" name="toggleEventContent_default"><label for="toggleEventContent_default_on"><?php echo _t('P_TOGGLEEVENTCONTENT_DEFAULT_ON') ?></label>
				<input type="radio" <?php if ($toggle == 1) echo 'checked="checked"'; ?> value="1" id="toggleEventContent_default_off" name="toggleEventContent_default"><label for="toggleEventContent_default_off"><?php echo _t('P_TOGGLEEVENTCONTENT_DEFAULT_OFF') ?></label>
			</fieldset>

			<button class="button" type="submit"><?php echo _t('P_TOGGLEEVENTCONTENT_RECORD_BUTTON') ?></button>
		</form>
	</section>
	<?php
}

// Fonction de mise à jour de la table de configuration
function toggleEventContent_Update($_) {

	$config = new Configuration();
	$config->getAll();
	
	if($_['action'] == 'toggleEventContent_update') {
		$config->put('toggleEventContent_default',$_['toggleEventContent_default']);
		$_SESSION['configuration'] = null;

//		header('location: settings.php#toggleEventContent');
		header('location: /');
	}
}

// Fonction de test d'affichage par défaut du contenu
function FS_toggleEventContent_PreTest() {
	
	$toggle = FS_toggleEventContent_getDefault();
	
	if ($toggle == 1) Plugin::addCss('/css/toggle-event-content.css');
}

// Lecture de l'option par défaut
function FS_toggleEventContent_getDefault() {

	$config = new Configuration();
	$config->getAll();
	return $config->get('toggleEventContent_default');
}

// Lecture des paramètres de configuration
$FS_config = new Configuration();
$FS_config->getAll();

// Insertion du bouton 'Haut'
// si l'affichage du contenu de l'article est demandé
if ($FS_config->get('articleDisplayContent') == '1') {
	Plugin::addHook("event_pre_top_options", "FS_toggleEventContent_AddButton");
}

// Insertion du bouton 'Bas'
// si l'affichage du contenu de l'article * entier * est demandé
if ( ($FS_config->get('articleDisplayContent') == '1') and ($FS_config->get('articleView') != 'partial') ) {
	Plugin::addHook("event_pre_bottom_options", "FS_toggleEventContent_AddButton");
}

// Restriction sur la configuration des plugins
// Issue: https://github.com/ldleman/Leed-market/issues/79
$myUser = ( isset($_SESSION['currentUser']) ? unserialize($_SESSION['currentUser']) : false );

if ($myUser != false) {
	// Insertion du lien dans le menu de gestion
	Plugin::addHook("setting_post_link","FS_toggleEventContent_SettingLink");
	// Affichage du menu de gestion
	Plugin::addHook("setting_post_section","FS_toggleEventContent_SettingForm");
	// Mise à jour du choix de l'affichage
	Plugin::addHook("action_post_case", "toggleEventContent_Update"); 
}

// Execution du choix : insertion ou non du CSS
Plugin::addHook("index_pre_treatment","FS_toggleEventContent_PreTest");

// Insertion du javascript
Plugin::addJs("/js/main.js");


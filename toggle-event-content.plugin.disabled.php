<?php
/*
@name ToggleEventContent
@author Forty-Six <Forty-Six>
@link https://github.com/Forty-Six
@licence CC by nc sa http://creativecommons.org/licenses/by-nc-sa/2.0/fr/
@version 0.3
@description Ce plugin ajoute un bouton à coté du titre de chaque événement pour en afficher ou non le contenu
*/

// Fonction d'ajout du bouton
function FS_toggleEventContent_AddButton(&$event) {

	echo '<div onClick="FS_toggleEventContent(this);" class="pointer FS_toggleEventContent_Button" alt="Toggle the content" title="Toggle the content">Toggle off</div>';
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

// Insertion du javascript
Plugin::addJs("/js/main.js");


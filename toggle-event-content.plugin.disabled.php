<?php
/*
@name ToggleEventContent
@author Forty-Six <Forty-Six>
@link https://github.com/Forty-Six
@licence CC by nc sa http://creativecommons.org/licenses/by-nc-sa/2.0/fr/
@version 0.2
@description Ce plugin ajoute un bouton à coté du titre de chaque événement pour en afficher ou non le contenu
*/

// Ajouter le bouton si le Affichage du contenu de l'article est demandé
function FS_toggleEventContent_AddButton(&$event) {

        $config = new Configuration();
        $config->getAll();

	if ($config->get('articleDisplayContent') == '1') {
		echo '<div onClick="javascript:FS_toggleEventContent(\''.$event->getId().'\');" class="pointer FS_toggleEventContent_Button FS_rightSpace" alt="Toggle the content" title="Toggle the content" id="FS_toggleEventContent_Button_'.$event->getId().'">Toggle on</div>';
	}
}

// Ajouter la balise ouvrante
function FS_toggleEventContent_Begin(&$event) {
	echo '<div id="event_'.$event->getId().'" style="display:none">';
}

// Ajouter la balise fermante
function FS_toggleEventContent_End(&$event) {
	echo '</div>';
}


// Ajouter des balises autour des détails et options de l'article affiché entier
function FS_toggleEventOptions_Begin (&$event) {
	echo '<div id="eventOptions_'.$event->getId().'" style="display:none">';
	echo '<div onClick="javascript:FS_toggleEventContent(\''.$event->getId().'\');" class="pointer FS_toggleEventContent_Button FS_leftSpace" alt="Toggle the content" title="Toggle the content" id="FS_toggleEventContent_Button_'.$event->getId().'">Toggle off</div>';
}
function FS_toggleEventOptions_End (&$event) {
	echo "</div>";
}

// Ajouter des balises autour du contenu de l'article
$FS_config = new Configuration();
$FS_config->getAll();

if ($FS_config->get('articleDisplayContent') == '1') {
	
	switch ($FS_config->get('articleView')) {

		case 'partial':
		Plugin::addHook("event_pre_description", "FS_toggleEventContent_Begin");
		Plugin::addHook("event_post_description", "FS_toggleEventContent_End");
		break;
		
		default:
		case 'complete':
		Plugin::addHook("event_pre_content", "FS_toggleEventContent_Begin");
		Plugin::addHook("event_post_content", "FS_toggleEventContent_End");
		Plugin::addHook("event_pre_bottom_options", "FS_toggleEventOptions_Begin");
		Plugin::addHook("event_post_bottom_options", "FS_toggleEventOptions_End");
		break;
	}
}

// Insertion du bouton
Plugin::addHook("event_post_top_options", "FS_toggleEventContent_AddButton");

// Insertion du javascript
Plugin::addJs("/js/main.js");


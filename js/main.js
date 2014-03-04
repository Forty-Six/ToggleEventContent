/*
@name ToggleEventContent
@author Forty-Six <Forty-Six>
@link https://github.com/Forty-Six
@licence CC by nc sa http://creativecommons.org/licenses/by-nc-sa/2.0/fr/
@version 0.5
@description Ce plugin ajoute un bouton à chaque article pour en afficher ou non le contenu
*/

function FS_toggleEventContent(element) {

    // Affiche / Cache le contenu de l'article désigné
    // Affiche / Cache les détails de l'article entier désigné
    
	eventBloc = $(element).parent().parent();
	eventContent = $('div.articleContent', eventBloc);
	eventButtons = $('div.FS_toggleEventContent_Button', eventBloc.children('h3.articleDetails'));
	eventDetails = eventBloc.children('h3.articleDetails:last-child');

	if (eventContent.css('display') == 'none') {
		if (eventDetails) eventDetails.css('display', 'block');
		eventButtons.html( _t('P_TOGGLEEVENTCONTENT_BUTTON_OFF') );
	} else {
		eventButtons.html( _t('P_TOGGLEEVENTCONTENT_BUTTON_ON') );
		if (eventDetails) eventDetails.css('display', 'none');
	}
	eventContent.slideToggle(200);
}


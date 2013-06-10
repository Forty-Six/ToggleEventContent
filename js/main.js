/*
@name ToggleEventContent
@author Forty-Six <Forty-Six>
@link https://github.com/Forty-Six
@licence CC by nc sa http://creativecommons.org/licenses/by-nc-sa/2.0/fr/
@version 0.2
@description Ce plugin ajoute un bouton à coté du titre de chaque événement pour en afficher ou non le contenu
*/

function FS_toggleEventContent(eventId) {

    // Affiche / Cache le contenu de l'événement désigné
    // Affiche / Cache les détails de l'événement entier désigné
    
    var targetEvent;
    targetEvent = document.getElementById('event_' + eventId);
    optionsEvent = document.getElementById('eventOptions_' + eventId);
    eventButton = document.getElementById('FS_toggleEventContent_Button_' + eventId);

    if (targetEvent.style.display == 'none') {
    	targetEvent.style.display = '';
    	if (optionsEvent) optionsEvent.style.display = '';
    	eventButton.innerHTML = "Toggle off";
    } else {
    	targetEvent.style.display = 'none';
    	if (optionsEvent) optionsEvent.style.display = 'none';
    	eventButton.innerHTML = "Toggle on";
    }

}

/**
 * # QUESTO FILE È COMPILATO DA MIX #
 * (inserito in webpack.mix.js)
 */

/**
 * HEADER LOGOUT BUTTON
 * 
 * eccezione per rotte 'sponsorships' e 'statistics'
 * che non possono far uso di app.js
 * il pulsante deve funzionare senza vuejs
 *  
 * codice collegato in:
 * views/partials/header_dash.blade.php
 */
const panel  = document.getElementById('auth-panel');
const button = document.getElementById('togglePanel');

panel.style.display = 'none';
var isPanelOpen = false;

button.addEventListener('click',function(e){
	e.stopPropagation();
	if (isPanelOpen) {
		panel.style.display = 'none';
		isPanelOpen = false;
	}
	else {
		panel.style.display = 'block';
		isPanelOpen = true;
	} 
});

document.addEventListener('click',function(){
	panel.style.display = 'none';
	isPanelOpen = false;
});



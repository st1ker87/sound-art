
# ORIENTAMENTO TECNICO-ORGANIZZATIVO

**fattibile tutti insieme**
* db: disegno
* framework: nascita + risorse
  * laravel
  * vue >>> vedi sotto (no components)
  * axios
  * bootstrap
* layout: disegno
* sass: struttura pezzetti

**cosa vogliamo sicuramente**
* laravel
* api interne
* sass (eventualemente plain css a discrezione individuale)
* extra: geolocalizzazione (per bdoctors/deliveboo)
 
**dubbi**
* scambiarsi continuamente ruoli ?
* messaggi: solo DB oppure anche email?

NOTA: l'orientamento risulta disaccoppiato da scelta progetto 

&nbsp;


# SCAFFOLDING MEMO (DRAFT)

**LARAVEL** (v.7.0)
```
composer create-project --prefer-dist laravel/laravel:^7.0 project_name
```

**MIX** (già attivo v5.0.1)
* `/webpack.mix.js`: direttive notifiche e paths
	```js
	mix.js('resources/js/app.js', 'public/js')
		.sass('resources/sass/app.scss', 'public/css')
		.disableSuccessNotifications()	// solo notifiche con errore
		.options({processCssUrls:false}); // gestisco io i path delle immagini in css
	```

**LARAVEL STORAGE**

1. `/*{active PHP installation}/php.ini`: abilitare `extension=fileinfo`
2. `/config/filesystems.php` > riga16: `'local'` diventa `'public'`
	```php
	'default' => env('FILESYSTEM_DRIVER', 'public'),
	```
3. collegamento con cartella `/storage/` (link simbolico `/storage/app/public/`<->`/public/storage/`)
	```
	php artisan storage:link
	```

**FAKER: sostituzione**

1. rimozione Zaninotto, installazione Fakerphp
	```
	composer remove fzaninotto/faker
	composer require fakerphp/faker
	```

**DB: collegamento in laravel**

1. db name: *db_sound_art*
2. `/.env`: connessione db (eventualmente anche mail server)
	```
	DB_CONNECTION=mysql
	DB_HOST=127.0.0.1
	DB_PORT=3306
	DB_DATABASE={<<DB_NAME>>}
	DB_USERNAME=root
	DB_PASSWORD={<<PWD=root>>}
	```

**VUE: installazione con autenticazione**

1. prerequisito laravel/ui, installazione Vue tramite ui, avvio
	```
	composer require laravel/ui:^2.4
	php artisan ui vue --auth 
	npm install | npm audit fix | npm run dev | npm run watch
	```
2. pagine view o layout, `<head>`: puntamento compilato js
	```html
	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}" defer></script>
	```
3. pagine view o layout, `<body>`: contenitore html per Vue
	```html
	<div id="app">...</div>
	```
4. `/resources/js/app.js`: oggetto Vue()
	```js
	const app = new Vue({
		el: '#app',
		...
	});
	```

**SASS** (già attivo)

1. pagine view o layout, `<head>`: puntamento compilato css 
	```html
	<!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	```

**BOOTSTRAP** (già attivo v4.0)

1. `/resources/sass/app.scss`: import bootstrap già predisposto da laravel
	```scss
	// Bootstrap
	@import '~bootstrap/scss/bootstrap';
	```

**AXIOS** (già attivo)

* nulla da fare

&nbsp;

# ####################################################

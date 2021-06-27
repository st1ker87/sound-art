
# ####################################################
# PHP (https://www.php.net/docs.php)

**prerequisiti**
installazione PHP via MAMP/XAMPP/WAMP

**WIN disponibilità globale**
System Properties > Environment Variables > System Variables > Path = C:\MAMP\bin\php\[php in uso]

**MAC disponibilità globale da bash shell**
sudo nano ~/.bash_profile
*inserire riga*
export PATH=/Applications/MAMP/Library/bin:/Applications/MAMP/bin/php/[php in uso]/bin:$PATH

**verifica versione**
php -v

**var_dump prettify**
*WIN scommentare in C:/MAMP/conf/{PHP in uso}/php.ini*
*MAC scommentare in ........../{PHP in uso}/php.ini*
extension=php_xdebug.dll

# ####################################################
# NPM front-end packages (Node.js)

**installazione**
*Node.js con NPM*
https://nodejs.org/it/download/

# ####################################################
# LARAVEL-MIX stand-alone (https://laravel-mix.com/)

**prerequisiti**
NPM (Node.js)

**laravel-mix: installazione**
*DENTRO cartella progetto*
npm init -y
npm install laravel-mix --save-dev

**laravel-mix; comandi base**
*compilazione css*
npx mix
*compilazione css restando in ascolto*
npm mix watch

# ####################################################
# COMPOSER - back-end packages (https://getcomposer.org/)

**WIN installer di composer**
https://getcomposer.org/Composer-Setup.exe
*durante installazione indicare path PHP in uso*
C:\MAMP\bin\php\[php in uso]

**MAC download installer**
curl -sS https://getcomposer.org/installer | php

**MAC disponibilità globale**
sudo mv composer.phar /usr/local/bin/composer

**comandi composer**
*versione e man*
composer -v
*installazione dipendenze definite in composer.json*
composer install
*WIN installazione dipendenze definite in composer.json, installazione creata da altra piattaforma*
composer install --ignore-platform-reqs
*installazione libreria specifica (nel progetto)*
composer require “nomelibreria”
*aggiornamento dipendenze (occhio!)*
composer update

# ####################################################
# LARAVEL (https://laravel.com/docs/7.x)

**prerequisiti**
COMPOSER, PHP

**laravel: installazione per setup progetto**
*FUORI cartella progetto /project_name/ (la cartella viene creata)* 
*versione 7.0*
composer create-project --prefer-dist laravel/laravel:^7.0 project_name
**artisan: comandi base**
*local server: avvio (default port 8000)*
php artisan serve
*local server: avvio su porta diversa*
php artisan serve --port=8001
*lista di comandi artisan*
php artisan list
*schema riassuntivo delle rotte*
php artisan route:list
*man di comando*
php artisan --help route:list

**MVC management**
*CONTROLLER: creazione*
*nome controller singolare PascalCase*
php artisan make:controller NomeController
*CONTROLLER & CRUD: creazione*
php artisan make:controller --resource NomeController
*MODEL: creazione tramite ORM Eloquent*
*nome controller singolare PascalCase <-> tabella plurale minuscolo*
*attivazione driver > PHP in uso > php.ini: extension=pdo_mysql*
php artisan make:model ModelName
*MODEL, RESOURCE, MIGRATION, SEEDER: creazione unica*
php artisan make:model ModelName -rcms

**DB management MIGRATION + SEEDING**
*MIGRATION setup*
*definizione file istruzioni creazione/rollback tabella products*
php artisan make:migration create_products_table
*MIGRATION update*
*definizione file istruzioni modifica/rollback tabella products*
php artisan make:migration update_products_table --table=products
*MIGRATION esecuzione*
*esecuzione istruzioni (non già eseguite) in /database/migrations su DB connesso*
php artisan migrate
*MIGRATION ritorno allo stato precedente*
php artisan migrate:rollback
*MIGRATION cancellazione di tutte le migration dall'inizio*
*(esecuzione di tutti i down() in ordine inverso)*
php artisan migrate:reset
*MIGRATION ripristino stato iniziale e rieseguo tutte le migrations*
*(esecuzione di tutti i down() in ordine inverso, poi tutti gli up() in oridne diretto)*
php artisan migrate:refresh
*MIGRATION controllo migrazioni fatte e da fare*
php artisan migrate:status
*SEEDER: creazione seeder*
php artisan make:seeder ProductsTableSeeder
*SEEDER: esecuzione default seeder collector (DatabaseSeeder.php)*
php artisan db:seed
*SEEDER: esecuzione seeder specifico*
php artisan db:seed --class=ProductsTableSeeder
*FAKER sostituzione zaninotto->fakerphp (https://fakerphp.github.io/)*
composer remove fzaninotto/faker
composer require fakerphp/faker
*in caso di problemi sul riconoscimento delle classi*
composer dump-autoload

**DATE management**
*carbon (https://carbon.nesbot.com/)*
/vendor/laravel/framework/src/Illuminate/Support/Carbon.php

**AUTENTICAZIONE**
*laravel ui: installazione*
*pacchetto di strumenti di base per bootstrap, Vue.js, etc.*
*versione 2.4*
composer require laravel/ui:^2.4
*scaffolding: bootstrap + autentication*
php artisan ui bootstrap --auth
*oppure*
*scaffolding: Vue.js + autentication*
php artisan ui vue --auth
*laravel login/register form > sass > laravel-mix*
npm install | npm audit fix | npm run dev | npm run watch
*DB tables: users, pwd_reset > migration*
php artisan migrate
*controller degli autenticati*
php artisan make:controller Admin/HomeController
*middelware custom*
php artisan make:middleware NomeMiddleware
app/Http/Kernel.php:
	protected $routeMiddleware = [
		...
		'custom_middelware_name' => \App\Http\Middleware\NomeMiddleware::class,
	];

**laravel-mix: installazione dentro laravel**
*package.json: laravel-mix v5.0.1 >>> comandi diversi*
*installazione dipendenze definite in package.json*
npm install
*in caso di vulnerabilities trovate*
npm audit fix
*compilazione css*
npm run dev
*compilazione css restando in ascolto*
npm run watch

**bootstrap: installazione dentro laravel**
*cartella /node_modules/bootstrap/scss/bootstrap/*
npm install bootstrap

**axios: installazione dentro laravel**
*cartella /node_modules/axios/*
npm install axios

**Vue router: installazione dentro laravel**
*getione rotte tramite Vue*
*scaffolding: Vue.js*
php artisan ui vue 
*oppure*
*scaffolding: Vue.js + autentication*
php artisan ui vue --auth
*Vue router: installazione*
npm install vue-router

**Laravel MAIL**
*guzzle: installazione/aggiornamento*
composer require guzzlehttp/guzzle
*gestore di servizi email: creazione (nome scelto: SendNewMail)*
*(viene governato da un controller)*
php artisan make:mail SendNewMail

**Laravel STORAGE**
*1. php.ini: abilitare extension=fileinfo*
*2. /config/filesystems.php > riga16: 'local' diventa 'public'*
*'default' => env('FILESYSTEM_DRIVER', 'public'),*
*solo a quel punto lanciare il comando seguente*
*collegamento con cartella /storage/*
*genera link simbolico /storage/app/public/<->/public/storage/*
php artisan storage:link





# ####################################################
# VUE CLI (https://cli.vuejs.org/)

**VUE/CLI: installazione**
*vue/cli*
npm install -g @vue/cli
*Windows PowerShell: in caso di problemi di autorizzazione*
Set-ExecutionPolicy remotesigned
*versione*
vue --version
*creazione progetto*
*FUORI cartella progetto /project_name/ (la cartella viene creata)* 
vue create project_name
*CLI settings*
	1. Manually select features
	2. Choose Vue version, Babel, CSS Pre-processors, Linter / Formatter
	3. 2.x
	4. Sass/SCSS (with dart-sass)
	5. ESLint + Prettier
	6. Lint on save
	7. In dedicated config files
*local webserver (default port:8080)*
npm run serve

# ####################################################
# GIT CLI (https://git-scm.com/book/en/v2/Getting-Started-The-Command-Line)

**CLONE from github**
*FUORI cartella progetto (la cartella {repo_name} viene creata)*
git clone https://github.com/{git_user}/{repo_name}.git
*esempi Dossetto*
git clone https://github.com/pdossetto/pokemon.git
git clone https://github.com/pdossetto/laravel-vue-base-scaffolding.git
https://github.com/pdossetto/boolisana-laravel-vue.git
*front-end dependencies*
npm install
*back-end dependencies*
composer install
*back-end dependencies (other platfrom project)*
composer install --ignore-platform-reqs

# ####################################################
# SCARICARE DA GITHUB E ALLINEARSI

**prelevare da github**

*scaricare da github*
git clone https://github.com/RikoPiko/sound-art

**completare l'installazione**

*front-end dependencies: installazione e avvio*
npm install
npm install | npm audit fix | npm run dev | npm run watch
*back-end dependencies*
composer install
*back-end dependencies (other platfrom project)*
composer install --ignore-platform-reqs


# ####################################################
# ISSUES

**MAC xcode (macOS Catalina ??)**
*in my case /Library/Developer/CommandLineTools*
xcode-select --print-path
*the next line deletes the path returned by the command above*
sudo rm -rf $(xcode-select --print-path)
*install them (again) if you don't get a default installation prompt*
xcode-select --install

# ####################################################




























# ############################################################# #
# DATABASE > Tipo di dato > Formato

**Numeri**
	TINYINT			1B [-128,127] (ok boolean)
	SMALLINT		2B [-32768,32767] 
	MEDIUMINT		3B [-8388608,8388607]
	INT				4B [-2147483648,2147483647]
	BIGINT			8B [-9.223372*10ˆ18,9.223372*10ˆ18]
	FLOAT (I,D)		4B
	DOUBLE (I,D)	8B
	DECIMAL (I,D)	8B con arrotondamenti

**Stringhe**
	VARCHAR 	max 255 caratteri
	TEXT 		max 65535 caratteri (ok descrizioni prodotto)
	MEDIUMTEXT 	max 16MB
	LONGTEXT	max 4.2GB

**Date**
	DATETIME	[YYYY-MM-GG HH:II:SS]
	DATE		[YYYY-MM-GG]
	TIME		[HH:II:SS]
	YEAR		[YYYY]
	TIMESTAMP	formato variabile

**Altri meno utilizzati**
	a. Dati geometrici/geografici
	b. Dati binary (BLOB)

# ############################################################# #



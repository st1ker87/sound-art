/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

const { split } = require('lodash');

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
	el: '#app',
	data: {
		/* PANNELS SHOW */
		searchHome : false,
		showCategoryPannel : false,
		showGenrePannel : false,
		showVotePannel : false,

		/*BUTTONS IN PAGINA SEARCH*/
		btnCategories : null,
		btnGeneres : null,
		btnVotes : null,
		//scroll per nav bar (per ora solo in search.blade)
		scrollPosition: null,
		scrollChange: 400,

		// FILTER
		category_selected	: null,
		genre_selected		: null,
		vote_selected 		: null,
		reviewNum_selected	: null,

		// INTERNAL APIs
		iper_profiles_url	: 'http://localhost:8000/api/profiles',
		iper_profiles		: [],
		iper_profiles_display: [],

	},
	methods: {
		showSearch : function() {
			this.searchHome = !this.searchHome;		
		},
		showCategory: function() {
			this.showCategoryPannel = !this.showCategoryPannel;
			this.showGenrePannel = false;
			this.showVotePannel = false;
		},
		showGenres: function() {
			this.showGenrePannel = !this.showGenrePannel;
			this.showCategoryPannel = false;
			this.showVotePannel = false;
		},
		showVotes: function() {
			this.showVotePannel = !this.showVotePannel;
			this.showCategoryPannel = false;
			this.showGenrePannel = false;
		},
		setCategory: function (category) {
			if(category === 'No filter') {
				this.category_selected = null;
			}
			else {
				this.category_selected = category;
			}
			this.btnCategories = category;
			this.showCategoryPannel = false;
		},
		setGenre: function (genre) {
			if(genre === 'No filter') {
				this.genre_selected = null;
			}
			else {
				this.genre_selected = genre;
			}
			this.btnGeneres = genre;
			this.showGenrePannel = false;
		},
		setVote: function (vote) {
			if(vote === 'No filter') {
				this.vote_selected = null;
			}
			else {
				this.vote_selected = vote;
			}
			this.btnVotes = vote;
			this.showVotePannel = false;	
		},

		//metodo per lo scroll
		updateScroll() {
			this.scrollPosition = window.scrollY
		},

		// INTERNAL APIs
		filterCall() {
			console.log(this.category_selected);
			console.log(this.genre_selected);
			console.log(this.vote_selected);
			console.log(this.reviewNum_selected);

			axios.get(this.iper_profiles_url, {
				params: {
					category	: this.category_selected,
					genre		: this.genre_selected,
					vote		: this.vote_selected,
					reviewNum	: this.reviewNum_selected,
				}
			})
			.then((resp) => {
				this.iper_profiles = resp.data.results;
				console.log('this.iper_profiles',this.iper_profiles);
			})
			.catch((error) => {
				console.error(error);
			});
		},
		
		searchDefault() {
			if(typeof(search_from_home_key) !== 'undefined'){
				if(search_from_home_key === 'category') {
					this.btnCategories = search_from_home_value;
					this.category_selected = search_from_home_value;
					this.btnGeneres = 'Genre';
					this.btnVotes = 'Votes';
				}
				else if (search_from_home_key === 'genre') {
					this.btnGeneres = search_from_home_value;
					this.genre_selected = search_from_home_value;
					this.btnCategories = 'Categories';
					this.btnVotes = 'Votes';
				}
				else {
					this.btnCategories = 'Categories';
					this.btnGeneres = 'Genres';
					this.btnVotes = 'Vote';
				}
				this.filterCall();
			}
			else {
				this.btnCategories = 'Categories';
				this.btnGeneres = 'Genres';
				this.btnVotes = 'Vote';
				this.filterCall();
			}
		}
	},
	mounted() {
		window.addEventListener('scroll', this.updateScroll);
		this.searchDefault();	
		
		// INTERNAL APIs
		// chiamate di test (in realtà avviene al Filter Submit)
		// this.filterCall_TEST('Drummer','Metal',3,5); // 1 risultato [OK]
		// this.filterCall_TEST('Drummer','Metal',3,6); // 0 risultati [OK]
		// this.filterCall_TEST(null,null,3,4); // 2 risultati
		// this.filterCall_TEST(null,null,3,1); // 5 risultati
		// this.filterCall_TEST(null,'New-age',null,null); // 3 risultati [OK]
		// this.filterCall_TEST('Mixer/Engineer',null,null,null); // 3 risultati [OK]
		// this.filterCall_TEST('Classical Guitarist',null,null,null); // 2 risultati [OK]
		// this.filterCall_TEST(null,null,null,null); // 11 risultati [OK]
	},
	created() {
			
	},
	updated() {
	}
});


////////////////////////////////////////////////////////
// COSE DA FARE
/**
 * [1]
 * ! aggiungere in ogni "tendina" la voce di non-selezione
 */
/**
 * [2]
 * ! chiudere tendine quando clicco altrove
 */

////////////////////////////////////////////////////////
// COSE FATTIBILI
/**
 * [1] 
 * lisa valori DB di: categories, genres, (eventuelmente) offers
 */
////////////////////////////////////////////////////////

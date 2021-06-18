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
		btnCategories : 'Categories',
		btnGeneres : 'Genres',
		btnVotes : 'Vote',
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

	},
	methods: {
		showSearch : function() {
			this.searchHome = !this.searchHome
		},
		showCategory: function() {
			this.showCategoryPannel = !this.showCategoryPannel;
		},
		showGenres: function() {
			this.showGenrePannel = !this.showGenrePannel;
		},
		showVotes: function() {
			this.showVotePannel = !this.showVotePannel;
		},
		setCategory: function (category) {
			this.btnCategories = category;
			this.showCategoryPannel = false;
			this.genre_selected = category;
		},
		setGenre: function (genre) {
			this.btnGeneres = genre;
			this.showGenrePannel = false;
			this.category_selected = genre;
		},
		setVote: function (vote) {
			this.btnVotes = vote;
			this.showVotePannel = false;
			this.vote_selected = vote;
		},

		//metodo per lo scroll
		updateScroll() {
			this.scrollPosition = window.scrollY
		},

		// INTERNAL APIs
		// STEP 1 utente seleziona alcune delle 4 tendine > ottengo i vari {qualcosa}_selected
<<<<<<< HEAD
		// STEP 2 al Submit chiamo filterCall(category_selected,genre_selected,vote_selected,reviewNum_selected)
		filterCall() {
=======
		// STEP 2 al Submit dell'utente chiamo filterCall(category_selected,genre_selected,vote_selected,reviewNum_selected)
		filterCall(_category,_genre,_vote,_reviewNum) {

>>>>>>> 8f5a66fa76a1f55de5a4a74354790873fee5d4e7
			axios.get(this.iper_profiles_url, {
				params: {
					category	: this.category_selected,
					genre		: this.genre_selected,
					vote		: this.vote_selected,
					reviewNum	: this.reviewNum_selected,
				}
			})
			.then((resp) => {
				console.log('resp',resp);
				console.log('resp.data',resp.data);
				this.iper_profiles = resp.data.results;
				console.log('this.iper_profiles',this.iper_profiles);
			})
			.catch((error) => {
				console.error(error);
			});
		},


	},
	mounted() {
		window.addEventListener('scroll', this.updateScroll);


		// INTERNAL APIs
		// chiamate di test (in realtà avviene al Filter Submit)
		// this.filterCall('Drummer','Metal',3,5); // 1 risultato [OK]
		// this.filterCall('Drummer','Metal',3,6); // 0 risultati [OK]
		// this.filterCall(null,null,3,4); // 2 risultati
		// this.filterCall(null,null,3,1); // 5 risultati
		// this.filterCall(null,'New-age',null,null); // 3 risultati [OK]
		// this.filterCall('Mixer/Engineer',null,null,null); // 3 risultati [OK]
		// this.filterCall('Classical Guitarist',null,null,null); // 2 risultati [OK]
		this.filterCall(null,null,null,null); // 11 risultati [OK]
	}
});

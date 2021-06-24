/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

const { split } = require('lodash');

require('./bootstrap');
require('./aux1');

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
		humburger : false,

		/*BUTTONS IN PAGINA SEARCH*/
		btnCategories : null,
		btnGeneres : null,
		btnVotes : null,
		//scroll per nav bar (per ora solo in search.blade)
		scrollPosition: null,
		scrollChange: 400,

		//BASE URL CARDS
		base_url : null,







		// API FILTERS
		category_selected	: null,
		genre_selected		: null,
		vote_selected 		: null,
		reviewNum_selected	: null,
		onlySponsorship		: false,
		profile_num_start : null,
		profile_num_end : null,

		// INTERNAL APIs
		iper_profiles_url	: 'http://localhost:8000/api/profiles',
		iper_profiles		: [],
		iper_profiles_display: [],













	},
	methods: {
		showHumburger : function() {
			this.humburger = !this.humburger;
		},
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
		stopProp: function(e) {
			e.stopPropagation();
		},
		btnSubmit() {
			this.showCategoryPannel = false;
			this.showGenrePannel = false;
			this.showVotePannel = false;
			this.profile_num_start = 1;	//Costante = profile_num_start + (counter * 24)
			this.profile_num_end = 24;  //Costante
			this.filterCall();
		},
		btnMore() {

		},
		// INTERNAL APIs
		filterCall() {		
			axios.get(this.iper_profiles_url, {
				params: {
					category	: this.category_selected,
					genre		: this.genre_selected,
					vote		: this.vote_selected,
					reviewNum	: this.reviewNum_selected,
					only_sponsorship: this.onlySponsorship,
					profile_num_start : this.profile_num_start,
					profile_num_end : this.profile_num_end
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
			this.profile_num_start = 1;
			this.profile_num_end = 24;
			if(typeof(search_from_home_key) !== 'undefined'){
				if(search_from_home_key === 'category') {
					this.btnCategories = search_from_home_value;
					this.category_selected = search_from_home_value;
					this.btnGeneres = 'No filter';
					this.btnVotes = 'No filter';
				}
				else if (search_from_home_key === 'genre') {
					this.btnGeneres = search_from_home_value;
					this.genre_selected = search_from_home_value;
					this.btnCategories = 'No filter';
					this.btnVotes = 'No filter';
				}
				else {
					this.btnCategories = 'No filter';
					this.btnGeneres = 'No filter';
					this.btnVotes = 'No filter';
				}
			}
			else {
				this.btnCategories = 'No filter';
				this.btnGeneres = 'No filter';
				this.btnVotes = 'No filter';
			}
			this.filterCall();
		},

		addEventClickListener() {
			document.addEventListener('click', () => {
				this.showCategoryPannel = false;
				this.showGenrePannel = false;
				this.showVotePannel = false;
				this.searchHome = false;
			});
			return;
		},
		scrollSearch() {
			let x = document.querySelector('.header-search');
			let z = document.querySelector('.jumbotron-container-search');
			let y = document.querySelector('[class^=search-bar]');
				window.addEventListener('scroll', function() {
				if(window.scrollY > (x.offsetHeight + z.offsetHeight)) {
					y.classList.remove('search-bar-white');
					y.classList.add('search-bar-blue');
				}
				else {
					y.classList.remove('search-bar-blue');
					y.classList.add('search-bar-white');
				}
			});
			
		}
	},
	mounted() {

		// console.log('window.location.pathname: ',window.location.pathname);
		var ulr_path = window.location.pathname;
		if (ulr_path == '/') {
			this.onlySponsorship = true,
			this.searchDefault();
			this.addEventClickListener();
			this.base_url = 'profiles/search/';
		}	
		if (ulr_path == '/profiles/search') {
			this.onlySponsorship = false,
			this.searchDefault();
			this.addEventClickListener();
			this.scrollSearch();
			this.base_url = 'search/';
		}
	},
	created() {			
	},
	updated() {
	}
});


// scroll su link con ancora nella pagina

$(document).ready(function(){
  // Add smooth scrolling to all links
  $("a").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 700, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
        console.log(this.hash);
      });
    } // End if
  });
});


////////////////////////////////////////////////////////
// COSE DA FARE
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


/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

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
		searchHome : false,
		//scroll per nav bar (per ora solo in search.blade)
		scrollPosition: null,
		scrollChange: 400,


		// INTERNAL APIs
		iper_profiles_url	: 'http://localhost:8000/api/profiles',
		iper_profiles		: [],


	},
	methods: {
		showSearch : function() {
			this.searchHome = !this.searchHome
		},
		//metodo per lo scroll
		updateScroll() {
			this.scrollPosition = window.scrollY
		},

		// INTERNAL APIs
		iperProfilesCall() {
			axios.get(this.iper_profiles_url, {
				// headers: {
				// 	'Authorization': 'Bearer '+this.access_token
				// }
			})
			.then((resp) => {
				// console.log('resp',resp);
				// console.log('resp.data',resp.data);
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
		// ! STABILIRE QUANDO ESEGUIRE LA CHIAMATA
		this.iperProfilesCall();


	}
});

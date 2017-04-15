
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

require('hideshowpassword');

Dropzone = require('dropzone');

password = require('password-strength-meter');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));

// const app = new Vue({
//     el: '#app'
// });

$.fn.extend({

	toggleText: function(a, b){
	  	return this.text(this.text() == b ? a : b);
	},

	/**
	 * Remove element classes with wildcard matching. Optionally add classes:
	 *   $( '#foo' ).alterClass( 'foo-* bar-*', 'foobar' )
	 *
	 */
	alterClass: function(removals, additions) {

		var self = this;

		if(removals.indexOf('*') === -1) {
			// Use native jQuery methods if there is no wildcard matching
			self.removeClass(removals);
			return !additions ? self : self.addClass(additions);
		}

		var patt = new RegExp( '\\s' +
				removals.
					replace( /\*/g, '[A-Za-z0-9-_]+' ).
					split( ' ' ).
					join( '\\s|\\s' ) +
				'\\s', 'g' );

		self.each(function(i, it) {
			var cn = ' ' + it.className + ' ';
			while(patt.test(cn)) {
				cn = cn.replace( patt, ' ' );
			}
			it.className = $.trim(cn);
		});

		return !additions ? self : self.addClass(additions);
	}

});

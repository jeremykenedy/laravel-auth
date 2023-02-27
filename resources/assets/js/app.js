import { createApp } from "vue";
import "./bootstrap";
import Alpine from "alpinejs";
import * as bootstrap from "bootstrap"; // eslint-disable-line no-unused-vars
import jQuery from "jquery";
import axios from "axios";
import "@fortawesome/fontawesome-free/css/all.min.css";
// import VueSecureHTML from 'vue-html-secure';

Object.assign(window, { $: jQuery, jQuery });
window.jQuery = window.$ = $;
window.Alpine = Alpine;
// window.Vue = require('vue');

Alpine.start();

axios.defaults.withCredentials = true;

const app = createApp({});

$.fn.extend({
  toggleText: function (a, b) {
    return this.text(this.text() == b ? a : b);
  },

  /**
   * Remove element classes with wildcard matching. Optionally add classes:
   *   $( '#foo' ).alterClass( 'foo-* bar-*', 'foobar' )
   *
   */
  alterClass: function (removals, additions) {
    var self = this;

    if (removals.indexOf("*") === -1) {
      // Use native jQuery methods if there is no wildcard matching
      self.removeClass(removals);
      return !additions ? self : self.addClass(additions);
    }

    var patt = new RegExp(
      "\\s" +
        removals.replace(/\*/g, "[A-Za-z0-9-_]+").split(" ").join("\\s|\\s") +
        "\\s",
      "g"
    );

    self.each(function (i, it) {
      var cn = " " + it.className + " ";
      while (patt.test(cn)) {
        cn = cn.replace(patt, " ");
      }
      it.className = $.trim(cn);
    });

    return !additions ? self : self.addClass(additions);
  },
});

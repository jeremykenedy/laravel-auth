import axios from "axios";
import Echo from "laravel-echo";
import Pusher from "pusher-js";
import * as Popper from "@popperjs/core";
import loadash from "lodash";

window._ = loadash;
window.Popper = Popper;
window.axios = axios;
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
window.axios.defaults.withCredentials = true;
// window.Vue = require("vue");
window.Pusher = Pusher;

// const password = require("password-strength-meter");
const token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
  window.axios.defaults.headers.common["X-CSRF-TOKEN"] = token.content;
} else {
  console.error(
    "CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token"
  );
}

try {
  // var $ = require('jquery');
  // window.$ = window.jQuery = require("jquery");
  // require("hideshowpassword");
  // require('password-strength-meter');
} catch (e) {}

/*eslint-disable */
window.Echo = new Echo({
  broadcaster: "pusher",
  key: import.meta.env.VITE_PUSHER_APP_KEY,
  cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? "mt1",
  wsHost: import.meta.env.VITE_PUSHER_HOST
    ? import.meta.env.VITE_PUSHER_HOST
    : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
  wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
  wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
  forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? "https") === "https",
  enabledTransports: ["ws", "wss"],
});
/*eslint-enable */

$.fn.extend({
  toggleText(a, b) {
    return this.text(this.text() == b ? a : b);
  },

  /**
   * Remove element classes with wildcard matching. Optionally add classes:
   *   $( '#foo' ).alterClass( 'foo-* bar-*', 'foobar' )
   *
   */
  alterClass(removals, additions) {
    const self = this;

    if (removals.indexOf("*") === -1) {
      // Use native jQuery methods if there is no wildcard matching
      self.removeClass(removals);
      return !additions ? self : self.addClass(additions);
    }

    const patt = new RegExp(
      `\\s${removals
        .replace(/\*/g, "[A-Za-z0-9-_]+")
        .split(" ")
        .join("\\s|\\s")}\\s`,
      "g"
    );

    self.each((i, it) => {
      let cn = ` ${it.className} `;
      while (patt.test(cn)) {
        cn = cn.replace(patt, " ");
      }
      it.className = $.trim(cn);
    });

    return !additions ? self : self.addClass(additions);
  },
});

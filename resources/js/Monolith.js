// Import modules...
import Vue from "vue";
import {
  App as InertiaApp,
  plugin as InertiaPlugin
} from "@inertiajs/inertia-vue";
import { InertiaProgress } from "@inertiajs/progress";
import PortalVue from "portal-vue";
import VueTailwind from "vue-tailwind";
import { TButton, TInput } from "vue-tailwind/dist/components";
import { __ } from "matice";

const settings = {
  "t-input": {
    component: TInput
  },
  "t-button": {
    component: TButton
  }
};
Vue.use(VueTailwind, settings);

Vue.mixin({ methods: { route } });
Vue.mixin({ methods: { $t: __ } });
Vue.use(InertiaPlugin);
Vue.use(PortalVue);

InertiaProgress.init({ color: "#4B5563" });

export default class Monolith {
  constructor(config) {
    this.bus = new Vue();
    this.bootingCallbacks = [];
    this.config = config;
  }

  /**
   * Register a callback to be called before Monolith starts. This is used to bootstrap
   * addons, tools, custom fields, or anything else Monolith needs
   */
  booting(callback) {
    this.bootingCallbacks.push(callback);
  }

  /**
   * Execute all of the booting callbacks.
   */
  boot() {
    this.bootingCallbacks.forEach(callback => callback(Vue, router, store));
    this.bootingCallbacks = [];
  }

  /**
   * Register the built-in Vuex modules for each resource
   */
  registerStoreModules() {
    this.config.resources.forEach(resource => {
      store.registerModule(resource.uriKey, resources);
    });
  }

  /**
   * Start the Monolith app by calling each of the tool's callbacks and then creating
   * the underlying Vue instance.
   */
  starter() {
    let _this = this;

    this.boot();
    //this.registerStoreModules();

    const el = document.getElementById("app");

    this.app = new Vue({
      render: h =>
        h(InertiaApp, {
          props: {
            initialPage: JSON.parse(app.dataset.page),
            resolveComponent: name => require(`./Pages/${name}`).default
          }
        })
    }).$mount(el);
  }

  /**
   * Return an axios instance configured to make requests to Monolith's API
   * and handle certain response codes.
   */
  request(options) {
    if (options !== undefined) {
      return axios(options);
    }

    return axios;
  }

  /**
   * Format a number using numbro.js for consistent number formatting.
   */
  // formatNumber(number, format) {
  //   const num = numbro(number);
  //
  //   if (format !== undefined) {
  //     return num.format(format);
  //   }
  //
  //   return num.format();
  // }

  /**
   * Register a listener on Monolith's built-in event bus
   */
  $on(...args) {
    this.bus.$on(...args);
  }

  /**
   * Register a one-time listener on the event bus
   */
  $once(...args) {
    this.bus.$once(...args);
  }

  /**
   * Unregister an listener on the event bus
   */
  $off(...args) {
    this.bus.$off(...args);
  }

  /**
   * Emit an event on the event bus
   */
  $emit(...args) {
    this.bus.$emit(...args);
  }

  /**
   * Determine if Monolith is missing the requested resource with the given uri key
   */
  // missingResource(uriKey) {
  //   return _.find(this.config.resources, r => r.uriKey == uriKey) == undefined;
  // }

  /**
   * Show an error message to the user.
   *
   * @param {string} message
   */
  // error(message) {
  //   Vue.toasted.show(message, { type: "error" });
  // }

  /**
   * Show a success message to the user.
   *
   * @param {string} message
   */
  // success(message) {
  //   Vue.toasted.show(message, { type: "success" });
  // }

  /**
   * Show a warning message to the user.
   *
   * @param {string} message
   */
  // warning(message) {
  //   Vue.toasted.show(message, { type: "warning" });
  // }

  /**
   * Register a keyboard shortcut.
   */
  // addShortcut(keys, callback) {
  //   Mousetrap.bind(keys, callback);
  // }

  /**
   * Unbind a keyboard shortcut.
   */
  // removeShortcut(keys) {
  //   Mousetrap.unbind(keys);
  // }
}

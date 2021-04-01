require('./bootstrap');

// Import modules...
import Vue from 'vue';
import {App as InertiaApp, plugin as InertiaPlugin} from '@inertiajs/inertia-vue';
import {InertiaProgress} from '@inertiajs/progress';
import PortalVue from 'portal-vue';
import VueTailwind from 'vue-tailwind';
import {TButton, TInput,} from 'vue-tailwind/dist/components';
import { __ } from "matice";

const settings = {
  't-input': {
    component: TInput,
  },
  't-button': {
    component: TButton,
  },
};
Vue.use(VueTailwind, settings);

Vue.mixin({methods: {route}});
Vue.mixin({ methods: { $t: __ } });
Vue.use(InertiaPlugin);
Vue.use(PortalVue);

const app = document.getElementById('app');

new Vue({
  render: (h) =>
    h(InertiaApp, {
      props: {
        initialPage: JSON.parse(app.dataset.page),
        resolveComponent: name => {
          return import(`./Pages/${name}`).then(module => module.default)
        },
      }
    }),
}).$mount(app);

InertiaProgress.init({color: '#4B5563'});

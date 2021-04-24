<template>
  <div :class="{ 'mobile-menu': open }" ref="layout">
    <jet-banner/>

    <div class="min-h-screen bg-gray-100">
      <!-- LayoutTopBar -->
      <div class="LayoutTopBar">
        <TopBar @click="mobileMenuHandler(true)"/>
      </div>

      <!-- LayoutSideBar -->
      <div class="LayoutSideBar">
        <div class="LayoutLogo flex flex-wrap justify-between md:justify items-center px-4">
          <inertia-link
            class="flex justify-center items-center"
            :href="route('dashboard')"
          >
            <jet-application-mark class="block h-9 w-auto"/>
            <span class="ml-4 text-2xl font-bold">Monolith</span>
          </inertia-link>

          <div class="ml-2 md:hidden">
            <button type="button" class="px-1" @click="mobileMenuHandler(false)">
              <v-icon name="ri-close-line"/>
            </button>
          </div>
        </div>
        <div class="LayoutSidebarContent">
          <!-- Navigation Links -->
          <div class="space-x-8">
            <Navigation :menu="mainMenu"/>
          </div>
        </div>
      </div>
      <!-- LayoutContent -->
      <main class="LayoutContent md:flex-1">
        <slot></slot>
      </main>

      <!-- Modal Portal -->
      <portal-target multiple name="modal"/>
      <!-- Mobile menu backdrop -->
      <div class="backdrop" @click="mobileMenuHandler(false)"></div>
    </div>
  </div>
</template>

<script>
import TopBar from "@/Layouts/Components/TopBar";
import JetBanner from "@/Jetstream/Banner";
import JetApplicationMark from "@/Jetstream/ApplicationMark";
import Navigation from "@/Layouts/Components/Navigation/Navigation.vue";

export default {
  components: {
    TopBar,
    JetBanner,
    JetApplicationMark,
    Navigation
  },
  data() {
    return {
      open: false,
    }
  },
  computed: {
    mainMenu() {
      const {menus} = this.$page.props;
      return menus && menus.main ? menus.main : [];
    }
  },
  methods: {
    mobileMenuHandler(bool) {
      this.open = bool;
    }
  }
};
</script>

<style scoped>
.LayoutContent {
  padding: 4rem 2rem 0;
  /*margin-left: 16rem;*/
  transition: margin-left 300ms ease-in-out;
}

.LayoutSideBar {
  display: table-cell;
  height: 100%;
  overflow: hidden;
  position: fixed;
  top: 0;
  z-index: 15;
  width: 260px;
  background-color: #ffffff;
  transform: translateX(-100%);
  box-shadow: 0 0 21px 0 rgba(89, 102, 122, 0.1);
  transition: transform 300ms ease-in-out;
}

.LayoutSidebarContent {
}

.LayoutLogo {
  height: 4rem;
  box-shadow: -9px 0 20px rgba(89, 102, 122, 0.1);
}

.LayoutTopBar {
  position: fixed;
  /*width: calc(100% - 16rem);*/
  width: 100%;
  z-index: 12;
  right: 0;
  transition: width 300ms ease-in-out;
}

@media screen and (min-width: 768px) {
  .LayoutSideBar {
    transform: translateX(0);
  }

  .LayoutContent {
    margin-left: 16rem;
  }

  .LayoutTopBar {
    width: calc(100% - 16rem);
  }
}

.backdrop {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 0;
  background-color: transparent;
  z-index: 1000;
  transition: background-color 300ms ease-in-out;
}

.mobile-menu .LayoutSideBar {
  transform: translateX(0);
  z-index: 1010;
}

.mobile-menu .backdrop {
  height: 100%;
  background-color: rgba(0, 0, 0, 0.2);
}
</style>

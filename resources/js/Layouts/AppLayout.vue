<template>
  <div>
    <jet-banner />

    <div class="min-h-screen bg-gray-100">
      <!-- LayoutTopBar -->
      <div class="LayoutTopBar">
        <TopBar />
      </div>

      <!-- LayoutSideBar -->
      <div class="LayoutSideBar">
        <div class="LayoutLogo flex flex-wrap justify-center items-center">
          <inertia-link
            class="flex justify-center items-center"
            :href="route('dashboard')"
          >
            <jet-application-mark class="block h-9 w-auto" />
            <span class="ml-4 text-2xl font-bold">Monolith</span>
          </inertia-link>
        </div>
        <div class="LayoutSidebarContent">
          <!-- Navigation Links -->
          <div class="hidden space-x-8 sm:flex">
            <ul class="w-full">
              <li v-for="(menu, index) in mainMenus" :key="index">
                <template v-if="route().has(menu.nickname)">
                  <jet-nav-link
                    class="px-6 py-4"
                    :active="route().current(menu.nickname)"
                    :href="route(menu.nickname)"
                    v-text="$t(menu.title)"
                  />
                </template>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- LayoutContent -->
      <main class="LayoutContent md:flex-1">
        <slot></slot>
      </main>

      <!-- Modal Portal -->
      <portal-target multiple name="modal" />
    </div>
  </div>
</template>

<script>
import TopBar from "@/Layouts/Components/TopBar";
import JetBanner from "@/Jetstream/Banner";
import JetApplicationMark from "@/Jetstream/ApplicationMark";
import JetNavLink from "@/Jetstream/NavLink";

export default {
  components: {
    TopBar,
    JetNavLink,
    JetBanner,
    JetApplicationMark
  },
  computed: {
    mainMenus() {
      const { menus } = this.$page.props;
      return (menus && menus.main) ? menus.main : [];
    }
  }
};
</script>

<style scoped>
.LayoutContent {
  padding: 4rem 2rem 0;
  margin-left: 16rem;
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
  transform: translateZ(0);
  box-shadow: 0 0 21px 0 rgba(89, 102, 122, 0.1);
}
.LayoutSidebarContent {
}
.LayoutLogo {
  height: 4rem;
  box-shadow: -9px 0 20px rgba(89, 102, 122, 0.1);
}
.LayoutTopBar {
  position: fixed;
  width: calc(100% - 16rem);
  z-index: 12;
  right: 0;
}
</style>

<template>
  <div>
    <template v-if="item.submenu && item.submenu.length">
      <button
        type="button"
        class="w-full flex items-center justify-between px-6 py-4 focus-within:outline-none font-bold leading-none text-gray-500 transition duration-150 ease-in-out"
        @click="open = !open"
      >
        <span class="flex items-center mr-2">
          <v-icon class="mr-2" v-if="item.meta.icon" :name="item.meta.icon"/>
          <span>{{ $t(item.title) }}</span>
        </span>
        <v-icon v-if="open" name="ri-arrow-down-s-line"/>
        <v-icon v-else name="ri-arrow-right-s-line"/>
      </button>
    </template>

    <template v-else>
      <jet-nav-link
        class="px-6 py-4"
        :active="route().current(item.nickname)"
        :href="route(item.nickname)"
      >
        <v-icon class="mr-2" v-if="item.meta.icon" :name="item.meta.icon"/>
        <span>{{ $t(item.title) }}</span>
      </jet-nav-link>
    </template>

    <!-- Sidebar submenu -->
    <ul class="w-full" v-show="open">
      <li v-for="subItem in item.submenu" class="px-6">
        <jet-nav-link
          class="SubMenuItem p-4"
          :active="route().current(item.nickname)"
          :href="route(subItem.nickname)"
          v-text="$t(subItem.title)"
        />
      </li>
    </ul>
    <!-- \ Sidebar submenu -->
  </div>
</template>

<script>
import JetNavLink from "@/Jetstream/NavLink";

export default {
  name: "NavigationItem",
  components: {
    JetNavLink
  },
  props: {
    item: {
      type: Object,
      default: () => ({
        title: "",
        nickname: "",
        submenu: []
      }),
    }
  },
  data() {
    return {
      open: false
    }
  }
}
</script>

<style scoped>

.SubMenuItem {
  position: relative;
  padding-left: 1.5rem;
}

.SubMenuItem:after {
  position: absolute;
  content: "";
  top: 50%;
  left: 0.5rem;
  width: 0.5rem;
  border-top: 2px solid #595c60;
  transform: translateY(-50%);
}
</style>

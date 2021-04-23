<template>
  <ul v-if="menu.length" class="w-full">
    <template v-for="(item, index) in menu">
      <li v-if="route().has(item.nickname)" :key="index">
        <NavigationItem :item="item" />
      </li>
    </template>
  </ul>
  <!-- Empty state -->
  <div v-else class="p-4">No main menu</div>
</template>

<script>
import NavigationItem from "./NavigationItem";

export default {
  name: "Navigation",
  components: {
    NavigationItem
  },
  props: {
    menu: {
      type: Array,
      default: () => ([]),
    }
  }
}
</script>

<style scoped>

</style>

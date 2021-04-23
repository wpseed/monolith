<template>
  <inertia-link :href="href" :class="classes">
    <slot></slot>
  </inertia-link>
</template>

<script>
export default {
  props: ["href", "active"],

  computed: {
    classes() {
      return this.active
        ? "flex items-center font-bold leading-none text-gray-900 focus:outline-none transition duration-150 ease-in-out"
        : "flex items-center font-bold leading-none text-gray-500 focus:outline-none transition duration-150 ease-in-out";
    }
  }
};
</script>

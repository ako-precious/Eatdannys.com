<script setup>
import { Head, Link } from "@inertiajs/vue3";
</script>
<template>
  <div>
    <a
      class="text-blueGray-500 py-1 px-3"
      href="#pablo"
      ref="btnDropdownRef"
      v-on:click="toggleDropdown($event)"
    > <font-awesome-icon icon="fa-solid fa-ellipsis-vertical" class="text-lg" />
  </a>
    <div
      ref="popoverDropdownRef"
      class="bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48 font-black"
      v-bind:class="{
        hidden: !dropdownPopoverShow,
        block: dropdownPopoverShow,
      }"
    >
      <Link
        href=""
        class="text-sm py-2 px-4 font-bold block w-full whitespace-nowrap bg-transparent text-polynesian "
      >
        Show
    </Link>
      <Link
        href="javascript:void(0);"
        class="text-sm py-2 px-4 font-bold block w-full whitespace-nowrap bg-transparent text-persian"
      >
        Edit
    </Link>
      <Link
        href="javascript:void(0);"
        class="text-sm py-2 px-4 font-bold block w-full whitespace-nowrap bg-transparent text-lighred"
      >
        Delete
    </Link>
    </div>
  </div>
</template>
<script>
import { createPopper } from "@popperjs/core";

export default {
  data() {
    return {
      dropdownPopoverShow: false,
    };
  },
  methods: {
    toggleDropdown: function (event) {
      event.preventDefault();
      if (this.dropdownPopoverShow) {
        this.dropdownPopoverShow = false;
      } else {
        this.dropdownPopoverShow = true;
        createPopper(this.$refs.btnDropdownRef, this.$refs.popoverDropdownRef, {
          placement: "bottom-start",
        });
      }
    },
  },
};
</script>

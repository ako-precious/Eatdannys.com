<script setup>
import { Head, Link } from "@inertiajs/vue3";
</script>
<template>
  <div>
    <a
      href="#"
      ref="btnDropdownRef"
      @click="toggleDropdown"
      class="text-blueGray-500 py-1 px-3"
    >
      <font-awesome-icon icon="fa-solid fa-ellipsis-vertical" class="text-lg" />
    </a>

    <div
      ref="popoverDropdownRef"
      class="bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48 font-black"
      :class="{ hidden: !dropdownPopoverShow, block: dropdownPopoverShow }"
    >
      <Link
        :href="`/meals/${meal.id}`"
        class="text-sm py-2 px-4 font-bold block w-full whitespace-nowrap bg-transparent cursor-pointer text-polynesian"
      >
        Show
      </Link>
      <Link
        :href="`/meals/${meal.id}/edit`"
        class="text-sm py-2 px-4 font-bold block w-full whitespace-nowrap bg-transparent cursor-pointer text-persian"
      >
        Edit
      </Link>
      <a
        href="#"
        @click.prevent="deleteMeal"
        class="text-sm py-2 px-4 font-bold block w-full whitespace-nowrap bg-transparent cursor-pointer text-lighred"
      >
        Delete
      </a>
    </div>
  </div>
</template>

<script>
import { createPopper } from "@popperjs/core";

export default {
  props: {
    meal: Object,
  },
  data() {
    return {
      dropdownPopoverShow: false,
    };
  },
  methods: {
    toggleDropdown(event) {
      event.preventDefault();
      this.dropdownPopoverShow = !this.dropdownPopoverShow;
      if (this.dropdownPopoverShow) {
        createPopper(
          this.$refs.btnDropdownRef,
          this.$refs.popoverDropdownRef,
          {
            placement: "bottom-start",
          }
        );
      }
    },
    deleteMeal() {
      if (confirm("Are you sure you want to delete this meal?")) {
        this.$inertia.delete(`/meals/${this.meal.id}`);
      }
    },
  },
};
</script>

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
        :href="`/reservations/${reservation.id}`"
        class="text-sm py-2 px-4 font-bold block w-full whitespace-nowrap bg-transparent cursor-pointer text-polynesian"
      >
        Show
      </Link>
      <Link
        :href="`/reservations/${reservation.id}/edit`"
        class="text-sm py-2 px-4 font-bold block w-full whitespace-nowrap bg-transparent cursor-pointer text-persian"
      >
        Edit
      </Link>
      <a
        href="#"
        @click.prevent="deletereservation"
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
    reservation: Object,
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
    deletereservation() {
      if (confirm("Are you sure you want to delete this reservation?")) {
        this.$inertia.delete(`/reservations/${this.reservation.id}`);
      }
    },
  },
};
</script>

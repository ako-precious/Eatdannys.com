<template>
  <div v-if="user && user.role === 'admin'">
    <sidebar />
    <div class="relative md:ml-64 bg-blueGray-100">
      <admin-navbar />
      <header-stats />
      <div class="px-4 md:px-10 mx-auto w-full -m-24">
        <slot />
        <footer-admin />
      </div>
    </div>
  </div>
  <div v-else>
    <p class="text-center py-20 text-red-500 font-bold">
      Redirecting to your profile...
    </p>
  </div>
</template>

<script>
import AdminNavbar from "@/Components/Navbars/AdminNavbar.vue";
import Sidebar from "@/Components/Sidebar/Sidebar.vue";
import HeaderStats from "@/Components/Headers/HeaderStats.vue";
import FooterAdmin from "@/Components/Footers/FooterAdmin.vue";
import CardBarChart from "@/Components/Cards/CardBarChart.vue";
import { Inertia } from '@inertiajs/inertia';

export default {
  name: "admin-layout",
  components: {
    AdminNavbar,
    Sidebar,
    HeaderStats,
    FooterAdmin,
    CardBarChart,
  },
  
  props: {
    user: {
      type: Object,
      required: true
    }
  },
  
  // watch: {
  //   user: {
  //     immediate: true,
  //     handler(user) {
  //       if (user && user.role !== 'admin') {
  //         // Redirect to user profile
  //         Inertia.visit(`/user/${user.id}`);
  //       }
  //     }
  //   }
  // },
  
  // mounted() {
  //   if (this.user && this.user.role !== 'admin') {
  //     // Redirect to user profile
  //     Inertia.visit(`/user/${this.user.id}`);
  //   }
  // }
};
</script>
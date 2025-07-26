<template>
  <div v-if=" $page.props.auth.user.role == 'admin'">
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
     <div class="relative bg-blueGray-100">
      <admin-navbar />
      <user-tab />
      <div class="px-4 md:px-10 mx-auto w-full -m-24">
        <slot />
      <footer-admin /> {{ user && user.role }}
      </div>
    </div>
  </div>
</template>

<script>
import AdminNavbar from "@/Components/Navbars/AdminNavbar.vue";
import Sidebar from "@/Components/Sidebar/Sidebar.vue";
import HeaderStats from "@/Components/Headers/HeaderStats.vue";
import UserTab from "@/Components/Headers/UserTab.vue";
import FooterAdmin from "@/Components/Footers/FooterAdmin.vue";
import CardBarChart from "@/Components/Cards/CardBarChart.vue";
import { Inertia } from '@inertiajs/inertia';

export default {
  name: "admin-layout",
  components: {
    AdminNavbar,
    Sidebar,
    HeaderStats,
    UserTab,
    FooterAdmin,
    CardBarChart,
  },
  
  
  
  watch: {
    user: {
      immediate: true,
      handler(user) {
        if (user && user.role !== 'admin') {
          // Redirect to user profile
          Inertia.visit(`/oders}`);
        }
      }
    }
  },
  
  mounted() {
    if (this.user && this.user.role !== 'admin') {
      // Redirect to user profile
      Inertia.visit(`/orders`);
    }
  }
};
</script>
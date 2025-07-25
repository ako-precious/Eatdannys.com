<template>
  <AppLayout  title="Reservations"  v-if=" $page.props.auth.user.role === 'admin'">

    <div class="flex flex-wrap mt-4">
      <div class="w-full mb-12 px-4">
        <ReservationsTable />
      </div>
      
    </div>
  </AppLayout>
   <div v-else>
<NotFoundPage></NotFoundPage>
    </div>
</template>
<script>
import ReservationsTable from "./ReservationsTable.vue";
// import AppLayout from "../../Layouts/Applayout.vue";

import NotFoundPage from "@/Pages/NotFoundPage.vue"
import AppLayout from "@/Layouts/AppLayout.vue";
export default {
   
  components: {
    ReservationsTable,
    AppLayout,
    NotFoundPage
  },

  
};
</script>

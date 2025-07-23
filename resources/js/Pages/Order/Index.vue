<template>

  <AppLayout  v-if=" $page.props.auth.user.role === 'admin'" title="Order">

    <div class="flex flex-wrap mt-4">
      <div class="w-full mb-12 px-4">
        <order-table />
      </div>
      
    </div>
  </AppLayout>

   <div v-else class="flex flex-wrap mt-4">
      <div class="w-full mb-12 px-4">
        <order-table />
      </div>
      
    </div>
</template>
<script>
import OrderTable from "./OrdersTable.vue";
// import AppLayout from "../../Layouts/Applayout.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
export default {
   
  components: {
    OrderTable,
    AppLayout,
  },
};
</script>

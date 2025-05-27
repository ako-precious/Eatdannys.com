<template>
  <AppLayout  title="Order">

    <div class="flex flex-wrap mt-4">
      <div class="w-full mb-12 px-4">
        <order-table />
      </div>
      
    </div>
  </AppLayout>
</template>
<script>
import OrderTable from "./OrdersTable.vue";
import AppLayout from "../Applayout.vue";
// import AppLayout from "@/Layouts/AppLayout.vue";
export default {
   
  components: {
    OrderTable,
    AppLayout,
  },
};
</script>

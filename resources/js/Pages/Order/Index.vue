<template>
  <AppLayout  title="Order">

    <div class="flex flex-wrap mt-4">
      <div class="w-full mb-12 px-4">
        <card-table :orders="orders" />
      </div>
      
    </div>
  </AppLayout>
</template>
<script>
import CardTable from "./OrdersTable.vue";
import AppLayout from "../Applayout.vue";
// import AppLayout from "@/Layouts/AppLayout.vue";
export default {
   props: {
        orders: Object,
    },
  components: {
    CardTable,
    AppLayout,
  },
};
</script>

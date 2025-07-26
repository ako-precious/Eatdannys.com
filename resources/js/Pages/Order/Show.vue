<template>
  
  <AppLayout  title="Order">

    <div class="flex flex-wrap mt-4">
      <div class="w-full mb-12 px-4">
        <ShowCard :order="order"></ShowCard> 
      </div>
      
    </div>
  </AppLayout>
</template>
<script>
import OrderTable from "./OrdersTable.vue";
import ShowCard from "./ShowCard.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
export default {
   
  components: {
    OrderTable,
    AppLayout,
    ShowCard,
  },

    props: {

    user: {
      type: Object,
      required: true
    },
    order: {
      type: Object,
      required: true
    }
  },
};
</script>

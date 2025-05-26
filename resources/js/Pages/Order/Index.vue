<template>
  <AppLayout>

    <div class="flex flex-wrap mt-4">
      <div class="w-full mb-12 px-4">
        <card-table />
      </div>
      
    </div>
  </AppLayout>
</template>
<script>
import CardTable from "@/Components/Cards/CardTable.vue";
import AppLayout from "../Applayout.vue";
// import AppLayout from "@/Layouts/AppLayout.vue";
export default {
  components: {
    CardTable,
  },
};
</script>

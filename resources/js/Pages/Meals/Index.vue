<template>
  <AppLayout  title="Meals">

    <div class="flex flex-wrap mt-4">
      <div class="w-full mb-12 px-4">
        <meals-table />
      </div>
      
    </div>
  </AppLayout>
</template>
<script>
import MealsTable from "./MealsTable.vue";
// import AppLayout from "../../Layouts/Applayout.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
export default {
   
  components: {
    MealsTable,
    AppLayout,
  },
};
</script>

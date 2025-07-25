<template>
  <AppLayout  title="Meals"  v-if=" $page.props.auth.user.role === 'admin'">

    <div class="flex flex-wrap mt-4">
      <div class="w-full mb-12 px-4">
        <meals-table />
      </div>
      
    </div>
  </AppLayout>
   <div v-else>
<NotFoundPage></NotFoundPage>
    </div>
</template>
<script>
import MealsTable from "./MealsTable.vue";
// import AppLayout from "../../Layouts/Applayout.vue";

import NotFoundPage from "@/Pages/NotFoundPage.vue"
import AppLayout from "@/Layouts/AppLayout.vue";
export default {
   
  components: {
    MealsTable,
    AppLayout,
    NotFoundPage
  },

  
};
</script>

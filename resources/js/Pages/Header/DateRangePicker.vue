<template>
  <form @submit.prevent="submitFilterForm">
    <div class="flex items-center justify-center py-5 w-full lg:p-0  text-oynx dark:text-snow">
       
        <div class="relative pr-3 ">
            <input 
                placeholder="Search for food"
                class=" -shadow-snow-sm  dark:-shadow-oynx-sm focus:shadow-snow-inner focus:dark:shadow-oynx-inner bg-transparent border-none sm:w-[15rem] md:w-[20rem] lg:w-[25rem]  2xl:max-w-2xl text-oynx dark:text-white  rounded-full py-3 px-5 outline-none   dark:border-snow focus:border-polynesian dark:focus:border-lighred focus:ring-polynesian dark:focus:ring-lighred transition-all ease-in duration-250 delay-75"
                v-model="searchText"
                
                type="text"/>
        </div>

          <button class="button bg-gradient-to-br from-[#e3dedf] to-[#ffffff] -shadow-snow-sm hover:shadow-snow-sm dark:bg-gradient-to-br dark:from-[#2b312e] dark:to-[#333a37]  dark:-shadow-oynx-sm hover:dark:shadow-oynx-sm text-lg hover:text-polynesian hover:dark:text-lighred">
            <font-awesome-icon :icon="['fas', 'search']" class="svgIcon "/>
          </button>
    </div></form>
</template>

<script>
export default {
  data() {
    return {
      searchText: "",
    };
  },
  methods: {
    submitFilterForm() {
      this.$emit("filter-meals", this.searchText);
    },
  },
};
</script>

<style scoped>
/* Add Tailwind CSS styles here or in your global styles */


.button {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  border: none;
  font-weight: 600;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition-duration: 0.3s;
  overflow: hidden;
  position: relative;
}

.svgIcon {
  width: 12px;
  transition-duration: 0.3s;
}


.button:hover {
  width: 110px;
  border-radius: 50px;
  transition-duration: 0.3s;

  background-color: rgb(181, 160, 255);
  align-items: center;
}

.button:hover .svgIcon {
  /* width: 20px; */
  transition-duration: 0.3s;
  transform: translateX(320%);
}

.button::before {
  position: absolute;
  bottom: -20px;
  content: "Search";
  /* transition-duration: .3s; */
  font-size: 0px;
}

.button:hover::before {
  font-size: 13px;
  opacity: 1;
  bottom: unset;
  /* transform: translateY(-30px); */
  transition-duration: 0.3s;
}

</style>

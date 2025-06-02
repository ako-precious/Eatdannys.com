
<script setup>
import Pagination from "./Pagination.vue";
import Search from "@/Components/Search.vue";
import { ref, onMounted, computed } from "vue";
import axios from "axios";

const meals = ref([]);
const perPage = ref(10);
const pagination = ref({
  current_page: 1,
  per_page: 10,
  total: 0,
  from: 1,
  to: 10,
  last_page: 1,
  next_page_url: null,
  prev_page_url: null
});


const searchTerm = ref("");

const handleSearch = (term) => {
  searchTerm.value = term;
  getmeals(1); // Reset to page 1 when searching
};

// const getmeals = async (page = 1) => {
//   const response = await axios.get(`/api/meal`, {
//     params: {
//       page,
//       per_page: perPage.value,
//       search: searchTerm.value,
//     },
//   });

//   meals.value = response.data.meals.data;
//   pagination.value = {
//     current_page: response.data.meals.current_page,
//     per_page: response.data.meals.per_page,
//     total: response.data.meals.total,
//     from: response.data.meals.from,
//     to: response.data.meals.to,
//     last_page: response.data.meals.last_page,
//     next_page_url: response.data.meals.next_page_url,
//     prev_page_url: response.data.meals.prev_page_url,
//   };
// };

// const changePerPage = (event) => {
//   perPage.value = event.target.value;
//   getmeals(1);
// };

// const getPageRange = computed(() => {
//   const current = pagination.value.current_page;
//   const last = pagination.value.last_page;
//   const delta = 2;
//   const range = [];
  
//   if (last <= 1) return [1];
  
//   range.push(1);
  
//   if (last <= 7) {
//     for (let i = 2; i <= last - 1; i++) {
//       range.push(i);
//     }
//   } else {
//     let left = Math.max(2, current - delta);
//     let right = Math.min(last - 1, current + delta);
    
//     if (current - 1 <= delta) {
//       right = Math.min(5, last - 1);
//     }
//     if (last - current <= delta) {
//       left = Math.max(2, last - 4);
//     }
    
//     if (left > 2) range.push("...");
    
//     for (let i = left; i <= right; i++) {
//       range.push(i);
//     }
    
//     if (right < last - 1) range.push("...");
//   }
  
//   if (last > 1) range.push(last);
  
//   return range;
// });

const getmeals = async (page = 1) => {
  const response = await axios.get(`/api/meal?page=${page}&per_page=${perPage.value}`);
  meals.value = response.data.meals.data;
  
  pagination.value = {
    current_page: response.data.meals.current_page,
    per_page: response.data.meals.per_page,
    total: response.data.meals.total,
    from: response.data.meals.from,
    to: response.data.meals.to,
    last_page: response.data.meals.last_page,
    next_page_url: response.data.meals.next_page_url,
    prev_page_url: response.data.meals.prev_page_url,
  };
};

onMounted(() => {
  getmeals();
});
</script>
<template>
    <div
        class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded"
        :class="[color === 'light' ? 'bg-white' : 'bg-emerald-900 text-white']"
    >
        <div class="rounded-t mb-0 px-4 py-3 border-0">
            <div class="flex flex-wrap items-center justify-center">
                <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                    <h3 class="font-bold text-lg md:text-2xl text-oynx_alt">
                        Meals Tables
                    </h3>


                </div>
                <div class=" w-full md:w-[50%]">
                     <Search
            @search="handleSearch"
            class="flex my-6 sticky top-0 transition-all duration-300 delay-75 ease-in animate-fade-in w-[80%]"
        ></Search>
                </div>
            </div>
        </div>
        <div class="block w-full overflow-x-auto">
            <!-- Projects table -->
            <table class="items-center w-full bg-transparent border-collapse">
                <thead class="bg-snow/50">
                    <tr>
                        <th
                            class="px-6 align-middle border border-solid py-3 text-sm uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left text-oynx/75"
                        >
                            Name
                        </th>
                        <th
                            class="px-6 align-middle border border-solid py-3 text-sm uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left text-oynx/75"
                        >
                            Categories
                        </th>

                        <!-- <th
                            class="px-6 align-middle border border-solid py-3 text-sm uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left text-oynx/75"
                        >
                            Description
                        </th> -->
                        <th
                            class="px-6 align-middle border border-solid py-3 text-sm uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left text-oynx/75"
                        >
                            Price
                        </th>

                        <th
                            class="px-6 align-middle border border-solid py-3 text-sm uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left text-oynx/75"
                        ></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="meal in meals" :key="meal.id">
                        <th
                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4 text-left  items-center"
                        >
                            <span>
                                {{ meal.name }}
                            </span>
                        </th>
                        <td
                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4"
                        >
                            {{ meal.category.name }}
                        </td>
                        <!-- <td
                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4"
                        >
                            {{ meal.description }}
                        </td> -->
                        <td
                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
                        >
                            <div
                            class="grid grid-cols-4 gap-2 w-full  cursor-pointer"
                        >
                            <div
                                v-for="(price, index) in meal.prices"
                                :key="index"
                            >
                                <input
                                    class="hidden"
                                    :id="`radio_${meal.id}_${index}`"
                                    type="radio"
                                    :name="`option_${meal.id}`"
                                    :value="price"
                                />
                                <label
                                    class="flex flex-col p-1 border-1 border-oynx/30"
                                   
                                >
                                    <span
                                        class="text-[0.68rem] font- uppercase"
                                    >
                                        {{ price.size ?? price.quantity }}
                                    </span>
                                    <span class="text-[0.8rem] font-bold">
                                        ${{ price.price }}
                                    </span>
                                </label>
                            </div>
                        </div>

                        </td>
                        <td
                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4 text-right"
                        >
                            <table-dropdown />
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <Pagination
  :getorders="getorders"
  @page-changed="getmeals"
/>

    </div>
</template>
<script>
import TableDropdown from "./TableDropdown.vue";

import { router } from "@inertiajs/vue3";

export default {
    methods: {
        goTo(url) {
            router.visit(url, {
                preserveScroll: true,
                preserveState: true,
            });
        },
    },
    data() {
        return {};
    },
    components: {
        TableDropdown,
    },
    props: {
        color: {
            default: "light",
            validator: function (value) {
                // The value must match one of these strings
                return ["light", "dark"].indexOf(value) !== -1;
            },
        },
    },
    // mounted() {
    //     axios
    //         .get("/api/get-order")
    //         .then((response) => {
    //             this.meals = response.data;
    //         })
    //         .catch((error) => {
    //             console.error("Failed to load menu:", error);
    //         });
    // },
};
</script>

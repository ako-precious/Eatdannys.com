<template>
  <div class="p-2 border-t dark:border-gray-700 w-full">
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
      <!-- Mobile View -->
      <div class="flex justify-between items-center flex-1 lg:hidden">
        <div class="w-10">
          <button 
            @click="getorders(pagination.current_page - 1)" 
            :disabled="!pagination.prev_page_url"
            title="Previous"
            type="button"
            class="flex items-center justify-center rounded-full relative outline-none hover:bg-gray-500/5 disabled:opacity-70 disabled:cursor-not-allowed disabled:pointer-events-none text-yellow-500 focus:bg-yellow-500/10 dark:hover:bg-gray-300/5 w-10 h-10"
            rel="prev"
          >
            <span class="sr-only"> Prev </span>
            <font-awesome-icon icon="fa-solid fa-chevron-left" />
          </button>
        </div>

        <!-- <div class="flex items-center gap-2 rtl:space-x-reverse">
          <select 
            @change="changePerPage" 
            :value="perPage"
            class="h-8 text-sm px-2 leading-none transition duration-75 border-gray-300 rounded-lg shadow-sm outline-none focus:border-yellow-500 focus:ring-1 focus:ring-inset focus:ring-yellow-500 dark:text-white dark:bg-gray-700 dark:border-gray-600 dark:focus:border-yellow-500"
          >
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="-1">All</option>
          </select>

          <span class="text-sm font-medium dark:text-white">
            per page
          </span>
        </div> -->

        <div class="w-10">
          <button 
            @click="getorders(pagination.current_page + 1)" 
            :disabled="!pagination.next_page_url"   
            title="Next"
            type="button"
            class="flex items-center justify-center rounded-full relative outline-none hover:bg-gray-500/5 disabled:opacity-70 disabled:cursor-not-allowed disabled:pointer-events-none text-yellow-500 focus:bg-yellow-500/10 dark:hover:bg-gray-300/5 w-10 h-10"
            rel="next"
          >
            <span class="sr-only"> Next </span>
            <font-awesome-icon icon="fa-solid fa-chevron-right" />
          </button>
        </div>
      </div>

      <!-- Desktop View -->
      <div class="hidden flex-1 items-center lg:grid grid-cols-3 px-8">
        <div class="flex items-center">
          <div class="pl-2 text-sm font-medium dark:text-white">
            Showing {{ pagination.from }} to {{ pagination.to }} of {{ pagination.total }} results
          </div>
        </div>

        <div class="flex items-center justify-center">
          <!-- <div class="flex items-center space-x-2 filament-tables-pagination-records-per-page-selector rtl:space-x-reverse">
            <label>
              <select 
                @change="changePerPage" 
                :value="perPage"
                class="h-8 text-sm pr-8 leading-none transition duration-75 border-gray-300 rounded-lg shadow-sm outline-none focus:border-yellow-500 focus:ring-1 focus:ring-inset focus:ring-yellow-500 dark:text-white dark:bg-gray-700 dark:border-gray-600 dark:focus:border-yellow-500"
              >
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="-1">All</option>
              </select>
              <span class="text-sm font-medium dark:text-white">per page</span>
            </label>
          </div> -->
        </div>

        <div class="flex items-center justify-end">
          <div class="py-3 border rounded-lg dark:border-gray-600">
            <ol class="flex items-center text-sm text-gray-500 divide-x rtl:divide-x-reverse divide-gray-300 dark:text-gray-400 dark:divide-gray-600">
              <li>
                <button 
                  @click="getorders(pagination.current_page - 1)" 
                  :disabled="!pagination.prev_page_url"
                  type="button"
                  class="relative flex items-center justify-center font-medium min-w-[2rem] px-1.5 h-8 -my-3 rounded-md outline-none hover:bg-gray-500/5 focus:bg-yellow-500/10 focus:ring-2 focus:ring-yellow-500 dark:hover:bg-gray-400/5 transition text-yellow-600"
                  aria-label="Previous"
                  rel="prev"
                >
                  <font-awesome-icon icon="fa-solid fa-chevron-left" />
                </button>
              </li>

              <li v-for="(page, index) in getPageRange" :key="index">
                <button
                  v-if="page === '...'"
                  disabled
                  class="cursor-not-allowed pointer-events-none opacity-70"
                >
                  <span>...</span>
                </button>

                <button
                  v-else
                  @click="getorders(page)"
                  :class="[
                    'relative flex items-center justify-center font-medium min-w-[2rem] px-1.5 h-8 -my-3 rounded-md outline-none transition',
                    page === pagination.current_page
                      ? 'text-yellow-600 bg-yellow-500/10 ring-2 ring-yellow-500'
                      : 'hover:bg-gray-500/5 focus:bg-yellow-500/10 focus:ring-2 focus:ring-yellow-500 dark:hover:bg-gray-400/5 focus:text-yellow-600'
                  ]"
                >
                  <span>{{ page }}</span>
                </button>
              </li>

              <li>
                <button 
                  @click="getorders(pagination.current_page + 1)" 
                  :disabled="!pagination.next_page_url"
                  type="button"
                  class="relative flex items-center justify-center font-medium min-w-[2rem] px-1.5 h-8 -my-3 rounded-md outline-none hover:bg-gray-500/5 focus:bg-yellow-500/10 focus:ring-2 focus:ring-yellow-500 dark:hover:bg-gray-400/5 transition text-yellow-600"
                  aria-label="Next"
                  rel="next"
                >
                  <font-awesome-icon icon="fa-solid fa-chevron-right" />
                </button>
              </li>
            </ol>
          </div>
        </div>
      </div>
    </nav>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from "vue";
import axios from "axios";

const orders = ref([]);
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

const changePerPage = (event) => {
  perPage.value = event.target.value;
  getorders(1);
};

const getPageRange = computed(() => {
  const current = pagination.value.current_page;
  const last = pagination.value.last_page;
  const delta = 2;
  const range = [];
  
  if (last <= 1) return [1];
  
  range.push(1);
  
  if (last <= 7) {
    for (let i = 2; i <= last - 1; i++) {
      range.push(i);
    }
  } else {
    let left = Math.max(2, current - delta);
    let right = Math.min(last - 1, current + delta);
    
    if (current - 1 <= delta) {
      right = Math.min(5, last - 1);
    }
    if (last - current <= delta) {
      left = Math.max(2, last - 4);
    }
    
    if (left > 2) range.push("...");
    
    for (let i = left; i <= right; i++) {
      range.push(i);
    }
    
    if (right < last - 1) range.push("...");
  }
  
  if (last > 1) range.push(last);
  
  return range;
});

const getorders = async (page = 1) => {
  const response = await axios.get(`/api/meal?page=${page}&per_page=${perPage.value}`);
  orders.value = response.data.orders.data;
  
  pagination.value = {
    current_page: response.data.orders.current_page,
    per_page: response.data.orders.per_page,
    total: response.data.orders.total,
    from: response.data.orders.from,
    to: response.data.orders.to,
    last_page: response.data.orders.last_page,
    next_page_url: response.data.orders.next_page_url,
    prev_page_url: response.data.orders.prev_page_url,
  };
};

onMounted(() => {
  getorders();
});
</script>
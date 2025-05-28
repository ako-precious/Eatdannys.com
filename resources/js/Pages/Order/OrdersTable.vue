<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";

const orders = ref([]);
const pagination = ref({});

const getOrders = async (page = 1) => {
    const response = await axios.get(`/api/get-orders?page=${page}`);
    orders.value = response.data.orders.data;
    pagination.value = {
        current_page: response.data.orders.current_page,
        last_page: response.data.orders.last_page,
        next_page_url: response.data.orders.next_page_url,
        prev_page_url: response.data.orders.prev_page_url,
    };
};

onMounted(() => {
    getOrders();
});
</script>
<template>
    <div
        class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded"
        :class="[color === 'light' ? 'bg-white' : 'bg-emerald-900 text-white']"
    >
        <div class="rounded-t mb-0 px-4 py-3 border-0">
            <div class="flex flex-wrap items-center">
                <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                    <h3 class="font-bold text-lg md:text-2xl text-oynx_alt">
                        Orders Tables
                    </h3>
                </div>
            </div>
        </div>
        <div class="block w-full overflow-x-auto">
            <!-- Projects table -->
            <table class="items-center w-full bg-transparent border-collapse">
                <thead class=" bg-snow/20">
                    <tr>
                        <th
                            class="px-6 align-middle border border-solid py-3 text-sm uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left text-oynx/75"
                        >
                            Session Id
                        </th>
                        <th
                            class="px-6 align-middle border border-solid py-3 text-sm uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left text-oynx/75"
                        >
                            Customer
                        </th>
                        <th
                            class="px-6 align-middle border border-solid py-3 text-sm uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left text-oynx/75"
                        >
                            Status
                        </th>
                        <th
                            class="px-6 align-middle border border-solid py-3 text-sm uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left text-oynx/75"
                        >
                            Order
                        </th>
                        <th
                            class="px-6 align-middle border border-solid py-3 text-sm uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left text-oynx/75"
                        >
                            Total Price
                        </th>

                        <th
                            class="px-6 align-middle border border-solid py-3 text-sm uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left text-oynx/75"
                        ></th>
                    </tr>
                </thead>
                <tbody>
                  
                    <tr v-for="order in orders" :key="order.id">
                        <th
                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left flex items-center"
                        >
                            <span>
                                {{ order.session_id }}
                            </span>
                        </th>
                        <td
                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
                        >
                            {{ order.user_id }}
                        </td>
                        <td
                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
                        >
                            {{ order.status }}
                        </td>
                        <td
                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
                        >
                            {{ order.menu }}
                        </td>
                        <td
                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
                        >
                            {{ order.total_price }}
                        </td>
                        <td
                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-right"
                        >
                            <table-dropdown />
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="p-2 border-t dark:border-gray-700 w-full">
            <nav
                role="navigation"
                aria-label="Pagination Navigation"
                class="flex items-center justify-between"
            >
                <div class="flex justify-between items-center flex-1 lg:hidden">
                    <div class="w-10">
                        <button @click="getOrders(pagination.current_page - 1)" :disabled="!pagination.prev_page_url"
                            title="Previous"
                            type="button"
                            class="flex items-center justify-center rounded-full relative outline-none hover:bg-gray-500/5 disabled:opacity-70 disabled:cursor-not-allowed disabled:pointer-events-none text-yellow-500 focus:bg-yellow-500/10 dark:hover:bg-gray-300/5 w-10 h-10"
                            rel="prev"
                        >
                            <span class="sr-only"> Prev </span>
                            <font-awesome-icon
                                icon="fa-solid fa-chevron-left"
                            />
                        </button>
                    </div>

                    <div class="flex items-center gap-2 rtl:space-x-reverse">
                        <select
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
                    </div>

                    <div class="w-10">
                        <button @click="getOrders(pagination.current_page + 1)" :disabled="!pagination.next_page_url"   
                            title="Next"
                            type="button"
                            class="flex items-center justify-center rounded-full relative outline-none hover:bg-gray-500/5 disabled:opacity-70 disabled:cursor-not-allowed disabled:pointer-events-none text-yellow-500 focus:bg-yellow-500/10 dark:hover:bg-gray-300/5 w-10 h-10"
                            rel="next"
                        >
                            <span class="sr-only"> Next </span>

                            <font-awesome-icon
                                icon="fa-solid fa-chevron-right"
                            />
                        </button>
                    </div>
                </div>

                <div class="hidden flex-1 items-center lg:grid grid-cols-3">
                    <div class="flex items-center">
                        <div class="pl-2 text-sm font-medium dark:text-white">
                            Showing 11 to 20 of 99 results
                        </div>
                    </div>

                    <div class="flex items-center justify-center">
                        <div
                            class="flex items-center space-x-2 filament-tables-pagination-records-per-page-selector rtl:space-x-reverse"
                        >
                            <label>
                                <select
                                    class="h-8 text-sm pr-8 leading-none transition duration-75 border-gray-300 rounded-lg shadow-sm outline-none focus:border-yellow-500 focus:ring-1 focus:ring-inset focus:ring-yellow-500 dark:text-white dark:bg-gray-700 dark:border-gray-600 dark:focus:border-yellow-500"
                                >
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="-1">All</option>
                                </select>

                                <span
                                    class="text-sm font-medium dark:text-white"
                                >
                                    per page
                                </span>
                            </label>
                        </div>
                    </div>

                    <div class="flex items-center justify-end">
                        <div
                            class="py-3 border rounded-lg dark:border-gray-600"
                        >
                            <ol
                                class="flex items-center text-sm text-gray-500 divide-x rtl:divide-x-reverse divide-gray-300 dark:text-gray-400 dark:divide-gray-600"
                            >
                                <li>
                                    <button @click="getOrders(pagination.current_page - 1)" :disabled="!pagination.prev_page_url"
                                        type="button"
                                        class="relative flex items-center justify-center font-medium min-w-[2rem] px-1.5 h-8 -my-3 rounded-md outline-none hover:bg-gray-500/5 focus:bg-yellow-500/10 focus:ring-2 focus:ring-yellow-500 dark:hover:bg-gray-400/5 transition text-yellow-600"
                                        aria-label="Previous"
                                        rel="prev"
                                    >
                                        <font-awesome-icon
                                            icon="fa-solid fa-chevron-left"
                                        />
                                    </button>
                                </li>

                                <li>
                                    <button
                                        type="button"
                                        class="relative flex items-center justify-center font-medium min-w-[2rem] px-1.5 h-8 -my-3 rounded-md outline-none hover:bg-gray-500/5 focus:bg-yellow-500/10 focus:ring-2 focus:ring-yellow-500 dark:hover:bg-gray-400/5 focus:text-yellow-600 transition"
                                    >
                                        <span>1</span>
                                    </button>
                                </li>
                                <li>
                                    <button
                                        type="button"
                                        class="relative flex items-center justify-center font-medium min-w-[2rem] px-1.5 h-8 -my-3 rounded-md outline-none transition text-yellow-600 filament-tables-pagination-item-active focus:underline bg-yellow-500/10 ring-2 ring-yellow-500"
                                    >
                                        <span>2</span>
                                    </button>
                                </li>
                                <li>
                                    <button
                                        type="button"
                                        class="relative flex items-center justify-center font-medium min-w-[2rem] px-1.5 h-8 -my-3 rounded-md outline-none hover:bg-gray-500/5 focus:bg-yellow-500/10 focus:ring-2 focus:ring-yellow-500 dark:hover:bg-gray-400/5 focus:text-yellow-600 transition"
                                    >
                                        <span>3</span>
                                    </button>
                                </li>
                                <li>
                                    <button
                                        type="button"
                                        class="relative flex items-center justify-center font-medium min-w-[2rem] px-1.5 h-8 -my-3 rounded-md outline-none hover:bg-gray-500/5 focus:bg-yellow-500/10 focus:ring-2 focus:ring-yellow-500 dark:hover:bg-gray-400/5 focus:text-yellow-600 transition"
                                    >
                                        <span>4</span>
                                    </button>
                                </li>
                                <li>
                                    <button
                                        type="button"
                                        class="relative flex items-center justify-center font-medium min-w-[2rem] px-1.5 h-8 -my-3 rounded-md outline-none hover:bg-gray-500/5 focus:bg-yellow-500/10 focus:ring-2 focus:ring-yellow-500 dark:hover:bg-gray-400/5 focus:text-yellow-600 transition"
                                    >
                                        <span>5</span>
                                    </button>
                                </li>
                                <li>
                                    <button
                                        type="button"
                                        class="relative flex items-center justify-center font-medium min-w-[2rem] px-1.5 h-8 -my-3 rounded-md outline-none hover:bg-gray-500/5 focus:bg-yellow-500/10 focus:ring-2 focus:ring-yellow-500 dark:hover:bg-gray-400/5 focus:text-yellow-600 transition"
                                    >
                                        <span>6</span>
                                    </button>
                                </li>
                                <li>
                                    <button
                                        disabled=""
                                        type="button"
                                        class="relative flex items-center justify-center font-medium min-w-[2rem] px-1.5 h-8 -my-3 rounded-md outline-none filament-tables-pagination-item-disabled cursor-not-allowed pointer-events-none opacity-70"
                                    >
                                        <span>...</span>
                                    </button>
                                </li>

                                <li>
                                    <button
                                        type="button"
                                        class="relative flex items-center justify-center font-medium min-w-[2rem] px-1.5 h-8 -my-3 rounded-md outline-none hover:bg-gray-500/5 focus:bg-yellow-500/10 focus:ring-2 focus:ring-yellow-500 dark:hover:bg-gray-400/5 focus:text-yellow-600 transition"
                                    >
                                        <span>9</span>
                                    </button>
                                </li>
                                <li>
                                    <button
                                        type="button"
                                        class="relative flex items-center justify-center font-medium min-w-[2rem] px-1.5 h-8 -my-3 rounded-md outline-none hover:bg-gray-500/5 focus:bg-yellow-500/10 focus:ring-2 focus:ring-yellow-500 dark:hover:bg-gray-400/5 focus:text-yellow-600 transition"
                                    >
                                        <span>10</span>
                                    </button>
                                </li>

                                <li>
                                    <button @click="getOrders(pagination.current_page + 1)" :disabled="!pagination.next_page_url"
   
                                        type="button"
                                        class="relative flex items-center justify-center font-medium min-w-[2rem] px-1.5 h-8 -my-3 rounded-md outline-none hover:bg-gray-500/5 focus:bg-yellow-500/10 focus:ring-2 focus:ring-yellow-500 dark:hover:bg-gray-400/5 transition text-yellow-600"
                                        aria-label="Next"
                                        rel="next"
                                    >
                                        <font-awesome-icon
                                            icon="fa-solid fa-chevron-right"
                                        />
                                    </button>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</template>
<script>
import TableDropdown from "@/Components/Dropdowns/TableDropdown.vue";

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
    //             this.orders = response.data;
    //         })
    //         .catch((error) => {
    //             console.error("Failed to load menu:", error);
    //         });
    // },
};
</script>

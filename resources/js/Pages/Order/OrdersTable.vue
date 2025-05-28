<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { computed } from 'vue';
import Pagination from './Pagination.vue'

const orders = ref([]);
const pagination = ref({
  current_page: 1,
  per_page: 10,
  total: 0,
  from: 1,
  to: 10,
})

const perPage = ref(10)



const getOrders = async (page = 1) => {
    const response = await axios.get(`/api/get-orders?page=${page}&per_page=${perPage.value}`);
    orders.value = response.data.orders.data;
    pagination.value = {
        current_page: response.data.orders.current_page,
    per_page: response.data.orders.per_page,
    total: response.data.orders.total,
    from: response.data.orders.from,
    to: response.data.orders.to,
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
                <thead class=" bg-snow/50">
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
                            {{ order.user.name}}
                        </td>
                        <td
                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
                        >
                            {{ order.status }}
                        </td>
                        <td
                            class="border-t-0 px-6 align-middle  border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
                        >
                            {{ order.menu.name }}
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
        <Pagination></Pagination>
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
    //             this.orders = response.data;
    //         })
    //         .catch((error) => {
    //             console.error("Failed to load menu:", error);
    //         });
    // },
};
</script>

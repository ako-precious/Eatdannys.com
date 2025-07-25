<script setup>
import Pagination from "@/Components/Pagination.vue";
import Search from "@/Components/Search.vue";
import { ref, onMounted } from "vue";
import { Head, Link } from "@inertiajs/vue3";
import axios from "axios";

const reservations = ref([]);
const perPage = ref(10);
const searchTerm = ref("");
const pagination = ref({
    current_page: 1,
    per_page: 10,
    total: 0,
    from: 1,
    to: 10,
    last_page: 1,
    next_page_url: null,
    prev_page_url: null,
});

// Handle search
const handleSearch = (term) => {
    searchTerm.value = term;
    getreservations(1); // Reset to page 1 when searching
};

// Handle per-page changes
const changePerPage = (value) => {
    perPage.value = value;
    getreservations(1); // Reset to page 1
};

// Fetch reservations with search
const getreservations = async (page = 1) => {
    try {
        const response = await axios.get(`/api/get-reservations`, {
            params: {
                page: page,
                per_page: perPage.value,
                search: searchTerm.value,
            },
        });

        reservations.value = response.data.reservations.data;

        pagination.value = {
            current_page: response.data.reservations.current_page,
            per_page: response.data.reservations.per_page,
            total: response.data.reservations.total,
            from: response.data.reservations.from,
            to: response.data.reservations.to,
            last_page: response.data.reservations.last_page,
            next_page_url: response.data.reservations.next_page_url,
            prev_page_url: response.data.reservations.prev_page_url,
        };
    } catch (error) {
        console.error("Failed to load reservations:", error);
    }
};

onMounted(() => {
    getreservations();
});
</script>

<template>
    <Head title="reservations" />
    <div
        class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded"
        :class="[color === 'light' ? 'bg-white' : 'bg-emerald-900 text-white']"
    >
        <div class="rounded-t mb-0 px-4 py-3 border-0">
            <div class="flex flex-wrap items-center justify-center">
                <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                    <h3 class="font-bold text-lg md:text-2xl text-oynx_alt">
                        reservations Table
                    </h3>
                </div>
                <div class="w-full md:w-[50%]">
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
                            Email
                        </th>
                        <th
                            class="px-6 align-middle border border-solid py-3 text-sm uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left text-oynx/75"
                        >
                            Phone Number
                        </th>
                        <th
                            class="px-6 align-middle border border-solid py-3 text-sm uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left text-oynx/75"
                        >
                            Date
                        </th>
                        <th
                            class="px-6 align-middle border border-solid py-3 text-sm uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left text-oynx/75"
                        >
                            Time
                        </th>
                        <th
                            class="px-6 align-middle border border-solid py-3 text-sm uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left text-oynx/75"
                        >
                            guests
                        </th>
                        <th
                            class="px-6 align-middle border border-solid py-3 text-sm uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left text-oynx/75"
                        >
                            Special Requests
                        </th>
                        <th
                            class="px-6 align-middle border border-solid py-3 text-sm uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left text-oynx/75"
                        ></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="reservation in reservations" :key="reservation.id">
                        <th
                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4 text-left items-center"
                        >
                            <span>{{ reservation.name }}</span>
                        </th>
                        <td
                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4"
                        >
                            {{ reservation.email }}
                        </td>
                        <td
                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4"
                        >
                            {{ reservation.phone }}
                        </td>
                        <td
                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4"
                        >
                            {{ reservation.date }}
                        </td>
                        <td
                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4"
                        >
                            {{ reservation.time }}
                        </td>
                       
                        <td
                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4"
                        >
                            {{ reservation.guests }}
                        </td>
                        <td
                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4"
                        >
                            {{ reservation.special_requests }}
                        </td>
                       
                        <td
                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4 text-right"
                        >
                            <table-dropdown :reservation="reservation" />
                        </td>
                    </tr>
                    <tr v-if="reservations.length === 0">
                        <td colspan="4" class="text-center py-8">
                            No reservations found
                            <span v-if="searchTerm">
                                for "{{ searchTerm }}"</span
                            >
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <Pagination
            :pagination="pagination"
            :per-page="perPage"
            @page-changed="getreservations"
            @per-page-changed="changePerPage"
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
    components: {
        TableDropdown,
    },
    props: {
        color: {
            default: "light",
            validator: function (value) {
                return ["light", "dark"].indexOf(value) !== -1;
            },
        },
    },
};
</script>

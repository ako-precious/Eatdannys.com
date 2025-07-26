<script setup>
import Pagination from "@/Components/Pagination.vue";
import Search from "@/Components/Search.vue";
import { ref, onMounted } from "vue";
import { Head, Link } from "@inertiajs/vue3";
import axios from "axios";

const meals = ref([]);
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
    getMeals(1); // Reset to page 1 when searching
};

// Handle per-page changes
const changePerPage = (value) => {
    perPage.value = value;
    getMeals(1); // Reset to page 1
};

// Fetch meals with search
const getMeals = async (page = 1) => {
    try {
        const response = await axios.get(`/api/meal`, {
            params: {
                page: page,
                per_page: perPage.value,
                search: searchTerm.value,
            },
        });

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
    } catch (error) {
        console.error("Failed to load meals:", error);
    }
};

onMounted(() => {
    getMeals();
});
</script>

<template>
    <Head title="Meals" />
    <div
        class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded"
        :class="[color === 'light' ? 'bg-white' : 'bg-emerald-900 text-white']"
    >
        <div class="rounded-t mb-0 px-4 py-3 border-0">
            <div class="flex flex-wrap items-center justify-center">
                <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                    <h3 class="font-bold text-lg md:text-2xl text-oynx_alt">
                        Meals For Bulk
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
                            Categories
                        </th>
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
                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4 text-left items-center"
                        >
                            <span>{{ meal.name }}</span>
                        </th>
                        <td
                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4"
                        >
                            {{ meal.category.name }}
                        </td>
                        <td
                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
                        >
                            <div
                                class="grid grid-cols-4 gap-2 w-full cursor-pointer"
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
                            <table-dropdown :meal="meal" />
                        </td>
                    </tr>
                    <tr v-if="meals.length === 0">
                        <td colspan="4" class="text-center py-8">
                            No meals found
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
            @page-changed="getMeals"
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

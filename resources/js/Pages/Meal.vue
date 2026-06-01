<template>
    <div class="flex flex-col items-center py-8 bg-snow dark:bg-oynx">

        <!-- Navigation tabs -->
        <div class="flex gap-4 mb-8">
            <Link :href="route('dining')">
                <button class="relative cursor-pointer py-3 px-6 inline-flex justify-center text-sm uppercase rounded-lg border-solid transition-transform duration-300 ease-in-out overflow-hidden group">
                    <span class="relative z-20 font-semibold text-oynx dark:text-snow">Dine In</span>
                    <span class="absolute left-[-75%] top-0 h-full w-[50%] bg-oynx/20 rotate-12 z-10 blur-lg group-hover:left-[125%] transition-all duration-1000 ease-in-out"></span>
                    <span class="w-1/2 transition-all duration-300 block border-[#D4EDF9] absolute h-[20%] rounded-tl-lg border-l-2 border-t-2 top-0 left-0"></span>
                    <span class="w-1/2 transition-all duration-300 block border-[#D4EDF9] absolute h-[60%] group-hover:h-[90%] rounded-tr-lg border-r-2 border-t-2 top-0 right-0"></span>
                    <span class="w-1/2 transition-all duration-300 block border-[#D4EDF9] absolute h-[60%] group-hover:h-[90%] rounded-bl-lg border-l-2 border-b-2 left-0 bottom-0"></span>
                    <span class="w-1/2 transition-all duration-300 block border-[#D4EDF9] absolute h-[20%] rounded-br-lg border-r-2 border-b-2 right-0 bottom-0"></span>
                </button>
            </Link>
            <Link :href="route('dining&takeout')">
                <button class="relative cursor-pointer py-3 px-6 inline-flex justify-center text-sm uppercase rounded-lg border-solid transition-transform duration-300 ease-in-out overflow-hidden group">
                    <span class="relative z-20 font-semibold text-oynx dark:text-snow">Bulk Order</span>
                    <span class="absolute left-[-75%] top-0 h-full w-[50%] bg-oynx/20 rotate-12 z-10 blur-lg group-hover:left-[125%] transition-all duration-1000 ease-in-out"></span>
                    <span class="w-1/2 transition-all duration-300 block border-[#D4EDF9] absolute h-[20%] rounded-tl-lg border-l-2 border-t-2 top-0 left-0"></span>
                    <span class="w-1/2 transition-all duration-300 block border-[#D4EDF9] absolute h-[60%] group-hover:h-[90%] rounded-tr-lg border-r-2 border-t-2 top-0 right-0"></span>
                    <span class="w-1/2 transition-all duration-300 block border-[#D4EDF9] absolute h-[60%] group-hover:h-[90%] rounded-bl-lg border-l-2 border-b-2 left-0 bottom-0"></span>
                    <span class="w-1/2 transition-all duration-300 block border-[#D4EDF9] absolute h-[20%] rounded-br-lg border-r-2 border-b-2 right-0 bottom-0"></span>
                </button>
            </Link>
        </div>

        <!-- Search -->
        <Search
            @search="handleSearch"
            class="flex mb-8 sticky top-0 z-10 transition-all duration-300 w-[80%] max-w-xl"
        />

        <!-- Results count -->
        <div v-if="!loading && meals.length > 0" class="w-full max-w-7xl px-4 mb-4">
            <p class="text-sm text-gray-500">
                Showing {{ meals.length }} item{{ meals.length === 1 ? '' : 's' }}
                <span v-if="searchTerm"> for "<strong>{{ searchTerm }}</strong>"</span>
            </p>
        </div>

        <!-- Meal grid -->
        <section class="w-full max-w-7xl px-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 justify-items-center">

            <div
                v-for="item in meals"
                :key="item.id"
                class="w-full max-w-[320px] bg-snow dark:bg-oynx_alt rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1 overflow-hidden flex flex-col"
            >
                <!-- Image -->
                <div class="relative overflow-hidden">
                    <img
                        :src="item.imageSrc"
                        :alt="item.name"
                        class="w-full h-60 object-cover transition-transform duration-500 hover:scale-105"
                        loading="lazy"
                    />
                    <div class="absolute top-3 left-3">
                        <span class="bg-oynx/70 text-snow text-xxs font-bold uppercase tracking-wide px-2 py-1 rounded-full">
                            {{ item.category.name }}
                        </span>
                    </div>
                </div>

                <!-- Content -->
                <div class="px-4 pt-4 pb-2 flex flex-col flex-grow">
                    <h2 class="font-bold text-base text-oynx dark:text-snow capitalize truncate mb-1">
                        {{ item.name }}
                    </h2>
                    <p v-if="item.description" class="text-xs text-gray-500 dark:text-gray-400 line-clamp-2 mb-3">
                        {{ item.description }}
                    </p>

                    <!-- Size / price selector -->
                    <div class="grid grid-cols-3 gap-2 mb-4">
                        <label
                            v-for="(price, priceIndex) in item.prices"
                            :key="priceIndex"
                            :for="`radio_${item.id}_${priceIndex}`"
                            class="flex flex-col items-center p-2 rounded-lg border cursor-pointer transition-all duration-150 text-center"
                            :class="selectedOptions[item.id] === price
                                ? 'border-persian bg-persian/10 shadow-sm'
                                : 'border-gray-200 hover:border-gray-400'"
                        >
                            <input
                                class="sr-only"
                                :id="`radio_${item.id}_${priceIndex}`"
                                type="radio"
                                :name="`option_${item.id}`"
                                :value="price"
                                v-model="selectedOptions[item.id]"
                            />
                            <span class="text-[0.65rem] font-semibold uppercase text-gray-600 dark:text-gray-300 leading-tight">
                                {{ price.size ?? price.quantity }}
                            </span>
                            <span class="text-sm font-bold text-oynx dark:text-snow mt-0.5">
                                ${{ price.price }}
                            </span>
                        </label>
                    </div>

                    <!-- Qty + Add to cart -->
                    <div class="flex items-center gap-3 mt-auto">
                        <div class="flex items-center border border-gray-200 rounded-lg overflow-hidden">
                            <button
                                class="px-2 py-1.5 text-oynx dark:text-snow hover:bg-gray-100 dark:hover:bg-oynx transition text-base font-bold"
                                @click="decrement(item.id)"
                            >−</button>
                            <span class="px-3 text-sm font-semibold text-oynx dark:text-snow min-w-[2rem] text-center">
                                {{ quantities[item.id] ?? 1 }}
                            </span>
                            <button
                                class="px-2 py-1.5 text-oynx dark:text-snow hover:bg-gray-100 dark:hover:bg-oynx transition text-base font-bold"
                                @click="increment(item.id)"
                            >+</button>
                        </div>

                        <button
                            class="flex-1 flex items-center justify-center gap-2 py-2 rounded-lg font-semibold text-sm transition-all duration-200"
                            :class="selectedOptions[item.id]
                                ? 'bg-persian text-oynx hover:brightness-110 active:scale-95'
                                : 'bg-gray-100 text-gray-400 cursor-not-allowed'"
                            :disabled="!selectedOptions[item.id]"
                            @click="addToCart(item, selectedOptions[item.id])"
                        >
                            <font-awesome-icon icon="fa-solid fa-cart-plus" />
                            <span>Add to Cart</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Loading skeleton -->
            <template v-if="loading">
                <div
                    v-for="n in 3"
                    :key="`skeleton-${n}`"
                    class="w-full max-w-[320px] bg-snow dark:bg-oynx_alt rounded-2xl shadow-md overflow-hidden animate-pulse"
                >
                    <div class="w-full h-60 bg-gray-200 dark:bg-gray-700"></div>
                    <div class="p-4 space-y-3">
                        <div class="h-4 bg-gray-200 dark:bg-gray-700 rounded w-3/4"></div>
                        <div class="h-3 bg-gray-200 dark:bg-gray-700 rounded w-full"></div>
                        <div class="h-3 bg-gray-200 dark:bg-gray-700 rounded w-2/3"></div>
                        <div class="h-10 bg-gray-200 dark:bg-gray-700 rounded mt-4"></div>
                    </div>
                </div>
            </template>
        </section>

        <!-- Empty state -->
        <div v-if="!loading && meals.length === 0" class="py-20 text-center text-gray-500">
            <i class="fa-solid fa-bowl-food text-5xl mb-4 opacity-30"></i>
            <p class="text-lg font-medium" v-if="searchTerm">No meals found for "{{ searchTerm }}"</p>
            <p class="text-lg font-medium" v-else>No meals available right now</p>
            <p class="text-sm mt-1">Check back soon!</p>
        </div>

        <!-- Load more indicator -->
        <div v-if="loading && meals.length > 0" class="py-10">
            <Loader />
        </div>

        <div v-if="allLoaded && meals.length > 0" class="py-8 text-center text-sm text-gray-400">
            All items loaded
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import Search from "@/Components/Search.vue";
import Loader from "@/Components/Loader.vue";
</script>

<script>
import axios from "axios";
import { useCartStore } from "@/stores/cart";

const FALLBACK_IMAGE = "https://img.icons8.com/ios/100/image--v1.png";

export default {
    data() {
        return {
            meals: [],
            page: 1,
            perPage: 10,
            loading: false,
            allLoaded: false,
            selectedOptions: {},
            quantities: {},
            searchTerm: "",
        };
    },

    computed: {
        cart() {
            return useCartStore();
        },
    },

    methods: {
        handleSearch(term) {
            this.searchTerm = term;
            this.page = 1;
            this.meals = [];
            this.allLoaded = false;
            this.fetchMeals();
        },

        async fetchMeals() {
            if (this.loading || this.allLoaded) return;

            this.loading = true;
            try {
                const response = await axios.get("/api/meal", {
                    params: { page: this.page, per_page: this.perPage, search: this.searchTerm },
                });

                const fetched = response.data.meals.data;

                if (fetched.length === 0) {
                    this.allLoaded = true;
                    return;
                }

                for (const meal of fetched) {
                    // Use eager-loaded photos — no extra API call needed
                    const firstPhoto = meal.photos?.[0];
                    meal.imageSrc = firstPhoto?.image_path
                        ? `/storage/${firstPhoto.image_path}`
                        : FALLBACK_IMAGE;

                    this.selectedOptions[meal.id] = meal.prices?.[0] ?? null;
                    this.quantities[meal.id] = 1;
                }

                this.meals = [...this.meals, ...fetched];
                this.page++;
            } catch (error) {
                console.error("Failed to load meals:", error);
            } finally {
                this.loading = false;
            }
        },

        addToCart(menuItem, selectedOption) {
            if (!selectedOption) return;
            const quantity = this.quantities[menuItem.id] ?? 1;

            this.cart.addItem({
                name: menuItem.name,
                category: menuItem.category.name,
                price: selectedOption.price * quantity,
                unit_price: selectedOption.price,
                quantity,
                size_or_quantity: selectedOption.size ?? selectedOption.quantity,
                image: menuItem.imageSrc ?? null,
            });
        },

        increment(id) {
            this.quantities[id] = (this.quantities[id] ?? 1) + 1;
        },

        decrement(id) {
            if ((this.quantities[id] ?? 1) > 1) {
                this.quantities[id]--;
            }
        },

        handleScroll() {
            const nearBottom =
                document.documentElement.scrollTop + window.innerHeight >=
                document.documentElement.scrollHeight - 200;
            if (nearBottom) this.fetchMeals();
        },
    },

    mounted() {
        this.fetchMeals();
        window.addEventListener("scroll", this.handleScroll);
    },

    beforeUnmount() {
        window.removeEventListener("scroll", this.handleScroll);
    },
};
</script>


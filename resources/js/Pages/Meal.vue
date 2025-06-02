<template>
    <!-- source: https://github.com/mfg888/Responsive-Tailwind-CSS-Grid/blob/main/index.html -->
    <div
        id="Projects"
        class="flex flex-col items-center py-12 bg-snow! dark:bg-oynx! relative bg-snow"
    >
        <Search
            @search="handleSearch"
            class="flex my-6 sticky top-0 transition-all duration-300 delay-75 ease-in animate-fade-in w-[80%]"
        ></Search>

        <section
            id="Projects"
            class="w-fit mx-auto grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 justify-items-center justify-center gap-y-16 gap-x-10 bg-snow"
        >
            <div
                class="w-[19rem] bg-snow shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl"
                v-for="(item, index) in meals"
                :key="index"
            >
                <div href="#" class="text-oynx/70">
                    <a href="">
                        <img
                            src="https://images.unsplash.com/photo-1646753522408-077ef9839300?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwcm9maWxlLXBhZ2V8NjZ8fHxlbnwwfHx8fA%3D%3D&auto=format&fit=crop&w=500&q=60"
                            alt="Product"
                            class="h-72 w-[19rem] object-cover rounded-t-xl"
                        />
                    </a>
                    <div class="px-4 py-3 w-[19rem]">
                        <div class="flex justify-between items-center">
                            <span
                                class="text-gray-600 mr-3 uppercase text-xs"
                                >{{ item.category.name}}</span
                            >
                            <p class="text-gray-500 text-sm">
                                Qty
                                <input
                                    type="number"
                                    min="1"
                                    class="w-20 h-7 border rounded px-1 text-sm"
                                    v-model.number="quantities[item.id]"
                                />
                            </p>
                        </div>
                        <p
                            class="text-lg mb-1 font-bold text-oynx truncate block capitalize"
                        >
                            {{ item.name }}
                        </p>

                        <!-- Component Start -->
                        <div
                            class="grid grid-cols-3 gap-2 w-full max-w-screen-sm cursor-pointer"
                        >
                            <div
                                v-for="(price, index) in item.prices"
                                :key="index"
                            >
                                <input
                                    class="hidden"
                                    :id="`radio_${item.id}_${index}`"
                                    type="radio"
                                    :name="`option_${item.id}`"
                                    :value="price"
                                    v-model="selectedOptions[item.id]"
                                />
                                <label
                                    class="flex flex-col p-2 border-2"
                                    :class="{
                                        'border-oynx bg-blue-100':
                                            selectedOptions[item.id] === price,
                                        'border-gray-400':
                                            selectedOptions[item.id] !== price,
                                    }"
                                    :for="`radio_${item.id}_${index}`"
                                >
                                    <span
                                        class="text-[0.68rem] font-semibold uppercase"
                                    >
                                        {{ price.size ?? price.quantity }}
                                    </span>
                                    <span class="text-[0.8rem] font-bold">
                                        ${{ price.price }}
                                    </span>
                                </label>
                            </div>
                        </div>

                        <button
                            class="mt-3 px-4 text-bold w-full rounded cursor-pointer"
                            @click="addToCart(item, selectedOptions[item.id])"
                            title="Select an option before clicking"
                            :disabled="!selectedOptions[item.id]"
                        >
                            <p
                                class="flex font-bold justify-between w-full items-center text-sm m-auto relative three py-1 px-3"
                            >
                                <!-- <div>
                        
                      </div> -->
                                <font-awesome-icon
                                    icon="fa-solid fa-cart-plus"
                                    class="text-lg mr-2"
                                />
                                <span class="px-1">Add To Cart</span>
                                <span
                                    class="absolute left-0 -bottom-1 w-full h-6 transition-all bg-persian"
                                    style="z-index: -9"
                                ></span>
                            </p>
                        </button>
                    </div>
                </div>
            </div>
             <div v-if="loading" class="py-8 text-center">
      Loading more meals...
    </div>
    
    <div v-else-if="meals.length === 0" class="py-12 text-center">
      <p v-if="searchTerm">No meals found for "{{ searchTerm }}"</p>
      <p v-else>No meals available</p>
    </div>
        </section>
    </div>
</template>

<script setup>
import Search from "./Header/Search.vue";
</script>
<script>
import axios from "axios";
import { useCartStore } from "@/stores/cart";
export default {
    data() {
        return {
            meals: [],
            page: 1,
            perPage: 10,
            loading: false,
            allLoaded: false,
            selectedOptions: {},
            quantity: 1,
            quantities: {},
        };
    },

    computed: {
        cart() {
            return useCartStore();
        },
    },
    methods: {
        handleSearch(term) {
            axios
                .get("/api/meal", {
                    params: { search: term },
                })
                .then((response) => {
                    this.meals = response.data;
                })
                .catch((error) => {
                    console.error("Search failed:", error);
                });
        },
        addToCart(menuItem, selectedOption) {
            if (!selectedOption) return;

            const quantity = this.quantities[menuItem.id] || 1;

            this.cart.addItem({
                name: menuItem.name,
                category: menuItem.category.name,
                price: selectedOption.price * quantity,
                unit_price: selectedOption.price,
                quantity,
                size_or_quantity:
                    selectedOption.size || selectedOption.quantity,
            });
        },
         handleScroll() {
        const scrollHeight = document.documentElement.scrollHeight;
        const scrollTop = document.documentElement.scrollTop;
        const clientHeight = document.documentElement.clientHeight;

        if (scrollTop + clientHeight >= scrollHeight - 100) {
            this.fetchMeals();
        }
    },
        async fetchMeals() {
        if (this.loading || this.allLoaded) return;

        this.loading = true;
        try {
            const response = await axios.get("/api/meal", {
                params: { page: this.page, per_page: this.perPage }
            });

            const fetchedMeals = response.data.data;

            if (fetchedMeals.length === 0) {
                this.allLoaded = true;
            } else {
                this.meals.push(...fetchedMeals);
                this.page++;

                // Default selections
                fetchedMeals.forEach(item => {
                    if (item.prices && item.prices.length > 0) {
                        this.$set(this.selectedOptions, item.id, item.prices[0]);
                        this.$set(this.quantities, item.id, 1);
                    }
                });
            }
        } catch (error) {
            console.error("Failed to load meals:", error);
        } finally {
            this.loading = false;
        }
    }
    },
    beforeDestroy() {
    window.removeEventListener('scroll', this.handleScroll);
},
    mounted() {
            this.fetchMeals();
    window.addEventListener('scroll', this.handleScroll);

      
    },
};
</script>

<style scoped>
input:checked + label {
    border-color: black;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1),
        0 4px 6px -2px rgba(0, 0, 0, 0.05);
}

.three:hover span {
    height: 120%;
}
</style>

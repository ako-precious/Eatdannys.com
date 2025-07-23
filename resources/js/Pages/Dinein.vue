<template>
    <!-- source: https://github.com/mfg888/Responsive-Tailwind-CSS-Grid/blob/main/index.html -->
   <Head title="Welcome" />
    <Background>

        <div
            class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-snow"
        >
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <main class="my-12">
                    
                 <div
        id="Projects"
        class="flex flex-col items-center py-12 bg-snow! dark:bg-oynx! relative"
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
                            :src="item.imageSrc || fallbackImage"
                            class="h-72 w-[19rem] object-cover rounded-t-xl"
                            alt="Meal"
                        />
                    </a>
                    <div class="px-4 py-3 w-[19rem]">
                        <div class="flex justify-between items-center">
                            <span
                                class="text-gray-600 mr-3 uppercase text-xs"
                                >{{ item.category.name }}</span
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
                        <div class="flex justify-between items-center">
                            <p
                                class="text-lg mb-1 font-bold text-oynx truncate block capitalize"
                            >
                                {{ item.name }} 
                            </p>
                            <span
                                class="text-gray-600 mr-3 uppercase text-xxs"
                                > {{ item.category.order_type }}</span
                            >
                          
                        </div>

                        <!-- Component Start -->
                        <div
                            class="grid grid-cols-3 gap-2 w-full mb-3 max-w-screen-xs cursor-pointer"
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
                                    class="flex flex-col p-1 border-1"
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
                            class=" px-4 text-bold w-full rounded cursor-pointer"
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
            <div v-if="loading" class="p-8 text-center m-auto">
                <Loader></Loader>
            </div>

            <div v-else-if="meals.length === 0" class="py-12 text-center">
                <p v-if="searchTerm">No meals found for "{{ searchTerm }}"</p>
                <p v-else>No meals available</p>
            </div>
        </section>
    </div>   
                </main>

               
            </div>
        </div>
        <div
            class="relative z-10"
            aria-labelledby="slide-over-title"
            role="dialog"
            aria-modal="true"
        ></div>
        <CartSlideOver ></CartSlideOver>
<ScrollToTop></ScrollToTop>
   </Background>
    
</template>

<script setup>
import { Head, Link } from "@inertiajs/vue3";

import Meal from "./Meal.vue";
import ScrollToTop from "@/Components/ScrollToTop.vue";
import CartSlideOver from "./Header/CartSlideOver.vue";
import Background from "@/Layouts/Background.vue";

import Search from "@/Components/Search.vue";
import Loader from "@/Components/Loader.vue";
defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

function handleImageError() {
    document.getElementById("screenshot-container")?.classList.add("hidden!");
    document.getElementById("docs-card")?.classList.add("row-span-1!");
    document.getElementById("docs-card-content")?.classList.add("flex-row!");
    document.getElementById("background")?.classList.add("hidden!");
}
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
            quantities: {},
            src: "",
            fallbackImage:
                "https://img.icons8.com/ios/100/image--v1.png",
   
            searchTerm: "", // Track search term for pagination
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
        async getPhoto(mealId) {
            const fallbackImage =
                "https://img.icons8.com/ios/50/image--v1.png";
            try {
                const response = await axios.get(`/meal-photos/${mealId}`);
                const photoPath = response.data.firstPhoto?.image_path;
                return photoPath ? `/storage/${photoPath}` : fallbackImage;
            } catch (error) {
                console.error("Error fetching photo:", error);
                return fallbackImage;
            }
        },

        // async fetchMeals() {
        //     if (this.loading || this.allLoaded) return;

        //     this.loading = true;
        //     try {
        //         const params = {
        //             page: this.page,
        //             per_page: this.perPage,
        //             search: this.searchTerm,
        //         };

        //         const response = await axios.get("/api/meal", { params });
        //         const fetchedMeals = response.data.meals.data; // Correct path

        //         if (fetchedMeals.length === 0) {
        //             this.allLoaded = true;
        //             return;
        //         }

        //         this.meals = [...this.meals, ...fetchedMeals];
        //         this.page++;

        //         // Initialize selections
        //         fetchedMeals.forEach((item) => {
        //             this.$set(
        //                 this.selectedOptions,
        //                 item.id,
        //                 item.prices?.[0] || null
        //             );
        //             this.$set(this.quantities, item.id, 1);
        //         });
        //     } catch (error) {
        //         console.error("Failed to load meals:", error);
        //     } finally {
        //         this.loading = false;
        //     }
        // },
      
      async fetchMeals() {
    if (this.loading || this.allLoaded) return;

    this.loading = true;
    try {
        const params = {
            page: this.page,
            per_page: this.perPage,
            search: this.searchTerm,
        };

        const response = await axios.get("/api/dine-meal", { params });
        const fetchedMeals = response.data.meals.data;

        if (fetchedMeals.length === 0) {
            this.allLoaded = true;
            return;
        }

        // 👇 Fetch image for each meal
        for (const meal of fetchedMeals) {
            meal.imageSrc = await this.getPhoto(meal.id);
        }

        this.meals = [...this.meals, ...fetchedMeals];
        this.page++;

        fetchedMeals.forEach((item) => {
            this.$set(this.selectedOptions, item.id, item.prices?.[0] || null);
            this.$set(this.quantities, item.id, 1);
        });

    } catch (error) {
        console.error("Failed to load meals:", error);
    } finally {
        this.loading = false;
    }
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
                    image: menuItem.imageSrc || null, // ✅ Add image to cart item
            });
        },
        handleScroll() {
            const bottomOfWindow =
                document.documentElement.scrollTop + window.innerHeight >=
                document.documentElement.scrollHeight - 100;

            if (bottomOfWindow) this.fetchMeals();
        },
    },
    beforeUnmount() {
        window.removeEventListener("scroll", this.handleScroll);
    },
    mounted() {
        this.fetchMeals();
        window.addEventListener("scroll", this.handleScroll);
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

<template>
    <!-- source: https://github.com/mfg888/Responsive-Tailwind-CSS-Grid/blob/main/index.html -->

    <section
        id="Projects"
        class="w-fit mx-auto pattern grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 justify-items-center justify-center gap-y-20 gap-x-10 p-16"
    >
        <div
            class="w-72 bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl"
            v-for="(item, index) in meals"
            :key="index"
        >
            <a href="#">
                <img
                    src="https://images.unsplash.com/photo-1646753522408-077ef9839300?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwcm9maWxlLXBhZ2V8NjZ8fHxlbnwwfHx8fA%3D%3D&auto=format&fit=crop&w=500&q=60"
                    alt="Product"
                    class="h-72 w-72 object-cover rounded-t-xl"
                />
                <div class="px-4 py-3 w-72">
                    <span class="text-gray-400 mr-3 uppercase text-xs">{{
                        item.category.name
                    }}</span>
                    <p
                        class="text-lg mb-1 font-bold text-oynx truncate block capitalize"
                    >
                        {{ item.name }}
                    </p>

                    <!-- Component Start -->
                    <div class="grid grid-cols-3 gap-2 w-full max-w-screen-xs">
                        <div v-for="(price, index) in item.prices" :key="index">
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
                                <span class="text-[0.68rem] font-semibold uppercase">
                                    {{ price.size ?? price.quantity }}
                                </span>
                                <span class="text-sm font-bold">
                                    ${{ price.price }}
                                </span>
                            </label>
                        </div>
                    </div>
                    
                    <button
                    class="mt-3 px-4 text-bold w-full  rounded"
                    @click="addToCart(item)"
                    :disabled="!selectedOptions[item.id]"
                    >
                    <p class=" flex font-bold justify-between w-full items-center text-sm m-auto relative w-max three py-1 px-3">
                      <!-- <div>
                        
                      </div> -->
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="20"
                            height="20"
                            fill="currentColor"
                            class="bi bi-bag-plus"
                            viewBox="0 0 16 16"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z"
                            />
                            <path
                                d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"
                            />
                        </svg>
  <span class="px-1">Add To Cart</span>
  <span class="absolute left-0 -bottom-1 w-full h-1 transition-all bg-persian" style="z-index: -9;"></span>
</p>
                    </button>
                </div>
            </a>
        </div>
    </section>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            meals: [],
            selectedOptions: {}, // Stores selected size/quantity per item
            cart: [],
        };
    },
    mounted() {
        axios
            .get("/api/meal")
            .then((response) => {
                this.meals = response.data;
            })
            .catch((error) => {
                console.error("Failed to load menu:", error);
            });
    },
    methods: {
        addToCart(item) {
            const selected = this.selectedOptions[item.id];
            if (!selected) return;

            this.cart.push({
                id: item.id,
                name: item.name,
                size_or_quantity: selected.size ?? selected.quantity,
                price: selected.price,
            });

            // Optionally: Emit an event or sync with backend
            console.log("Cart:", this.cart);
        },
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

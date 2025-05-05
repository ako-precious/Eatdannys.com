<template>
    <!-- source: https://github.com/mfg888/Responsive-Tailwind-CSS-Grid/blob/main/index.html -->

    <section
        id="Projects"
        class="w-fit mx-auto grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 justify-items-center justify-center gap-y-20 gap-x-10 p-16 bg-snow! dark:bg-oynx!"
    >
        <div
            class="w-72 bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl"
            v-for="(item, index) in meals"
            :key="index"
        >
            <a href="#" class="text-oynx">
                <img
                    src="https://images.unsplash.com/photo-1646753522408-077ef9839300?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwcm9maWxlLXBhZ2V8NjZ8fHxlbnwwfHx8fA%3D%3D&auto=format&fit=crop&w=500&q=60"
                    alt="Product"
                    class="h-72 w-72 object-cover rounded-t-xl"
                />
                <div class="px-4 py-3 w-72">
                    <span class="text-gray-600 mr-3 uppercase text-xs">{{
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
                      <font-awesome-icon icon="fa-solid fa-cart-plus" class="text-lg mr-2" />
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

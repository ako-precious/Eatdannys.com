<script setup>
import { onMounted, ref } from "vue";


const Meal = ref({
    prices: [],
    // other meal properties...
});

// Normalize prices to use a common 'label' field
onMounted(() => {
    Meal.value.prices = Meal.value.prices.map(p => ({
        label: p.size ?? p.quantity ?? "",
        price: p.price ?? 0,
    }));
});

// For form submission
function getFormattedPrices() {
    return Meal.value.prices.map(p => ({
        size: p.label, // change to 'quantity' if your backend expects that
        price: p.price
    }));
}
</script>

<template>
    <div class="col-span-6">
        <div class="flex gap-4 mb-2">
            <label class="text-sm font-medium text-oynx/90 block mb-2 w-1/2">Size/Quantity</label>
            <label class="text-sm font-medium text-oynx/90 block mb-2 w-1/2">Price</label>
        </div>

        <div v-for="(price, index) in Meal.prices" :key="index" class="flex gap-4 mb-2">
            <!-- Input for label -->
            <input
                v-model="Meal.prices[index].label"
                placeholder="Size / Quantity"
                required
                class="shadow-sm bg-oynx/5 border border-oynx/30 text-oynx/90 sm:text-sm rounded-lg focus:ring-polynesian/60 focus:border-polynesian/60 block w-full p-2"
            />

            <!-- Input for price -->
            <div class="relative w-full">
                <input
                    v-model="Meal.prices[index].price"
                    placeholder="Price"
                    required
                    type="number"
                    class="shadow-sm bg-oynx/5 border border-oynx/30 text-oynx/90 sm:text-sm rounded-lg focus:ring-polynesian/60 focus:border-polynesian/60 block pl-6 p-2 w-full"
                />
                <span class="absolute py-2 top-1 left-2">$</span>
            </div>

            <!-- Delete button -->
            <button
                @click="Meal.prices.splice(index, 1)"
                type="button"
                title="Delete"
            >
                <font-awesome-icon :icon="['fas', 'trash']" class="text-lighred text-xl" />
            </button>
        </div>

        <!-- Add button -->
        <Button type="button" @click="Meal.prices.push({ label: '', price: 0 })">
            Add
        </Button>
    </div>
</template>

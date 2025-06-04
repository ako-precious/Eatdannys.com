<template>
    <AppLayout title="Meals">
        <div class="flex flex-wrap mt-4">
            <div class="w-full mb-12 px-4">
                <div class="bg-white border rounded-lg shadow relative p-5">
                    <div
                        class="flex items-start justify-between py-5 border-b rounded-t"
                    >
                        <h3 class="text-xl font-semibold px-5">Edit Meal</h3>
                    </div>

                    <div class="p-6 space-y-6">
                        <form action="#">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <label
                                        for="Meal-name"
                                        class="text-sm font-medium text-gray-900 block mb-2"
                                        >Meal Name</label
                                    >
                                    <input
                                        type="text"
                                        name="Meal-name"
                                        id="Meal-name"
                                        :value="Meal.name"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                                        placeholder="Apple Imac 27”"
                                        required
                                    />
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label
                                        for="category"
                                        class="text-sm font-medium text-gray-900 block mb-2"
                                        >Category</label
                                    >
                                    <select
                                        name="category"
                                        id="category"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                                        required
                                        v-model="Meal.category_id"
                                    >
                                        <option
                                            v-for="category in Categories"
                                            :key="category.id"
                                            :value="category.id"
                                        >
                                            {{ category.name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="col-span-6">
                                    <div class="flex gap-4 mb-2">
                                        <label
                                            for="brand"
                                            class="text-sm font-medium text-gray-900 block mb-2 w-1/2"
                                            >Quality</label
                                        >
                                        <label
                                            for="price"
                                            class="text-sm font-medium text-gray-900 block mb-2 w-1/2"
                                            >Price</label
                                        >
                                    </div>

                                    <div
                                        v-for="(price, index) in Meal.prices"
                                        :key="index"
                                        class="flex gap-4 mb-2"
                                    >
                                        <input
                                            v-model="Meal.prices[index].size"
                                            placeholder="Size"
                                            required
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                                        />
                                        <input
                                            v-model="Meal.prices[index].price"
                                            placeholder="Price"
                                            required
                                            type="number"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                                        />
                                        <button
                                            @click="
                                                Meal.prices.splice(index, 1)
                                            "
                                            type="button"
                                            title="delete"
                                        >
                                            <font-awesome-icon
                                                :icon="['fas', 'trash']"
                                                class="text-lighred text-xl"
                                            />
                                        </button>
                                    </div>
                                    <Button
                                        type="button"
                                        @click="
                                            Meal.prices.push({
                                                size: '',
                                                price: 0,
                                            })
                                        "
                                    >
                                        Add
                                        <!-- <template #first>Add</template> -->
                                        <!-- <template #second>+</template> -->
                                    </Button>
                                </div>

                                <div class="col-span-6">
                                    <label
                                        for="Meal-details"
                                        class="text-sm font-medium text-gray-900 block mb-2"
                                        >Meal Details</label
                                    >
                                    <textarea
                                        id="Meal-details"
                                        rows="6"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-4"
                                        placeholder="Details"
                                    ></textarea>
                                </div>
                                <div class="col-span-6">
                                    <label
                                        for="Meal-details"
                                        class="text-sm font-medium text-gray-900 block mb-2"
                                        >Meal Photos
                                    </label>
                                    <div
                                        class="w-full mx-auto rounded-lg overflow-hidden md:max-w-xl"
                                    >
                                        <div class="bg-white px-2">
                                            <div
                                                class="w-full mx-auto rounded-lg overflow-hidden md:max-w-xl"
                                            >
                                                <div class="md:flex">
                                                    <div class="w-full p-3">
                                                        <div
                                                            class="relative border-dotted h-48 w-full rounded-lg border-2 border-blue-700 bg-gray-100 flex justify-center items-center"
                                                        >
                                                            <div
                                                                class="absolute"
                                                            >
                                                                <div
                                                                    class="flex flex-col items-center text-oynx"
                                                                >
                                                                    <font-awesome-icon
                                                                        :icon="[
                                                                            'fas',
                                                                            'file-image',
                                                                        ]"
                                                                        class="text-5xl pb-4"
                                                                    />
                                                                    <span
                                                                        class="block font-normal"
                                                                        >Attach
                                                                        you
                                                                        files
                                                                        here</span
                                                                    >
                                                                </div>
                                                            </div>

                                                            <input
                                                                type="file"
                                                                class="h-full w-full opacity-0"
                                                                multiple
                                                                accept="image/*"
                                                                @change="
                                                                    handleFileChange
                                                                "
                                                            />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="p-6 border-t border-gray-200 rounded-b">
                        <button
                            class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                            type="submit"
                        >
                            Save All
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
<script>
import MealsTable from "./MealsTable.vue";
import Button from "./Button.vue";
// import AppLayout from "../../Layouts/Applayout.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
export default {
    props: {
        Meal: Object,
        Categories: Object,
    },
    components: {
        MealsTable,
        AppLayout,
        Button,
    },
};
</script>

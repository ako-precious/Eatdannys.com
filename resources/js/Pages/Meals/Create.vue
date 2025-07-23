<script setup>
import { ref, reactive } from 'vue';
import MealsTable from "./MealsTable.vue";
import Button from "./Button.vue";
// import AppLayout from "../../Layouts/Applayout.vue";
import AppLayout from "@/Layouts/AppLayout.vue";

const selectedFiles = ref([]);
const imagePreviews = ref([]);
const errors = ref([]);

const MIN_IMAGE_SIZE = 20 * 1024; // 20KB
const MAX_IMAGE_SIZE = 5 * 1024 * 1024; // 5MB
const MAX_IMAGES = 6;
const MIN_IMAGES = 3;


const props = defineProps({
    Meal: Object,
    Categories: Object,
    Photos: Object,
});

const meal = reactive({ ...props.Meal }); // 🔄 reactive copy

function handleFileChange(event) {
    const files = Array.from(event.target.files);
    errors.value = [];

    for (let file of files) {
        // Validate image type
        if (!file.type.startsWith("image/")) {
            errors.value.push(`${file.name} is not a valid image.`);
            continue;
        }

        // Validate file size
        if (file.size < MIN_IMAGE_SIZE) {
            errors.value.push(`${file.name} is too small (min 20KB).`);
            continue;
        }

        if (file.size > MAX_IMAGE_SIZE) {
            errors.value.push(`${file.name} is too large (max 5MB).`);
            continue;
        }

        // Validate total image count
        if (selectedFiles.value.length >= MAX_IMAGES) {
            errors.value.push(
                `You can upload a maximum of ${MAX_IMAGES} images.`
            );
            break;
        }

        selectedFiles.value.push(file);

        const reader = new FileReader();
        reader.onload = (e) => {
            imagePreviews.value.push({ url: e.target.result, name: file.name });
        };
        reader.readAsDataURL(file);
    }

    event.target.value = null;
}

function submitForm() {
    const formData = new FormData();
    formData.append("name", meal.name);
    formData.append("category_id", meal.category_id);
    formData.append("description", meal.description || "");
    formData.append("prices", JSON.stringify(meal.prices));

    selectedFiles.value.forEach((file) => {
        formData.append("images[]", file);
    });

    axios
        .post(`/meals/${meal.id}?_method=PUT`, formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        })
        .then((res) => {
            alert("Meal updated successfully.");
            window.location.href = "/meals"; // or use inertia if needed
        })
        .catch((err) => {
            if (err.response?.data?.errors) {
                console.log('Validation Errors:', err.response.data.errors);
                errors.value = Object.values(err.response.data.errors).flat();
            } else {
                console.error(err);
            }
        });
}



function removeImage(index) {
    selectedFiles.value.splice(index, 1);
    imagePreviews.value.splice(index, 1);
}
</script>

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
                                        class="text-sm font-medium text-oynx/90 block mb-2"
                                        >Meal Name</label
                                    >
                                    <input
                                        type="text"
                                        name="Meal-name"
                                        id="Meal-name"
                                         v-model="Meal.name"
                                        class="shadow-sm bg-oynx/5 border border-oynx/30 text-oynx/90 sm:text-sm rounded-lg focus:ring-polynesian/60 focus:border-polynesian/60 block w-full p-2.5"
                                        placeholder=" "
                                        required
                                    />
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label
                                        for="category"
                                        class="text-sm font-medium text-oynx/90 block mb-2"
                                        >Category</label
                                    >
                                    <select
                                        name="category"
                                        id="category"
                                        class="shadow-sm bg-oynx/5 border border-oynx/30 text-oynx/90 sm:text-sm rounded-lg focus:ring-polynesian/60 focus:border-polynesian/60 block w-full p-2.5"
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
                                            class="text-sm font-medium text-oynx/90 block mb-2 w-1/2"
                                            >Size/Quality</label
                                        >
                                        <label
                                            for="price"
                                            class="text-sm font-medium text-oynx/90 block mb-2 w-1/2"
                                            >Price</label
                                        >
                                    </div>

                                    <div
                                        v-for="(price, index) in Meal.prices"
                                        :key="index"
                                        class="flex gap-4 mb-2"
                                    >
                                        <input  
                                            v-model="Meal.prices[index].size "
                                            placeholder="Size"
                                            required
                                            class="shadow-sm bg-oynx/5 border border-oynx/30 text-oynx/90 sm:text-sm rounded-lg focus:ring-polynesian/60 focus:border-polynesian/60 block w-full p-2"
                                        />
                                      
                                        <div class="relative w-full">

                                            <input
                                                v-model="Meal.prices[index].price"
                                                placeholder="Price"
                                                required
                                                type="number"
                                                class=" shadow-sm bg-oynx/5 border border-oynx/30 text-oynx/90 sm:text-sm rounded-lg focus:ring-polynesian/60 focus:border-polynesian/60 block pl-6 p-2 w-full"
                                            /> 
                                            <span class="absolute  py-2 top-1 left-2 ">$</span>
                                        </div>
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
                                        @click=" Meal.prices.push({size: '1', price: 1,}) "
                                    >
                                        Add
                                    </Button>
                                  
                                </div>

                                <div class="col-span-6">
                                    <label
                                        for="Meal-details"
                                        class="text-sm font-medium text-oynx/90 block mb-2"
                                        >Meal Details</label
                                    >
                                    <textarea
                                        id="Meal-details"  v-model="Meal.description"
                                        rows="6"
                                        class="bg-oynx/5 border border-oynx/30 text-oynx/90 sm:text-sm rounded-lg focus:ring-polynesian/60 focus:border-polynesian/60 block w-full p-4"
                                        placeholder="Details"
                                    ></textarea>
                                </div>
                                <div class="col-span-6">
                                    <label
                                        for="Meal-details"
                                        class="text-sm font-medium text-oynx/90 block mb-2"
                                        >Meal Photos
                                    </label>
                                    <div>
                                       
                                        <div
                                            class="relative border-dotted h-48 w-full rounded-lg border-2 border-polynesian/70 bg-oynx/10 flex justify-center items-center "
                                        >
                                            <div class="absolute">
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
                                                        >Attach your files
                                                        here</span
                                                    >
                                                </div>
                                            </div>

                                            <input
                                                type="file"
                                                class="h-full w-full opacity-0"
                                                multiple
                                                accept="image/*"
                                                @change="handleFileChange"
                                            />
                                        </div>

                                        <!-- Preview Thumbnails -->
                                        <div
                                            class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4"
                                        >
                                            <div
                                                v-for="(
                                                    image, index
                                                ) in imagePreviews"
                                                :key="index"
                                                class="relative group"
                                            >
                                                <img
                                                    :src="image.url"
                                                    class="rounded-lg w-full h-32 object-cover"
                                                />

                                                <!-- Remove Button -->
                                                <button
                                                    @click="removeImage(index)"
                                                    type="button"
                                                    class="absolute top-1 right-1 bg-red-600 text-white text-xs px-1.5 py-0.5 rounded opacity-80 hover:opacity-100"
                                                >
                                                    <font-awesome-icon
                                                        :icon="['fas', 'trash']"
                                                        class=" "
                                                    />
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                     <div
                                            v-if="errors.length"
                                            class="mt-4 text-sm text-red-600"
                                        >
                                            <ul>
                                                <li
                                                    v-for="(
                                                        error, index
                                                    ) in errors"
                                                    :key="index"
                                                >
                                                    • {{ error }}
                                                </li>
                                            </ul>
                                        </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="p-6 border-t border-oynx/20 rounded-b">
                        <button @click="submitForm"
                            class="text-white bg-polynesian/60 hover:bg-polynesian/70 focus:ring-4 focus:ring-polynesian/20 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
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


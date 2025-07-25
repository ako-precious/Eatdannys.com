<script setup>
import { ref, reactive } from 'vue';
import { router } from '@inertiajs/vue3'
import Button from "./Button.vue";
// import AppLayout from "../../Layouts/Applayout.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import NotFoundPage from "@/Pages/NotFoundPage.vue"
const errors = ref([]);



const props = defineProps({
    reservation: Object,
});

const reservation = reactive({ ...props.reservation }); // 🔄 reactive copy

function submitForm() {


    const formData = new FormData();
    formData.append("name", reservation.name);
    formData.append("email", reservation.email);
    formData.append("phone", reservation.phone);
    formData.append("date", reservation.date);
    formData.append("time", reservation.time);
    formData.append("guests", reservation.guests);
    formData.append("special_requests", reservation.special_requests || "");
formData.append("_method", "PUT"); // ← Spoofing PUT method
   

  axios
  .post(`/reservations/${reservation.id}`, formData, {
   
  })
  .then((res) => {
    alert("reservation updated successfully.");
    router.visit('/reservations');
    // console.log(res);
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

</script>

<template>
    <AppLayout  title="reservations"  v-if=" $page.props.auth.user.role === 'admin'">
        <div class="flex flex-wrap mt-4">
            <div class="w-full mb-12 px-4">
                <div class="bg-white border rounded-lg shadow relative p-5">
                    <div
                        class="flex items-start justify-between py-5 border-b rounded-t"
                    >
                        <h3 class="text-xl font-semibold px-5">Edit Reservation</h3>
                    </div>

                    <div class="p-6 space-y-6">
                        <form action="#">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <label
                                        for="reservation-name"
                                        class="text-sm font-medium text-oynx/90 block mb-2"
                                        >Name</label
                                    >
                                    <input
                                        type="text"
                                        name="reservation-name"
                                        id="reservation-name"
                                         v-model="reservation.name"
                                        class="shadow-sm bg-oynx/5 border border-oynx/30 text-oynx/90 sm:text-sm rounded-lg focus:ring-polynesian/60 focus:border-polynesian/60 block w-full p-2.5"
                                        placeholder=" "
                                        required
                                    />
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label
                                        for="reservation-name"
                                        class="text-sm font-medium text-oynx/90 block mb-2"
                                        >Email</label
                                    >
                                    <input
                                        type="text"
                                        name="reservation-name"
                                        id="reservation-name"
                                         v-model="reservation.email"
                                        class="shadow-sm bg-oynx/5 border border-oynx/30 text-oynx/90 sm:text-sm rounded-lg focus:ring-polynesian/60 focus:border-polynesian/60 block w-full p-2.5"
                                        placeholder=" "
                                        required
                                    />
                                </div>
                              
                                <div class="col-span-6 sm:col-span-3">
                                    <label
                                        for="reservation-name"
                                        class="text-sm font-medium text-oynx/90 block mb-2"
                                        >Phone</label
                                    >
                                    <input
                                        type="text"
                                        name="reservation-name"
                                        id="reservation-name"
                                         v-model="reservation.phone"
                                        class="shadow-sm bg-oynx/5 border border-oynx/30 text-oynx/90 sm:text-sm rounded-lg focus:ring-polynesian/60 focus:border-polynesian/60 block w-full p-2.5"
                                        placeholder=" "
                                        required
                                    />
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label
                                        for="reservation-name"
                                        class="text-sm font-medium text-oynx/90 block mb-2"
                                        >Date</label
                                    >
                                    <input
                                        type="text"
                                        name="reservation-name"
                                        id="reservation-name"
                                         v-model="reservation.date"
                                        class="shadow-sm bg-oynx/5 border border-oynx/30 text-oynx/90 sm:text-sm rounded-lg focus:ring-polynesian/60 focus:border-polynesian/60 block w-full p-2.5"
                                        placeholder=" "
                                        required
                                    />
                                </div>
                              
                                <div class="col-span-6 sm:col-span-3">
                                    <label
                                        for="reservation-name"
                                        class="text-sm font-medium text-oynx/90 block mb-2"
                                        >Time</label
                                    >
                                    <input
                                        type="text"
                                        name="reservation-name"
                                        id="reservation-name"
                                         v-model="reservation.time"
                                        class="shadow-sm bg-oynx/5 border border-oynx/30 text-oynx/90 sm:text-sm rounded-lg focus:ring-polynesian/60 focus:border-polynesian/60 block w-full p-2.5"
                                        placeholder=" "
                                        required
                                    />
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label
                                        for="reservation-name"
                                        class="text-sm font-medium text-oynx/90 block mb-2"
                                        >Guests</label
                                    >
                                    <input
                                        type="number"
                                        name="reservation-name"
                                        id="reservation-name"
                                         v-model="reservation.guests"
                                        class="shadow-sm bg-oynx/5 border border-oynx/30 text-oynx/90 sm:text-sm rounded-lg focus:ring-polynesian/60 focus:border-polynesian/60 block w-full p-2.5"
                                        placeholder=" "
                                        required
                                    />
                                </div>
                              
                                

                                <div class="col-span-6">
                                    <label
                                        for="reservation-details"
                                        class="text-sm font-medium text-oynx/90 block mb-2"
                                        >Special Request</label
                                    >
                                    <textarea
                                        id="reservation-details"  v-model="reservation.special_requests"
                                        rows="6"
                                        class="bg-oynx/5 border border-oynx/30 text-oynx/90 sm:text-sm rounded-lg focus:ring-polynesian/60 focus:border-polynesian/60 block w-full p-4"
                                        placeholder="Details"
                                    ></textarea>
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

    <div v-else>
<NotFoundPage></NotFoundPage>
    </div>
</template>
<script setup>
import { Head, Link } from "@inertiajs/vue3";

import Meal from "./Meal.vue";
import Header from "@/Pages/Header/Index.vue";
import Gridtemplate from "@/Layouts/Gridtemplate.vue";
import Testimonial from "@/Layouts/Testimonial.vue";
import Footer from "@/Layouts/Footer.vue";

import { ref } from 'vue'
import { Dialog, DialogPanel, DialogTitle, DialogDescription, TransitionRoot, TransitionChild } from '@headlessui/vue'

const isOpen = ref(false)
const reservationData = ref({
  name: '',
  email: '',
  phone: '',
  date: '',
  time: '',
  guests: 2,
  specialRequests: ''
})

function openModal() {
  isOpen.value = true
}

function closeModal() {
  isOpen.value = false
}

function submitReservation() {
  // Handle form submission here
  console.log('Reservation submitted:', reservationData.value)
  closeModal()
}
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
</script>

<template>
    <div class=" w-screen overflow-x-hidden  min-h-screen flex flex-col">
        <section
            class="relative w-full min-h-[95vh] flex flex-col items-center justify-center text-center px-6 lg:px-16 py-16 md:py-32"
        >
        <!-- Background Image -->
        <div
        class="absolute inset-0 bg-cover bg-center"
        style="
                    background-image: url('images/keesha-s-kitchen-PqG32DYCTM8-unsplash.jpg');
                    "
            ></div>
            <div class="absolute inset-0 bg-oynx opacity-70"></div>
            
            <div  class=" absolute top-0 w-screen  ">  <Header class="w-full "  /></div>
          
            <!-- Content -->
            <div class="relative z-10 text-snow max-w-3xl">
                <h1 class="text-4xl md:text-6xl font-black uppercase leading-tight">
                    Your Table Awaits, or We'll Come to You!
                </h1>
                <p class="mt-4 text-lg md:text-xl">
                   Choose from the varieties of meal we have
                </p>
                <div class="mt-6 flex flex-col md:flex-row gap-4.5 items-center justify-center">
                    <Link
                         :href="route('dining')"
                        class="group px-6 py-3  bg-lighred/50 hover:bg-lighred/60 rounded-lg text-lg font-semibold transition inline-flex items-center"
                    >
                        Order Takeout
                        <i
                            class="fa-solid fa-arrow-right ml-2 transition-transform group-hover:translate-x-1"
                        ></i>
                </Link>
                    <a
                        href="#"  @click.prevent="openModal"
                        class="group px-6 py-3 bg-polynesian/50  hover:bg-polynesian/60 rounded-lg text-lg font-semibold transition inline-flex items-center"
                    >
                        Make a Reservation
                        <i
                            class="fa-solid fa-arrow-right ml-2 transition-transform group-hover:translate-x-1"
                        ></i>
                    </a>
                    
    <!-- Modal -->
    <TransitionRoot appear :show="isOpen" as="template">
      <Dialog as="div" @close="closeModal" class="relative z-100">
        <TransitionChild
          as="template"
          enter="duration-300 ease-out"
          enter-from="opacity-0"
          enter-to="opacity-100"
          leave="duration-200 ease-in"
          leave-from="opacity-100"
          leave-to="opacity-0"
        >
          <div class="fixed inset-0  bg-opacity-50" />
        </TransitionChild>

        <div class="fixed inset-0 overflow-y-auto">
          <div class="flex min-h-full items-center justify-center p-4 text-center">
            <TransitionChild
              as="template"
              enter="duration-300 ease-out"
              enter-from="opacity-0 scale-95"
              enter-to="opacity-100 scale-100"
              leave="duration-200 ease-in"
              leave-from="opacity-100 scale-100"
              leave-to="opacity-0 scale-95"
            >
              <DialogPanel
                class="w-full max-w-lg transform overflow-hidden rounded-2xl bg-sand-50 p-6 text-left align-middle shadow-xl transition-all"
              >
                <DialogTitle
                  as="h3"
                  class="text-2xl font-bold leading-6 text-african-sunset mb-4 flex items-center"
                >
                  <i class="fa-solid fa-utensils mr-2"></i>
                  Reserve Your Table
                </DialogTitle>

                <form @submit.prevent="submitReservation">
                  <div class="space-y-4">
                    <div>
                      <label class="block text-sm font-medium text-african-earth mb-1">Full Name</label>
                      <input
                        v-model="reservationData.name"
                        required
                        type="text"
                        class="w-full px-3 py-2 border border-african-earth/30 rounded-md focus:outline-none focus:ring-2 focus:ring-polynesian"
                      >
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                      <div>
                        <label class="block text-sm font-medium text-african-earth mb-1">Email</label>
                        <input
                          v-model="reservationData.email"
                          required
                          type="email"
                          class="w-full px-3 py-2 border border-african-earth/30 rounded-md focus:outline-none focus:ring-2 focus:ring-polynesian"
                        >
                      </div>
                      <div>
                        <label class="block text-sm font-medium text-african-earth mb-1">Phone</label>
                        <input
                          v-model="reservationData.phone"
                          required
                          type="tel"
                          class="w-full px-3 py-2 border border-african-earth/30 rounded-md focus:outline-none focus:ring-2 focus:ring-polynesian"
                        >
                      </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                      <div>
                        <label class="block text-sm font-medium text-african-earth mb-1">Date</label>
                        <input
                          v-model="reservationData.date"
                          required
                          type="date"
                          class="w-full px-3 py-2 border border-african-earth/30 rounded-md focus:outline-none focus:ring-2 focus:ring-polynesian"
                        >
                      </div>
                      <div>
                        <label class="block text-sm font-medium text-african-earth mb-1">Time</label>
                        <input
                          v-model="reservationData.time"
                          required
                          type="time"
                          class="w-full px-3 py-2 border border-african-earth/30 rounded-md focus:outline-none focus:ring-2 focus:ring-polynesian"
                        >
                      </div>
                    </div>

                    <div>
                      <label class="block text-sm font-medium text-african-earth mb-1">Number of Guests</label>
                      <select
                        v-model="reservationData.guests"
                        class="w-full px-3 py-2 border border-african-earth/30 rounded-md focus:outline-none focus:ring-2 focus:ring-polynesian"
                      >
                        <option v-for="n in 8" :value="n" :key="n">{{ n }} {{ n === 1 ? 'person' : 'people' }}</option>
                        <option value="9">9+ people</option>
                      </select>
                    </div>

                    <div>
                      <label class="block text-sm font-medium text-african-earth mb-1">Special Requests</label>
                      <textarea
                        v-model="reservationData.specialRequests"
                        rows="3"
                        class="w-full px-3 py-2 border border-african-earth/30 rounded-md focus:outline-none focus:ring-2 focus:ring-polynesian"
                      ></textarea>
                    </div>
                  </div>

                  <div class="mt-6 flex justify-between">
                    <button
                      type="button"
                      @click="closeModal"
                      class="px-4 py-2 text-sm font-medium text-african-earth hover:text-african-sunset"
                    >
                      Cancel
                    </button>
                    <button
                      type="submit"
                      class="px-6 py-2 bg-polynesian/50 text-snow rounded-md  transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-polynesian"
                    >
                      Confirm Reservation
                    </button>
                  </div>
                </form>
              </DialogPanel>
            </TransitionChild>
          </div>
        </div>
      </Dialog>
    </TransitionRoot>
                </div>
            </div>
        </section>

        <section class="px-8 my-16 container">
            <div class="w-full flex justify-between items-center">
                <h1 class="text-start font-semibold text-2xl md:text-4xl text-polynesian">
                    Popular Dishes
                </h1>
                <a
                    href="#"
                    class="px-6 py-3 text-lighred/50 font-semibold rounded-lg hover:text-lighred/60 transition"
                    >All</a
                >
            </div>

            <div
                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-5"
            >
                <!-- CARD 1 -->
                <div
                    class="rounded-lg overflow-hidden border border-gray-300 shadow-lg flex flex-col bg-snow"
                >
                    <div class="relative">
                        <img
                            class="w-full h-56 object-cover"
                            src="images/keesha-s-kitchen-woC24wGXsQ8-unsplash.jpg"
                            alt="Simplest Salad Recipe"
                        />
                        <div
                            class="absolute inset-0 bg-oynx opacity-25 hover:opacity-0 transition"
                        ></div>
                        <div
                            class="text-xs absolute top-2 right-2 bg-lighred/50 px-3 py-1 text-snow rounded-lg"
                        >
                            #1
                        </div>
                    </div>
                    <div class="px-6 py-4 flex-grow">
                        <h2
                            class="font-semibold text-lg hover:text-lighred/60 transition"
                        >
                            Jollof Rice
                        </h2>
                        <p class="text-gray-500 text-sm mt-1">
                           Often considered the "king" of Nigerian cuisine, Jollof Rice is a vibrant, savory, one-pot rice dish cooked in a flavorful tomato and pepper sauce.
                        </p>
                    </div>
                   
                </div>

                <!-- CARD 2 -->
                <div
                    class="rounded-lg overflow-hidden shadow-lg border border-gray-300 flex flex-col bg-snow"
                >
                    <div class="relative">
                        <img
                            class="w-full h-56 object-cover"
                            src="images/soup.png"
                            alt="FastFood Ideas"
                        />
                        <div
                            class="absolute inset-0 bg-oynx opacity-25 hover:opacity-0 transition"
                        ></div>
                        <div
                            class="text-xs absolute top-2 right-2 bg-lighred/50 px-3 py-1 text-snow rounded-lg"
                        >
                            #2
                        </div>
                    </div>
                    <div class="px-6 py-4 flex-grow">
                        <h2
                            class="font-semibold text-lg hover:text-lighred/60 transition"
                        >
                            Soup
                        </h2>
                        <p class="text-gray-500 text-sm mt-1">
                            soups are a culinary delight! They're known for their incredible richness, diverse flavors, and comforting warmth, truly the heart of Nigerian cuisine.
                        </p>
                    </div>
                  
                </div>

                <!-- CARD 3 -->
                <div
                    class="rounded-lg overflow-hidden shadow-lg border border-gray-300 flex flex-col bg-snow"
                >
                    <div class="relative">
                        <img
                            class="w-full h-56 object-cover"
                            src="images/poundedyam.png"
                            alt="Why to eat salad?"
                        />
                        <div
                            class="absolute inset-0 bg-oynx opacity-25 hover:opacity-0 transition"
                        ></div>
                        <div
                            class="text-xs absolute top-2 right-2 bg-lighred/50 px-3 py-1 text-snow rounded-lg"
                        >
                            #3
                        </div>
                    </div>
                    <div class="px-6 py-4 flex-grow">
                        <h2
                            class="font-semibold text-lg hover:text-lighred/60 transition"
                        >
                            Pounded Yam
                        </h2>
                        <p class="text-gray-500 text-sm mt-1">
                           Pounded Yam is a beloved Nigerian staple, celebrated for its smooth, dough-like texture and mild, earthy flavor. It's the perfect "swallow" to accompany rich, flavorful Nigerian soups!
                        </p>
                    </div>
                    
                </div>
            </div>
        </section>
        <div class="py-10 " >
            <Gridtemplate></Gridtemplate>
        </div>
        
        <div class="py-10 " >
           <!-- https://gist.github.com/goodreds/3d044027175954984fb96c7407a955ab -->

<!-- Container -->
<div class="relative flex flex-col items-center mx-auto lg:flex-row-reverse lg:max-w-5xl lg:mt-12 xl:max-w-6xl ">

    <!-- Image Column -->
    <div class="w-full h-64 lg:w-1/2 lg:h-auto">
        <img class="h-full w-full object-cover" src="images/keesha-s-kitchen-3gbiqiGJYUc-unsplash.jpg" alt="Winding mountain road">
    </div>
    <!-- Close Image Column -->

    <!-- Text Column -->
    <div
        class="max-w-lg container md:max-w-2xl md:z-10 md:shadow-lg md:absolute md:top-0 md:mt-48 lg:w-3/5 lg:left-0 lg:mt-20 lg:ml-20 xl:mt-24 xl:ml-12">
        <!-- Text Wrapper -->
        
            <Testimonial></Testimonial>
        
        <!-- Close Text Wrapper -->
    </div>
    <!-- Close Text Column -->

</div>
        </div>

    </div>

    <Footer />
</template>

<style scoped>
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');

/* Custom colors - add these to your Tailwind config */
.bg-polynesian {
  background-color: #1a3a5f;
}
.bg-polynesian\/50 {
  background-color: rgba(26, 58, 95, 0.5);
}
.bg-polynesian\/60 {
  background-color: rgba(26, 58, 95, 0.6);
}
.bg-polynesian-dark {
  background-color: #0f2540;
}
.bg-sand-50 {
  background-color: #faf5eb;
}
.text-african-sunset {
  color: #e76f51;
}
.text-african-earth {
  color: #5d4037;
}
</style>
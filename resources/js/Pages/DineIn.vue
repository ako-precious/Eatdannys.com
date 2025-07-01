<script setup>
import { Head, Link } from "@inertiajs/vue3";

import Meal from "./Meal.vue";
import Header from "@/Pages/Header/Index.vue";
import Gridtemplate from "@/Layouts/Gridtemplate.vue";
import Background from "@/Layouts/Background.vue";
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
    <div class="w-full min-h-screen">
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
                <div class="mt-6">
                    <a
                        href="#"
                        class="group px-6 py-3 bg-lighred/50 hover:bg-lighred/60 rounded-lg text-lg font-semibold transition inline-flex items-center mr-2"
                    >
                        Order Takeout
                        <i
                            class="fa-solid fa-arrow-right ml-2 transition-transform group-hover:translate-x-1"
                        ></i>
                    </a>
                    <a
                        href="#"
                        class="group px-6 py-3 bg-polynesian/50  hover:bg-polynesian/60 rounded-lg text-lg font-semibold transition inline-flex items-center ml-2"
                    >
                        Make a Reservation
                        <i
                            class="fa-solid fa-arrow-right ml-2 transition-transform group-hover:translate-x-1"
                        ></i>
                    </a>
                </div>
            </div>
        </section>

        <section class="px-8 my-16">
            <div class="w-full flex justify-between items-center">
                <h1 class="text-start font-semibold text-2xl md:text-4xl">
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
                            src="https://images.pexels.com/photos/61180/pexels-photo-61180.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
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
                            Simplest Salad Recipe
                        </h2>
                        <p class="text-gray-500 text-sm mt-1">
                            A fresh and healthy salad recipe that's easy to
                            prepare.
                        </p>
                    </div>
                    <div class="px-6 py-3 flex justify-between bg-gray-100">
                        <button
                            class="px-4 py-2 text-lighred/50 border border-lighred/50 rounded-lg hover:bg-lighred/50 hover:text-snow transition"
                        >
                            View
                        </button>
                        <button
                            class="px-4 py-2 bg-lighred/50 text-snow rounded-lg hover:bg-lighred/60 transition"
                        >
                            Add <i class="fa-solid fa-cart-plus"></i>
                        </button>
                    </div>
                </div>

                <!-- CARD 2 -->
                <div
                    class="rounded-lg overflow-hidden shadow-lg border border-gray-300 flex flex-col bg-snow"
                >
                    <div class="relative">
                        <img
                            class="w-full h-56 object-cover"
                            src="https://images.pexels.com/photos/1600727/pexels-photo-1600727.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
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
                            Best FastFood Ideas
                        </h2>
                        <p class="text-gray-500 text-sm mt-1">
                            Quick and delicious fast food ideas to try at home.
                        </p>
                    </div>
                    <div class="px-6 py-3 flex justify-between bg-gray-100">
                        <button
                            class="px-4 py-2 text-lighred/50 border border-lighred/50 rounded-lg hover:bg-lighred/50 hover:text-snow transition"
                        >
                            View
                        </button>
                        <button
                            class="px-4 py-2 bg-lighred/50 text-snow rounded-lg hover:bg-lighred/60 transition"
                        >
                            Add <i class="fa-solid fa-cart-plus"></i>
                        </button>
                    </div>
                </div>

                <!-- CARD 3 -->
                <div
                    class="rounded-lg overflow-hidden shadow-lg border border-gray-300 flex flex-col bg-snow"
                >
                    <div class="relative">
                        <img
                            class="w-full h-56 object-cover"
                            src="https://images.pexels.com/photos/6086/food-salad-healthy-vegetables.jpg?auto=compress&cs=tinysrgb&dpr=1&w=500"
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
                            Why to eat salad?
                        </h2>
                        <p class="text-gray-500 text-sm mt-1">
                            The benefits of including fresh salads in your daily
                            diet.
                        </p>
                    </div>
                    <div class="px-6 py-3 flex justify-between bg-gray-100">
                        <button
                            class="px-4 py-2 text-lighred/50 border border-lighred/50 rounded-lg hover:bg-lighred/50 hover:text-snow transition"
                        >
                            View
                        </button>
                        <button
                            class="px-4 py-2 bg-lighred/50 text-snow rounded-lg hover:bg-lighred/60 transition"
                        >
                            Add <i class="fa-solid fa-cart-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </section>
        <div class="py-10 min-h" >
            <Gridtemplate></Gridtemplate>
        </div>
    </div>
</template>

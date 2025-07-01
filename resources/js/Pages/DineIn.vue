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
        <div class="py-10 " >
            <Gridtemplate></Gridtemplate>
        </div>
        
        <div class="py-10 " >
           <!-- https://gist.github.com/goodreds/3d044027175954984fb96c7407a955ab -->

<!-- Container -->
<div class="relative flex flex-col items-center mx-auto lg:flex-row-reverse lg:max-w-5xl lg:mt-12 xl:max-w-6xl">

    <!-- Image Column -->
    <div class="w-full h-64 lg:w-1/2 lg:h-auto">
        <img class="h-full w-full object-cover" src="images/keesha-s-kitchen-3gbiqiGJYUc-unsplash.jpg" alt="Winding mountain road">
    </div>
    <!-- Close Image Column -->

    <!-- Text Column -->
    <div
        class="max-w-lg bg-white md:max-w-2xl md:z-10 md:shadow-lg md:absolute md:top-0 md:mt-48 lg:w-3/5 lg:left-0 lg:mt-20 lg:ml-20 xl:mt-24 xl:ml-12">
        <!-- Text Wrapper -->
        <div class="flex flex-col p-12 md:px-16">
            <h2 class="text-2xl font-medium uppercase text-polynesian lg:text-4xl">Testimonials</h2>
          <figure class="relative rounded-2xl bg-white p-6 shadow-xl shadow-slate-900/10">
    <svg aria-hidden="true" width="105" height="78" class="absolute top-6 left-6 fill-slate-100">
        <path
            d="M25.086 77.292c-4.821 0-9.115-1.205-12.882-3.616-3.767-2.561-6.78-6.102-9.04-10.622C1.054 58.534 0 53.411 0 47.686c0-5.273.904-10.396 2.712-15.368 1.959-4.972 4.746-9.567 8.362-13.786a59.042 59.042 0 0 1 12.43-11.3C28.325 3.917 33.599 1.507 39.324 0l11.074 13.786c-6.479 2.561-11.677 5.951-15.594 10.17-3.767 4.219-5.65 7.835-5.65 10.848 0 1.356.377 2.863 1.13 4.52.904 1.507 2.637 3.089 5.198 4.746 3.767 2.41 6.328 4.972 7.684 7.684 1.507 2.561 2.26 5.5 2.26 8.814 0 5.123-1.959 9.19-5.876 12.204-3.767 3.013-8.588 4.52-14.464 4.52Zm54.24 0c-4.821 0-9.115-1.205-12.882-3.616-3.767-2.561-6.78-6.102-9.04-10.622-2.11-4.52-3.164-9.643-3.164-15.368 0-5.273.904-10.396 2.712-15.368 1.959-4.972 4.746-9.567 8.362-13.786a59.042 59.042 0 0 1 12.43-11.3C82.565 3.917 87.839 1.507 93.564 0l11.074 13.786c-6.479 2.561-11.677 5.951-15.594 10.17-3.767 4.219-5.65 7.835-5.65 10.848 0 1.356.377 2.863 1.13 4.52.904 1.507 2.637 3.089 5.198 4.746 3.767 2.41 6.328 4.972 7.684 7.684 1.507 2.561 2.26 5.5 2.26 8.814 0 5.123-1.959 9.19-5.876 12.204-3.767 3.013-8.588 4.52-14.464 4.52Z">
        </path>
    </svg>
    <blockquote class="relative">
        <p class="text-lg tracking-tight text-slate-900">
            Awesome idea. Can't wait to see how this turns out!
        </p>
    </blockquote>
    <figcaption class="relative mt-6 flex items-center justify-between border-t border-slate-100 pt-6">
        <div>
            <div class="font-display text-base text-slate-900">Exmaple name</div>
            <div class="mt-1 text-sm text-slate-500">Job designation</div>
        </div>
        <div class="overflow-hidden rounded-full bg-slate-50">
            <img alt="" src="https://i.pravatar.cc/300" class="h-14 w-14 object-cover" loading="lazy" width="56" height="56">
        </div>
    </figcaption>
</figure>
        </div>
        <!-- Close Text Wrapper -->
    </div>
    <!-- Close Text Column -->

</div>
        </div>

    </div>
</template>

<script setup>
import { Head, Link } from "@inertiajs/vue3";

import Header from "@/Pages/Header/Index.vue";
import Gridtemplate from "@/Layouts/Gridtemplate.vue";
import Testimonial from "@/Layouts/Testimonial.vue";
import Footer from "@/Layouts/Footer.vue";

import { ref } from 'vue'
import Reservation from "@/Layouts/Reservation.vue";

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
                   <Reservation></Reservation>
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


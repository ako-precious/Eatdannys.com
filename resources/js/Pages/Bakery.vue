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
     
<section class="relative w-full min-h-[95vh] flex flex-col items-center justify-center text-center px-6 lg:px-16 py-16 md:py-32">
    <!-- Background Video -->
    <video 
        class="absolute inset-0 w-full h-full object-cover"
        autoplay 
        muted 
        loop 
        playsinline
        onloadedmetadata="this.playbackRate = 0.5"
    >
        <source src="images/bakerys.mp4" type="video/mp4">
        <!-- <source src="videos/your-video-file.webm" type="video/webm"> -->
        <!-- Fallback image in case video doesn't load -->
        Your browser does not support the video tag.
    </video>
    
    <!-- Dark overlay for better text readability -->
    <div class="absolute inset-0 bg-oynx opacity-70"></div>
    
    <!-- Header -->
    <div class="absolute top-0 w-screen">
        <Header class="w-full" />
    </div>
     
    <!-- Content -->
    <div class="relative z-10 text-snow max-w-3xl">
        <h1 class="text-5xl md:text-7xl font-black uppercase leading-tight">
            Coming Soon
            <br> Stay Tunned 
           
        </h1>
       
    </div>
</section>
     
      

    </div>

    <Footer />
</template>


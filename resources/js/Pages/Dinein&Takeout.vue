<script setup>
import { Head, Link } from "@inertiajs/vue3";

import Meal from "./Meal.vue";
import Header from "@/Pages/Header/Index.vue";
import Gridtemplate from "@/Layouts/Gridtemplate.vue";
import Testimonial from "@/Layouts/Testimonial.vue";
import Footer from "@/Layouts/Footer.vue";
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
                        href="#"
                        class="group px-6 py-3 bg-polynesian/50  hover:bg-polynesian/60 rounded-lg text-lg font-semibold transition inline-flex items-center"
                    >
                        Make a Reservation
                        <i
                            class="fa-solid fa-arrow-right ml-2 transition-transform group-hover:translate-x-1"
                        ></i>
                    </a>
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
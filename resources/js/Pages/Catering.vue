<script setup>
import { Head, Link } from "@inertiajs/vue3";

import Header from "@/Pages/Header/Index.vue";
import Gridtemplate from "@/Layouts/Gridtemplate.vue";
import Testimonial from "@/Layouts/Testimonial.vue";
import Footer from "@/Layouts/Footer.vue";

import { ref } from 'vue'
import Reservation from "@/Layouts/Reservation.vue";
import CartingCard from "@/Layouts/CartingCard.vue";

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
    <div class=" w-screen overflow-x-hidden bg-oynx  min-h-screen flex flex-col">
        
        <div  class=" absolute top-0 w-screen  ">  <Header class="w-full  z-100 "  /></div>
        <section
            class="fixed w-full min-h-[95vh] z-0  flex flex-col items-center justify-center text-center px-6 lg:px-16 py-16 "
        >  <div  class="absolute -inset-100  opacity-10 animate"></div>
       
        <!-- Background Image -->
               
          
            <!-- Content -->
            <div class="relative z-10 text-snow min-h-screen p-6">
                <h1 class="text-4xl md:text-[14vw] font-black uppercase  text-nowrap pt-30">
                    EAT DANNy's
                </h1>
                <div class="flex items-end  h-[40vh] w-[35vw] ">
                    

                        <p class="mt-4 text-lg md:text-xl   left-0 right-0 mx-auto max-w-2xl text-left">
                           
                           Welcome to our catering service! 👋 We are dedicated to providing you with the best culinary experience for your events. 🍽️✨ Whether it's a wedding 💒, corporate gathering 🏢, or private party 🎉, we have a wide range of delicious options 😋 to suit your needs.  </p>
                       
                           
                    
                
                </div>
                
            </div>
        </section>

        <section class="px-8 mt-[350px] z-10 flex flex-col md:flex-row justify-between  p-16">
            <div class="max-w-[50vh] w-[50vh]">  </div>
           <CartingCard> <template #first>
        <div>
            
        </div>
      </template>
      
      <template #second>
        <h2>This goes in the second content area</h2>
        <p>Any content for the second slot</p>
      </template></CartingCard>
        </section>
       
        
      

        <Footer class="z-10" />
    </div>
</template>


<style scoped>
.animate {
 position: absolute;
  z-index: -1;
    animation: identifier 0.3s linear infinite both;
    background-image: url("images/noise.png");
}
@keyframes identifier {
  0% {
    transform: translateX(10%) translateY(10%);
  }
  100% {
    transform: translateX(-10%) translateY(-10%);
  }
    
}
</style>
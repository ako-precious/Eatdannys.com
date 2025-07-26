<script setup>
import { Head, Link } from "@inertiajs/vue3";

import Header from "@/Pages/Header/Index.vue";
import Gridtemplate from "@/Layouts/Gridtemplate.vue";
import Testimonial from "@/Layouts/Testimonial.vue";
import Footer from "@/Layouts/Footer.vue";

import { ref } from "vue";
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
    <div
        class="w-screen overflow-x-hidden bg-oynx lg:min-h-screen flex flex-col"
    >
        <div class="absolute top-0 w-screen">
            <Header class="w-full z-100" />
        </div>
        <section
            class="lg:fixed w-full lg:min-h-[95vh] z-0 flex flex-col items-center justify-center text-center px-6 lg:px-16"
        >
            <div class="absolute -inset-100 opacity-5 animate"></div>

            <!-- Background Image -->

            <!-- Content -->
            <div class="relative z-10 text-snow lg:min-h-screen p-6">
                <h1
                    class="text-[14vw] font-black uppercase lg:text-nowrap pt-30"
                >
                    EAT DANNy's
                </h1>
                <div class="flex lg:items-end lg:h-[30vh] lg:w-[35vw]">
                    <p
                        class="mt-4 text-lg md:text-xl left-0 right-0 mx-auto max-w-2xl text-left"
                    >
                        Welcome to our catering service! 👋 We are dedicated to
                        providing you with the best culinary experience for your
                        events. 🍽️✨ Whether it's a wedding 💒, corporate
                        gathering 🏢, or private party 🎉, we have a wide range
                        of delicious options 😋 to suit your needs.
                    </p>
                </div>
            </div>
        </section>

        <section
            class="px-16 lg:mt-[430px] z-10 flex flex-col lg:flex-row justify-center lg:justify-between text-snow items-end relative"
        >
        <div class="w-[90vw] md:w-[50vw] bg-transparent"></div>
        <div
        class="flex flex-col gap-4 items-center bg-oynx min-h-screen w-[85vw] lg:w-[50vw]"
        >
       
                <div class="flex flex-col gap-4 w-full">
                    <CartingCard class="relative h-full overflow-hidden">
                        <template #first>
                            <div
                                class="absolute inset-0 bg-cover bg-center"
                                style="
                                    background-image: url('images/wedding.jpg');
                                "
                            ></div>
                            <div
                                class="absolute inset-0 bg-oynx opacity-50"
                            ></div>
                        </template>

                        <template #second>
                            <video
                                class="absolute inset-0 w-full h-[90vh] object-cover rounded-[15px]"
                                autoplay
                                muted
                                loop
                                playsinline
                                onloadedmetadata="this.playbackRate = 0.5"
                            >
                                <source
                                    src="images/wedding.mp4"
                                    type="video/mp4"
                                />
                                <!-- <source src="videos/your-video-file.webm" type="video/webm"> -->
                                <!-- Fallback image in case video doesn't load -->
                                Your browser does not support the video tag.
                            </video>
                        </template>
                    </CartingCard>
                    <div class="py-6">
                        <h1
                            class="text-xl md:text-4xl font-black uppercase leading-tight"
                        >
                            Wedding Cermony
                        </h1>
                        <p class="mt-4 text-sm md:text-lg max-w-4xl">
                            Your dream day deserves a culinary masterpiece. From
                            elegant plated dinners to lavish buffets, we work
                            with you to create a menu as unique as your love
                            story.
                        </p>
                    </div>
                </div>
                <div class="flex flex-col m gap-4 w-full">
                    <CartingCard class="relative h-full overflow-hidden">
                        <template #first>
                           <div
                                class="absolute inset-0 bg-cover bg-center z-10"
                                style="
                                    background-image: url('images/anniversary.jpg');
                                "
                            ></div>
                            <div
                                class="absolute inset-0 bg-oynx opacity-50"
                            ></div>  
                        </template>

                        <template #second>
                           <video
                                class="absolute inset-0 w-full h-[90vh] object-cover rounded-[15px]"
                                autoplay
                                muted
                                loop
                                playsinline
                                onloadedmetadata="this.playbackRate = 0.5"
                            >
                                <source
                                    src="images/anniversary.mp4"
                                    type="video/mp4"
                                />
                                <!-- <source src="videos/your-video-file.webm" type="video/webm"> -->
                                <!-- Fallback image in case video doesn't load -->
                                Your browser does not support the video tag.
                            </video>
                        </template>
                    </CartingCard>
                    <div class="py-6">
                        <h1
                            class="text-xl md:text-4xl font-black uppercase leading-tight"
                        >
                            Anniversary Cermony
                        </h1>
                        <p class="mt-4 text-sm md:text-lg max-w-4xl">
                            Celebrate life's milestones with delectable food
                            that delights every guest. Fun and vibrant, or
                            sophisticated and chic – we cater to your style.
                        </p>
                    </div>
                </div>
                <div class="flex flex-col m gap-4 w-full">
                    <CartingCard class="relative h-full overflow-hidden">
                        <template #first>
                           <div
                                class="absolute inset-0 bg-cover bg-center"
                                style="
                                    background-image: url('images/birthday.jpg');
                                "
                            ></div>
                            <div
                                class="absolute inset-0 bg-oynx opacity-50"
                            ></div> 
                        </template>

                        <template #second>
                            <video
                                class="absolute inset-0 w-full h-[90vh] object-cover rounded-[15px]"
                                autoplay
                                muted
                                loop
                                playsinline
                                onloadedmetadata="this.playbackRate = 0.5"
                            >
                                <source
                                    src="images/birthday.mp4"
                                    type="video/mp4"
                                />
                                <!-- <source src="videos/your-video-file.webm" type="video/webm"> -->
                                <!-- Fallback image in case video doesn't load -->
                                Your browser does not support the video tag.
                            </video>
                        </template>
                    </CartingCard>
                    <div class="py-6">
                        <h1
                            class="text-xl md:text-4xl font-black uppercase leading-tight"
                        >
                            Birthday Cermony
                        </h1>
                        <p class="mt-4 text-sm md:text-lg max-w-4xl">
                            Celebrate life's milestones with delectable food
                            that delights every guest. Fun and vibrant, or
                            sophisticated and chic – we cater to your style.
                        </p>
                    </div>
                </div>
                <div class="flex flex-col m gap-4 w-full">
                    <CartingCard class="relative h-full overflow-hidden">
                        <template #first>
                           <div
                                class="absolute inset-0 bg-cover bg-center"
                                style="
                                    background-image: url('images/foodboxing.png');
                                "
                            ></div>
                            <div
                                class="absolute inset-0 bg-oynx opacity-50"
                            ></div> 
                        </template>

                        <template #second>
                            <video
                                class="absolute inset-0 w-full h-[90vh] object-cover rounded-[15px]"
                                autoplay
                                muted
                                loop
                                playsinline
                                onloadedmetadata="this.playbackRate = 0.5"
                            >
                                <source
                                    src="images/foodboxing.mp4"
                                    type="video/mp4"
                                />
                                <!-- <source src="videos/your-video-file.webm" type="video/webm"> -->
                                <!-- Fallback image in case video doesn't load -->
                                Your browser does not support the video tag.
                            </video>
                        </template>
                    </CartingCard>
                    <div class="py-6">
                        <h1
                            class="text-xl md:text-4xl font-black uppercase leading-tight"
                        >
                            Food Boxing
                        </h1>
                        <p class="mt-4 text-sm md:text-lg max-w-4xl">
                            Individually portioned gourmet meals, freshly
                            prepared and perfectly packaged for corporate
                            meetings, team lunches, or group outings. Choose
                            from a variety of balanced and delicious options.
                        </p>
                        <p class="mt-4 text-sm md:text-lg max-w-4xl">
                            You can get all these and more. just contact us on
                            and we will make your day
                        </p>
                    </div>
                </div>
                
            </div>
        </section>

        <!--  -->

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

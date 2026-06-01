<script setup>
import { Head } from "@inertiajs/vue3";
import Meal from "./Meal.vue";
import ScrollToTop from "@/Components/ScrollToTop.vue";
import CartSlideOver from "./Header/CartSlideOver.vue";
import Background from "@/Layouts/Background.vue";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
});
</script>

<template>
    <Head title="Bulk & Catering Orders — Danny's" />
    <Background>

        <!-- Hero banner -->
        <section class="relative bg-oynx overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-oynx via-oynx/90 to-transparent"></div>
            <div class="relative z-10 max-w-4xl mx-auto px-6 py-16 text-center">
                <span class="inline-block bg-persian/20 text-persian text-xs font-bold uppercase tracking-widest px-3 py-1 rounded-full mb-4">
                    Bulk &amp; Catering
                </span>
                <h1 class="text-4xl md:text-5xl font-black text-snow leading-tight">
                    Feed the Crowd with<br class="hidden md:block" />
                    Authentic Nigerian Flavours
                </h1>
                <p class="mt-4 text-lg text-snow/70 max-w-xl mx-auto">
                    Available in 2L, 3L, and 6L portions — perfect for events, family gatherings, and corporate catering.
                </p>
                <div class="mt-6 flex items-center justify-center gap-6 text-snow/60 text-sm">
                    <span class="flex items-center gap-2">
                        <i class="fa-solid fa-truck-fast text-persian"></i> Fast delivery
                    </span>
                    <span class="flex items-center gap-2">
                        <i class="fa-solid fa-leaf text-persian"></i> Fresh daily
                    </span>
                    <span class="flex items-center gap-2">
                        <i class="fa-solid fa-star text-persian"></i> 5-star rated
                    </span>
                </div>
            </div>
        </section>

        <main class="py-8">
            <Meal />
        </main>

        <CartSlideOver />
        <ScrollToTop />
    </Background>
</template>

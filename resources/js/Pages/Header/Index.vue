<script setup>
import { onMounted } from "vue";
import { Head, Link, usePage } from "@inertiajs/vue3";
import DropBarNav from "./DropBarNav.vue";
import Navbar from "./Navbar.vue";
import Dropdown from "@/Components/Dropdown.vue";
import CartIcon from "./CartIcon.vue";
import axios from "axios";
// import { route } from 'ziggy-js';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    pushSub: Boolean,
});
</script>

<script>
export default {
    inheritAttrs: false,

    data() {
        return {
            // meals: [],
            // page: 1, // Current page
            // perPage: 12, // Number of items per page
            // hasMoreData: true,
            isHeaderFixed: false,
        };
    },
    beforeDestroy() {
        window.removeEventListener("scroll", this.handleScroll);
    },
    computed: {
        // isSpecialOrderRoute() {
        //   return route().current('special-order');
        // },
        // isBulkRoute() {
        //   return route().current('bulk-meal');
        // },
        // isWelcome() {
        //   return route().current('welcome');
        // },
    },

    mounted() {
        window.addEventListener("scroll", this.handleScroll);
        // if (this.$page.props.auth.user) {
        //     if (
        //         this.$page.props.auth.user.phone_number == null ||
        //         this.$page.props.auth.user.address == null
        //     ) {
        //         this.$inertia.visit(`/user/profile`);
        //     }
        // }
    },
    created() {
        this.handleScroll();
    },
    methods: {
        handleScroll() {
            // Adjust the scroll threshold as needed
            const scrollThreshold = 50;            
            this.isHeaderFixed = window.scrollY > scrollThreshold;
        },
    },
};
</script>

<template>
    <div class="  ">
       
        <header
            :class="{
                'fix align-bottom shadow-sm py-4 px-8 bg-snow dark:bg-oynx text-oynx dark:text-snow': isHeaderFixed,
            }"
            class="py-5  z-10 transition-all duration-300 delay-75 ease-in animate-fade-in"
        >
            <Navbar class="">
                <template #search>
                    <div
                        class="w-full p-4 max-w-sm lg:max-w-lg 2xl:max-w-2xl rounded-md hidden md:flex items-center"
                    >
                        <div
                            v-if="!isHeaderFixed"
                            class="bg-transparent capitalize font-bold text-sm mr-4 flex justify-around w-full transition-all duration-300 delay-75 ease-in"
                            name=""
                            id=""
                        >
                            <Link
                                class="py-2 px-3 navbar-link"
                                :href="route('welcome')"
                            >
                                <p class="font-bold two">
                                    <span>Bulk </span>
                                    <span
                                        class="absolute bottom-1 left-1/2 w-0 transition-all h-1 bg-polynesian duration-250 ease-in"
                                    ></span>
                                    <span
                                        class="absolute bottom-1 right-1/2 w-0 transition-all h-1 bg-polynesian duration-250 ease-in"
                                    ></span>
                                </p>
                            </Link>
                            <Link
                                class="py-2 px-3 navbar-link"
                                :href="route('catering')"
                            >
                                <p class="font-bold two">
                                    <span>Catering </span>
                                    <span
                                        class="absolute bottom-1 left-1/2 w-0 transition-all h-1 bg-polynesian duration-250 ease-in"
                                    ></span>
                                    <span
                                        class="absolute bottom-1 right-1/2 w-0 transition-all h-1 bg-polynesian duration-250 ease-in"
                                    ></span>
                                </p>
                            </Link>
                           
                          
                            <Link
                                class="py-2 px-3 navbar-link"
                                :href="route('dining&takeout')"
                                ><p class="font-bold two">
                                    <span class="hidden text-nowrap lg:block">dining  & take out</span>
                                    <span  class="lg:hidden block">dining...</span>
                                    <span
                                        class="absolute bottom-1 left-1/2 w-0 transition-all h-1 bg-polynesian duration-250 ease-in"
                                    ></span>
                                    <span
                                        class="absolute bottom-1 right-1/2 w-0 transition-all h-1 bg-polynesian duration-250 ease-in"
                                    ></span></p
                            ></Link>
                            <Link
                                class="py-2 px-3 navbar-link"
                                :href="route('bakery')"><p class="font-bold two">
                                    <span>Bakery</span>
                                    <span
                                        class="absolute bottom-1 left-1/2 w-0 transition-all h-1 bg-polynesian duration-250 ease-in"
                                    ></span>
                                    <span
                                        class="absolute bottom-1 right-1/2 w-0 transition-all h-1 bg-polynesian duration-250 ease-in"
                                    ></span>
                                </p>
                            </Link>
                        </div>
                        <div
                            v-else="isHeaderFixed"
                            class="bg-transparent capitalize font-bold text-sm mr-4 flex justify-around w-full transition-all duration-300 delay-75 ease-in"
                            name=""
                            id=""
                        >
                            <Link
                                class="py-2 px-3 navbar-link text-oynx!"
                                :href="route('welcome')"
                                >
                                <p class="font-bold two">
                                    <span>Bulk </span>
                                    <span
                                    class="absolute bottom-1 left-1/2 w-0 transition-all h-1 bg-polynesian duration-250 ease-in"
                                    ></span>
                                    <span
                                    class="absolute bottom-1 right-1/2 w-0 transition-all h-1 bg-polynesian duration-250 ease-in"
                                    ></span>
                                </p>
                            </Link>
                           
                            <Link
                                class="py-2 px-3 navbar-link text-oynx!"
                                :href="route('welcome')"
                                >
                                <p class="font-bold two">
                                    <span>Catering </span>
                                    <span
                                    class="absolute bottom-1 left-1/2 w-0 transition-all h-1 bg-polynesian duration-250 ease-in"
                                    ></span>
                                    <span
                                    class="absolute bottom-1 right-1/2 w-0 transition-all h-1 bg-polynesian duration-250 ease-in"
                                    ></span>
                                </p>
                            </Link>
                           
                          
                            <Link
                                class="py-2 px-3 navbar-link text-oynx"
                                :href="route('dining&takeout')"
                                ><p class="font-bold two">
                                    <span class="hidden text-nowrap lg:block">dining  & take out</span>
                                    <span  class="lg:hidden block">dining...</span>
                                    <span
                                        class="absolute bottom-1 left-1/2 w-0 transition-all h-1 bg-polynesian duration-250 ease-in"
                                    ></span>
                                    <span
                                        class="absolute bottom-1 right-1/2 w-0 transition-all h-1 bg-polynesian duration-250 ease-in"
                                    ></span></p
                            ></Link>
                            <Link
                                class="py-2 px-3 navbar-link text-oynx"
                                :href="route('bakery')"><p class="font-bold two">
                                    <span>Bakery</span>
                                    <span
                                        class="absolute bottom-1 left-1/2 w-0 transition-all h-1 bg-polynesian duration-250 ease-in"
                                    ></span>
                                    <span
                                        class="absolute bottom-1 right-1/2 w-0 transition-all h-1 bg-polynesian duration-250 ease-in"
                                    ></span>
                                </p>
                            </Link>
                        </div>
                        <slot name="search-content"></slot>
                    </div>
                </template>
                <template #dropdown>
                    
                   
                    <DropBarNav class="cursor-pointer "
                    :canLogin="canLogin"
                    :canRegister="canRegister"
                    :laravelVersion="laravelVersion"
                    :phpVersion="phpVersion"
                    />
                    <button @click="openCart">
  <CartIcon />
</button>
                  
                    
                </template>
            </Navbar>
            <slot name="extra-content"></slot>
        </header>
    </div>
</template>

<style scoped>
.fix {
    position: fixed;
    top: 0;
    right: 0;
    width: 100%;
    padding: 0.4rem 2rem;
    z-index: 1000; /* Adjust z-index as needed */
}
.two:hover span {
    width: 50%;
}
</style>

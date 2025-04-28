<script setup>
import { onMounted } from "vue";
import { Head, Link, usePage } from "@inertiajs/vue3";
import DropBarNav from "./DropBarNav.vue";
import Navbar from "./Navbar.vue";
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
            // isHeaderFixed: false,
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
        // window.addEventListener("scroll", this.handleScroll);
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
            const scrollThreshold = 20;
            this.isHeaderFixed = window.scrollY > scrollThreshold;
        },
        
    },
};
</script>


<template>
     <div class="  ">
        <!-- <div
            v-if="notificationPermission !== 'granted' && pushSub === false"
            class="bg-gray-500 m-auto"
        >
            <p
                @click="requestNotificationPermission"
                class="text-xs pl-10 capitalize cursor-pointer hover:underline py-1"
            >
                enable notification
            </p>
        </div> -->
        <header
            :class="{
                'fix align-bottom shadow-sm py-4 px-8 lg ': isHeaderFixed,
            }"
            class="py-5 bg-snow dark:bg-oynx z-990 transition-all duration-300 delay-75 ease-in animate-fade-in"
        >
            <Navbar class="bg-snow dark:bg-oynx">
                <template #search>
                    <div
                        class="w-full p-4 max-w-xs lg:max-w-lg 2xl:max-w-2xl bg-snow dark:bg-oynx rounded-md hidden lg:flex items-center"
                    >
                        <div
                            v-if="!isHeaderFixed"
                            class="bg-transparent capitalize font-bold text-sm mr-4 flex justify-around w-full transition-all duration-300 delay-75 ease-in"
                            name=""
                            id=""
                        >
                            <Link   :class="{ 'dark:text-snow text-oynx':  !isWelcome, 'border-b': isWelcome }"
                                class="py-2 px-3 navbar-link"
                                :href="route('welcome')"
                            >
                                <p>Explore</p>
                            </Link>
                            <Link   :class="{'dark:text-snow text-oynx':  !isBulkRoute,  'border-b ': isBulkRoute }"
                                class="py-2 px-3 navbar-link"
                                 :href="route('welcome')"
                            >
                                <p>Bulk Meal</p>
                            </Link>
                            <Link
                            
                            class="py-2 px-3 navbar-link"
                            :class="{ 'dark:text-snow text-oynx':  !isSpecialOrderRoute, 'border-b': isSpecialOrderRoute }"
                                 :href="route('welcome')"
                            >
                                <p>Special Meal</p>
                            </Link>
                        </div>
                        <slot  name="search-content"></slot>
                       
                    </div>
                </template>
                <template #dropdown>
                    <DropBarNav
                        :canLogin="canLogin"
                        :canRegister="canRegister"
                        :laravelVersion="laravelVersion"
                        :phpVersion="phpVersion"
                    />
                </template>
            </Navbar>
             <slot  name="extra-content"></slot>
          
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

</style>
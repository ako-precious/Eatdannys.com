<template>
    <div
        class="container mx-auto px-4 lg:px-10 flex justify-between items-center"
    >
        <!-- logo -->
        <div class="md:w-48 flex-shrink-0 flex items-center">
            
             <!-- Logo -->
             <Link :href="route('welcome')">
             <div class="w-full flex items-center">
                    <ApplicationMark class="block w-auto" />
                    <span
                        class="hidden md:block ml-2 font-bold transition-all duration-200 ease-in-out text-2xl uppercase text-oynx dark:text-snow"
                    >
                        Ounjemi
                    </span>
                </div>
            </Link>
               
        </div>
        
        <!-- search -->
        <slot name="search"></slot>

        <!-- buttons -->
        <nav class="contents">
            <ul class="ml-4 xl:w-48 flex items-center justify-end">
                <!-- hso -->
                <div v-if="!isLoading">
                <li v-if="check" class="text-nowrap py-2 px-4 navbar-link">
                    <Link :href="`/cook/menu`">
                        <a class="" href="">
                            <p>Your Menu</p>
                        </a>
                    </Link>
                </li>
                <li v-else class="text-nowrap py-2 px-4 navbar-link">
                    <Link :href="`/cook/setup`">
                        <a class="" href="">
                            <p>Be a Cook</p>
                        </a>
                    </Link>
                </li>
            </div>
            <li v-else class="text-nowrap py-2 px-4 navbar-link">
                <Link :href="`/cook/setup`">
                    <a class="" href="">
                        <p>Be a Cook</p>
                    </a>
                </Link>

            </li>
          
                <!-- <li class="navbar-link">
                    <a class="" href="">
                        <font-awesome-icon
                            icon="globe"
                            class="h-3 lg:h-4 p-2 svg-inline--fa fa-user fa-w-14 fa-9x"
                        />
                    </a>
                </li> -->
                  <slot name="dropdown"> </slot>
                <div class="sm uppercase:hidden px-4 flex items-center">
                    <a
                        mini-sidenav-burger=""
                        href="javascript:;"
                        class="sm uppercase:marker:hidden p-0 text-sm uppercase text-white transition-all ease-nav-brand block"
                        aria-expanded="false"
                    >
                        <Dropdown align="right" width="48">
                            <template #trigger>
                                <div class="w-4.5 overflow-hidden">
                                    <i
                                        class="ease mb-0.75 relative block h-0.5 rounded-sm uppercase bg-persian group-hover:bg-polynesian dark:group-hover:bg-lighred transition-all"
                                    ></i>
                                    <i
                                        class="ease mb-0.75 relative block h-0.5 rounded-sm uppercase bg-persian group-hover:bg-polynesian dark:group-hover:bg-lighred transition-all"
                                    ></i>
                                    <i
                                        class="ease relative block h-0.5 rounded-sm uppercase bg-persian group-hover:bg-polynesian dark:group-hover:bg-lighred transition-all"
                                    ></i>
                                </div>
                            </template>

                            <template #content class="bg-snow dark:bg-oynx">
                                <div
                                    class="origin-top-right absolute right-0 mt-2 w-48 delay-75 rounded-md border-snow ring-1 bg-gradient-to-br from-[#e3dedf] to-[#ffffff] -shadow-snow-sm uppercase hover:shadow-snow-sm uppercase dark:bg-gradient-to-br dark:from-[#2b312e] dark:to-[#333a37] dark:-shadow-oynx-sm uppercase hover:dark:shadow-oynx-sm uppercase z-20 transition-all duration-250 ease-in dark:border-oynx"
                                >
                                    <DropdownLink
                                        :href="route('welcome')"
                                        class="flex w-full items-center rounded-md px-4 py-2 text-sm uppercase text-oynx hover:text-polynesian dark:text-snow dark:hover:text-lighred cursor-pointer transition-all duration-200 ease-in-out"
                                    >
                                        <p>Bulk</p>
                                    </DropdownLink>
                                    <DropdownLink
                                         :href="route('welcome')"
                                        class="relative flex items-center rounded-md px-4 py-2 text-sm uppercase text-oynx hover:text-polynesian dark:text-snow dark:hover:text-lighred cursor-pointer transition-all duration-200 ease-in-out"
                                    >
                                        <p>Catering</p>
                                    </DropdownLink>
                                    <DropdownLink
                                         :href="route('welcome')"
                                        class="relative flex items-center rounded-md px-4 py-2 text-sm uppercase text-oynx hover:text-polynesian dark:text-snow dark:hover:text-lighred cursor-pointer transition-all duration-200 ease-in-out"
                                    >
                                        <p>dining and take out</p>
                                    </DropdownLink>
                                    <DropdownLink
                                          :href="route('welcome')"
                                        class="relative flex items-center rounded-md px-4 py-2 text-sm uppercase text-oynx hover:text-polynesian dark:text-snow dark:hover:text-lighred cursor-pointer transition-all duration-200 ease-in-out"
                                    >
                                        
                                            <p>bakery</p>
                                        
                                    </DropdownLink>
                                </div>
                             
                            </template>
                        </Dropdown>
                    </a>
                </div>
              
                
                <!-- <li  -->
            </ul>
        </nav>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import ApplicationMark from '@/Components/ApplicationMark.vue';
// import route from "vendor/tightenco/ziggy/src/js";

import DropdownLink from "@/Components/DropdownLink.vue";
import Dropdown from "@/Components/Dropdown.vue";
</script>

<script>
import axios from "axios";
export default {
    data() {
        return {
            check: false,
            notifications: '',            
            isLoading: true,
        };
    },
    created() {
       this.checkNotification();
        this.chekUser(); // Fetch images from the backend when the component is created
    },
    mounted(){
        this.chekUser()
    },
    methods: {
      async chekUser() {
          await axios
                .get("/checkUser")
                .then((response) => {
                    this.check = response.data.checkUser;
                })
                .catch((error) => {
                    // Handle error
                    console.error("Error saving data:", error);
                }).finally(() => {
                    // Set loading state to false when fetching completes
                    this.isLoading = false;
                });
        },
      async checkNotification() {
        await axios
                .get("/checkUser")
                .then((response) => {
                    this.notifications = response.data.notifications;
                })
                .catch((error) => {                    // Handle error
                    console.error("Error saving data:", error);
                });
        },
    },
};
</script>
<style>
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>

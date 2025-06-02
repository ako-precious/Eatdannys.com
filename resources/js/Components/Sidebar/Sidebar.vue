<template>
    <nav
        class="md:left-0 md:block md:fixed md:top-0 md:bottom-0 md:flex-row md:flex-nowrap  md:max-h-screen bg-snow shadow-xl text-oynx  flex flex-wrap items-center justify-between relative md:w-64 z-10 py-4 px-6 pr-2"
    >
        <!-- Toggler -->
        <button
            class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
            type="button"
            v-on:click="toggleCollapseShow('bg-snow m-2 py-3 px-6')"
        > <font-awesome-icon icon="fa-solid fa-bars" /> </button>
        <!-- Brand -->
        <Link
            class="text-left md:pb-2 text-blueGray-600 mr-0 flex justify-center items-center whitespace-nowrap text-sm uppercase font-bold p-4 px-0 "
            href="/"
        >
            <ApplicationLogo class="w-16 h-14"></ApplicationLogo>
        </Link>
        <!-- User -->
    
        <div
            class="md:flex-col md:overflow-y-auto md:items-stretch md:max-h-80/100 pb-10 md:flex-nowrap px-0 flex flex-wrap items-center justify-between w-full mx-auto border border-solid border-transparent"
        >
            <ul class="md:hidden items-center flex flex-wrap list-none">
                <li class="inline-block relative">
                    <notification-dropdown />
                </li>
                <li class="inline-block relative">
                    <user-dropdown />
                </li>
            </ul>
            <!-- Collapse -->
            <div
                class="md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:mt-4 md:shadow-none shadow absolute top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-auto items-center flex-1 rounded"
                v-bind:class="collapseShow"
            >
                <!-- Collapse header -->
                <div
                    class="md:min-w-full md:hidden block pb-4 mb-4 "
                >
                    <div class="flex flex-wrap justify-around items-center">
                        <div class="w-8/12 ">
                            <Link
                                class="text-left md:pb-2 text-blueGray-600 mr-0 flex justify-center items-center whitespace-nowrap text-sm uppercase font-bold p-4 px-0"
                                href="/"
                            >
                                <img src="/images/logo.png" class="rounded-full w-24 h-24" alt="">
                                    
                              
                            </Link>
                        </div>
                        <div class="w-4/12 flex justify-end">
                            <button
                                type="button"
                                class="cursor-pointer opacity-80 md:hidden px-3 py-1 text-3xl leading-none bg-transparent rounded border border-solid border-transparent"
                                v-on:click="toggleCollapseShow('hidden')"
                            >
                               <font-awesome-icon  class="text-lighred text-3xl"
                               icon="fa-solid fa-xmark" />
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Form -->
                <form class="mt-6 mb-4 md:hidden">
                    <div class="mb-3 pt-0">
                        <input
                            type="text"
                            placeholder="Search"
                            class="border-0 px-3 py-2 h-12 border-solid border-blueGray-500 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-base leading-snug shadow-none outline-none focus:outline-none w-full font-normal"
                        />
                    </div>
                </form>

                <!-- Divider -->
                <hr class="my-4 md:min-w-full" />
                <!-- Heading -->
                <h6
                    class="md:min-w-full text-blueGray-500 text-sm uppercase font-bold block pt-1 pb-4 no-underline"
                >
                    Admin Layout Pages
                </h6>
                <!-- Navigation -->

                <ul class="md:flex-col md:min-w-full flex flex-col list-none">
                    <li class="items-center">
                        <Link href="/dashboard">
                            <a
                                :href="href"
                                @click="navigate"
                                class="text-sm uppercase py-3 font-bold block"
                                :class="[
                                    isActive
                                        ? 'text-polynesian hover:text-polynesian/60'
                                        : 'text-oynx hover:text-blueGray-500',
                                ]"
                            >
                                <i
                                    class="fas fa-tv mr-2 text-sm"
                                    :class="[
                                        isActive
                                            ? 'opacity-75'
                                            : 'text-blueGray-300',
                                    ]"
                                ></i>
                                Dashboard
                            </a>
                        </Link>
                    </li>

                    <li class="items-center">
                        <Link href="/orders">
                            <a
                                :href="href"
                                @click="navigate"
                                class="text-sm uppercase py-3 font-bold block"
                                :class="[
                                    isActive
                                        ? 'text-polynesian hover:text-polynesian/60'
                                        : 'text-oynx hover:text-blueGray-500',
                                ]"
                            >
                                <i
                                    class="fas fa-tools mr-2 text-sm"
                                    :class="[
                                        isActive
                                            ? 'opacity-75'
                                            : 'text-blueGray-300',
                                    ]"
                                ></i>
                                Orders
                            </a>
                        </Link>
                    </li>

                    <li class="items-center">
                        <Link href="/users">
                            <a
                                :href="href"
                                @click="navigate"
                                class="text-sm uppercase py-3 font-bold block"
                                :class="[
                                    isActive
                                        ? 'text-polynesian hover:text-polynesian/60'
                                        : 'text-oynx hover:text-blueGray-500',
                                ]"
                            >
                                <i
                                    class="fas fa-table mr-2 text-sm"
                                    :class="[
                                        isActive
                                            ? 'opacity-75'
                                            : 'text-blueGray-300',
                                    ]"
                                ></i>
                                Users
                            </a>
                        </Link>
                    </li>

                    <li class="items-center">
                        <Link href="/meals">
                            <a
                                :href="href"
                                @click="navigate"
                                class="text-sm uppercase py-3 font-bold block"
                                :class="[
                                    isActive
                                        ? 'text-polynesian hover:text-polynesian/60'
                                        : 'text-oynx hover:text-blueGray-500',
                                ]"
                            >
                                <font-awesome-icon icon="fa-solid fa-utensils"  class="fas fa-map-marked mr-2 text-sm "
                                    :class="[
                                        isActive
                                            ? 'opacity-75'
                                            : 'text-blueGray-300',
                                    ]"/>
                                
                                Meals
                            </a>
                        </Link>
                    </li>
                </ul>

                <!-- Divider -->
                <hr class="my-4 md:min-w-full" />
                <!-- Heading -->
                <h6
                    class="md:min-w-full text-blueGray-500 text-sm uppercase font-bold block pt-1 pb-4 no-underline"
                >
                    Auth Layout Pages
                </h6>
                <!-- Navigation -->

                <ul
                    class="md:flex-col md:min-w-full flex flex-col list-none md:mb-4"
                >
                    <li class="items-center">
                        <Link
                            class="text-oynx hover:text-blueGray-500 text-sm uppercase py-3 font-bold block"
                            href="/auth/login"
                        >
                            <i
                                class="fas fa-fingerprint text-blueGray-300 mr-2 text-sm"
                            ></i>
                            Login
                        </Link>
                    </li>

                    <li class="items-center">
                        <Link
                            class="text-oynx hover:text-blueGray-500 text-sm uppercase py-3 font-bold block"
                            href="/auth/register"
                        >
                            <i
                                class="fas fa-clipboard-list text-blueGray-300 mr-2 text-sm"
                            ></i>
                            Register
                        </Link>
                    </li>
                </ul>

                <
              
            </div>
        </div>
        
    </nav>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<script>
import NotificationDropdown from "@/Components/Dropdowns/NotificationDropdown.vue";
import UserDropdown from "@/Components/Dropdowns/UserDropdown.vue";
import ApplicationLogo from "../ApplicationLogo.vue";
export default {
    data() {
        return {
            collapseShow: "hidden",
        };
    },
    methods: {
        toggleCollapseShow: function (classes) {
            this.collapseShow = classes;
        },
    },
    components: {
        NotificationDropdown,
        UserDropdown,
    },
};
</script>

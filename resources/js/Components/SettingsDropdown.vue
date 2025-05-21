<script setup>
import { Head, Link, router } from "@inertiajs/vue3";

import DropdownLink from "@/Components/DropdownLink.vue";
import Dropdown from "@/Components/Dropdown.vue";
import { useDark, useToggle } from "@vueuse/core";
const logout = () => {
    router.post(route("logout"));
};

const isDark = useDark();
const toggleDarkMode = useToggle(isDark);
// const attrs = useAttrs();
</script>

<template>
    <!-- Settings Dropdown -->
    <div
        class="ml-2 lg:mr-4 relative text-oynx active:text-persian hover:text-polynesian dark:text-snow dark:active:text-persian dark:hover:text-lighred rounded-full bg-gradient-to-br from-[#e3dedf] to-[#ffffff] shadow-snow-sm hover:-shadow-snow-sm focus:shadow-none active:shadow-none hover:border-polynesian dark:bg-gradient-to-br dark:from-[#2b312e] dark:to-[#333a37] dark:shadow-oynx-sm hover:dark:-shadow-oynx-sm active:dark:shadow-none z-20 transition-all duration-250 ease-in"
    >
        <Dropdown align="right" width="48">
            <template #trigger>
                <button
                    v-if="$page.props.jetstream.managesProfilePhotos"
                    class="flex w-11 h-11 relative text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition"
                >
                    <img
                        class="h-full w-full rounded-full object-cover"
                        :src=" getProfilePhotoUrl($page.props.auth.user.profile_photo_url) "
                        :alt="$page.props.auth.user.name"
                    />
                    <div
                        v-if="notifications"
                        class="absolute top-[20%] right-[10%]"
                    >
                        <div
                            class="bg-lighred w-[8px] h-[8px] rounded-full animate-ping group-hover:animate-none"
                        >
                            <p class="opacity-0">r</p>
                        </div>
                    </div>
                </button>

                <span v-else class="inline-flex rounded-md">
                    <button
                        type="button"
                        class="inline-flex items-center px-3 py-3 border border-transparent text-sm leading-4 font-medium rounded-full transition ease-in-out duration-150"
                    >
                        <!-- {{ truncatedIng($page.props.auth.user.name) }} -->
                        <font-awesome-icon
                            icon="caret-down"
                            class="h-3 lg:h-4 ml-2 svg-inline--fa fa-user fa-w-14 fa-9x"
                        />
                    </button>
                </span>
            </template>

            <template #content class="bg-snow dark:bg-oynx">
                <div
                    class="origin-top-right disable-scrollbars overflow-y-scroll h-60 absolute right-0 mt-2 w-48 delay-75 rounded-md border-snow ring-1 bg-gradient-to-br from-[#e3dedf] to-[#ffffff] -shadow-snow-sm hover:shadow-snow-sm dark:bg-gradient-to-br dark:from-[#2b312e] dark:to-[#333a37] dark:-shadow-oynx-sm hover:dark:shadow-oynx-sm z-20 transition-all duration-250 ease-in dark:border-oynx"
                >
                    <!-- Account Management -->
                    <div class="block px-4 py-2 text-xs text-gray-600">
                        Manage Account
                    </div>

                    <DropdownLink
                        :href="route('profile.show')"
                        class="flex w-full items-center rounded-md px-4 py-1 text-sm text-oynx hover:text-polynesian dark:text-snow dark:hover:text-lighred cursor-pointer transition-all duration-200 ease-in-out"
                        ><font-awesome-icon icon="user" class="mr-2" />
                        Profile
                    </DropdownLink>
                   

                    <DropdownLink
                        v-if="$page.props.jetstream.hasApiFeatures"
                        :href="route('api-tokens.index')"
                    >
                        API Tokens
                    </DropdownLink>

                    <!-- Authentication -->
                    <form @submit.prevent="logout">
                        <DropdownLink
                        
                            as="button"
                            class="flex items-center rounded-md px-4 py-1 text-sm text-oynx hover:text-polynesian dark:text-snow dark:hover:text-lighred cursor-pointer transition-all duration-200 ease-in-out"
                        >
                            <font-awesome-icon
                                icon="right-from-bracket"
                                class="mr-2"
                            />
                            Log Out
                        </DropdownLink>
                    </form>
                    <div class="border-t border-gray-600" />
                    <!-- Add the toggle bo ttuns later -->
                    <input
                        id="switch"
                        type="checkbox"
                        @click="toggleDarkMode()"
                        dark-toggle
                        :checked="isDark"
                    />
                    <div class="app">
                        <div class="body">
                            <div
                                class="content flex flex-col m-auto text-center w-2/3 translate-y-[5%]"
                            >
                                <div
                                    class="circle relative rounded-full w-[3rem] h-[3rem] m-auto"
                                >
                                    <div
                                        class="crescent absolute rounded-full right-0 w-[2.2rem] h-[2.2rem]"
                                    ></div>
                                </div>
                                <label for="switch">
                                    <div class="toggle"></div>
                                    <div
                                        class="names items-center justify-between"
                                    >
                                        <p class="light">Light</p>
                                        <p class="dark">Dark</p>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </Dropdown>
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            notifications: "",
            wishlist: "",
        };
    },
    methods: {
        getProfilePhotoUrl(profilePhotoPath) {
            if (
                profilePhotoPath.includes("https://lh3.googleusercontent.com")
            ) {
                return profilePhotoPath;
            } else {
                return `${profilePhotoPath}`;
            }
        },
      
    },
};
</script>
<style scoped>
/* Middle */
.circle {
    background: linear-gradient(40deg, #ff0080, #ff8c00 70%);
}
.crescent {
    -webkit-transform: scale(0);
    -ms-transform: scale(0);
    transform: scale(0);
    -webkit-transform-origin: top right;
    -ms-transform-origin: top right;
    transform-origin: top right;
    -webkit-transition: -webkit-transform 0.6s
        cubic-bezier(0.645, 0.045, 0.355, 1);
    transition: -webkit-transform 0.6s cubic-bezier(0.645, 0.045, 0.355, 1);
    transition: transform 0.6s cubic-bezier(0.645, 0.045, 0.355, 1);
    transition: transform 0.6s cubic-bezier(0.645, 0.045, 0.355, 1),
        -webkit-transform 0.6s cubic-bezier(0.645, 0.045, 0.355, 1);
}

label,
.toggle {
    height: 2rem;
    border-radius: 100px;
}

label {
    width: 100%;
    background-color: rgba(0, 0, 0, 0.1);
    border-radius: 100px;
    position: relative;
    margin: 1.8rem 0 4rem 0;
    cursor: pointer;
}

.toggle {
    position: absolute;
    width: 50%;
    background-color: #fff;
    -webkit-box-shadow: 0 2px 15px rgba(0, 0, 0, 0.15);
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.15);
    -webkit-transition: -webkit-transform 0.3s
        cubic-bezier(0.25, 0.46, 0.45, 0.94);
    transition: -webkit-transform 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    transition: transform 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    transition: transform 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94),
        -webkit-transform 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.names {
    font-size: 80%;
    font-weight: bolder;
    color: black;
    width: 65%;
    margin-left: 17.5%;
    margin-top: 3.5%;
    position: absolute;
    display: flex;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

.dark {
    opacity: 0.5;
}

/* -------- Switch Styles ------------*/
[type="checkbox"] {
    display: none;
}
/* Toggle */
[type="checkbox"]:checked + .app .toggle {
    -webkit-transform: translateX(100%);
    -ms-transform: translateX(100%);
    transform: translateX(100%);
    background-color: #303633;
}

[type="checkbox"]:checked + .app .dark {
    opacity: 1;
    color: white;
}

[type="checkbox"]:checked + .app .light {
    opacity: 1;
    color: white;
}
/* App */
[type="checkbox"]:checked + .app .body {
    /* background-color: #26242E; */
    color: white;
}
/* Circle */
[type="checkbox"]:checked + .app .crescent {
    -webkit-transform: scale(1);
    -ms-transform: scale(1);
    transform: scale(1);
    background: #303633;
}

[type="checkbox"]:checked + .app .circle {
    background: linear-gradient(40deg, #8983f7, #a3dafb 70%);
}
</style>

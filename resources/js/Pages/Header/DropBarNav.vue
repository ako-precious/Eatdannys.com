<script setup>
import Dropdown from "@/Components/Dropdown.vue";

import SettingsDropdown from "@/Components/SettingsDropdown.vue";
// import { Link } from "@inertiajs/vue3";
defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>
<template>
   
    <div v-if="$page.props.auth.user">

        <SettingsDropdown class="w-10 h-10"></SettingsDropdown>
    </div>
    <div v-else
    class="ml-2 w-10 h-10  lg:mr-4 relative text-oynx active:text-persian hover:text-polynesian dark:text-snow dark:active:text-persian border border-gray-600 hover:border-none dark:hover:text-lighred rounded-full p-1 bg-gradient-to-br from-[#e3dedf] to-[#ffffff]  hover:shadow-snow-sm dark:bg-gradient-to-br dark:from-[#2b312e] dark:to-[#333a37]   hover:dark:shadow-oynx-sm z-20 transition-all duration-250 ease-in"
    >
    <Dropdown >
        <template #trigger>
           
            <button
                   
                    class="flex transition-all duration-200 ease-in-out"
                >
                    <font-awesome-icon
                        icon="user"
                        class="h-3 lg:h-4 p-2 svg-inline--fa fa-user fa-w-14 fa-9x"
                    />
                  
                </button>
           
        </template>

        <template #content>
            <!-- Account Management -->
            <div
                   
                    id="dropdown-menu"
                    class="origin-top-right absolute right-0 mt-2 w-48 delay-75 rounded-md border-snow  ring-1 bg-gradient-to-br from-[#e3dedf] to-[#ffffff]  hover:shadow-snow-sm dark:bg-gradient-to-br dark:from-[#2b312e] dark:to-[#333a37]  hover:dark:shadow-oynx-sm z-20 transition-all duration-250 ease-in dark:border-oynx"
                >
                    <div
                        class="py-2 p-2"
                        role="menu"
                        aria-orientation="vertical"
                        aria-labelledby="dropdown-button"
                    >
                        <div
                            
                            class="sm:end-0 text-end z-10 transition-all duration-200 ease-in-out"
                        >
                           
                            <div >
                                <Link
                                    :href="route('login')"
                                    class="flex items-center rounded-md px-4 py-2 text-sm text-oynx hover:text-polynesian dark:text-snow dark:hover:text-lighred cursor-pointer transition-all duration-200 ease-in-out"
                                    >Sign in
                                    <font-awesome-icon
                                        icon="right-to-bracket"
                                        class="ml-2"
                                /></Link>

                                <Link
                                    v-if="canRegister"
                                    :href="route('register')"
                                    class="flex items-center rounded-md px-4 py-2 text-sm text-oynx hover:text-polynesian dark:text-snow dark:hover:text-lighred cursor-pointer"
                                    >Sign up<font-awesome-icon
                                        icon="user-plus"
                                        class="ml-2"
                                /></Link>
                            </div>
                        </div>
                        <hr class="my-2" />
                       
                    </div>
                </div>
        </template>
    </Dropdown>
        
</div>
   
</template>

<script>
// import { defineProps } from 'vue';
export default {
    // props: defineProps(['canLogin', 'canRegister', 'laravelVersion', 'phpVersion']),

    data() {
        return {
            isDropdownOpen: false,
        };
    },
    methods: {
        toggleDropdown() {
            this.isDropdownOpen = !this.isDropdownOpen;
        },
        selectTheme(theme) {
            // Add logic for theme selection
            console.log("Selected theme:", theme);
            this.toggleDropdown(); // Close the dropdown after selection
        },
    },
};
</script>
<style scoped>
.dropdown {
    background: linear-gradient(145deg, #e3dedf, #ffffff);
    box-shadow: 15px 15px 30px #d6d2d3, -15px -15px 30px #ffffff;
}

@media (prefers-color-scheme: dark) {
    .dark\:dropdown {
        background: #303633;
        box-shadow: 15px 15px 30px #292e2b, -15px -15px 30px #373e3b;
    }
}
</style>

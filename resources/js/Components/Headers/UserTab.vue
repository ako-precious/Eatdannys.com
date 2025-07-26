<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const page = usePage();

// Function to determine if current route matches
const isActiveRoute = (route) => {
  return computed(() => page.url === route);
};
</script>


<template>
    <!-- Header -->
    <div class="relative bg-polynesian md:pt-32 pb-32 pt-12">
        <div class="px-4 md:px-10 mx-auto w-full">
            <div>
                <!-- Card stats -->
                <div>
                    <div class="grid grid-cols-3 bg-white p-10 gap-5 mx-3.5">
                        <div   :class="[
                                        
                                    isActiveRoute('/dashboard').value
                                        ? 'text-snow p-4 rounded bg-polynesian shadow-md flex items-center justify-center'
                                            : 'p-4 rounded bg-snow text-polynesian shadow-md flex items-center justify-center',
                                    ]"
                        >  <Link href="/dashboard">
                        <!-- class="text-snow p-4 rounded bg-polynesian shadow-md flex items-center justify-center" -->
                           <font-awesome-icon icon="fa-solid fa-house" class="fas fa-tv mr-2 text-lg"
                                    />
                            Home </Link>
                        </div>
                          <div
                             :class="[
                                        isActiveRoute('/orders').value
                                        ? 'text-snow p-4 rounded bg-polynesian shadow-md flex items-center justify-center'
                                            : 'p-4 rounded bg-snow text-polynesian shadow-md flex items-center justify-center',
                                    ]"
                        > <Link href="/orders"> <font-awesome-icon icon="fa-solid fa-cart-shopping" class="mr-2 text-lg" />
                          
                            Orders </Link>
                        </div>
                        <div
                             :class="[
                                        isActiveRoute('/user/profile').value
                                        ? 'text-snow p-4 rounded bg-polynesian shadow-md flex items-center justify-center'
                                            : 'p-4 rounded bg-snow text-polynesian shadow-md flex items-center justify-center',
                                    ]"
                        > <Link href="/user/profile">
                            <font-awesome-icon icon="user" class="mr-2 text-lg" />
                            Profile </Link>
                        </div>
                      
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import CardStats from "@/Components/Cards/CardStats.vue";

export default {
    components: {
        CardStats,
    },
};
</script>

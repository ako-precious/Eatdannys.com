<script setup>
import { useCartStore } from '@/stores/cart'
const cart = useCartStore()
</script>

<template>

<div 
    class="ml-2 w-10 h-10  lg:mr-4 cursor-pointer relative flex items-center justify-center  bg-snow dark:bg-onyx text-oynx active:text-persian hover:text-polynesian dark:text-snow dark:active:text-persian border border-gray-600 hover:border-none dark:hover:text-lighred rounded-full p-1 bg-gradient-to-br from-[#e3dedf] to-[#ffffff]  hover:shadow-snow-sm dark:bg-gradient-to-br dark:from-[#2b312e] dark:to-[#333a37]   hover:dark:shadow-oynx-sm z transition-all duration-250 ease-in"
    >
    <font-awesome-icon class=" text-oynx font-black text-xl"  icon="fa-solid fa-cart-shopping" />
   
  <span v-if="cart.count" class="absolute -top-2 -right-2 bg-lighred text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
    {{ cart.count }}
  </span>
</div>
</template>

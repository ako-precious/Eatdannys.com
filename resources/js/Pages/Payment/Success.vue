<template>
  <div class="flex min-h-screen justify-center items-center p-12 bg-snow">
    <div class="card max-h-[360px] max-w-[360px] shadow-2xl bg-snow/70 p-4">
      
      <h2 class="text-oynx text-sm ">{{ session }}</h2>
    </div>

  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
// import { useRoute } from 'vue-router'

defineProps({
  session: {
    type: Object,
    required: true
  }
});
// const route = useRoute()

// onMounted(() => {
//   if (route.path.includes('success')) {
//     message.value = 'Payment Successful ✅'
//   } else if (route.path.includes('cancel')) {
//     message.value = 'Payment Cancelled ❌'
//   } else {
//     message.value = 'Unknown Status'
//   }
// })
</script>

<style scoped>
.card {
  
  position: relative;
  display: flex;
  place-content: center;
  place-items: center;
  overflow: hidden;
  border-radius: 15px;
  text-align: center;
}

.card h2 {
  z-index: 1;
  padding: 1rem;
}

.card::before {
  content: '';
  position: absolute;
  width: 100px;
  background-image: linear-gradient(180deg,  #ECA72C, #00A6ED);
  height: 230%;
  animation: rotBGimg 3s linear infinite;
  transition: all 3s linear;
}

@keyframes rotBGimg {
  from {
    transform: rotate(0deg);
  }

  to {
    transform: rotate(360deg);
  }
}

.card::after {
  content: '';
  position: absolute;
  background-color: #FFFCF9;
  inset: 5px;
  border-radius: 15px;
}
</style>

<template>
  <div class="card">
    <h2>{{ message }}</h2>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'

const message = ref('')
const route = useRoute()

onMounted(() => {
  if (route.path.includes('success')) {
    message.value = 'Payment Successful ✅'
  } else if (route.path.includes('cancel')) {
    message.value = 'Payment Cancelled ❌'
  } else {
    message.value = 'Unknown Status'
  }
})
</script>

<style scoped>
.card {
  width: 260px;
  height: 260px;
  background: #07182E;
  position: relative;
  display: flex;
  place-content: center;
  place-items: center;
  overflow: hidden;
  border-radius: 20px;
  text-align: center;
}

.card h2 {
  z-index: 1;
  color: white;
  font-size: 1.5em;
  padding: 1rem;
}

.card::before {
  content: '';
  position: absolute;
  width: 100px;
  background-image: linear-gradient(180deg, rgb(0, 183, 255), rgb(255, 48, 255));
  height: 130%;
  animation: rotBGimg 3s linear infinite;
  transition: all 0.2s linear;
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
  background: #07182E;
  inset: 5px;
  border-radius: 15px;
}
</style>

<template>
  <div v-if="success">
    <h2>Payment Successful! 🎉</h2>
    <div v-if="needsPassword">
      <p>Check your email to set up your account password</p>
      <button @click="resendEmail">Resend Email</button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      needsPassword: false,
      success: false
    };
  },
  async mounted() {
    const response = await axios.get('/api/checkout/success', {
      params: { session_id: this.$route.query.session_id }
    });
    
    this.needsPassword = response.data.needs_password;
    this.success = true;
  }
};
</script>

<!-- 

<template>
  <div v-if="paymentResult">
    <div v-if="paymentResult.paid" class="success-message">
      <h2>Payment Successful! 🎉</h2>
      
      <div v-if="paymentResult.requires_signup" class="signup-prompt">
        <h3>Almost done!</h3>
        <p>Please complete your account setup to access order history.</p>
        <button @click="redirectToSignup">Complete Signup</button>
      </div>

      <order-details :customer="paymentResult.customer" />
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    async checkPaymentStatus() {
      try {
        const response = await axios.get('/api/checkout/success', {
          params: { session_id: this.sessionId }
        });
        
        if (response.data.requires_signup) {
          localStorage.setItem('pending_user_email', response.data.customer.email);
        }
        
        this.paymentResult = response.data;
      } catch (error) {
        this.handleError(error);
      }
    },
    redirectToSignup() {
      this.$router.push({
        path: '/signup',
        query: { email: this.paymentResult.customer.email }
      });
    }
  }
}
</script>

<!-- <template>
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
</style> --> 

<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import axios from "axios";
import { useCartStore } from "@/stores/cart";
import Background from "../Layout/Background.vue";

const page = usePage();
const user = page.props.auth?.user || null;

const cart = useCartStore();

// ✅ Clear cart on mount
cart.clearCart();
</script>

<template>
    <Background>
        <div>
            <div>
              
            </div>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <!-- <div v-if="loading" class="text-center">
             <jet-spinner class="h-12 w-12 mx-auto" />
             <p class="mt-4 text-gray-600 dark:text-gray-400">Verifying payment...</p>
           </div>
   
           <div v-else-if="error" class="bg-red-50 dark:bg-red-900 p-6 rounded-lg">
             <h3 class="text-red-800 dark:text-red-100 text-xl font-bold mb-4">Payment Verification Failed</h3>
             <p class="text-red-700 dark:text-red-200">{{ error }}</p>
             <jet-button class="mt-4" @click.native="retryVerification">
               Try Again
             </jet-button>
           </div> -->

                    <div
                        class="bg-snow dark:bg-gray-800 overflow-hidden shadow-md max-w-4xl m-auto sm:rounded-lg"
                    >
                        <div
                            class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700"
                        >
                            <div class="flex items-center mb-6">
                                <svg
                                    class="h-12 w-12 text-green-500 mr-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M5 13l4 4L19 7"
                                    ></path>
                                </svg>
                                <h3
                                    class="text-2xl font-semibold text-gray-900 dark:text-gray-100"
                                >
                                    Payment Successful!
                                </h3>
                            </div>

                            <div
                                v-if="requiresPasswordSetup"
                                class="mt-8 bg-oynx dark:bg-oynx p-6 rounded-lg"
                            >
                                <h4
                                    class="text-lg font-medium text-oynx dark:text-oynx mb-4"
                                >
                                    Almost Done!
                                </h4>
                                <p class="text-oynx dark:text-oynx">
                                    We've sent a password setup link to
                                    <span class="font-semibold">{{
                                        customerEmail
                                    }}</span
                                    >. Check your inbox to complete your account
                                    setup.
                                </p>

                                <div class="mt-6 flex items-center space-x-4">
                                    <jet-button
                                        @click.native="resendVerificationEmail"
                                    >
                                        Resend Email
                                    </jet-button>
                                    <span
                                        class="text-sm text-oynx dark:text-oynx"
                                    >
                                        Didn't receive it? Check spam folder
                                        first
                                    </span>
                                </div>
                            </div>

                            <div
                                class="mt-8 border-t border-gray-200 dark:border-gray-700 pt-6"
                            >
                                <h4
                                    class="text-lg font-medium mb-4 text-gray-900 dark:text-gray-100"
                                >
                                    Next Steps
                                </h4>
                                <ul
                                    class="list-disc pl-6 space-y-2 text-gray-600 dark:text-gray-300"
                                >
                                    <li>
                                        You'll receive an order confirmation
                                        email shortly
                                    </li>

                                    <li v-if="user && requiresPasswordSetup">
                                        Please check your email to set a
                                        password and activate your account.
                                    </li>

                                    <li v-else-if="user">
                                        Track your order in
                                        <Link
                                            href="/orders"
                                            class="text-oynx dark:text-oynx"
                                            >Order History</Link
                                        >
                                    </li>

                                    <li v-else>
                                        Please
                                        <Link
                                            href="/login"
                                            class="text-oynx dark:text-oynx"
                                            >login</Link
                                        >
                                        to view your order History.
                                    </li>
                                    <li>
                                        Contact support if you have any
                                        questions
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Background>
</template>

<script>
import JetButton from "@/Components/PrimaryButton.vue";
import JetSpinner from "@/Components/Spinner.vue";

export default {
    components: {
        JetButton,
        JetSpinner,
    },

    data() {
        return {
            loading: false,
            error: null,
            requiresPasswordSetup: false,
            customerEmail: null,
        };
    },

    mounted() {
        this.verifyPayment();
    },

    methods: {
        async verifyPayment() {
            try {
                const sessionId = new URLSearchParams(
                    window.location.search
                ).get("session_id");

                const response = await axios.get(
                    route("api.checkout.success"),
                    {
                        params: {
                            session_id: sessionId,
                        },
                    }
                );
                console.log(response);

                if (response.data.success) {
                    this.requiresPasswordSetup =
                        response.data.requires_password_setup;
                    this.customerEmail = response.data.customer_email;
                } else {
                    this.error =
                        "Payment verification failed. Please contact support.";
                }
            } catch (error) {
                this.error = this.extractErrorMessage(error);
                if (error.response?.status === 404) {
                    this.$inertia.visit(route("checkout.cancel"));
                }
            } finally {
                this.loading = false;
            }
        },

        async resendVerificationEmail() {
            try {
                await axios.post(route("password.email"), {
                    email: this.customerEmail,
                });
                this.$page.props.flash = {
                    message: "New verification email sent!",
                    type: "success",
                };
            } catch (error) {
                this.error = this.extractErrorMessage(error);
            }
        },

        retryVerification() {
            // this.loading = true
            this.error = null;
            this.verifyPayment();
        },

        extractErrorMessage(error) {
            return (
                error.response?.data?.error ||
                error.message ||
                "An unexpected error occurred"
            );
        },
    },
};
</script>

<!-- <template>
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
</script> -->

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

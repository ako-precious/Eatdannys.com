<template>
    <form id="payment-form" @submit.prevent="handleSubmit">
      <div v-if="loading">Loading payment form...</div>
      <div v-else>
        <div id="payment-element">
          </div>
        <button :disabled="processing || !canSubmit">
          {{ processing ? 'Processing...' : 'Pay Now' }}
        </button>
        <div v-if="error" class="error-message">{{ error }}</div>
      </div>
    </form>
  </template>
  
  <script setup>
  import { ref, onMounted, computed } from 'vue';
  import { loadStripe } from '@stripe/stripe-js'; // Or use the wrapper's load function
  
  // Replace with your actual Stripe publishable key from your .env
  const publishableKey = import.meta.env.VITE_STRIPE_KEY; // Assuming you use Vite
  const stripe = ref(null);
  const elements = ref(null);
  const clientSecret = ref(null);
  const loading = ref(true);
  const processing = ref(false);
  const error = ref(null);
  
  // Computed property to check if the form can be submitted
  const canSubmit = computed(() => clientSecret.value && !processing.value);
  
  onMounted(async () => {
    try {
      // 1. Load Stripe.js
      stripe.value = await loadStripe(publishableKey);
  
      if (!stripe.value) {
        throw new Error('Failed to load Stripe.js');
      }
  
      // 2. Obtain the client_secret from your Laravel backend
      const response = await fetch('/api/create-payment-intent', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        // Send any necessary data to your backend, e.g., order amount
        body: JSON.stringify({ amount: 2500, currency: 'usd' }), // Example: $25.00
      });
  
      if (!response.ok) {
        const errorData = await response.json();
        throw new Error(errorData.error || 'Failed to create Payment Intent on backend.');
      }
  
      const data = await response.json();
      clientSecret.value = data.clientSecret;
  
      // 3. Initialize and mount Stripe Elements (specifically the PaymentElement)
      elements.value = stripe.value.elements({ clientSecret: clientSecret.value });
      const paymentElement = elements.value.create('payment');
      paymentElement.mount('#payment-element');
  
    } catch (e) {
      error.value = e.message;
      console.error("Error during Stripe initialization:", e);
    } finally {
      loading.value = false;
    }
  });
  
  const handleSubmit = async () => {
    if (processing.value || !canSubmit.value) {
      return;
    }
  
    processing.value = true;
    error.value = null;
  
    // Confirm the payment using the client_secret and the Payment Element
    const { error: stripeError } = await stripe.value.confirmPayment({
      elements: elements.value,
      confirmParams: {
        // Specify your return URL. Stripe will redirect the user here after the payment flow.
        return_url: `${window.location.origin}/payment-status`, // Example: Redirect to a payment status page
      },
    });
  
    if (stripeError) {
      // This point is only reached if there's an immediate error when
      // confirming the payment. Show the error to your customer.
      error.value = stripeError.message;
      processing.value = false;
    } else {
      // The payment is complete or requires further action (like 3DS).
      // Stripe will automatically redirect the user to the return_url.
      // No need to do anything else here.
    }
  };
  </script>
  
  <style scoped>
  /* Add some basic styling for the form and error message */
  #payment-form {
    max-width: 500px;
    margin: 20px auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 8px;
  }
  
  #payment-element {
    margin-bottom: 20px;
  }
  
  button {
    background-color: #6772E5;
    color: #FFF;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
  }
  
  button:disabled {
    background-color: #ccc;
    cursor: not-allowed;
  }
  
  button:hover:not(:disabled) {
    background-color: #5764c0;
  }
  
  .error-message {
    color: #e00000;
    margin-top: 15px;
  }
  </style>
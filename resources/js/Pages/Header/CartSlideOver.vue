
   <template>
    <div>
      <button @click="openCart">
        <CartIcon />
      </button>
      <div v-if="ui.isCartOpen">
        <div
          class="fixed inset-0 bg-oynx/75 transition-opacity"
          aria-hidden="true"
        ></div>
  
        <div class="fixed inset-0 overflow-hidden">
          <div
            class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10"
          >
            <transition
              enter-active-class="transform transition ease-in-out duration-500 sm:duration-700"
              enter-from-class="translate-x-full"
              enter-to-class="translate-x-0"
              leave-active-class="transform transition ease-in-out duration-500 sm:duration-700"
              leave-from-class="translate-x-0"
              leave-to-class="translate-x-full"
            >
              <div v-if="ui.isCartOpen" class="pointer-events-auto w-screen max-w-md">
                <div
                  class="flex h-full flex-col overflow-y-scroll bg-snow shadow-xl"
                >
                  <div class="flex-1 overflow-y-auto px-4 py-6 sm:px-6">
                    <div class="flex items-start justify-between">
                      <h2
                        class="text-lg font-medium text-gray-900"
                        id="slide-over-title"
                      >
                        Shopping cart
                      </h2>
                      <div class="ml-3 flex h-7 items-center">
                        <button
                          type="button"
                          class="relative -m-2 p-2 text-gray-400 hover:text-gray-500 cursor-pointer"
                          @click="closeCart"
                        >
                          <span class="absolute -inset-0.5"></span>
                          <span class="sr-only">Close panel</span>
                          <font-awesome-icon
                            icon="fa-solid fa-xmark"
                            class=" text-2xl text-lighred"
                          />
                        </button>
                      </div>
                    </div>
  
                    <div class="mt-8">
                      <div class="flow-root">
                        <ul
                          role="list"
                          class="-my-6 divide-y divide-gray-200"
                        >
                          <li
                            class="flex py-6"
                            v-for="(item, index) in cart.items"
                            :key="index"
                          >
                            <div
                              class="size-24 shrink-0 overflow-hidden rounded-md border border-gray-200"
                            >
                              <img
                                src="https://tailwindcss.com/plus-assets/img/ecommerce-images/shopping-cart-page-04-product-01.jpg"
                                alt="Salmon orange fabric pouch with match zipper, gray zipper pull, and adjustable hip belt."
                                class="size-full object-cover"
                              />
                            </div>
  
                            <div class="ml-4 flex flex-1 flex-col">
                              <div>
                                <div
                                  class="flex justify-between text-base font-medium text-oynx"
                                >
                                  <h3>
                                    <a href="#">{{ item.name }}</a>
                                  </h3>
                                  <p class="ml-4">
                                   ${{ item.price }}
                                  </p>
                                </div>
                                <p
                                  class="mt-1 flex justify-between text-sm text-oynx/75"
                                >
                               <span> {{ item.category }}</span>   <span>{{ item.size_or_quantity }}</span> 
                                </p>
                              </div>
                              <div
                                class="flex flex-1 items-end justify-between text-sm"
                              >
                                <p class="text-gray-500">
                                  Qty
                                  <input
                                  type="number"
                                  name=""
                                  class="w-14 h-8 border-none"
                                  readonly
                                   v-model.number="item.quantity"
                                  />
                                </p>
  
                                <div class="flex">
                                  <button
                                    type="button"
                                    @click="cart.removeItem(index)"
                                    class="font-medium text-lg text-lighred/80 hover:text-lighred cursor-pointer"
                                  >
                                  <font-awesome-icon icon="fa-solid fa-trash" />
                                  </button>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
  
                  <div class="border-t border-gray-200 px-4 py-6 sm:px-6">
                    <div
                      class="flex justify-between text-base font-medium text-gray-900"
                    >
                      <p>Subtotal</p>
                      <p>
                        <p>Total: ${{ cart.subtotal }}</p>
                      </p>
                    </div>
                    <p class="mt-0.5 text-sm text-gray-500">
                      Shipping and taxes calculated at checkout.
                    </p>
                    <div class="mt-6">
                      <button @click="checkout" 
                        href="#"
                        class="flex items-center justify-center rounded-md border border-transparent bg-polynesian/80 px-6 py-3 text-base font-medium text-snow shadow-xs hover:bg-polynesian cursor-pointer "
                        >Checkout</button
                      >
                    </div>
                    
                  </div>
                </div>
              </div>
            </transition>
          </div>
        </div>
      </div>
    </div>
  </template>
  <script setup>
  
  import { useCartStore } from '@/stores/cart';
  import CartIcon from './CartIcon.vue'; // Import your CartIcon component
  import { useUIStore } from '@/stores/ui';
  import { loadStripe } from '@stripe/stripe-js'
  import axios from 'axios'
  
  const cart = useCartStore();
  const ui = useUIStore();
  
  const openCart = () => {
    ui.openCart();
  };
  const closeCart = () => {
    ui.closeCart();
  };
  
 
  const stripePromise = loadStripe('pk_test_51IvR8jAFJD6o0rICZ3MCmT7M8K0RNwvscS75G6T5cvT7mK2hnDXG7RSiqs2JK6nGskhEFo9QMNvP5VvGTmpyksEn00uGLkrESc')
  
  async function checkout() {
      const stripe = await stripePromise
  
      const response = await axios.post('/api/create-checkout-session', {
          items: cart.items
      })
  
      const result = await stripe.redirectToCheckout({
          sessionId: response.data.id
      })
  
      if (result.error) {
          console.error(result.error.message)
      }
  }
  </script>
 
  
  <!-- <template>
    <button @click="checkout" class="bg-blue-600 text-white px-4 py-2 rounded">
      Pay Now ${{ cart.subtotal.toFixed(2) }}
    </button>
  </template> -->
  
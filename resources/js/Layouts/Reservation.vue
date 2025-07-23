<script setup>
import { ref, computed } from 'vue'
import { Dialog, DialogPanel, DialogTitle, TransitionRoot, TransitionChild } from '@headlessui/vue'

const isOpen = ref(false)
const isLoading = ref(false)
const successMessage = ref('')
const errorMessage = ref('')

// Get today's date in YYYY-MM-DD format
const today = new Date().toISOString().split('T')[0]

const reservationData = ref({
  name: '',
  email: '',
  phone: '',
  date: today,
  time: '12:00',
  guests: 2,
  special_requests: ''
})

// Generate time slots from 7am to 7pm in 30-min intervals
const timeSlots = computed(() => {
  const slots = []
  for (let hour = 7; hour <= 19; hour++) {
    for (let minute = 0; minute < 60; minute += 30) {
      if (hour === 19 && minute > 0) break // Stop after 7pm
      const hourStr = hour.toString().padStart(2, '0')
      const minStr = minute.toString().padStart(2, '0')
      const time24 = `${hourStr}:${minStr}`
      const ampm = hour >= 12 ? 'PM' : 'AM'
      const hour12 = hour % 12 || 12
      slots.push({
        value: time24,
        label: `${hour12}:${minStr} ${ampm}`
      })
    }
  }
  return slots
})

// Block weekends
const isWeekend = (dateString) => {
  const date = new Date(dateString)
  const day = date.getDay()
  return day === 0 || day === 6 // Sunday = 0, Saturday = 6
}

function openModal() {
  isOpen.value = true
  successMessage.value = ''
  errorMessage.value = ''
}

function closeModal() {
  isOpen.value = false
  setTimeout(() => {
    reservationData.value = {
      name: '',
      email: '',
      phone: '',
      date: today,
      time: '12:00',
      guests: 2,
      special_requests: ''
    }
  }, 300)
}

async function submitReservation() {
  // Frontend validation
  if (isWeekend(reservationData.value.date)) {
    errorMessage.value = 'Reservations are not available on weekends'
    return
  }
  
  const timeValue = reservationData.value.time
  const [hours] = timeValue.split(':').map(Number)
  if (hours < 7 || hours >= 19) {
    errorMessage.value = 'Reservations must be between 7am and 7pm'
    return
  }

  isLoading.value = true
  errorMessage.value = ''
  
  try {
    const response = await fetch('/api/reservations', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        // 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      body: JSON.stringify(reservationData.value)
    })

    const data = await response.json()
    
    if (!response.ok) {
      throw new Error(data.message || 'Failed to create reservation')
    }
    
    successMessage.value = 'Reservation created successfully!'
    // Close modal after 2 seconds
    setTimeout(() => {
      closeModal()
    }, 2000)
  } catch (error) {
    console.log(error);
    
    errorMessage.value = error.message || 'An error occurred. Please try again.'
  } finally {
    isLoading.value = false
  }
}
</script>

<template>
  <div>
    <!-- Reservation Button -->
    <a
      href="#"
      @click.prevent="openModal"
      class="group px-6 py-3 bg-polynesian/50 hover:bg-polynesian/60 rounded-lg text-lg font-semibold transition inline-flex items-center"
    >
      Make a Reservation
      <i class="fa-solid fa-arrow-right ml-2 transition-transform group-hover:translate-x-1"></i>
    </a>

    <!-- Modal -->
    <TransitionRoot appear :show="isOpen" as="template">
      <Dialog as="div" @close="closeModal" class="relative z-10">
        <TransitionChild
          as="template"
          enter="duration-300 ease-out"
          enter-from="opacity-0"
          enter-to="opacity-100"
          leave="duration-200 ease-in"
          leave-from="opacity-100"
          leave-to="opacity-0"
        >
          <div class="fixed inset-0 bg-black/60 bg-opacity-50" />
        </TransitionChild>

        <div class="fixed inset-0 overflow-y-auto">
          <div class="flex min-h-full items-center justify-center p-4 text-center">
            <TransitionChild
              as="template"
              enter="duration-300 ease-out"
              enter-from="opacity-0 scale-95"
              enter-to="opacity-100 scale-100"
              leave="duration-200 ease-in"
              leave-from="opacity-100 scale-100"
              leave-to="opacity-0 scale-95"
            >
              <DialogPanel
                class="w-full max-w-lg transform overflow-hidden rounded-2xl bg-sand-50 p-6 text-left align-middle shadow-xl transition-all"
              >
                <DialogTitle
                  as="h3"
                  class="text-2xl font-bold leading-6 text-african-sunset mb-4 flex items-center"
                >
                  <i class="fa-solid fa-utensils mr-2"></i>
                  Reserve Your Table
                </DialogTitle>

                <!-- Messages -->
                <div v-if="successMessage" class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
                  {{ successMessage }}
                </div>
                <div v-if="errorMessage" class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg">
                  {{ errorMessage }}
                </div>

                <form @submit.prevent="submitReservation">
                  <div class="space-y-4">
                    <div>
                      <label class="block text-sm font-medium text-african-earth mb-1">Full Name</label>
                      <input
                        v-model="reservationData.name"
                        required
                        type="text"
                        class="w-full px-3 py-2 border border-african-earth/30 rounded-md focus:outline-none focus:ring-2 focus:ring-polynesian"
                      >
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                      <div>
                        <label class="block text-sm font-medium text-african-earth mb-1">Email</label>
                        <input
                          v-model="reservationData.email"
                          required
                          type="email"
                          class="w-full px-3 py-2 border border-african-earth/30 rounded-md focus:outline-none focus:ring-2 focus:ring-polynesian"
                        >
                      </div>
                      <div>
                        <label class="block text-sm font-medium text-african-earth mb-1">Phone</label>
                        <input
                          v-model="reservationData.phone"
                          required
                          type="tel"
                          class="w-full px-3 py-2 border border-african-earth/30 rounded-md focus:outline-none focus:ring-2 focus:ring-polynesian"
                        >
                      </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                      <div>
                        <label class="block text-sm font-medium text-african-earth mb-1">Date</label>
                        <input
                          v-model="reservationData.date"
                          required
                          type="date"
                          :min="today"
                          class="w-full px-3 py-2 border border-african-earth/30 rounded-md focus:outline-none focus:ring-2 focus:ring-polynesian"
                        >
                      </div>
                      <div>
                        <label class="block text-sm font-medium text-african-earth mb-1">Time</label>
                        <select
                          v-model="reservationData.time"
                          required
                          class="w-full px-3 py-2 border border-african-earth/30 rounded-md focus:outline-none focus:ring-2 focus:ring-polynesian"
                        >
                          <option v-for="slot in timeSlots" :key="slot.value" :value="slot.value">
                            {{ slot.label }}
                          </option>
                        </select>
                      </div>
                    </div>

                    <div>
                      <label class="block text-sm font-medium text-african-earth mb-1">Number of Guests</label>
                      <select
                        v-model="reservationData.guests"
                        class="w-full px-3 py-2 border border-african-earth/30 rounded-md focus:outline-none focus:ring-2 focus:ring-polynesian"
                      >
                        <option v-for="n in 8" :value="n" :key="n">{{ n }} {{ n === 1 ? 'person' : 'people' }}</option>
                        <option value="9">9+ people</option>
                      </select>
                    </div>

                    <div>
                      <label class="block text-sm font-medium text-african-earth mb-1">Special Requests</label>
                      <textarea
                        v-model="reservationData.special_requests"
                        rows="3"
                        class="w-full px-3 py-2 border border-african-earth/30 rounded-md focus:outline-none focus:ring-2 focus:ring-polynesian"
                      ></textarea>
                    </div>
                  </div>

                  <div class="mt-6 flex justify-between">
                    <button
                      type="button"
                      @click="closeModal"
                      class="px-4 py-2 text-sm font-medium text-african-earth hover:text-african-sunset"
                      :disabled="isLoading"
                    >
                      Cancel
                    </button>
                    <button
                      type="submit"
                      class="px-6 py-2 bg-polynesian/50 text-white rounded-md hover:bg-polynesian-dark transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-polynesian disabled:opacity-50"
                      :disabled="isLoading"
                    >
                      <span v-if="isLoading">
                        <i class="fa-solid fa-spinner fa-spin mr-2"></i> Processing...
                      </span>
                      <span v-else>Confirm Reservation</span>
                    </button>
                  </div>
                </form>
              </DialogPanel>
            </TransitionChild>
          </div>
        </div>
      </Dialog>
    </TransitionRoot>
  </div>
</template>

<style scoped>
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');

/* Custom colors - add these to your Tailwind config */
.bg-polynesian {
  background-color: #1a3a5f;
}
.bg-polynesian\/50 {
  background-color: rgba(26, 58, 95, 0.5);
}
.bg-polynesian\/60 {
  background-color: rgba(26, 58, 95, 0.6);
}
.bg-polynesian-dark {
  background-color: #0f2540;
}
.bg-sand-50 {
  background-color: #faf5eb;
}
.text-african-sunset {
  color: #e76f51;
}
.text-african-earth {
  color: #5d4037;
}
</style>
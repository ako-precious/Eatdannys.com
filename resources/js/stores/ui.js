// src/stores/ui.js
import { defineStore } from 'pinia'

export const useUIStore = defineStore('ui', {
  state: () => ({
    isCartOpen: false,
  }),
  actions: {
    openCart() {
      this.isCartOpen = true
    },
    closeCart() {
      this.isCartOpen = false
    },
    toggleCart() {
      this.isCartOpen = !this.isCartOpen
    },
  },
})

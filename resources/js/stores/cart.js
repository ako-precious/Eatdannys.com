import { defineStore } from 'pinia'

export const useCartStore = defineStore('cart', {
  state: () => ({
    items: JSON.parse(localStorage.getItem('cart_items')) || []
  }),
  getters: {
    count: (state) => state.items.length,
    subtotal: (state) =>
      state.items.reduce((sum, item) => sum + (item.unit_price * item.quantity), 0)
  },
  actions: {
    addItem(item) {
      this.items.push(item)
      this.saveToStorage()
    },
    removeItem(index) {
      this.items.splice(index, 1)
      this.saveToStorage()
    },
    clearCart() {
      this.items = []
      this.saveToStorage()
    },
    saveToStorage() {
      localStorage.setItem('cart_items', JSON.stringify(this.items))
    }
  }
})

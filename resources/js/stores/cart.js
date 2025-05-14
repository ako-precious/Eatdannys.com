import { defineStore } from 'pinia'

export const useCartStore = defineStore('cart', {
  state: () => ({
    items: []
  }),
  getters: {
    count: (state) => state.items.length,
    subtotal: (state) =>
        state.items.reduce((sum, item) => sum + (item.unit_price * item.quantity), 0),
      
  },
  actions: {
    addItem(item) {
      this.items.push(item)
    },
    removeItem(index) {
      this.items.splice(index, 1)
    }
  }
})

<script setup>
import Navbar from './Navbar.vue'
import DropBarNav from './DropBarNav.vue'
import CartIcon from './CartIcon.vue'

defineProps({
  canLogin:      Boolean,
  canRegister:   Boolean,
  laravelVersion: String,
  phpVersion:    String,
  pushSub:       Boolean,
})
</script>

<template>
  <Navbar>
    <template #dropdown>
      <DropBarNav
        :canLogin="canLogin"
        :canRegister="canRegister"
        :laravelVersion="laravelVersion"
        :phpVersion="phpVersion"
      />
      <CartIcon />
    </template>
  </Navbar>
</template>

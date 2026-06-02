<script setup>
import { ref, onMounted, onUnmounted, nextTick } from 'vue'
import { Link } from '@inertiajs/vue3'
import { gsap } from 'gsap'

// ─── Nav links ────────────────────────────────────────────────────────────────
const navLinks = [
  { label: 'Dining & Takeout', route: 'welcome' },
  { label: 'Event Catering',   route: 'catering' },
  { label: 'Bakery',           route: 'bakery' },
]

const isActive = (routeName) => {
  try { return route().current(routeName) } catch { return false }
}

// ─── Refs ─────────────────────────────────────────────────────────────────────
const navEl         = ref(null)
const mobileMenuEl  = ref(null)
const mobileItemEls = ref([])
const mobileOpen    = ref(false)
const isScrolled    = ref(false)

// ─── Scroll: transparent ↔ solid + hide-on-down / show-on-up ─────────────────
let lastY  = 0
let hidden = false

const onScroll = () => {
  const y = window.scrollY
  isScrolled.value = y > 48

  if (navEl.value && y > 280) {
    if (y > lastY && !hidden) {
      gsap.to(navEl.value, { y: '-110%', duration: 0.38, ease: 'power3.inOut' })
      hidden = true
    } else if (y < lastY && hidden) {
      gsap.to(navEl.value, { y: '0%', duration: 0.38, ease: 'power3.out' })
      hidden = false
    }
  }
  lastY = y
}

// ─── Mobile menu ──────────────────────────────────────────────────────────────
const openMobile = async () => {
  mobileItemEls.value = []
  mobileOpen.value = true
  document.body.style.overflow = 'hidden'
  await nextTick()

  gsap.fromTo(
    mobileMenuEl.value,
    { autoAlpha: 0 },
    { autoAlpha: 1, duration: 0.32, ease: 'power2.out' }
  )

  const items = mobileItemEls.value.filter(Boolean)
  if (items.length) {
    gsap.fromTo(
      items,
      { y: 36, autoAlpha: 0 },
      { y: 0, autoAlpha: 1, duration: 0.55, stagger: 0.07, ease: 'power3.out', delay: 0.12 }
    )
  }
}

const closeMobile = () => {
  const items = [...mobileItemEls.value].filter(Boolean).reverse()
  gsap.timeline({
    onComplete: () => {
      mobileOpen.value = false
      document.body.style.overflow = ''
    },
  })
    .to(items, { y: -18, autoAlpha: 0, duration: 0.22, stagger: 0.04, ease: 'power2.in' })
    .to(mobileMenuEl.value, { autoAlpha: 0, duration: 0.22, ease: 'power2.in' }, '-=0.1')
}

// ─── Lifecycle ────────────────────────────────────────────────────────────────
onMounted(() => {
  lastY = window.scrollY
  isScrolled.value = lastY > 48

  gsap.fromTo(
    navEl.value,
    { y: -56, autoAlpha: 0 },
    { y: 0, autoAlpha: 1, duration: 0.72, ease: 'power3.out', delay: 0.08 }
  )

  window.addEventListener('scroll', onScroll, { passive: true })
})

onUnmounted(() => {
  window.removeEventListener('scroll', onScroll)
  document.body.style.overflow = ''
})
</script>

<template>
  <!-- ── Fixed navbar ────────────────────────────────────────────────────── -->
  <header
    ref="navEl"
    class="fixed top-0 left-0 right-0 z-[990] transition-colors duration-500"
    :class="isScrolled
      ? 'bg-oynx/96 backdrop-blur-md border-b border-snow/8'
      : 'bg-transparent'"
    style="will-change: transform"
  >
    <div class="max-w-7xl mx-auto px-6 lg:px-10">
      <div class="flex items-center justify-between h-16 lg:h-[72px]">

        <!-- Logo -->
        <Link
          :href="route('welcome')"
          class="flex-shrink-0 flex items-center gap-2.5 group"
          aria-label="Danny's — Home"
        >
          <img
            src="/images/logo.png"
            alt="Danny's"
            class="w-8 h-8 rounded-full object-cover ring-1 ring-snow/20 transition-all duration-300 group-hover:ring-persian/60 group-hover:scale-105"
          />
          <span class="hidden sm:block font-bold text-snow text-sm tracking-widest uppercase">
            Danny's
          </span>
        </Link>

        <!-- Desktop nav links (centre) -->
        <nav class="hidden md:flex items-center gap-8" aria-label="Primary navigation">
          <Link
            v-for="link in navLinks"
            :key="link.route"
            :href="route(link.route)"
            class="nav-link group relative text-xs font-bold uppercase tracking-[0.16em] py-1 transition-colors duration-200 focus:outline-none focus-visible:text-persian"
            :class="isActive(link.route) ? 'text-persian' : 'text-snow/70 hover:text-snow'"
          >
            {{ link.label }}
            <!-- Animated underline indicator -->
            <span
              class="absolute -bottom-px left-0 h-px bg-persian transition-all duration-300 ease-out origin-left"
              :class="isActive(link.route) ? 'w-full' : 'w-0 group-hover:w-full'"
              aria-hidden="true"
            ></span>
          </Link>
        </nav>

        <!-- Right side: user menu + cart passed from parent, plus mobile trigger -->
        <div class="flex items-center gap-2">
          <slot name="dropdown" />

          <!-- Mobile hamburger button -->
          <button
            class="md:hidden flex flex-col items-center justify-center gap-[5px] w-9 h-9 rounded-lg hover:bg-snow/10 transition-all duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-persian"
            :aria-expanded="mobileOpen"
            aria-label="Open navigation menu"
            @click="openMobile"
          >
            <span class="block w-5 h-[1.5px] bg-snow rounded-full transition-all duration-300"></span>
            <span class="block w-3.5 h-[1.5px] bg-snow rounded-full transition-all duration-300"></span>
            <span class="block w-5 h-[1.5px] bg-snow rounded-full transition-all duration-300"></span>
          </button>
        </div>

      </div>
    </div>

    <!-- Hairline border that fades in when scrolled -->
    <div
      class="absolute inset-x-0 bottom-0 h-px bg-snow/8 transition-opacity duration-500"
      :class="isScrolled ? 'opacity-100' : 'opacity-0'"
      aria-hidden="true"
    ></div>
  </header>

  <!-- ── Mobile fullscreen overlay ─────────────────────────────────────── -->
  <Teleport to="body">
    <div
      v-if="mobileOpen"
      ref="mobileMenuEl"
      class="fixed inset-0 z-[999] flex flex-col bg-oynx/98 backdrop-blur-2xl"
      style="opacity: 0; visibility: hidden"
      role="dialog"
      aria-modal="true"
      aria-label="Navigation menu"
    >
      <!-- Top bar -->
      <div class="flex items-center justify-between px-6 py-5 border-b border-snow/8">
        <Link
          :href="route('welcome')"
          class="flex items-center gap-2.5 group"
          @click="closeMobile"
        >
          <img
            src="/images/logo.png"
            alt="Danny's"
            class="w-8 h-8 rounded-full object-cover"
          />
          <span class="font-bold text-snow text-sm tracking-widest uppercase">Danny's</span>
        </Link>

        <button
          class="w-10 h-10 flex items-center justify-center rounded-full text-snow/55 hover:text-snow hover:bg-snow/10 transition-all duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-persian"
          aria-label="Close navigation menu"
          @click="closeMobile"
        >
          <i class="fa-solid fa-xmark text-xl" aria-hidden="true"></i>
        </button>
      </div>

      <!-- Nav links (large) -->
      <nav
        class="flex-1 flex flex-col justify-center px-8"
        aria-label="Mobile navigation"
      >
        <Link
          v-for="(link, i) in navLinks"
          :key="link.route"
          :ref="el => { if (el) mobileItemEls[i] = el }"
          :href="route(link.route)"
          class="group flex items-center justify-between py-5 border-b border-snow/8 focus:outline-none"
          :class="isActive(link.route) ? 'text-persian' : 'text-snow'"
          style="opacity: 0"
          @click="closeMobile"
        >
          <span
            class="text-3xl sm:text-4xl font-black uppercase tracking-tight transition-colors duration-200 group-hover:text-persian"
          >
            {{ link.label }}
          </span>
          <i
            class="fa-solid fa-arrow-right text-sm opacity-0 -translate-x-2 transition-all duration-200 group-hover:opacity-100 group-hover:translate-x-0"
            aria-hidden="true"
          ></i>
        </Link>
      </nav>

      <!-- Footer contact -->
      <div
        :ref="el => { if (el) mobileItemEls[navLinks.length] = el }"
        class="px-8 py-8 border-t border-snow/8"
        style="opacity: 0"
      >
        <p class="text-snow/35 text-xs font-semibold uppercase tracking-[0.2em] mb-3">
          Contact
        </p>
        <a
          href="tel:+17058886114"
          class="text-snow/60 hover:text-persian text-sm font-medium transition-colors duration-200"
        >
          +1 (705) 888-6114
        </a>
      </div>
    </div>
  </Teleport>
</template>

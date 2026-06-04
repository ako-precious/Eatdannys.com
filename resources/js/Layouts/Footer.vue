<script setup>
import { Link } from '@inertiajs/vue3'
import SocialMedia from '@/Components/SocialMedia.vue'

const year = new Date().getFullYear()

const navLinks = [
  { label: 'Dining & Takeout', route: 'welcome' },
  { label: 'Event Catering', route: 'catering' },
  { label: 'Bakery', route: 'bakery' },
  { label: 'Order Online', route: 'dining' },
]

const contactLinks = [
  {
    label: 'Call',
    value: '+1 (705) 888-6114',
    href: 'tel:+17058886114',
    icon: 'fa-solid fa-phone',
  },
  {
    label: 'Email',
    value: 'dannys20edible@gmail.com',
    href: 'mailto:dannys20edible@gmail.com',
    icon: 'fa-solid fa-envelope',
  },
  {
    label: 'Visit',
    value: '1179 Bayfield Street North, Barrie, ON L9X 0N5',
    href: 'https://www.google.com/maps/place/1179+Bayfield+St+N,+Midhurst,+ON+L9X+0N5/@44.4386183,-79.7351199,17z/data=!3m1!4b1!4m6!3m5!1s0x882aa2716c15c251:0x9937db4094649aa2!8m2!3d44.4386145!4d-79.732545!16s%2Fg%2F11smbsqv3s?entry=ttu',
    icon: 'fa-solid fa-location-dot',
    external: true,
  },
]

const serviceHighlights = [
  'Authentic Nigerian dishes',
  'Takeout and delivery',
  'Private events and catering',
]
</script>

<template>
  <footer class="relative overflow-hidden bg-slate-950 text-white">
    <div class="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-amber-400/70 to-transparent" aria-hidden="true"></div>
    <div class="absolute -top-40 left-8 h-80 w-80 rounded-full bg-amber-500/10 blur-3xl pointer-events-none" aria-hidden="true"></div>
    <div class="absolute bottom-0 right-0 h-96 w-96 rounded-full bg-red-500/10 blur-3xl pointer-events-none" aria-hidden="true"></div>

    <div class="relative mx-auto max-w-7xl px-6 py-16 lg:px-8">
      <div class="grid gap-12 lg:grid-cols-[1.2fr_0.8fr_1fr_0.9fr]">
        <div>
          <Link :href="route('welcome')" class="inline-flex items-center gap-3" aria-label="Danny's home">
            <img src="/images/logo.png" class="h-12 w-12 rounded-full border border-white/15 bg-white object-cover p-1" alt="Danny's" />
            <div>
              <p class="text-base font-black uppercase tracking-[0.18em]">Danny's</p>
              <p class="text-sm font-semibold text-amber-300">African Restaurant</p>
            </div>
          </Link>

          <p class="mt-6 max-w-sm text-sm leading-7 text-slate-300">
            Authentic Nigerian food made for everyday comfort, memorable events, and the kind of meal that brings people back to the table.
          </p>

          <div class="mt-8 flex flex-col gap-3 sm:flex-row">
            <Link
              :href="route('dining')"
              class="inline-flex items-center justify-center gap-2 rounded-lg bg-amber-400 px-4 py-2.5 text-xs font-black uppercase tracking-widest text-slate-950 shadow-lg shadow-amber-500/20 transition hover:bg-amber-300"
            >
              <i class="fa-solid fa-bag-shopping"></i>
              Order Takeout
            </Link>
            <a
              href="tel:+17058886114"
              class="inline-flex items-center justify-center gap-2 rounded-lg border border-white/20 bg-white/5 px-4 py-2.5 text-xs font-black uppercase tracking-widest text-white transition hover:border-amber-300 hover:bg-white/10"
            >
              <i class="fa-solid fa-phone"></i>
              Call Us
            </a>
          </div>
        </div>

        <nav aria-label="Footer navigation">
          <p class="text-sm font-black uppercase tracking-[0.24em] text-amber-300">Explore</p>
          <ul class="mt-5 space-y-3">
            <li v-for="item in navLinks" :key="item.route">
              <Link
                :href="route(item.route)"
                class="group inline-flex items-center gap-2 text-sm font-semibold text-slate-300 transition hover:text-white"
              >
                <span class="h-px w-4 bg-amber-400/50 transition group-hover:w-6 group-hover:bg-amber-300"></span>
                {{ item.label }}
              </Link>
            </li>
          </ul>
        </nav>

        <div>
          <p class="text-sm font-black uppercase tracking-[0.24em] text-amber-300">Contact</p>
          <ul class="mt-5 space-y-4">
            <li v-for="item in contactLinks" :key="item.label">
              <a
                :href="item.href"
                :target="item.external ? '_blank' : undefined"
                :rel="item.external ? 'noopener noreferrer' : undefined"
                class="group flex gap-3 rounded-xl border border-white/10 bg-white/[0.03] p-3 transition hover:border-amber-300/60 hover:bg-white/[0.06]"
              >
                <span class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-md bg-amber-400/15 text-sm text-amber-300">
                  <i :class="item.icon"></i>
                </span>
                <span>
                  <span class="block text-xs font-bold uppercase tracking-widest text-slate-500 group-hover:text-amber-300">{{ item.label }}</span>
                  <span class="mt-1 block text-sm font-semibold leading-6 text-slate-200">{{ item.value }}</span>
                </span>
              </a>
            </li>
          </ul>
        </div>

        <div>
          <p class="text-sm font-black uppercase tracking-[0.24em] text-amber-300">Good To Know</p>
          <ul class="mt-5 space-y-3">
            <li v-for="item in serviceHighlights" :key="item" class="flex items-start gap-3 text-sm font-semibold text-slate-300">
              <i class="fa-solid fa-check mt-1 text-amber-300"></i>
              <span>{{ item }}</span>
            </li>
          </ul>

          <div class="mt-8">
            <p class="mb-4 text-sm font-black uppercase tracking-[0.24em] text-amber-300">Follow</p>
            <div class="footer-social -ml-2 flex justify-start">
              <SocialMedia />
            </div>
          </div>
        </div>
      </div>

      <div class="mt-14 flex flex-col gap-4 border-t border-white/10 pt-6 text-sm text-slate-400 md:flex-row md:items-center md:justify-between">
        <p>Copyright {{ year }} Danny's African Restaurant. All rights reserved.</p>
        <div class="flex flex-wrap gap-x-6 gap-y-2">
          <Link :href="route('welcome')" class="transition hover:text-amber-300">FAQ</Link>
          <Link :href="route('welcome')" class="transition hover:text-amber-300">Privacy Policy</Link>
          <Link :href="route('welcome')" class="transition hover:text-amber-300">Terms & Conditions</Link>
        </div>
      </div>
    </div>
  </footer>
</template>

<style scoped>
.footer-social :deep(.example-2 .icon-content) {
  margin: 0 6px;
}

.footer-social :deep(.example-2 .icon-content a) {
  width: 38px;
  height: 38px;
}

.footer-social :deep(.example-2 .icon-content a svg) {
  width: 20px;
  height: 20px;
}
</style>

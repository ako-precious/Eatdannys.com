<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import { Head } from '@inertiajs/vue3'
import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'
import Header from '@/Pages/Header/Index.vue'
import Footer from '@/Layouts/Footer.vue'
import Testimonial from '@/Layouts/Testimonial.vue'
import Reservation from '@/Layouts/Reservation.vue'

gsap.registerPlugin(ScrollTrigger)

defineProps({ canLogin: Boolean, canRegister: Boolean })

// ─── Data ─────────────────────────────────────────────────────────────────────

const services = [
  {
    slug: 'wedding',
    title: 'Wedding',
    subtitle: 'Ceremony',
    tagline: 'Romance & Elegance',
    icon: '💍',
    description: 'Your dream day deserves a culinary masterpiece. From elegant plated dinners to lavish buffets, we craft a menu as unique and timeless as your love story.',
    image: 'images/wedding.jpg',
    video: 'images/wedding.mp4',
    accent: '#d4a76a',
  },
  {
    slug: 'anniversary',
    title: 'Anniversary',
    subtitle: 'Celebration',
    tagline: 'Memories & Milestones',
    icon: '🥂',
    description: 'Honour the journey with food that stirs the soul. Sophisticated, warm, and rooted in meaning — every bite a tribute to what you\'ve built together.',
    image: 'images/anniversary.jpg',
    video: 'images/anniversary.mp4',
    accent: '#a8b8cc',
  },
  {
    slug: 'birthday',
    title: 'Birthday',
    subtitle: 'Party',
    tagline: 'Energy & Excitement',
    icon: '🎂',
    description: 'Vibrant, joyful, full of flavour. We turn birthdays into experiences — from intimate dinners to full-scale celebrations that leave every guest talking.',
    image: 'images/birthday.jpg',
    video: 'images/birthday.mp4',
    accent: '#e8956d',
  },
  {
    slug: 'foodbox',
    title: 'Food',
    subtitle: 'Boxing',
    tagline: 'Convenience & Precision',
    icon: '🍱',
    description: 'Individually portioned gourmet meals, freshly prepared and perfectly packaged for corporate meetings, team lunches, or large-group outings.',
    image: 'images/foodboxing.png',
    video: 'images/foodboxing.mp4',
    accent: '#8fbf9f',
  },
]

const stats = [
  { value: 500, suffix: '+',  label: 'Events Catered' },
  { value: 98,  suffix: '%',  label: 'Client Satisfaction' },
  { value: 8,   suffix: '+',  label: 'Years of Excellence' },
  { value: 12,  suffix: 'k+', label: 'Guests Served' },
]

const whyItems = [
  { icon: '🍽️', title: 'Authentic Cuisine',     desc: 'Rooted in Nigerian culinary tradition, elevated for every occasion.' },
  { icon: '👨‍🍳', title: 'Expert Chefs',          desc: 'Years of professional experience behind every dish we deliver.' },
  { icon: '🌿', title: 'Fresh Ingredients',     desc: 'Locally and seasonally sourced for peak flavour in every bite.' },
  { icon: '📋', title: 'Tailored to You',       desc: 'No two events are the same. We personalise every menu to your vision.' },
  { icon: '⏱️', title: 'Punctual Delivery',     desc: 'We respect your timeline — food arrives hot, fresh, and on schedule.' },
  { icon: '💬', title: 'White-Glove Service',   desc: 'Dedicated coordination from your first call to the final plate.' },
]

// ─── DOM refs ─────────────────────────────────────────────────────────────────

const heroSection     = ref(null)
const charRefs        = ref([])
const heroSubtitle    = ref(null)
const heroCta         = ref(null)
const statsSection    = ref(null)
const statEls         = ref([])
const serviceSections = ref([])
const whySection      = ref(null)
const bookingSection  = ref(null)
const floatingCta     = ref(null)

const titleText  = "EAT DANNY'S"
const titleChars = computed(() => titleText.split('').map((char, i) => ({ char, i })))

// ─── Motion preference ────────────────────────────────────────────────────────

const reduceMotion = typeof window !== 'undefined'
  ? window.matchMedia('(prefers-reduced-motion: reduce)').matches
  : false

// ─── GSAP ─────────────────────────────────────────────────────────────────────

let ctx = null

onMounted(() => {
  if (reduceMotion) return

  ctx = gsap.context(() => {

    // 1 ── Hero title: staggered character lift
    gsap.from(charRefs.value, {
      y: '110%',
      opacity: 0,
      rotationX: -80,
      transformOrigin: '50% 100%',
      duration: 1,
      stagger: 0.035,
      ease: 'expo.out',
      delay: 0.2,
    })

    // 2 ── Hero subtitle + CTA fade-blur-up
    gsap.from([heroSubtitle.value, heroCta.value], {
      y: 30,
      opacity: 0,
      filter: 'blur(12px)',
      duration: 1.1,
      stagger: 0.2,
      ease: 'power3.out',
      delay: 1.0,
    })

    // 3 ── Hero background parallax
    gsap.to('.hero-bg-img', {
      yPercent: 22,
      ease: 'none',
      scrollTrigger: {
        trigger: heroSection.value,
        start: 'top top',
        end: 'bottom top',
        scrub: 1.2,
      },
    })

    // 4 ── Stats counters (scroll-triggered)
    statEls.value.forEach((el, i) => {
      if (!el) return
      const stat  = stats[i]
      const obj   = { val: 0 }
      const numEl = el.querySelector('.stat-num')
      gsap.to(obj, {
        val: stat.value,
        duration: 2.8,
        ease: 'power2.out',
        onUpdate() { if (numEl) numEl.textContent = Math.round(obj.val) + stat.suffix },
        scrollTrigger: { trigger: el, start: 'top 88%', once: true },
      })
    })

    // 5 ── Service sections
    serviceSections.value.forEach((section, i) => {
      if (!section) return
      const isEven  = i % 2 === 0
      const media   = section.querySelector('.service-media')
      const inner   = section.querySelector('.media-inner')
      const tagline = section.querySelector('.service-tagline')
      const title   = section.querySelector('.service-title')
      const desc    = section.querySelector('.service-desc')
      const cta     = section.querySelector('.service-cta')

      gsap.from(media, {
        xPercent: isEven ? 6 : -6,
        opacity: 0,
        scale: 1.04,
        duration: 1.4,
        ease: 'power3.out',
        scrollTrigger: { trigger: section, start: 'top 75%' },
      })

      gsap.from([tagline, title, desc, cta].filter(Boolean), {
        y: 40,
        opacity: 0,
        duration: 0.95,
        stagger: 0.13,
        ease: 'power3.out',
        scrollTrigger: { trigger: section, start: 'top 68%' },
      })

      // Video inner parallax while scrolling
      if (inner) {
        gsap.to(inner, {
          yPercent: -14,
          ease: 'none',
          scrollTrigger: {
            trigger: section,
            start: 'top bottom',
            end: 'bottom top',
            scrub: 1.8,
          },
        })
      }
    })

    // 6 ── Why-cards stagger entrance
    const cards = whySection.value?.querySelectorAll('.why-card')
    if (cards?.length) {
      gsap.from(cards, {
        y: 60,
        opacity: 0,
        scale: 0.94,
        duration: 0.85,
        stagger: 0.09,
        ease: 'power3.out',
        scrollTrigger: { trigger: whySection.value, start: 'top 72%' },
      })
    }

    // 7 ── Booking section reveal
    if (bookingSection.value) {
      gsap.from(bookingSection.value.querySelectorAll('.book-anim'), {
        y: 44,
        opacity: 0,
        duration: 1,
        stagger: 0.14,
        ease: 'power3.out',
        scrollTrigger: { trigger: bookingSection.value, start: 'top 78%' },
      })
    }

    // 8 ── Floating CTA gentle float
    if (floatingCta.value) {
      gsap.to(floatingCta.value, {
        y: -7,
        duration: 1.8,
        ease: 'sine.inOut',
        yoyo: true,
        repeat: -1,
      })
    }
  })
})

onUnmounted(() => {
  ctx?.revert()
})
</script>

<template>
  <Head title="Catering Services — Danny's" />

  <!-- ── Floating CTA (desktop only) ──────────────────────────────────── -->
  <div
    ref="floatingCta"
    class="fixed bottom-8 right-8 z-50 hidden md:block"
    style="filter: drop-shadow(0 8px 24px rgba(236,167,44,0.4))"
  >
    <a
      href="#booking"
      class="flex items-center gap-2 bg-persian text-oynx font-bold text-sm uppercase tracking-wider px-5 py-3 rounded-full transition-all duration-300 hover:brightness-110 hover:scale-105"
    >
      <i class="fa-solid fa-utensils text-xs"></i>
      Book Your Event
    </a>
  </div>

  <div class="bg-oynx text-snow overflow-x-hidden">

    <Header />

    <!-- ══════════════════════════════════════════════════════════════════
         HERO
    ═══════════════════════════════════════════════════════════════════════ -->
    <section
      ref="heroSection"
      class="relative min-h-screen flex flex-col items-center justify-center overflow-hidden"
    >
      <!-- Parallax background -->
      <div class="hero-bg absolute inset-0 overflow-hidden">
        <img
          src="images/keesha-s-kitchen-3gbiqiGJYUc-unsplash.jpg"
          alt=""
          aria-hidden="true"
          class="hero-bg-img absolute inset-0 w-full object-cover"
          style="height: 130%; top: -15%"
        />
        <div class="absolute inset-0 bg-gradient-to-b from-oynx/75 via-oynx/55 to-oynx"></div>
      </div>

      <!-- Animated grain overlay -->
      <div
        aria-hidden="true"
        class="grain-overlay absolute inset-0 pointer-events-none z-10"
      ></div>

      <!-- Warm radial glow -->
      <div
        aria-hidden="true"
        class="absolute inset-0 z-10 pointer-events-none"
        style="background: radial-gradient(ellipse 70% 50% at 50% 40%, rgba(236,167,44,0.09) 0%, transparent 70%)"
      ></div>

      <!-- Hero content -->
      <div class="relative z-20 text-center px-6 max-w-6xl mx-auto">

        <!-- Badge -->
        <div class="inline-flex items-center gap-2 bg-persian/15 border border-persian/30 text-persian text-xs font-bold uppercase tracking-[0.18em] px-4 py-2 rounded-full mb-10">
          <i class="fa-solid fa-star" style="font-size: 9px"></i>
          Premium Catering Services
          <i class="fa-solid fa-star" style="font-size: 9px"></i>
        </div>

        <!-- Title with per-character GSAP targets -->
        <div class="overflow-hidden pb-2">
          <h1 class="text-[13vw] sm:text-[11vw] md:text-[9vw] font-black uppercase leading-none tracking-tight">
            <span
              v-for="item in titleChars"
              :key="item.i"
              :ref="el => { if (el) charRefs[item.i] = el }"
              class="inline-block"
              :style="item.char === ' ' ? 'width: 0.28em; display: inline-block' : ''"
            >{{ item.char === ' ' ? ' ' : item.char }}</span>
          </h1>
        </div>

        <!-- Subtitle -->
        <p
          ref="heroSubtitle"
          class="mt-6 text-lg md:text-xl text-snow/62 max-w-xl mx-auto leading-relaxed"
        >
          Crafting unforgettable culinary experiences for weddings, anniversaries,
          birthdays, and corporate events.
        </p>

        <!-- CTAs -->
        <div
          ref="heroCta"
          class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4"
        >
          <Reservation />
          <a
            href="#services"
            class="group flex items-center gap-2 border border-snow/25 text-snow/75 hover:text-snow hover:border-snow/55 font-semibold text-sm uppercase tracking-wider px-6 py-3 rounded-lg transition-all duration-300"
          >
            Explore Services
            <i class="fa-solid fa-arrow-down transition-transform duration-300 group-hover:translate-y-1"></i>
          </a>
        </div>
      </div>

      <!-- Scroll hint -->
      <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20 flex flex-col items-center gap-2 text-snow/35 text-xs uppercase tracking-widest pointer-events-none">
        <span>Scroll</span>
        <i class="fa-solid fa-chevron-down animate-bounce"></i>
      </div>
    </section>

    <!-- ══════════════════════════════════════════════════════════════════
         STATS STRIP
    ═══════════════════════════════════════════════════════════════════════ -->
    <section ref="statsSection" class="border-y border-persian/20 bg-persian/5">
      <div class="container mx-auto px-6 py-14 grid grid-cols-2 md:grid-cols-4 divide-persian/15 md:divide-x">
        <div
          v-for="(stat, i) in stats"
          :key="stat.label"
          :ref="el => { if (el) statEls[i] = el }"
          class="flex flex-col items-center text-center py-4 md:py-0 px-6"
        >
          <span class="stat-num text-4xl md:text-5xl font-black text-persian tabular-nums">
            0{{ stat.suffix }}
          </span>
          <span class="mt-2 text-snow/45 text-xs uppercase tracking-widest">{{ stat.label }}</span>
        </div>
      </div>
    </section>

    <!-- ══════════════════════════════════════════════════════════════════
         SERVICE SECTIONS
    ═══════════════════════════════════════════════════════════════════════ -->
    <div id="services">
      <section
        v-for="(service, i) in services"
        :key="service.slug"
        :ref="el => { if (el) serviceSections[i] = el }"
        class="relative flex flex-col min-h-screen border-b border-snow/5"
        :class="i % 2 === 0 ? 'md:flex-row' : 'md:flex-row-reverse'"
      >

        <!-- Media panel -->
        <div class="service-media relative w-full md:w-1/2 min-h-[60vw] md:min-h-screen overflow-hidden">
          <div class="media-inner absolute inset-0" style="scale: 1.12">
            <video
              class="w-full h-full object-cover"
              autoplay
              muted
              loop
              playsinline
              :poster="service.image"
              preload="none"
              onloadedmetadata="this.playbackRate = 0.6"
            >
              <source :src="service.video" type="video/mp4" />
            </video>
            <!-- Dim overlay for readability on mobile -->
            <div class="absolute inset-0 bg-oynx/30 md:hidden"></div>
          </div>

          <!-- Gradient vignette toward text -->
          <div
            class="absolute inset-0 pointer-events-none"
            :class="i % 2 === 0
              ? 'bg-gradient-to-r from-transparent via-transparent to-oynx'
              : 'bg-gradient-to-l from-transparent via-transparent to-oynx'"
          ></div>
          <!-- Bottom fade for mobile stacking -->
          <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-oynx md:hidden pointer-events-none"></div>

          <!-- Giant index number watermark -->
          <div
            aria-hidden="true"
            class="absolute bottom-4 font-black leading-none select-none pointer-events-none opacity-[0.055]"
            :class="i % 2 === 0 ? 'right-4 text-right' : 'left-4'"
            :style="{ color: service.accent, fontSize: 'min(18vw, 160px)' }"
          >0{{ i + 1 }}</div>
        </div>

        <!-- Text panel -->
        <div class="service-text relative z-10 w-full md:w-1/2 flex items-center bg-oynx">
          <div class="w-full px-8 md:px-16 lg:px-20 py-16">

            <span
              class="service-tagline inline-flex items-center gap-2 text-xs font-bold uppercase tracking-[0.22em] mb-6"
              :style="{ color: service.accent }"
            >
              {{ service.icon }} {{ service.tagline }}
            </span>

            <h2 class="service-title font-black uppercase leading-none mb-6" style="font-size: clamp(2.5rem, 5vw, 4.5rem)">
              <span class="block text-snow">{{ service.title }}</span>
              <span :style="{ color: service.accent }">{{ service.subtitle }}</span>
            </h2>

            <p class="service-desc text-snow/60 leading-relaxed max-w-md mb-10" style="font-size: clamp(0.95rem, 1.5vw, 1.1rem)">
              {{ service.description }}
            </p>

            <div class="service-cta">
              <Reservation />
            </div>
          </div>
        </div>

      </section>
    </div>

    <!-- ══════════════════════════════════════════════════════════════════
         WHY CHOOSE US
    ═══════════════════════════════════════════════════════════════════════ -->
    <section ref="whySection" class="py-24 relative overflow-hidden" style="background: #1a1618">

      <div
        aria-hidden="true"
        class="absolute inset-0 pointer-events-none"
        style="background: radial-gradient(ellipse 65% 65% at 80% 50%, rgba(236,167,44,0.05) 0%, transparent 70%)"
      ></div>

      <div class="container mx-auto px-6 relative z-10">

        <div class="text-center mb-16">
          <span class="text-xs font-bold uppercase tracking-[0.22em] text-persian mb-4 block">Our Commitment</span>
          <h2 class="font-black uppercase leading-tight" style="font-size: clamp(2rem, 5vw, 3.5rem)">
            Why Choose<br />
            <span class="text-persian">Danny's?</span>
          </h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
          <div
            v-for="item in whyItems"
            :key="item.title"
            class="why-card group relative rounded-2xl p-8 border transition-all duration-500 cursor-default"
            style="background: rgba(34,30,34,0.6); border-color: rgba(255,255,255,0.07)"
            onmouseenter="this.style.borderColor='rgba(236,167,44,0.35)'; this.style.transform='translateY(-4px)'"
            onmouseleave="this.style.borderColor='rgba(255,255,255,0.07)'; this.style.transform='translateY(0)'"
          >
            <div class="text-4xl mb-5 leading-none">{{ item.icon }}</div>
            <h3 class="font-bold text-lg text-snow mb-3">{{ item.title }}</h3>
            <p class="text-sm leading-relaxed" style="color: rgba(255,252,249,0.52)">{{ item.desc }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- ══════════════════════════════════════════════════════════════════
         TESTIMONIALS
    ═══════════════════════════════════════════════════════════════════════ -->
    <section class="bg-oynx py-4 border-t" style="border-color: rgba(255,255,255,0.07)">
      <Testimonial />
    </section>

    <!-- ══════════════════════════════════════════════════════════════════
         BOOKING CTA
    ═══════════════════════════════════════════════════════════════════════ -->
    <section
      id="booking"
      ref="bookingSection"
      class="relative py-32 text-center overflow-hidden"
    >
      <!-- Background image -->
      <div class="absolute inset-0">
        <img
          src="images/keesha-s-kitchen-PqG32DYCTM8-unsplash.jpg"
          alt=""
          aria-hidden="true"
          class="w-full h-full object-cover"
        />
        <div class="absolute inset-0 bg-oynx/88"></div>
      </div>

      <!-- Warm glow -->
      <div
        aria-hidden="true"
        class="absolute inset-0 pointer-events-none"
        style="background: radial-gradient(ellipse 55% 55% at 50% 50%, rgba(236,167,44,0.11) 0%, transparent 70%)"
      ></div>

      <div class="relative z-10 container mx-auto px-6 max-w-3xl">
        <span class="book-anim inline-block text-persian text-xs font-bold uppercase tracking-[0.22em] mb-6">
          Let's Create Something Extraordinary
        </span>
        <h2
          class="book-anim font-black uppercase leading-tight mb-6"
          style="font-size: clamp(2.2rem, 5vw, 4rem)"
        >
          Your Perfect Event<br />
          <span class="text-persian">Starts Here</span>
        </h2>
        <p class="book-anim text-lg leading-relaxed mb-10" style="color: rgba(255,252,249,0.58)">
          From intimate gatherings to grand celebrations — we handle every
          detail so you can focus on the moments that matter.
        </p>
        <div class="book-anim flex flex-col sm:flex-row items-center justify-center gap-4">
          <Reservation />
          <a
            href="tel:+17058886114"
            class="group flex items-center gap-2 border font-semibold text-sm uppercase tracking-wider px-6 py-3 rounded-lg transition-all duration-300 hover:scale-105"
            style="border-color: rgba(255,255,255,0.25); color: rgba(255,252,249,0.75)"
            onmouseenter="this.style.borderColor='rgba(255,255,255,0.55)'; this.style.color='#FFFCF9'"
            onmouseleave="this.style.borderColor='rgba(255,255,255,0.25)'; this.style.color='rgba(255,252,249,0.75)'"
          >
            <i class="fa-solid fa-phone"></i>
            +1 (705) 888-6114
          </a>
        </div>
      </div>
    </section>

    <Footer />
  </div>
</template>

<style scoped>
/* Animated film-grain effect */
.grain-overlay {
  background-image: url('images/noise.png');
  opacity: 0.045;
  mix-blend-mode: overlay;
  animation: grain 0.35s steps(2) infinite;
}

@keyframes grain {
  0%, 100% { background-position: 0 0; }
  25%       { background-position: 12% 18%; }
  50%       { background-position: -6% 9%; }
  75%       { background-position: 9% -12%; }
}

/* Smooth anchor scrolling */
:global(html) {
  scroll-behavior: smooth;
}
</style>

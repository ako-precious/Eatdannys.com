<script setup>
import { ref, computed, onMounted, onUnmounted, nextTick } from 'vue'
import { Head, Link } from '@inertiajs/vue3'
import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'
import Header from '@/Pages/Header/Index.vue'
import Gridtemplate from '@/Layouts/Gridtemplate.vue'
import Testimonial from '@/Layouts/Testimonial.vue'
import Footer from '@/Layouts/Footer.vue'
import Reservation from '@/Layouts/Reservation.vue'

gsap.registerPlugin(ScrollTrigger)

defineProps({ canLogin: Boolean, canRegister: Boolean })

// ─── Hero title — split into words for staggered reveal ───────────────────────
const heroTitleText  = "Authentic Nigerian Flavours, Served With Elegance"
const heroTitleWords = heroTitleText.split(' ')

// ─── DOM refs ─────────────────────────────────────────────────────────────────
const progressRef          = ref(null)
const heroRef              = ref(null)
const heroImageLayerRef    = ref(null)
const heroContentRef       = ref(null)
const wordRefs             = ref([])   // per-word spans for stagger
const heroSubtitleRef      = ref(null)
const heroCtaRef           = ref(null)
const signatureCardsRef    = ref([])   // [0,1,2]
const signatureSectionRef  = ref(null)
const popularSectionRef    = ref(null)
const popularHeadingRef    = ref(null)
const dishCardRefs         = ref([])   // [0,1,2]
const exploreHeadingRef    = ref(null)
const exploreSectionRef    = ref(null)
const gridSectionRef       = ref(null)
const testimonialSection   = ref(null)
const testimonialImageRef  = ref(null)
const testimonialCardRef   = ref(null)
const finalCtaRef          = ref(null)
const finalCtaHeadingRef   = ref(null)
const finalCtaButtonsRef   = ref(null)
const footerRef            = ref(null)

// ─── Motion preference ────────────────────────────────────────────────────────
const reduceMotion = typeof window !== 'undefined'
  ? window.matchMedia('(prefers-reduced-motion: reduce)').matches
  : false

// ─── Event-listener cleanup registry ─────────────────────────────────────────
const cleanupFns = []
const addListener = (el, event, fn, opts) => {
  if (!el) return
  el.addEventListener(event, fn, opts)
  cleanupFns.push(() => el.removeEventListener(event, fn))
}

// ─── GSAP ─────────────────────────────────────────────────────────────────────
let ctx = null

onMounted(async () => {
  if (reduceMotion) return

  await nextTick()

  const isMobile = window.innerWidth < 768

  ScrollTrigger.refresh()
  window.addEventListener('load', () => ScrollTrigger.refresh(), { once: true })

  ctx = gsap.context(() => {

    // ── SCROLL PROGRESS BAR ──────────────────────────────────────────────────
    if (progressRef.value) {
      gsap.to(progressRef.value, {
        width: '100%',
        ease: 'none',
        scrollTrigger: {
          trigger: document.body,
          start: 'top top',
          end: 'bottom bottom',
          scrub: 0.3,
        },
      })
    }

    // ── HERO ─────────────────────────────────────────────────────────────────

    // Hero image layer: floating entrance
    if (heroImageLayerRef.value) {
      gsap.fromTo(heroImageLayerRef.value,
        { autoAlpha: 0, y: 40, scale: 0.95 },
        { autoAlpha: 1, y: 0, scale: 1, duration: 1.2, ease: 'power3.out', delay: 0.15 }
      )
    }

    // Orchestrated hero entrance: words → subtitle → CTA
    const heroTl = gsap.timeline({ delay: 0.35 })

    // Word-by-word 3D lift with stagger
    const words = wordRefs.value.filter(Boolean)
    if (words.length) {
      heroTl.fromTo(
        words,
        { yPercent: 110, autoAlpha: 0, rotationX: -80, transformOrigin: '50% 100%' },
        {
          yPercent: 0, autoAlpha: 1, rotationX: 0,
          duration: 0.75,
          stagger: { each: 0.06, ease: 'power2.out' },
          ease: 'expo.out',
        }
      )
    }

    // Subtitle: blur-to-sharp fade-up
    if (heroSubtitleRef.value) {
      heroTl.fromTo(heroSubtitleRef.value,
        { y: 20, autoAlpha: 0, filter: 'blur(12px)' },
        { y: 0, autoAlpha: 1, filter: 'blur(0px)', duration: 0.95, ease: 'power3.out' },
        '-=0.4'
      )
    }

    // CTA buttons staggered entrance
    if (heroCtaRef.value) {
      const btns = heroCtaRef.value.querySelectorAll('button, a')
      heroTl.fromTo(btns,
        { y: 20, autoAlpha: 0 },
        { y: 0, autoAlpha: 1, duration: 0.7, stagger: 0.12, ease: 'power3.out' },
        '-=0.5'
      )
    }

    // Gentle floating motion to CTA buttons
    heroTl.call(() => {
      if (heroCtaRef.value) {
        const btns = heroCtaRef.value.querySelectorAll('button, a')
        gsap.to(btns, {
          y: -5, duration: 2.4, ease: 'sine.inOut', yoyo: true, repeat: -1, stagger: 0.2,
        })
      }
    })

    // Magnetic hover on CTA buttons (desktop)
    if (!isMobile && heroCtaRef.value) {
      heroCtaRef.value.querySelectorAll('button, a').forEach(btn => {
        const onMove = (e) => {
          const r = btn.getBoundingClientRect()
          gsap.to(btn, {
            x: (e.clientX - r.left - r.width  / 2) * 0.25,
            y: (e.clientY - r.top  - r.height / 2) * 0.2,
            duration: 0.3, ease: 'power2.out',
          })
        }
        const onLeave = () => gsap.to(btn, { x: 0, y: 0, duration: 0.6, ease: 'elastic.out(1.1, 0.45)' })
        addListener(btn, 'mousemove', onMove)
        addListener(btn, 'mouseleave', onLeave)
      })
    }

    // ── SIGNATURE EXPERIENCE SECTION ────────────────────────────────────────────
    if (signatureSectionRef.value) {
      const cards = signatureCardsRef.value.filter(Boolean)
      if (cards.length) {
        gsap.fromTo(cards,
          { y: 50, autoAlpha: 0, scale: 0.92 },
          {
            y: 0, autoAlpha: 1, scale: 1,
            duration: 0.85, stagger: 0.15, ease: 'power3.out',
            scrollTrigger: { trigger: signatureSectionRef.value, start: 'top 75%', once: true, invalidateOnRefresh: true },
          }
        )

        // Hover lift effect (desktop)
        if (!isMobile) {
          cards.forEach(card => {
            const onEnter = () => {
              gsap.to(card, { y: -8, boxShadow: '0 20px 50px rgba(212, 167, 106, 0.15)', duration: 0.4, ease: 'power2.out' })
            }
            const onLeave = () => {
              gsap.to(card, { y: 0, boxShadow: '0 8px 20px rgba(0, 0, 0, 0.1)', duration: 0.5, ease: 'power3.out' })
            }
            addListener(card, 'mouseenter', onEnter)
            addListener(card, 'mouseleave', onLeave)
          })
        }
      }
    }

    // ── POPULAR DISHES ───────────────────────────────────────────────────────
    if (popularSectionRef.value) {

      // Section heading slide in
      if (popularHeadingRef.value) {
        gsap.fromTo(popularHeadingRef.value,
          { y: 40, autoAlpha: 0 },
          {
            y: 0, autoAlpha: 1, duration: 0.8, ease: 'power3.out',
            scrollTrigger: { trigger: popularSectionRef.value, start: 'top 80%', once: true, invalidateOnRefresh: true },
          }
        )
      }

      // Dish cards: staggered fade-up + scale
      const cards = dishCardRefs.value.filter(Boolean)
      if (cards.length) {
        gsap.fromTo(cards,
          { y: 60, autoAlpha: 0, scale: 0.93 },
          {
            y: 0, autoAlpha: 1, scale: 1,
            duration: 0.9, stagger: 0.16, ease: 'power3.out',
            scrollTrigger: { trigger: popularSectionRef.value, start: 'top 72%', once: true, invalidateOnRefresh: true },
          }
        )

        // Badge pop after cards appear
        cards.forEach(card => {
          const badge = card.querySelector('.dish-badge')
          if (badge) {
            gsap.fromTo(badge,
              { scale: 0, autoAlpha: 0 },
              {
                scale: 1, autoAlpha: 1, duration: 0.5, ease: 'back.out(2.2)',
                scrollTrigger: { trigger: card, start: 'top 75%', once: true, invalidateOnRefresh: true },
              }
            )
          }
        })

        // GSAP hover: lift + image scale + overlay fade (desktop)
        if (!isMobile) {
          cards.forEach(card => {
            const img     = card.querySelector('img')
            const overlay = card.querySelector('.card-overlay')

            const onEnter = () => {
              gsap.to(card, { y: -12, scale: 1.04, boxShadow: '0 30px 60px rgba(212, 167, 106, 0.2)', duration: 0.42, ease: 'power2.out' })
              if (img)     gsap.to(img,     { scale: 1.1, duration: 0.6, ease: 'power2.out' })
              if (overlay) gsap.to(overlay, { opacity: 0.02, duration: 0.4 })
            }
            const onLeave = () => {
              gsap.to(card, { y: 0, scale: 1, boxShadow: '0 8px 20px rgba(0, 0, 0, 0.08)', duration: 0.52, ease: 'power3.out' })
              if (img)     gsap.to(img,     { scale: 1, duration: 0.6, ease: 'power3.out' })
              if (overlay) gsap.to(overlay, { opacity: 0.2, duration: 0.4 })
            }
            addListener(card, 'mouseenter', onEnter)
            addListener(card, 'mouseleave', onLeave)
          })
        }
      }
    }

    // ── EXPLORE SECTION ─────────────────────────────────────────────────────────
    if (exploreSectionRef.value) {

      // Heading animation
      if (exploreHeadingRef.value) {
        gsap.fromTo(exploreHeadingRef.value,
          { y: 40, autoAlpha: 0 },
          {
            y: 0, autoAlpha: 1, duration: 0.8, ease: 'power3.out',
            scrollTrigger: { trigger: exploreSectionRef.value, start: 'top 80%', once: true, invalidateOnRefresh: true },
          }
        )
      }

      // Grid section fade-up
      gsap.fromTo(exploreSectionRef.value,
        { y: 50, autoAlpha: 0 },
        {
          y: 0, autoAlpha: 1, duration: 1, ease: 'power3.out',
          scrollTrigger: { trigger: exploreSectionRef.value, start: 'top 75%', once: true, invalidateOnRefresh: true },
        }
      )
    }

    // ── TESTIMONIAL SECTION ───────────────────────────────────────────────────
    if (testimonialSection.value) {

      // Image column: clip-path wipe from right
      if (testimonialImageRef.value) {
        gsap.fromTo(testimonialImageRef.value,
          { clipPath: 'inset(0% 100% 0% 0%)' },
          {
            clipPath: 'inset(0% 0% 0% 0%)',
            duration: 1.5, ease: 'power3.inOut',
            scrollTrigger: { trigger: testimonialSection.value, start: 'top 70%', once: true, invalidateOnRefresh: true },
          }
        )

        // Image parallax (desktop)
        if (!isMobile) {
          gsap.to(testimonialImageRef.value,
            {
              yPercent: -10, ease: 'none',
              scrollTrigger: {
                trigger: testimonialSection.value,
                start: 'top bottom', end: 'bottom top',
                scrub: 1.8, invalidateOnRefresh: true,
              },
            }
          )
        }
      }

      // Testimonial card: fade-up slide
      if (testimonialCardRef.value) {
        gsap.fromTo(testimonialCardRef.value,
          { y: 50, autoAlpha: 0, scale: 0.96 },
          {
            y: 0, autoAlpha: 1, scale: 1, duration: 1.1, ease: 'power3.out',
            scrollTrigger: { trigger: testimonialSection.value, start: 'top 65%', once: true, invalidateOnRefresh: true },
          }
        )
      }
    }

    // ── FINAL CTA SECTION ───────────────────────────────────────────────────────
    if (finalCtaRef.value) {

      // Heading animation
      if (finalCtaHeadingRef.value) {
        const headingWords = finalCtaHeadingRef.value.querySelectorAll('span')
        if (headingWords.length) {
          gsap.fromTo(headingWords,
            { y: 30, autoAlpha: 0 },
            {
              y: 0, autoAlpha: 1, duration: 0.8, stagger: 0.1, ease: 'power3.out',
              scrollTrigger: { trigger: finalCtaRef.value, start: 'top 75%', once: true, invalidateOnRefresh: true },
            }
          )
        }
      }

      // Buttons entrance
      if (finalCtaButtonsRef.value) {
        const btns = finalCtaButtonsRef.value.querySelectorAll('button, a')
        gsap.fromTo(btns,
          { y: 25, autoAlpha: 0 },
          {
            y: 0, autoAlpha: 1, duration: 0.8, stagger: 0.15, ease: 'power3.out',
            scrollTrigger: { trigger: finalCtaRef.value, start: 'top 70%', once: true, invalidateOnRefresh: true },
          }
        )
      }

      // Glow pulse animation
      const glow = finalCtaRef.value.querySelector('.final-glow')
      if (glow) {
        gsap.to(glow, {
          opacity: [0.15, 0.3, 0.15],
          scale: [1, 1.15, 1],
          duration: 4,
          ease: 'sine.inOut',
          repeat: -1,
        })
      }
    }

    // ── FOOTER ───────────────────────────────────────────────────────────────
    if (footerRef.value) {
      gsap.fromTo(footerRef.value,
        { y: 30, autoAlpha: 0 },
        {
          y: 0, autoAlpha: 1, duration: 0.85, ease: 'power3.out',
          scrollTrigger: { trigger: footerRef.value, start: 'top 90%', once: true, invalidateOnRefresh: true },
        }
      )
    }

  }) // end gsap.context
})

onUnmounted(() => {
  ctx?.revert()
  cleanupFns.forEach(fn => fn())
  cleanupFns.length = 0
})
</script>

<template>
  <Head title="Dining & Takeout — Danny's" />

  <!-- ── Scroll progress bar ──────────────────────────────────────────── -->
  <div
    ref="progressRef"
    class="fixed top-0 left-0 h-1 bg-gradient-to-r from-amber-600 via-amber-500 to-amber-400 z-[9999] w-0 pointer-events-none"
    aria-hidden="true"
    style="box-shadow: 0 0 12px rgba(217, 119, 6, 0.6)"
  ></div>

  <div class="w-screen overflow-x-hidden min-h-screen flex flex-col bg-white">

    <!-- Header -->
    <Header />

    <!-- ══════════════════════════════════════════════════════════════════
         HERO: Split Layout
    ═══════════════════════════════════════════════════════════════════════ -->
    <section
      ref="heroRef"
      class="relative w-full min-h-[100vh] flex items-center overflow-hidden pt-20 pb-20"
      style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 50%, #ffffff 100%)"
    >
      <!-- Decorative gradient orb -->
      <div
        class="absolute -top-40 -left-40 w-96 h-96 bg-amber-300 rounded-full opacity-5 blur-3xl pointer-events-none"
        aria-hidden="true"
      ></div>
      <div
        class="absolute top-1/3 -right-20 w-72 h-72 bg-red-300 rounded-full opacity-3 blur-3xl pointer-events-none"
        aria-hidden="true"
      ></div>

      <div class="container mx-auto px-6 lg:px-12 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">

          <!-- LEFT: Hero Content -->
          <div ref="heroContentRef" class="text-slate-900">

            <!-- Headline -->
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-black uppercase leading-[1.1] mb-6">
              <span
                v-for="(word, wi) in heroTitleWords"
                :key="wi"
                class="inline-block overflow-hidden align-bottom"
                :style="wi < heroTitleWords.length - 1 ? 'margin-right: 0.15em' : ''"
              >
                <span
                  :ref="el => { if (el) wordRefs[wi] = el }"
                  class="inline-block"
                  style="will-change: transform, opacity"
                >{{ word }}</span>
              </span>
            </h1>

            <!-- Subtitle -->
            <p
              ref="heroSubtitleRef"
              class="text-lg md:text-xl text-slate-600 leading-relaxed mb-8 max-w-lg"
              style="will-change: transform, opacity"
            >
              From rich party jollof to soulful soups and soft pounded yam, every dish is prepared to make your table feel like home.
            </p>

            <!-- Trust signals -->
            <div class="flex flex-col sm:flex-row gap-6 mb-10 text-sm font-medium">
              <div class="flex items-center gap-2 text-amber-300">
                <i class="fa-solid fa-check-circle"></i>
                <span>Freshly Prepared</span>
              </div>
              <div class="flex items-center gap-2 text-amber-300">
                <i class="fa-solid fa-leaf"></i>
                <span>Authentic Recipes</span>
              </div>
              <div class="flex items-center gap-2 text-amber-300">
                <i class="fa-solid fa-truck"></i>
                <span>Delivery & Takeout</span>
              </div>
            </div>

            <!-- CTAs -->
            <div
              ref="heroCtaRef"
              class="flex flex-col sm:flex-row gap-4 sm:gap-5"
            >
              <Link
                :href="route('dining')"
                class="group relative inline-flex items-center justify-center gap-3 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 font-bold text-base uppercase tracking-widest px-8 py-4 rounded-xl transition-all duration-300 overflow-hidden shadow-lg hover:shadow-amber-600/50"
                style="will-change: transform"
              >
                <i class="fa-solid fa-shopping-bag text-lg"></i>
                <span>Order Takeout</span>
                <div class="absolute inset-0 bg-white/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-xl"></div>
              </Link>

              <Reservation v-slot="{ open }">
                <button
                  @click="open"
                  class="group inline-flex items-center justify-center gap-3 border-2 border-slate-300 hover:border-amber-500 text-slate-900 font-bold text-base uppercase tracking-widest px-8 py-4 rounded-xl transition-all duration-300 backdrop-blur-sm hover:bg-slate-50"
                  style="will-change: transform"
                >
                  <i class="fa-solid fa-calendar-days text-lg"></i>
                  <span>Reserve a Table</span>
                </button>
              </Reservation>
            </div>
          </div>

          <!-- RIGHT: Image Layer -->
          <div
            ref="heroImageLayerRef"
            class="relative h-96 lg:h-[550px] hidden lg:block"
            style="will-change: transform, opacity"
          >
            <!-- Main image -->
            <div class="absolute inset-0 rounded-3xl overflow-hidden shadow-2xl border border-slate-200">
              <img
                src="images/keesha-s-kitchen-woC24wGXsQ8-unsplash.jpg"
                alt="Nigerian cuisine"
                class="w-full h-full object-cover"
              />
              <div class="absolute inset-0 bg-gradient-to-tr from-black/20 via-transparent to-transparent"></div>
            </div>

            <!-- Floating cards -->
            <div
              class="absolute -bottom-8 -left-8 bg-white backdrop-blur-xl border border-slate-200 rounded-2xl p-6 w-64 shadow-2xl"
              style="animation: float 4s ease-in-out infinite"
            >
              <div class="flex items-center gap-4 mb-3">
                <div class="w-12 h-12 bg-amber-100 rounded-lg flex items-center justify-center text-2xl">🍲</div>
                <div>
                  <p class="text-xs text-slate-500 uppercase tracking-widest">Specialty</p>
                  <p class="font-bold text-slate-900">Jollof Rice</p>
                </div>
              </div>
              <p class="text-sm text-slate-600">Aromatic blend of spices and perfectly cooked rice</p>
            </div>

            <!-- Secondary floating card -->
            <div
              class="absolute top-12 -right-6 bg-white backdrop-blur-xl border border-slate-200 rounded-2xl p-5 w-56 shadow-2xl"
              style="animation: float 5s ease-in-out infinite 0.5s"
            >
              <div class="flex items-center gap-3 mb-2">
                <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center text-xl">🥘</div>
                <div>
                  <p class="text-xs text-slate-500 uppercase tracking-widest">Premium</p>
                  <p class="font-bold text-slate-900">Fresh Soups</p>
                </div>
              </div>
              <p class="text-xs text-slate-600">Made daily with authentic Nigerian ingredients</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ══════════════════════════════════════════════════════════════════
         SIGNATURE EXPERIENCE
    ═══════════════════════════════════════════════════════════════════════ -->
    <section
      ref="signatureSectionRef"
      class="py-20 px-6 bg-gradient-to-b from-white via-slate-50 to-white"
    >
      <div class="container mx-auto">
        <div class="text-center mb-16">
          <p class="text-amber-600 font-bold uppercase tracking-[0.25em] text-sm mb-4">Our Essence</p>
          <h2 class="text-4xl md:text-5xl font-black uppercase text-slate-900 leading-tight">
            More Than Food<br />
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-600 to-amber-700">A Taste of Home</span>
          </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <!-- Card 1 -->
          <div
            :ref="el => { if (el) signatureCardsRef[0] = el }"
            class="group relative p-8 rounded-2xl border border-slate-200 bg-white hover:border-amber-300 transition-all duration-300 cursor-default shadow-sm"
            style="will-change: transform, box-shadow"
          >
            <div class="text-5xl mb-4">🌾</div>
            <h3 class="text-2xl font-black text-slate-900 mb-3">Authentic Recipes</h3>
            <p class="text-slate-600 leading-relaxed">
              Passed down through generations. Every recipe tells a story of Nigerian heritage and family traditions.
            </p>
            <div class="absolute inset-0 rounded-2xl bg-gradient-to-br from-amber-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
          </div>

          <!-- Card 2 -->
          <div
            :ref="el => { if (el) signatureCardsRef[1] = el }"
            class="group relative p-8 rounded-2xl border border-slate-200 bg-white hover:border-amber-300 transition-all duration-300 cursor-default shadow-sm"
            style="will-change: transform, box-shadow"
          >
            <div class="text-5xl mb-4">🔥</div>
            <h3 class="text-2xl font-black text-slate-900 mb-3">Fresh Daily Cooking</h3>
            <p class="text-slate-600 leading-relaxed">
              No pre-made shortcuts. Each dish is prepared fresh to order with premium, hand-selected ingredients.
            </p>
            <div class="absolute inset-0 rounded-2xl bg-gradient-to-br from-amber-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
          </div>

          <!-- Card 3 -->
          <div
            :ref="el => { if (el) signatureCardsRef[2] = el }"
            class="group relative p-8 rounded-2xl border border-slate-200 bg-white hover:border-amber-300 transition-all duration-300 cursor-default shadow-sm"
            style="will-change: transform, box-shadow"
          >
            <div class="text-5xl mb-4">🎉</div>
            <h3 class="text-2xl font-black text-slate-900 mb-3">Perfect for Events</h3>
            <p class="text-slate-600 leading-relaxed">
              Celebrate special moments with authentic catering. Weddings, birthdays, corporate events — we make it memorable.
            </p>
            <div class="absolute inset-0 rounded-2xl bg-gradient-to-br from-amber-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
          </div>
        </div>
      </div>
    </section>

    <!-- ══════════════════════════════════════════════════════════════════
         POPULAR DISHES
    ═══════════════════════════════════════════════════════════════════════ -->
    <section
      ref="popularSectionRef"
      class="py-24 px-6 bg-gradient-to-b from-white to-slate-50"
    >
      <div class="container mx-auto">
        <!-- Heading -->
        <div class="mb-16 text-center">
          <p class="text-amber-600 font-bold uppercase tracking-[0.25em] text-sm mb-4">Our Selection</p>
          <h2
            ref="popularHeadingRef"
            class="text-5xl md:text-6xl font-black uppercase text-slate-900 leading-tight"
            style="will-change: transform, opacity"
          >
            Popular Dishes
          </h2>
        </div>

        <!-- Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <!-- CARD 1 -->
          <div
            :ref="el => { if (el) dishCardRefs[0] = el }"
            class="group relative rounded-3xl overflow-hidden border border-slate-200 bg-white flex flex-col h-full transition-all duration-300 cursor-default shadow-md"
            style="will-change: transform, box-shadow"
          >
            <!-- Image -->
            <div class="relative overflow-hidden h-72 lg:h-80">
              <img
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                src="images/keesha-s-kitchen-woC24wGXsQ8-unsplash.jpg"
                alt="Jollof Rice"
                style="will-change: transform"
              />
              <div class="card-overlay absolute inset-0 bg-black" style="opacity: 0.1; will-change: opacity"></div>

              <!-- Rank Badge -->
              <div
                class="dish-badge absolute top-6 right-6 w-14 h-14 bg-gradient-to-br from-amber-500 to-amber-600 text-white rounded-full flex items-center justify-center font-black text-2xl shadow-lg border-2 border-white"
                style="will-change: transform, opacity"
              >
                #1
              </div>
            </div>

            <!-- Content -->
            <div class="px-8 py-8 flex flex-col flex-grow">
              <h3 class="text-2xl font-black text-slate-900 mb-3 group-hover:text-amber-600 transition-colors">Jollof Rice</h3>
              <p class="text-slate-600 text-sm leading-relaxed flex-grow mb-6">
                Often considered the "king" of Nigerian cuisine. Vibrant, savory, and cooked in a flavorful tomato and pepper sauce.
              </p>
              <button class="w-full py-3 px-4 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white font-bold rounded-xl transition-all duration-300 uppercase tracking-wider text-sm">
                Order Now
              </button>
            </div>
          </div>

          <!-- CARD 2 -->
          <div
            :ref="el => { if (el) dishCardRefs[1] = el }"
            class="group relative rounded-3xl overflow-hidden border border-slate-200 bg-white flex flex-col h-full transition-all duration-300 cursor-default shadow-md"
            style="will-change: transform, box-shadow"
          >
            <!-- Image -->
            <div class="relative overflow-hidden h-72 lg:h-80">
              <img
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                src="images/soup.png"
                alt="Nigerian Soup"
                style="will-change: transform"
              />
              <div class="card-overlay absolute inset-0 bg-black" style="opacity: 0.1; will-change: opacity"></div>

              <!-- Rank Badge -->
              <div
                class="dish-badge absolute top-6 right-6 w-14 h-14 bg-gradient-to-br from-red-500 to-red-600 text-white rounded-full flex items-center justify-center font-black text-2xl shadow-lg border-2 border-white"
                style="will-change: transform, opacity"
              >
                #2
              </div>
            </div>

            <!-- Content -->
            <div class="px-8 py-8 flex flex-col flex-grow">
              <h3 class="text-2xl font-black text-slate-900 mb-3 group-hover:text-amber-600 transition-colors">Soups</h3>
              <p class="text-slate-600 text-sm leading-relaxed flex-grow mb-6">
                Known for their incredible richness, diverse flavours, and comforting warmth — truly the heart of Nigerian cuisine.
              </p>
              <button class="w-full py-3 px-4 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white font-bold rounded-xl transition-all duration-300 uppercase tracking-wider text-sm">
                Order Now
              </button>
            </div>
          </div>

          <!-- CARD 3 -->
          <div
            :ref="el => { if (el) dishCardRefs[2] = el }"
            class="group relative rounded-3xl overflow-hidden border border-slate-200 bg-white flex flex-col h-full transition-all duration-300 cursor-default shadow-md"
            style="will-change: transform, box-shadow"
          >
            <!-- Image -->
            <div class="relative overflow-hidden h-72 lg:h-80">
              <img
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                src="images/poundedyam.png"
                alt="Pounded Yam"
                style="will-change: transform"
              />
              <div class="card-overlay absolute inset-0 bg-black" style="opacity: 0.1; will-change: opacity"></div>

              <!-- Rank Badge -->
              <div
                class="dish-badge absolute top-6 right-6 w-14 h-14 bg-gradient-to-br from-amber-600 to-orange-600 text-white rounded-full flex items-center justify-center font-black text-2xl shadow-lg border-2 border-white"
                style="will-change: transform, opacity"
              >
                #3
              </div>
            </div>

            <!-- Content -->
            <div class="px-8 py-8 flex flex-col flex-grow">
              <h3 class="text-2xl font-black text-slate-900 mb-3 group-hover:text-amber-600 transition-colors">Pounded Yam</h3>
              <p class="text-slate-600 text-sm leading-relaxed flex-grow mb-6">
                A beloved Nigerian staple, celebrated for its smooth dough-like texture. The perfect "swallow" for rich Nigerian soups.
              </p>
              <button class="w-full py-3 px-4 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white font-bold rounded-xl transition-all duration-300 uppercase tracking-wider text-sm">
                Order Now
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ══════════════════════════════════════════════════════════════════
         EXPLORE OUR KITCHEN
    ═══════════════════════════════════════════════════════════════════════ -->
    <section
      ref="exploreSectionRef"
      class="py-24 px-6 bg-gradient-to-b from-slate-50 to-white relative overflow-hidden"
    >
      <!-- Decorative elements -->
      <div class="absolute top-0 right-0 w-96 h-96 bg-amber-200 rounded-full opacity-3 blur-3xl pointer-events-none" aria-hidden="true"></div>

      <div class="container mx-auto relative z-10">
        <!-- Heading -->
        <div class="text-center mb-12">
          <p class="text-amber-600 font-bold uppercase tracking-[0.25em] text-sm mb-4">Visual Journey</p>
          <h2
            ref="exploreHeadingRef"
            class="text-5xl md:text-6xl font-black uppercase text-slate-900 leading-tight mb-6"
            style="will-change: transform, opacity"
          >
            Explore Our Kitchen
          </h2>
          <p class="text-lg text-slate-600 max-w-2xl mx-auto">
            Step inside our kitchen and discover the passion, precision, and pride that goes into every dish we prepare for you.
          </p>
        </div>

        <!-- Gridtemplate wrapped in premium container -->
        <div
          class="relative rounded-3xl overflow-hidden border border-slate-200 bg-gradient-to-b from-white to-slate-50 shadow-sm p-8 lg:p-12"
          style="will-change: transform, opacity"
        >
          <Gridtemplate />
        </div>
      </div>
    </section>

    <!-- ══════════════════════════════════════════════════════════════════
         TESTIMONIAL SECTION
    ═══════════════════════════════════════════════════════════════════════ -->
    <section
      ref="testimonialSection"
      class="py-24 px-6 bg-gradient-to-b from-white to-slate-50 relative overflow-hidden"
    >
      <!-- Decorative glow -->
      <div class="absolute top-1/2 left-0 w-96 h-96 bg-red-200 rounded-full opacity-3 blur-3xl pointer-events-none -translate-y-1/2" aria-hidden="true"></div>

      <div class="container mx-auto relative z-10">
        <div class="text-center mb-16">
          <p class="text-amber-600 font-bold uppercase tracking-[0.25em] text-sm mb-4">Guest Stories</p>
          <h2 class="text-5xl md:text-6xl font-black uppercase text-slate-900 leading-tight">
            Loved by Guests,<br />
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-600 to-red-600">Remembered by Families</span>
          </h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
          <!-- Image -->
          <div
            ref="testimonialImageRef"
            class="relative h-96 lg:h-[500px] rounded-3xl overflow-hidden shadow-xl border border-slate-200"
            style="will-change: clip-path, transform"
          >
            <img
              class="w-full h-full object-cover"
              src="images/keesha-s-kitchen-3gbiqiGJYUc-unsplash.jpg"
              alt="Danny's kitchen"
            />
            <div class="absolute inset-0 bg-gradient-to-tr from-black/20 via-transparent to-transparent"></div>
          </div>

          <!-- Testimonial Card -->
          <div
            ref="testimonialCardRef"
            class="relative rounded-3xl p-8 lg:p-10 border border-slate-200 bg-white shadow-xl"
            style="will-change: transform, opacity"
          >
            <div class="flex gap-1 mb-6">
              <i class="fa-solid fa-star text-amber-500"></i>
              <i class="fa-solid fa-star text-amber-500"></i>
              <i class="fa-solid fa-star text-amber-500"></i>
              <i class="fa-solid fa-star text-amber-500"></i>
              <i class="fa-solid fa-star text-amber-500"></i>
            </div>

            <p class="text-lg text-slate-800 leading-relaxed mb-6 italic">
              "Danny's isn't just food—it's a celebration of our heritage. Every bite takes me home. The Jollof rice is perfection, and the customer service makes you feel like family. Highly recommended for anyone wanting authentic Nigerian cuisine done right."
            </p>

            <div class="flex items-center gap-4">
              <div class="w-14 h-14 rounded-full bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center text-white font-bold text-xl">
                A
              </div>
              <div>
                <p class="font-bold text-slate-900 text-lg">Amina Okafor</p>
                <p class="text-slate-500 text-sm">Verified Customer</p>
              </div>
            </div>

            <!-- Decorative element -->
            <div class="absolute top-6 right-6 text-7xl text-amber-200 font-black">"</div>
          </div>
        </div>
      </div>
    </section>

    <!-- ══════════════════════════════════════════════════════════════════
         FINAL CTA SECTION
    ═══════════════════════════════════════════════════════════════════════ -->
    <section
      ref="finalCtaRef"
      class="py-24 px-6 relative overflow-hidden"
      style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 50%, #ffffff 100%)"
    >
      <!-- Animated glow -->
      <div
        class="final-glow absolute inset-0 bg-gradient-to-br from-amber-200/15 via-transparent to-red-200/10 pointer-events-none"
        style="opacity: 0.15; will-change: opacity, transform"
        aria-hidden="true"
      ></div>

      <!-- Decorative orbs -->
      <div class="absolute top-1/2 left-1/4 w-80 h-80 bg-amber-300 rounded-full opacity-5 blur-3xl pointer-events-none -translate-y-1/2" aria-hidden="true"></div>
      <div class="absolute bottom-0 right-1/4 w-72 h-72 bg-red-300 rounded-full opacity-3 blur-3xl pointer-events-none" aria-hidden="true"></div>

      <div class="container mx-auto text-center relative z-10">
        <div ref="finalCtaHeadingRef" class="mb-12">
          <p class="text-amber-600 font-bold uppercase tracking-[0.25em] text-sm mb-6">Ready?</p>
          <h2 class="text-5xl md:text-6xl lg:text-7xl font-black uppercase text-slate-900 leading-[1.1]">
            <span class="block">Ready to Taste</span>
            <span class="block text-transparent bg-clip-text bg-gradient-to-r from-amber-600 via-amber-500 to-red-600">Something Special?</span>
          </h2>
        </div>

        <p class="text-lg text-slate-700 mb-12 max-w-2xl mx-auto">
          Experience authentic Nigerian flavours that celebrate tradition, family, and the art of great food. Order online or reserve your table now.
        </p>

        <div ref="finalCtaButtonsRef" class="flex flex-col sm:flex-row gap-6 justify-center">
          <Link
            :href="route('dining')"
            class="group inline-flex items-center justify-center gap-3 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white font-bold text-lg uppercase tracking-widest px-10 py-5 rounded-xl transition-all duration-300 shadow-lg hover:shadow-amber-500/40 overflow-hidden relative"
          >
            <i class="fa-solid fa-shopping-bag text-xl"></i>
            <span>Order Takeout</span>
            <div class="absolute inset-0 bg-white/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          </Link>

          <Reservation v-slot="{ open }">
            <button
              @click="open"
              class="group inline-flex items-center justify-center gap-3 border-2 border-slate-300 hover:border-amber-500 text-slate-900 font-bold text-lg uppercase tracking-widest px-10 py-5 rounded-xl transition-all duration-300 hover:bg-slate-50 hover:shadow-md"
            >
              <i class="fa-solid fa-calendar-days text-xl"></i>
              <span>Make a Reservation</span>
            </button>
          </Reservation>
        </div>
      </div>
    </section>

    <!-- ══════════════════════════════════════════════════════════════════
         TESTIMONIALS (From Layouts)
    ═══════════════════════════════════════════════════════════════════════ -->
    <section class="py-16 px-6 bg-white border-t border-slate-200">
      <Testimonial />
    </section>

    <!-- Footer -->
    <div ref="footerRef" style="will-change: transform, opacity">
      <Footer />
    </div>
  </div>
</template>

<style scoped>
@keyframes float {
  0%, 100% {
    transform: translateY(0px);
  }
  50% {
    transform: translateY(-20px);
  }
}

@keyframes glow-pulse {
  0%, 100% {
    opacity: 0.15;
  }
  50% {
    opacity: 0.3;
  }
}
</style>

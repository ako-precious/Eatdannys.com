<script setup>
import { ref, onMounted, onUnmounted, nextTick } from 'vue'
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
const heroEyebrowRef       = ref(null)
const wordRefs             = ref([])   // per-word spans for stagger
const heroSubtitleRef      = ref(null)
const heroTrustRef         = ref(null)
const heroCtaRef           = ref(null)
const signatureCardsRef    = ref([])   // [0,1,2]
const signatureSectionRef  = ref(null)
const signatureHeadingRef  = ref(null)
const popularSectionRef    = ref(null)
const popularHeadingRef    = ref(null)
const dishCardRefs         = ref([])   // [0,1,2]
const exploreHeadingRef    = ref(null)
const exploreSectionRef    = ref(null)
const exploreCopyRef       = ref(null)
const gridSectionRef       = ref(null)
const testimonialSection   = ref(null)
const testimonialImageRef  = ref(null)
const testimonialCardRef   = ref(null)
const finalCtaRef          = ref(null)
const finalCtaHeadingRef   = ref(null)
const finalCtaCopyRef      = ref(null)
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
  cleanupFns.push(() => el.removeEventListener(event, fn, opts))
}

const safeElements = (items) => items.filter(Boolean)

// ─── GSAP ─────────────────────────────────────────────────────────────────────
let ctx = null

onMounted(async () => {
  if (reduceMotion) return

  await nextTick()

  const isMobile = window.innerWidth < 768
  const revealY = isMobile ? 24 : 46
  const refreshScrollTrigger = () => ScrollTrigger.refresh()

  ScrollTrigger.refresh()
  addListener(window, 'load', refreshScrollTrigger, { once: true })
  const refreshTimer = window.setTimeout(refreshScrollTrigger, 450)
  cleanupFns.push(() => window.clearTimeout(refreshTimer))

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
        { autoAlpha: 0, y: isMobile ? 18 : 44, scale: 0.96 },
        { autoAlpha: 1, y: 0, scale: 1, duration: 1.15, ease: 'power3.out', delay: 0.1 }
      )
    }

    // Orchestrated hero entrance: words → subtitle → CTA
    const heroTl = gsap.timeline({ delay: 0.25 })

    if (heroEyebrowRef.value) {
      heroTl.fromTo(heroEyebrowRef.value,
        { y: 14, autoAlpha: 0 },
        { y: 0, autoAlpha: 1, duration: 0.65, ease: 'power3.out' }
      )
    }

    // Word-by-word 3D lift with stagger
    const words = safeElements(wordRefs.value)
    if (words.length) {
      heroTl.fromTo(
        words,
        { yPercent: 112, autoAlpha: 0, rotationX: isMobile ? 0 : -76, transformOrigin: '50% 100%' },
        {
          yPercent: 0, autoAlpha: 1, rotationX: 0,
          duration: isMobile ? 0.58 : 0.78,
          stagger: { each: isMobile ? 0.035 : 0.055, ease: 'power2.out' },
          ease: 'expo.out',
        }
      )
    }

    // Subtitle: blur-to-sharp fade-up
    if (heroSubtitleRef.value) {
      heroTl.fromTo(heroSubtitleRef.value,
        { y: 18, autoAlpha: 0, filter: isMobile ? 'blur(0px)' : 'blur(10px)' },
        { y: 0, autoAlpha: 1, filter: 'blur(0px)', duration: 0.82, ease: 'power3.out' },
        '-=0.4'
      )
    }

    if (heroTrustRef.value) {
      const signals = heroTrustRef.value.querySelectorAll('[data-trust-signal]')
      if (signals.length) {
        heroTl.fromTo(signals,
          { y: 14, autoAlpha: 0 },
          { y: 0, autoAlpha: 1, duration: 0.55, stagger: 0.09, ease: 'power3.out' },
          '-=0.38'
        )
      }
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

    if (heroImageLayerRef.value && !isMobile) {
      const floatCards = heroImageLayerRef.value.querySelectorAll('[data-float-card]')
      gsap.to(floatCards, {
        y: -12,
        duration: 3.2,
        ease: 'sine.inOut',
        yoyo: true,
        repeat: -1,
        stagger: 0.35,
      })

      const heroGlows = heroRef.value?.querySelectorAll('[data-hero-glow]')
      const onHeroMove = (e) => {
        const r = heroRef.value.getBoundingClientRect()
        const x = (e.clientX - r.left) / r.width - 0.5
        const y = (e.clientY - r.top) / r.height - 0.5
        gsap.to(heroImageLayerRef.value, { x: x * 18, y: y * 14, rotateY: x * 3, rotateX: y * -2, duration: 0.7, ease: 'power2.out' })
        if (heroGlows?.length) gsap.to(heroGlows, { x: x * -28, y: y * -18, duration: 1, ease: 'power2.out', stagger: 0.03 })
      }
      const onHeroLeave = () => {
        gsap.to(heroImageLayerRef.value, { x: 0, y: 0, rotateY: 0, rotateX: 0, duration: 0.8, ease: 'power3.out' })
        if (heroGlows?.length) gsap.to(heroGlows, { x: 0, y: 0, duration: 0.8, ease: 'power3.out' })
      }
      addListener(heroRef.value, 'mousemove', onHeroMove)
      addListener(heroRef.value, 'mouseleave', onHeroLeave)
    }

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
        const onEnter = () => gsap.to(btn, { scale: 1.035, duration: 0.3, ease: 'power2.out' })
        const onLeave = () => gsap.to(btn, { x: 0, y: 0, scale: 1, duration: 0.6, ease: 'elastic.out(1.1, 0.45)' })
        addListener(btn, 'mouseenter', onEnter)
        addListener(btn, 'mousemove', onMove)
        addListener(btn, 'mouseleave', onLeave)
      })
    }

    // ── SIGNATURE EXPERIENCE SECTION ────────────────────────────────────────────
    if (signatureSectionRef.value) {
      if (signatureHeadingRef.value) {
        gsap.fromTo(signatureHeadingRef.value,
          { y: revealY, autoAlpha: 0 },
          {
            y: 0, autoAlpha: 1, duration: 0.82, ease: 'power3.out',
            scrollTrigger: { trigger: signatureSectionRef.value, start: 'top 78%', once: true, invalidateOnRefresh: true },
          }
        )
      }

      const cards = safeElements(signatureCardsRef.value)
      if (cards.length) {
        gsap.fromTo(cards,
          { y: revealY, autoAlpha: 0, scale: 0.94 },
          {
            y: 0, autoAlpha: 1, scale: 1,
            duration: 0.85, stagger: 0.15, ease: 'power3.out',
            scrollTrigger: { trigger: signatureSectionRef.value, start: 'top 75%', once: true, invalidateOnRefresh: true },
          }
        )

        // Hover lift effect (desktop)
        if (!isMobile) {
          cards.forEach(card => {
            const icon = card.querySelector('[data-card-icon]')
            const onEnter = () => {
              gsap.to(card, { y: -10, borderColor: '#f59e0b', boxShadow: '0 24px 55px rgba(217, 119, 6, 0.18)', duration: 0.4, ease: 'power2.out' })
              if (icon) gsap.to(icon, { y: -8, scale: 1.08, duration: 0.38, ease: 'back.out(1.8)' })
            }
            const onLeave = () => {
              gsap.to(card, { y: 0, borderColor: '#e2e8f0', boxShadow: '0 1px 3px rgba(15, 23, 42, 0.08)', duration: 0.5, ease: 'power3.out' })
              if (icon) gsap.to(icon, { y: 0, scale: 1, duration: 0.45, ease: 'power3.out' })
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
          { y: revealY, autoAlpha: 0 },
          {
            y: 0, autoAlpha: 1, duration: 0.8, ease: 'power3.out',
            scrollTrigger: { trigger: popularSectionRef.value, start: 'top 80%', once: true, invalidateOnRefresh: true },
          }
        )
      }

      // Dish cards: staggered fade-up + scale
      const cards = safeElements(dishCardRefs.value)
      if (cards.length) {
        gsap.fromTo(cards,
          { y: isMobile ? 30 : 58, autoAlpha: 0, scale: 0.94, rotate: isMobile ? 0 : -1.5 },
          {
            y: 0, autoAlpha: 1, scale: 1, rotate: 0,
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
          { y: revealY, autoAlpha: 0 },
          {
            y: 0, autoAlpha: 1, duration: 0.8, ease: 'power3.out',
            scrollTrigger: { trigger: exploreSectionRef.value, start: 'top 80%', once: true, invalidateOnRefresh: true },
          }
        )
      }

      if (exploreCopyRef.value) {
        gsap.fromTo(exploreCopyRef.value,
          { y: 20, autoAlpha: 0 },
          {
            y: 0, autoAlpha: 1, duration: 0.75, ease: 'power3.out',
            scrollTrigger: { trigger: exploreSectionRef.value, start: 'top 78%', once: true, invalidateOnRefresh: true },
          }
        )
      }

      if (gridSectionRef.value) {
        gsap.fromTo(gridSectionRef.value,
          { y: revealY, autoAlpha: 0, scale: 0.985 },
          {
            y: 0, autoAlpha: 1, scale: 1, duration: 1, ease: 'power3.out',
            scrollTrigger: { trigger: gridSectionRef.value, start: 'top 82%', once: true, invalidateOnRefresh: true },
          }
        )
      }
    }

    // ── TESTIMONIAL SECTION ───────────────────────────────────────────────────
    if (testimonialSection.value) {

      // Image column: clip-path wipe from right
      if (testimonialImageRef.value) {
        gsap.fromTo(testimonialImageRef.value,
          { clipPath: isMobile ? 'inset(0% 0% 18% 0%)' : 'inset(0% 100% 0% 0%)', autoAlpha: isMobile ? 0 : 1 },
          {
            clipPath: 'inset(0% 0% 0% 0%)', autoAlpha: 1,
            duration: isMobile ? 0.9 : 1.35, ease: 'power3.inOut',
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
          { y: isMobile ? 28 : 50, x: isMobile ? 0 : -18, autoAlpha: 0, scale: 0.96 },
          {
            y: 0, x: 0, autoAlpha: 1, scale: 1, duration: 1.05, ease: 'power3.out',
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

      if (finalCtaCopyRef.value) {
        gsap.fromTo(finalCtaCopyRef.value,
          { y: 20, autoAlpha: 0 },
          {
            y: 0, autoAlpha: 1, duration: 0.75, ease: 'power3.out',
            scrollTrigger: { trigger: finalCtaRef.value, start: 'top 72%', once: true, invalidateOnRefresh: true },
          }
        )
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
          opacity: 0.34,
          scale: 1.08,
          duration: 3.5,
          ease: 'sine.inOut',
          yoyo: true,
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
        data-hero-glow
        aria-hidden="true"
      ></div>
      <div
        class="absolute top-1/3 -right-20 w-72 h-72 bg-red-300 rounded-full opacity-3 blur-3xl pointer-events-none"
        data-hero-glow
        aria-hidden="true"
      ></div>

      <div class="container mx-auto px-6 lg:px-12 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">

          <!-- LEFT: Hero Content -->
          <div ref="heroContentRef" class="text-slate-900">
            <p
              ref="heroEyebrowRef"
              class="mb-5 text-sm font-bold uppercase tracking-[0.28em] text-amber-700"
              style="will-change: transform, opacity"
            >
              Dining, takeout, and warm Nigerian hospitality
            </p>

            <!-- Headline -->
            <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-6xl font-black uppercase leading-[1.08] mb-6">
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
            <div ref="heroTrustRef" class="flex flex-col sm:flex-row gap-4 sm:gap-6 mb-10 text-sm font-semibold">
              <div data-trust-signal class="flex items-center gap-2 text-amber-700" style="will-change: transform, opacity">
                <i class="fa-solid fa-check-circle"></i>
                <span>Freshly Prepared</span>
              </div>
              <div data-trust-signal class="flex items-center gap-2 text-amber-700" style="will-change: transform, opacity">
                <i class="fa-solid fa-leaf"></i>
                <span>Authentic Recipes</span>
              </div>
              <div data-trust-signal class="flex items-center gap-2 text-amber-700" style="will-change: transform, opacity">
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
                class="group relative inline-flex items-center justify-center gap-3 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 font-bold text-base uppercase tracking-widest px-8 py-4 rounded-xl transition-all duration-300 overflow-hidden shadow-lg shadow-amber-600/20 hover:shadow-amber-600/45"
                style="will-change: transform"
              >
                <span class="absolute inset-y-0 -left-16 w-12 rotate-12 bg-white/35 blur-sm transition-transform duration-700 group-hover:translate-x-80" aria-hidden="true"></span>
                <i class="fa-solid fa-shopping-bag text-lg"></i>
                <span class="relative">Order Takeout</span>
                <div class="absolute inset-0 bg-white/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-xl"></div>
              </Link>

              <Reservation v-slot="{ open }">
                <button
                  @click="open"
                  class="group inline-flex items-center justify-center gap-3 border-2 border-slate-300 hover:border-amber-500 text-slate-900 font-bold text-base uppercase tracking-widest px-8 py-4 rounded-xl transition-all duration-300 backdrop-blur-sm bg-white/70 hover:bg-amber-50"
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
              data-float-card
              style="will-change: transform"
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
              data-float-card
              style="will-change: transform"
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
        <div ref="signatureHeadingRef" class="text-center mb-16" style="will-change: transform, opacity">
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
            <div data-card-icon class="text-5xl mb-4" style="will-change: transform">🌾</div>
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
            <div data-card-icon class="text-5xl mb-4" style="will-change: transform">🔥</div>
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
            <div data-card-icon class="text-5xl mb-4" style="will-change: transform">🎉</div>
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
                class="dish-badge absolute top-6 right-6 w-14 h-14 bg-gradient-to-br from-amber-500 to-amber-600 text-slate-500 rounded-full flex items-center justify-center font-black text-2xl shadow-lg border-2 border-white"
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
              <button class="w-full py-3 px-4 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-500 font-bold rounded-xl transition-all duration-300 uppercase tracking-wider text-sm">
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
                class="dish-badge absolute top-6 right-6 w-14 h-14 bg-gradient-to-br from-red-500 to-red-600 text-slate-500 rounded-full flex items-center justify-center font-black text-2xl shadow-lg border-2 border-white"
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
              <button class="w-full py-3 px-4 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-500 font-bold rounded-xl transition-all duration-300 uppercase tracking-wider text-sm">
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
                class="dish-badge absolute top-6 right-6 w-14 h-14 bg-gradient-to-br from-amber-600 to-orange-600 text-slate-500 rounded-full flex items-center justify-center font-black text-2xl shadow-lg border-2 border-white"
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
              <button class="w-full py-3 px-4 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-500 font-bold rounded-xl transition-all duration-300 uppercase tracking-wider text-sm">
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
          <p ref="exploreCopyRef" class="text-lg text-slate-600 max-w-2xl mx-auto" style="will-change: transform, opacity">
            Step inside our kitchen and discover the passion, precision, and pride that goes into every dish we prepare for you.
          </p>
        </div>

        <!-- Gridtemplate wrapped in premium container -->
        <div
          ref="gridSectionRef"
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
      class="py-24 px-6 bg-gradient-to-br from-slate-950 via-slate-900 to-red-950 relative overflow-hidden"
    >
      <!-- Decorative glow -->
      <div class="absolute top-1/2 left-0 w-96 h-96 bg-amber-500 rounded-full opacity-10 blur-3xl pointer-events-none -translate-y-1/2" aria-hidden="true"></div>
      <div class="absolute -bottom-32 right-8 w-96 h-96 bg-red-500 rounded-full opacity-10 blur-3xl pointer-events-none" aria-hidden="true"></div>

      <div class="container mx-auto relative z-10">
        <div class="text-center mb-16">
          <p class="text-amber-300 font-bold uppercase tracking-[0.25em] text-sm mb-4">Flexible Portions</p>
          <h2 class="text-4xl md:text-6xl font-black uppercase text-white leading-tight">
            Dine In or Take Out,<br />
            <span class="text-amber-200">Small Plates to Large Trays</span>
          </h2>
          <p class="mt-6 text-base md:text-lg text-slate-500 max-w-3xl mx-auto leading-relaxed">
            Whether you are stopping by for one comforting meal or feeding a family, team, or celebration, Danny's prepares Nigerian favourites in the quantity that fits your table.
          </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
          <!-- Image -->
          <div
            ref="testimonialImageRef"
            class="relative h-96 lg:h-[500px] rounded-3xl overflow-hidden shadow-2xl border border-white/10"
            style="will-change: clip-path, transform"
          >
            <img
              class="w-full h-full object-cover"
              src="images/keesha-s-kitchen-3gbiqiGJYUc-unsplash.jpg"
              alt="Prepared Nigerian dishes for dine-in and takeout"
            />
            <div class="absolute inset-0 bg-gradient-to-tr from-black/55 via-black/40 to-transparent"></div>
            <div class="absolute left-6 bottom-6 right-6 grid grid-cols-1 sm:grid-cols-2 gap-3">
              <div class="rounded-2xl border border-white/15 bg-white/12 p-4 backdrop-blur-lg">
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-amber-300">Small Quantity</p>
                <p class="mt-1 text-sm font-semibold text-white">Single meals, pairs, and quick takeout.</p>
              </div>
              <div class="rounded-2xl border border-white/15 bg-white/12 p-4 backdrop-blur-lg">
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-amber-300">Large Quantity</p>
                <p class="mt-1 text-sm font-semibold text-white">Family packs, trays, soups, and events.</p>
              </div>
            </div>
          </div>

          <!-- Testimonial Card -->
          <div
            ref="testimonialCardRef"
            class="relative rounded-3xl p-8 lg:p-10 border border-white/15 bg-gradient-to-br from-white/14 via-amber-500/10 to-red-500/10 shadow-2xl backdrop-blur-xl"
            style="will-change: transform, opacity"
          >
            <div class="absolute -inset-8 bg-amber-700/10 blur-3xl pointer-events-none" aria-hidden="true"></div>
            <div class="relative">
              <div class="mb-7 inline-flex items-center gap-2 rounded-full border border-amber-500/25 bg-amber-500/10 px-4 py-2 text-xs font-black uppercase tracking-[0.2em] text-amber-400">
                <i class="fa-solid fa-bowl-food"></i>
                Made Fresh for Your Order
              </div>

              <h3 class="text-3xl md:text-4xl font-black uppercase leading-tight text-amber-700">
                Choose the way you want to enjoy Danny's.
              </h3>

              <div class="mt-4 space-y-4">
                <div class="rounded-2xl border border-white/10 bg-white/8 p-2">
                  <div class="flex items-start gap-3">
                    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-amber-300 text-slate-950">
                      <i class="fa-solid fa-utensils"></i>
                    </span>
                    <div>
                      <p class="font-black text-amber-300">Dine In</p>
                      <p class="mt-1 text-sm leading-4 text-slate-500">Come in for hot plates, soups, rice dishes, and a relaxed meal with authentic Nigerian flavour.</p>
                    </div>
                  </div>
                </div>

                <div class="rounded-2xl border border-white/10 bg-white/8 p-2">
                  <div class="flex items-start gap-3">
                    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-amber-300 text-slate-950">
                      <i class="fa-solid fa-bag-shopping"></i>
                    </span>
                    <div>
                      <p class="font-black text-amber-300">Takeout in Small Quantities</p>
                      <p class="mt-1 text-sm leading-4 text-slate-500">Order individual meals, quick lunch portions, dinner for two, or a few favourites to enjoy at home.</p>
                    </div>
                  </div>
                </div>

                <div class="rounded-2xl border border-white/10 bg-white/8 p-2">
                  <div class="flex items-start gap-3">
                    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-amber-300 text-slate-950">
                      <i class="fa-solid fa-boxes-stacked"></i>
                    </span>
                    <div>
                      <p class="font-black text-amber-300">Takeout in Large Quantities</p>
                      <p class="mt-1 text-sm leading-6 text-slate-500">Request trays, family portions, soups, and larger food orders for gatherings, office meals, and celebrations.</p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                <Link
                  :href="route('dining')"
                  class="inline-flex items-center justify-center gap-2 rounded-xl bg-amber-400 px-6 py-3 text-sm font-black uppercase tracking-wide text-slate-950 transition hover:bg-amber-300"
                >
                  Order Takeout
                </Link>
                <a
                  href="tel:+17058886114"
                  class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/25 bg-white/8 px-6 py-3 text-sm font-black uppercase tracking-wide text-slate-500 transition  backdrop-blur-xl hover:border-amber-300 hover:bg-white/12"
                >
                  Ask About Large Orders
                </a>
              </div>

            <div class="hidden gap-1 mb-6">
              <i class="fa-solid fa-star text-amber-300"></i>
              <i class="fa-solid fa-star text-amber-300"></i>
              <i class="fa-solid fa-star text-amber-300"></i>
              <i class="fa-solid fa-star text-amber-300"></i>
              <i class="fa-solid fa-star text-amber-300"></i>
            </div>

            <p class="hidden text-lg text-slate-100 leading-relaxed mb-6 italic">
              "Danny's isn't just food—it's a celebration of our heritage. Every bite takes me home. The Jollof rice is perfection, and the customer service makes you feel like family. Highly recommended for anyone wanting authentic Nigerian cuisine done right."
            </p>

            <div class="hidden items-center gap-4">
              <div class="w-14 h-14 rounded-full bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center text-slate-500 font-bold text-xl">
                A
              </div>
              <div>
                <p class="font-bold text-slate-500 text-lg">Amina Okafor</p>
                <p class="text-slate-300 text-sm">Verified Customer</p>
              </div>
            </div>

            <!-- Decorative element -->
            <div class="absolute top-0 right-0 text-6xl text-amber-200/20">
              <i class="fa-solid fa-bag-shopping"></i>
            </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ══════════════════════════════════════════════════════════════════
         TESTIMONIALS (From Layouts)
    ═══════════════════════════════════════════════════════════════════════ -->
    <section class="py-16 px-6 bg-white border-t border-slate-200">
      <Testimonial />
    </section>

    <!-- ══════════════════════════════════════════════════════════════════
         FINAL CTA SECTION
    ═══════════════════════════════════════════════════════════════════════ -->
    <section
      ref="finalCtaRef"
      class="py-24 px-6 relative overflow-hidden bg-gradient-to-br from-slate-950 via-red-950 to-amber-950"
    >
      <!-- Animated glow -->
      <div
        class="final-glow absolute left-1/2 top-1/2 h-96 w-96 -translate-x-1/2 -translate-y-1/2 rounded-full bg-amber-400/25 blur-3xl pointer-events-none"
        style="opacity: 0.2; will-change: opacity, transform"
        aria-hidden="true"
      ></div>

      <!-- Decorative orbs -->
      <div class="absolute top-1/2 left-1/4 w-80 h-80 bg-amber-300 rounded-full opacity-10 blur-3xl pointer-events-none -translate-y-1/2" aria-hidden="true"></div>
      <div class="absolute bottom-0 right-1/4 w-72 h-72 bg-red-300 rounded-full opacity-10 blur-3xl pointer-events-none" aria-hidden="true"></div>

      <div class="container mx-auto text-center relative z-10">
        <div ref="finalCtaHeadingRef" class="mb-12">
          <p class="text-amber-300 font-bold uppercase tracking-[0.25em] text-sm mb-6">Ready?</p>
          <h2 class="text-4xl md:text-6xl lg:text-7xl font-black uppercase text-white leading-[1.1]">
            <span class="block text-amber-500 drop-shadow-[0_0_24px_rgba(251,191,36,0.28)]">Ready to Taste</span>
            <span class="block text-amber-800 drop-shadow-[0_0_24px_rgba(251,191,36,0.28)]">Something Special?</span>
          </h2>
        </div>

        <p ref="finalCtaCopyRef" class="text-lg text-slate-400 mb-12 max-w-2xl mx-auto" style="will-change: transform, opacity">
          Experience authentic Nigerian flavours that celebrate tradition, family, and the art of great food. Order online or reserve your table now.
        </p>

        <div ref="finalCtaButtonsRef" class="flex flex-col sm:flex-row gap-6 justify-center">
          <Link
            :href="route('dining')"
            class="group inline-flex items-center justify-center gap-3 bg-gradient-to-r from-amber-400 to-amber-500 hover:from-amber-300 hover:to-amber-500 text-slate-950 font-bold text-lg uppercase tracking-widest px-10 py-5 rounded-xl transition-all duration-300 shadow-lg shadow-amber-500/25 hover:shadow-amber-400/40 overflow-hidden relative"
          >
            <span class="absolute inset-y-0 -left-16 w-12 rotate-12 bg-white/40 blur-sm transition-transform duration-700 group-hover:translate-x-96" aria-hidden="true"></span>
            <i class="fa-solid fa-shopping-bag text-xl"></i>
            <span class="relative">Order Takeout</span>
            <div class="absolute inset-0 bg-white/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          </Link>

          <Reservation v-slot="{ open }">
            <button
              @click="open"
              class="group inline-flex items-center justify-center gap-3 border-2 border-white/35 hover:border-amber-300 text-slate-500 font-bold text-lg uppercase tracking-widest px-10 py-5 rounded-xl transition-all duration-300 bg-white/10 hover:bg-white/15 hover:shadow-md backdrop-blur-sm"
            >
              <i class="fa-solid fa-calendar-days text-xl"></i>
              <span>Make a Reservation</span>
            </button>
          </Reservation>
        </div>
      </div>
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

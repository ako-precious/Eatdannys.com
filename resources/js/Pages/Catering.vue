<script setup>
import { ref, computed, onMounted, onUnmounted, nextTick } from 'vue'
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
  { icon: '🍽️', title: 'Authentic Cuisine',   desc: 'Rooted in Nigerian culinary tradition, elevated for every occasion.' },
  { icon: '👨‍🍳', title: 'Expert Chefs',        desc: 'Years of professional experience behind every dish we deliver.' },
  { icon: '🌿', title: 'Fresh Ingredients',   desc: 'Locally and seasonally sourced for peak flavour in every bite.' },
  { icon: '📋', title: 'Tailored to You',     desc: 'No two events are the same. We personalise every menu to your vision.' },
  { icon: '⏱️', title: 'Punctual Delivery',   desc: 'We respect your timeline — food arrives hot, fresh, and on schedule.' },
  { icon: '💬', title: 'White-Glove Service', desc: 'Dedicated coordination from your first call to the final plate.' },
]

// ─── DOM refs ─────────────────────────────────────────────────────────────────

const scrollProgress  = ref(null)
const heroSection     = ref(null)
const heroBadge       = ref(null)
const charRefs        = ref([])
const heroSubtitle    = ref(null)
const heroCta         = ref(null)
const heroGlow        = ref(null)
const statsSection    = ref(null)
const statEls         = ref([])
const serviceSections = ref([])
const whySection      = ref(null)
const bookingSection  = ref(null)
const floatingCta     = ref(null)

const titleText  = "EAT DANNY'S"
const titleChars = computed(() => titleText.split('').map((char, i) => ({ char, i })))

// ─── Preferences ──────────────────────────────────────────────────────────────

const reduceMotion = typeof window !== 'undefined'
  ? window.matchMedia('(prefers-reduced-motion: reduce)').matches
  : false

// ─── Event-listener cleanup registry ─────────────────────────────────────────
// gsap.context().revert() kills tweens/ScrollTriggers but not DOM event listeners.
// Every listener added via addListener() is tracked here and removed on unmount.

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

  // Refresh once immediately, then again after all media has loaded so
  // ScrollTrigger measures correct positions even if images/videos change layout.
  ScrollTrigger.refresh()
  window.addEventListener('load', () => ScrollTrigger.refresh(), { once: true })

  ctx = gsap.context(() => {

    // ── SCROLL PROGRESS BAR ────────────────────────────────────────────────
    if (scrollProgress.value) {
      gsap.to(scrollProgress.value, {
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

    // ── HERO: CINEMATIC ENTRANCE ───────────────────────────────────────────

    // Ken Burns: slow atmospheric zoom on the hero background.
    // Starts with a short delay so it doesn't interrupt the entrance sequence.
    gsap.delayedCall(0.4, () => {
      gsap.to('.hero-bg-img', {
        scale: 1.08,
        duration: 14,
        ease: 'power1.inOut',
        repeat: -1,
        yoyo: true,
      })
    })

    // Orchestrated entrance: badge → chars → subtitle → CTA
    const heroTl = gsap.timeline({ delay: 0.1 })

    if (heroBadge.value) {
      heroTl.fromTo(heroBadge.value,
        { y: -16, autoAlpha: 0, scale: 0.94 },
        { y: 0, autoAlpha: 1, scale: 1, duration: 0.65, ease: 'power3.out' }
      )
    }

    // 3-D character flip — each char lifts from below with perspective rotation.
    // stagger.ease means earlier chars feel snappier; the wave decelerates naturally.
    if (charRefs.value.length) {
      heroTl.fromTo(
        charRefs.value,
        { yPercent: 120, autoAlpha: 0, rotationX: -85, transformOrigin: '50% 100%', transformPerspective: 600 },
        {
          yPercent: 0, autoAlpha: 1, rotationX: 0,
          duration: 0.92,
          stagger: { each: 0.032, ease: 'power2.out' },
          ease: 'expo.out',
        },
        heroBadge.value ? '-=0.28' : 0
      )
    }

    // Subtitle: blur-to-sharp fade-up (premium "focus pull" effect)
    if (heroSubtitle.value) {
      heroTl.fromTo(heroSubtitle.value,
        { y: 24, autoAlpha: 0, filter: 'blur(12px)' },
        { y: 0, autoAlpha: 1, filter: 'blur(0px)', duration: 1.1, ease: 'power3.out' },
        '-=0.52'
      )
    }

    // CTA block slides up behind the subtitle
    if (heroCta.value) {
      heroTl.fromTo(heroCta.value,
        { y: 20, autoAlpha: 0 },
        { y: 0, autoAlpha: 1, duration: 0.85, ease: 'power3.out' },
        '-=0.7'
      )
    }

    // Ambient glow pulse behind hero content
    if (heroGlow.value) {
      gsap.to(heroGlow.value, {
        scale: 1.22,
        opacity: 0.2,
        duration: 3.6,
        ease: 'sine.inOut',
        yoyo: true,
        repeat: -1,
      })
    }

    // Background scroll parallax — desktop only (prevents mobile jank)
    if (!isMobile) {
      gsap.to('.hero-bg-img', {
        yPercent: 22,
        ease: 'none',
        scrollTrigger: {
          trigger: heroSection.value,
          start: 'top top',
          end: 'bottom top',
          scrub: 1,
          invalidateOnRefresh: true,
        },
      })
    }

    // Mouse-move parallax: glow tracks cursor, bg drifts subtly (desktop only)
    if (!isMobile && heroSection.value) {
      const onHeroMove = (e) => {
        const cx = (e.clientX / window.innerWidth  - 0.5) * 2
        const cy = (e.clientY / window.innerHeight - 0.5) * 2
        gsap.to('.hero-bg-img', { x: cx * 10, duration: 1.6, ease: 'power1.out', overwrite: 'auto' })
        if (heroGlow.value) {
          gsap.to(heroGlow.value, { x: cx * 28, y: cy * 22, duration: 1.8, ease: 'power1.out', overwrite: 'auto' })
        }
      }
      addListener(heroSection.value, 'mousemove', onHeroMove)
    }

    // Magnetic hover on CTA buttons: slight pull toward cursor, elastic snap-back
    if (!isMobile && heroCta.value) {
      heroCta.value.querySelectorAll('.magnetic-btn').forEach(btn => {
        const onMove = (e) => {
          const r = btn.getBoundingClientRect()
          gsap.to(btn, {
            x: (e.clientX - r.left - r.width  / 2) * 0.28,
            y: (e.clientY - r.top  - r.height / 2) * 0.22,
            duration: 0.35, ease: 'power2.out',
          })
        }
        const onLeave = () => gsap.to(btn, { x: 0, y: 0, duration: 0.65, ease: 'elastic.out(1.1, 0.45)' })
        addListener(btn, 'mousemove', onMove)
        addListener(btn, 'mouseleave', onLeave)
      })
    }

    // ── FLOATING CTA ────────────────────────────────────────────────────────
    if (floatingCta.value) {
      gsap.set(floatingCta.value, { autoAlpha: 0, y: 16 })

      ScrollTrigger.create({
        trigger: heroSection.value,
        start: 'bottom 55%',
        once: true,
        onEnter() {
          gsap.to(floatingCta.value, {
            autoAlpha: 1, y: 0, duration: 0.7, ease: 'power3.out',
            onComplete() {
              gsap.to(floatingCta.value, {
                y: -8, duration: 1.9, ease: 'sine.inOut', yoyo: true, repeat: -1,
              })
            },
          })
        },
      })

      // Shine sweep on hover
      if (!isMobile) {
        const ctaLink  = floatingCta.value.querySelector('a')
        const ctaShine = ctaLink?.querySelector('.cta-shine')
        if (ctaLink && ctaShine) {
          addListener(ctaLink, 'mouseenter', () => {
            gsap.fromTo(ctaShine, { x: '-130%' }, { x: '200%', duration: 0.48, ease: 'power2.out' })
          })
        }
      }
    }

    // ── STATS ───────────────────────────────────────────────────────────────
    if (statsSection.value) {
      gsap.fromTo(statsSection.value,
        { autoAlpha: 0, y: 28 },
        {
          autoAlpha: 1, y: 0, duration: 0.9, ease: 'power3.out',
          scrollTrigger: {
            trigger: statsSection.value, start: 'top 88%',
            once: true, invalidateOnRefresh: true,
          },
        }
      )
    }

    // Counters: slight stagger between them + scale pulse on finish
    statEls.value.forEach((el, i) => {
      if (!el) return
      const stat  = stats[i]
      const obj   = { val: 0 }
      const numEl = el.querySelector('.stat-num')
      gsap.to(obj, {
        val: stat.value,
        duration: 2.6,
        ease: 'power2.out',
        delay: i * 0.09,
        onUpdate() { if (numEl) numEl.textContent = Math.round(obj.val) + stat.suffix },
        onComplete() {
          if (numEl) {
            gsap.fromTo(numEl,
              { scale: 1 },
              { scale: 1.12, duration: 0.18, yoyo: true, repeat: 1, ease: 'power2.out' }
            )
          }
        },
        scrollTrigger: { trigger: el, start: 'top 85%', once: true, invalidateOnRefresh: true },
      })
    })

    // ── SERVICE SECTIONS ────────────────────────────────────────────────────
    serviceSections.value.forEach((section, i) => {
      if (!section) return

      const isEven     = i % 2 === 0
      const media      = section.querySelector('.service-media')
      const mediaInner = section.querySelector('.media-inner')
      const accentLine = section.querySelector('.service-accent-line')
      const tagline    = section.querySelector('.service-tagline')
      const title      = section.querySelector('.service-title')
      const desc       = section.querySelector('.service-desc')

      const st = { once: true, invalidateOnRefresh: true }

      // Cinematic wipe: clip-path reveals from the edge nearest the text panel
      if (media) {
        gsap.fromTo(media,
          { clipPath: isEven ? 'inset(0% 100% 0% 0%)' : 'inset(0% 0% 0% 100%)' },
          {
            clipPath: 'inset(0% 0% 0% 0%)',
            duration: 1.5, ease: 'power3.inOut',
            scrollTrigger: { ...st, trigger: section, start: 'top 78%' },
          }
        )
      }

      // Accent line draws left-to-right ahead of the text arrival
      if (accentLine) {
        gsap.fromTo(accentLine,
          { scaleX: 0, transformOrigin: 'left center' },
          {
            scaleX: 1, duration: 0.65, ease: 'power3.inOut',
            scrollTrigger: { ...st, trigger: section, start: 'top 68%' },
          }
        )
      }

      // Text: tagline → title → description staggered up
      gsap.fromTo(
        [tagline, title, desc].filter(Boolean),
        { y: 44, autoAlpha: 0 },
        {
          y: 0, autoAlpha: 1, duration: 0.95, stagger: 0.13, ease: 'power3.out',
          scrollTrigger: { ...st, trigger: section, start: 'top 65%' },
        }
      )

      // Video panel scroll parallax (desktop)
      if (mediaInner && !isMobile) {
        gsap.to(mediaInner, {
          yPercent: -12, ease: 'none',
          scrollTrigger: {
            trigger: section, start: 'top bottom', end: 'bottom top',
            scrub: 1.5, invalidateOnRefresh: true,
          },
        })
      }

      // Media panel hover: gentle scale + inner zoom (desktop)
      if (!isMobile && media) {
        const onEnter = () => {
          gsap.to(media,      { scale: 1.02,  duration: 0.55, ease: 'power2.out' })
          if (mediaInner) gsap.to(mediaInner, { scale: 1.025, duration: 0.55, ease: 'power2.out' })
        }
        const onLeave = () => {
          gsap.to(media,      { scale: 1, duration: 0.65, ease: 'power3.out' })
          if (mediaInner) gsap.to(mediaInner, { scale: 1, duration: 0.65, ease: 'power3.out' })
        }
        addListener(media, 'mouseenter', onEnter)
        addListener(media, 'mouseleave', onLeave)
      }
    })

    // ── WHY SECTION ─────────────────────────────────────────────────────────
    if (whySection.value) {

      // Heading slides up
      const heading = whySection.value.querySelector('.why-heading')
      if (heading) {
        gsap.fromTo(heading,
          { y: 40, autoAlpha: 0 },
          {
            y: 0, autoAlpha: 1, duration: 1, ease: 'power3.out',
            scrollTrigger: { trigger: whySection.value, start: 'top 80%', once: true, invalidateOnRefresh: true },
          }
        )
      }

      // Cards entrance stagger
      const cards = whySection.value.querySelectorAll('.why-card')
      if (cards.length) {
        gsap.fromTo(cards,
          { y: 60, autoAlpha: 0, scale: 0.93 },
          {
            y: 0, autoAlpha: 1, scale: 1,
            duration: 0.85, stagger: 0.09, ease: 'power3.out',
            scrollTrigger: { trigger: whySection.value, start: 'top 72%', once: true, invalidateOnRefresh: true },
          }
        )

        // GSAP hover: card lifts, border glows, icon floats upward
        // Using GSAP instead of inline style mutations for smooth, interruptible transitions.
        cards.forEach(card => {
          const icon = card.querySelector('.why-icon')
          const onEnter = () => {
            gsap.to(card, {
              y: -7, scale: 1.02,
              borderColor: 'rgba(236,167,44,0.42)',
              boxShadow: '0 12px 48px rgba(236,167,44,0.13)',
              duration: 0.38, ease: 'power2.out',
            })
            if (icon) gsap.to(icon, { y: -5, scale: 1.1, duration: 0.38, ease: 'power2.out' })
          }
          const onLeave = () => {
            gsap.to(card, {
              y: 0, scale: 1,
              borderColor: 'rgba(255,255,255,0.07)',
              boxShadow: '0 0 0 rgba(0,0,0,0)',
              duration: 0.48, ease: 'power3.out',
            })
            if (icon) gsap.to(icon, { y: 0, scale: 1, duration: 0.48, ease: 'power3.out' })
          }
          addListener(card, 'mouseenter', onEnter)
          addListener(card, 'mouseleave', onLeave)
        })
      }
    }

    // ── BOOKING SECTION ─────────────────────────────────────────────────────
    if (bookingSection.value) {

      // Background image parallax
      const bookBg = bookingSection.value.querySelector('.booking-bg-img')
      if (bookBg && !isMobile) {
        gsap.to(bookBg, {
          yPercent: 15, ease: 'none',
          scrollTrigger: {
            trigger: bookingSection.value, start: 'top bottom', end: 'bottom top',
            scrub: 1.5, invalidateOnRefresh: true,
          },
        })
      }

      // Glow pulse behind CTA
      const bookGlow = bookingSection.value.querySelector('.booking-glow')
      if (bookGlow) {
        gsap.to(bookGlow, {
          opacity: 0.2, scale: 1.2,
          duration: 3.2, ease: 'sine.inOut',
          yoyo: true, repeat: -1,
        })
      }

      // Text reveal stagger
      const bookAnims = bookingSection.value.querySelectorAll('.book-anim')
      if (bookAnims.length) {
        gsap.fromTo(bookAnims,
          { y: 44, autoAlpha: 0 },
          {
            y: 0, autoAlpha: 1, duration: 1, stagger: 0.14, ease: 'power3.out',
            scrollTrigger: {
              trigger: bookingSection.value, start: 'top 75%',
              once: true, invalidateOnRefresh: true,
            },
          }
        )
      }

      // Shine sweep on the primary booking button
      if (!isMobile) {
        const bookBtn = bookingSection.value.querySelector('.book-btn')
        const shine   = bookBtn?.querySelector('.btn-shine')
        if (bookBtn && shine) {
          addListener(bookBtn, 'mouseenter', () => {
            gsap.fromTo(shine, { x: '-130%' }, { x: '200%', duration: 0.5, ease: 'power2.out' })
          })
        }
      }
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
  <Head title="Catering Services — Danny's" />

  <!-- ── Scroll progress bar (top of page) ────────────────────────────── -->
  <div
    ref="scrollProgress"
    class="fixed top-0 left-0 h-[2px] bg-persian z-[9999] w-0 pointer-events-none"
    aria-hidden="true"
  ></div>
  <!-- ── Floating CTA: revealed after hero scro````````````````````````````````````````````````````````````l````````````````````````````````````````````````````````````ls away ───────────────── -->
  <div
    ref="floatingCta"
    class="fixed bottom-8 right-8 z-50 hidden md:block"
    style="filter: drop-shadow(0 8px 24px rgba(236,167,44,0.4)); will-change: transform, opacity"
    aria-hidden="true"
  >
    <a
      href="#booking"
      class="relative overflow-hidden flex items-center gap-2 bg-persian text-oynx font-bold text-sm uppercase tracking-wider px-5 py-3 rounded-full transition-all duration-300 hover:brightness-110 hover:scale-105"
    >
      <i class="fa-solid fa-utensils text-xs"></i>
      Book Your Event
      <!-- Shine sweep element (animated via GSAP on hover) -->
      <span
        class="cta-shine pointer-events-none absolute inset-y-0 w-1/2 -skew-x-12"
        style="background: linear-gradient(90deg, transparent, rgba(255,255,255,0.22), transparent); transform: translateX(-130%)"
        aria-hidden="true"
      ></span>
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
      <!-- Parallax background — Ken Burns scale animated by GSAP -->
      <div class="hero-bg absolute inset-0 overflow-hidden" style="background: radial-gradient(ellipse 55% 55% at 50% 50%, rgba(236,167,44,0.11) 0%, transparent 70%); transform-origin: center; will-change: transform, opacity"
      >
        <img
          src="images/keesha-s-kitchen-3gbiqiGJYUc-unsplash.jpg"
          alt=""
          aria-hidden="true"
          class="hero-bg-img absolute inset-0 w-full object-cover"
          style="height: 130%; top: -15%; will-change: transform; filter: blur(4px)"
        />
        <div class="absolute inset-0 bg-gradient-to-b from-oynx/95 via-oynx/88 to-oynx"></div>
      </div>

      <!-- Animated grain overlay -->
      <div aria-hidden="true" class="grain-overlay absolute inset-0 pointer-events-none z-10"></div>

      <!-- Warm glow — animated via GSAP ref (scale pulse + mouse-follow) -->
      <div
        ref="heroGlow"
        aria-hidden="true"
        class="hero-glow absolute inset-0 z-10 pointer-events-none"
        style="background: radial-gradient(ellipse 70% 50% at 50% 40%, rgba(236,167,44,0.09) 0%, transparent 70%); transform-origin: center; will-change: transform, opacity"
      ></div>

      <!-- Hero content -->
      <div class="relative z-20 text-center px-6 max-w-6xl mx-auto">

        <!-- Badge — first element in the entrance timeline -->
        <div
          ref="heroBadge"
          class="inline-flex items-center gap-2 bg-persian text-oynx text-xs font-bold uppercase tracking-[0.18em] px-4 py-2 rounded-full mb-10"
          style="will-change: transform, opacity"
        >
          <i class="fa-solid fa-star" style="font-size: 9px"></i>
          Premium Catering Services
          <i class="fa-solid fa-star" style="font-size: 9px"></i>
        </div>

        <!-- Title — per-character refs for 3-D flip stagger -->
        <div class="overflow-hidden pb-2">
          <h1
            class="text-snow text-[13vw] sm:text-[11vw] md:text-[9vw] font-black uppercase leading-none tracking-tight"
            style="text-shadow: 0 2px 24px rgba(0,0,0,0.6)"
          >
            <span
              v-for="item in titleChars"
              :key="item.i"
              :ref="el => { if (el) charRefs[item.i] = el }"
              class="inline-block"
              :style="item.char === ' ' ? 'width: 0.28em' : 'will-change: transform, opacity'"
            >{{ item.char === ' ' ? ' ' : item.char }}</span>
          </h1>
        </div>

        <!-- Subtitle — blur-to-sharp entrance -->
        <p
          ref="heroSubtitle"
          class="mt-6 text-lg md:text-xl text-snow/85 max-w-xl mx-auto leading-relaxed"
          style="will-change: transform, opacity"
        >
          Crafting unforgettable culinary experiences for weddings, anniversaries,
          birthdays, and corporate events.
        </p>

        <!-- CTAs — magnetic-btn class enables GSAP cursor-pull on desktop -->
        <div
          ref="heroCta"
          class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4"
          style="will-change: transform, opacity"
        >
          <Reservation v-slot="{ open }">
            <button
              @click="open"
              class="magnetic-btn group inline-flex items-center gap-3 bg-persian text-oynx font-bold text-sm uppercase tracking-widest px-7 py-3 rounded-full transition-colors duration-300 hover:brightness-110 active:scale-95"
            >
              <i class="fa-solid fa-calendar-check text-xs"></i>
              Reserve Your Table
            </button>
          </Reservation>
          <a
            href="#services"
            class="magnetic-btn group flex items-center gap-2 border border-snow/40 text-snow font-semibold text-sm uppercase tracking-wider px-6 py-3 rounded-lg transition-all duration-300 hover:border-snow hover:bg-snow/10"
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
    <section
      ref="statsSection"
      class="border-y border-persian/20 bg-persian/5"
      style="will-change: transform, opacity"
    >
      <div class="container mx-auto px-6 py-14 grid grid-cols-2 md:grid-cols-4 divide-persian/15 md:divide-x">
        <div
          v-for="(stat, i) in stats"
          :key="stat.label"
          :ref="el => { if (el) statEls[i] = el }"
          class="flex flex-col items-center text-center py-4 md:py-0 px-6"
        >
          <span class="stat-num text-4xl md:text-5xl font-black text-persian tabular-nums" style="will-change: transform">
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
        <!-- Media panel — clip-path wipe + scroll parallax + hover zoom -->
        <div
          class="service-media relative w-full md:w-1/2 min-h-[60vw] md:min-h-screen overflow-hidden"
          style="will-change: clip-path"
        >
          <div class="media-inner absolute inset-0" style="scale: 1.12; will-change: transform">
            <video
              class="w-full h-full object-cover"
              autoplay muted loop playsinline
              :poster="service.image"
              preload="none"
              onloadedmetadata="this.playbackRate = 0.6"
            >
              <source :src="service.video" type="video/mp4" />
            </video>
            <div class="absolute inset-0 bg-oynx/30 md:hidden"></div>
          </div>

          <!-- Gradient toward text -->
          <div
            class="absolute inset-0 pointer-events-none"
            :class="i % 2 === 0
              ? 'bg-gradient-to-r from-transparent via-transparent to-oynx'
              : 'bg-gradient-to-l from-transparent via-transparent to-oynx'"
          ></div>
          <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-oynx md:hidden pointer-events-none"></div>

          <!-- Large watermark index -->
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

            <!-- Accent line: GSAP scaleX from 0 → 1 -->
            <div
              class="service-accent-line h-[2px] w-12 mb-6"
              :style="{ background: service.accent }"
            ></div>

            <span
              class="service-tagline inline-flex items-center gap-2 text-xs font-bold uppercase tracking-[0.22em] mb-6"
              :style="{ color: service.accent }"
            >
              {{ service.icon }} {{ service.tagline }}
            </span>

            <h2
              class="service-title font-black uppercase leading-none mb-6"
              style="font-size: clamp(2.5rem, 5vw, 4.5rem)"
            >
              <span class="block text-snow">{{ service.title }}</span>
              <span :style="{ color: service.accent }">{{ service.subtitle }}</span>
            </h2>

            <p
              class="service-desc text-snow/60 leading-relaxed max-w-md"
              style="font-size: clamp(0.95rem, 1.5vw, 1.1rem)"
            >
              {{ service.description }}
            </p>
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

        <!-- Heading animated separately from cards -->
        <div class="why-heading text-center mb-16" style="will-change: transform, opacity">
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
            class="why-card relative rounded-2xl p-8 border cursor-default"
            style="background: rgba(34,30,34,0.6); border-color: rgba(255,255,255,0.07); will-change: transform, opacity"
          >
            <!-- why-icon class lets GSAP target the emoji independently on hover -->
            <div class="why-icon text-4xl mb-5 leading-none" style="will-change: transform">
              {{ item.icon }}
            </div>
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
      <!-- Background image — booking-bg-img class enables GSAP parallax -->
      <div class="absolute inset-0 overflow-hidden">
        <img
          src="images/keesha-s-kitchen-PqG32DYCTM8-unsplash.jpg"
          alt=""
          aria-hidden="true"
          class="booking-bg-img w-full h-full object-cover"
          style="will-change: transform"
        />
        <div class="absolute inset-0 bg-oynx/88"></div>
      </div>

      <!-- Booking glow — animated by GSAP scale pulse -->
      <div
        aria-hidden="true"
        class="booking-glow absolute inset-0 pointer-events-none"
        style="background: radial-gradient(ellipse 55% 55% at 50% 50%, rgba(236,167,44,0.11) 0%, transparent 70%); transform-origin: center; will-change: transform, opacity"
      ></div>

      <div class="relative z-10 container mx-auto px-6 max-w-3xl">
        <span
          class="book-anim inline-block text-persian text-xs font-bold uppercase tracking-[0.22em] mb-6"
          style="will-change: transform, opacity"
        >
          Let's Create Something Extraordinary
        </span>

        <h2
          class="book-anim font-black uppercase leading-tight mb-6"
          style="font-size: clamp(2.2rem, 5vw, 4rem); will-change: transform, opacity"
        >
          Your Perfect Event<br />
          <span class="text-persian">Starts Here</span>
        </h2>

        <p
          class="book-anim text-lg leading-relaxed mb-10"
          style="color: rgba(255,252,249,0.58); will-change: transform, opacity"
        >
          From intimate gatherings to grand celebrations — we handle every
          detail so you can focus on the moments that matter.
        </p>

        <div
          class="book-anim flex flex-col sm:flex-row items-center justify-center gap-4"
          style="will-change: transform, opacity"
        >
          <Reservation v-slot="{ open }">
            <!-- book-btn class + .btn-shine enable the GSAP shine sweep on hover -->
            <button
              @click="open"
              class="book-btn group relative overflow-hidden inline-flex items-center gap-3 bg-persian text-oynx font-bold text-sm uppercase tracking-widest px-8 py-4 rounded-full transition-colors duration-300 hover:brightness-110 hover:scale-105 active:scale-95"
              style="box-shadow: 0 4px 24px rgba(236,167,44,0.35)"` 
            >
              <i class="fa-solid fa-calendar-check"></i>
              Book Your Event
              <!-- Shine sweep element -->
              <span
                class="btn-shine pointer-events-none absolute inset-y-0 w-1/2 -skew-x-12"
                style="background: linear-gradient(90deg, transparent, rgba(255,255,255,0.22), transparent); transform: translateX(-130%)"
                aria-hidden="true"
              ></span>
            </button>
          </Reservation>

          <a
            href="tel:+17058886114"
            class="group flex items-center gap-2 border font-semibold text-sm uppercase tracking-wider px-6 py-3 rounded-lg transition-all duration-300 hover:scale-105"
            style="border-color: rgba(255,255,255,0.25); color: rgba(255,252,249,0.75)"
            @mouseenter="e => { e.currentTarget.style.borderColor='rgba(255,255,255,0.55)'; e.currentTarget.style.color='#FFFCF9' }"
            @mouseleave="e => { e.currentTarget.style.borderColor='rgba(255,255,255,0.25)'; e.currentTarget.style.color='rgba(255,252,249,0.75)' }"
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
/* Animated film-grain texture */
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

:global(html) { scroll-behavior: smooth; }
</style>

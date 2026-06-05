<script setup>
import { computed, nextTick, onMounted, onUnmounted, ref, watch } from 'vue'
import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'

gsap.registerPlugin(ScrollTrigger)

const galleryRef = ref(null)
const liquidBlobRefs = ref([])
const eyebrowRef = ref(null)
const headingRef = ref(null)
const subtitleRef = ref(null)
const cardRefs = ref([])
const lightboxRef = ref(null)
const lightboxPanelRef = ref(null)
const lightboxImageRef = ref(null)
const lightboxCaptionRef = ref(null)

let ctx = null
let lightboxTween = null
const cleanupFns = []

const reduceMotion = typeof window !== 'undefined'
  ? window.matchMedia('(prefers-reduced-motion: reduce)').matches
  : false

const isMobile = () => typeof window !== 'undefined' && window.innerWidth < 768

const addListener = (el, event, fn, opts) => {
  if (!el) return
  el.addEventListener(event, fn, opts)
  cleanupFns.push(() => el.removeEventListener(event, fn, opts))
}

const galleryImages = [
  {
    src: 'images/Screenshot (73).png',
    title: 'Freshly Prepared',
    category: 'Kitchen Moments',
    alt: 'Fresh Nigerian food being prepared in Danny\'s kitchen',
    size: 'feature',
  },
  {
    src: 'images/Screenshot (55).png',
    title: 'Party Jollof',
    category: 'Authentic Nigerian Taste',
    alt: 'A serving of Nigerian party jollof rice prepared for guests',
    size: 'wide',
  },
  {
    src: 'images/Screenshot (74).png',
    title: 'Family Celebration',
    category: 'Gatherings',
    alt: 'Food arranged for a warm family celebration',
    size: 'tall',
  },
  {
    src: 'images/Screenshot (38).png',
    title: 'Event Catering',
    category: 'Large Orders',
    alt: 'Prepared Nigerian dishes ready for an event catering order',
    size: 'standard',
  },
  {
    src: 'images/Screenshot (39).png',
    title: 'Kitchen Moments',
    category: 'Behind the Scenes',
    alt: 'Behind-the-scenes kitchen moment at Danny\'s',
    size: 'standard',
  },
  {
    src: 'images/Screenshot (50).png',
    title: 'Authentic Nigerian Taste',
    category: 'Traditional Flavour',
    alt: 'Traditional Nigerian food presented for dine-in or takeout',
    size: 'wide',
  },
  {
    src: 'images/Screenshot (64).png',
    title: 'Small Tray Favourites',
    category: 'Takeout',
    alt: 'Small quantity Nigerian takeout prepared fresh',
    size: 'standard',
  },
  {
    src: 'images/Screenshot (40).png',
    title: 'Shared Plates',
    category: 'Dine In',
    alt: 'Shared plates of Nigerian food for dine-in guests',
    size: 'tall',
  },
  {
    src: 'images/Screenshot (37).png',
    title: 'Celebration Portions',
    category: 'Large Quantity',
    alt: 'Large portions of Nigerian food for celebrations',
    size: 'standard',
  },
  {
    src: 'images/Screenshot (42).png',
    title: 'Flavour in Every Detail',
    category: 'Chef Prepared',
    alt: 'Close-up of carefully prepared Nigerian cuisine',
    size: 'standard',
  },
  {
    src: 'images/Screenshot (51).png',
    title: 'Golden Jollof Moments',
    category: 'Customer Favourite',
    alt: 'Golden Nigerian jollof rice presented as a customer favourite',
    size: 'wide',
  },
  {
    src: 'images/Screenshot (48).png',
    title: 'Made for the Table',
    category: 'Dine In',
    alt: 'Nigerian dishes served beautifully for the table',
    size: 'standard',
  },
  {
    src: 'images/Screenshot (78).png',
    title: 'Premium Event Spread',
    category: 'Event Catering',
    alt: 'Premium Nigerian food spread for an event',
    size: 'feature',
  },
  {
    src: 'images/Screenshot (65).png',
    title: 'Comfort Food Classics',
    category: 'Traditional',
    alt: 'Classic Nigerian comfort food prepared for guests',
    size: 'standard',
  },
  {
    src: 'images/Screenshot (80).png',
    title: 'Ready for Pickup',
    category: 'Takeout',
    alt: 'Nigerian takeout order ready for pickup',
    size: 'standard',
  },
  {
    src: 'images/Screenshot (47).png',
    title: 'Warm Hospitality',
    category: 'Guest Experience',
    alt: 'A warm restaurant hospitality moment at Danny\'s',
    size: 'tall',
  },
  {
    src: 'images/Screenshot (41).png',
    title: 'Rich Soup Pairings',
    category: 'Authentic Taste',
    alt: 'Rich Nigerian soup pairing prepared with care',
    size: 'standard',
  },
  {
    src: 'images/Screenshot (81).png',
    title: 'Large Tray Orders',
    category: 'Celebrations',
    alt: 'Large tray Nigerian food order prepared for a celebration',
    size: 'wide',
  },
  {
    src: 'images/Screenshot (75).png',
    title: 'Fresh From the Kitchen',
    category: 'Daily Cooking',
    alt: 'Fresh Nigerian food coming from the kitchen',
    size: 'standard',
  },
  {
    src: 'images/Screenshot (43).png',
    title: 'Food Worth Gathering For',
    category: 'Family and Events',
    alt: 'Nigerian food prepared for family and event gatherings',
    size: 'standard',
  },
]

const selectedIndex = ref(null)
const selectedImage = computed(() => (
  selectedIndex.value === null ? null : galleryImages[selectedIndex.value]
))

const sizeClasses = {
  feature: 'md:col-span-2 md:row-span-2 min-h-[24rem]',
  wide: 'md:col-span-2 min-h-[17rem]',
  tall: 'md:row-span-2 min-h-[24rem]',
  standard: 'min-h-[17rem]',
}

const openLightbox = async (index) => {
  selectedIndex.value = index
  document.body.style.overflow = 'hidden'
  await nextTick()

  if (reduceMotion) return

  lightboxTween?.kill()
  lightboxTween = gsap.timeline()
    .fromTo(lightboxRef.value, { autoAlpha: 0 }, { autoAlpha: 1, duration: 0.22, ease: 'power2.out' })
    .fromTo(lightboxPanelRef.value, { scale: 0.96, y: 18 }, { scale: 1, y: 0, duration: 0.42, ease: 'power3.out' }, '<')
    .fromTo(lightboxImageRef.value, { scale: 0.92, autoAlpha: 0 }, { scale: 1, autoAlpha: 1, duration: 0.48, ease: 'power3.out' }, '-=0.24')
    .fromTo(lightboxCaptionRef.value, { y: 16, autoAlpha: 0 }, { y: 0, autoAlpha: 1, duration: 0.34, ease: 'power2.out' }, '-=0.2')
}

const closeLightbox = () => {
  if (selectedIndex.value === null) return

  const finishClose = () => {
    selectedIndex.value = null
    document.body.style.overflow = ''
  }

  if (reduceMotion || !lightboxRef.value) {
    finishClose()
    return
  }

  lightboxTween?.kill()
  lightboxTween = gsap.timeline({ onComplete: finishClose })
    .to(lightboxPanelRef.value, { scale: 0.97, y: 12, duration: 0.22, ease: 'power2.in' })
    .to(lightboxRef.value, { autoAlpha: 0, duration: 0.2, ease: 'power2.in' }, '<')
}

const showPrevious = () => {
  if (selectedIndex.value === null) return
  selectedIndex.value = (selectedIndex.value - 1 + galleryImages.length) % galleryImages.length
}

const showNext = () => {
  if (selectedIndex.value === null) return
  selectedIndex.value = (selectedIndex.value + 1) % galleryImages.length
}

const handleKeydown = (event) => {
  if (selectedIndex.value === null) return

  if (event.key === 'Escape') closeLightbox()
  if (event.key === 'ArrowLeft') showPrevious()
  if (event.key === 'ArrowRight') showNext()
}

onMounted(async () => {
  await nextTick()

  addListener(window, 'keydown', handleKeydown)

  if (reduceMotion) return

  ctx = gsap.context(() => {
    const cards = cardRefs.value.filter(Boolean)
    const featureCards = cards.filter(card => card.dataset.size === 'feature')
    const standardCards = cards.filter(card => card.dataset.size !== 'feature')
    const liquidBlobs = liquidBlobRefs.value.filter(Boolean)

    ScrollTrigger.refresh()

    if (liquidBlobs.length) {
      gsap.to(liquidBlobs, {
        x: (index) => index % 2 === 0 ? 28 : -24,
        y: (index) => index % 2 === 0 ? -20 : 26,
        scale: (index) => index % 2 === 0 ? 1.12 : 0.94,
        duration: 7,
        ease: 'sine.inOut',
        repeat: -1,
        yoyo: true,
        stagger: 0.8,
      })
    }

    const intro = gsap.timeline({
      scrollTrigger: {
        trigger: galleryRef.value,
        start: 'top 78%',
        once: true,
        invalidateOnRefresh: true,
      },
    })

    intro
      .fromTo(eyebrowRef.value, { y: 18, autoAlpha: 0 }, { y: 0, autoAlpha: 1, duration: 0.55, ease: 'power2.out' })
      .fromTo(headingRef.value, { y: 28, autoAlpha: 0 }, { y: 0, autoAlpha: 1, duration: 0.75, ease: 'power3.out' }, '-=0.25')
      .fromTo(subtitleRef.value, { y: 18, autoAlpha: 0 }, { y: 0, autoAlpha: 1, duration: 0.68, ease: 'power2.out' }, '-=0.35')
      .fromTo(featureCards, { y: 46, scale: 0.94, rotate: -1.8, autoAlpha: 0 }, { y: 0, scale: 1, rotate: 0, autoAlpha: 1, duration: 0.95, stagger: 0.12, ease: 'power3.out' }, '-=0.12')
      .fromTo(standardCards, { y: 34, scale: 0.96, rotate: 1.2, autoAlpha: 0 }, { y: 0, scale: 1, rotate: 0, autoAlpha: 1, duration: 0.72, stagger: 0.055, ease: 'power3.out' }, '-=0.58')

    if (!isMobile()) {
      cards.forEach((card) => {
        const image = card.querySelector('.gallery-image')
        const overlay = card.querySelector('.gallery-overlay')
        const caption = card.querySelector('.gallery-caption')
        const shine = card.querySelector('.liquid-glass-shine')

        const onEnter = () => {
          gsap.to(card, {
            y: -8,
            rotateX: 0,
            rotateY: 0,
            boxShadow: '0 26px 60px rgba(180, 83, 9, 0.22)',
            borderColor: 'rgba(245, 158, 11, 0.55)',
            duration: 0.35,
            ease: 'power2.out',
            overwrite: 'auto',
          })
          gsap.to(image, { scale: 1.07, duration: 0.7, ease: 'power3.out', overwrite: 'auto' })
          gsap.to(overlay, { opacity: 1, duration: 0.3, ease: 'power2.out', overwrite: 'auto' })
          gsap.to(caption, { y: 0, autoAlpha: 1, duration: 0.34, ease: 'power2.out', overwrite: 'auto' })
          gsap.fromTo(shine, { xPercent: -40, opacity: 0 }, { xPercent: 52, opacity: 0.9, duration: 0.75, ease: 'power2.out', overwrite: 'auto' })
        }

        const onMove = (event) => {
          const rect = card.getBoundingClientRect()
          const x = (event.clientX - rect.left) / rect.width - 0.5
          const y = (event.clientY - rect.top) / rect.height - 0.5

          gsap.to(card, {
            rotateY: x * 4,
            rotateX: y * -4,
            x: x * 5,
            duration: 0.45,
            ease: 'power2.out',
            overwrite: 'auto',
          })
        }

        const onLeave = () => {
          gsap.to(card, {
            y: 0,
            x: 0,
            rotateX: 0,
            rotateY: 0,
            boxShadow: '0 14px 35px rgba(15, 23, 42, 0.08)',
            borderColor: 'rgba(226, 232, 240, 0.92)',
            duration: 0.52,
            ease: 'power3.out',
            overwrite: 'auto',
          })
          gsap.to(image, { scale: 1, duration: 0.75, ease: 'power3.out', overwrite: 'auto' })
          gsap.to(overlay, { opacity: 0, duration: 0.34, ease: 'power2.out', overwrite: 'auto' })
          gsap.to(caption, { y: 18, autoAlpha: 0, duration: 0.28, ease: 'power2.out', overwrite: 'auto' })
          gsap.to(shine, { opacity: 0, duration: 0.25, ease: 'power2.out', overwrite: 'auto' })
        }

        addListener(card, 'mouseenter', onEnter)
        addListener(card, 'mousemove', onMove)
        addListener(card, 'mouseleave', onLeave)
      })
    }
  }, galleryRef.value)
})

watch(selectedIndex, async (newIndex, oldIndex) => {
  if (newIndex === null || oldIndex === null || reduceMotion) return
  await nextTick()
  gsap.fromTo(lightboxImageRef.value, { autoAlpha: 0, scale: 0.97 }, { autoAlpha: 1, scale: 1, duration: 0.28, ease: 'power2.out' })
  gsap.fromTo(lightboxCaptionRef.value, { y: 12, autoAlpha: 0 }, { y: 0, autoAlpha: 1, duration: 0.25, ease: 'power2.out' })
})

onUnmounted(() => {
  ctx?.revert()
  lightboxTween?.kill()
  cleanupFns.forEach(fn => fn())
  cleanupFns.length = 0
  document.body.style.overflow = ''
})
</script>

<template>
  <section
    ref="galleryRef"
    class="relative isolate overflow-hidden rounded-[2rem] px-4 py-10 text-slate-950 sm:px-6 lg:px-8"
    aria-labelledby="gallery-heading"
  >
    <div class="gallery-glow gallery-glow-left" aria-hidden="true"></div>
    <div class="gallery-glow gallery-glow-right" aria-hidden="true"></div>
    <div
      :ref="el => { if (el) liquidBlobRefs[0] = el }"
      class="liquid-glass-blob left-[6%] top-28 h-28 w-28 bg-amber-300/70"
      aria-hidden="true"
    ></div>
    <div
      :ref="el => { if (el) liquidBlobRefs[1] = el }"
      class="liquid-glass-blob bottom-24 right-[10%] h-36 w-36 bg-red-300/45"
      aria-hidden="true"
    ></div>

    <div class="mx-auto max-w-7xl">
      <div class="liquid-glass-panel mx-auto mb-10 max-w-3xl rounded-[1.75rem] px-5 py-8 text-center md:mb-14 md:px-10">
        <p
          ref="eyebrowRef"
          class="mb-4 text-xs font-black uppercase tracking-[0.28em] text-amber-600"
          style="will-change: transform, opacity"
        >
          Danny's in Pictures
        </p>
        <h1
          id="gallery-heading"
          ref="headingRef"
          class="text-4xl font-black uppercase leading-tight text-slate-950 sm:text-5xl lg:text-6xl"
          style="will-change: transform, opacity"
        >
          A Gallery of Flavour, Family &amp; Celebration
        </h1>
        <p
          ref="subtitleRef"
          class="mx-auto mt-5 max-w-2xl text-base leading-7 text-slate-600 sm:text-lg"
          style="will-change: transform, opacity"
        >
          From freshly prepared favourites to generous trays for special moments, every frame tells the story of food made with care.
        </p>
      </div>

      <div class="gallery-grid" aria-label="Danny's food and event photo gallery">
        <figure
          v-for="(image, index) in galleryImages"
          :key="image.src"
          :ref="el => { if (el) cardRefs[index] = el }"
          :data-size="image.size"
          class="gallery-card liquid-glass-card group relative min-h-[17rem] overflow-hidden rounded-2xl border border-slate-200/90 bg-white shadow-[0_14px_35px_rgba(15,23,42,0.08)] outline-none transition-colors duration-300 focus-within:border-amber-500"
          :class="sizeClasses[image.size]"
          style="will-change: transform"
        >
          <button
            type="button"
            class="block h-full w-full cursor-pointer overflow-hidden text-left outline-none focus-visible:ring-4 focus-visible:ring-amber-400/60"
            :aria-label="`Open gallery image: ${image.title}`"
            @click="openLightbox(index)"
          >
            <span class="liquid-glass-shine" aria-hidden="true"></span>
            <img
              :src="image.src"
              :alt="image.alt"
              class="gallery-image h-full w-full object-cover"
              loading="lazy"
              decoding="async"
              style="will-change: transform"
            />

            <div
              class="gallery-overlay absolute inset-0 bg-gradient-to-t from-slate-950/82 via-slate-950/24 to-transparent opacity-0"
              aria-hidden="true"
              style="will-change: opacity"
            ></div>

            <figcaption
              class="gallery-caption absolute inset-x-0 bottom-0 z-10 translate-y-5 p-5 text-white opacity-0 sm:p-6"
              style="will-change: transform, opacity"
            >
              <span class="mb-2 inline-flex rounded-full border border-amber-200/45 bg-amber-300/18 px-3 py-1 text-[0.68rem] font-black uppercase tracking-[0.2em] text-amber-100 backdrop-blur">
                {{ image.category }}
              </span>
              <h2 class="text-xl font-black leading-tight sm:text-2xl">{{ image.title }}</h2>
            </figcaption>
          </button>
        </figure>
      </div>
    </div>

    <Teleport to="body">
      <div
        v-if="selectedImage"
        ref="lightboxRef"
        class="fixed inset-0 z-[10000] flex items-center justify-center bg-slate-950/88 px-4 py-6 backdrop-blur-md"
        role="dialog"
        aria-modal="true"
        :aria-label="`Preview image: ${selectedImage.title}`"
        @click.self="closeLightbox"
      >
        <div
          ref="lightboxPanelRef"
          class="liquid-glass-panel liquid-glass-dark relative flex max-h-[92vh] w-full max-w-6xl flex-col overflow-hidden rounded-2xl border border-white/15 bg-slate-950 shadow-2xl"
          style="will-change: transform"
        >
          <button
            type="button"
            class="liquid-glass-control absolute right-4 top-4 z-20 inline-flex h-10 w-10 items-center justify-center rounded-full border border-white/20 bg-white/12 text-xl font-bold text-white backdrop-blur transition hover:bg-white/20 focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-amber-300/70"
            aria-label="Close gallery preview"
            @click="closeLightbox"
          >
            &times;
          </button>

          <button
            type="button"
            class="liquid-glass-control absolute left-4 top-1/2 z-20 hidden h-11 w-11 -translate-y-1/2 items-center justify-center rounded-full border border-white/20 bg-white/12 text-3xl text-white backdrop-blur transition hover:bg-white/20 focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-amber-300/70 sm:inline-flex"
            aria-label="Show previous image"
            @click="showPrevious"
          >
            &#8249;
          </button>

          <button
            type="button"
            class="liquid-glass-control absolute right-4 top-1/2 z-20 hidden h-11 w-11 -translate-y-1/2 items-center justify-center rounded-full border border-white/20 bg-white/12 text-3xl text-white backdrop-blur transition hover:bg-white/20 focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-amber-300/70 sm:inline-flex"
            aria-label="Show next image"
            @click="showNext"
          >
            &#8250;
          </button>

          <div class="relative min-h-0 flex-1 bg-black">
            <img
              ref="lightboxImageRef"
              :src="selectedImage.src"
              :alt="selectedImage.alt"
              class="max-h-[72vh] w-full object-contain"
              decoding="async"
              style="will-change: transform, opacity"
            />
          </div>

          <div
            ref="lightboxCaptionRef"
            class="flex flex-col gap-4 border-t border-white/10 bg-gradient-to-r from-slate-950 via-slate-900 to-amber-950/70 p-5 text-white sm:flex-row sm:items-center sm:justify-between sm:p-6"
            style="will-change: transform, opacity"
          >
            <div>
              <p class="text-xs font-black uppercase tracking-[0.24em] text-amber-200">{{ selectedImage.category }}</p>
              <h2 class="mt-2 text-2xl font-black">{{ selectedImage.title }}</h2>
            </div>

            <div class="flex gap-3 sm:hidden">
              <button
                type="button"
                class="liquid-glass-control inline-flex flex-1 items-center justify-center rounded-full border border-white/20 px-5 py-3 text-sm font-bold uppercase tracking-wider text-white focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-amber-300/70"
                aria-label="Show previous image"
                @click="showPrevious"
              >
                Prev
              </button>
              <button
                type="button"
                class="liquid-glass-control inline-flex flex-1 items-center justify-center rounded-full border border-white/20 px-5 py-3 text-sm font-bold uppercase tracking-wider text-white focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-amber-300/70"
                aria-label="Show next image"
                @click="showNext"
              >
                Next
              </button>
            </div>
          </div>
        </div>
      </div>
    </Teleport>
  </section>
</template>

<style scoped>
.gallery-grid {
  display: grid;
  grid-auto-flow: dense;
  grid-auto-rows: 8.5rem;
  grid-template-columns: repeat(1, minmax(0, 1fr));
  gap: 1rem;
}

.gallery-card {
  min-height: 17rem;
  perspective: 900px;
}

.gallery-glow {
  position: absolute;
  z-index: -1;
  width: 24rem;
  height: 24rem;
  border-radius: 9999px;
  filter: blur(80px);
  opacity: 0.35;
  pointer-events: none;
  animation: gallery-float 8s ease-in-out infinite;
}

.gallery-glow-left {
  top: 4rem;
  left: -10rem;
  background: rgba(251, 191, 36, 0.34);
}

.gallery-glow-right {
  right: -8rem;
  bottom: 7rem;
  background: rgba(248, 113, 113, 0.22);
  animation-delay: -2.5s;
}

@keyframes gallery-float {
  0%, 100% {
    transform: translate3d(0, 0, 0) scale(1);
  }

  50% {
    transform: translate3d(0, -18px, 0) scale(1.06);
  }
}

@media (min-width: 640px) {
  .gallery-grid {
    grid-template-columns: repeat(2, minmax(0, 1fr));
  }
}

@media (min-width: 768px) {
  .gallery-grid {
    grid-auto-rows: 8rem;
    grid-template-columns: repeat(4, minmax(0, 1fr));
  }
}

@media (min-width: 1024px) {
  .gallery-grid {
    grid-auto-rows: 8.75rem;
    gap: 1.15rem;
  }
}

@media (prefers-reduced-motion: reduce) {
  .gallery-glow {
    animation: none;
  }

  .gallery-card,
  .gallery-image,
  .gallery-overlay,
  .gallery-caption {
    transition: none;
  }
}
</style>

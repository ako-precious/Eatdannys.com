<template>
  <div class="container">
    <div class="header">
      <h1>Customer Testimonials</h1>
      <p>What our clients say about working with us</p>
    </div>
    
    <div class="carousel-container">
      <div class="carousel" :style="{ transform: `translateX(-${currentIndex * 100}%)` }">
        <div class="slide" v-for="(testimonial, index) in testimonials" :key="index">
          <div class="testimonial-card">
            <svg class="quote-icon" aria-hidden="true" width="105" height="78">
              <path d="M25.086 77.292c-4.821 0-9.115-1.205-12.882-3.616-3.767-2.561-6.78-6.102-9.04-10.622C1.054 58.534 0 53.411 0 47.686c0-5.273.904-10.396 2.712-15.368 1.959-4.972 4.746-9.567 8.362-13.786a59.042 59.042 0 0 1 12.43-11.3C28.325 3.917 33.599 1.507 39.324 0l11.074 13.786c-6.479 2.561-11.677 5.951-15.594 10.17-3.767 4.219-5.65 7.835-5.65 10.848 0 1.356.377 2.863 1.13 4.52.904 1.507 2.637 3.089 5.198 4.746 3.767 2.41 6.328 4.972 7.684 7.684 1.507 2.561 2.26 5.5 2.26 8.814 0 5.123-1.959 9.19-5.876 12.204-3.767 3.013-8.588 4.52-14.464 4.52Zm54.24 0c-4.821 0-9.115-1.205-12.882-3.616-3.767-2.561-6.78-6.102-9.04-10.622-2.11-4.52-3.164-9.643-3.164-15.368 0-5.273.904-10.396 2.712-15.368 1.959-4.972 4.746-9.567 8.362-13.786a59.042 59.042 0 0 1 12.43-11.3C82.565 3.917 87.839 1.507 93.564 0l11.074 13.786c-6.479 2.561-11.677 5.951-15.594 10.17-3.767 4.219-5.65 7.835-5.65 10.848 0 1.356.377 2.863 1.13 4.52.904 1.507 2.637 3.089 5.198 4.746 3.767 2.41 6.328 4.972 7.684 7.684 1.507 2.561 2.26 5.5 2.26 8.814 0 5.123-1.959 9.19-5.876 12.204-3.767 3.013-8.588 4.52-14.464 4.52Z"></path>
            </svg>
            
            <div class="testimonial-content">
              <p class="quote">{{ testimonial.quote }}</p>
              
              <div class="testimonial-footer">
                <div class="author-info">
                  <div class="author-name">{{ testimonial.name }}</div>
                  <div class="author-title">{{ testimonial.title }}</div>
                </div>
                <img :src="testimonial.image" :alt="testimonial.name" class="author-image">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="controls">
      <button class="control-btn" @click="prevSlide">
        <i class="fas fa-chevron-left"></i>
      </button>
      
      <div class="indicators">
        <div v-for="(dot, index) in testimonials.length" 
              :key="index" 
              class="indicator" 
              :class="{ active: currentIndex === index }"
              @click="goToSlide(index)">
        </div>
      </div>
      
      <button class="control-btn" @click="nextSlide">
        <i class="fas fa-chevron-right"></i>
      </button>
    </div>
    
    <div class="footer">
      <p>Vue.js Testimonial Carousel | Made with <i class="fas fa-heart" style="color: #e74c3c;"></i></p>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const currentIndex = ref(0);
const testimonials = ref([
  {
    quote: "Awesome idea. Can't wait to see how this turns out! The implementation was perfect and exceeded our expectations.",
    name: "Alex Johnson",
    title: "Product Manager",
    image: "https://randomuser.me/api/portraits/men/32.jpg"
  },
  {
    quote: "This solution has completely transformed our workflow. The team is more productive and collaboration has improved significantly.",
    name: "Sarah Williams",
    title: "CTO, Tech Innovations",
    image: "https://randomuser.me/api/portraits/women/44.jpg"
  },
  {
    quote: "The attention to detail is remarkable. Every aspect was carefully considered and executed perfectly. Truly impressive work!",
    name: "Michael Chen",
    title: "UX Director",
    image: "https://randomuser.me/api/portraits/men/62.jpg"
  },
  {
    quote: "We've seen a 40% increase in user engagement since implementing this solution. It's been a game-changer for our business.",
    name: "Emma Rodriguez",
    title: "Marketing Lead",
    image: "https://randomuser.me/api/portraits/women/68.jpg"
  },
  {
    quote: "The support team was incredibly responsive and helpful throughout the entire process. Five stars for customer service!",
    name: "David Kim",
    title: "Operations Director",
    image: "https://randomuser.me/api/portraits/men/22.jpg"
  },
  {
    quote: "This is exactly what our company needed. The implementation was seamless and the results have been outstanding.",
    name: "Olivia Parker",
    title: "CEO, Startup Ventures",
    image: "https://randomuser.me/api/portraits/women/26.jpg"
  },
  {
    quote: "I've worked with many solutions in this space, and this one stands out for its simplicity and effectiveness. Highly recommended!",
    name: "James Wilson",
    title: "Senior Developer",
    image: "https://randomuser.me/api/portraits/men/41.jpg"
  },
  {
    quote: "The intuitive interface makes it easy for our entire team to adopt. Training time was minimal and adoption rates are high.",
    name: "Sophia Martinez",
    title: "Training Coordinator",
    image: "https://randomuser.me/api/portraits/women/65.jpg"
  },
  {
    quote: "We've reduced operational costs by 25% since implementation. The ROI has been incredible and beyond our projections.",
    name: "Daniel Thompson",
    title: "Finance Director",
    image: "https://randomuser.me/api/portraits/men/75.jpg"
  },
  {
    quote: "The customization options allowed us to tailor the solution perfectly to our unique workflow requirements. Brilliant execution!",
    name: "Grace Anderson",
    title: "Project Lead",
    image: "https://randomuser.me/api/portraits/women/12.jpg"
  }
]);

function nextSlide() {
  currentIndex.value = (currentIndex.value + 1) % testimonials.value.length;
}

function prevSlide() {
  currentIndex.value = (currentIndex.value - 1 + testimonials.value.length) % testimonials.value.length;
}

function goToSlide(index) {
  currentIndex.value = index;
}

// Auto-advance carousel every 5 seconds
onMounted(() => {
  setInterval(() => {
    nextSlide();
  }, 5000);
});
</script>

<style scoped>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

body {
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
  padding: 20px;
}

.container {
  width: 100%;
  max-width: 1200px;
  padding: 40px 20px;
  margin: 0 auto;
}

.header {
  text-align: center;
  margin-bottom: 40px;
}

.header h1 {
  font-size: 2.5rem;
  color: #2c3e50;
  margin-bottom: 10px;
}

.header p {
  font-size: 1.1rem;
  color: #7f8c8d;
  max-width: 600px;
  margin: 0 auto;
}

.carousel-container {
  position: relative;
  max-width: 900px;
  margin: 0 auto;
  overflow: hidden;
  border-radius: 20px;
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
}

.carousel {
  display: flex;
  transition: transform 0.5s ease-in-out;
}

.slide {
  min-width: 100%;
  padding: 40px;
}

.testimonial-card {
  position: relative;
  border-radius: 16px;
  background: white;
  padding: 40px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
}

.quote-icon {
  position: absolute;
  top: 30px;
  left: 30px;
  width: 80px;
  height: 60px;
  fill: #e0e7ff;
  z-index: 1;
}

.testimonial-content {
  position: relative;
  z-index: 2;
}

.quote {
  font-size: 1.3rem;
  line-height: 1.7;
  color: #34495e;
  margin-bottom: 30px;
  font-style: italic;
}

.testimonial-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding-top: 25px;
  border-top: 1px solid #f0f4f8;
}

.author-info {
  display: flex;
  flex-direction: column;
}

.author-name {
  font-weight: 700;
  font-size: 1.2rem;
  color: #2c3e50;
}

.author-title {
  color: #7f8c8d;
  font-size: 0.95rem;
}

.author-image {
  width: 70px;
  height: 70px;
  border-radius: 50%;
  object-fit: cover;
  border: 3px solid #e0e7ff;
}

.controls {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 30px;
  gap: 15px;
}

.control-btn {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  border: none;
  background: #4a6cf7;
  color: white;
  font-size: 1.2rem;
  cursor: pointer;
  display: flex;
  justify-content: center;
  align-items: center;
  transition: all 0.3s ease;
  box-shadow: 0 4px 10px rgba(74, 108, 247, 0.3);
}

.control-btn:hover {
  background: #3a5af5;
  transform: translateY(-2px);
  box-shadow: 0 6px 15px rgba(74, 108, 247, 0.4);
}

.indicators {
  display: flex;
  justify-content: center;
  gap: 10px;
  margin-top: 0;
}

.indicator {
  width: 12px;
  height: 12px;
  border-radius: 50%;
  background: #d1d8e0;
  cursor: pointer;
  transition: all 0.3s ease;
}

.indicator.active {
  background: #4a6cf7;
  transform: scale(1.2);
}

.footer {
  text-align: center;
  margin-top: 40px;
  color: #7f8c8d;
  font-size: 0.9rem;
}

.footer a {
  color: #4a6cf7;
  text-decoration: none;
}

.footer a:hover {
  text-decoration: underline;
}

@media (max-width: 768px) {
  .testimonial-card {
    padding: 30px 20px;
  }
  
  .quote {
    font-size: 1.1rem;
  }
  
  .author-image {
    width: 60px;
    height: 60px;
  }
  
  .control-btn {
    width: 45px;
    height: 45px;
  }
  
  .slide {
    padding: 20px;
  }
}
</style>
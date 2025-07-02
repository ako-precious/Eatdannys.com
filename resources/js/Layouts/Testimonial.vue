<template>
    <div class="container w-full  py-20  m-auto">
        <div class="header">
            <h1 class="font-semibold text-2xl md:text-4xl pt-3 text-polynesian">
                Customer Testimonials
            </h1>
        </div>

        <div class="carousel-container">
            <div
                class="carousel"
                :style="{ transform: `translateX(-${currentIndex * 100}%)` }"
            >
                <div
                    class="slide"
                    v-for="(testimonial, index) in testimonials"
                    :key="index"
                >
                    <div class="testimonial-card p-2">
                        <svg
                            class="quote-icon"
                            aria-hidden="true"
                            width="105"
                            height="78"
                        >
                            <path
                                d="M25.086 77.292c-4.821 0-9.115-1.205-12.882-3.616-3.767-2.561-6.78-6.102-9.04-10.622C1.054 58.534 0 53.411 0 47.686c0-5.273.904-10.396 2.712-15.368 1.959-4.972 4.746-9.567 8.362-13.786a59.042 59.042 0 0 1 12.43-11.3C28.325 3.917 33.599 1.507 39.324 0l11.074 13.786c-6.479 2.561-11.677 5.951-15.594 10.17-3.767 4.219-5.65 7.835-5.65 10.848 0 1.356.377 2.863 1.13 4.52.904 1.507 2.637 3.089 5.198 4.746 3.767 2.41 6.328 4.972 7.684 7.684 1.507 2.561 2.26 5.5 2.26 8.814 0 5.123-1.959 9.19-5.876 12.204-3.767 3.013-8.588 4.52-14.464 4.52Zm54.24 0c-4.821 0-9.115-1.205-12.882-3.616-3.767-2.561-6.78-6.102-9.04-10.622-2.11-4.52-3.164-9.643-3.164-15.368 0-5.273.904-10.396 2.712-15.368 1.959-4.972 4.746-9.567 8.362-13.786a59.042 59.042 0 0 1 12.43-11.3C82.565 3.917 87.839 1.507 93.564 0l11.074 13.786c-6.479 2.561-11.677 5.951-15.594 10.17-3.767 4.219-5.65 7.835-5.65 10.848 0 1.356.377 2.863 1.13 4.52.904 1.507 2.637 3.089 5.198 4.746 3.767 2.41 6.328 4.972 7.684 7.684 1.507 2.561 2.26 5.5 2.26 8.814 0 5.123-1.959 9.19-5.876 12.204-3.767 3.013-8.588 4.52-14.464 4.52Z"
                            ></path>
                        </svg>

                        <div class="testimonial-content p-3">
                            <p class="quote text-base">{{ testimonial.quote }}</p>

                            <div class="testimonial-footer">
                                <div class="author-info">
                                    <div
                                        class="author-name text-lg font-semibold"
                                    >
                                        {{ testimonial.name }}
                                    </div>
                                </div>
                                <img
                                    :src="testimonial.image"
                                    :alt="testimonial.name"
                                    class="author-image"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="controls">
            <button class="control-btn" @click="prevSlide">
                <font-awesome-icon icon="chevron-left" />
            </button>

            <div class="indicators">
                <div
                    v-for="(dot, index) in testimonials.length"
                    :key="index"
                    class="indicator"
                    :class="{ active: currentIndex === index }"
                    @click="goToSlide(index)"
                ></div>
            </div>

            <button class="control-btn" @click="nextSlide">
                <font-awesome-icon icon="chevron-right" />
            </button>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";

const currentIndex = ref(0);
const testimonials = ref([
    {
        quote: "I had an amazing experience at Danny’s Restaurant! The warm and welcoming atmosphere set the tone for a fantastic meal, and the Jollof Rice and Moi Moi were absolutely perfect. The Jollof had that rich, smoky flavor with just the right amount of spice, while the Moi Moi was soft, flavorful, and well-seasoned.",
        name: "Adekola Victor",
        image: "https://lh3.googleusercontent.com/a-/ALV-UjVt1rEOj-ZsGx6WGIIoa6SRMvY6z6gBEOUP25zoGeoDAYgTgvA=w54-h54-p-rp-mo-br100",
    },
    {
        quote: "I went with my friends to get dinner. The service was impeccable. The server went above and beyond, and she was so welcoming. The food here is packed with flavours and it comes well packaged and aesthetically pleasing. I will always return and the prices are at a good range. Worth every cents!!!",
        name: "Peace Bae",
        image: "https://lh3.googleusercontent.com/a-/ALV-UjVXa7PsDqHgFb9z7WOTnyJE9jWM_ktHI8uq2-HGeoODpJrKsoc=w54-h54-p-rp-mo-br100",
    },
    {
        quote: "The food is very authentic and well worth the money. Try the very fragrant and spicy but well seasoned jollof rice. The pastries are really nice also! These guys run out of food later in the day so be sure to visit them early after they open and get it all fresh. ",
        name: "Nikita Shmyglya",
        image: "https://lh3.googleusercontent.com/a-/ALV-UjW3ttK0J68OAItaMDz8TyfqZIoIeE7p45qmyAVKyn923PQSjZtg=w54-h54-p-rp-mo-ba2-br100",
    },
    {
        quote: "Very few restaurants get the smoky jollof flavour. Danny’s gets it and very well. Very good price and food quality. Amazing customer service. 100% recommend.",
        name: "Praisel Jegede",
        image: "https://lh3.googleusercontent.com/a-/ALV-UjWnfxLDu4eLMB85r5P7828ZJwEgmxdfn24Y4jDvodZe3BIlKBnaCw=w54-h54-p-rp-mo-br100",
    },
    {
        quote: "First time trying African food and couldn’t have picked a better place! Server was lovely, food was delicious. ❤️✨",
        name: "Shauna Willmore",
        image: "https://lh3.googleusercontent.com/a-/ALV-UjVYlB7ccDUHqCKQ9kzut9J1TvMgE4JrpDFoGKl4NuEJX4RauyI=w54-h54-p-rp-mo-ba2-br100",
    },
    {
        quote: "This restaurant is the best I have had since 2022. The Amala was superb, the jollof, the fried rice, in fact they gave us meat pie and sausage rolls, it was all too good. I will drive another 3 hours to eat there again. The service was best of the best ❤️❤️❤️❤️❤️",
        name: "Ogege Susan",
        image: "https://lh3.googleusercontent.com/a-/ALV-UjVUb11hmNKYgiuWZ5ZCyWvPobNMgSMZ1-3EMoVcK41UC2B1jf7n=w108-h108-p-rp-mo-br100",
    },
    {
        quote: "The meal was delicious.  My family enjoyed the beautifully made meal",
        name: "Oludayo Adedeji",
        title: "Senior Developer",
        image: "https://lh3.googleusercontent.com/a-/ALV-UjVK6KnW6C1_BaFi0TYgoKy4Ts03UHs0Z3HGGnmMAcT2kDDdxKjISQ=w54-h54-p-rp-mo-br100",
    },
    {
        quote: "LOVE the food and the lady running it when we went was so lovely! When we came they were having plumbing issues so we couldn't stay in to eat but it was DELICIOUS. We got dinner for 2 and paid extra for the goat. Everything was super flavourful! Nothing was too spicy for me but had a kick and was very full of flavour.",
        name: "Ann Goerz",
        image: "https://lh3.googleusercontent.com/a-/ALV-UjUoKD3qnrUlSgG-6mF4YncmsGOy5cVjqhzGlpwqFmaYcmJIqnFB4g=w54-h54-p-rp-mo-br100",
    },
    {
        quote: "Food is excellent, just like home, flavour-full  and delicious. Staff are friendly. The atmosphere need to reflect the African decor. Ample parking space.",
        name: "Segun Oriade",
        image: "https://lh3.googleusercontent.com/a-/ALV-UjUCNGvzpZPhjENsB_GtnQLOsSkSDxTUUGWRLw2hgpuz7ThBcUTdxg=w54-h54-p-rp-mo-ba5-br100",
    },
    {
        quote: "Craving jollof led me here through Google, and the Dinner for 2 (Jollof + Fried Rice) exceeded expectations! Welcoming host, amazing food, and a sparkling atmosphere. I'm on my second visit, still exploring the menu, and so far, no complaints!!!",
        name: "Ikechukwu Udonsi",
        image: "https://lh3.googleusercontent.com/a-/ALV-UjVm9CQ3xBWDoZODJlcR9uByUOPMyGaiGXniU7sa4qAVJR94F9lA=w54-h54-p-rp-mo-br100",
    },
]);

function nextSlide() {
    currentIndex.value = (currentIndex.value + 1) % testimonials.value.length;
}

function prevSlide() {
    currentIndex.value =
        (currentIndex.value - 1 + testimonials.value.length) %
        testimonials.value.length;
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
/* * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
}

body {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    padding: 20px;
} */
.container {
    backdrop-filter: blur(13px) saturate(150%);
    -webkit-backdrop-filter: blur(13px) saturate(150%);
    background-color: rgba(251, 251, 251, 0);
    border-radius: 12px;
    border: 1px solid rgba(255, 255, 255, 0.125);
}

.header {
    text-align: center;
    margin-bottom: 40px;
}

.carousel-container {
    position: relative;
    max-width: 700px;
    margin: 0 auto;
    overflow: hidden;
}

.carousel {
    display: flex;
    transition: transform 0.5s ease-in-out;
}

.slide {
    min-width: 100%;
    padding: 10px;
}

.testimonial-card {
    position: relative;
    border-radius: 16px;
    background: white;
    
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
    color: #34495e;
    margin-bottom: 30px;
    font-style: italic;
}

.testimonial-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 20px;
    border-top: 1px solid #f0f4f8;
}

.author-info {
    display: flex;
    flex-direction: column;
}

.author-name {
    color: #2c3e50;
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
    margin-top: 20px;
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
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: #d1d8e0;
    cursor: pointer;
    transition: all 0.3s ease;
}

.indicator.active {
    background: #4a6cf7;
    transform: scale(1.2);
}

@media (max-width: 768px) {
    .testimonial-card {
        padding: 30px 20px;
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

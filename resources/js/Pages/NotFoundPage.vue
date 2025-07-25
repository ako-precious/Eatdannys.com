<template>
    <div class="body relative">
        <div
            id="wrap "
            class="container flex min-h-screen gap-8 justify-center items-center"
        >
            <div id="wordsearch">
                <ul>
                    <li>k</li>

                    <li>v</li>

                    <li>n</li>

                    <li>z</li>

                    <li>i</li>

                    <li>x</li>

                    <li>m</li>

                    <li>e</li>

                    <li>t</li>

                    <li>a</li>

                    <li>x</li>

                    <li>l</li>

                    <li class="bg-oynx! one">4</li>

                    <li class="bg-oynx! two">0</li>

                    <li class="bg-oynx! three">4</li>

                    <li>y</li>

                    <li>y</li>

                    <li>w</li>

                    <li>v</li>

                    <li>b</li>

                    <li>o</li>

                    <li>q</li>

                    <li>d</li>

                    <li>y</li>

                    <li>p</li>

                    <li>a</li>

                    <li class="bg-oynx! four">p</li>

                    <li class="bg-oynx! five">a</li>

                    <li class="bg-oynx! six">g</li>

                    <li class="bg-oynx! seven">e</li>

                    <li>v</li>

                    <li>j</li>

                    <li>a</li>

                    <li class="bg-oynx! eight">n</li>

                    <li class="bg-oynx! nine">o</li>

                    <li class="bg-oynx! ten">t</li>

                    <li>s</li>

                    <li>c</li>

                    <li>e</li>

                    <li>w</li>

                    <li>v</li>

                    <li>x</li>

                    <li>e</li>

                    <li>p</li>

                    <li>c</li>

                    <li>f</li>

                    <li>h</li>

                    <li>q</li>

                    <li>e</li>

                    <li class="bg-oynx! eleven">f</li>

                    <li class="bg-oynx! twelve">o</li>

                    <li class="bg-oynx! thirteen">u</li>

                    <li class="bg-oynx! fourteen">n</li>

                    <li class="bg-oynx! fifteen">d</li>

                    <li>s</li>

                    <li>w</li>

                    <li>q</li>

                    <li>v</li>

                    <li>o</li>

                    <li>s</li>

                    <li>m</li>

                    <li>v</li>

                    <li>f</li>

                    <li>u</li>
                </ul>
            </div>

            <div id="main-content">
                <h1>We couldn't find what you were looking for.</h1>

                <p>
                    Unfortunately the page you were looking for could not be
                    found. It may be temporarily unavailable, moved or no longer
                    exist.
                </p>

                <p>Check the URL you entered for any mistakes and try again.</p>

                <div id="navigation">
                    <a class="navigation" href="">Home</a
                    ><a class="navigation" href="">About Us</a>
                    <a class="navigation" href="">Site Map</a>
                    <a class="navigation" href="">Contact</a>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
@import url(https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300);

.body {
    background: -ms-radial-gradient(ellipse at center, #00A6ED 0%, #2c3e50 100%)
        fixed no-repeat;
    background: -moz-radial-gradient(
            ellipse at center,
            #00A6ED 0%,
            #2c3e50 100%
        )
        fixed no-repeat;
    background: -o-radial-gradient(ellipse at center, #00A6ED 0%, #2c3e50 100%)
        fixed no-repeat;
    background: -webkit-gradient(
        radial,
        center center,
        0,
        center center,
        497,
        color-stop(0, #00A6ED),
        color-stop(1, #2c3e50)
    );
    background: -webkit-radial-gradient(
            ellipse at center,
            #00A6ED 0%,
            #2c3e50 100%
        )
        fixed no-repeat;
    background: radial-gradient(ellipse at center, #00A6ED 0%, #2c3e50 100%)
        fixed no-repeat;
    font-family: "Source Sans Pro", sans-serif;
    -webkit-font-smoothing: antialiased;
    margin: 0px;
}

::selection {
    background-color: rgba(0, 0, 0, 0.2);
}

::-moz-selection {
    background-color: rgba(0, 0, 0, 0.2);
}

a {
    color: white;
    text-decoration: none;
    border-bottom: 1px solid rgba(255, 255, 255, 0.5);
    transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    -webkit-transition: all 0.5s ease;
    margin-right: 10px;
}

a:last-child {
    margin-right: 0px;
}

a:hover {
    text-shadow: 0px 0px 1px rgba(255, 255, 255, 0.5);
    border-bottom: 1px solid rgba(255, 255, 255, 1);
}

#noscript-warning {
    width: 100%;
    text-align: center;
    background-color: rgba(0, 0, 0, 0.2);
    font-weight: 300;
    color: white;
    padding-top: 10px;
    padding-bottom: 10px;
}

/* === WRAP === */

#wrap {
    width: 80%;
    max-width: 1400px;
    margin: 0 auto;
    height: auto;
    position: relative;
    margin-top: 8%;
}

/* === MAIN TEXT CONTENT === */

#main-content {
    float: right;
    max-width: 45%;
    color: white;
    font-weight: 300;
    font-size: 18px;
    padding-bottom: 40px;
    line-height: 28px;
}

#main-content h1 {
    margin: 0px;
    font-weight: 400;
    font-size: 42px;
    margin-bottom: 40px;
    line-height: normal;
}

/* === NAVIGATION BUTTONS === */

#navigation {
    margin-top: 2%;
}

#navigation a.navigation {
    display: block;
    float: left;
    background-color: rgba(0, 0, 0, 0.2);
    padding-left: 15px;
    padding-right: 15px;
    color: white;
    height: 41px;
    line-height: 41px;
    text-decoration: none;
    font-size: 16px;
    transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    -webkit-transition: all 0.5s ease;
    margin-right: 2%;
    margin-bottom: 2%;
    border-bottom: none;
}

#navigation a.navigation i {
    line-height: 41px;
}

#navigation a.navigation:hover {
    background-color: rgba(26, 188, 156, 0.7);
    border-bottom: none;
}

/* === WORDSEARCH === */

#wordsearch {
    width: 45%;
    float: left;
}

#wordsearch ul {
    margin: 0px;
    padding: 0px;
}

#wordsearch ul li {
    float: left;
    width: 12%;
    background-color: rgba(0, 0, 0, 0.2);
    list-style: none;
    margin-right: 0.5%;
    margin-bottom: 0.5%;
    padding: 15px;
    display: block;
    text-align: center;
    color: rgba(255, 255, 255, 0.7);
    text-transform: uppercase;
    overflow: hidden;
    font-size: 40px;
    font-size: 1.6vw;
    font-weight: 300;
    transition: background-color 0.75s ease;
    -moz-transition: background-color 0.75s ease;
    -webkit-transition: background-color 0.75s ease;
    -o-transition: background-color 0.75s ease;
}

/* === RESPONSIVE CSS === */

@media all and (max-width: 899px) {
    #wrap {
        width: 90%;
    }
}

@media all and (max-width: 799px) {
    #wrap {
        width: 90%;
        height: auto;
        margin-top: 40px;
        top: 0%;
    }
    #wordsearch {
        width: 90%;
        float: none;
        margin: 0 auto;
    }
    #wordsearch ul li {
        font-size: 4vw;
    }
    #main-content {
        float: none;
        width: 90%;
        max-width: 90%;
        margin: 0 auto;
        margin-top: 30px;
        text-align: justify;
    }
    #main-content h1 {
        text-align: left;
    }
    #search input[type="text"] {
        width: 84%;
    }
    #search .input-search {
        width: 15%;
    }
}

@media all and (max-width: 499px) {
    #main-content h1 {
        font-size: 28px;
    }
}
</style>
<script>
export default {
    data() {
        return {
            letters: [
                "k",
                "v",
                "n",
                "z",
                "i",
                "x",
                "m",
                "e",
                "t",
                "a",
                "x",
                "l",
                "4",
                "0",
                "4",
                "y",
                "y",
                "w",
                "v",
                "b",
                "o",
                "q",
                "d",
                "y",
                "p",
                "a",
                "p",
                "a",
                "g",
                "e",
                "v",
                "j",
                "a",
                "n",
                "o",
                "t",
                "s",
                "c",
                "e",
                "w",
                "v",
                "x",
                "e",
                "p",
                "c",
                "f",
                "h",
                "q",
                "e",
                "f",
                "o",
                "u",
                "n",
                "d",
                "s",
                "w",
                "q",
                "v",
                "o",
                "s",
                "m",
                "v",
                "f",
                "u",
            ],
            selectedLetters: [],
            letterRefs: [],
        };
    },
    mounted() {
        this.setDimensions();
        this.startAnimation();
        window.addEventListener("resize", this.handleResize);
    },
    beforeUnmount() {
        window.removeEventListener("resize", this.handleResize);
    },
    methods: {
        // Set initial dimensions
        setDimensions() {
            this.$nextTick(() => {
                if (this.letterRefs.length > 0) {
                    const width = getComputedStyle(this.letterRefs[0]).width;

                    // Set dimensions for all letters
                    this.letterRefs.forEach((li) => {
                        li.style.height = width;
                        li.style.lineHeight = width;
                    });

                    // Set container height
                    if (this.$refs.wordsearch) {
                        this.$refs.wordsearch.style.height = getComputedStyle(
                            this.$refs.wordsearch
                        ).width;
                    }
                }
            });
        },

        // Handle window resize
        handleResize() {
            this.setDimensions();

            // Force repaint (original functionality)
            ["h1", "h2", "h3", "p"].forEach((selector) => {
                document.querySelectorAll(selector).forEach((el) => {
                    el.style.zIndex = 1;
                });
            });
        },

        // Animation sequence
        startAnimation() {
            const letterIndexes = [
                12, 13, 14, 26, 27, 28, 29, 33, 34, 35, 50, 51, 52, 53, 54,
            ];

            letterIndexes.forEach((idx, i) => {
                setTimeout(() => {
                    this.selectedLetters.push(idx);
                }, 1500 + i * 500);
            });
        },

        // Dynamic class helper
        getLetterClass(index) {
            return {
                selected: this.selectedLetters.includes(index),
                one: index === 12,
                two: index === 13,
                // ... other classes as needed
            };
        },
    },
};
</script>

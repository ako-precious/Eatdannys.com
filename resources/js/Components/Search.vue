<style scoped>
/* From uiverse.io by @satyamchaudharydev */
/* removing default style of button */

.form button {
    border: none;
    background: none;
    color: #8b8ba7;
}
/* styling of whole input container */
.form {
    --timing: 0.3s;

    --height-of-input: 52px;
    --border-height: 2px;
    --input-bg: #FFFCF9;
    --border-color: #00a6ed;
    --border-radius: 30px;
    --after-border-radius: 1px;
    position: relative;
    height: var(--height-of-input);
    display: flex;
    align-items: center;
    padding-inline: 0.8em;
    border-radius: var(--border-radius);
    transition: border-radius 0.5s ease;
    background: var(--input-bg, #fff);
}
/* styling of Input */
.input {
    font-size: 0.9rem;
    background-color: transparent;
    --tw-ring-offset-shadow:0;
    width: 100%;
    height: 100%;
    padding-inline: 0.5em;
    padding-block: 0.7em;
    border: none;
}
/* styling of animated border */
.form:before {
    content: "";
    position: absolute;
    background: var(--border-color);
    transform: scaleX(0);
    transform-origin: center;
    width: 100%;
    height: var(--border-height);
    left: 0;
    bottom: 0;
    border-radius: 1px;
    transition: transform var(--timing) ease;
}
/* Hover on Input */
.form:focus-within {
    border-radius: var(--after-border-radius);
}

input:focus {
    outline: none;
}
/* here is code of animated border */
.form:focus-within:before {
    transform: scale(1);
}
/* styling of close button */
/* == you can click the close button to remove text == */
.reset {
    border: none;
    background: none;
    opacity: 0;
    visibility: hidden;
}
/* close button shown when typing */
input:not(:placeholder-shown) ~ .reset {
    opacity: 1;
    visibility: visible;
}
/* sizing svg icons */
.form svg {
    width: 17px;
    margin-top: 3px;
}
</style>

<template>
    <form class="form bg-gray-500">
        <button>
            <font-awesome-icon
                class="text-oynx font-black text-xl"
                icon="fa-solid fa-magnifying-glass"
            />
        </button>
        <input
            class="input text-oynx ring-0 w-85/100 lg:w-65/100 outline-none ring-offset-0 ring-shado "
            v-model="query"
            @input="onInput"
            placeholder="Search ..."
            required
            type="text"
        />
        <button class="reset" type="reset">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M6 18L18 6M6 6l12 12"
                ></path>
            </svg>
        </button>
    </form>
</template>
<script>
export default {
    data() {
        return {
            query: "",
        };
    },
    methods: {
        onInput() {
            this.$emit("search", this.query);
        },
    },
};
</script>

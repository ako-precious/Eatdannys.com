<!-- <template>
  <form @submit.prevent="submitFilterForm">
    <div class="flex items-center justify-center py-5 w-full lg:p-0  text-oynx dark:text-snow">
       
        <div class="relative pr-3 ">
            <input 
                placeholder="Search for food"
                class=" -shadow-snow-sm  dark:-shadow-oynx-sm focus:shadow-snow-inner focus:dark:shadow-oynx-inner bg-transparent border-none sm:w-[15rem] md:w-[20rem] lg:w-[25rem]  2xl:max-w-2xl text-oynx dark:text-white  rounded-full py-3 px-5 outline-none   dark:border-snow focus:border-polynesian dark:focus:border-lighred focus:ring-polynesian dark:focus:ring-lighred transition-all ease-in duration-250 delay-75"
                v-model="searchText"
                
                type="text"/>
        </div>

          <button class="button bg-gradient-to-br from-[#e3dedf] to-[#ffffff] -shadow-snow-sm hover:shadow-snow-sm dark:bg-gradient-to-br dark:from-[#2b312e] dark:to-[#333a37]  dark:-shadow-oynx-sm hover:dark:shadow-oynx-sm text-lg hover:text-polynesian hover:dark:text-lighred">
            <font-awesome-icon :icon="['fas', 'search']" class="svgIcon "/>
          </button>
    </div></form>
</template> -->
<template>
  <div class="input-container">
    <input
      class="input"
      name="text"
      type="text"
      placeholder="Search the internet..."
    />
  </div>
</template>

<script>
export default {
  data() {
    return {
      searchText: "",
    };
  },
  methods: {
    submitFilterForm() {
      this.$emit("filter-meals", this.searchText);
    },
  },
};
</script>

<style scoped>
  .input {
    width: 100%;
    max-width: 270px;
    height: 60px;
    padding: 12px;
    font-size: 18px;
    font-family: "Courier New", monospace;
    color: #000;
    background-color: #fff;
    border: 4px solid #000;
    border-radius: 0;
    outline: none;
    transition: all 0.3s ease;
    box-shadow: 8px 8px 0 #000;
  }

  .input::placeholder {
    color: #888;
  }

  .input:hover {
    transform: translate(-4px, -4px);
    box-shadow: 12px 12px 0 #000;
  }

  .input:focus {
    background-color: #000;
    color: #fff;
    border-color: #ffffff;
  }

  .input:focus::placeholder {
    color: #fff;
  }

  @keyframes typing {
    from {
      width: 0;
    }
    to {
      width: 100%;
    }
  }

  @keyframes blink {
    50% {
      border-color: transparent;
    }
  }

  .input:focus::after {
    content: "|";
    position: absolute;
    right: 10px;
    animation: blink 0.7s step-end infinite;
  }

  .input:valid {
    animation: typing 2s steps(30, end);
  }
  .input-container {
    position: relative;
    width: 100%;
    max-width: 270px;
  }

  .input {
    width: 100%;
    height: 60px;
    padding: 12px;
    font-size: 18px;
    font-family: "Courier New", monospace;
    color: #000;
    background-color: #fff;
    border: 4px solid #000;
    border-radius: 0;
    outline: none;
    transition: all 0.3s ease;
    box-shadow: 8px 8px 0 #000;
  }

  .input::placeholder {
    color: #888;
  }

  .input:hover {
    transform: translate(-4px, -4px);
    box-shadow: 12px 12px 0 #000;
  }

  .input:focus {
    background-color: #010101;
    color: #fff;
    border-color: #d6d9dd;
  }

  .input:focus::placeholder {
    color: #fff;
  }

  @keyframes shake {
    0% {
      transform: translateX(0);
    }
    25% {
      transform: translateX(-5px) rotate(-5deg);
    }
    50% {
      transform: translateX(5px) rotate(5deg);
    }
    75% {
      transform: translateX(-5px) rotate(-5deg);
    }
    100% {
      transform: translateX(0);
    }
  }

  .input:focus {
    animation: shake 0.5s ease-in-out;
  }

  @keyframes glitch {
    0% {
      transform: none;
      opacity: 1;
    }
    7% {
      transform: skew(-0.5deg, -0.9deg);
      opacity: 0.75;
    }
    10% {
      transform: none;
      opacity: 1;
    }
    27% {
      transform: none;
      opacity: 1;
    }
    30% {
      transform: skew(0.8deg, -0.1deg);
      opacity: 0.75;
    }
    35% {
      transform: none;
      opacity: 1;
    }
    52% {
      transform: none;
      opacity: 1;
    }
    55% {
      transform: skew(-1deg, 0.2deg);
      opacity: 0.75;
    }
    50% {
      transform: none;
      opacity: 1;
    }
    72% {
      transform: none;
      opacity: 1;
    }
    75% {
      transform: skew(0.4deg, 1deg);
      opacity: 0.75;
    }
    80% {
      transform: none;
      opacity: 1;
    }
    100% {
      transform: none;
      opacity: 1;
    }
  }

  .input:not(:placeholder-shown) {
    animation: glitch 1s linear infinite;
  }

  .input-container::after {
    content: "|";
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    color: #000;
    animation: blink 0.7s step-end infinite;
  }

  @keyframes blink {
    50% {
      opacity: 0;
    }
  }

  .input:focus + .input-container::after {
    color: #fff;
  }

  .input:not(:placeholder-shown) {
    font-weight: bold;
    letter-spacing: 1px;
    text-shadow: 0px 0px 0 #000;
  }
</style>


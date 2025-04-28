<template>
 
</template>

<script>
export default {
  data() {
    return {
      searchText: "",
    };
  },
  methods: {
  
  },
};
</script>

<style scoped>
/* Add Tailwind CSS styles here or in your global styles */


.button {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  border: none;
  font-weight: 600;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition-duration: 0.3s;
  overflow: hidden;
  position: relative;
}

.svgIcon {
  width: 12px;
  transition-duration: 0.3s;
}


.button:hover {
  width: 110px;
  border-radius: 50px;
  transition-duration: 0.3s;

  background-color: rgb(181, 160, 255);
  align-items: center;
}

.button:hover .svgIcon {
  /* width: 20px; */
  transition-duration: 0.3s;
  transform: translateX(320%);
}

.button::before {
  position: absolute;
  bottom: -20px;
  content: "Search";
  /* transition-duration: .3s; */
  font-size: 0px;
}

.button:hover::before {
  font-size: 13px;
  opacity: 1;
  bottom: unset;
  /* transform: translateY(-30px); */
  transition-duration: 0.3s;
}

</style>

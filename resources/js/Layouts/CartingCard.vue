<style scoped>
  .card {
    
    background: rgb(103, 225, 255);
    transition: all 1s;
    border-radius: 10px;
    box-shadow: 0px 0px 10px 5px  rgba(0, 0, 0, 0.705);
    font-size: 30px;
    font-weight: 900;
  }

  .card:hover {
    border-radius: 15px;
    cursor: pointer;
    transform: scale(1.1);
    animation-delay: 3s;
    box-shadow: 0px 0px 10px 5px  rgba(0, 0, 0, 0.705);
    background: rgb(103, 151, 255);
  }

  .first-content {
    height: 100%;
    width: 100%;
    transition: all 1s;
    display: flex;
    justify-content: center;
    align-items: center;
    opacity: 1;
    border-radius: 15px;
  }

  .card:hover .first-content {
    height: 0px;
    opacity: 0;
  }

  .second-content {
    height: 0%;
    width: 100%;
    opacity: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 15px;
    transition: all 1s;
    font-size: 0px;
    transform: rotate(90deg) scale(-1);
  }

  .card:hover .second-content {
    opacity: 1;
    height: 100%;
    font-size: 1.8rem;
    transform: rotate(0deg);
  }
</style>

<template>
  <div class="card min-h-[90vh] min-w-[50vw]">
    <div class="first-content">
      <span>First</span>
    </div>
    <div class="second-content">
  <span>Second</span>
    </div>


  </div>
</template>

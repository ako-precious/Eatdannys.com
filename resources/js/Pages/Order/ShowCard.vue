<style scoped>
  .card-title {
    color: #262626;
    font-size: 2em;
    line-height: normal;
  }

  .go-corner {
    display: flex;
    align-items: center;
    justify-content: center;
    position: absolute;
    width: 4em;
    height: 4em;
    overflow: hidden;
    top: 0;
    right: 0;
    background: linear-gradient(135deg,  #00A6ED, #00A6Ec);
    border-radius: 0 4px 0 60px;
  }

  .go-arrow {
    margin-top: -4px;
    margin-right: -4px;
    color: white;
    font-family: courier, sans;
  }

  .card {
    display: block;
    position: relative;    
    background-color: #FFFCF9;
    border-radius: 10px;
    padding: 2em ;
    text-decoration: none;
    z-index: 0;
    overflow: hidden;
    background: linear-gradient(to bottom, #c3e6ec, #FFFCF9);
    font-family: Arial, Helvetica, sans-serif;
  }

  .card:before {
    content: '';
    position: absolute;
    z-index: -1;
    top: -16px;
    right: -16px;
    background: linear-gradient(135deg, #00A6ED, #00A6Ec);
    height: 72px;
    width: 72px;
    border-radius: 72px;
    transform: scale(1);
    transform-origin: 50% 50%;
    transition: transform 0.35s ease-out;
  }

  .card:hover:before {
    transform: scale(45);
  }

  .card:hover .small-desc {
    transition: all 0.5s ease-out;
    color: rgba(255, 255, 255, 0.8);
  }

  .card:hover .card-title {
    transition: all 0.5s ease-out;
    color: #ffffff;
  }
</style>

<template>
  <div class="card max-w-2xl m-auto shadow-2xl p-4">
        <p class="card-title">Orders Detail</p>
        <div class="flex flex-col">

            <p class="small-desc font-bold text-lg ">
             Order ID
            </p>
            <p class="small-desc text-base">
             {{ order.session_id }}
            </p>
        </div>
        <div class="flex flex-wrap justify-between">
        <div class="flex flex-col">

            <p class="small-desc font-bold text-lg ">
             Customer's Email 
            </p>
            <p class="small-desc text-base">
             {{ order.user.email }}
            </p>
        </div>
        <div class="flex flex-col">

            <p class="small-desc font-bold text-lg ">
             Customers Name 
            </p>
            <p class="small-desc text-base">
             {{ order.user.email }}
            </p>
        </div>
        </div>
        <div class="flex flex-col">

            <p class="small-desc font-bold text-lg ">
             Items 
            </p>
            <div >
                 <p class="small-desc text-base flex justify-between font-bold"  >
            <span> Name</span>  <span> Unit Price</span> <span>Quantity</span>
            </p>
                 <p class="small-desc text-base flex justify-between"  v-for="items in order.menu" :key="order.id">
            <span> {{ items.name }}  </span>  <span> ${{ items.unit_price }}</span> <span> {{ items.quantity }}</span>
            </p>
            </div>
           
        </div>
        <div class="flex flex-wrap justify-between">
            <div class="flex flex-col">
    
               <p class="small-desc font-bold text-lg ">
                Total Price
               </p>
               <p class="small-desc text-base">
               $ {{ order.total_price }}
               </p>
           </div>
            <div class="flex flex-col">
    
               <p class="small-desc font-bold text-lg ">
                Payment Status
               </p>
               <p class="small-desc text-base">
                {{ order.status }}
               </p>
           </div>

        </div>
        <div class="go-corner">
          <div class="go-arrow "></div>
        </div>
      </div>
</template>

<script>

export default {
   
  

    props: {

    user: {
      type: Object,
      required: true
    },
    order: {
      type: Object,
      required: true
    }
  },
};
</script>
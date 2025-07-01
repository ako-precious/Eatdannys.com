<template>


<main class="main container py-8 bg-snow">
  <h1 class='text-right text-xl md:text-3xl '>CSS Grid - Photo Gallery</h1>

  <div class="gallery">
    <figure>
        <img src="images/Screenshot (73).png" alt="Lorem ipsum dolor sit amet">
        
    </figure>
    
    <figure>
        <img src="images/Screenshot (55).png" alt="Lorem ipsum dolor sit amet">
        
    </figure>
    
    <figure>
        <img src="images/Screenshot (74).png" alt="Lorem ipsum dolor sit amet">
        
    </figure>
    
    <figure>
        <img src="images/Screenshot (38).png" alt="Lorem ipsum dolor sit amet">
    </figure>
    
    <figure>
        <img src="images/Screenshot (39).png" alt="Lorem ipsum dolor sit amet">
        
        
    </figure>
    
    <figure>
        <img src="images/Screenshot (50).png" alt="Lorem ipsum dolor sit amet">
        <!-- <img src="https://images.unsplash.com/photo-1487017159836-4e23ece2e4cf" alt="Lorem ipsum dolor sit amet"> -->
        
    </figure>
    
    <figure>
        <img src="images/Screenshot (64).png" alt="Lorem ipsum dolor sit amet">
        
    </figure>
    
    <figure>
        <img src="images/Screenshot (40).png" alt="Lorem ipsum dolor sit amet">
        
    </figure>
    
    <figure>
        <img src="images/Screenshot (37).png" alt="Lorem ipsum dolor sit amet">
        
    </figure>
    
    <figure>
        <img src="images/Screenshot (42).png" alt="Lorem ipsum dolor sit amet">
        
    </figure>
    
    <figure>
        <img src="images/Screenshot (51).png" alt="Lorem ipsum dolor sit amet">
      
    </figure>

    <figure>
      <img src="https://images.unsplash.com/photo-1472396961693-142e6e269027" alt="Lorem ipsum dolor sit amet">
      
    </figure>

    <figure>
      <img src="https://images.unsplash.com/photo-1500375592092-40eb2168fd21" alt="Lorem ipsum dolor sit amet">
      
    </figure>

    <figure>
      <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb" alt="Lorem ipsum dolor sit amet">
      
    </figure>

    <figure>
      <img src="https://images.unsplash.com/photo-1487017159836-4e23ece2e4cf" alt="Lorem ipsum dolor sit amet">
      
    </figure>

    <figure>
      <img src="https://images.unsplash.com/photo-1532103054090-3491f1a05d0d" alt="Lorem ipsum dolor sit amet">
      
    </figure>

    <figure>
      <img src="https://images.unsplash.com/photo-1599033153041-e88627ca70bb" alt="Lorem ipsum dolor sit amet">
      
    </figure>

    <figure>
      <img src="https://images.unsplash.com/photo-1494475673543-6a6a27143fc8" alt="Lorem ipsum dolor sit amet">
      
    </figure>

    <figure>
      <img src="https://images.unsplash.com/photo-1528988719300-046ff7faf8cb" alt="Lorem ipsum dolor sit amet">
      
    </figure>

    <figure>
      <img src="https://images.unsplash.com/photo-1466970601638-4e5fb6556584" alt="Lorem ipsum dolor sit amet">
      
    </figure>
  </div>
</main>
</template>

<style scope>


img {
  max-inline-size: 100%;
}

.sidebar {
  grid-column: sidebar;
  color: #fff;
  background-color: #1d1d29;
}

.logo {
  display: flex;
  justify-content: center;
  font-size: 3rem;
  line-height: 1.5;
}

.main {
  grid-column: main;
  padding: 1.25rem;
}

/* Photo Gallery */
.gallery {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(12.5rem, 1fr));
  grid-auto-rows: 12.5rem;
  grid-auto-flow: dense;
  gap: 0.75rem;
}

.gallery figure {
  /* container-type: inline-size; */
  container: figure / inline-size;
  overflow: hidden;

  display: grid;
  /* grid-template-columns: 1fr; */
  /* grid-template-rows: 1fr; */

  /*
    Because 1fr = minmax(auto, 1fr),
    to prevent the grid blowout,
    set the minimum to zero.
  */
  grid-template-columns: minmax(0, 1fr);
  grid-template-rows: minmax(0, 1fr);
}

.gallery img {
  inline-size: 100%;
  block-size: 100%;
  object-fit: cover;

  /* grid-row: 1 / -1; */
  /* grid-column: 1 / -1; */
  grid-area: 1 / 1 / -1 / -1;

  transition: scale 1s ease-in-out;
}

.gallery figure:hover img {
  scale: 1.125;
}

.gallery figcaption {
  grid-area: 1 / 1 / -1 / -1;
  align-self: end;
  z-index: 1;

  padding: 3em 15% 1em 1em;
  color: #fff;
  font-size: 0.875rem;
  line-height: 1.3;
  background: linear-gradient(transparent 25%, rgb(0 0 0 / 0.75));
  display: none;
}

@container figure (width > 20rem) {
  .gallery figcaption {
    display: block;
  }
}

.gallery figcaption h3 {
  font-size: 1.0625rem;
}

.gallery figcaption p {
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
}

@media (width > 600px) {
  .gallery figure:nth-child(1) {
    grid-area: span 2 / span 2;
  }

  .gallery figure:nth-child(4n + 1) {
    grid-row: span 2;
  }

  .gallery figure:nth-child(4n + 2) {
    grid-column: span 2;
  }
}

</style>
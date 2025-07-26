<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
              <link rel="icon" href="/images/logo.png" type="image/png">
    <link rel="apple-touch-icon" href="/images/logo-2.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/logo.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/logo.png">
   
        <!-- Scripts -->
       
   <style>
    @import url(https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300);

body {
	background-color: #00A6ED;
	background: -ms-radial-gradient(ellipse at center,  #00A6ED 0%, #2C3E50 100%) fixed no-repeat;
	background: -moz-radial-gradient(ellipse at center,  #00A6ED 0%, #2C3E50 100%) fixed no-repeat;
	background: -o-radial-gradient(ellipse at center, #00A6ED 0%, #2C3E50 100%) fixed no-repeat;
	background: -webkit-gradient(radial, center center, 0, center center, 497, color-stop(0, #00A6ED), color-stop(1, #2C3E50));
	background: -webkit-radial-gradient(ellipse at center,  #00A6ED 0%, #2C3E50 100%) fixed no-repeat;
	background: radial-gradient(ellipse at center, #00A6ED 0%, #2C3E50 100%) fixed no-repeat;
	font-family: 'Source Sans Pro', sans-serif;
	-webkit-font-smoothing: antialiased;
	margin: 0px;
}

::selection {
	background-color: rgba(0,0,0,0.2);
}

::-moz-selection {
	background-color: rgba(0,0,0,0.2);
}
	

a {
	color: white;
	text-decoration: none;
	border-bottom: 1px solid rgba(255,255,255,0.5);
	transition: all 0.5s ease;
	-moz-transition: all 0.5s ease;
	-o-transition: all 0.5s ease;
	-webkit-transition: all 0.5s ease;
	margin-right: 10px;
}

a:last-child { margin-right: 0px; }

a:hover {
	text-shadow: 0px 0px 1px rgba(255,255,255,.5);
	border-bottom: 1px solid rgba(255,255,255,1);
}

#noscript-warning {
	width: 100%;
	text-align: center;
	background-color: rgba(0,0,0,0.2);
	font-weight: 300;
	color: white;
	padding-top: 10px;
	padding-bottom: 10px;
}



/* === WRAP === */

#wrap {
	width: 85%;
	max-width: 1400px;
	margin:0 auto;
    display: flex;
    flex-wrap: wrap 
	height: auto;
	position: relative;
	margin-top: 8%;
}



/* === MAIN TEXT CONTENT === */

#main-content {
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

#navigation { margin-top: 2%; display: flex; }

#navigation a.navigation {
	display: block;
	background-color: rgba(0,0,0,0.2);
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

#navigation a.navigation i { line-height: 41px; }

#navigation a.navigation:hover {
	background-color: #00A6ED;
	border-bottom: none;
}



/* === WORDSEARCH === */

#wordsearch {
	width: 50%;
	float: left;
}

#wordsearch ul {
	margin: 0px;
	padding: 0px;
}

#wordsearch ul li {
	float: left;
	width: 12%;
	background-color: rgba(0,0,0,.2);
	list-style: none;
	margin-right: 1%;
	margin-bottom: 1%;
    padding: 5px;
    display: block;
    text-align: center;
    color: rgba(255,255,255,0.7);
    text-transform: uppercase;
    overflow: hidden;
    font-size: 30px;
    font-size: 1.8vw;
    font-weight: 300;
    transition: background-color 0.75s ease;
    -moz-transition: background-color 0.75s ease;
    -webkit-transition: background-color 0.75s ease;
    -o-transition: background-color 0.75s ease;
}

#wordsearch ul li.selected {
	background-color: #221E22;
	color: rgba(255,255,255,1);
	font-weight: 400;
}






/* === RESPONSIVE CSS === */

@media all and (max-width: 899px) {
	#wrap { width: 90%; }
}

@media all and (max-width: 799px) {
	#wrap { width: 90%; height: auto; margin-top: 40px; top: 0%; }
	#wordsearch { width: 90%; float: none; margin:0 auto; }
	#wordsearch ul li { font-size: 4vw; }
	#main-content { float: none; width: 90%; max-width: 90%; margin:0 auto; margin-top: 30px; text-align: justify; }
	#main-content h1 { text-align: left; }
	#search input[type='text'] { width: 84%; }
	#search .input-search { width: 15%; }
}

@media all and (max-width: 499px) {
	#main-content h1 { font-size: 28px; }
}
   </style>
    </head>
    <body class="font-sans antialiased">
     
  <div id="wrap">
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

        <li class= " selected bg-polynesian! one">4</li>

        <li class= " selected bg-polynesian! two">0</li>

        <li class= " selected bg-polynesian! three">4</li>

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

        <li class= " selected bg-polynesian! four">p</li>

        <li class= " selected bg-polynesian! five">a</li>

        <li class= " selected bg-polynesian! six">g</li>

        <li class= " selected bg-polynesian! seven">e</li>

        <li>v</li>

        <li>j</li>

        <li>a</li>

        <li class= " selected bg-polynesian! eight">n</li>

        <li class= " selected bg-polynesian! nine">o</li>

        <li class= " selected bg-polynesian! ten">t</li>

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

        <li class= " selected bg-polynesian! eleven">f</li>

        <li class= " selected bg-polynesian! twelve">o</li>

        <li class= " selected bg-polynesian! thirteen">u</li>

        <li class= " selected bg-polynesian! fourteen">n</li>

        <li class= " selected bg-polynesian! fifteen">d</li>

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

      <p>Unfortunately the page you were looking for could not be found. It may be
      temporarily unavailable, moved or no longer exist.</p>

      <p>Check the URL you entered for any mistakes and try again.</p>


      <div id="navigation">
        <a class="navigation" href="">Home</a><a class="navigation" href="">About
        Us</a>
        <a class="navigation" href="">Site Map</a>
        <a class="navigation" href=
        "">Contact</a>
      </div>
    </div>
  </div>
     
    </body>
   </html>
   <script>
    function backToTop() {
      window.scrollTo({
        top: 0,
        behavior: 'smooth' // This provides a smooth scrolling effect
      });
    }
    </script>
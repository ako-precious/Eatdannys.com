<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Google+Sans+Code:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    <link rel="icon" href="/images/logo.png" type="image/png">
    <link rel="apple-touch-icon" href="/images/logo-2.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/logo.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/logo.png">

    <style>
      body {
  font-family: "Google Sans Code", monospace;
}
    </style>

    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>

<body class="antialiased">
    @inertia

    <div class="fixed bottom-0 right-0 p-4  z-[400] ">
        <button class="bg-snow text-oynx rounded-full w-10 h-10 flex items-center cursor-pointer justify-center"
            onclick="backToTop()">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18">
                </path>
            </svg>
        </button>
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

<template>
   <div class="bg-snow">
       <div
            class="px-4 pt-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 "
        >
            <div class="grid gap-10 row-gap-6 mb-8 sm:grid-cols-2 lg:grid-cols-4">
                <div class="sm:col-span-1">
                    <a
                        href="/"
                        aria-label="Go home"
                        title="Company"
                        class="inline-flex items-center"
                    >
                        <ApplicationMark />
                        <span
                            class="ml-2 text-xl font-bold tracking-wide text-gray-800 uppercase"
                        >
                            Dannys</span
                        >
                    </a>
                    <div class="mt-6 lg:max-w-sm">
                        <p class="text-sm text-gray-800">
                            Your go-to for incredible food, effortless events, and
                            delicious daily convenience! Specializing in Event
                            Catering, Private Chef experiences, and ready-to-eat
                            Food Boxes, Trays & Soups. Taste the expertise
                        </p>
                    </div>
                </div>
                <div class="space-y-2 text-sm">
                    <p class="text-base font-bold tracking-wide text-gray-900">
                        Menu
                    </p>
                    <div class="flex">
                        <p class="mr-1 text-gray-800">About Us</p>
                    </div>
                    <div class="flex">
                        <p class="mr-1 text-gray-800">Team</p>
                    </div>
                    <div class="flex">
                        <p class="mr-1 text-gray-800">Testimonials</p>
                    </div>
                </div>
                <div class="space-y-2 text-sm">
                    <p class="text-base font-bold tracking-wide text-gray-900">
                        Contacts
                    </p>
                    <div class="flex">
                        <p class="mr-1 text-gray-800">Phone:</p>
                        <a
                            href="tel:+17058886114"
                            aria-label="Our phone"
                            title="Our phone"
                            class="transition-colors duration-300 text-deep-purple-accent-400 hover:text-deep-purple-800"
                            >+1 (705) 888-6114</a
                        >
                    </div>
                    <div class="flex">
                        <p class="mr-1 text-gray-800">Email:</p>
                        <a
                            href="mailto:dannys20edible@gmail.com"
                            aria-label="Our email"
                            title="Our email"
                            class="transition-colors duration-300 text-deep-purple-accent-400 hover:text-deep-purple-800"
                            >dannys20edible@gmail.com</a
                        >
                    </div>
                    <div class="flex">
                        <p class="mr-1 text-gray-800">Address:</p>
                        <a
                            href="https://www.google.com/maps/place/1179+Bayfield+St+N,+Midhurst,+ON+L9X+0N5/@44.4386183,-79.7351199,17z/data=!3m1!4b1!4m6!3m5!1s0x882aa2716c15c251:0x9937db4094649aa2!8m2!3d44.4386145!4d-79.732545!16s%2Fg%2F11smbsqv3s?entry=ttu&g_ep=EgoyMDI1MDUyOC4wIKXMDSoASAFQAw%3D%3D"
                            target="_blank"
                            rel="noopener noreferrer"
                            aria-label="Our address"
                            title="Our address"
                            class="transition-colors duration-300 text-deep-purple-accent-400 hover:text-deep-purple-800"
                        >
                            1179 Bayfield Street North, Barrie. L9X 0N5
                        </a>
                    </div>
                </div>
                <div>
                    <span class="text-base font-bold tracking-wide text-gray-900"
                        >Social</span
                    >
    
                    <div class="flex items-center mt-1 space-x-3">
                        <SocialMedia />
                    </div>
                    <p class="mt-4 text-sm text-gray-500">
                        Make sure to follow us across all our
                        social media channels! You'll get instant updates and
                        perhaps even a sneak peek at behind-the-scenes moments from
                        our restaurant. 
                    </p>
                </div>
            </div>
            <div
                class="flex flex-col-reverse justify-between pt-5 pb-10 border-t lg:flex-row"
            >
                <p class="text-sm text-gray-600">
                    © Copyright {{ date }} Labi. All rights reserved.
                </p>
                <ul
                    class="flex flex-col mb-3 space-y-2 lg:mb-0 sm:space-y-0 sm:space-x-5 sm:flex-row"
                >
                    <li>
                        <a
                            href="/"
                            class="text-sm text-gray-600 transition-colors duration-300 hover:text-deep-purple-accent-400"
                            >F.A.Q</a
                        >
                    </li>
                    <li>
                        <a
                            href="/"
                            class="text-sm text-gray-600 transition-colors duration-300 hover:text-deep-purple-accent-400"
                            >Privacy Policy</a
                        >
                    </li>
                    <li>
                        <a
                            href="/"
                            class="text-sm text-gray-600 transition-colors duration-300 hover:text-deep-purple-accent-400"
                            >Terms &amp; Conditions</a
                        >
                    </li>
                </ul>
            </div>
        </div>

   </div> 
</template>
<script setup>
import SocialMedia from "@/Components/SocialMedia.vue";
import ApplicationMark from "@/Components/ApplicationMark.vue";
</script>
<script>
export default {
    data() {
        return {
            date: new Date().getFullYear(),
        };
    },
};
</script>

<!-- <script setup>
import DashboardSidebar from "@/Components//Sidebars/DashboardSidebar.vue" ;
import DashboardHeader from "@/Components//Headers/DashboardHeader.vue" ;
import DashboardFooter from "@/Components//Footers/DashboardFooter.vue" ;
import DashboardSettingsDrawer from "@/Components//Sidebars/DashboardSettingsDrawer.vue" ;

</script>
<template>
	<div> -->

		<!-- Dashboard Layout -->
		<!-- <a-layout class="layout-dashboard" id="layout-dashboard" :class="[navbarFixed ? 'navbar-fixed' : '', ! sidebarCollapsed ? 'has-sidebar' : '', layoutClass]"> -->
			
			<!-- Main Sidebar -->
			<!-- <DashboardSidebar
				:sidebarCollapsed="sidebarCollapsed"
				:sidebarColor="sidebarColor"
				:sidebarTheme="sidebarTheme"
				@toggleSidebar="toggleSidebar"
			></DashboardSidebar> -->
			<!-- / Main Sidebar -->

			<!-- Layout Content -->
			<!-- <a-layout> -->

				<!-- Layout Header's Conditionally Fixed Wrapper -->
				<!-- <DashboardHeader
					:sidebarCollapsed="sidebarCollapsed"
					:navbarFixed="navbarFixed"
					@toggleSettingsDrawer="toggleSettingsDrawer"
					@toggleSidebar="toggleSidebar"
				></DashboardHeader> -->
				<!-- / Layout Header's Conditionally Fixed Wrapper -->

				<!-- Page Content -->
				<!-- <a-layout-content>
					<router-view />
				</a-layout-content> -->
				<!-- / Page Content -->

				<!-- Layout Footer -->
				<!-- <DashboardFooter></DashboardFooter> -->
				<!-- / Layout Footer -->

				
				<!-- Floating Action Button For Toggling Settings Drawer -->
    			<!-- <a-button class="fab" shape="circle" @click="showSettingsDrawer = true">
					<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M11.4892 3.17094C11.1102 1.60969 8.8898 1.60969 8.51078 3.17094C8.26594 4.17949 7.11045 4.65811 6.22416 4.11809C4.85218 3.28212 3.28212 4.85218 4.11809 6.22416C4.65811 7.11045 4.17949 8.26593 3.17094 8.51078C1.60969 8.8898 1.60969 11.1102 3.17094 11.4892C4.17949 11.7341 4.65811 12.8896 4.11809 13.7758C3.28212 15.1478 4.85218 16.7179 6.22417 15.8819C7.11045 15.3419 8.26594 15.8205 8.51078 16.8291C8.8898 18.3903 11.1102 18.3903 11.4892 16.8291C11.7341 15.8205 12.8896 15.3419 13.7758 15.8819C15.1478 16.7179 16.7179 15.1478 15.8819 13.7758C15.3419 12.8896 15.8205 11.7341 16.8291 11.4892C18.3903 11.1102 18.3903 8.8898 16.8291 8.51078C15.8205 8.26593 15.3419 7.11045 15.8819 6.22416C16.7179 4.85218 15.1478 3.28212 13.7758 4.11809C12.8896 4.65811 11.7341 4.17949 11.4892 3.17094ZM10 13C11.6569 13 13 11.6569 13 10C13 8.34315 11.6569 7 10 7C8.34315 7 7 8.34315 7 10C7 11.6569 8.34315 13 10 13Z" fill="#111827"/>
					</svg>
				</a-button> -->
				<!-- / Floating Action Button For Toggling Settings Drawer -->

				<!-- Sidebar Overlay -->
				<!-- <div class="sidebar-overlay" @click="sidebarCollapsed = true" v-show="! sidebarCollapsed"></div> -->
				<!-- / Sidebar Overlay -->

			<!-- </a-layout> -->
			<!-- / Layout Content -->
			
			<!-- Settings Drawer -->
			<!-- <DashboardSettingsDrawer
				:showSettingsDrawer="showSettingsDrawer"
				:navbarFixed="navbarFixed"
				:sidebarTheme="sidebarTheme"
				@toggleSettingsDrawer="toggleSettingsDrawer"
				@toggleNavbarPosition="toggleNavbarPosition"
				@updateSidebarTheme="updateSidebarTheme"
				@updateSidebarColor="updateSidebarColor"
			></DashboardSettingsDrawer> -->
			<!-- / Settings Drawer -->
<!--  -->
		<!-- </a-layout>-->
		<!-- / Dashboard Layout -->

	<!-- </div> -->
<!-- </template> -->


<!-- 
<script>


	export default ({
		
		data() {
			return {
				// Sidebar collapsed status.
				sidebarCollapsed: false,
				
				// Main sidebar color.
				sidebarColor: "primary",
				
				// Main sidebar theme : light, white, dark.
				sidebarTheme: "light",

				// Header fixed status.
				navbarFixed: false,

				// Settings drawer visiblility status.
				showSettingsDrawer: false,
			}
		},
		methods: {
			toggleSidebar( value ) {
				this.sidebarCollapsed = value ;
			},
			toggleSettingsDrawer( value ) {
				this.showSettingsDrawer = value ;
			},
			toggleNavbarPosition( value ) {
				this.navbarFixed = value ;
			},
			updateSidebarTheme( value ) {
				this.sidebarTheme = value ;
			},
			updateSidebarColor( value ) {
				this.sidebarColor = value ;
			},
		},
		computed: {
			// Sets layout's element's class based on route's meta data.
			layoutClass() {
				return this.$route.meta.layoutClass ;
			}
		},
	})

</script> -->

<script setup>
import { useLayoutStore } from "@/stores/layout"; // Adjust path as needed
import { computed } from 'vue'; // Import computed if you use it

import DashboardSidebar from "@/Components/Sidebars/DashboardSidebar.vue" ;
// import DashboardHeader from "@/Components/Headers/DashboardHeader.vue" ;
// import DashboardFooter from "@/Components/Footers/DashboardFooter.vue" ;
// import DashboardSettingsDrawer from "@/Components/Sidebars/DashboardSettingsDrawer.vue" ;

const layoutStore = useLayoutStore();

// Directly use properties from the store, they are reactive
// Or use computed properties if you need transformations
const sidebarCollapsed = computed(() => layoutStore.sidebarCollapsed);
const sidebarColor = computed(() => layoutStore.sidebarColor);
const sidebarTheme = computed(() => layoutStore.sidebarTheme);
const navbarFixed = computed(() => layoutStore.navbarFixed);
const showSettingsDrawer = computed(() => layoutStore.showSettingsDrawer);
const layoutClass = computed(() => layoutStore.layoutClass); // Get layoutClass from store


// Call store actions for methods
const toggleSidebar = (value) => layoutStore.toggleSidebar(value);
const toggleSettingsDrawer = (value) => layoutStore.toggleSettingsDrawer(value);
const toggleNavbarPosition = (value) => layoutStore.toggleNavbarPosition(value);
const updateSidebarTheme = (value) => layoutStore.updateSidebarTheme(value);
const updateSidebarColor = (value) => layoutStore.updateSidebarColor(value);

// No need for the options API export default {} block if using script setup fully
</script>

<template>
    <div>
        <a-layout class="layout-dashboard" id="layout-dashboard" :class="[navbarFixed ? 'navbar-fixed' : '', ! sidebarCollapsed ? 'has-sidebar' : '', layoutClass]">
            <!-- <DashboardSidebar
                :sidebarCollapsed="sidebarCollapsed"
                :sidebarColor="sidebarColor"
                :sidebarTheme="sidebarTheme"
                @toggleSidebar="toggleSidebar"
            ></DashboardSidebar> -->

            <a-layout>
                <!-- <DashboardHeader
                    :sidebarCollapsed="sidebarCollapsed"
                    :navbarFixed="navbarFixed"
                    @toggleSettingsDrawer="toggleSettingsDrawer"
                    @toggleSidebar="toggleSidebar"
                ></DashboardHeader> -->

                <a-layout-content>
                    <slot /> </a-layout-content>

                <!-- <DashboardFooter></DashboardFooter> -->

                <a-button class="fab" shape="circle" @click="layoutStore.toggleSettingsDrawer(true)">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.4892 3.17094C11.1102 1.60969 8.8898 1.60969 8.51078 3.17094C8.26594 4.17949 7.11045 4.65811 6.22416 4.11809C4.85218 3.28212 3.28212 4.85218 4.11809 6.22416C4.65811 7.11045 4.17949 8.26593 3.17094 8.51078C1.60969 8.8898 1.60969 11.1102 3.17094 11.4892C4.17949 11.7341 4.65811 12.8896 4.11809 13.7758C3.28212 15.1478 4.85218 16.7179 6.22417 15.8819C7.11045 15.3419 8.26594 15.8205 8.51078 16.8291C8.8898 18.3903 11.1102 18.3903 11.4892 16.8291C11.7341 15.8205 12.8896 15.3419 13.7758 15.8819C15.1478 16.7179 16.7179 15.1478 15.8819 13.7758C15.3419 12.8896 15.8205 11.7341 16.8291 11.4892C18.3903 11.1102 18.3903 8.8898 16.8291 8.51078C15.8205 8.26593 15.3419 7.11045 15.8819 6.22416C16.7179 4.85218 15.1478 3.28212 13.7758 4.11809C12.8896 4.65811 11.7341 4.17949 11.4892 3.17094ZM10 13C11.6569 13 13 11.6569 13 10C13 8.34315 11.6569 7 10 7C8.34315 7 7 8.34315 7 10C7 11.6569 8.34315 13 10 13Z" fill="#111827"/>
                    </svg>
                </a-button>

                <div class="sidebar-overlay" @click="layoutStore.toggleSidebar(true)" v-show="! sidebarCollapsed"></div>

            </a-layout>

            <!-- <DashboardSettingsDrawer
                :showSettingsDrawer="showSettingsDrawer"
                :navbarFixed="navbarFixed"
                :sidebarTheme="sidebarTheme"
                @toggleSettingsDrawer="toggleSettingsDrawer"
                @toggleNavbarPosition="toggleNavbarPosition"
                @updateSidebarTheme="updateSidebarTheme"
                @updateSidebarColor="updateSidebarColor"
            ></DashboardSettingsDrawer> -->

        </a-layout>
    </div>
</template>
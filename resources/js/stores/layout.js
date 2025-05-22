import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useLayoutStore = defineStore('layout', () => {
  const sidebarCollapsed = ref(false);
  const sidebarColor = ref("primary");
  const sidebarTheme = ref("light");
  const navbarFixed = ref(false);
  const showSettingsDrawer = ref(false);
  const layoutClass = ref(''); // Add layout class here

  function toggleSidebar(value) { sidebarCollapsed.value = value; }
  function toggleSettingsDrawer(value) { showSettingsDrawer.value = value; }
  function toggleNavbarPosition(value) { navbarFixed.value = value; }
  function updateSidebarTheme(value) { sidebarTheme.value = value; }
  function updateSidebarColor(value) { sidebarColor.value = value; }
  function updateLayoutClass(value) { layoutClass.value = value; } // New action

  return {
    sidebarCollapsed, sidebarColor, sidebarTheme, navbarFixed, showSettingsDrawer, layoutClass,
    toggleSidebar, toggleSettingsDrawer, toggleNavbarPosition, updateSidebarTheme, updateSidebarColor, updateLayoutClass
  };
});
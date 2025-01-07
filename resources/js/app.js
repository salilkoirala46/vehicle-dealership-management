import "./bootstrap";
import router from "./router";
import axios from "@/axios";
import { createApp } from "vue";
import App from "./App.vue";
import VueSweetalert2 from "vue-sweetalert2";
import "sweetalert2/dist/sweetalert2.min.css"; // Optional for default styles

const app = createApp(App);

import FooterComponent from "./components/Footer.vue";
import NavbarComponent from "./components/Navbar.vue";
import SidebarComponent from "./components/Sidebar.vue";
import MainheaderComponent from "./components/Mainheader.vue";
import InputText from "./components/InputText.vue";

app.component("Footer", FooterComponent);
app.component("Navbar", NavbarComponent);
app.component("Sidebar", SidebarComponent);
app.component("Mainheader", MainheaderComponent);
app.component("InputText", InputText);
// Make axios globally available to all components
app.config.globalProperties.$axios = axios;

app.config.globalProperties.$user = {
    data: null,
    setUser(userData) {
        this.data = userData;
    },
    clearUser() {
        this.data = null;
    },
};

// Make user data available to all components and even after refresh of page
const storedUserData = localStorage.getItem("userData");
if (storedUserData) {
    app.config.globalProperties.$user.setUser(JSON.parse(storedUserData));
}

app.use(router);
app.use(VueSweetalert2);
app.mount("#app");

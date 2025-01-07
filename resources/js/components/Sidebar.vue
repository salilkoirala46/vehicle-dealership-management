<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="index3.html" class="brand-link">
            <img
                src="/img/AdminLTELogo.png"
                alt="AdminLTE Logo"
                class="brand-image img-circle elevation-3"
                style="opacity: 0.8"
            />
            <span class="brand-text font-weight-light">Car Sales</span>
        </a>

        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img
                        src="/img/user2-160x160.jpg"
                        class="img-circle elevation-2"
                        alt="User Image"
                    />
                </div>
                <div class="info">
                    <a href="#" class="d-block">Alexander Pierce</a>
                </div>
            </div>

            <nav class="mt-2">
                <ul
                    class="nav nav-pills nav-sidebar flex-column"
                    data-widget="treeview"
                    role="menu"
                    data-accordion="false"
                >
                    <li class="nav-item">
                        <router-link to="/dashboard/user" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>Users</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/dashboard/vehicles" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>Vehicles</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <a @click="logout" href="#" class="nav-link">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Logout</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
</template>

<script>
export default {
    methods: {
        logout() {
            localStorage.removeItem("authToken");
            localStorage.removeItem("userData");

            this.$user.clearUser();

            this.$router.push({ name: "login" });
        },
    },
};
</script>
<style></style>

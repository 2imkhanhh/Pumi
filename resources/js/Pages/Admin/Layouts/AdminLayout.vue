<script setup>
import Sidebar from '../Components/Sidebar.vue';
import Topnav from '../Components/Topnav.vue';
</script>

<template>
    <div class="admin-layout">
        <Sidebar />
        <div class="main-content">
            <Topnav />
            <main class="page-content">
                <slot />
            </main>
        </div>
    </div>
</template>

<style>
/* Global resets for admin */
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

body.admin-mode {
    background-color: #f8fafc;
    margin: 0;
    font-family: 'Inter', sans-serif;
    color: #334155;
}
</style>

<style scoped>
.admin-layout {
    display: flex;
    min-height: 100vh;
    background: #f8fafc;
}

.main-content {
    flex: 1;
    margin-left: 260px; /* Width of sidebar */
    display: flex;
    flex-direction: column;
}

.page-content {
    padding: 2rem;
    flex: 1;
}

@media (max-width: 768px) {
    .main-content {
        margin-left: 0;
    }
}
</style>

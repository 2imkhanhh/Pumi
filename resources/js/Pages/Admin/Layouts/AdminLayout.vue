<script setup>
import Sidebar from '../Components/Sidebar.vue';
import Topnav from '../Components/Topnav.vue';
import Toast from '../Components/Toast.vue';
import ConfirmDialog from '../Components/ConfirmDialog.vue';
import { onMounted, onUnmounted, provide, ref } from 'vue';

const toastRef = ref(null);
const confirmDialogRef = ref(null);

const showToast = (message, type = 'success') => {
    toastRef.value?.addToast(message, type);
};

const showConfirm = (title, message) => {
    return confirmDialogRef.value?.show(title, message);
};

provide('toast', showToast);
provide('confirm', showConfirm);

onMounted(() => {
    document.body.classList.add('admin-mode');
});

onUnmounted(() => {
    document.body.classList.remove('admin-mode');
});
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
        <Toast ref="toastRef" />
        <ConfirmDialog ref="confirmDialogRef" />
    </div>
</template>

<style>
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
    margin-left: 260px;
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

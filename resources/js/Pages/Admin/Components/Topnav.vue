<script setup>
import { Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';

const isDropdownOpen = ref(false);

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <header class="topnav">
        <div class="search-bar">
            <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            <input type="text" placeholder="Tìm kiếm nhanh..." class="search-input" />
        </div>

        <div class="user-actions">
            <button class="notification-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                <span class="badge">3</span>
            </button>

            <div class="profile-dropdown">
                <button class="profile-btn" @click="isDropdownOpen = !isDropdownOpen">
                    <img src="https://ui-avatars.com/api/?name=Admin&background=eff6ff&color=3b82f6" alt="Avatar" class="avatar" />
                    <span class="user-name">{{ $page.props.auth.user.name }}</span>
                    <svg class="chevron" :class="{ open: isDropdownOpen }" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </button>

                <div v-if="isDropdownOpen" class="dropdown-menu">
                    <div class="dropdown-header">
                        <p class="name">{{ $page.props.auth.user.name }}</p>
                        <p class="email">{{ $page.props.auth.user.email }}</p>
                    </div>
                    <Link :href="route('profile.edit')" class="dropdown-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        Tài khoản
                    </Link>
                    <button @click="logout" class="dropdown-item text-danger">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                        Đăng xuất
                    </button>
                </div>
            </div>
        </div>
    </header>
</template>

<style scoped>
.topnav {
    height: 70px;
    background: #ffffff;
    border-bottom: 1px solid #e2e8f0;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 2rem;
    position: sticky;
    top: 0;
    z-index: 99;
}

.search-bar {
    position: relative;
    width: 300px;
}

.search-input {
    width: 100%;
    padding: 0.6rem 1rem 0.6rem 2.5rem;
    background: #f1f5f9;
    border: 1px solid transparent;
    border-radius: 20px;
    font-size: 0.9rem;
    color: #334155;
    transition: all 0.2s ease;
    outline: none;
}

.search-input:focus {
    background: #ffffff;
    border-color: #cbd5e1;
    box-shadow: 0 0 0 3px rgba(203, 213, 225, 0.3);
}

.search-icon {
    position: absolute;
    left: 0.8rem;
    top: 50%;
    transform: translateY(-50%);
    width: 16px;
    height: 16px;
    color: #94a3b8;
}

.user-actions {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.notification-btn {
    background: none;
    border: none;
    position: relative;
    cursor: pointer;
    color: #64748b;
    padding: 0.5rem;
    border-radius: 50%;
    transition: background 0.2s;
}

.notification-btn:hover {
    background: #f1f5f9;
    color: #0f172a;
}

.notification-btn svg {
    width: 20px;
    height: 20px;
}

.badge {
    position: absolute;
    top: 2px;
    right: 2px;
    background: #ef4444;
    color: white;
    font-size: 0.65rem;
    font-weight: bold;
    padding: 2px 5px;
    border-radius: 10px;
    border: 2px solid #ffffff;
}

.profile-dropdown {
    position: relative;
}

.profile-btn {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    background: none;
    border: none;
    cursor: pointer;
    padding: 0.25rem;
    border-radius: 20px;
    transition: background 0.2s;
}

.profile-btn:hover {
    background: #f8fafc;
}

.avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    object-fit: cover;
}

.user-name {
    font-size: 0.9rem;
    font-weight: 600;
    color: #334155;
}

.chevron {
    width: 16px;
    height: 16px;
    color: #64748b;
    transition: transform 0.2s;
}

.chevron.open {
    transform: rotate(180deg);
}

.dropdown-menu {
    position: absolute;
    top: calc(100% + 0.5rem);
    right: 0;
    width: 220px;
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    border: 1px solid #f1f5f9;
    overflow: hidden;
    animation: fadeInDown 0.2s ease;
}

@keyframes fadeInDown {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

.dropdown-header {
    padding: 1rem;
    border-bottom: 1px solid #f1f5f9;
    background: #f8fafc;
}

.dropdown-header .name {
    margin: 0;
    font-weight: 600;
    font-size: 0.9rem;
    color: #0f172a;
}

.dropdown-header .email {
    margin: 0;
    font-size: 0.8rem;
    color: #64748b;
    margin-top: 0.25rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.dropdown-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    width: 100%;
    padding: 0.75rem 1rem;
    background: none;
    border: none;
    text-align: left;
    font-size: 0.9rem;
    color: #475569;
    cursor: pointer;
    text-decoration: none;
    transition: background 0.2s;
}

.dropdown-item:hover {
    background: #f1f5f9;
    color: #0f172a;
}

.dropdown-item svg {
    width: 16px;
    height: 16px;
}

.text-danger {
    color: #ef4444;
}
.text-danger:hover {
    background: #fef2f2;
    color: #dc2626;
}
</style>

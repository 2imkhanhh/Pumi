<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const isSubmitting = ref(false);

const submit = () => {
    isSubmitting.value = true;
    form.post(route('login'), {
        onFinish: () => {
            form.reset('password');
            isSubmitting.value = false;
        },
    });
};
</script>

<template>
    <Head title="Pumi Admin - Đăng nhập" />
    <div class="login-wrapper">
        <div class="login-container">
            <div class="login-left">
                <div class="brand">
                    <img src="/assets/images/favicon.png" alt="Pumi Logo" class="logo-img" />
                    <h1>Pumi Admin</h1>
                </div>
                <p class="subtitle">Hệ thống quản trị nội dung cao cấp</p>
                <div class="graphic">
                    <div class="glass-sphere"></div>
                    <div class="glass-sphere small"></div>
                </div>
            </div>
            <div class="login-right">
                <div class="form-wrapper">
                    <h2>Đăng nhập</h2>
                    <p class="welcome-text">Chào mừng trở lại! Vui lòng nhập thông tin của bạn.</p>
                    
                    <div v-if="status" class="status-message">
                        {{ status }}
                    </div>

                    <form @submit.prevent="submit" class="login-form">
                        <div class="input-group">
                            <label for="email">Email</label>
                            <div class="input-wrapper">
                                <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                <input 
                                    id="email" 
                                    type="email" 
                                    v-model="form.email" 
                                    placeholder="admin@pumi.vn" 
                                    required 
                                    autofocus 
                                    :class="{ 'has-error': form.errors.email }"
                                />
                            </div>
                            <span v-if="form.errors.email" class="error-text">{{ form.errors.email }}</span>
                        </div>

                        <div class="input-group">
                            <label for="password">Mật khẩu</label>
                            <div class="input-wrapper">
                                <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                <input 
                                    id="password" 
                                    type="password" 
                                    v-model="form.password" 
                                    placeholder="••••••••" 
                                    required 
                                    :class="{ 'has-error': form.errors.password }"
                                />
                            </div>
                            <span v-if="form.errors.password" class="error-text">{{ form.errors.password }}</span>
                        </div>

                        <div class="form-actions">
                            <label class="checkbox-container">
                                <input type="checkbox" v-model="form.remember" />
                                <span class="checkmark"></span>
                                Ghi nhớ đăng nhập
                            </label>
                            
                            <Link v-if="canResetPassword" :href="route('password.request')" class="forgot-link">
                                Quên mật khẩu?
                            </Link>
                        </div>

                        <button type="submit" class="submit-btn" :disabled="form.processing">
                            <span v-if="form.processing">Đang xử lý...</span>
                            <span v-else>Đăng nhập</span>
                            <svg v-if="!form.processing" class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

.login-wrapper {
    font-family: 'Inter', sans-serif;
    min-height: 100vh;
    background: #f0f4f8; 
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    box-sizing: border-box;
    margin: -8px; /* Offset default body margin if any */
}

.login-container {
    display: flex;
    width: 100%;
    max-width: 1000px;
    min-height: 600px;
    background: #ffffff;
    border-radius: 24px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05), 0 1px 3px rgba(0, 0, 0, 0.05);
    overflow: hidden;
    position: relative;
}

.login-left {
    flex: 1;
    background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
    padding: 3rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
    position: relative;
    overflow: hidden;
}

.login-left::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.8) 0%, rgba(255,255,255,0) 60%);
    opacity: 0.5;
    animation: rotate 20s linear infinite;
}

@keyframes rotate {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.brand {
    display: flex;
    align-items: center;
    gap: 1rem;
    z-index: 2;
    margin-bottom: 1rem;
}

.logo-img {
    width: 48px;
    height: 48px;
    object-fit: contain;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.brand h1 {
    font-size: 2rem;
    font-weight: 700;
    color: #1e3a8a;
    margin: 0;
    letter-spacing: -0.5px;
}

.subtitle {
    font-size: 1.1rem;
    color: #475569;
    z-index: 2;
    margin: 0;
    font-weight: 400;
}

.graphic {
    position: absolute;
    bottom: -10%;
    right: -10%;
    width: 300px;
    height: 300px;
}

.glass-sphere {
    position: absolute;
    width: 250px;
    height: 250px;
    border-radius: 50%;
    background: linear-gradient(135deg, rgba(255,255,255,0.4), rgba(255,255,255,0.1));
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.5);
    box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.1);
    top: 0;
    left: 0;
}
.glass-sphere.small {
    width: 100px;
    height: 100px;
    top: -50px;
    left: -20px;
}

.login-right {
    flex: 1;
    padding: 3rem;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #ffffff;
}

.form-wrapper {
    width: 100%;
    max-width: 380px;
}

.form-wrapper h2 {
    font-size: 2rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 0.5rem;
}

.welcome-text {
    color: #64748b;
    margin-bottom: 2.5rem;
    font-size: 0.95rem;
}

.status-message {
    background: #dcfce7;
    color: #166534;
    padding: 1rem;
    border-radius: 12px;
    margin-bottom: 1.5rem;
    font-size: 0.9rem;
    font-weight: 500;
}

.input-group {
    margin-bottom: 1.5rem;
}

.input-group label {
    display: block;
    font-size: 0.875rem;
    font-weight: 600;
    color: #334155;
    margin-bottom: 0.5rem;
}

.input-wrapper {
    position: relative;
    display: flex;
    align-items: center;
}

.input-wrapper input {
    width: 100%;
    padding: 0.875rem 1rem 0.875rem 3rem;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    font-size: 0.95rem;
    color: #0f172a;
    background: #f8fafc;
    transition: all 0.3s ease;
    outline: none;
    font-family: inherit;
    box-sizing: border-box;
}

.input-wrapper input:focus {
    background: #ffffff;
    border-color: #3b82f6;
    box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
}

.input-wrapper input.has-error {
    border-color: #ef4444;
    background: #fef2f2;
}

.input-wrapper input.has-error:focus {
    box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
}

.input-icon {
    position: absolute;
    left: 1rem;
    width: 20px;
    height: 20px;
    color: #94a3b8;
    transition: color 0.3s ease;
}

.input-wrapper input:focus + .input-icon,
.input-wrapper input:focus ~ .input-icon {
    color: #3b82f6;
}

.error-text {
    display: block;
    color: #ef4444;
    font-size: 0.8rem;
    margin-top: 0.5rem;
}

.form-actions {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 2rem;
}

.checkbox-container {
    display: flex;
    align-items: center;
    cursor: pointer;
    font-size: 0.875rem;
    color: #475569;
    user-select: none;
    position: relative;
}

.checkbox-container input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0;
}

.checkmark {
    height: 18px;
    width: 18px;
    background-color: #f1f5f9;
    border: 1px solid #cbd5e1;
    border-radius: 4px;
    margin-right: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
}

.checkbox-container:hover input ~ .checkmark {
    background-color: #e2e8f0;
}

.checkbox-container input:checked ~ .checkmark {
    background-color: #3b82f6;
    border-color: #3b82f6;
}

.checkmark:after {
    content: "";
    display: none;
    width: 4px;
    height: 8px;
    border: solid white;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
    margin-bottom: 2px;
}

.checkbox-container input:checked ~ .checkmark:after {
    display: block;
}

.forgot-link {
    font-size: 0.875rem;
    color: #3b82f6;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.2s ease;
}

.forgot-link:hover {
    color: #1d4ed8;
    text-decoration: underline;
}

.submit-btn {
    width: 100%;
    padding: 1rem;
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
    font-family: inherit;
}

.submit-btn:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(37, 99, 235, 0.3);
}

.submit-btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

.btn-icon {
    width: 20px;
    height: 20px;
    transition: transform 0.3s ease;
}

.submit-btn:hover:not(:disabled) .btn-icon {
    transform: translateX(4px);
}

@media (max-width: 768px) {
    .login-container {
        flex-direction: column;
    }
    
    .login-left {
        padding: 2rem;
        flex: none;
        height: 200px;
    }
    
    .graphic {
        display: none;
    }
    
    .login-right {
        padding: 2rem;
    }
}
</style>

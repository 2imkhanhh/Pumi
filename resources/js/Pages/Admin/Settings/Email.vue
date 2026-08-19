<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AdminLayout from '../Layouts/AdminLayout.vue';
import { ref } from 'vue';

defineOptions({ layout: AdminLayout });

const props = defineProps({
    settings: Object,
});

const form = useForm({
    mail_host: props.settings.mail_host || 'smtp.gmail.com',
    mail_port: props.settings.mail_port || '587',
    mail_encryption: props.settings.mail_encryption || 'tls',
    mail_username: props.settings.mail_username || '',
    mail_password: props.settings.mail_password || '',
    mail_receive_address: props.settings.mail_receive_address || '',
    _method: 'POST'
});

const submit = () => {
    form.post(route('admin.settings.store'), {
        preserveScroll: true,
        forceFormData: true,
    });
};
</script>

<template>

    <Head title="Cấu hình Email" />

    <div class="page-header">
        <div>
            <h1 class="title">Cấu hình Email</h1>
        </div>
    </div>

    <form @submit.prevent="submit" class="settings-form" novalidate>
        <div class="card">
            <div class="card-body">
                <h3 class="section-title">Cấu hình SMTP</h3>
                <div class="grid-2">
                    <div class="form-group">
                        <label>Máy chủ SMTP (Mail Host)</label>
                        <input type="text" v-model="form.mail_host" class="form-control" placeholder="smtp.gmail.com" />
                    </div>

                    <div class="form-group">
                        <label>Cổng (Mail Port)</label>
                        <input type="text" v-model="form.mail_port" class="form-control" placeholder="587" />
                    </div>

                    <div class="form-group">
                        <label>Mã hóa (Mail Encryption)</label>
                        <select v-model="form.mail_encryption" class="form-control">
                            <option value="tls">TLS</option>
                            <option value="ssl">SSL</option>
                            <option value="">Không mã hóa</option>
                        </select>
                    </div>
                </div>

                <div class="grid-2 mt-4">
                    <div class="form-group">
                        <label>Tài khoản Email gửi (SMTP Username)</label>
                        <input type="text" v-model="form.mail_username" class="form-control"
                            placeholder="example@gmail.com" />
                    </div>

                    <div class="form-group">
                        <label>Mật khẩu ứng dụng (App Password)</label>
                        <input type="password" v-model="form.mail_password" class="form-control"
                            placeholder="Mật khẩu ứng dụng..." />
                    </div>
                </div>

                <h3 class="section-title mt-4">Nhận thông báo</h3>
                <div class="form-group">
                    <label>Email nhận thông báo liên hệ</label>
                    <input type="text" v-model="form.mail_receive_address" class="form-control"
                        placeholder="admin@example.com" />
                    <p class="text-sm text-gray mt-1">Địa chỉ email nhận thông báo khi có khách điền form. Nếu để trống
                        sẽ dùng tài khoản email gửi.</p>
                </div>
            </div>
        </div>

        <div class="form-actions mt-4">
            <button type="submit" class="btn-primary" :disabled="form.processing">
                Lưu
            </button>
        </div>
    </form>
</template>

<style scoped>
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0;
}

.card {
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    margin-bottom: 1.5rem;
    overflow: hidden;
}

.card-body {
    padding: 1.5rem;
}

.section-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #334155;
    margin-bottom: 1.25rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid #e2e8f0;
}

.form-group {
    margin-bottom: 1.25rem;
}

.grid-2 .form-group {
    margin-bottom: 0;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
    color: #475569;
}

.form-control {
    width: 100%;
    padding: 0.625rem 0.875rem;
    background-color: #fff;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    font-size: 0.95rem;
    color: #1e293b;
    transition: all 0.2s;
    box-sizing: border-box;
}

.form-control:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.grid-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
}

@media (max-width: 768px) {
    .grid-2 {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
}

.text-gray {
    color: #64748b;
}

.text-sm {
    font-size: 0.875rem;
}

.mt-1 {
    margin-top: 0.25rem;
}

.mt-4 {
    margin-top: 1.5rem;
}

.mb-4 {
    margin-bottom: 1.5rem;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
}

.btn-primary {
    background: #3b82f6;
    color: white;
    border: none;
    padding: 0.625rem 1.25rem;
    border-radius: 8px;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.2s;
}

.btn-primary:hover {
    background: #2563eb;
}

.btn-primary:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}
</style>

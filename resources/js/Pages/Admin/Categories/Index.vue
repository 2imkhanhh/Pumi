<script setup>
import { Head, useForm, router, Link } from '@inertiajs/vue3';
import AdminLayout from '../Layouts/AdminLayout.vue';
import { ref, watch } from 'vue';

defineOptions({ layout: AdminLayout });

const props = defineProps({
    categories: Object,
});

const isModalOpen = ref(false);
const isEditing = ref(false);

const form = useForm({
    id: null,
    name: '',
    slug: '',
    is_active: 1,
    _method: 'POST'
});

const openCreateModal = () => {
    isEditing.value = false;
    form.reset();
    form.clearErrors();
    form._method = 'POST';
    isModalOpen.value = true;
};

const openEditModal = (category) => {
    isEditing.value = true;
    form.clearErrors();
    form.id = category.id;
    form.name = category.name;
    form.slug = category.slug;
    form.is_active = category.is_active;
    form._method = 'PUT';
    isModalOpen.value = true;
};

const submit = () => {
    if (isEditing.value) {
        form.post(route('admin.categories.update', form.id), {
            preserveScroll: true,
            onSuccess: () => { isModalOpen.value = false; }
        });
    } else {
        form.post(route('admin.categories.store'), {
            preserveScroll: true,
            onSuccess: () => { isModalOpen.value = false; }
        });
    }
};

const deleteCategory = (id) => {
    if (confirm('Bạn có chắc chắn muốn xóa danh mục này? Các sản phẩm trong danh mục này cũng có thể bị ảnh hưởng!')) {
        router.delete(route('admin.categories.destroy', id), {
            preserveScroll: true
        });
    }
};

const generateSlug = (str) => {
    if (!str) return '';
    str = str.replace(/^\s+|\s+$/g, '');
    str = str.toLowerCase();
    const from = "àáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ·/_,:;";
    const to   = "aaaaaaaaaaaaaaaaaeeeeeeeeeeeiiiiiooooooooooooooooouuuuuuuuuuuyyyyyd------";
    for (let i = 0, l = from.length; i < l; i++) {
        str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
    }
    str = str.replace(/[^a-z0-9 -]/g, '')
             .replace(/\s+/g, '-')
             .replace(/-+/g, '-');
    return str;
};

watch(() => form.name, (newName) => {
    if (!isEditing.value) {
        form.slug = generateSlug(newName);
    }
});
</script>

<template>
    <Head title="Quản lý Danh mục" />

    <div class="page-header">
        <div>
            <h1 class="title">Danh mục Sản phẩm</h1>
            <p class="subtitle">Quản lý các nhóm/danh mục sản phẩm hiển thị trên website.</p>
        </div>
        <button @click="openCreateModal" class="btn-primary">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Thêm danh mục
        </button>
    </div>

    <!-- Notification -->
    <div v-if="$page.props.flash && $page.props.flash.message" class="alert-success">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
        {{ $page.props.flash.message }}
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th width="80">STT</th>
                        <th>Tên danh mục</th>
                        <th>Đường dẫn tĩnh</th>
                        <th>Trạng thái</th>
                        <th width="120" class="text-right">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(category, index) in categories.data" :key="category.id">
                        <td>{{ (categories.current_page - 1) * categories.per_page + index + 1 }}</td>
                        <td class="font-medium text-dark">{{ category.name }}</td>
                        <td><span class="badge">{{ category.slug }}</span></td>
                        <td>
                            <span :class="['status-dot', category.is_active ? 'active' : 'inactive']"></span>
                            {{ category.is_active ? 'Hiển thị' : 'Ẩn' }}
                        </td>
                        <td class="text-right">
                            <div class="actions">
                                <button @click="openEditModal(category)" class="btn-icon text-blue" title="Sửa">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                </button>
                                <button @click="deleteCategory(category.id)" class="btn-icon text-red" title="Xóa">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr v-if="categories.data.length === 0">
                        <td colspan="5" class="text-center py-4 text-gray">Không có danh mục nào.</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="pagination-wrap" v-if="categories.links && categories.links.length > 3">
            <div class="pagination">
                <template v-for="(link, i) in categories.links" :key="i">
                    <Link 
                        v-if="link.url" 
                        :href="link.url" 
                        class="page-link" 
                        :class="{ active: link.active }"
                        v-html="link.label"
                    ></Link>
                    <span v-else class="page-link disabled" v-html="link.label"></span>
                </template>
            </div>
        </div>
    </div>

    <!-- Center Popup Modal -->
    <div class="modal-overlay" :class="{ show: isModalOpen }" @click="isModalOpen = false"></div>
    <div class="center-modal" :class="{ show: isModalOpen }">
        <div class="modal-header">
            <h2>{{ isEditing ? 'Cập nhật Danh mục' : 'Thêm Danh mục mới' }}</h2>
            <button class="close-btn" @click="isModalOpen = false">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>
        <div class="modal-body">
            <form @submit.prevent="submit">
                <div class="form-group">
                    <label>Tên danh mục <span class="required">*</span></label>
                    <input type="text" v-model="form.name" class="form-control" required />
                    <span class="error" v-if="form.errors.name">{{ form.errors.name }}</span>
                </div>

                <div class="form-group">
                    <label>Đường dẫn tĩnh</label>
                    <input type="text" v-model="form.slug" class="form-control" />
                    <span class="error" v-if="form.errors.slug">{{ form.errors.slug }}</span>
                </div>

                <div class="form-group switch-group">
                    <label class="switch">
                        <input type="checkbox" v-model="form.is_active" :true-value="1" :false-value="0" />
                        <span class="slider round"></span>
                    </label>
                    <span class="switch-label">Hiển thị trên website</span>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-default" @click="isModalOpen = false">Hủy</button>
                    <button type="submit" class="btn-primary" :disabled="form.processing">
                        {{ form.processing ? 'Đang xử lý...' : 'Lưu lại' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<style scoped>
/* Reuse the exact same scoped CSS as Products/Index.vue */
.page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; }
.title { font-size: 1.5rem; font-weight: 700; color: #0f172a; margin: 0; }
.subtitle { color: #64748b; margin: 0.25rem 0 0 0; font-size: 0.9rem; }

.btn-primary { display: flex; align-items: center; gap: 0.5rem; background: #3b82f6; color: white; border: none; padding: 0.6rem 1.25rem; border-radius: 10px; font-weight: 500; font-size: 0.9rem; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.2); }
.btn-primary:hover { background: #2563eb; transform: translateY(-1px); }
.btn-primary svg { width: 18px; height: 18px; }

.btn-default { background: #f1f5f9; color: #475569; border: none; padding: 0.6rem 1.25rem; border-radius: 10px; font-weight: 500; font-size: 0.9rem; cursor: pointer; transition: all 0.2s; }
.btn-default:hover { background: #e2e8f0; }

.alert-success { background: #ecfdf5; color: #059669; padding: 1rem; border-radius: 12px; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem; font-weight: 500; font-size: 0.9rem; border: 1px solid #a7f3d0; }
.alert-success svg { width: 20px; height: 20px; }

.card { background: #ffffff; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); border: 1px solid #f1f5f9; overflow: hidden; }
.table-responsive { overflow-x: auto; }
.table { width: 100%; border-collapse: collapse; }
.table th { background: #f8fafc; color: #64748b; font-weight: 600; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px; padding: 1rem; text-align: left; border-bottom: 1px solid #e2e8f0; }
.table td { padding: 1rem; vertical-align: middle; border-bottom: 1px solid #f1f5f9; font-size: 0.9rem; color: #475569; }
.table tr:last-child td { border-bottom: none; }
.table tr:hover { background: #f8fafc; }

.text-right { text-align: right; }
.text-center { text-align: center; }
.font-medium { font-weight: 500; }
.text-dark { color: #0f172a; }
.text-gray { color: #94a3b8; }
.py-4 { padding-top: 1.5rem; padding-bottom: 1.5rem; }

.badge { background: #eff6ff; color: #3b82f6; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.8rem; font-weight: 500; }

.status-dot { display: inline-block; width: 8px; height: 8px; border-radius: 50%; margin-right: 6px; }
.status-dot.active { background: #10b981; }
.status-dot.inactive { background: #cbd5e1; }

.actions { display: flex; align-items: center; justify-content: flex-end; gap: 0.5rem; }
.btn-icon { background: none; border: none; cursor: pointer; padding: 0.4rem; border-radius: 8px; transition: all 0.2s; display: flex; align-items: center; justify-content: center; }
.btn-icon svg { width: 18px; height: 18px; }
.btn-icon:hover { background: #f1f5f9; }
.text-blue { color: #3b82f6; }
.text-red { color: #ef4444; }

/* Pagination Premium */
.pagination-wrap { padding: 1.5rem; border-top: 1px solid #f1f5f9; display: flex; justify-content: center; }
.pagination { display: inline-flex; align-items: center; gap: 0.5rem; }
.page-link { display: flex; align-items: center; justify-content: center; min-width: 36px; height: 36px; border-radius: 50%; background: transparent; border: none; color: #64748b; text-decoration: none; font-size: 0.95rem; font-weight: 600; transition: all 0.25s ease; cursor: pointer; }
.page-link:hover:not(.disabled) { background: #f1f5f9; color: #0f172a; transform: translateY(-2px); }
.page-link.active { background: #3b82f6; color: #ffffff; box-shadow: 0 4px 10px rgba(59, 130, 246, 0.35); }
.page-link.disabled { opacity: 0.4; pointer-events: none; cursor: default; }

/* Center Modal */
.modal-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(15, 23, 42, 0.4); backdrop-filter: blur(4px); z-index: 1000; opacity: 0; visibility: hidden; transition: all 0.3s ease; }
.modal-overlay.show { opacity: 1; visibility: visible; }
.center-modal { position: fixed; top: 50%; left: 50%; width: 100%; max-width: 500px; background: #ffffff; z-index: 1001; border-radius: 12px; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); transform: translate(-50%, -50%) scale(0.95); opacity: 0; visibility: hidden; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); display: flex; flex-direction: column; }
.center-modal.show { transform: translate(-50%, -50%) scale(1); opacity: 1; visibility: visible; }
.modal-header { padding: 1.5rem; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center; }
.modal-header h2 { margin: 0; font-size: 1.25rem; color: #0f172a; }
.close-btn { background: none; border: none; cursor: pointer; color: #64748b; border-radius: 50%; padding: 0.5rem; transition: background 0.2s; }
.close-btn:hover { background: #f1f5f9; color: #0f172a; }
.close-btn svg { width: 20px; height: 20px; }
.modal-body { padding: 1.5rem; flex: 1; overflow-y: auto; }
.modal-footer { padding-top: 1.5rem; margin-top: 1rem; border-top: 1px solid #e2e8f0; display: flex; justify-content: flex-end; gap: 1rem; }

/* Form Styles */
.form-group { margin-bottom: 1.25rem; }
.form-group label { display: block; font-size: 0.85rem; font-weight: 600; color: #334155; margin-bottom: 0.5rem; }
.required { color: #ef4444; }
.form-control { width: 100%; padding: 0.65rem 1rem; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 0.95rem; color: #0f172a; background: #ffffff; transition: all 0.2s; font-family: inherit; box-sizing: border-box; }
.form-control:focus { outline: none; border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1); }
.error { display: block; color: #ef4444; font-size: 0.8rem; margin-top: 0.4rem; }
.switch-group { display: flex; align-items: center; gap: 0.75rem; }
.switch-label { font-size: 0.9rem; font-weight: 500; color: #334155; }
.switch { position: relative; display: inline-block; width: 44px; height: 24px; }
.switch input { opacity: 0; width: 0; height: 0; }
.slider { position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #cbd5e1; transition: .3s; }
.slider:before { position: absolute; content: ""; height: 18px; width: 18px; left: 3px; bottom: 3px; background-color: white; transition: .3s; }
input:checked + .slider { background-color: #10b981; }
input:focus + .slider { box-shadow: 0 0 1px #10b981; }
input:checked + .slider:before { transform: translateX(20px); }
.slider.round { border-radius: 24px; }
.slider.round:before { border-radius: 50%; }
</style>

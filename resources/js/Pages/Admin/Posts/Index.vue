<script setup>
import { Head, useForm, router, Link } from '@inertiajs/vue3';
import AdminLayout from '../Layouts/AdminLayout.vue';
import { ref, watch, inject } from 'vue';
import { QuillEditor } from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import axios from 'axios';

const showConfirm = inject('confirm');
const showToast = inject('toast');

defineOptions({ layout: AdminLayout });

const props = defineProps({
    posts: Object,
    categories: Array,
    filters: Object,
});

const isModalOpen = ref(false);
const isEditing = ref(false);
const searchKeyword = ref(props.filters.search || '');
const currentImage = ref(null);

const form = useForm({
    id: null,
    title: '',
    slug: '',
    slug: '',
    type: 'news',
    category_id: null,
    job_type: '',
    location: '',
    salary: '',
    deadline: '',
    excerpt: '',
    content: '',
    published_at: '',
    image: null,
    _method: 'POST'
});

const quillRef = ref(null);

const imageHandler = () => {
    const input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.setAttribute('accept', 'image/*');
    input.click();
    input.onchange = async () => {
        const file = input.files[0];
        if (file) {
            const formData = new FormData();
            formData.append('image', file);
            try {
                const res = await axios.post(route('admin.upload.image'), formData, {
                    headers: { 'Content-Type': 'multipart/form-data' }
                });
                const url = res.data.url;
                const quill = quillRef.value.getQuill();
                const range = quill.getSelection();
                const cursorPosition = range ? range.index : quill.getLength();
                quill.insertEmbed(cursorPosition, 'image', url);
            } catch (err) {
                console.error('Image upload failed', err);
                showToast('Tải ảnh lên thất bại!', 'error');
            }
        }
    };
};

const editorOptions = {
    modules: {
        toolbar: {
            container: [
                ['bold', 'italic', 'underline', 'strike'],
                ['blockquote'],
                [{ 'header': 1 }, { 'header': 2 }],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                [{ 'size': ['small', false, 'large', 'huge'] }],
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'align': [] }],
                ['clean'],
                ['link', 'image', 'video']
            ],
            handlers: {
                image: imageHandler
            }
        }
    }
};

const openCreateModal = () => {
    isEditing.value = false;
    currentImage.value = null;
    form.reset();
    form.clearErrors();
    form.id = null;
    form.title = '';
    form.slug = '';
    form.type = 'news';
    form.category_id = null;
    form.job_type = '';
    form.location = '';
    form.salary = '';
    form.deadline = '';
    form.excerpt = '';
    form.content = '';
    form.image = null;
    form._method = 'POST';
    const now = new Date();
    form.published_at = now.toISOString().split('T')[0];
    isModalOpen.value = true;
};

const openEditModal = (post) => {
    isEditing.value = true;
    currentImage.value = post.image;
    form.clearErrors();
    form.id = post.id;
    form.title = post.title;
    form.slug = post.slug;
    form.type = post.type || 'news';
    form.category_id = post.category_id || null;
    form.job_type = post.job_type || '';
    form.location = post.location || '';
    form.salary = post.salary || '';
    form.deadline = post.deadline || '';
    form.excerpt = post.excerpt;
    form.content = post.content;
    form.published_at = post.published_at ? post.published_at.split(' ')[0] : '';
    form.image = null;
    form._method = 'PUT';
    isModalOpen.value = true;
};

const submit = () => {
    if (isEditing.value) {
        form.post(route('admin.posts.update', form.id), {
            preserveScroll: true,
            onSuccess: () => {
                isModalOpen.value = false;
                form.reset();
            }
        });
    } else {
        form.post(route('admin.posts.store'), {
            preserveScroll: true,
            onSuccess: () => {
                isModalOpen.value = false;
                form.reset();
            }
        });
    }
};

const deletePost = async (id) => {
    const confirmed = await showConfirm('Xóa bài viết', 'Bạn có chắc chắn muốn xóa bài viết này? Thao tác này không thể hoàn tác.');
    if (confirmed) {
        router.delete(route('admin.posts.destroy', id), {
            preserveScroll: true
        });
    }
};

const generateSlug = (str) => {
    if (!str) return '';
    str = str.replace(/^\s+|\s+$/g, '');
    str = str.toLowerCase();
    const from = "àáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ·/_,:;";
    const to = "aaaaaaaaaaaaaaaaaeeeeeeeeeeeiiiiiooooooooooooooooouuuuuuuuuuuyyyyyd------";
    for (let i = 0, l = from.length; i < l; i++) {
        str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
    }
    str = str.replace(/[^a-z0-9 -]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-');
    return str;
};

watch(() => form.title, (newTitle) => {
    if (!isEditing.value) {
        form.slug = generateSlug(newTitle);
    }
});

let searchTimeout = null;
watch(searchKeyword, (value) => {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        router.get(route('admin.posts.index'), { search: value }, {
            preserveState: true,
            replace: true
        });
    }, 300);
});
</script>

<template>

    <Head title="Quản lý Tin tức" />

    <div class="page-header">
        <div>
            <h1 class="title">Tin tức</h1>
        </div>
        <button @click="openCreateModal" class="btn-primary">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Thêm bài viết
        </button>
    </div>

    <div class="card">
        <div class="table-toolbar">
            <input type="text" v-model="searchKeyword" class="form-control search-input"
                placeholder="Tìm kiếm bài viết..." />
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th width="60">STT</th>
                        <th width="80">Ảnh</th>
                        <th style="max-width: 250px;">Tiêu đề</th>
                        <th style="white-space: nowrap;">Danh mục</th>
                        <th style="white-space: nowrap;">Loại</th>
                        <th style="white-space: nowrap;">Ngày đăng</th>
                        <th width="120" class="text-right">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(post, index) in posts.data" :key="post.id">
                        <td>{{ (posts.current_page - 1) * posts.per_page + index + 1 }}</td>
                        <td>
                            <div class="thumb">
                                <img v-if="post.image" :src="'/' + post.image" alt="Post" />
                                <div v-else class="no-img">No IMG</div>
                            </div>
                        </td>
                        <td style="max-width: 250px; white-space: normal; word-break: break-word;"
                            class="font-medium text-dark">{{ post.title }}</td>
                        <td style="white-space: nowrap;">
                            <span v-if="post.type === 'news'">
                                {{categories.find(c => c.id === post.category_id)?.name || 'Chưa phân loại'}}
                            </span>
                            <span v-else class="text-gray">-</span>
                        </td>
                        <td style="white-space: nowrap;">
                            <span class="badge" :class="post.type === 'recruitment' ? 'bg-indigo' : 'bg-blue'">
                                {{ post.type === 'recruitment' ? 'Tuyển dụng' : 'Tin tức' }}
                            </span>
                        </td>
                        <td style="white-space: nowrap;">
                            <span class="badge">{{ post.published_at ? post.published_at.split(' ')[0] : '' }}</span>
                        </td>
                        <td class="text-right">
                            <div class="actions">
                                <button @click="openEditModal(post)" class="btn-icon text-blue" title="Sửa">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                </button>
                                <button @click="deletePost(post.id)" class="btn-icon text-red" title="Xóa">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path
                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr v-if="posts.data.length === 0">
                        <td colspan="5" class="text-center py-4 text-gray">Không có bài viết nào.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="pagination-wrap" v-if="posts.links && posts.links.length > 3">
            <div class="pagination">
                <template v-for="(link, i) in posts.links" :key="i">
                    <Link v-if="link.url" :href="link.url" class="page-link" :class="{ active: link.active }"
                        v-html="link.label"></Link>
                    <span v-else class="page-link disabled" v-html="link.label"></span>
                </template>
            </div>
        </div>
    </div>

    <div class="modal-overlay" :class="{ show: isModalOpen }" @click="isModalOpen = false"></div>
    <div class="center-modal" :class="{ show: isModalOpen }">
        <div class="modal-header">
            <h2>{{ isEditing ? 'Cập nhật Bài viết' : 'Thêm Bài viết mới' }}</h2>
            <button class="close-btn" @click="isModalOpen = false">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        <div class="modal-body">
            <form @submit.prevent="submit">
                <div class="form-row">
                    <div class="form-group flex-1">
                        <label>Tiêu đề bài viết <span class="required">*</span></label>
                        <input type="text" v-model="form.title" class="form-control" required />
                        <span class="error" v-if="form.errors.title">{{ form.errors.title }}</span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group flex-1">
                        <label>Loại bài viết</label>
                        <select v-model="form.type" class="form-control">
                            <option value="news">Tin tức</option>
                            <option value="recruitment">Tuyển dụng</option>
                        </select>
                        <span class="error" v-if="form.errors.type">{{ form.errors.type }}</span>
                    </div>
                    <div class="form-group flex-1" v-if="form.type === 'news'">
                        <label>Danh mục tin tức</label>
                        <select v-model="form.category_id" class="form-control">
                            <option :value="null">-- Chọn danh mục --</option>
                            <option v-for="cat in categories" :key="cat.id" :value="cat.id">{{ cat.name }}</option>
                        </select>
                        <span class="error" v-if="form.errors.category_id">{{ form.errors.category_id }}</span>
                    </div>
                    <div class="form-group flex-1" v-else>
                    </div>
                </div>

                <div class="form-row" v-if="form.type === 'recruitment'">
                    <div class="form-group flex-1">
                        <label>Loại công việc</label>
                        <input type="text" v-model="form.job_type" placeholder="VD: Toàn thời gian"
                            class="form-control" />
                    </div>
                    <div class="form-group flex-1">
                        <label>Địa điểm</label>
                        <input type="text" v-model="form.location" placeholder="VD: Thành phố Sơn La"
                            class="form-control" />
                    </div>
                </div>

                <div class="form-row" v-if="form.type === 'recruitment'">
                    <div class="form-group flex-1">
                        <label>Mức lương</label>
                        <input type="text" v-model="form.salary" placeholder="VD: Thỏa thuận + thưởng"
                            class="form-control" />
                    </div>
                    <div class="form-group flex-1">
                        <label>Hạn nộp hồ sơ</label>
                        <input type="date" v-model="form.deadline" class="form-control" />
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group flex-1">
                        <label>Đường dẫn tĩnh</label>
                        <input type="text" v-model="form.slug" class="form-control" />
                        <span class="error" v-if="form.errors.slug">{{ form.errors.slug }}</span>
                    </div>
                    <div class="form-group flex-1">
                        <label>Ngày xuất bản</label>
                        <input type="date" v-model="form.published_at" class="form-control" />
                        <span class="error" v-if="form.errors.published_at">{{ form.errors.published_at }}</span>
                    </div>
                </div>

                <div class="form-group">
                    <label>Tóm tắt</label>
                    <textarea v-model="form.excerpt" class="form-control" rows="3"></textarea>
                    <span class="error" v-if="form.errors.excerpt">{{ form.errors.excerpt }}</span>
                </div>

                <div class="form-group quill-container">
                    <label>Nội dung</label>
                    <QuillEditor ref="quillRef" v-model:content="form.content" contentType="html"
                        :options="editorOptions" theme="snow" />
                    <span class="error" v-if="form.errors.content">{{ form.errors.content }}</span>
                </div>

                <div class="form-group">
                    <label>Hình ảnh đại diện</label>
                    <div v-if="isEditing && currentImage" style="margin-bottom: 10px;">
                        <img :src="'/' + currentImage" alt="Current"
                            style="max-height: 100px; border-radius: 8px; object-fit: cover;" />
                    </div>
                    <input type="file" @input="form.image = $event.target.files[0]" class="form-control file-input"
                        accept="image/*" />
                    <span class="error" v-if="form.errors.image">{{ form.errors.image }}</span>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-default" @click="isModalOpen = false">Hủy</button>
                    <button type="submit" class="btn-primary" :disabled="form.processing">
                        {{ form.processing ? 'Đang xử lý...' : 'Lưu' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
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
    font-weight: 700;
    color: #0f172a;
    margin: 0;
}

.subtitle {
    color: #64748b;
    margin: 0.25rem 0 0 0;
    font-size: 0.9rem;
}

.btn-primary {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: #3b82f6;
    color: white;
    border: none;
    padding: 0.6rem 1.25rem;
    border-radius: 10px;
    font-weight: 500;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.2s;
    box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.2);
}

.btn-primary:hover {
    background: #2563eb;
    transform: translateY(-1px);
}

.btn-primary svg {
    width: 18px;
    height: 18px;
}

.btn-default {
    background: #f1f5f9;
    color: #475569;
    border: none;
    padding: 0.6rem 1.25rem;
    border-radius: 10px;
    font-weight: 500;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.2s;
}

.btn-default:hover {
    background: #e2e8f0;
}

.alert-success {
    background: #ecfdf5;
    color: #059669;
    padding: 1rem;
    border-radius: 12px;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 500;
    font-size: 0.9rem;
    border: 1px solid #a7f3d0;
}

.alert-success svg {
    width: 20px;
    height: 20px;
}

.card {
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    border: 1px solid #f1f5f9;
    overflow: hidden;
}

.table-toolbar {
    padding: 1rem;
    border-bottom: 1px solid #e2e8f0;
}

.search-input {
    max-width: 300px;
}

.table-responsive {
    overflow-x: auto;
}

.table {
    width: 100%;
    border-collapse: collapse;
}

.table th {
    background: #f8fafc;
    color: #64748b;
    font-weight: 600;
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 1rem;
    text-align: left;
    border-bottom: 1px solid #e2e8f0;
}

.table td {
    padding: 1rem;
    vertical-align: middle;
    border-bottom: 1px solid #f1f5f9;
    font-size: 0.9rem;
    color: #475569;
}

.table tr:last-child td {
    border-bottom: none;
}

.table tr:hover {
    background: #f8fafc;
}

.text-right {
    text-align: right;
}

.text-center {
    text-align: center;
}

.font-medium {
    font-weight: 500;
}

.text-dark {
    color: #0f172a;
}

.text-gray {
    color: #94a3b8;
}

.py-4 {
    padding-top: 1.5rem;
    padding-bottom: 1.5rem;
}

.thumb {
    width: 60px;
    height: 40px;
    border-radius: 8px;
    background: #f1f5f9;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

.thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.no-img {
    font-size: 0.6rem;
    color: #94a3b8;
    font-weight: bold;
}

.bg-blue {
    background: #e0f2fe;
    color: #0284c7;
}

.bg-indigo {
    background: #e0e7ff;
    color: #4f46e5;
}

.bg-green {
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
}

.badge {
    background: #eff6ff;
    color: #3b82f6;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
}

.actions {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 0.5rem;
}

.btn-icon {
    background: none;
    border: none;
    cursor: pointer;
    padding: 0.4rem;
    border-radius: 8px;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-icon svg {
    width: 18px;
    height: 18px;
}

.btn-icon:hover {
    background: #f1f5f9;
}

.text-blue {
    color: #3b82f6;
}

.text-red {
    color: #ef4444;
}

/* Pagination Premium */
.pagination-wrap {
    padding: 1.5rem;
    border-top: 1px solid #f1f5f9;
    display: flex;
    justify-content: center;
}

.pagination {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.page-link {
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 36px;
    height: 36px;
    border-radius: 50%;
    background: transparent;
    border: none;
    color: #64748b;
    text-decoration: none;
    font-size: 0.95rem;
    font-weight: 600;
    transition: all 0.25s ease;
    cursor: pointer;
}

.page-link:hover:not(.disabled) {
    background: #f1f5f9;
    color: #0f172a;
    transform: translateY(-2px);
}

.page-link.active {
    background: #3b82f6;
    color: #ffffff;
    box-shadow: 0 4px 10px rgba(59, 130, 246, 0.35);
}

.page-link.disabled {
    opacity: 0.4;
    pointer-events: none;
    cursor: default;
}

/* Slide Modal */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(15, 23, 42, 0.4);
    backdrop-filter: blur(4px);
    z-index: 1000;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.modal-overlay.show {
    opacity: 1;
    visibility: visible;
}

.center-modal {
    position: fixed;
    top: 50%;
    left: 50%;
    width: 100%;
    max-width: 700px;
    max-height: 90vh;
    background: #ffffff;
    z-index: 1001;
    border-radius: 12px;
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    transform: translate(-50%, -50%) scale(0.95);
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    flex-direction: column;
}

.center-modal.show {
    transform: translate(-50%, -50%) scale(1);
    opacity: 1;
    visibility: visible;
}

.modal-header {
    padding: 1.5rem;
    border-bottom: 1px solid #e2e8f0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-header h2 {
    margin: 0;
    font-size: 1.25rem;
    color: #0f172a;
}

.close-btn {
    background: none;
    border: none;
    cursor: pointer;
    color: #64748b;
    border-radius: 50%;
    padding: 0.5rem;
    transition: background 0.2s;
}

.close-btn:hover {
    background: #f1f5f9;
    color: #0f172a;
}

.close-btn svg {
    width: 20px;
    height: 20px;
}

.modal-body {
    padding: 1.5rem;
    flex: 1;
    overflow-y: auto;
}

.modal-footer {
    padding-top: 1.5rem;
    margin-top: 1rem;
    border-bottom: none;
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
}

/* Form Styles */
.form-group {
    margin-bottom: 1.25rem;
}

.form-row {
    display: flex;
    gap: 1rem;
    margin-bottom: 1.25rem;
}

.form-row .form-group {
    margin-bottom: 0;
}

.flex-1 {
    flex: 1;
}

.form-group label {
    display: block;
    font-size: 0.85rem;
    font-weight: 600;
    color: #334155;
    margin-bottom: 0.5rem;
}

.required {
    color: #ef4444;
}

.form-control {
    width: 100%;
    padding: 0.65rem 1rem;
    border: 1px solid #cbd5e1;
    border-radius: 10px;
    font-size: 0.95rem;
    color: #0f172a;
    background: #ffffff;
    transition: all 0.2s;
    font-family: inherit;
    box-sizing: border-box;
}

.form-control:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.file-input {
    padding: 0.5rem;
    font-size: 0.85rem;
}

textarea.form-control {
    resize: vertical;
}

.error {
    display: block;
    color: #ef4444;
    font-size: 0.8rem;
    margin-top: 0.4rem;
}

.quill-container :deep(.ql-container) {
    min-height: 250px;
    font-size: 0.95rem;
    font-family: inherit;
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
    border-color: #cbd5e1;
    background: #ffffff;
}

.quill-container :deep(.ql-toolbar) {
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    border-color: #cbd5e1;
    background: #f8fafc;
}

.quill-container :deep(.ql-editor) {
    min-height: 250px;
}
</style>

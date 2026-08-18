<script setup>
import { Head, useForm, router, Link } from '@inertiajs/vue3';
import AdminLayout from '../Layouts/AdminLayout.vue';
import { ref, watch } from 'vue';

defineOptions({ layout: AdminLayout });

const props = defineProps({
    products: Object,
    filters: Object,
});

const isModalOpen = ref(false);
const isEditing = ref(false);
const previewImages = ref([]);
const fileInput = ref(null);
const searchKeyword = ref(props.filters?.search || '');

const form = useForm({
    id: null,
    name: '',
    slug: '',
    price: '',
    short_description: '',
    description: '',
    use_1: '',
    use_2: '',
    use_3: '',
    usage_guide: '',
    notice: '',
    preservation: '',
    is_active: 1,
    is_featured: 0,
    images: [],
    existing_gallery: [],
    featured_image: '',
    _method: 'POST'
});

const openCreateModal = () => {
    isEditing.value = false;
    form.reset();
    form.clearErrors();
    form._method = 'POST';
    form.is_featured = 0;
    form.images = [];
    form.existing_gallery = [];
    form.featured_image = '';
    previewImages.value = [];
    if(fileInput.value) fileInput.value.value = '';
    isModalOpen.value = true;
};

const openEditModal = (product) => {
    isEditing.value = true;
    form.clearErrors();
    form.id = product.id;
    form.name = product.name;
    form.slug = product.slug;
    form.price = product.price;
    form.short_description = product.short_description;
    form.description = product.description || '';
    form.use_1 = product.use_1 || '';
    form.use_2 = product.use_2 || '';
    form.use_3 = product.use_3 || '';
    form.usage_guide = product.usage_guide || '';
    form.notice = product.notice || '';
    form.preservation = product.preservation || '';
    form.is_active = product.is_active;
    form.is_featured = product.is_featured;
    form.images = [];
    let gal = Array.isArray(product.gallery) ? product.gallery : [];
    if (gal.length === 0 && product.image) {
        gal = [product.image];
    }
    form.existing_gallery = [...gal];
    form.featured_image = product.image || '';
    previewImages.value = [];
    if(fileInput.value) fileInput.value.value = '';
    form._method = 'PUT'; // Use PUT for updating with form data spoofing
    isModalOpen.value = true;
};

const handleFileSelect = (event) => {
    const files = Array.from(event.target.files);
    form.images = [...form.images, ...files];
    
    files.forEach(file => {
        const reader = new FileReader();
        reader.onload = (e) => {
            previewImages.value.push({ file: file, url: e.target.result });
        };
        reader.readAsDataURL(file);
    });
};

const removeNewImage = (index) => {
    form.images.splice(index, 1);
    previewImages.value.splice(index, 1);
};

const removeExistingImage = (index) => {
    const removedPath = form.existing_gallery[index];
    form.existing_gallery.splice(index, 1);
    // If the removed image was featured, un-feature it
    if ('/' + removedPath === form.featured_image || removedPath === form.featured_image) {
        form.featured_image = form.existing_gallery.length > 0 ? form.existing_gallery[0] : '';
    }
};

const setFeaturedImage = (path, isNew = false) => {
    form.featured_image = isNew ? path : path;
};

const submit = () => {
    if (isEditing.value) {
        form.post(route('admin.products.update', form.id), {
            preserveScroll: true,
            onSuccess: () => { isModalOpen.value = false; }
        });
    } else {
        form.post(route('admin.products.store'), {
            preserveScroll: true,
            onSuccess: () => { isModalOpen.value = false; }
        });
    }
};

const deleteProduct = (id) => {
    if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) {
        router.delete(route('admin.products.destroy', id), {
            preserveScroll: true
        });
    }
};

const formatPrice = (price) => {
    if (!price) return 'Liên hệ';
    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(price);
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

let searchTimeout = null;
watch(searchKeyword, (value) => {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        router.get(route('admin.products.index'), { search: value }, {
            preserveState: true,
            replace: true
        });
    }, 300);
});
</script>

<template>
    <Head title="Quản lý Sản phẩm" />

    <div class="page-header">
        <div>
            <h1 class="title">Sản phẩm</h1>
        </div>
        <button @click="openCreateModal" class="btn-primary">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Thêm sản phẩm
        </button>
    </div>

    <!-- Notification -->
    <div v-if="$page.props.flash && $page.props.flash.message" class="alert-success">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
        {{ $page.props.flash.message }}
    </div>

    <div class="card">
        <div class="table-toolbar">
            <input type="text" v-model="searchKeyword" class="form-control search-input"
                placeholder="Tìm kiếm sản phẩm..." />
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th width="60">STT</th>
                        <th width="80">Ảnh</th>
                        <th>Tên sản phẩm</th>

                        <th>Giá</th>
                        <th>Trạng thái</th>
                        <th>Nổi bật</th>
                        <th width="120" class="text-right">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(product, index) in products.data" :key="product.id">
                        <td>{{ (products.current_page - 1) * products.per_page + index + 1 }}</td>
                        <td>
                            <div class="thumb">
                                <img v-if="product.image" :src="'/' + product.image" alt="Product" />
                                <div v-else class="no-img">No IMG</div>
                            </div>
                        </td>
                        <td class="font-medium text-dark">{{ product.name }}</td>

                        <td>{{ formatPrice(product.price) }}</td>
                        <td>
                            <span :class="['status-dot', product.is_active ? 'active' : 'inactive']"></span>
                            {{ product.is_active ? 'Hiển thị' : 'Ẩn' }}
                        </td>
                        <td>
                            <span :class="['status-dot', product.is_featured ? 'active' : 'inactive']"></span>
                            {{ product.is_featured ? 'Nổi bật' : 'Thường' }}
                        </td>
                        <td class="text-right">
                            <div class="actions">
                                <button @click="openEditModal(product)" class="btn-icon text-blue" title="Sửa">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                </button>
                                <button @click="deleteProduct(product.id)" class="btn-icon text-red" title="Xóa">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr v-if="products.data.length === 0">
                        <td colspan="8" class="text-center py-4 text-gray">Không có sản phẩm nào.</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- Pagination Component placeholder -->
        <div class="pagination-wrap" v-if="products.links && products.links.length > 3">
            <div class="pagination">
                <template v-for="(link, i) in products.links" :key="i">
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

    <!-- Slide-over Modal -->
    <div class="modal-overlay" :class="{ show: isModalOpen }" @click="isModalOpen = false"></div>
    <div class="center-modal" :class="{ show: isModalOpen }">
        <div class="modal-header">
            <h2>{{ isEditing ? 'Cập nhật Sản phẩm' : 'Thêm Sản phẩm mới' }}</h2>
            <button class="close-btn" @click="isModalOpen = false">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>
        <div class="modal-body">
            <form @submit.prevent="submit">
                <div class="form-group">
                    <label>Tên sản phẩm <span class="required">*</span></label>
                    <input type="text" v-model="form.name" class="form-control" required />
                    <span class="error" v-if="form.errors.name">{{ form.errors.name }}</span>
                </div>

                <div class="form-row">

                    <div class="form-group flex-1">
                        <label>Giá (VNĐ)</label>
                        <input type="number" v-model="form.price" class="form-control" />
                        <span class="error" v-if="form.errors.price">{{ form.errors.price }}</span>
                    </div>
                </div>

                <div class="form-group">
                    <label>Đường dẫn tĩnh</label>
                    <input type="text" v-model="form.slug" class="form-control" />
                    <span class="error" v-if="form.errors.slug">{{ form.errors.slug }}</span>
                </div>

                <div class="form-group">
                    <label>Mô tả ngắn (Hiển thị ở danh sách)</label>
                    <textarea v-model="form.short_description" class="form-control" rows="2"></textarea>
                    <span class="error" v-if="form.errors.short_description">{{ form.errors.short_description }}</span>
                </div>

                <div class="form-group">
                    <label>Mô tả chi tiết (Thành phần, đối tượng sử dụng...)</label>
                    <textarea v-model="form.description" class="form-control" rows="4" placeholder="Nhập mô tả chi tiết của sản phẩm..."></textarea>
                    <span class="error" v-if="form.errors.description">{{ form.errors.description }}</span>
                </div>

                <h3 class="form-section-title">Công dụng</h3>
                <div class="form-group">
                    <label>Công dụng 1</label>
                    <input type="text" v-model="form.use_1" class="form-control" placeholder="Ví dụ: Dùng để tắm, gội hàng ngày cho bé..." />
                    <span class="error" v-if="form.errors.use_1">{{ form.errors.use_1 }}</span>
                </div>
                <div class="form-group">
                    <label>Công dụng 2</label>
                    <input type="text" v-model="form.use_2" class="form-control" placeholder="Ví dụ: Góp phần làm dịu mát da..." />
                    <span class="error" v-if="form.errors.use_2">{{ form.errors.use_2 }}</span>
                </div>
                <div class="form-group">
                    <label>Công dụng 3</label>
                    <input type="text" v-model="form.use_3" class="form-control" placeholder="Ví dụ: Giúp duy trì độ ẩm tự nhiên..." />
                    <span class="error" v-if="form.errors.use_3">{{ form.errors.use_3 }}</span>
                </div>

                <h3 class="form-section-title">Hướng dẫn & Lưu ý</h3>
                <div class="form-group">
                    <label>Hướng dẫn sử dụng</label>
                    <textarea v-model="form.usage_guide" class="form-control" rows="3" placeholder="Nhập hướng dẫn sử dụng..."></textarea>
                    <span class="error" v-if="form.errors.usage_guide">{{ form.errors.usage_guide }}</span>
                </div>

                <div class="form-group">
                    <label>Lưu ý</label>
                    <textarea v-model="form.notice" class="form-control" rows="2" placeholder="Nhập các lưu ý khi sử dụng..."></textarea>
                    <span class="error" v-if="form.errors.notice">{{ form.errors.notice }}</span>
                </div>

                <div class="form-group">
                    <label>Bảo quản</label>
                    <textarea v-model="form.preservation" class="form-control" rows="2" placeholder="Nhập hướng dẫn bảo quản..."></textarea>
                    <span class="error" v-if="form.errors.preservation">{{ form.errors.preservation }}</span>
                </div>

                <div class="form-group">
                    <label>Thư viện hình ảnh</label>
                    <input type="file" ref="fileInput" @change="handleFileSelect" class="form-control file-input" accept="image/*" multiple />
                    <span class="error" v-if="form.errors.images">{{ form.errors.images }}</span>
                    
                    <div class="gallery-preview">
                        <!-- Existing Images -->
                        <div v-for="(img, idx) in form.existing_gallery" :key="'ex-'+idx" class="gallery-item" :class="{ 'is-featured': form.featured_image === img || form.featured_image === '/' + img }">
                            <img :src="'/' + img" alt="Preview" />
                            <div class="gallery-actions">
                                <button type="button" class="action-btn star-btn" @click="setFeaturedImage(img)" title="Đặt làm ảnh bìa">
                                    <svg viewBox="0 0 24 24" :fill="form.featured_image === img || form.featured_image === '/' + img ? 'currentColor' : 'none'" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                </button>
                                <button type="button" class="action-btn trash-btn" @click="removeExistingImage(idx)" title="Xóa ảnh">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                </button>
                            </div>
                        </div>

                        <!-- New Images -->
                        <div v-for="(preview, idx) in previewImages" :key="'new-'+idx" class="gallery-item" :class="{ 'is-featured': form.featured_image === preview.file.name }">
                            <img :src="preview.url" alt="Preview" />
                            <div class="gallery-actions">
                                <button type="button" class="action-btn star-btn" @click="setFeaturedImage(preview.file.name, true)" title="Đặt làm ảnh bìa">
                                    <svg viewBox="0 0 24 24" :fill="form.featured_image === preview.file.name ? 'currentColor' : 'none'" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                </button>
                                <button type="button" class="action-btn trash-btn" @click="removeNewImage(idx)" title="Xóa ảnh">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="form-group switch-group">
                    <label class="switch">
                        <input type="checkbox" v-model="form.is_active" :true-value="1" :false-value="0" />
                        <span class="slider round"></span>
                    </label>
                    <span class="switch-label">Hiển thị trên website</span>
                </div>

                <div class="form-group switch-group">
                    <label class="switch">
                        <input type="checkbox" v-model="form.is_featured" :true-value="1" :false-value="0" />
                        <span class="slider round"></span>
                    </label>
                    <span class="switch-label">Nổi bật trên trang chủ</span>
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
/* Scoped Admin CSS for Premium Look */
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

.form-section-title {
    font-size: 1.05rem;
    font-weight: 700;
    color: #1e293b;
    margin: 1.5rem 0 1rem 0;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid #f1f5f9;
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
.btn-primary svg { width: 18px; height: 18px; }

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
.btn-default:hover { background: #e2e8f0; }

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
.alert-success svg { width: 20px; height: 20px; }

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

.table tr:last-child td { border-bottom: none; }
.table tr:hover { background: #f8fafc; }

.text-right { text-align: right; }
.text-center { text-align: center; }
.font-medium { font-weight: 500; }
.text-dark { color: #0f172a; }
.text-gray { color: #94a3b8; }
.py-4 { padding-top: 1.5rem; padding-bottom: 1.5rem; }

.thumb {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    background: #f1f5f9;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}
.thumb img { width: 100%; height: 100%; object-fit: cover; }
.no-img { font-size: 0.6rem; color: #94a3b8; font-weight: bold; }

.badge {
    background: #eff6ff;
    color: #3b82f6;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
}

.status-dot {
    display: inline-block;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    margin-right: 6px;
}
.status-dot.active { background: #10b981; }
.status-dot.inactive { background: #cbd5e1; }

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

/* Slide Modal */
.modal-overlay {
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(15, 23, 42, 0.4);
    backdrop-filter: blur(4px);
    z-index: 1000;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}
.modal-overlay.show { opacity: 1; visibility: visible; }

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
    box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04);
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
.modal-header h2 { margin: 0; font-size: 1.25rem; color: #0f172a; }
.close-btn { background: none; border: none; cursor: pointer; color: #64748b; border-radius: 50%; padding: 0.5rem; transition: background 0.2s; }
.close-btn:hover { background: #f1f5f9; color: #0f172a; }
.close-btn svg { width: 20px; height: 20px; }

.modal-body {
    padding: 1.5rem;
    flex: 1;
    overflow-y: auto;
}

.modal-footer {
    padding-top: 1.5rem;
    margin-top: 1rem;
    border-top: 1px solid #e2e8f0;
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
}

/* Form Styles */
.form-group { margin-bottom: 1.25rem; }
.form-row { display: flex; gap: 1rem; margin-bottom: 1.25rem; }
.form-row .form-group { margin-bottom: 0; }
.flex-1 { flex: 1; }
.form-group label { display: block; font-size: 0.85rem; font-weight: 600; color: #334155; margin-bottom: 0.5rem; }
.required { color: #ef4444; }

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
.form-control:focus { outline: none; border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1); }
.file-input { padding: 0.5rem; font-size: 0.85rem; }
textarea.form-control { resize: vertical; }

.error { display: block; color: #ef4444; font-size: 0.8rem; margin-top: 0.4rem; }

/* Switch Toggle */
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

/* Gallery Preview */
.gallery-preview {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
    gap: 10px;
    margin-top: 10px;
}
.gallery-item {
    position: relative;
    border-radius: 8px;
    overflow: hidden;
    border: 2px solid transparent;
    aspect-ratio: 1 / 1;
    background: #f1f5f9;
}
.gallery-item.is-featured {
    border-color: #3b82f6;
}
.gallery-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.gallery-actions {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    opacity: 0;
    transition: opacity 0.2s;
}
.gallery-item:hover .gallery-actions {
    opacity: 1;
}
.action-btn {
    background: white;
    border: none;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    cursor: pointer;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 14px;
}
.action-btn:hover {
    transform: scale(1.1);
}
.action-btn svg {
    width: 16px;
    height: 16px;
}
.star-btn { color: #f59e0b; }
.trash-btn { color: #ef4444; }
.mt-1 { margin-top: 0.25rem; }
.block { display: block; }
</style>

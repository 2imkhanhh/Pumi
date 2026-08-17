<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '../Layouts/AdminLayout.vue';

defineOptions({ layout: AdminLayout });

const props = defineProps({
    reviews: Object,
});

const toggleApproval = (review) => {
    router.put(route('admin.reviews.update', review.id), {
        is_approved: !review.is_approved
    }, {
        preserveScroll: true
    });
};

const deleteReview = (id) => {
    if (confirm('Bạn có chắc chắn muốn xóa đánh giá này?')) {
        router.delete(route('admin.reviews.destroy', id), {
            preserveScroll: true
        });
    }
};

</script>

<template>
    <Head title="Quản lý Đánh giá" />

    <div class="page-header">
        <div>
            <h1 class="title">Đánh giá Sản phẩm</h1>
            <p class="subtitle">Quản lý và kiểm duyệt các đánh giá từ khách hàng.</p>
        </div>
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
                        <th width="60">STT</th>
                        <th>Sản phẩm</th>
                        <th>Khách hàng</th>
                        <th>Đánh giá</th>
                        <th>Nội dung</th>
                        <th>Trạng thái</th>
                        <th width="120" class="text-right">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(review, index) in reviews.data" :key="review.id">
                        <td>{{ (reviews.current_page - 1) * reviews.per_page + index + 1 }}</td>
                        <td class="font-medium text-dark">
                            <a :href="'/san-pham/' + (review.product ? review.product.slug : '')" target="_blank" class="text-blue">
                                {{ review.product ? review.product.name : 'Sản phẩm đã xóa' }}
                            </a>
                        </td>
                        <td>
                            <div class="font-medium">{{ review.fullname }}</div>
                            <div class="text-gray" style="font-size: 0.8rem">{{ review.email }}</div>
                        </td>
                        <td>
                            <div style="display:flex; gap:2px; color: #f59e0b;">
                                <svg v-for="i in review.rating" :key="'full'+i" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                <svg v-for="i in 5 - review.rating" :key="'empty'+i" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#ccc" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                            </div>
                        </td>
                        <td>
                            <div style="max-width: 250px; white-space: pre-wrap; font-size: 0.85rem;">{{ review.note }}</div>
                        </td>
                        <td>
                            <button @click="toggleApproval(review)" :class="['badge-btn', review.is_approved ? 'approved' : 'pending']">
                                {{ review.is_approved ? 'Đã duyệt' : 'Chờ duyệt' }}
                            </button>
                        </td>
                        <td class="text-right">
                            <div class="actions">
                                <button @click="deleteReview(review.id)" class="btn-icon text-red" title="Xóa">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr v-if="reviews.data.length === 0">
                        <td colspan="7" class="text-center py-4 text-gray">Không có đánh giá nào.</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="pagination-wrap" v-if="reviews.links && reviews.links.length > 3">
            <div class="pagination">
                <template v-for="(link, i) in reviews.links" :key="i">
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
.text-blue { color: #3b82f6; text-decoration: none; }
.text-blue:hover { text-decoration: underline; }
.text-warning { color: #f59e0b; letter-spacing: 2px;}
.py-4 { padding-top: 1.5rem; padding-bottom: 1.5rem; }

.badge-btn {
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: all 0.2s;
}
.badge-btn.approved { background: #d1fae5; color: #059669; }
.badge-btn.pending { background: #fef3c7; color: #d97706; }
.badge-btn:hover { opacity: 0.8; }

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
.text-red { color: #ef4444; }

.pagination-wrap { padding: 1.5rem; border-top: 1px solid #f1f5f9; display: flex; justify-content: center; }
.pagination { display: inline-flex; align-items: center; gap: 0.5rem; }
.page-link { display: flex; align-items: center; justify-content: center; min-width: 36px; height: 36px; border-radius: 50%; background: transparent; border: none; color: #64748b; text-decoration: none; font-size: 0.95rem; font-weight: 600; transition: all 0.25s ease; cursor: pointer; }
.page-link:hover:not(.disabled) { background: #f1f5f9; color: #0f172a; transform: translateY(-2px); }
.page-link.active { background: #3b82f6; color: #ffffff; box-shadow: 0 4px 10px rgba(59, 130, 246, 0.35); }
.page-link.disabled { opacity: 0.4; pointer-events: none; cursor: default; }
</style>

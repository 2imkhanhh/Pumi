<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AdminLayout from '../Layouts/AdminLayout.vue';
import { ref } from 'vue';
import { QuillEditor } from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';

defineOptions({ layout: AdminLayout });

const props = defineProps({
    settings: Object,
});

const activeTab = ref('general');

const form = useForm({
    company_name: props.settings.company_name || '',
    phone: props.settings.phone || '',
    email: props.settings.email || '',
    address: props.settings.address || '',
    website: props.settings.website || '',
    map_iframe: props.settings.map_iframe || '',
    facebook: props.settings.facebook || '',
    tiktok: props.settings.tiktok || '',
    shopee: props.settings.shopee || '',

    // Homepage Content
    home_banners: (() => {
        let initialBanners = [];
        if (props.settings.home_banners) {
            try {
                initialBanners = JSON.parse(props.settings.home_banners).map((b, i) => ({
                    id: Date.now() + i,
                    old_image: b.img,
                    image: null,
                    link: b.link
                }));
            } catch (e) { }
        } else {
            if (props.settings.home_banner_1) initialBanners.push({ id: 1, old_image: props.settings.home_banner_1, image: null, link: props.settings.home_banner_1_link || '' });
            if (props.settings.home_banner_2) initialBanners.push({ id: 2, old_image: props.settings.home_banner_2, image: null, link: props.settings.home_banner_2_link || '' });
            if (props.settings.home_banner_3) initialBanners.push({ id: 3, old_image: props.settings.home_banner_3, image: null, link: props.settings.home_banner_3_link || '' });
        }
        if (initialBanners.length === 0) {
            initialBanners.push({ id: Date.now(), old_image: null, image: null, link: '' });
        }
        return initialBanners;
    })(),
    home_welcome_title: props.settings.home_welcome_title || '',
    home_welcome_subtitle: props.settings.home_welcome_subtitle || '',
    home_welcome_content: props.settings.home_welcome_content || '',
    home_about_title: props.settings.home_about_title || '',
    home_about_subtitle: props.settings.home_about_subtitle || '',
    home_about_content: props.settings.home_about_content || '',
    home_partner_title: props.settings.home_partner_title || '',
    home_partner_subtitle: props.settings.home_partner_subtitle || '',
    home_partners: (() => {
        let initial = [];
        if (props.settings.home_partners) {
            try { initial = JSON.parse(props.settings.home_partners).map((b, i) => ({ id: Date.now() + i, old_image: b.img, image: null })); } catch (e) { }
        }
        return initial;
    })(),

    // About Page Content
    about_welcome_title: props.settings.about_welcome_title || '',
    about_welcome_subtitle: props.settings.about_welcome_subtitle || '',
    about_welcome_content: props.settings.about_welcome_content || '',
    about_story_title: props.settings.about_story_title || '',
    about_story_subtitle: props.settings.about_story_subtitle || '',
    about_story_content: props.settings.about_story_content || '',
    about_message_title: props.settings.about_message_title || '',
    about_message_subtitle: props.settings.about_message_subtitle || '',
    about_message_content: props.settings.about_message_content || '',
    about_herb_title: props.settings.about_herb_title || '',
    about_herb_content: props.settings.about_herb_content || '',
    about_cgmp_title: props.settings.about_cgmp_title || '',
    about_mission_title: props.settings.about_mission_title || '',
    about_mission_content: props.settings.about_mission_content || '',
    about_vision_title: props.settings.about_vision_title || '',
    about_vision_content: props.settings.about_vision_content || '',
    about_core_1_title: props.settings.about_core_1_title || '',
    about_core_1_content: props.settings.about_core_1_content || '',
    about_core_2_title: props.settings.about_core_2_title || '',
    about_core_2_content: props.settings.about_core_2_content || '',
    about_core_3_title: props.settings.about_core_3_title || '',
    about_core_3_content: props.settings.about_core_3_content || '',
    about_leader_1_name: props.settings.about_leader_1_name || '',
    about_leader_1_role: props.settings.about_leader_1_role || '',
    about_leader_2_name: props.settings.about_leader_2_name || '',
    about_leader_2_role: props.settings.about_leader_2_role || '',
    about_culture_title: props.settings.about_culture_title || '',
    about_culture_content: props.settings.about_culture_content || '',
    about_activity_title: props.settings.about_activity_title || '',
    about_activity_subtitle: props.settings.about_activity_subtitle || '',
    about_activity_content: props.settings.about_activity_content || '',

    // Partners Page Content
    partners_banner: null,
    partners_ingredient_title: props.settings.partners_ingredient_title || '',
    ingredient_partners: (() => {
        let initial = [];
        if (props.settings.ingredient_partners) {
            try { initial = JSON.parse(props.settings.ingredient_partners).map((b, i) => ({ id: Date.now() + i, name: b.name, description: b.description, old_image: b.img, image: null })); } catch (e) { }
        }
        return initial;
    })(),
    partners_hospital_title: props.settings.partners_hospital_title || '',
    partners_hospital_desc: props.settings.partners_hospital_desc || '',
    hospital_partners: (() => {
        let initial = [];
        if (props.settings.hospital_partners) {
            try { initial = JSON.parse(props.settings.hospital_partners).map((b, i) => ({ id: Date.now() + i, old_image: b.img, image: null })); } catch (e) { }
        }
        return initial;
    })(),
    partners_media_title: props.settings.partners_media_title || '',
    partners_media_desc: props.settings.partners_media_desc || '',
    media_partners: (() => {
        let initial = [];
        if (props.settings.media_partners) {
            try { initial = JSON.parse(props.settings.media_partners).map((b, i) => ({ id: Date.now() + i, old_image: b.img, image: null })); } catch (e) { }
        }
        return initial;
    })(),

    // Image and File inputs
    home_video: null,
    logo: null,
    footer_logo: null,
    home_middle_banner: null,
    about_banner: null,
    about_welcome_image: null,
    about_story_image: null,
    about_message_image: null,
    about_herb_image: null,
    about_cgmp_image: null,
    about_mission_image: null,
    about_vision_image: null,
    about_core_1_image: null,
    about_core_2_image: null,
    about_core_3_image: null,
    about_leader_1_image: null,
    about_leader_2_image: null,
    about_activity_image: null,

    // Contact Page
    contact_stores: (() => {
        let initial = [];
        if (props.settings.contact_stores) {
            try { initial = JSON.parse(props.settings.contact_stores).map((b, i) => ({ id: Date.now() + i, name: b.name, address: b.address, phone: b.phone })); } catch (e) { }
        }
        return initial;
    })(),

    _method: 'POST'
});

const addContactStore = () => form.contact_stores.push({ id: Date.now(), name: '', address: '', phone: '' });
const removeContactStore = (index) => form.contact_stores.splice(index, 1);

const handleFileChange = (e, key) => {
    form[key] = e.target.files[0];
};

const handleBannerFileChange = (e, index) => {
    form.home_banners[index].image = e.target.files[0];
};

const addBanner = () => {
    form.home_banners.push({ id: Date.now(), old_image: null, image: null, link: '' });
};

const removeBanner = (index) => {
    form.home_banners.splice(index, 1);
};

const handleDynamicFileChange = (e, index, field) => {
    form[field][index].image = e.target.files[0];
};

const addHomePartner = () => form.home_partners.push({ id: Date.now(), old_image: null, image: null });
const removeHomePartner = (index) => form.home_partners.splice(index, 1);

const addIngredientPartner = () => form.ingredient_partners.push({ id: Date.now(), name: '', description: '', old_image: null, image: null });
const removeIngredientPartner = (index) => form.ingredient_partners.splice(index, 1);

const addHospitalPartner = () => form.hospital_partners.push({ id: Date.now(), old_image: null, image: null });
const removeHospitalPartner = (index) => form.hospital_partners.splice(index, 1);

const addMediaPartner = () => form.media_partners.push({ id: Date.now(), old_image: null, image: null });
const removeMediaPartner = (index) => form.media_partners.splice(index, 1);

const handleMultipleFilesChange = (e, field) => {
    const files = e.target.files;
    for (let i = 0; i < files.length; i++) {
        form[field].push({
            id: Date.now() + i + Math.random(),
            old_image: null,
            image: files[i],
            preview: URL.createObjectURL(files[i])
        });
    }
    e.target.value = '';
};

const submit = () => {
    form.post(route('admin.settings.store'), {
        preserveScroll: true,
        forceFormData: true,
    });
};
</script>

<template>

    <Head title="Nội dung website" />

    <div class="page-header">
        <div>
            <h1 class="title">Nội dung website</h1>
        </div>
    </div>
    <!-- Tab Navigation -->
    <div class="tabs-nav">
        <button type="button" class="tab-btn" :class="{ active: activeTab === 'general' }"
            @click="activeTab = 'general'">
            Cấu hình chung
        </button>
        <button type="button" class="tab-btn" :class="{ active: activeTab === 'homepage' }"
            @click="activeTab = 'homepage'">
            Trang chủ
        </button>
        <button type="button" class="tab-btn" :class="{ active: activeTab === 'about' }" @click="activeTab = 'about'">
            Trang giới thiệu
        </button>
        <button type="button" class="tab-btn" :class="{ active: activeTab === 'partners_page' }"
            @click="activeTab = 'partners_page'">
            Trang đối tác
        </button>
        <button type="button" class="tab-btn" :class="{ active: activeTab === 'contact_page' }"
            @click="activeTab = 'contact_page'">
            Trang liên hệ
        </button>
    </div>

    <form @submit.prevent="submit" class="settings-form" novalidate>
        <!-- Tab 1 -->
        <div v-show="activeTab === 'general'" class="card">
            <div class="card-body">
                <h3 class="section-title">Thông tin doanh nghiệp</h3>
                <div class="grid-2">
                    <div class="form-group">
                        <label>Tên công ty / Cửa hàng</label>
                        <input type="text" v-model="form.company_name" class="form-control"
                            placeholder="Pumi - Thảo mộc cho người Việt" />
                    </div>

                    <div class="form-group">
                        <label>Đường dẫn Website</label>
                        <input type="url" v-model="form.website" class="form-control" placeholder="https://pumi.vn" />
                    </div>

                    <div class="form-group">
                        <label>Số điện thoại (Hotline)</label>
                        <input type="text" v-model="form.phone" class="form-control" placeholder="0986 127 635" />
                    </div>

                    <div class="form-group">
                        <label>Email liên hệ</label>
                        <input type="email" v-model="form.email" class="form-control" placeholder="contact@pumi.vn" />
                    </div>
                </div>

                <div class="form-group mt-3">
                    <label>Địa chỉ</label>
                    <input type="text" v-model="form.address" class="form-control" placeholder="309a Lê Duẩn, Sơn La" />
                </div>

                <div class="grid-2 mt-3">
                    <div class="form-group">
                        <label>Logo Website</label>
                        <div class="flex items-center gap-3">
                            <img v-if="settings.logo" :src="'/' + settings.logo" class="thumb-img" alt="Logo" />
                            <input type="file" @change="handleFileChange($event, 'logo')" class="form-control"
                                accept="image/*" />
                        </div>
                        <p class="text-sm text-gray mt-1">Để trống nếu giữ nguyên.</p>
                    </div>

                    <div class="form-group">
                        <label>Logo chân trang</label>
                        <div class="flex items-center gap-3">
                            <img v-if="settings.footer_logo" :src="'/' + settings.footer_logo" class="thumb-img"
                                alt="Footer Logo" />
                            <input type="file" @change="handleFileChange($event, 'footer_logo')" class="form-control"
                                accept="image/*" />
                        </div>
                        <p class="text-sm text-gray mt-1">Để trống nếu giữ nguyên.</p>
                    </div>
                </div>

                <h3 class="section-title mt-4">Mạng xã hội</h3>
                <div class="grid-2">
                    <div class="form-group">
                        <label>Link Facebook</label>
                        <input type="url" v-model="form.facebook" class="form-control"
                            placeholder="https://facebook.com/..." />
                    </div>

                    <div class="form-group">
                        <label>Link Tiktok</label>
                        <input type="url" v-model="form.tiktok" class="form-control"
                            placeholder="https://tiktok.com/..." />
                    </div>

                    <div class="form-group">
                        <label>Link Shopee</label>
                        <input type="url" v-model="form.shopee" class="form-control"
                            placeholder="https://shopee.vn/..." />
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab 2 -->
        <div v-show="activeTab === 'homepage'" class="card">
            <div class="card-body">
                <h3 class="section-title">Banners Trang chủ</h3>

                <div v-for="(banner, index) in form.home_banners" :key="banner.id"
                    class="banner-box p-3 mb-3 border rounded relative">
                    <button type="button" @click="removeBanner(index)"
                        class="absolute top-2 right-2 text-red-500 hover:text-red-700"
                        style="position: absolute; top: 10px; right: 10px; background: none; border: none; color: #ef4444; cursor: pointer;">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                            </path>
                        </svg>
                    </button>
                    <h4 class="font-medium mb-2">Banner {{ index + 1 }}</h4>
                    <div class="grid-2">
                        <div class="form-group">
                            <label>Hình ảnh Banner</label>
                            <div class="flex items-center gap-3">
                                <img v-if="banner.old_image && !banner.image" :src="'/' + banner.old_image"
                                    class="thumb-img" style="max-height: 80px;" alt="Banner" />
                                <input type="file" @change="handleBannerFileChange($event, index)" class="form-control"
                                    accept="image/*" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Link liên kết Banner</label>
                            <input type="text" v-model="banner.link" class="form-control" placeholder="#" />
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button type="button" @click="addBanner" class="btn-secondary"
                        style="padding: 0.5rem 1rem; border: 1px dashed #3b82f6; color: #3b82f6; background: transparent; border-radius: 8px; cursor: pointer; font-weight: 500;">
                        + Thêm Banner mới
                    </button>
                </div>

                <h3 class="section-title mt-4">Phần Chào Mừng</h3>
                <div class="grid-2">
                    <div class="form-group">
                        <label>Tiêu đề chào mừng</label>
                        <input type="text" v-model="form.home_welcome_title" class="form-control"
                            placeholder="Pumi Việt Nam" />
                    </div>
                    <div class="form-group">
                        <label>Tiêu đề phụ chào mừng</label>
                        <input type="text" v-model="form.home_welcome_subtitle" class="form-control"
                            placeholder="Xin Chào!" />
                    </div>
                </div>
                <div class="form-group quill-container">
                    <label>Nội dung chào mừng</label>
                    <QuillEditor v-model:content="form.home_welcome_content" contentType="html" theme="snow" />
                </div>

                <h3 class="section-title mt-4">Phần Video giới thiệu</h3>
                <div class="form-group">
                    <label>Video Trang chủ (File MP4)</label>
                    <div class="flex items-center gap-3">
                        <video v-if="settings.home_video" :src="'/' + settings.home_video" class="thumb-img"
                            style="max-height: 80px; max-width: 150px; background: #000;" muted controls></video>
                        <input type="file" @change="handleFileChange($event, 'home_video')" class="form-control"
                            accept="video/*" />
                    </div>
                </div>

                <h3 class="section-title mt-4">Khối giới thiệu thương hiệu</h3>
                <div class="grid-2">
                    <div class="form-group">
                        <label>Tiêu đề khối giới thiệu</label>
                        <input type="text" v-model="form.home_about_title" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Tiêu đề phụ khối giới thiệu</label>
                        <input type="text" v-model="form.home_about_subtitle" class="form-control" />
                    </div>
                </div>
                <div class="form-group quill-container">
                    <label>Nội dung khối giới thiệu</label>
                    <QuillEditor v-model:content="form.home_about_content" contentType="html" theme="snow" />
                </div>

                <h3 class="section-title mt-4">Banner giữa trang</h3>
                <div class="form-group">
                    <label>Hình ảnh Banner giữa trang</label>
                    <div class="flex items-center gap-3">
                        <img v-if="settings.home_middle_banner" :src="'/' + settings.home_middle_banner"
                            class="thumb-img" style="max-height: 80px;" alt="Middle Banner" />
                        <input type="file" @change="handleFileChange($event, 'home_middle_banner')" class="form-control"
                            accept="image/*" />
                    </div>
                </div>

                <h3 class="section-title mt-4">Phần Đối tác</h3>
                <div class="grid-2">
                    <div class="form-group">
                        <label>Tiêu đề phần đối tác</label>
                        <input type="text" v-model="form.home_partner_title" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label>Mô tả ngắn phần đối tác</label>
                    <textarea v-model="form.home_partner_subtitle" class="form-control" rows="2"></textarea>
                </div>

                <div class="mt-4">
                    <label class="font-medium mb-2 block">Hình ảnh</label>
                    <div
                        style="display: flex; flex-wrap: wrap; gap: 1.5rem; margin-bottom: 1rem; align-items: flex-end;">
                        <div v-for="(partner, index) in form.home_partners" :key="partner.id"
                            style="position: relative; display: inline-flex; align-items: center; justify-content: center;">
                            <img v-if="partner.old_image && !partner.preview" :src="'/' + partner.old_image"
                                class="thumb-img" style="max-height: 90px;" alt="Partner" />
                            <img v-if="partner.preview" :src="partner.preview" class="thumb-img"
                                style="max-height: 90px;" alt="Partner Preview" />
                            <button type="button" @click="removeHomePartner(index)"
                                style="position: absolute; top: -10px; right: -10px; background: #ef4444; color: white; border: 2px solid white; border-radius: 50%; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; font-size: 12px; cursor: pointer; padding: 0; box-shadow: 0 2px 4px rgba(0,0,0,0.2);">✕</button>
                        </div>
                    </div>
                    <div>
                        <label class="btn-secondary"
                            style="padding: 0.5rem 1rem; border: 1px dashed #3b82f6; color: #3b82f6; background: transparent; border-radius: 8px; cursor: pointer; display: inline-block;">
                            + Chọn nhiều ảnh Đối tác Trang chủ
                            <input type="file" multiple @change="handleMultipleFilesChange($event, 'home_partners')"
                                accept="image/*" style="display: none;" />
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab 3 -->
        <div v-show="activeTab === 'about'" class="card">
            <div class="card-body">
                <h3 class="section-title">Banner trang Giới thiệu</h3>
                <div class="form-group">
                    <label>Hình ảnh Banner đầu trang</label>
                    <div class="flex items-center gap-3">
                        <img v-if="settings.about_banner" :src="'/' + settings.about_banner" class="thumb-img"
                            style="max-height: 80px;" alt="About Banner" />
                        <input type="file" @change="handleFileChange($event, 'about_banner')" class="form-control"
                            accept="image/*" />
                    </div>
                </div>

                <h3 class="section-title mt-4">Khối 1: Lời giới thiệu</h3>
                <div class="grid-2">
                    <div class="form-group">
                        <label>Tiêu đề</label>
                        <input type="text" v-model="form.about_welcome_title" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Tiêu đề phụ</label>
                        <input type="text" v-model="form.about_welcome_subtitle" class="form-control" />
                    </div>
                </div>
                <div class="grid-2">
                    <div class="form-group">
                        <label>Hình ảnh khối giới thiệu</label>
                        <div class="flex items-center gap-3">
                            <img v-if="settings.about_welcome_image" :src="'/' + settings.about_welcome_image"
                                class="thumb-img" style="max-height: 60px;" alt="Welcome Img" />
                            <input type="file" @change="handleFileChange($event, 'about_welcome_image')"
                                class="form-control" accept="image/*" />
                        </div>
                    </div>
                </div>
                <div class="form-group quill-container">
                    <label>Nội dung giới thiệu</label>
                    <QuillEditor v-model:content="form.about_welcome_content" contentType="html" theme="snow" />
                </div>

                <h3 class="section-title mt-4">Khối 2: Câu chuyện nguyên liệu</h3>
                <div class="grid-2">
                    <div class="form-group">
                        <label>Tiêu đề</label>
                        <input type="text" v-model="form.about_story_title" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Tiêu đề phụ</label>
                        <input type="text" v-model="form.about_story_subtitle" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label>Hình ảnh</label>
                    <div class="flex items-center gap-3">
                        <img v-if="settings.about_story_image" :src="'/' + settings.about_story_image" class="thumb-img"
                            style="max-height: 60px;" alt="Story Img" />
                        <input type="file" @change="handleFileChange($event, 'about_story_image')" class="form-control"
                            accept="image/*" />
                    </div>
                </div>
                <div class="form-group quill-container">
                    <label>Nội dung câu chuyện</label>
                    <QuillEditor v-model:content="form.about_story_content" contentType="html" theme="snow" />
                </div>

                <h3 class="section-title mt-4">Khối 3: Thông điệp thương hiệu</h3>
                <div class="grid-2">
                    <div class="form-group">
                        <label>Tiêu đề</label>
                        <input type="text" v-model="form.about_message_title" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Tiêu đề phụ</label>
                        <input type="text" v-model="form.about_message_subtitle" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label>Hình ảnh</label>
                    <div class="flex items-center gap-3">
                        <img v-if="settings.about_message_image" :src="'/' + settings.about_message_image"
                            class="thumb-img" style="max-height: 60px;" alt="Message Img" />
                        <input type="file" @change="handleFileChange($event, 'about_message_image')"
                            class="form-control" accept="image/*" />
                    </div>
                </div>
                <div class="form-group quill-container">
                    <label>Nội dung thông điệp</label>
                    <QuillEditor v-model:content="form.about_message_content" contentType="html" theme="snow" />
                </div>

                <h3 class="section-title mt-4">Khối 4: Ứng dụng thảo dược</h3>
                <div class="form-group">
                    <label>Tiêu đề</label>
                    <input type="text" v-model="form.about_herb_title" class="form-control" />
                </div>
                <div class="form-group">
                    <label>Hình ảnh</label>
                    <div class="flex items-center gap-3">
                        <img v-if="settings.about_herb_image" :src="'/' + settings.about_herb_image" class="thumb-img"
                            style="max-height: 60px;" alt="Herb Img" />
                        <input type="file" @change="handleFileChange($event, 'about_herb_image')" class="form-control"
                            accept="image/*" />
                    </div>
                </div>
                <div class="form-group quill-container">
                    <label>Nội dung</label>
                    <QuillEditor v-model:content="form.about_herb_content" contentType="html" theme="snow" />
                </div>

                <h3 class="section-title mt-4">Khối 5: Nhà máy CGMP</h3>
                <div class="form-group">
                    <label>Tiêu đề nhà máy</label>
                    <input type="text" v-model="form.about_cgmp_title" class="form-control" />
                </div>
                <div class="form-group">
                    <label>Hình ảnh nhà máy</label>
                    <div class="flex items-center gap-3">
                        <img v-if="settings.about_cgmp_image" :src="'/' + settings.about_cgmp_image" class="thumb-img"
                            style="max-height: 60px;" alt="CGMP Img" />
                        <input type="file" @change="handleFileChange($event, 'about_cgmp_image')" class="form-control"
                            accept="image/*" />
                    </div>
                </div>

                <h3 class="section-title mt-4">Khối 6: Sứ mệnh & Tầm nhìn</h3>
                <div class="p-3 mb-3 border rounded">
                    <h4 class="font-medium mb-2">Sứ mệnh</h4>
                    <div class="form-group">
                        <label>Tiêu đề Sứ mệnh</label>
                        <input type="text" v-model="form.about_mission_title" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Hình ảnh Sứ mệnh</label>
                        <div class="flex items-center gap-3">
                            <img v-if="settings.about_mission_image" :src="'/' + settings.about_mission_image"
                                class="thumb-img" style="max-height: 60px;" alt="Mission Img" />
                            <input type="file" @change="handleFileChange($event, 'about_mission_image')"
                                class="form-control" accept="image/*" />
                        </div>
                    </div>
                    <div class="form-group quill-container">
                        <label>Nội dung Sứ mệnh</label>
                        <QuillEditor v-model:content="form.about_mission_content" contentType="html" theme="snow" />
                    </div>
                </div>

                <div class="p-3 mb-3 border rounded">
                    <h4 class="font-medium mb-2">Tầm nhìn</h4>
                    <div class="form-group">
                        <label>Tiêu đề Tầm nhìn</label>
                        <input type="text" v-model="form.about_vision_title" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Hình ảnh Tầm nhìn</label>
                        <div class="flex items-center gap-3">
                            <img v-if="settings.about_vision_image" :src="'/' + settings.about_vision_image"
                                class="thumb-img" style="max-height: 60px;" alt="Vision Img" />
                            <input type="file" @change="handleFileChange($event, 'about_vision_image')"
                                class="form-control" accept="image/*" />
                        </div>
                    </div>
                    <div class="form-group quill-container">
                        <label>Nội dung Tầm nhìn</label>
                        <QuillEditor v-model:content="form.about_vision_content" contentType="html" theme="snow" />
                    </div>
                </div>

                <h3 class="section-title mt-4">Khối 7: Giá trị cốt lõi</h3>
                <div class="p-3 mb-3 border rounded">
                    <h4 class="font-medium mb-2">Giá trị 1</h4>
                    <div class="form-group">
                        <label>Tiêu đề</label>
                        <input type="text" v-model="form.about_core_1_title" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Hình ảnh biểu tượng</label>
                        <div class="flex items-center gap-3">
                            <img v-if="settings.about_core_1_image" :src="'/' + settings.about_core_1_image"
                                class="thumb-img" style="max-height: 40px;" alt="Core 1 Img" />
                            <input type="file" @change="handleFileChange($event, 'about_core_1_image')"
                                class="form-control" accept="image/*" />
                        </div>
                    </div>
                    <div class="form-group quill-container">
                        <label>Nội dung</label>
                        <QuillEditor v-model:content="form.about_core_1_content" contentType="html" theme="snow" />
                    </div>
                </div>

                <div class="p-3 mb-3 border rounded">
                    <h4 class="font-medium mb-2">Giá trị 2</h4>
                    <div class="form-group">
                        <label>Tiêu đề</label>
                        <input type="text" v-model="form.about_core_2_title" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Hình ảnh biểu tượng</label>
                        <div class="flex items-center gap-3">
                            <img v-if="settings.about_core_2_image" :src="'/' + settings.about_core_2_image"
                                class="thumb-img" style="max-height: 40px;" alt="Core 2 Img" />
                            <input type="file" @change="handleFileChange($event, 'about_core_2_image')"
                                class="form-control" accept="image/*" />
                        </div>
                    </div>
                    <div class="form-group quill-container">
                        <label>Nội dung</label>
                        <QuillEditor v-model:content="form.about_core_2_content" contentType="html" theme="snow" />
                    </div>
                </div>

                <div class="p-3 mb-3 border rounded">
                    <h4 class="font-medium mb-2">Giá trị 3</h4>
                    <div class="form-group">
                        <label>Tiêu đề</label>
                        <input type="text" v-model="form.about_core_3_title" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Hình ảnh biểu tượng</label>
                        <div class="flex items-center gap-3">
                            <img v-if="settings.about_core_3_image" :src="'/' + settings.about_core_3_image"
                                class="thumb-img" style="max-height: 40px;" alt="Core 3 Img" />
                            <input type="file" @change="handleFileChange($event, 'about_core_3_image')"
                                class="form-control" accept="image/*" />
                        </div>
                    </div>
                    <div class="form-group quill-container">
                        <label>Nội dung</label>
                        <QuillEditor v-model:content="form.about_core_3_content" contentType="html" theme="snow" />
                    </div>
                </div>

                <h3 class="section-title mt-4">Khối 8: Ban Lãnh Đạo</h3>
                <div class="p-3 mb-3 border rounded">
                    <h4 class="font-medium mb-2">Thành viên 1</h4>
                    <div class="form-group">
                        <label>Họ và tên</label>
                        <input type="text" v-model="form.about_leader_1_name" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Chức vụ (Hỗ trợ HTML)</label>
                        <input type="text" v-model="form.about_leader_1_role" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Hình ảnh chân dung</label>
                        <div class="flex items-center gap-3">
                            <img v-if="settings.about_leader_1_image" :src="'/' + settings.about_leader_1_image"
                                class="thumb-img" style="max-height: 60px;" alt="Leader 1 Img" />
                            <input type="file" @change="handleFileChange($event, 'about_leader_1_image')"
                                class="form-control" accept="image/*" />
                        </div>
                    </div>
                </div>

                <div class="p-3 mb-3 border rounded">
                    <h4 class="font-medium mb-2">Thành viên 2</h4>
                    <div class="form-group">
                        <label>Họ và tên</label>
                        <input type="text" v-model="form.about_leader_2_name" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Chức vụ (Hỗ trợ HTML)</label>
                        <input type="text" v-model="form.about_leader_2_role" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Hình ảnh chân dung</label>
                        <div class="flex items-center gap-3">
                            <img v-if="settings.about_leader_2_image" :src="'/' + settings.about_leader_2_image"
                                class="thumb-img" style="max-height: 60px;" alt="Leader 2 Img" />
                            <input type="file" @change="handleFileChange($event, 'about_leader_2_image')"
                                class="form-control" accept="image/*" />
                        </div>
                    </div>
                </div>

                <h3 class="section-title mt-4">Khối 9: Văn hóa công ty</h3>
                <div class="form-group">
                    <label>Tiêu đề</label>
                    <input type="text" v-model="form.about_culture_title" class="form-control" />
                </div>
                <div class="form-group quill-container">
                    <label>Nội dung văn hóa</label>
                    <QuillEditor v-model:content="form.about_culture_content" contentType="html" theme="snow" />
                </div>

                <h3 class="section-title mt-4">Khối 10: Lĩnh vực hoạt động</h3>
                <div class="grid-2">
                    <div class="form-group">
                        <label>Tiêu đề</label>
                        <input type="text" v-model="form.about_activity_title" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Tiêu đề phụ</label>
                        <input type="text" v-model="form.about_activity_subtitle" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label>Hình ảnh đại diện</label>
                    <div class="flex items-center gap-3">
                        <img v-if="settings.about_activity_image" :src="'/' + settings.about_activity_image"
                            class="thumb-img" style="max-height: 60px;" alt="Activity Img" />
                        <input type="file" @change="handleFileChange($event, 'about_activity_image')"
                            class="form-control" accept="image/*" />
                    </div>
                </div>
                <div class="form-group quill-container">
                    <label>Nội dung</label>
                    <QuillEditor v-model:content="form.about_activity_content" contentType="html" theme="snow" />
                </div>
            </div>
        </div>

        <!-- Tab 4 -->
        <div v-show="activeTab === 'partners_page'" class="card">
            <div class="card-body">
                <h3 class="section-title">Banner trang đối tác</h3>
                <div class="form-group">
                    <label>Hình ảnh Banner đầu trang</label>
                    <div class="flex items-center gap-3">
                        <img v-if="settings.partners_banner" :src="'/' + settings.partners_banner" class="thumb-img"
                            style="max-height: 80px;" alt="Partners Banner" />
                        <input type="file" @change="handleFileChange($event, 'partners_banner')" class="form-control"
                            accept="image/*" />
                    </div>
                </div>

                <h3 class="section-title mt-4">Khối 1: Tiêu đề chung & Đối tác nguyên liệu</h3>
                <div class="form-group">
                    <label>Tiêu đề phần Đối tác nguyên liệu</label>
                    <input type="text" v-model="form.partners_ingredient_title" class="form-control" />
                </div>

                <div class="mt-4">
                    <label class="font-medium mb-2 block">Danh sách Đối tác nguyên liệu</label>
                    <div v-for="(partner, index) in form.ingredient_partners" :key="partner.id"
                        class="p-3 mb-3 border rounded bg-gray-50 relative">
                        <button type="button" @click="removeIngredientPartner(index)" class="btn-icon text-red"
                            style="position: absolute; top: 10px; right: 10px; background: none; border: none; color: #ef4444; cursor: pointer; padding: 0.5rem;">
                            Xóa
                        </button>
                        <h4 class="font-medium mb-2">Đối tác nguyên liệu {{ index + 1 }}</h4>
                        <div class="form-group">
                            <label>Tên đối tác</label>
                            <input type="text" v-model="partner.name" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh đối tác</label>
                            <div class="flex items-center gap-3">
                                <img v-if="partner.old_image && !partner.image" :src="'/' + partner.old_image"
                                    class="thumb-img" style="max-height: 60px;" alt="Ingredient Img" />
                                <input type="file"
                                    @change="handleDynamicFileChange($event, index, 'ingredient_partners')"
                                    class="form-control" accept="image/*" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Mô tả chi tiết</label>
                            <textarea v-model="partner.description" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <button type="button" @click="addIngredientPartner" class="btn-secondary mt-2"
                        style="padding: 0.5rem 1rem; border: 1px dashed #3b82f6; color: #3b82f6; background: transparent; border-radius: 8px; cursor: pointer;">
                        + Thêm Đối tác nguyên liệu
                    </button>
                </div>

                <h3 class="section-title mt-4">Khối 2: Đối tác bệnh viện</h3>
                <div class="form-group">
                    <label>Tiêu đề</label>
                    <input type="text" v-model="form.partners_hospital_title" class="form-control" />
                </div>
                <div class="form-group quill-container">
                    <label>Mô tả</label>
                    <QuillEditor v-model:content="form.partners_hospital_desc" contentType="html" theme="snow" />
                </div>
                <div class="mt-4">
                    <label class="font-medium mb-2 block">Hình ảnh</label>
                    <div
                        style="display: flex; flex-wrap: wrap; gap: 1.5rem; margin-bottom: 1rem; align-items: flex-end;">
                        <div v-for="(partner, index) in form.hospital_partners" :key="partner.id"
                            style="position: relative; display: inline-flex; align-items: center; justify-content: center;">
                            <img v-if="partner.old_image && !partner.preview" :src="'/' + partner.old_image"
                                class="thumb-img" style="max-height: 90px;" alt="Partner" />
                            <img v-if="partner.preview" :src="partner.preview" class="thumb-img"
                                style="max-height: 90px;" alt="Partner Preview" />
                            <button type="button" @click="removeHospitalPartner(index)"
                                style="position: absolute; top: -10px; right: -10px; background: #ef4444; color: white; border: 2px solid white; border-radius: 50%; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; font-size: 12px; cursor: pointer; padding: 0; box-shadow: 0 2px 4px rgba(0,0,0,0.2);">✕</button>
                        </div>
                    </div>
                    <div>
                        <label class="btn-secondary"
                            style="padding: 0.5rem 1rem; border: 1px dashed #3b82f6; color: #3b82f6; background: transparent; border-radius: 8px; cursor: pointer; display: inline-block;">
                            + Chọn nhiều ảnh Bệnh viện
                            <input type="file" multiple @change="handleMultipleFilesChange($event, 'hospital_partners')"
                                accept="image/*" style="display: none;" />
                        </label>
                    </div>
                </div>

                <h3 class="section-title mt-4">Khối 3: Đối tác truyền thông</h3>
                <div class="form-group">
                    <label>Tiêu đề</label>
                    <input type="text" v-model="form.partners_media_title" class="form-control" />
                </div>
                <div class="form-group quill-container">
                    <label>Mô tả</label>
                    <QuillEditor v-model:content="form.partners_media_desc" contentType="html" theme="snow" />
                </div>
                <div class="mt-4">
                    <label class="font-medium mb-2 block">Hình ảnh</label>
                    <div
                        style="display: flex; flex-wrap: wrap; gap: 1.5rem; margin-bottom: 1rem; align-items: flex-end;">
                        <div v-for="(partner, index) in form.media_partners" :key="partner.id"
                            style="position: relative; display: inline-flex; align-items: center; justify-content: center;">
                            <img v-if="partner.old_image && !partner.preview" :src="'/' + partner.old_image"
                                class="thumb-img" style="max-height: 90px;" alt="Partner" />
                            <img v-if="partner.preview" :src="partner.preview" class="thumb-img"
                                style="max-height: 90px;" alt="Partner Preview" />
                            <button type="button" @click="removeMediaPartner(index)"
                                style="position: absolute; top: -10px; right: -10px; background: #ef4444; color: white; border: 2px solid white; border-radius: 50%; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; font-size: 12px; cursor: pointer; padding: 0; box-shadow: 0 2px 4px rgba(0,0,0,0.2);">✕</button>
                        </div>
                    </div>
                    <div>
                        <label class="btn-secondary"
                            style="padding: 0.5rem 1rem; border: 1px dashed #3b82f6; color: #3b82f6; background: transparent; border-radius: 8px; cursor: pointer; display: inline-block;">
                            + Chọn nhiều ảnh Truyền thông
                            <input type="file" multiple @change="handleMultipleFilesChange($event, 'media_partners')"
                                accept="image/*" style="display: none;" />
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab 5 -->
        <div v-show="activeTab === 'contact_page'" class="card">
            <div class="card-body">
                <h3 class="section-title">Bản đồ</h3>
                <div class="form-group mt-3">
                    <label>Google Map Iframe</label>
                    <textarea v-model="form.map_iframe" class="form-control" rows="3"
                        placeholder="<iframe src='...'></iframe>"></textarea>
                </div>

                <h3 class="section-title mt-4">Hệ thống Cửa hàng</h3>
                <div class="mt-4">
                    <label class="font-medium mb-2 block">Danh sách Cửa hàng</label>
                    <div v-for="(store, index) in form.contact_stores" :key="store.id"
                        class="p-3 mb-3 border rounded bg-gray-50 relative">
                        <button type="button" @click="removeContactStore(index)" class="btn-icon text-red"
                            style="position: absolute; top: 10px; right: 10px; background: none; border: none; color: #ef4444; cursor: pointer; padding: 0.5rem;">
                            Xóa
                        </button>
                        <h4 class="font-medium mb-2">Cửa hàng {{ index + 1 }}</h4>
                        <div class="grid-2">
                            <div class="form-group">
                                <label>Tên cửa hàng</label>
                                <input type="text" v-model="store.name" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <input type="text" v-model="store.phone" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Địa chỉ</label>
                            <textarea v-model="store.address" class="form-control" rows="2"></textarea>
                        </div>
                    </div>
                    <button type="button" @click="addContactStore" class="btn-secondary mt-2"
                        style="padding: 0.5rem 1rem; border: 1px dashed #3b82f6; color: #3b82f6; background: transparent; border-radius: 8px; cursor: pointer;">
                        + Thêm Cửa hàng
                    </button>
                </div>
            </div>
        </div>

        <!-- Form Submit Bar -->
        <div class="form-actions-bar mt-4 pt-3 border-top text-right">
            <button type="submit" class="btn-primary ml-auto" :disabled="form.processing">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" v-if="!form.processing">
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                    <polyline points="17 21 17 13 7 13 7 21"></polyline>
                    <polyline points="7 3 7 8 15 8"></polyline>
                </svg>
                {{ form.processing ? 'Đang lưu cấu hình...' : 'Lưu' }}
            </button>
        </div>
    </form>
</template>

<style scoped>
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
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

.alert-success svg {
    width: 20px;
    height: 20px;
}

/* Tabbed Premium Navigation */
.tabs-nav {
    display: flex;
    gap: 0.75rem;
    margin-bottom: 1.5rem;
    border-bottom: 2px solid #e2e8f0;
    padding-bottom: 0.5rem;
}

.tab-btn {
    background: none;
    border: none;
    padding: 0.75rem 1.25rem;
    font-size: 0.95rem;
    font-weight: 600;
    color: #64748b;
    cursor: pointer;
    border-radius: 8px;
    transition: all 0.2s ease;
}

.tab-btn:hover {
    background: #f1f5f9;
    color: #0f172a;
}

.tab-btn.active {
    background: #eff6ff;
    color: #3b82f6;
    box-shadow: 0 2px 4px rgba(59, 130, 246, 0.08);
}

.card {
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    border: 1px solid #f1f5f9;
    overflow: hidden;
}

.card-body {
    padding: 2rem;
}

.grid-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
}

@media (max-width: 768px) {
    .grid-2 {
        grid-template-columns: 1fr;
    }
}

.form-group {
    margin-bottom: 1.25rem;
}

.form-group label {
    display: block;
    font-size: 0.9rem;
    font-weight: 600;
    color: #334155;
    margin-bottom: 0.5rem;
}

.form-control {
    width: 100%;
    padding: 0.75rem 1rem;
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

.flex {
    display: flex;
}

.items-center {
    align-items: center;
}

.gap-3 {
    gap: 1rem;
}

.thumb-img {
    max-height: 48px;
    border-radius: 6px;
    border: 1px solid #e2e8f0;
    background: #f8fafc;
    padding: 4px;
    object-fit: contain;
}

.text-sm {
    font-size: 0.8rem;
}

.text-gray {
    color: #64748b;
}

.mt-1 {
    margin-top: 0.25rem;
}

.mt-3 {
    margin-top: 1rem;
}

.mt-4 {
    margin-top: 1.5rem;
}

.pt-3 {
    padding-top: 1rem;
}

.border-top {
    border-top: 1px solid #e2e8f0;
}

.section-title {
    font-size: 1.15rem;
    font-weight: 700;
    color: #0f172a;
    margin: 1.5rem 0 1rem 0;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #f1f5f9;
}

.section-title:first-of-type {
    margin-top: 0;
}

.btn-primary {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: #3b82f6;
    color: white;
    border: none;
    padding: 0.75rem 2rem;
    border-radius: 10px;
    font-weight: 600;
    font-size: 0.95rem;
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

.ml-auto {
    margin-left: auto;
}

.banner-box {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
}

/* Quill Editor Overrides */
.quill-container :deep(.ql-container) {
    min-height: 180px;
    font-family: inherit;
    font-size: 0.95rem;
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
}

.quill-container :deep(.ql-toolbar) {
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}
</style>

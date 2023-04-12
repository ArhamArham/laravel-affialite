<template>
    <div>
        <div class="grid grid-cols-12 mt-8">
            <div class="col-span-12 lg:col-span-8 sm:col-span-12">
                <h2 class="text-lg font-medium truncate mr-5">Page Create</h2>
            </div>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-8">
                <div class="w-full intro-y box p-5">
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <l-input
                            label="Title"
                            v-model="data.title"
                            :error="errors.title"
                            md="w-1/4"
                        />

                        <l-input
                            @blur="sanitizeTitle"
                            label="Slug"
                            v-model="data.slug"
                            :error="errors.slug"
                            md="w-1/4"/>

                        <div class="w-full px-3 mb-4">
                            <label class="form-label" for="long_description"> Content </label>
                            <ckeditor v-model="data.content" id="content"></ckeditor>
                            <span
                                v-if="hasError('content', true)"
                                class="font-medium tracking-wide text-red-500 text-xs"
                                v-text="hasError('content')"
                            ></span>
                        </div>
                    </div>
                </div>

                <div class="w-full intro-y box mt-4 p-5">
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <l-input
                            label="Meta Title"
                            v-model="data.meta_title"
                            :error="errors.meta_title"
                        />

                        <l-input
                            label="Meta Keywords"
                            v-model="data.meta_keywords"
                            :error="errors.meta_keywords"
                        />

                        <l-textarea
                            label="Meta Description"
                            v-model="data.meta_description"
                            :error="errors.meta_description"
                            cols="30"
                            rows="10"
                        />
                    </div>
                </div>

                <div class="text-right mt-5">
                    <a href="/admin/page" class="btn btn-outline-secondary w-24 mr-1"
                    >Cancel</a
                    >
                    <button
                        type="submit"
                        class="btn btn-primary w-24"
                        :disabled="btnLoading"
                        @click="onSubmit"
                    >
                        Save
                    </button>
                </div>
            </div>

            <div class="intro-y col-span-12 lg:col-span-4">
                <div class="w-full intro-y box p-5">
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3 mb-4">
                            <l-checkbox
                                label="Active Status"
                                v-model="data.is_active"
                                :error="errors.is_active"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import FileUpload from "../FileUpload";
import Input from "../Partials/Input";
import Select from "../Partials/Select";
import Checkbox from "../Partials/Checkbox";
import Textarea from "../Partials/Textarea";

export default {
    name: "Add",
    components: {
        FileUpload,
        LInput: Input,
        LSelect: Select,
        LCheckbox: Checkbox,
        LTextarea: Textarea,
    },
    data: function () {
        return {
            data: {
                title: null,
                slug: null,
                image: null,
                content: null,
                meta_title: null,
                meta_keywords: null,
                meta_description: null,
                is_active: true,
            },
            errors: {},
            btnLoading: false,
        };
    },
    methods: {
        sanitizeTitle: function () {
            if (!this.data.slug) {
                return "";
            }
            let slug = "";
            // Change to lower case
            const titleLower = this.data.slug.toLowerCase();
            // Letter "e"
            slug = titleLower.replace(/e|é|è|ẽ|ẻ|ẹ|ê|ế|ề|ễ|ể|ệ/gi, 'e');
            // Letter "a"
            slug = slug.replace(/a|á|à|ã|ả|ạ|ă|ắ|ằ|ẵ|ẳ|ặ|â|ấ|ầ|ẫ|ẩ|ậ/gi, 'a');
            // Letter "o"
            slug = slug.replace(/o|ó|ò|õ|ỏ|ọ|ô|ố|ồ|ỗ|ổ|ộ|ơ|ớ|ờ|ỡ|ở|ợ/gi, 'o');
            // Letter "u"
            slug = slug.replace(/u|ú|ù|ũ|ủ|ụ|ư|ứ|ừ|ữ|ử|ự/gi, 'u');
            // Letter "d"
            slug = slug.replace(/đ/gi, 'd');
            // Trim the last whitespace
            slug = slug.replace(/\s*$/g, '');
            // Change whitespace to "-"
            slug = slug.replace(/\s+/g, '-');

            this.data.slug = slug;
        },
        setImage(img, key, index = null) {
            if (index == null) {
                this.data[key] = img;
            } else {
                this.data.items[index][key] = img;
            }
        },
        hasError(type, isCheck = false) {
            if (type in this.errors && this.errors[type][0].length > 0) {
                if (isCheck) return true;
                return this.errors[type][0];
            }
            return false;
        },
        onSubmit() {
            this.btnLoading = true;
            axios
                .post("/advertisement/page", this.data)
                .then(() => {
                    this.btnLoading = false;
                    this.$alertify.success("Page created successfully");

                    setTimeout(() => {
                        window.location.href = "/advertisement/page";
                    }, 1000);
                })
                .catch((error) => {
                    if (error.response) {
                        this.btnLoading = false;
                        if (error.response.status === 422) {
                            this.errors = error.response.data.errors;
                        }
                    } else {
                        this.$alertify.error("Internet Disconnected");
                    }
                });
        },
        onCheckbox(e, key) {
            this.data[key] = e.target.checked;
        },
    },
};
</script>

<style scoped>
@media (min-width: 768px) {
    .md\:w-1\/2 {
        width: 25%;
    }

    .md\:w-1\/3 {
        width: 33.333333%;
    }

    .md\:w-1\/4 {
        width: 50%;
    }

    .md\:w-1\/5 {
        width: 75%;
    }
}

.border-radius-15 {
    border-radius: 15px;
}

.close {
    position: absolute;
    right: 12px;
    margin-top: -10px;
}
</style>

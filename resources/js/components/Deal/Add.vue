<template>
    <div>
        <div class="grid grid-cols-12 mt-8">
            <div class="col-span-12 lg:col-span-8 sm:col-span-12">
                <h2 class="text-lg font-medium truncate mr-5">
                    Deal Create
                </h2>
            </div>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-8">
                <div class="w-full intro-y box p-5">
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/4 px-3 mb-4">
                            <label class="form-label"
                                   for="title">
                                Title
                            </label>
                            <div class="flex items-center">
                                <input
                                    class="form-control w-full"
                                    id="title" placeholder="Enter Title" type="text"
                                    v-model="data.title">
                            </div>
                        </div>

                        <div class="w-full px-3 mb-4">
                            <label class="form-label"
                                   for="short_description">
                                Short Description
                            </label>
                            <div class="flex items-center">
                                <textarea
                                    id="short_description" class="form-control w-full"
                                    v-model="data.short_description"
                                    cols="30" rows="3"
                                ></textarea>
                            </div>
                        </div>

                        <div class="w-full px-3 mb-4">
                            <label class="form-label"
                                   for="long_description">
                                Long Description
                            </label>
                            <ckeditor v-model="data.long_description" id="long_description"></ckeditor>
                        </div>
                    </div>
                </div>

                <div class="w-full intro-y box mt-4 p-5">
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3 mb-4">
                            <label class="form-label"
                                   for="meta_title">
                                Meta Title
                            </label>
                            <div class="flex items-center">
                                <input
                                    class="form-control w-full"
                                    id="meta_title" placeholder="Enter Meta Title" type="text"
                                    v-model="data.meta_title">
                            </div>
                        </div>

                        <div class="w-full px-3 mb-4">
                            <label class="form-label"
                                   for="meta_keyword">
                                Meta Keywords
                            </label>
                            <div class="flex items-center">
                                <input
                                    class="form-control w-full"
                                    id="meta_keyword" placeholder="Enter Meta Keywords" type="text"
                                    v-model="data.meta_keywords">
                            </div>
                        </div>

                        <div class="w-full px-3 mb-4">
                            <label class="form-label"
                                   for="meta_description">
                                Meta Description
                            </label>
                            <div class="flex items-center">
                                <textarea
                                    id="meta_description" class="form-control w-full"
                                    v-model="data.meta_description"
                                    cols="30" rows="10"
                                ></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-right mt-5">
                    <a href="/advertisement/deal"
                       class="btn btn-outline-secondary w-24 mr-1">Cancel</a>
                    <button type="submit"
                            class="btn btn-primary w-24"
                            :disabled="btnLoading"
                            @click="onSubmit">Save
                    </button>
                </div>
            </div>

            <div class="intro-y col-span-12 lg:col-span-4">
                <div class="w-full intro-y box p-5">
                    <div class="flex flex-wrap -mx-3 mb-6">

                        <div class="w-full px-3 mb-4">
                            <label class="form-label"
                                   for="is_active">
                                Active Status
                            </label>
                            <div class="form-switch mt-2">
                                <input type="checkbox"
                                       id="is_active"
                                       class="form-check-input"
                                       :checked="data.is_active"
                                       @change="onCheckbox($event,'is_active')"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
import FileUpload from '../FileUpload'

export default {
    name: "Add",
    components: {
        FileUpload,
    },
    data: function () {
        return {
            data: {
                title: null,
                short_description: null,
                long_description: null,
                meta_title: null,
                meta_keywords: null,
                meta_description: null,
                is_active: true,
            },
            btnLoading: false
        }
    },
    methods: {
        setImage(img, key, index = null) {
            if (index == null) {
                this.data[key] = img
            } else {
                this.data.items[index][key] = img;
            }
        },
        onSubmit() {
            this.btnLoading = true;
            axios.post('/advertisement/deal', this.data)
                .then(() => {
                    this.btnLoading = false;
                    this.$alertify.success('Deal created successfully')

                    setTimeout(() => {
                        window.location.href = '/advertisement/deal'
                    }, 1000);

                }).catch((error) => {
                this.btnLoading = false;
                if (error.response.status === 422) {
                    this.$alertify.error(Object.values(error.response.data.errors)[0][0])
                }
            })
        },
        onCheckbox(e, key) {
            this.data[key] = e.target.checked;
        }
    }
}
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

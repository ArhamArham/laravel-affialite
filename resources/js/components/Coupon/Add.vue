<template>
    <div>
        <div class="grid grid-cols-12 mt-8">
            <div class="col-span-12 lg:col-span-8 sm:col-span-12">
                <h2 class="text-lg font-medium truncate mr-5">
                    Coupon Create
                </h2>
            </div>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-8">
                <div class="w-full intro-y box p-5">
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/4 px-3 mb-4">
                            <label class="form-label"
                                   for="offer_box">
                                Offer Box
                            </label>
                            <div class="flex items-center">
                                <input
                                    class="form-control w-full"
                                    id="offer_box" placeholder="Enter Offer Box" type="text"
                                    v-model="data.offer_box">
                            </div>
                        </div>

                        <div class="w-full md:w-1/4 px-3 mb-4">
                            <label class="form-label"
                                   for="store_id">
                                Select Store
                            </label>
                            <div class="flex items-center">
                                <v-select
                                    id="store_id"
                                    class="w-full"
                                    :reduce="options => options.id"
                                    :options="stores"
                                    label="name"
                                    placeholder="Select"
                                    v-model="data.store_id"
                                ></v-select>
                            </div>
                        </div>

                        <div class="w-full md:w-1/4 px-3 mb-4">
                            <label class="form-label"
                                   for="expiry_date">
                                Expiry Date
                            </label>
                            <div class="flex items-center">
                                <input
                                    class="form-control w-full"
                                    id="expiry_date" type="date"
                                    v-model="data.expiry_date">
                            </div>
                        </div>

                        <div class="w-full md:w-1/4 px-3 mb-4">
                            <label class="form-label"
                                   for="type">
                                Type
                            </label>
                            <div class="flex items-center">
                                <v-select
                                    id="type"
                                    class="w-full"
                                    :options="['deal','code']"
                                    placeholder="Select"
                                    v-model="data.type"
                                ></v-select>
                            </div>
                        </div>

                        <div class="w-full md:w-1/4 px-3 mb-4" v-if="data.type == 'code'">
                            <label class="form-label"
                                   for="code">
                                Code
                            </label>
                            <div class="flex items-center">
                                <input
                                    class="form-control w-full"
                                    id="code" placeholder="Enter Code" type="text"
                                    v-model="data.code">
                            </div>
                        </div>

                        <div class="w-full px-3 mb-4">
                            <label class="form-label"
                                   for="tracking_link">
                                Tracking Link
                            </label>
                            <div class="flex items-center">
                                <input
                                    class="form-control w-full"
                                    id="tracking_link" placeholder="Enter Tracking Url" type="text"
                                    v-model="data.tracking_link">
                            </div>
                        </div>

                        <div class="w-full px-3 mb-4">
                            <label class="form-label"
                                   for="offer_details">
                                Offer Details
                            </label>
                            <div class="flex items-center">
                                <textarea
                                    id="offer_details" class="form-control w-full"
                                    v-model="data.offer_details"
                                    cols="30" rows="10"
                                ></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-right mt-5">
                    <a href="/affiliate/coupon"
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

                        <div class="w-full px-3 mb-4">
                            <label class="form-label"
                                   for="featured_for_home">
                                Feature For Home
                            </label>
                            <div class="form-switch mt-2">
                                <input type="checkbox"
                                       id="featured_for_home"
                                       class="form-check-input"
                                       :checked="data.editor_choice"
                                       @change="onCheckbox($event,'featured_for_home')"/>
                            </div>
                            <small>The coupon will be added in featured for home</small>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    name: "Add",
    props: ['stores'],
    data: function () {
        return {
            data: {
                store_id: null,
                offer_box: null,
                offer_details: null,
                tracking_link: null,
                expiry_date: null,
                type: null,
                code: null,
                featured_for_home: true,
                is_active: true
            },
            btnLoading: false
        }
    },
    watch: {
        'data.type': function (val) {
            if (val == 'deal') {
                this.data.code = null
            }
        }
    },
    methods: {
        onSubmit() {
            this.btnLoading = true;
            axios.post('/affiliate/coupon', this.data)
                .then(() => {
                    this.btnLoading = false;
                    this.$alertify.success('Coupon created successfully')

                    // setTimeout(() => {
                    //     window.location.href = '/affiliate/coupon'
                    // }, 1000);

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

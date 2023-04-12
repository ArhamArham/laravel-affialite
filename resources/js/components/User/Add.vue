<template>
  <div>
    <div class="grid grid-cols-12 mt-8">
      <div class="col-span-12 lg:col-span-8 sm:col-span-12">
        <h2 class="text-lg font-medium truncate mr-5">
          User Create
        </h2>
      </div>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
      <div class="intro-y col-span-12 lg:col-span-8">
        <div class="w-full intro-y box p-5">

          <div class="flex flex-wrap -mx-3 mb-6">

            <l-input
              label="First Name"
              v-model="data.first_name"
              :error="errors.first_name"
              md="w-1/4"
            />

            <l-input
              label="Last Name"
              v-model="data.last_name"
              :error="errors.last_name"
              md="w-1/4"
            />

            <l-input
              label="Username"
              autocomplete="off"
              v-model="data.username"
              :error="errors.username"
              md="w-1/4"
            />

            <l-input
              label="Email"
              v-model="data.email"
              :error="errors.password"
              md="w-1/4"
            />

            <l-input
              label="Password"
              type="password"
              v-model="data.password"
              :error="errors.password"
              md="w-1/4"
            />

            <l-input
              label="Mobile No"
              v-model="data.mobile_no"
              :error="errors.mobile_no"
              md="w-1/4"
            />

            <l-select
              label="Network"
              v-model="data.network_id"
              :error="errors.network_id"
              :options="networks"
              md="w-1/4"
            />

            <l-select
              label="Roles"
              v-model="data.role_ids"
              :error="errors.role_ids"
              :options="roles"
              multiple
              md="w-1/4"
            />

          </div>

        </div>

        <div class="text-right mt-5">
          <a href="/userManagement/user"
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
</template>

<script>
import "flatpickr/dist/flatpickr.css"
import Input from "../Partials/Input";
import Select from "../Partials/Select";
import Checkbox from "../Partials/Checkbox";

export default {
  name: "Add",
  components: {
    LInput: Input,
    LSelect: Select,
    LCheckbox: Checkbox,
  },
  props: {
    roles: {
      type: Array,
      required: true
    },
    networks: {
      type: Array,
      required: true
    },
  },
  data: function () {
    return {
      data: {
        first_name: null,
        last_name: null,
        expiry_date: null,
        username: null,
        email: null,
        password: null,
        mobile_no: null,
        network_id: null,
        is_active: true,
        role_ids: []
      },
      errors: {},
      btnLoading: false
    }
  },
  methods: {
    onSubmit() {
      this.btnLoading = true;
      axios.post('/userManagement/user', this.data)
        .then(() => {
          this.btnLoading = false;
          this.$alertify.success('User created successfully')

          setTimeout(() => {
            window.location.href = '/userManagement/user'
          }, 1000);

        })
        .catch((error) => {
          this.btnLoading = false;
          if (error.response.status === 422) {
            this.errors = error.response.data.errors;
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
</style>

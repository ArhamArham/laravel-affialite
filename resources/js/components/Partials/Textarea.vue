<template>
  <div class="w-full px-3 mb-4" :class="{ ['md:' + md]: md }">
    <label class="form-label" :for="id" v-text="label"></label>
    <div class="flex items-center">
      <textarea
        class="form-control w-full"
        :placeholder="`Enter ${label}`"
        :class="{ 'border-red-500': hasError }"
        :id="id"
        :name="name"
        :value="value"
        :cols="cols"
        :rows="rows"
        v-bind="$attrs"
        @input="onInput"
        @change="onChange"
      ></textarea>
    </div>
    <span
      v-if="hasError"
      class="font-medium tracking-wide text-red-500 text-xs"
      v-text="getError"
    ></span>
  </div>
</template>

<script>
export default {
  name: "Textarea",
  inheritAttrs: false,
  props: {
    label: {
      type: String,
      required: true,
    },
    value: {},
    error: {
      type: Array,
    },
    md: {
      type: String,
    },
    cols: String,
    rows: String,
  },
  computed: {
    id() {
      return this.label.replaceAll(" ", "-").toLowerCase();
    },
    name() {
      return this.label.replaceAll(" ", "_").toLowerCase();
    },
    hasError() {
      return this.error?.length > 0;
    },
    getError() {
      return this.hasError && this.error[0];
    },
  },
  mounted() {
    if (this.type === "date") {
      flatpickr(`#${this.id}`, {
        dateFormat: "Y-m-d",
        // maxDate: new Date(),
        disableMobile: "true",
      });
    }
  },
  methods: {
    onInput(e) {
      this.$emit("input", e.target.value);
    },
    onChange(e) {
      this.$emit("change", e.target.value);
    },
  },
};
</script>

<style scoped>
</style>
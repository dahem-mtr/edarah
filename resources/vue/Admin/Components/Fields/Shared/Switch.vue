<template>
  <div
    v-for="(option, i) in field.options"
    :key="i"
    class="form-check form-switch"
    :class="field.isInline && 'form-check form-check-inline '"
  >
    <input
      type="checkbox"
      name="option"
      :checked="field.value !== null && field.value.includes(option.value)"
      @change="onChange(option.value)"
      class="form-check-input"
    />
    <label class="form-check-label">{{ option.displayName }}</label>
  </div>
</template>
<script>
export default {
  props: {
    field: Object,
    value: String,
  },
  emits: ["update-value"],
  methods: {
    onChange(option) {
      var vieldValue = this.field.value;
      if (vieldValue == null) {
        this.$emit("update-value", [option]);
      } else {
        if (vieldValue.includes(option)) {
          var optionsUpdated = vieldValue.filter((value) => {
            return value !== option;
          });

          this.$emit(
            "update-value",
            optionsUpdated.length === 0 ? null : optionsUpdated
          );
        } else {
          this.$emit("update-value", [...this.field.value, option]);
        }
      }
    },
  },
};
</script>

<template>
  <div
    v-for="(option, i) in field.options"
    :key="i"
    class="form-check"
    :class="field.isInline && 'form-check form-check-inline'"
  >
    <input
      :required="field.withRequiredMark"
      type="radio"
      :value="option.value"
      name="option"
      :checked="option.value === field.value"
      @change="(event) => $emit('update-value', event.target.value)"
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
};
</script>

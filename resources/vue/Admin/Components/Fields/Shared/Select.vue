<template>
  <select
    @change="(event) => $emit('update-value', event.target.value)"
    :required="field.withRequiredMark"
    class="form-select form-select-sm"
  >
    <option selected value="">اختر</option>
    <option
      v-for="(option, i) in field.options"
      :value="option.value"
      :key="i"
      :selected="option.value === field.value"
    >
      {{ option.displayName }}
    </option>
  </select>
</template>

<script>
export default {
  props: {
    field: Object,
  },
  emits: ["update-value"],
};
</script>

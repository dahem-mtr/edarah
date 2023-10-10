<template>
  <div class="card mt-2" :class="headerLayout === false && 'no-header'">
    <div class="card-header d-flex justify-content-between align-items-center">
      <div v-if="title">
        {{ title }}
      </div>

      <div>
        <slot name="tools" />
      </div>
    </div>

    <div class="card-body py-0 px-2">
      <slot />
    </div>
  </div>
</template>

<script>
export default {
  props: {
    title: String,
    headerLayout: Boolean,
  },
};
</script>



<template>
  <div class="item" :style="itemStyle(item.options)">
    <div
      class="item-title"
      :class="itemTitleClass(item.displayName)"
      v-html="
        isArray(item.displayName) ? item.displayName[0] : item.displayName
      "
    ></div>
    <component
      :is="item.component"
      :payload="item.payload"
      :options="item.options ? item.options : []"
    />
  </div>
</template>

<script>
import * as Items from "./Items";
export default {
  components: { ...Items },
  props: {
    item: Object,
  },
  methods: {
    isArray(prop) {
      return typeof prop === "object";
    },
    itemStyle(options) {
      return (
        options && options["minWidth"] && `min-width:${options["minWidth"]}px`
      );
    },
    itemTitleClass(displayName) {
      return this.isArray(displayName) && displayName[1];
    },
  },
};
</script>

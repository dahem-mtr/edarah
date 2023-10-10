<template>
   <img
      :src="img"
      :height="height"
      :width="width"
      :class="height && width  ? '' : 'img-fluid img-thumbnail'"
    />
</template>

<script>
export default {
  props: {
    img: [String,Boolean],
    width: [String,Number],
    height: [String,Number],
  },
};
</script>

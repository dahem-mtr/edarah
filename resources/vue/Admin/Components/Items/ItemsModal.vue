<template>
  <Modal ref="modalConfirm">
    <template v-slot:body> {{ action && action.withConfirm.msg }}</template>
    <template v-slot:buttons>
      <template v-if="action">
        <button
          type="button"
          @click="$emit('onConfirm', action)"
          class="btn btn-sm"
          :class="
            action && action.withConfirm.buttonClass
              ? action.withConfirm.buttonClass
              : 'btn-danger'
          "
          v-html="
            action && isArray(action.title) ? action.title[0] : action.title
          "
        ></button>
      </template>
    </template>
  </Modal>
</template>

<script>
import Modal from "../Modal.vue";

export default {
  components: { Modal },

  props: {
    isArray: Function,
  },
  data() {
    return {
      action: null,
    };
  },
  methods: {
    open(action) {
      this.action = action;

      this.$refs.modalConfirm.open();
    },
    close() {
      this.$refs.modalConfirm.close();
    },
  },
};
</script>


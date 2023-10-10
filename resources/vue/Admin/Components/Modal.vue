<template>
  <div class="modal fade" :id="modalKey" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div v-if="title" class="modal-header">
          <p class="modal-title">
            {{ title }}
          </p>
        </div>
        <div class="modal-body">
          <slot name="body" />
        </div>

        <div style="display: flex; gap: 2px; flex-wrap: wrap" class="pb-1 px-2">
          <button
            type="button"
            class="btn btn-secondary"
            data-bs-dismiss="modal"
          >
            cancel
          </button>
          <slot name="buttons" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    title: String,
  },
  data() {
    return {
      modalKey: Math.random().toString(36).slice(2, 7),
      modal: null,
    };
  },
  methods: {
    open() {
      if (!this.modal) {
        const modalRef = new bootstrap.Modal(document.getElementById(this.modalKey));
        modalRef.show();
        this.modal = modalRef;
      } else {
        this.modal.show();
      }
    },
    close() {
      this.modal.hide();
    },
  },
};
</script>

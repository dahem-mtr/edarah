<template>
  <div v-if="actions">
    <button
      class="btn items-action-button"
      type="button"
      id="dropdownMenuButton1"
      data-bs-toggle="dropdown"
      aria-expanded="false"
    >
      <i class="bi bi-three-dots-vertical"></i>
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
      <template v-for="(action, i) in actions" :key="i">
        <li>
          <a
            class="dropdown-item small"
            :class="isArray(action.title) ? action.title[1] : ''"
            @click="$emit('onAction', actions[0])"
            href="#"
            v-html="isArray(action.title) ? action.title[0] : action.title"
          >
          </a>
        </li>
      </template>
    </ul>
  </div>
</template>

<script>
export default {
  props: {
    actions: Array,
  },
  methods: {
    isArray(prop) {
      return typeof prop === "object";
    },
  },
};
</script>


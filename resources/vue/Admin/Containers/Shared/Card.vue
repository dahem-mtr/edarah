<template>
  <Card :title="payload.cardTitle" :headerLayout="payload.headerLayout">
    <template v-slot:tools>
      <DropdownListActions
        :actions="payload.actions"
        @onAction="
          (actionPressed) => itemsUtils.onAction(actionPressed, this.$refs.itemsModalRef, $inertia)
        "
      />
    </template>

    <ItemsStructure
      :structure="payload.structure"
      :getItem="getItem"
      :actions="payload.actions"
    />

    <ItemsActions
      v-if="payload.actions"
      :actions="payload.actions"
      :isArray="itemsUtils.isArray"
      @onAction="
        (actionPressed) =>
          itemsUtils.onAction(actionPressed, this.$refs.itemsModalRef, $inertia)
      "
    />

    <ItemsModal
      ref="itemsModalRef"
      :isArray="itemsUtils.isArray"
      @onConfirm="
        (actionPressed) =>
          itemsUtils.onConfirm(
            actionPressed,
            this.$refs.itemsModalRef,
            $inertia
          )
      "
    />
  </Card>
</template>

<script>
import Card from "../../Components/Card.vue";
import DropdownListActions from "../../Components/Items/DropdownListActions.vue";
import ItemsStructure from "../../Components/Items/ItemsStructure.vue";
import ItemsActions from "../../Components/Items/ItemsActions.vue";
import ItemsModal from "../../Components/Items/ItemsModal.vue";
import useItemsUtils from "../../Utils/useItemsUtils";
export default {
  components: {
    Card,
    DropdownListActions,
    ItemsStructure,
    ItemsModal,
    ItemsActions,
  },
  props: {
    payload: Object,
  },
  setup() {
    const { itemsUtils } = useItemsUtils();

    return { itemsUtils };
  },
  methods: {
    getItem(key) {
      return this.payload.items.find((item) => item.key === key);
    },
  },
};
</script>

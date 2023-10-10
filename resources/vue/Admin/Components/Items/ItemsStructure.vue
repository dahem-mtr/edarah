<template>
  <div class="items-container">
    <div v-for="(rowKeys, i) in structure" :key="i" class="row-items">
      <template v-for="(key, i) in rowKeys" :key="i">

        <template v-if="!isArray(key)">
          <div v-if="pushToEnd(getItem(key).options)" class="push-to-end" />
          <Item :item="getItem(key)"/>
        </template>

        <template v-else>
          <div v-if="pushToEnd(getItem(key[0]).options)" class="push-to-end" />
          <div class="items-nested">
            <template v-for="(keyNested, i) in key" :key="i">
              <Item :item="getItem(keyNested)"/>
            </template>
          </div>
        </template>
        
      </template>
    </div>
     
  </div>
  
</template>

<script>

import Item from "../Item.vue";


export default {
  components: { Item },
  props: {
    structure: Array,
    getItem: Function,

  },
  methods: {
    isArray(prop) {
      return typeof prop === "object";
    },
    pushToEnd(options) {
      return options && options["pushToEnd"];
    },
  },
};
</script>



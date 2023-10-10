<template>
  <div v-for="(rowStructure, i) in payload.structure" :key="i" class="row">
        <template v-for="(fieldCol, fieldName, i) in rowStructure" :key="i">
          <DeclarePropsForChild
            :field="defineField(fieldName)"
            v-slot="{ field }"
          >
            <div :class="'col-md-' + fieldCol">
              <div class="d-flex flex-row">
                <label class="form-label inline" v-html="field.displayName"> </label>
                <div v-if="field.withRequiredMark" class="text-danger mx-1">
                  *
                </div>
              </div>

              <component
                :is="field.component"
                :field="field"
                @update-value="(value) => (form[field.name] = value)"
                
              />
              <div v-if="form.errors[field.name]" class="text-danger">
                {{ form.errors[field.name] }}
              </div>
              <div class="text-muted">{{ field.note }}</div>
            </div>
          </DeclarePropsForChild>
        </template>
      </div>
</template>
<script>
import * as Fields from "../../Components/Fields/Shared/index";
import DeclarePropsForChild from "../../Utils/DeclarePropsForChild.vue";


export default {
  components: {  ...Fields,DeclarePropsForChild },

  props: {
    payload: Object,
    form: Object,
    defineField: Function,

  },
  
  
};
</script>

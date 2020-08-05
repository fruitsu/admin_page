<template>
  <div class="form-group">
    <label v-if="label">{{label}}</label>
    <v-select :options="items" v-model="selected" :label="labelBy"/>
    <input v-if="selected" type="hidden" :name="name" :value="selected[tagBy]">
  </div>
</template>

<script>
  import vSelect from 'vue-select';

  vSelect.props.components.default = () => ({
    Deselect: {
      render: createElement => createElement('span', '✕'),
    },
    OpenIndicator: {
      render: createElement => createElement('span', '↓'),
    },
  });

  export default {
    props: {
      options: String | Array | Object,
      value: String,
      label: String,
      labelBy: {
        type: String,
        default: 'title'
      },
      tagBy: {
        type: String,
        default: 'id'
      },
      name: {
        type: String,
        required: true
      }
    },

    components: {
      vSelect
    },

    data() {
      return {
        selected: null,
        items: this.options || null
      }
    },

    created() {
      if (this.options && typeof this.options === 'string') {
        this.items = JSON.parse(this.options);
      }

      if (this.value) {
        let value = this.value;

        if (typeof this.value === 'string') {
          value = JSON.parse(this.value)
        }

          this.selected = this.items.find(i => i[this.tagBy] === value.id);
      }
    }
  }
</script>


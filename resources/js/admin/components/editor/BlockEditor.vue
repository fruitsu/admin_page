<template>
  <form class="block-editor" :action="action" method="post" enctype="multipart/form-data">
    <div class="block-editor__header d-flex justify-content-between align-items-center">
      <div class="lang-switcher btn-group ml-auto">
        <button type="button" class="btn btn-sm"
                v-for="(lang, index) in locales" :key="index"
                :class="current === lang ? 'btn-primary' : 'btn-dark'"
                @click.prevent="current = lang">
          {{ langs[index] }}
        </button>
      </div>
    </div>

    <div class="block-editor__body">
      <div class="row">
        <div class="col-12"
             :class="{'col-md-8 col-lg-9': $slots.images}">
          <div v-for="locale in locales" v-show="locale === current" :key="locale">
            <slot :name="locale"/>
          </div>
        </div>

        <div class="col-md-4 col-lg-3" v-if="$slots.images">
          <slot name="images"/>
        </div>
      </div>

      <slot/>
    </div>
  </form>
</template>

<script>
  const locales = JSON.parse(document.head.querySelector('[name="locales"]').content);

  export default {
    props: {
      action: String,
    },
    data() {
      return {
        current: locales[0],
        locales: locales,
        langs: []
      }
    },
    mounted() {
      const langs = {
        ru: 'Русский',
        uk: 'Українська',
        en: 'English'
      };
      this.langs = this.locales.map(l => {
        return langs[l];
      });
    }
  }
</script>

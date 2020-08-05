import Vue from 'vue';

const lang = document.documentElement.lang;

/**
 * @param key
 * @param replace
 * @returns {T}
 */
Vue.prototype.trans = (key, replace = {}) => {
  let translation = key.split('.').reduce((t, i) => t[i] || null, window.i18n[lang]);

  for (let placeholder in replace) {
    translation = translation.replace(`:${placeholder}`, replace[placeholder]);
  }

  return translation;
};

/**
 * @param key
 * @param count
 * @param replace
 * @returns {parser.Node[] | * | string}
 */
Vue.prototype.trans_choice = (key, count = 1, replace = {}) => {
  let translation = key.split('.').reduce((t, i) => t[i] || null, window.i18n[lang]).split('|');

  translation = count > 1 ? translation[1] : translation[0];

  for (let placeholder in replace) {
    translation = translation.replace(`:${placeholder}`, replace[placeholder]);
  }

  return translation;
};

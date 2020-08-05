require('../global/modules/http');

import Vue from 'vue';

// import {Wysiwyg, SingleUploader, MultiUploader, BlockEditor, Options} from './components/Editor';

import Wysiwyg from './components/editor/Wysiwyg/Editor';
import ImageUploader from "./components/editor/ImageUploader";
import MultiUploader from "./components/editor/MultiUploader";
import BlockEditor from "./components/editor/BlockEditor";
import Options from "./components/editor/Options";
// import Repeater from "./components/repeater/Repeater";
import Password from "./components/auth/Password";
import Scrollbar from '../global/directives/scrollbar';


Vue.directive('scrollbar', Scrollbar);

new Vue({
  el: '#app',
  components: {
    Wysiwyg,
    ImageUploader,
    MultiUploader,
    BlockEditor,
    Options,
    Password
  },
  mounted() {
    require('./modules/notifications');
  }
});


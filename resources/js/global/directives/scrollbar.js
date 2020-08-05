import PerfectScrollbar from "perfect-scrollbar";

export default {
  inserted(el) {
    el.style.overflow = 'hidden';
    el.scrollbar = new PerfectScrollbar(el, {
        suppressScrollX: true
    });
  },

  update(el) {
    el.scrollbar.update();
  }
}

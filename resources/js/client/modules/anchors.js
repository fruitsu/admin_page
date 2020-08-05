const anchors = document.querySelectorAll('a[href*="#"]');

Array.from(anchors).forEach(a => {
  a.addEventListener('click', event => {
    event.preventDefault();

    const el = a.href.match(/#\w+/gi)

    if (el.length) {
      const section = document.querySelector(el[0]);

      if (section) section.scrollIntoView({block: "start", behavior: "smooth"});
    }
  })
});

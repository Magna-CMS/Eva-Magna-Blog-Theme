{{--
    Eva behaviour — small, dependency-free, progressive. Everything here is an
    enhancement: the page reads and navigates fully without JavaScript.

      • colour-scheme toggle for the fallback header (shares the core
        scheme-toggle block's "magna-theme" storage key)
      • mobile menu
      • reading-progress bar on Blog post pages
      • back-to-top button
      • heading anchors inside post bodies
--}}
<script>
(function () {
    var root = document.documentElement;
    var media = window.matchMedia ? window.matchMedia('(prefers-color-scheme: dark)') : null;

    function currentScheme() {
        var set = root.getAttribute('data-theme');
        if (set === 'light' || set === 'dark') { return set; }
        return media && media.matches ? 'dark' : 'light';
    }

    function syncSchemeButtons() {
        var dark = currentScheme() === 'dark';
        document.querySelectorAll('[data-eva-scheme]').forEach(function (btn) {
            btn.setAttribute('aria-pressed', dark ? 'true' : 'false');
        });
    }

    document.querySelectorAll('[data-eva-scheme]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var next = currentScheme() === 'dark' ? 'light' : 'dark';
            root.setAttribute('data-theme', next);
            try { localStorage.setItem('magna-theme', next); } catch (e) {}
            syncSchemeButtons();
        });
    });
    if (media && media.addEventListener) { media.addEventListener('change', syncSchemeButtons); }
    syncSchemeButtons();

    // Mobile menu
    var menuBtn = document.querySelector('[data-eva-menu-toggle]');
    var mobileNav = document.getElementById('eva-mobile-nav');
    if (menuBtn && mobileNav) {
        menuBtn.addEventListener('click', function () {
            var open = menuBtn.getAttribute('aria-expanded') === 'true';
            menuBtn.setAttribute('aria-expanded', open ? 'false' : 'true');
            menuBtn.setAttribute('aria-label', open ? 'Open menu' : 'Close menu');
            mobileNav.hidden = open;
        });
        mobileNav.addEventListener('click', function (event) {
            if (event.target.closest('a')) {
                mobileNav.hidden = true;
                menuBtn.setAttribute('aria-expanded', 'false');
            }
        });
    }

    // Reading progress (only where there is an article to read)
    var bar = document.querySelector('[data-eva-progress]');
    var article = document.querySelector('.magna-blog-post');
    var toTop = document.querySelector('[data-eva-to-top]');
    var ticking = false;

    if (article && bar) { bar.classList.add('is-active'); }

    function onScroll() {
        ticking = false;
        var y = window.scrollY || window.pageYOffset;
        if (article && bar) {
            var start = article.offsetTop;
            var end = start + article.offsetHeight - window.innerHeight;
            var pct = end > start ? Math.min(1, Math.max(0, (y - start) / (end - start))) : 1;
            bar.style.transform = 'scaleX(' + pct + ')';
        }
        if (toTop) { toTop.hidden = y < 640; }
    }
    window.addEventListener('scroll', function () {
        if (!ticking) { ticking = true; window.requestAnimationFrame(onScroll); }
    }, { passive: true });
    onScroll();

    function scrollTop() {
        var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        window.scrollTo({ top: 0, behavior: reduce ? 'auto' : 'smooth' });
    }
    if (toTop) { toTop.addEventListener('click', scrollTop); }
    document.querySelectorAll('[data-eva-scroll-top]').forEach(function (btn) {
        btn.addEventListener('click', scrollTop);
    });

    // Anchor links on post headings (Blog renders ids for the table of contents)
    document.querySelectorAll('.post-body > h2[id], .post-body > h3[id]').forEach(function (h) {
        var a = document.createElement('a');
        a.className = 'eva-anchor';
        a.href = '#' + h.id;
        a.setAttribute('aria-label', 'Link to this section');
        a.textContent = '#';
        h.appendChild(a);
    });
})();
</script>

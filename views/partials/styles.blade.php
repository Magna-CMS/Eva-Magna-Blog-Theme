{{--
    Eva stylesheet — inlined into every page (Magna serves no theme asset
    files, and the page cache stores the full HTML anyway).

    Written only against the design tokens from tokens.json, so the Design
    tab, style schedules, per-section token overrides and light/dark all
    work without touching this file.

    Map:
      1. Base & typography          6. Blog: post page
      2. Shell: header, footer      7. Blog: post body (Editor.js output)
      3. Page structure & bands     8. Blog: comments
      4. Core blocks                9. Blog posts block, Loop, pagination
      5. Pages blocks & chrome     10. Utilities & motion
--}}
<style>
/* ───────────────────────── 1. Base & typography ───────────────────────── */
:root {
    --eva-shadow-sm: 0 1px 2px rgba(26, 24, 19, .05);
    --eva-shadow-md: 0 10px 30px -12px rgba(26, 24, 19, .18);
    --eva-shadow-lg: 0 24px 60px -24px rgba(26, 24, 19, .28);
    --eva-ease: cubic-bezier(.16, 1, .3, 1);
    --eva-header-bg: color-mix(in srgb, var(--color-bg) 88%, transparent);
    color-scheme: light;
}
:root[data-theme="dark"] { color-scheme: dark; --eva-shadow-md: 0 10px 30px -12px rgba(0,0,0,.6); --eva-shadow-lg: 0 24px 60px -24px rgba(0,0,0,.7); }

*, *::before, *::after { box-sizing: border-box; }
html { -webkit-text-size-adjust: 100%; scroll-behavior: smooth; scroll-padding-top: calc(var(--header-height) + 1rem); }
@media (prefers-reduced-motion: reduce) { html { scroll-behavior: auto; } *, *::before, *::after { animation-duration: .01ms !important; transition-duration: .01ms !important; } }

body {
    margin: 0;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    background: var(--color-bg);
    color: var(--color-text);
    font-family: var(--font-body);
    font-size: var(--base-size);
    line-height: var(--line-height);
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    transition: background-color .3s ease, color .3s ease;
}
::selection { background: var(--color-primary-line); color: var(--color-primary-strong); }
img, video, iframe, svg { max-width: 100%; }
img, video { height: auto; display: block; }
a { color: var(--color-primary); text-decoration-thickness: 1px; text-underline-offset: .2em; transition: color .2s ease; }
a:hover { color: var(--color-primary-strong); }
h1, h2, h3, h4, h5, h6 { font-family: var(--font-heading); color: var(--color-heading); font-weight: 500; line-height: 1.15; letter-spacing: -.015em; margin: 0 0 .5em; text-wrap: balance; }
h1 { font-size: clamp(2.25rem, 1.6rem + 2.6vw, 3.6rem); }
h2 { font-size: clamp(1.75rem, 1.4rem + 1.4vw, 2.5rem); }
h3 { font-size: clamp(1.3rem, 1.15rem + .6vw, 1.6rem); }
h4 { font-size: 1.2rem; }
h5 { font-size: 1.05rem; }
h6 { font-size: .95rem; }
p { margin: 0 0 1em; }
hr { border: 0; border-top: 1px solid var(--color-border); margin: 2rem 0; }
code, kbd, samp { font-family: var(--font-mono); font-size: .875em; }
:not(pre) > code { background: var(--color-surface-alt); border: 1px solid var(--color-border); border-radius: 6px; padding: .1em .35em; }
mark { background: var(--color-primary-line); color: inherit; padding: 0 .15em; border-radius: 3px; }
:focus-visible { outline: 2px solid var(--color-primary); outline-offset: 3px; border-radius: 4px; }

::-webkit-scrollbar { width: 8px; height: 8px; }
::-webkit-scrollbar-track { background: transparent; }
::-webkit-scrollbar-thumb { background: var(--color-border-strong); border-radius: 4px; }

.eva-skip { position: absolute; left: 1rem; top: -100px; z-index: 100; background: var(--color-ink); color: var(--color-on-ink); padding: .6rem 1rem; border-radius: var(--radius-sm); font-weight: 600; text-decoration: none; }
.eva-skip:focus { top: 1rem; color: var(--color-on-ink); }

.eva-main { flex: 1 0 auto; }

/* Reading progress */
.eva-progress { position: fixed; inset: 0 0 auto 0; height: 3px; z-index: 60; background: var(--color-primary); transform: scaleX(0); transform-origin: 0 50%; opacity: 0; transition: opacity .3s ease; pointer-events: none; }
.eva-progress.is-active { opacity: 1; }

/* ───────────────────────── 2. Shell: header & footer ───────────────────────── */
.eva-header--fallback {
    position: sticky; top: 0; z-index: 40;
    background: var(--eva-header-bg);
    -webkit-backdrop-filter: saturate(140%) blur(12px); backdrop-filter: saturate(140%) blur(12px);
    border-bottom: 1px solid var(--color-border);
}
.eva-header__bar { max-width: var(--max-width); margin-inline: auto; padding: 0 var(--gutter); height: var(--header-height); display: flex; align-items: center; justify-content: space-between; gap: 1.5rem; }

.eva-brand { display: inline-flex; align-items: center; gap: .75rem; text-decoration: none; color: var(--color-heading); }
.eva-brand:hover { color: var(--color-heading); }
.eva-brand__mark { width: 2.5rem; height: 2.5rem; flex: none; border-radius: 50%; border: 1px solid var(--color-border-strong); background: var(--color-surface); display: grid; place-items: center; font-family: var(--font-heading); font-weight: 700; font-size: 1.25rem; color: var(--color-primary); transition: transform .3s var(--eva-ease), border-color .3s ease; }
.eva-brand:hover .eva-brand__mark { transform: scale(1.06); border-color: var(--color-primary); }
.eva-brand__mark--solid { width: 1.6rem; height: 1.6rem; font-size: .8rem; border: 0; background: var(--color-primary); color: var(--color-on-primary); }
.eva-brand__text { display: flex; flex-direction: column; line-height: 1.1; }
.eva-brand__name { font-family: var(--font-heading); font-size: 1.5rem; font-weight: 500; letter-spacing: -.02em; }
.eva-brand--small .eva-brand__name { font-size: 1.15rem; }
.eva-brand__tag { font-size: .6875rem; font-weight: 600; letter-spacing: .2em; text-transform: uppercase; color: var(--color-subtle); margin-top: .2rem; }

.eva-nav { flex: 1; display: flex; justify-content: center; }
.eva-header__actions { display: flex; align-items: center; gap: .35rem; }
.eva-icon-btn { appearance: none; border: 0; background: transparent; color: var(--color-muted); width: 2.5rem; height: 2.5rem; border-radius: 50%; display: inline-grid; place-items: center; cursor: pointer; transition: background-color .2s ease, color .2s ease; }
.eva-icon-btn:hover { background: var(--color-surface-alt); color: var(--color-primary); }
.eva-icon-sun { display: none; }
:root[data-theme="dark"] .eva-icon-sun { display: block; }
:root[data-theme="dark"] .eva-icon-moon { display: none; }
@media (prefers-color-scheme: dark) {
    :root:not([data-theme="light"]) .eva-icon-sun { display: block; }
    :root:not([data-theme="light"]) .eva-icon-moon { display: none; }
}
.eva-menu-btn { display: none; }
.eva-mobile-nav { border-top: 1px solid var(--color-border); padding: .75rem var(--gutter) 1.25rem; }
.eva-mobile-nav[hidden] { display: none; }
.eva-mobile-nav .magna-nav__list { flex-direction: column; align-items: stretch; gap: 0; }
.eva-mobile-nav .magna-nav__list a { display: block; padding: .7rem .25rem; font-size: 1rem; }
.eva-mobile-nav .magna-nav__list--depth-1 { position: static; display: block; box-shadow: none; border: 0; padding: 0 0 0 1rem; background: transparent; min-width: 0; }
@media (max-width: 860px) {
    .eva-header--fallback .eva-nav { display: none; }
    .eva-menu-btn { display: inline-grid; }
    .eva-brand__name { font-size: 1.3rem; }
}

/* Template-part header (built in the Pages builder) */
.eva-header--part { position: relative; z-index: 40; }
.eva-header--part .magna-chrome--header { background: var(--eva-header-bg); -webkit-backdrop-filter: saturate(140%) blur(12px); backdrop-filter: saturate(140%) blur(12px); border-bottom: 1px solid var(--color-border); }
.eva-header--part .magna-section__inner { padding-block: .9rem; }
.eva-header--part .magna-columns { align-items: center; }
.eva-header--part .magna-column:last-child { display: flex; justify-content: flex-end; align-items: center; gap: .5rem; }
.eva-header--part .magna-logo__text { font-family: var(--font-heading); font-size: 1.5rem; font-weight: 500; color: var(--color-heading); letter-spacing: -.02em; }
.eva-header--part .magna-logo__heading { margin: 0; font-size: inherit; }
@media (max-width: 640px) {
    .eva-header--part .magna-columns { flex-direction: row !important; flex-wrap: wrap; }
    .eva-header--part .magna-column { flex: 1 1 auto !important; }
    .eva-header--part .magna-nav { overflow-x: auto; }
}

/* Footer */
.eva-footer { background: var(--color-chrome); border-top: 1px solid var(--color-border); color: var(--color-muted); font-size: .875rem; flex: none; }
.eva-footer__inner { max-width: var(--max-width); margin-inline: auto; padding: 4rem var(--gutter) 2rem; }
.eva-footer__grid { display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 2.5rem; margin-bottom: 3rem; }
.eva-footer__blurb { max-width: 26rem; margin: 1rem 0 0; font-size: .8125rem; line-height: 1.7; color: var(--color-muted); }
.eva-footer__heading { font-family: var(--font-body); font-size: .75rem; font-weight: 600; letter-spacing: .1em; text-transform: uppercase; color: var(--color-heading); margin: 0 0 1rem; }
.eva-footer__links { list-style: none; margin: 0; padding: 0; display: grid; gap: .6rem; }
.eva-footer__links a, .eva-footer__link-btn { color: var(--color-muted); text-decoration: none; font-size: .8125rem; }
.eva-footer__links a:hover, .eva-footer__link-btn:hover { color: var(--color-primary); }
.eva-footer__link-btn { appearance: none; background: none; border: 0; padding: 0; cursor: pointer; font-family: inherit; }
.eva-footer__bottom { border-top: 1px solid var(--color-border); padding-top: 1.75rem; display: flex; flex-wrap: wrap; justify-content: space-between; gap: 1rem; font-size: .75rem; color: var(--color-subtle); }
.eva-footer__credit { display: inline-flex; align-items: center; gap: .5rem; }
.eva-dot { width: .5rem; height: .5rem; border-radius: 50%; background: var(--color-success); display: inline-block; }
@media (max-width: 760px) { .eva-footer__grid { grid-template-columns: 1fr 1fr; } .eva-footer__brand { grid-column: 1 / -1; } }
.eva-footer--part .magna-section__inner { padding-block: 3rem; }
.eva-footer--part .magna-heading h2, .eva-footer--part .magna-heading h3, .eva-footer--part .magna-heading h4 { font-family: var(--font-body); font-size: .75rem; font-weight: 600; letter-spacing: .1em; text-transform: uppercase; }
.eva-footer--part .magna-nav__list { flex-direction: column; align-items: flex-start; gap: .25rem; }
.eva-footer--part .magna-nav__list a { padding: .2rem 0; font-size: .8125rem; color: var(--color-muted); }
.eva-footer--part .magna-prose { font-size: .8125rem; color: var(--color-muted); }

/* Back to top */
.eva-to-top { position: fixed; right: 1.5rem; bottom: 1.5rem; z-index: 45; width: 2.9rem; height: 2.9rem; border-radius: 50%; border: 1px solid var(--color-border); background: var(--color-surface); color: var(--color-muted); box-shadow: var(--eva-shadow-md); display: grid; place-items: center; cursor: pointer; transition: transform .25s var(--eva-ease), color .2s ease, border-color .2s ease; }
.eva-to-top[hidden] { display: none; }
.eva-to-top:hover { color: var(--color-primary); border-color: var(--color-primary); transform: translateY(-2px); }

/* ───────────────────────── 3. Page structure & section bands ───────────────────────── */
.magna-section { position: relative; }
.magna-section__inner { max-width: var(--max-width); margin-inline: auto; padding: var(--section-y) var(--gutter); }
.magna-columns { display: flex; flex-wrap: wrap; gap: 2rem; }
.magna-column { min-width: 0; }
.magna-column > * + * { margin-top: 1.5rem; }
@media (max-width: 767.98px) {
    :root { --section-y: 3rem; --gutter: 1.1rem; }
    .magna-columns { flex-direction: column; }
    .magna-column { flex: 1 1 100% !important; }
}

/* Band vocabulary — add these in a section's "CSS class" setting. */
.eva-band--muted { background: var(--color-surface-alt); border-block: 1px solid var(--color-border); }
.eva-band--rule > .magna-section__inner { border-bottom: 1px solid var(--color-border); }
.eva-band--ruled { border-bottom: 1px solid var(--color-border); }
.eva-band--tight > .magna-section__inner { padding-block: calc(var(--section-y) / 2); }
.eva-band--flush > .magna-section__inner { padding-top: 0; }
.eva-band--narrow > .magna-section__inner { max-width: calc(var(--content-width) + 2 * var(--gutter)); }
.eva-band--center { text-align: center; }
.eva-band--center .magna-heading { text-align: center; }
.eva-band--panel > .magna-section__inner > .magna-columns { background: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-lg); padding: clamp(1.5rem, 4vw, 3rem); box-shadow: var(--eva-shadow-sm); align-items: center; }
.eva-band--ink { background: var(--color-ink); color: var(--color-on-ink); }
.eva-band--ink :is(h1, h2, h3, h4, .magna-hero__headline, .magna-cta__headline) { color: var(--color-on-ink); }
.eva-band--ink .magna-prose, .eva-band--ink .magna-cta__body { color: color-mix(in srgb, var(--color-on-ink) 75%, transparent); }
.eva-band--ink .magna-btn--primary { background: var(--color-primary); color: var(--color-on-primary); }

/* ───────────────────────── 4. Core blocks ───────────────────────── */
/* Heading — h6 is Eva's eyebrow label */
.magna-heading > :is(h1, h2, h3, h4, h5) { margin: 0; }
.magna-heading--center { text-align: center; }
.magna-heading--right { text-align: right; }
.eva-eyebrow { margin: 0; font-family: var(--font-body); font-size: .75rem; font-weight: 600; line-height: 1.4; letter-spacing: .18em; text-transform: uppercase; color: var(--color-primary); display: inline-flex; align-items: center; gap: .6rem; }
.eva-eyebrow::before { content: ""; flex: none; width: .55rem; height: .55rem; border-radius: 50%; background: var(--color-primary); animation: eva-pulse 2.4s ease-in-out infinite; }
.magna-heading > h6 { margin: 0; font-family: var(--font-body); font-size: .75rem; font-weight: 600; letter-spacing: .18em; text-transform: uppercase; color: var(--color-primary); }
.magna-column > .eva-eyebrow-wrap + * { margin-top: .9rem; }
.magna-column > .magna-heading + .magna-heading, .magna-column > .magna-heading + .magna-prose { margin-top: .75rem; }

/* Text */
.magna-prose { color: var(--color-muted); font-size: 1.0625rem; }
.magna-prose > :last-child { margin-bottom: 0; }
.magna-prose :is(h2, h3, h4) { margin-top: 1.5em; }
.magna-prose ul, .magna-prose ol { padding-left: 1.25rem; }
.magna-prose blockquote { margin: 1.5rem 0; padding-left: 1.25rem; border-left: 3px solid var(--color-primary); font-family: var(--font-heading); font-style: italic; font-size: 1.25rem; color: var(--color-heading); }
.magna-prose img { border-radius: var(--radius-md); }
.magna-prose table { width: 100%; border-collapse: collapse; }
.magna-prose th, .magna-prose td { border-bottom: 1px solid var(--color-border); padding: .6rem .5rem; text-align: left; }

/* Buttons */
.magna-btn, .post-body .btn, .post-comments__submit {
    display: inline-flex; align-items: center; justify-content: center; gap: .5rem;
    padding: .7rem 1.35rem; border-radius: var(--radius-pill);
    font-family: var(--font-body); font-size: .9rem; font-weight: 600; line-height: 1.2;
    text-decoration: none; border: 1px solid transparent; cursor: pointer;
    transition: background-color .2s ease, color .2s ease, border-color .2s ease, transform .2s var(--eva-ease), box-shadow .2s ease;
}
.magna-btn:hover { transform: translateY(-1px); }
.magna-btn--primary, .post-comments__submit { background: var(--color-ink); color: var(--color-on-ink); box-shadow: var(--eva-shadow-sm); }
.magna-btn--primary:hover, .post-comments__submit:hover { background: var(--color-primary); color: var(--color-on-primary); }
.magna-btn--secondary { background: var(--color-primary); color: var(--color-on-primary); }
.magna-btn--secondary:hover { background: var(--color-primary-strong); color: var(--color-on-primary); }
.magna-btn--outline { background: transparent; color: var(--color-heading); border-color: var(--color-border-strong); }
.magna-btn--outline:hover { border-color: var(--color-primary); color: var(--color-primary); }
.magna-btn--ghost { background: transparent; color: var(--color-primary); padding-inline: .5rem; }
.magna-btn--ghost:hover { color: var(--color-primary-strong); background: var(--color-primary-soft); }
.magna-btn--sm { padding: .45rem .95rem; font-size: .8rem; }
.magna-btn--lg { padding: .95rem 1.8rem; font-size: 1rem; }

/* Hero */
.magna-hero { padding-block: clamp(1rem, 4vw, 3rem); }
.magna-hero__content { max-width: 52rem; }
.magna-hero--centered { text-align: center; }
.magna-hero--centered .magna-hero__content { margin-inline: auto; }
.magna-hero__headline { font-size: clamp(2.6rem, 1.6rem + 4vw, 4.75rem); line-height: 1.05; letter-spacing: -.03em; margin-bottom: 1.25rem; }
.magna-hero__subheadline { font-size: clamp(1.05rem, 1rem + .4vw, 1.3rem); color: var(--color-muted); max-width: 40rem; line-height: 1.6; }
.magna-hero--centered .magna-hero__subheadline { margin-inline: auto; }
.magna-hero__ctas { display: flex; flex-wrap: wrap; gap: .75rem; margin-top: 2rem; }
.magna-hero--centered .magna-hero__ctas { justify-content: center; }
.magna-hero--full-bleed { background: var(--color-surface-alt); border: 1px solid var(--color-border); border-radius: var(--radius-lg); padding: clamp(2rem, 6vw, 5rem); }

/* Call to action — Eva's newsletter panel */
.magna-cta { background: var(--color-surface-alt); border: 1px solid var(--color-border); border-radius: var(--radius-lg); padding: clamp(2rem, 5vw, 4rem); }
.magna-cta--centered { text-align: center; }
.magna-cta--centered::before { content: ""; display: block; width: 3rem; height: 3rem; margin: 0 auto 1.5rem; border-radius: var(--radius-md); border: 1px solid var(--color-primary-line); background: var(--color-primary-soft) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23C35C3A' stroke-width='1.8' stroke-linecap='round' stroke-linejoin='round'%3E%3Crect x='3' y='5' width='18' height='14' rx='2'/%3E%3Cpath d='m3 7 9 6 9-6'/%3E%3C/svg%3E") center / 1.4rem no-repeat; }
.magna-cta__headline { font-size: clamp(1.9rem, 1.4rem + 2vw, 3rem); max-width: 40rem; }
.magna-cta--centered .magna-cta__headline, .magna-cta--centered .magna-cta__body { margin-inline: auto; }
.magna-cta__body { color: var(--color-muted); max-width: 36rem; font-size: 1.05rem; }
.magna-cta__actions { display: flex; flex-wrap: wrap; gap: .75rem; margin-top: 1.75rem; }
.magna-cta--centered .magna-cta__actions { justify-content: center; }
.magna-cta--left-right { display: grid; grid-template-columns: 1fr auto; gap: .5rem 2rem; align-items: center; }
.magna-cta--left-right .magna-cta__actions { grid-row: 1 / span 2; grid-column: 2; margin: 0; }
@media (max-width: 700px) { .magna-cta--left-right { grid-template-columns: 1fr; } .magna-cta--left-right .magna-cta__actions { grid-row: auto; grid-column: auto; } }

/* Callout */
.magna-callout { --eva-tone: var(--color-info); display: block; border: 1px solid color-mix(in srgb, var(--eva-tone) 30%, transparent); background: color-mix(in srgb, var(--eva-tone) 8%, var(--color-surface)); border-left: 4px solid var(--eva-tone); border-radius: var(--radius-sm); padding: 1rem 1.25rem; }
.magna-callout--success { --eva-tone: var(--color-success); }
.magna-callout--warning { --eva-tone: var(--color-warning); }
.magna-callout--danger { --eva-tone: var(--color-danger); }
.magna-callout__heading { margin: 0 0 .25rem; font-weight: 700; color: var(--color-heading); }
.magna-callout__body { color: var(--color-text); }
.magna-callout__body > :last-child { margin-bottom: 0; }

/* Code */
.magna-code { margin: 0; border-radius: var(--radius-md); overflow: hidden; background: var(--color-code-bg); border: 1px solid var(--color-border); }
.magna-code__filename { font-family: var(--font-mono); font-size: .75rem; color: var(--color-subtle); padding: .6rem 1rem; border-bottom: 1px solid rgba(255,255,255,.08); }
.magna-code__pre { margin: 0; padding: 1.1rem 1.25rem; overflow-x: auto; color: var(--color-code-text); font-size: .875rem; line-height: 1.7; }

/* Divider */
.magna-divider { border: 0; border-top: 1px solid var(--color-border); margin: 0; }
.magna-divider--dashed { border-top-style: dashed; }
.magna-divider--dotted { border-top-style: dotted; border-top-width: 2px; }
.magna-divider--icon-center { display: flex; align-items: center; gap: 1rem; border: 0; color: var(--color-primary); }
.magna-divider__line { flex: 1; border: 0; border-top: 1px solid var(--color-border); margin: 0; }

/* Entries */
.magna-entries { display: grid; gap: 1.5rem; }
.magna-entries--grid, .magna-entries--cards { grid-template-columns: repeat(auto-fill, minmax(min(100%, 18rem), 1fr)); }
.magna-entries__item { background: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-md); padding: 1.5rem; transition: transform .3s var(--eva-ease), box-shadow .3s ease; }
.magna-entries--list .magna-entries__item { background: none; border: 0; border-bottom: 1px solid var(--color-border); border-radius: 0; padding: 0 0 1.25rem; }
.magna-entries__item:hover { transform: translateY(-3px); box-shadow: var(--eva-shadow-md); }
.magna-entries--list .magna-entries__item:hover { transform: none; box-shadow: none; }
.magna-entries__title { font-size: 1.35rem; margin: 0 0 .5rem; }
.magna-entries__title a { color: var(--color-heading); text-decoration: none; }
.magna-entries__title a:hover { color: var(--color-primary); }
.magna-entries__excerpt { color: var(--color-muted); font-size: .95rem; margin: 0 0 .75rem; }
.magna-entries__date { font-size: .75rem; color: var(--color-subtle); font-family: var(--font-mono); }
.magna-entries__empty { color: var(--color-muted); font-style: italic; }

/* FAQ */
.magna-faq { border-top: 1px solid var(--color-border); }
.magna-faq__item { border-bottom: 1px solid var(--color-border); }
.magna-faq__question { list-style: none; cursor: pointer; padding: 1.25rem 2.5rem 1.25rem 0; position: relative; font-family: var(--font-heading); font-size: 1.25rem; color: var(--color-heading); }
.magna-faq__question::-webkit-details-marker { display: none; }
.magna-faq__question::after { content: "+"; position: absolute; right: .25rem; top: 50%; transform: translateY(-50%); font-family: var(--font-body); font-size: 1.4rem; font-weight: 300; color: var(--color-primary); transition: transform .3s var(--eva-ease); }
.magna-faq__item[open] .magna-faq__question::after { transform: translateY(-50%) rotate(45deg); }
.magna-faq__answer { padding: 0 0 1.25rem; color: var(--color-muted); }

/* Features — Eva's topic cards */
.magna-features { display: grid; gap: 1rem; }
.magna-features--icon-grid { grid-template-columns: repeat(auto-fit, minmax(min(100%, 10.5rem), 1fr)); }
.magna-features--horizontal-list { grid-template-columns: 1fr; }
.magna-features__item { background: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-md); padding: 1.5rem 1.25rem; text-align: center; transition: transform .3s var(--eva-ease), border-color .3s ease, box-shadow .3s ease; }
.magna-features--horizontal-list .magna-features__item { display: grid; grid-template-columns: auto 1fr; gap: .25rem 1rem; text-align: left; align-items: start; }
.magna-features--horizontal-list .magna-features__icon { grid-row: span 2; margin: 0; }
.magna-features__item:hover { transform: translateY(-3px); border-color: var(--color-primary-line); box-shadow: var(--eva-shadow-md); }
.magna-features__icon { width: 2.75rem; height: 2.75rem; margin: 0 auto .9rem; border-radius: 50%; background: var(--color-primary-soft); color: var(--color-primary); display: grid; place-items: center; font-family: var(--font-heading); font-size: 1.15rem; }
.magna-features__icon svg { width: 1.2rem; height: 1.2rem; }
.magna-features__title { font-family: var(--font-body); font-size: .95rem; font-weight: 600; margin: 0 0 .3rem; letter-spacing: 0; }
.magna-features__item:hover .magna-features__title { color: var(--color-primary); }
.magna-features__description { font-size: .8125rem; color: var(--color-muted); margin: 0; }

/* File */
.magna-file { border: 1px solid var(--color-border); border-radius: var(--radius-md); padding: 1rem 1.25rem; background: var(--color-surface); }
.magna-file__link { display: flex; justify-content: space-between; gap: 1rem; text-decoration: none; font-weight: 600; color: var(--color-heading); }
.magna-file__link:hover { color: var(--color-primary); }
.magna-file__meta { font-family: var(--font-mono); font-size: .75rem; color: var(--color-subtle); font-weight: 400; }
.magna-file__description { margin: .5rem 0 0; color: var(--color-muted); font-size: .875rem; }

/* Gallery */
.magna-gallery { display: grid; gap: .75rem; grid-template-columns: repeat(3, 1fr); }
.magna-gallery--cols-2 { grid-template-columns: repeat(2, 1fr); }
.magna-gallery--cols-4 { grid-template-columns: repeat(4, 1fr); }
@media (max-width: 640px) { .magna-gallery { grid-template-columns: repeat(2, 1fr); } }
.magna-gallery__item { display: block; overflow: hidden; border-radius: var(--radius-sm); aspect-ratio: 4 / 3; background: var(--color-surface-alt); }
.magna-gallery__item img { width: 100%; height: 100%; object-fit: cover; transition: transform .7s var(--eva-ease); }
.magna-gallery__item:hover img { transform: scale(1.04); }

/* Icon */
.magna-icon { color: var(--color-primary); display: inline-flex; }
.magna-icon--sm svg { width: 1rem; height: 1rem; } .magna-icon--md svg { width: 1.5rem; height: 1.5rem; }
.magna-icon--lg svg { width: 2.25rem; height: 2.25rem; } .magna-icon--xl svg { width: 3.25rem; height: 3.25rem; }

/* Image */
.magna-image { margin: 0; }
.magna-image img { width: 100%; border-radius: var(--radius-md); border: 1px solid var(--color-border); }
.magna-image figcaption, .magna-embed__caption { margin-top: .6rem; font-size: .8125rem; color: var(--color-subtle); text-align: center; }
.magna-image--float-left { float: left; max-width: 45%; margin: 0 1.5rem 1rem 0; }
.magna-image--float-right { float: right; max-width: 45%; margin: 0 0 1rem 1.5rem; }

/* Logo */
.magna-logo { display: inline-flex; }
.magna-logo__link { display: inline-flex; align-items: center; gap: .6rem; text-decoration: none; }
.magna-logo__text { font-family: var(--font-heading); font-size: 1.5rem; color: var(--color-heading); font-weight: 500; }

/* Logos */
.magna-logos { display: flex; flex-wrap: wrap; align-items: center; justify-content: center; gap: 2rem 3rem; }
.magna-logos__item img { max-height: 2.25rem; width: auto; }
.magna-logos--grayscale .magna-logos__item img { filter: grayscale(1); opacity: .6; transition: filter .3s ease, opacity .3s ease; }
.magna-logos--grayscale .magna-logos__item:hover img { filter: none; opacity: 1; }

/* Pricing */
.magna-pricing { display: grid; gap: 1.25rem; grid-template-columns: repeat(auto-fit, minmax(min(100%, 16rem), 1fr)); }
.magna-pricing__tier { background: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-lg); padding: 2rem; display: flex; flex-direction: column; gap: 1rem; }
.magna-pricing__tier--highlighted { border-color: var(--color-primary); box-shadow: 0 0 0 1px var(--color-primary), var(--eva-shadow-md); }
.magna-pricing__name { font-size: 1.35rem; margin: 0; }
.magna-pricing__amount { font-family: var(--font-heading); font-size: 2.75rem; color: var(--color-heading); }
.magna-pricing__period { color: var(--color-muted); font-size: .875rem; margin-left: .25rem; }
.magna-pricing__features { list-style: none; padding: 0; margin: 0; display: grid; gap: .5rem; color: var(--color-muted); font-size: .9rem; flex: 1; }
.magna-pricing__features li::before { content: "✓"; color: var(--color-primary); margin-right: .55rem; }

/* Quote */
.magna-quote { margin: 0; padding: 1rem 0 1rem 1.75rem; border-left: 3px solid var(--color-primary); }
.magna-quote__text { margin: 0; font-family: var(--font-heading); font-style: italic; font-size: clamp(1.4rem, 1.2rem + 1vw, 2rem); line-height: 1.35; color: var(--color-heading); }
.magna-quote__attribution { margin-top: 1rem; font-size: .875rem; color: var(--color-muted); }
.magna-quote__name { font-weight: 600; color: var(--color-heading); }
.magna-quote__name::before { content: "— "; }
.magna-quote__source { font-style: normal; margin-left: .35rem; }
.magna-quote__source::before { content: "· "; }

/* Scheme toggle */
.magna-scheme-toggle__button { appearance: none; border: 1px solid var(--color-border); background: var(--color-surface); color: var(--color-muted); border-radius: var(--radius-pill); padding: .45rem .85rem; font: 600 .75rem var(--font-body); cursor: pointer; transition: color .2s ease, border-color .2s ease; }
.magna-scheme-toggle__button:hover { color: var(--color-primary); border-color: var(--color-primary); }

/* Search */
.magna-search { display: flex; gap: .5rem; align-items: center; position: relative; }
.magna-search__label { position: absolute; width: 1px; height: 1px; overflow: hidden; clip: rect(0 0 0 0); white-space: nowrap; }
.magna-search__input, .post-comments__field input, .post-comments__field textarea {
    flex: 1; width: 100%; padding: .75rem 1rem; border-radius: var(--radius-sm);
    background: var(--color-surface); color: var(--color-text); border: 1px solid var(--color-border);
    font: inherit; font-size: .95rem; transition: border-color .2s ease, box-shadow .2s ease;
}
.magna-search__input:focus, .post-comments__field input:focus, .post-comments__field textarea:focus { outline: none; border-color: var(--color-primary); box-shadow: 0 0 0 3px var(--color-primary-soft); }
.magna-search__submit { appearance: none; border: 0; border-radius: var(--radius-sm); background: var(--color-ink); color: var(--color-on-ink); padding: .78rem 1.2rem; font: 600 .9rem var(--font-body); cursor: pointer; }
.magna-search__submit:hover { background: var(--color-primary); color: var(--color-on-primary); }

/* Spacer */
.magna-spacer { height: 2rem; }
.magna-spacer--xs { height: .5rem; } .magna-spacer--sm { height: 1rem; } .magna-spacer--md { height: 2rem; }
.magna-spacer--lg { height: 3.5rem; } .magna-spacer--xl { height: 5rem; } .magna-spacer--2xl { height: 7.5rem; }

/* Stats */
.magna-stats { display: grid; gap: 1rem; grid-template-columns: repeat(3, 1fr); }
.magna-stats--cols-2 { grid-template-columns: repeat(2, 1fr); }
.magna-stats--cols-4 { grid-template-columns: repeat(4, 1fr); }
@media (max-width: 640px) { .magna-stats { grid-template-columns: repeat(2, 1fr); } }
.magna-stats__item { background: var(--color-surface-alt); border: 1px solid var(--color-border); border-radius: var(--radius-md); padding: 1.25rem; text-align: center; display: flex; flex-direction: column; gap: .2rem; }
.magna-stats__icon { color: var(--color-primary); }
.magna-stats__value { font-family: var(--font-heading); font-size: 2rem; color: var(--color-heading); line-height: 1.1; }
.magna-stats__label { font-size: .7rem; font-weight: 600; letter-spacing: .12em; text-transform: uppercase; color: var(--color-subtle); }

/* Table */
.magna-table { overflow-x: auto; border: 1px solid var(--color-border); border-radius: var(--radius-md); }
.magna-table__table { width: 100%; border-collapse: collapse; font-size: .925rem; }
.magna-table__caption { caption-side: bottom; padding: .75rem; font-size: .8125rem; color: var(--color-subtle); }
.magna-table__table th, .magna-table__table td { padding: .75rem 1rem; text-align: left; border-bottom: 1px solid var(--color-border); }
.magna-table__table thead th { background: var(--color-surface-alt); font-size: .75rem; text-transform: uppercase; letter-spacing: .08em; color: var(--color-muted); }
.magna-table__table tbody tr:last-child td { border-bottom: 0; }

/* Team — Eva's author card */
.magna-team { display: grid; gap: 1.5rem; grid-template-columns: repeat(3, 1fr); }
.magna-team--cols-2 { grid-template-columns: repeat(2, 1fr); }
.magna-team--cols-4 { grid-template-columns: repeat(4, 1fr); }
.magna-team:has(> .magna-team__member:only-child) { grid-template-columns: 1fr; }
@media (max-width: 760px) { .magna-team { grid-template-columns: 1fr; } }
.magna-team__member { text-align: center; background: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-lg); padding: 2rem 1.5rem; }
.magna-team__photo { width: 7.5rem; height: 7.5rem; border-radius: 50%; object-fit: cover; margin: 0 auto 1.1rem; border: 4px solid var(--color-surface); box-shadow: 0 0 0 1px var(--color-border-strong), var(--eva-shadow-md); }
.magna-team__name { font-size: 1.4rem; margin: 0 0 .2rem; }
.magna-team__role { font-size: .7rem; font-weight: 600; letter-spacing: .14em; text-transform: uppercase; color: var(--color-primary); margin: 0 0 .9rem; }
.magna-team__bio { color: var(--color-muted); font-size: .925rem; margin: 0; }

/* Testimonials */
.magna-testimonials { display: grid; gap: 1.25rem; grid-template-columns: repeat(auto-fit, minmax(min(100%, 18rem), 1fr)); }
.magna-testimonials--carousel { grid-auto-flow: column; grid-auto-columns: minmax(min(85%, 22rem), 1fr); grid-template-columns: none; overflow-x: auto; scroll-snap-type: x mandatory; padding-bottom: .5rem; }
.magna-testimonials--carousel .magna-testimonials__item { scroll-snap-align: start; }
.magna-testimonials__item { margin: 0; background: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-md); padding: 1.75rem; display: flex; flex-direction: column; justify-content: space-between; gap: 1.25rem; }
.magna-testimonials__quote { margin: 0; font-family: var(--font-heading); font-style: italic; font-size: 1.15rem; line-height: 1.5; color: var(--color-heading); }
.magna-testimonials__author { font-size: .85rem; color: var(--color-muted); display: flex; flex-direction: column; }
.magna-testimonials__author strong { color: var(--color-heading); }

/* Video */
.magna-video { border-radius: var(--radius-md); overflow: hidden; background: var(--color-code-bg); }
.magna-video video { width: 100%; }
.magna-video__embed { aspect-ratio: 16 / 9; display: grid; place-items: center; }
.magna-video__link { color: #fff; text-decoration: none; display: inline-flex; align-items: center; gap: .5rem; padding: .75rem 1.25rem; border-radius: var(--radius-pill); background: rgba(255,255,255,.12); }
.magna-video__link::before { content: "▶"; }

/* ───────────────────────── 5. Pages blocks & chrome ───────────────────────── */
.magna-nav__list { list-style: none; margin: 0; padding: 0; display: flex; flex-wrap: wrap; align-items: center; gap: .25rem 1.75rem; }
.magna-nav__item { position: relative; }
.magna-nav__list a { display: inline-block; padding: .4rem 0; font-size: .875rem; font-weight: 500; color: var(--color-muted); text-decoration: none; transition: color .2s ease; }
.magna-nav__list a:hover, .magna-nav__list a[aria-current="page"] { color: var(--color-primary); }
.magna-nav__description { display: block; font-size: .75rem; color: var(--color-subtle); }
.magna-nav__list--depth-1 { position: absolute; top: 100%; left: -1rem; z-index: 50; min-width: 13rem; flex-direction: column; align-items: stretch; gap: 0; padding: .5rem; background: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-md); box-shadow: var(--eva-shadow-lg); opacity: 0; visibility: hidden; transform: translateY(6px); transition: opacity .2s ease, transform .2s var(--eva-ease), visibility .2s; }
.magna-nav__item:hover > .magna-nav__list--depth-1, .magna-nav__item:focus-within > .magna-nav__list--depth-1 { opacity: 1; visibility: visible; transform: none; }
.magna-nav__list--depth-1 a { display: block; padding: .55rem .75rem; border-radius: var(--radius-sm); }
.magna-nav__list--depth-1 a:hover { background: var(--color-surface-alt); }
.magna-nav__list--depth-2 { position: static; padding-left: .75rem; list-style: none; }

.magna-embed { margin: 0; }
.magna-embed__frame { border-radius: var(--radius-md); overflow: hidden; border: 1px solid var(--color-border); background: var(--color-surface-alt); }

.magna-locale-switcher__items { list-style: none; margin: 0; padding: 0; display: flex; gap: .5rem; }
.magna-locale-switcher__items a, .magna-locale-switcher__current { font-size: .75rem; font-weight: 600; text-transform: uppercase; letter-spacing: .08em; padding: .3rem .6rem; border-radius: var(--radius-pill); text-decoration: none; color: var(--color-muted); }
.magna-locale-switcher__current { background: var(--color-ink); color: var(--color-on-ink); }

/* Popups & consent */
.magna-popup__panel { background: var(--color-surface); color: var(--color-text); border: 1px solid var(--color-border); border-radius: var(--radius-lg); box-shadow: var(--eva-shadow-lg); }
.magna-popup__close { appearance: none; border: 0; background: var(--color-surface-alt); color: var(--color-muted); width: 2.25rem; height: 2.25rem; border-radius: 50%; cursor: pointer; }
.magna-consent { background: var(--color-surface); color: var(--color-text); border: 1px solid var(--color-border); border-radius: var(--radius-md); box-shadow: var(--eva-shadow-lg); font-size: .875rem; }

/* Collections */
.magna-collection { max-width: var(--max-width); margin-inline: auto; padding: var(--section-y) var(--gutter); }
.magna-collection--single { max-width: calc(var(--content-width) + 2 * var(--gutter)); }
.magna-collection__heading { font-size: clamp(2.25rem, 1.6rem + 2.6vw, 3.4rem); }
.magna-collection__date { font-family: var(--font-mono); font-size: .8rem; color: var(--color-subtle); }
.magna-collection__field { margin: 1.25rem 0; font-size: var(--prose-size); line-height: 1.75; }
.magna-collection__items { list-style: none; padding: 0; display: grid; gap: 1.25rem; grid-template-columns: repeat(auto-fill, minmax(min(100%, 18rem), 1fr)); }
.magna-collection__item { background: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-md); padding: 1.5rem; }
.magna-collection__title { font-family: var(--font-heading); font-size: 1.3rem; color: var(--color-heading); text-decoration: none; }
.magna-collection__empty { color: var(--color-muted); font-style: italic; }

/* ───────────────────────── 6. Blog: post page ───────────────────────── */
.magna-frontend-page--content { max-width: calc(var(--content-width) + 2 * var(--gutter)); margin-inline: auto; padding: clamp(2.5rem, 6vw, 5rem) var(--gutter) var(--section-y); }

.magna-blog-post > header { text-align: center; margin-bottom: clamp(2rem, 5vw, 3rem); }
.magna-blog-post > header::before { content: ""; display: block; width: 2.5rem; height: 2px; margin: 0 auto 1.75rem; background: var(--color-primary); border-radius: 2px; }
.post-title { font-size: clamp(2.25rem, 1.5rem + 3vw, 3.75rem); line-height: 1.08; letter-spacing: -.025em; margin: 0 0 1.25rem; }
.post-meta { display: flex; flex-wrap: wrap; justify-content: center; align-items: center; gap: .5rem; font-size: .8125rem; color: var(--color-muted); }
.post-meta .who { font-weight: 600; color: var(--color-heading); display: inline-flex; align-items: center; gap: .5rem; }
.post-meta .who::before { content: "By"; font-weight: 400; color: var(--color-subtle); }
.post-meta .dot { color: var(--color-border-strong); }
.post-meta time, .post-meta .reading-time { font-family: var(--font-mono); font-size: .75rem; letter-spacing: .02em; }

.magna-blog-post > img.featured { width: min(100vw - 2 * var(--gutter), 1040px); max-width: none; margin: 0 0 clamp(2rem, 5vw, 3.5rem) 50%; transform: translateX(-50%); aspect-ratio: 16 / 9; object-fit: cover; border-radius: var(--radius-lg); border: 1px solid var(--color-border); box-shadow: var(--eva-shadow-md); }

.post-tags { list-style: none; padding: 0; margin: 3rem 0 0; display: flex; flex-wrap: wrap; gap: .5rem; }
.post-tags li { font-size: .75rem; font-weight: 500; padding: .35rem .8rem; border-radius: var(--radius-pill); background: var(--color-surface-alt); border: 1px solid var(--color-border); color: var(--color-muted); }
.post-tags li::before { content: "#"; color: var(--color-primary); margin-right: .1rem; }

.post-nav { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-top: 3rem; padding-top: 2rem; border-top: 1px solid var(--color-border); }
.post-nav a { display: block; padding: 1.1rem 1.25rem; border: 1px solid var(--color-border); border-radius: var(--radius-md); background: var(--color-surface); text-decoration: none; font-family: var(--font-heading); font-size: 1.1rem; line-height: 1.3; color: var(--color-heading); transition: border-color .2s ease, transform .3s var(--eva-ease), box-shadow .3s ease; }
.post-nav a:hover { border-color: var(--color-primary-line); color: var(--color-primary); transform: translateY(-2px); box-shadow: var(--eva-shadow-md); }
.post-nav__next { grid-column: 2; text-align: right; }
@media (max-width: 600px) { .post-nav { grid-template-columns: 1fr; } .post-nav__next { grid-column: auto; } }

/* ───────────────────────── 7. Blog: post body ───────────────────────── */
.post-body { font-size: var(--prose-size); line-height: 1.8; color: var(--color-text); }
.post-body > * { margin-block: 0 1.5rem; }
.post-body > :last-child { margin-bottom: 0; }
.post-body > p:first-child::first-letter { float: left; font-family: var(--font-heading); font-weight: 700; font-size: 4.1em; line-height: .82; margin: .08em .12em 0 0; color: var(--color-primary); }
.post-body > :is(h2, h3, h4) { position: relative; margin-top: 2.75rem; margin-bottom: 1rem; }
.post-body > h2 { font-size: clamp(1.6rem, 1.35rem + 1vw, 2.1rem); }
.post-body > h3 { font-size: 1.45rem; }
.post-body > h4 { font-size: 1.2rem; }
.eva-anchor { margin-left: .4rem; color: var(--color-border-strong); text-decoration: none; font-weight: 400; opacity: 0; transition: opacity .2s ease; }
.post-body > :is(h2, h3):hover .eva-anchor, .eva-anchor:focus { opacity: 1; }
.post-body a { text-decoration: underline; text-decoration-color: var(--color-primary-line); }
.post-body a:hover { text-decoration-color: currentColor; }
.post-body :is(ul, ol) { padding-left: 1.4rem; }
.post-body li { margin: .4rem 0; }
.post-body li::marker { color: var(--color-primary); }
.post-body ul.checklist { list-style: none; padding-left: 0; }
.post-body img { border-radius: var(--radius-sm); }

.post-body blockquote { margin-inline: 0; padding: .25rem 0 .25rem 1.5rem; border-left: 3px solid var(--color-primary); font-family: var(--font-heading); font-style: italic; font-size: 1.3em; line-height: 1.5; color: var(--color-heading); }
.post-body blockquote p { margin: 0 0 .5rem; }
.post-body blockquote cite { display: block; font-family: var(--font-body); font-style: normal; font-size: .8rem; color: var(--color-muted); }
.post-body blockquote cite::before { content: "— "; }
.post-body blockquote.pullquote { border: 0; border-block: 1px solid var(--color-border); padding: 2rem 0; text-align: center; font-size: 1.6em; font-weight: 500; }
.post-body blockquote.pullquote::before { content: "“"; display: block; font-size: 3rem; line-height: .6; color: var(--color-primary); margin-bottom: .75rem; }

.post-body pre { background: var(--color-code-bg); color: var(--color-code-text); padding: 1.15rem 1.35rem; border-radius: var(--radius-md); overflow-x: auto; font-family: var(--font-mono); font-size: .85rem; line-height: 1.7; border: 1px solid var(--color-border); }
.post-body pre.code { position: relative; }
.post-body pre.code[data-lang]::before { content: attr(data-lang); position: absolute; top: .55rem; right: .8rem; font-size: .65rem; letter-spacing: .1em; text-transform: uppercase; color: var(--color-subtle); }
.post-body pre code { background: none; border: 0; padding: 0; font-size: inherit; color: inherit; }
.post-body pre.verse { background: transparent; color: inherit; border: 0; padding: 0 0 0 1.5rem; font-family: var(--font-heading); font-style: italic; font-size: 1.1em; white-space: pre-wrap; }

.post-body .delimiter { text-align: center; letter-spacing: 1em; color: var(--color-primary); font-size: 1.1rem; margin-block: 2.5rem; }
.post-body hr.delimiter-line, .post-body hr.marker { border: 0; border-top: 1px solid var(--color-border); margin-block: 2.5rem; }
.post-body hr.marker { border-top-style: dashed; }

.post-body table { width: 100%; border-collapse: collapse; font-size: .9em; }
@media (max-width: 640px) { .post-body table { display: block; overflow-x: auto; } }
.post-body :is(th, td) { padding: .65rem .85rem; text-align: left; border-bottom: 1px solid var(--color-border); vertical-align: top; }
.post-body th { font-size: .8em; text-transform: uppercase; letter-spacing: .06em; color: var(--color-muted); background: var(--color-surface-alt); }
.post-body .is-striped tr:nth-child(even) td { background: var(--color-surface-alt); }
.post-body .is-bordered :is(th, td) { border: 1px solid var(--color-border); }
.post-body .is-compact :is(th, td) { padding: .35rem .55rem; }

.post-body figure { margin-inline: 0; }
.post-body figure img, .post-body figure video { margin-inline: auto; border-radius: var(--radius-md); }
.post-body figcaption { margin-top: .65rem; font-size: .8rem; color: var(--color-subtle); text-align: center; }
.post-body audio { width: 100%; }
.post-body .gallery img { border-radius: var(--radius-sm); aspect-ratio: 1; object-fit: cover; }
.post-body .cover { display: flex; flex-direction: column; justify-content: center; padding: 2.5rem; border-radius: var(--radius-lg); color: #fff; background-size: cover; background-position: center; }
.post-body .cover h2 { color: #fff; margin: 0 0 .5rem; }
.post-body .embed iframe { width: 100%; aspect-ratio: 16 / 9; border: 0; border-radius: var(--radius-md); background: var(--color-surface-alt); }

.post-body .callout { --eva-tone: var(--color-info); display: flex; gap: .85rem; padding: 1rem 1.25rem; border-radius: var(--radius-sm); border: 1px solid color-mix(in srgb, var(--eva-tone) 30%, transparent); border-left: 4px solid var(--eva-tone); background: color-mix(in srgb, var(--eva-tone) 8%, var(--color-surface)); font-size: .92em; line-height: 1.65; }
.post-body .callout-success { --eva-tone: var(--color-success); }
.post-body .callout-warning { --eva-tone: var(--color-warning); }
.post-body .callout-danger { --eva-tone: var(--color-danger); }
.post-body .callout-icon { color: var(--eva-tone); font-weight: 700; }
.post-body .callout-body strong { display: block; color: var(--color-heading); margin-bottom: .2rem; }

.post-body .cta { background: var(--color-surface-alt); border: 1px solid var(--color-border); border-radius: var(--radius-lg); padding: 2rem; }
.post-body .cta h3 { margin-top: 0; }
.post-body .btn { background: var(--color-ink); color: var(--color-on-ink); text-decoration: none; margin-top: 1rem; font-size: .9rem; }
.post-body .buttons a { text-decoration: none; }

.post-body .columns { display: grid; grid-template-columns: repeat(var(--cols, 2), 1fr); gap: 1.5rem; }
.post-body .ratio-2-1 .columns { grid-template-columns: 2fr 1fr; }
.post-body .ratio-1-2 .columns { grid-template-columns: 1fr 2fr; }
.post-body .ratio-3-1 .columns { grid-template-columns: 3fr 1fr; }
.post-body .ratio-1-3 .columns { grid-template-columns: 1fr 3fr; }
.post-body .is-vcenter .columns { align-items: center; }
.post-body .column > * { margin-block: 0 1rem; }
@media (max-width: 640px) { .post-body .columns, .post-body [class*="ratio-"] .columns { grid-template-columns: 1fr; } }

.post-body .toc { background: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-md); padding: 1.25rem 1.5rem; font-size: .9rem; }
.post-body .toc > strong { display: block; font-size: .7rem; letter-spacing: .14em; text-transform: uppercase; color: var(--color-primary); margin-bottom: .5rem; }
.post-body .toc :is(ul, ol) { margin: 0; padding-left: 1.1rem; }
.post-body .toc a { text-decoration: none; color: var(--color-muted); }
.post-body .toc a:hover { color: var(--color-primary); }

.post-body .related > strong { display: block; font-family: var(--font-heading); font-size: 1.3rem; font-weight: 500; color: var(--color-heading); margin-bottom: 1rem; }
.post-body .related-items { display: grid; gap: 1rem; }
.post-body .related-grid .related-items { grid-template-columns: repeat(auto-fill, minmax(min(100%, 12rem), 1fr)); }
.post-body .related-item { display: flex; flex-direction: column; gap: .5rem; font-size: .95rem; }
.post-body .related-list .related-item { flex-direction: row; align-items: center; }
.post-body .related-item img { border-radius: var(--radius-sm); aspect-ratio: 16 / 10; object-fit: cover; }
.post-body .related-list .related-item img { width: 5rem; }
.post-body .related-item a { color: var(--color-heading); text-decoration: none; font-weight: 600; }
.post-body .related-item a:hover { color: var(--color-primary); }

.post-body .excerpt { font-family: var(--font-heading); font-size: 1.25em; line-height: 1.55; color: var(--color-muted); }
.post-body > img.featured { border-radius: var(--radius-lg); width: 100%; }

/* ───────────────────────── 8. Blog: comments ───────────────────────── */
.post-comments { margin-top: 4rem; padding-top: 2.5rem; border-top: 1px solid var(--color-border); }
.post-comments__title { font-size: 1.75rem; margin-bottom: 1.5rem; }
.post-comments__notice { padding: .85rem 1.1rem; border-radius: var(--radius-sm); font-size: .875rem; border: 1px solid var(--color-border); background: var(--color-surface-alt); }
.post-comments__notice--approved { border-color: color-mix(in srgb, var(--color-success) 35%, transparent); background: color-mix(in srgb, var(--color-success) 8%, var(--color-surface)); }
.post-comments__notice--pending { border-color: color-mix(in srgb, var(--color-warning) 35%, transparent); background: color-mix(in srgb, var(--color-warning) 8%, var(--color-surface)); }
.post-comments__list, .post-comment__replies { list-style: none; margin: 0; padding: 0; }
.post-comments__list { margin-bottom: 2.5rem; }
.post-comment { padding: 1.25rem 0; border-bottom: 1px solid var(--color-border); }
.post-comment__replies { margin-top: 1rem; padding-left: 1.25rem; border-left: 2px solid var(--color-primary-line); }
.post-comment--reply { border-bottom: 0; padding-bottom: .5rem; }
.post-comment__meta { display: flex; flex-wrap: wrap; align-items: baseline; gap: .6rem; margin-bottom: .45rem; }
.post-comment__author { font-weight: 600; color: var(--color-heading); font-size: .925rem; }
.post-comment__date { font-family: var(--font-mono); font-size: .7rem; color: var(--color-subtle); }
.post-comment__text { color: var(--color-text); font-size: .95rem; line-height: 1.7; }
.post-comment__text p { margin: 0 0 .5rem; }
.post-comment__reply { margin-top: .5rem; }
.post-comment__reply > summary { cursor: pointer; display: inline-block; font-size: .75rem; font-weight: 600; letter-spacing: .06em; text-transform: uppercase; color: var(--color-primary); list-style: none; }
.post-comment__reply > summary::-webkit-details-marker { display: none; }
.post-comment__reply[open] > summary { margin-bottom: .75rem; }
.post-comments__form { background: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-md); padding: 1.5rem; display: grid; gap: 1rem; }
.post-comments__field { margin: 0; display: grid; gap: .35rem; }
.post-comments__field label { font-size: .75rem; font-weight: 600; letter-spacing: .06em; text-transform: uppercase; color: var(--color-muted); }
.post-comments__field textarea { min-height: 8rem; resize: vertical; }
.post-comments__submit { justify-self: start; border: 0; }
.post-comments__errors { margin: 0; padding: .75rem 1rem .75rem 2rem; border-radius: var(--radius-sm); background: color-mix(in srgb, var(--color-danger) 8%, var(--color-surface)); color: var(--color-danger); font-size: .875rem; }
.post-comments__closed, .post-comments__login { color: var(--color-muted); font-style: italic; }

/* ───────────────────────── 9. Blog posts block, Loop & pagination ───────────────────────── */
.eva-posts__header { display: flex; flex-wrap: wrap; align-items: flex-end; justify-content: space-between; gap: 1rem; margin-bottom: 2.25rem; padding-bottom: 1.25rem; border-bottom: 1px solid var(--color-border); }
.eva-posts__heading { margin: 0; font-size: clamp(1.9rem, 1.5rem + 1.5vw, 2.6rem); }
.eva-posts__badge { display: inline-flex; align-items: center; gap: .55rem; font-size: .7rem; font-weight: 600; letter-spacing: .16em; text-transform: uppercase; color: var(--color-subtle); }
.eva-pulse { width: .55rem; height: .55rem; border-radius: 50%; background: var(--color-primary); animation: eva-pulse 2.4s ease-in-out infinite; }

.eva-posts__items, .magna-loop__items { list-style: none; margin: 0; padding: 0; display: grid; gap: 2rem 1.75rem; grid-template-columns: repeat(auto-fill, minmax(min(100%, 19rem), 1fr)); }

.eva-card, .magna-loop__item { position: relative; display: flex; flex-direction: column; background: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-md); overflow: hidden; transition: transform .45s var(--eva-ease), box-shadow .45s var(--eva-ease), border-color .3s ease; }
.eva-card:hover, .magna-loop__item:hover { transform: translateY(-4px); box-shadow: var(--eva-shadow-lg); border-color: var(--color-border-strong); }
.eva-card__media { position: relative; aspect-ratio: 16 / 10; overflow: hidden; background: var(--color-surface-alt); }
.eva-card__media::after { content: ""; position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,.28), transparent 55%); opacity: .6; transition: opacity .4s ease; }
.eva-card:hover .eva-card__media::after { opacity: .3; }
.eva-card__image, .magna-loop__image { width: 100%; height: 100%; object-fit: cover; transition: transform .8s var(--eva-ease); }
.magna-loop__image { aspect-ratio: 16 / 10; }
.eva-card:hover .eva-card__image, .magna-loop__item:hover .magna-loop__image { transform: scale(1.05); }
.eva-card__body, .magna-loop__body { flex: 1; display: flex; flex-direction: column; padding: 1.4rem 1.5rem 1.5rem; }
.eva-card__meta { display: flex; align-items: center; gap: .5rem; margin-bottom: .7rem; }
.eva-card__date, .magna-loop__date { font-family: var(--font-mono); font-size: .7rem; letter-spacing: .04em; color: var(--color-subtle); text-transform: uppercase; }
.eva-card__title { font-size: 1.45rem; line-height: 1.22; margin: 0 0 .65rem; letter-spacing: -.015em; }
.eva-card__link, .magna-loop__title { color: var(--color-heading); text-decoration: none; font-family: var(--font-heading); }
.magna-loop__title { font-size: 1.45rem; line-height: 1.22; margin-bottom: .65rem; display: block; }
.eva-card__link::after { content: ""; position: absolute; inset: 0; z-index: 1; }
.eva-card:hover .eva-card__link, .magna-loop__item:hover .magna-loop__title { color: var(--color-primary); }
.eva-card__excerpt, .magna-loop__description { color: var(--color-muted); font-size: .925rem; line-height: 1.65; margin: 0 0 1.25rem; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
.eva-card__more { margin-top: auto; display: inline-flex; align-items: center; gap: .4rem; font-size: .8rem; font-weight: 600; color: var(--color-heading); }
.eva-card__more svg { transition: transform .3s var(--eva-ease); }
.eva-card:hover .eva-card__more { color: var(--color-primary); }
.eva-card:hover .eva-card__more svg { transform: translateX(4px); }
.eva-card--no-image .eva-card__body { padding-top: 1.75rem; }
.eva-card--no-image::before { content: ""; height: 3px; background: var(--color-primary); }

/* Lead story: a block showing exactly one post */
.eva-posts--lead .eva-posts__items { grid-template-columns: 1fr; }
.eva-posts--lead .eva-card { display: grid; grid-template-columns: 7fr 5fr; align-items: center; gap: clamp(1.5rem, 4vw, 3.5rem); background: transparent; border: 0; overflow: visible; }
.eva-posts--lead .eva-card:hover { transform: none; box-shadow: none; }
.eva-posts--lead .eva-card__media { border-radius: var(--radius-lg); border: 1px solid var(--color-border); box-shadow: var(--eva-shadow-sm); }
.eva-posts--lead .eva-card__body { padding: 0; }
.eva-posts--lead .eva-card__title { font-size: clamp(2rem, 1.4rem + 2.4vw, 3.25rem); line-height: 1.12; letter-spacing: -.025em; margin-bottom: 1.1rem; }
.eva-posts--lead .eva-card__excerpt { font-size: 1.08rem; -webkit-line-clamp: 5; }
.eva-posts--lead .eva-card__more { align-self: flex-start; margin-top: .5rem; padding: .75rem 1.35rem; border-radius: var(--radius-pill); background: var(--color-ink); color: var(--color-on-ink); }
.eva-posts--lead .eva-card:hover .eva-card__more { background: var(--color-primary); color: var(--color-on-primary); }
.eva-posts--lead .eva-card--no-image { grid-template-columns: 1fr; }
.eva-posts--lead .eva-card--no-image::before { display: none; }
@media (max-width: 860px) { .eva-posts--lead .eva-card { grid-template-columns: 1fr; } }

.magna-loop__heading { margin-bottom: 2rem; }

.magna-pagination { display: flex; align-items: center; justify-content: center; gap: 1rem; margin-top: 3rem; font-size: .875rem; }
.magna-pagination__prev, .magna-pagination__next { display: inline-flex; align-items: center; padding: .6rem 1.2rem; border-radius: var(--radius-pill); border: 1px solid var(--color-border-strong); color: var(--color-heading); text-decoration: none; font-weight: 600; transition: border-color .2s ease, color .2s ease; }
.magna-pagination__prev::before { content: "← "; white-space: pre; }
.magna-pagination__next::after { content: " →"; white-space: pre; }
.magna-pagination__prev:hover, .magna-pagination__next:hover { border-color: var(--color-primary); color: var(--color-primary); }
.magna-pagination__status { font-family: var(--font-mono); font-size: .75rem; color: var(--color-subtle); }

/* ───────────────────────── 10. Utilities & motion ───────────────────────── */
@keyframes eva-pulse { 0%, 100% { opacity: 1; transform: scale(1); } 50% { opacity: .45; transform: scale(.82); } }
.eva--in-builder .eva-progress, .eva--in-builder .eva-to-top { display: none; }
@media print {
    .eva-header, .eva-footer, .eva-progress, .eva-to-top, .post-comments, .post-nav { display: none !important; }
    body { background: #fff; color: #000; }
}
</style>

{{--
    Eva fallback header — used only when the site has no published header
    template part. Brand monogram + site name, the primary menu, a colour
    scheme toggle and a mobile menu. Publish a "header" template part in the
    builder (the starter kit ships one) to replace it.
--}}
@php
    $evaInitial = mb_strtoupper(mb_substr(trim($siteName) !== '' ? trim($siteName) : 'E', 0, 1));
@endphp
<header class="eva-header eva-header--fallback" data-eva-header>
    <div class="eva-header__bar">
        <a class="eva-brand" href="{{ $homeUrl }}">
            <span class="eva-brand__mark" aria-hidden="true">{{ $evaInitial }}</span>
            <span class="eva-brand__text">
                <span class="eva-brand__name">{{ $siteName }}</span>
                <span class="eva-brand__tag">Journal</span>
            </span>
        </a>

        @if($headerMenu !== [])
            <nav class="eva-nav magna-nav" aria-label="Primary">
                @include('magna-pages::partials.nav-items', ['items' => $headerMenu, 'depth' => 0])
            </nav>
        @endif

        <div class="eva-header__actions">
            <button type="button" class="eva-icon-btn" data-eva-scheme aria-label="Switch between light and dark">
                <svg class="eva-icon-moon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                <svg class="eva-icon-sun" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41"/></svg>
            </button>
            @if($headerMenu !== [])
                <button type="button" class="eva-icon-btn eva-menu-btn" data-eva-menu-toggle aria-expanded="false" aria-controls="eva-mobile-nav" aria-label="Open menu">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
                </button>
            @endif
        </div>
    </div>

    @if($headerMenu !== [])
        <nav id="eva-mobile-nav" class="eva-mobile-nav magna-nav" aria-label="Primary" hidden>
            @include('magna-pages::partials.nav-items', ['items' => $headerMenu, 'depth' => 0])
        </nav>
    @endif
</header>

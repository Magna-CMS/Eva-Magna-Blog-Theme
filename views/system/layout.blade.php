{{--
    Eva — page shell.

    Every page Magna Pages serves comes through here: builder pages, the
    Blog's post pages (arriving pre-rendered in $mainHtml), collection pages
    and the not-found page. The header and footer are template parts when the
    site publishes them; otherwise Eva's own fallback chrome renders from the
    primary and footer menus, so a fresh install still looks finished.
--}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $seoTitle !== '' ? $seoTitle : ($title !== '' && $title !== $siteName ? $title.' — '.$siteName : $siteName) }}</title>
    {{-- Every page gets a description: the page's own, else a sensible default. --}}
    @php
        $evaDescription = $metaDescription !== ''
            ? $metaDescription
            : (($title !== '' && $title !== $siteName ? $title.' — ' : '').$siteName.': essays and notes, published with care.');
    @endphp
    <meta name="description" content="{{ $evaDescription }}">
    <meta property="og:description" content="{{ $evaDescription }}">
    @php
        $evaPage = request()->query('page');
        $evaCanonical = url()->current().(is_string($evaPage) && ctype_digit($evaPage) && (int) $evaPage > 1 ? '?page='.(int) $evaPage : '');
        $evaIsPost = !empty($mainHtml) && str_contains($mainHtml, 'magna-blog-post');
        $evaOgImage = $evaIsPost && preg_match('/<img class="featured" src="([^"]+)"/', $mainHtml, $evaImg) === 1
            ? html_entity_decode($evaImg[1], ENT_QUOTES | ENT_HTML5)
            : '';
    @endphp
    @if($evaOgImage !== '')
        <meta property="og:image" content="{{ url($evaOgImage) }}">
    @endif
    <link rel="canonical" href="{{ $evaCanonical }}">
    <meta name="robots" content="index, follow, max-image-preview:large">
    <meta property="og:type" content="{{ $evaIsPost ? 'article' : 'website' }}">
    <meta property="og:url" content="{{ $evaCanonical }}">
    <meta property="og:title" content="{{ $seoTitle !== '' ? $seoTitle : $title }}">
    <meta property="og:site_name" content="{{ $siteName }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="theme-color" content="#FAF8F4" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#12110E" media="(prefers-color-scheme: dark)">
    <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Ccircle cx='32' cy='32' r='32' fill='%23A94A2B'/%3E%3Ctext x='32' y='44' text-anchor='middle' font-family='Georgia,serif' font-size='34' font-weight='700' fill='%23FDFCF9'%3E{{ rawurlencode(mb_strtoupper(mb_substr(trim($siteName) !== '' ? trim($siteName) : 'E', 0, 1))) }}%3C/text%3E%3C/svg%3E">
    @if(count($localeAlternates ?? []) > 1)
        @foreach($localeAlternates as $alternateLocale => $alternateUrl)
            <link rel="alternate" hreflang="{{ $alternateLocale }}" href="{{ url($alternateUrl) }}">
        @endforeach
    @endif

    {{-- Apply a visitor's stored colour scheme before first paint. Same key the
         core scheme-toggle block uses, so both toggles stay in agreement. --}}
    <script>try{var s=localStorage.getItem('magna-theme');if(s==='light'||s==='dark'){document.documentElement.setAttribute('data-theme',s)}}catch(e){}</script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,400..700;1,6..72,400..700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap">

    @if($tokensCss !== '')
        <style>{!! $tokensCss !!}</style>
    @endif
    @include('theme::partials.styles')
</head>
<body class="eva{{ !empty($mainHtml) ? ' eva--app-page' : ' eva--builder-page' }}{{ ($builderMode ?? false) ? ' eva--in-builder' : '' }}">
<a class="eva-skip" href="#eva-main">Skip to content</a>
<div class="eva-progress" data-eva-progress aria-hidden="true"></div>

@if(!empty($headerPartHtml))
    <header class="eva-header eva-header--part">
        {!! $headerPartHtml !!}
    </header>
@else
    @include('theme::partials.header')
@endif

<main id="eva-main" class="eva-main">
    @if(!empty($mainHtml))
        {!! $mainHtml !!}
    @else
        @include('magna-pages::partials.sections')
    @endif
</main>

@if(!empty($footerPartHtml))
    <footer class="eva-footer eva-footer--part">
        {!! $footerPartHtml !!}
    </footer>
@else
    @include('theme::partials.footer')
@endif

<button type="button" class="eva-to-top" data-eva-to-top aria-label="Back to top" hidden>
    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 19V5M5 12l7-7 7 7"/></svg>
</button>

@if(!empty($popupsHtml))
    {!! $popupsHtml !!}
@endif

@include('theme::partials.scripts')
</body>
</html>

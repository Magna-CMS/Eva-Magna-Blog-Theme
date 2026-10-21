{{--
    Eva fallback footer — used only when the site has no published footer
    template part. Reads the "footer" menu (and falls back to the primary
    menu) so the colophon always has somewhere to send readers.
--}}
@php
    $evaFooterLinks = $menu('footer');
    if ($evaFooterLinks === []) {
        $evaFooterLinks = $headerMenu;
    }
    $evaSocialLinks = $menu('social');
    $evaInitial = mb_strtoupper(mb_substr(trim($siteName) !== '' ? trim($siteName) : 'E', 0, 1));
@endphp
<footer class="eva-footer eva-footer--fallback">
    <div class="eva-footer__inner">
        <div class="eva-footer__grid">
            <div class="eva-footer__brand">
                <a class="eva-brand eva-brand--small" href="{{ $homeUrl }}">
                    <span class="eva-brand__mark eva-brand__mark--solid" aria-hidden="true">{{ $evaInitial }}</span>
                    <span class="eva-brand__name">{{ $siteName }}</span>
                </a>
                <p class="eva-footer__blurb">
                    Essays and notes on craft, published with care. Typeset in Newsreader and Plus Jakarta Sans.
                </p>
            </div>

            @if($evaFooterLinks !== [])
                <div class="eva-footer__col">
                    <h2 class="eva-footer__heading">Sections</h2>
                    <ul class="eva-footer__links">
                        @foreach($evaFooterLinks as $link)
                            <li><a href="{{ $link['url'] }}" @if(!empty($link['target'])) target="{{ $link['target'] }}" rel="noopener noreferrer" @endif>{{ $link['label'] }}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="eva-footer__col">
                <h2 class="eva-footer__heading">Connect</h2>
                <ul class="eva-footer__links">
                    @foreach($evaSocialLinks as $link)
                        <li><a href="{{ $link['url'] }}" target="_blank" rel="noopener noreferrer">{{ $link['label'] }}</a></li>
                    @endforeach
                    <li>
                        <button type="button" class="eva-footer__link-btn" data-eva-scroll-top>
                            Back to top <span aria-hidden="true">↑</span>
                        </button>
                    </li>
                </ul>
            </div>
        </div>

        <div class="eva-footer__bottom">
            <span>&copy; {{ date('Y') }} {{ $siteName }}. All rights reserved.</span>
            <span class="eva-footer__credit"><span class="eva-dot" aria-hidden="true"></span> Theme: Eva</span>
        </div>
    </div>
</footer>

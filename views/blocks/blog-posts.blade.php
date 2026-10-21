{{--
    Eva — Blog posts block.

    Same data contract as Magna Blog's own view (title, url, description,
    date, image per item; optional pagination), drawn as Eva's editorial cards.

    Layouts, chosen automatically from what the editor set up:
      • one post (limit 1, e.g. the "featured" feed) → a large lead story
      • two or more → a responsive card grid
--}}
@php
    $items = $block['_resolved']['items'] ?? [];
    $heading = trim((string) ($block['data']['heading'] ?? ''));
    $isFeatured = ($block['data']['feed'] ?? 'latest') === 'featured';
    $count = count($items);
@endphp
<div class="magna-block magna-block--blog-posts magna-blog-posts eva-posts eva-posts--{{ $count === 1 ? 'lead' : 'grid' }}{{ $isFeatured ? ' eva-posts--featured' : '' }}">
    @if($heading !== '')
        <div class="eva-posts__header">
            <h2 class="magna-blog-posts__heading eva-posts__heading">{{ $heading }}</h2>
            @if($isFeatured)
                <span class="eva-posts__badge"><span class="eva-pulse" aria-hidden="true"></span> Featured</span>
            @endif
        </div>
    @endif

    @if($items !== [])
        <ul class="magna-blog-posts__items eva-posts__items">
            @foreach($items as $item)
                @php
                    $url = !empty($item['url']) ? \Magna\Blocks\Support\SafeUrl::sanitize($item['url']) : '';
                    $image = !empty($item['image']) ? \Magna\Blocks\Support\SafeUrl::sanitize($item['image']) : '';
                    $title = $item['title'] ?? 'Untitled';
                    $dateIso = '';
                    $dateLabel = '';
                    if (!empty($item['date']) && preg_match('/^\d{4}-\d{2}-\d{2}$/', (string) $item['date'])) {
                        $dateIso = (string) $item['date'];
                        $dateLabel = \Illuminate\Support\Carbon::createFromFormat('Y-m-d', $dateIso)->translatedFormat('M j, Y');
                    } elseif (!empty($item['date'])) {
                        $dateLabel = (string) $item['date'];
                    }
                @endphp
                <li class="magna-blog-posts__item eva-card{{ $image === '' ? ' eva-card--no-image' : '' }}">
                    @if($image !== '')
                        <div class="eva-card__media">
                            <img class="magna-blog-posts__image eva-card__image" src="{{ $image }}" alt="" loading="{{ $loop->first ? 'eager' : 'lazy' }}">
                        </div>
                    @endif

                    <div class="magna-blog-posts__body eva-card__body">
                        @if($dateLabel !== '')
                            <div class="eva-card__meta">
                                <time class="magna-blog-posts__date eva-card__date" @if($dateIso !== '') datetime="{{ $dateIso }}" @endif>{{ $dateLabel }}</time>
                            </div>
                        @endif

                        <h3 class="eva-card__title">
                            @if($url !== '')
                                <a class="magna-blog-posts__title eva-card__link" href="{{ $url }}">{{ $title }}</a>
                            @else
                                <span class="magna-blog-posts__title">{{ $title }}</span>
                            @endif
                        </h3>

                        @if(!empty($item['description']))
                            <p class="magna-blog-posts__description eva-card__excerpt">{{ $item['description'] }}</p>
                        @endif

                        @if($url !== '')
                            <span class="eva-card__more" aria-hidden="true">
                                Read essay
                                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 5l7 7-7 7"/></svg>
                            </span>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
    @endif

    {{-- Set only when the block paginates; renders nothing for a single page. --}}
    @include('magna::partials.pagination', ['pagination' => $block['_resolved']['pagination'] ?? null])
</div>

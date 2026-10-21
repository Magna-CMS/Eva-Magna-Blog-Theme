{{--
    Eva — Heading block.

    Levels H1–H5 render exactly like core. Level H6 is Eva's "eyebrow": the
    small uppercase label with a pulsing dot that sits above section titles.
    It renders as a paragraph, not a heading, so the page outline (and the
    heading-order checks in Lighthouse / screen readers) stays correct.
--}}
@php
    $level = in_array($block['data']['level'] ?? 'h2', ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'], true) ? ($block['data']['level'] ?? 'h2') : 'h2';
    $align = in_array($block['data']['align'] ?? 'left', ['left', 'center', 'right'], true) ? ($block['data']['align'] ?? 'left') : 'left';
    $text = $block['data']['text'] ?? '';
@endphp
<div class="magna-block magna-block--heading magna-heading magna-heading--{{ $align }}{{ $level === 'h6' ? ' eva-eyebrow-wrap' : '' }}">
    @if($level === 'h6')
        <p class="eva-eyebrow">{{ $text }}</p>
    @else
        <{{ $level }}>{{ $text }}</{{ $level }}>
    @endif
</div>

<div class="flex flex-col items-end mb-1 text-xs">
    @if( isset($points->total_score) && isset($points->word_count))
    <span>{{ $points->total_score }} pontos</span>
    <span>{{ $points->word_count }} palavras</span>
    @endif
</div>
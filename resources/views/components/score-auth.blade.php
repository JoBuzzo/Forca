<div class="flex items-start justify-start mt-1 text-xs">
    @if( isset($points->total_score) && isset($points->word_count))
        <span>Você jogou {{ $points->word_count }} de {{ $wordsCount }} palavras totalizando {{ $points->total_score }} pontos</span>
    @else
        <span>Tem {{ $wordsCount }} palavras cadastradas. </span>
    @endif
</div>
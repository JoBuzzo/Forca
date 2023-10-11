<div class="flex items-start justify-start mt-1 text-xs">
    <span>Você jogou {{ Auth::user()->words_count }} de {{ $wordsCount }} palavras totalizando em
        {{ Auth::user()->total_score }} pontos</span>
</div>

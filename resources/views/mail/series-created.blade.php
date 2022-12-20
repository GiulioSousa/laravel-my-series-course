@component('mail::message')
    {{-- # Uma nova série foi criada com sucesso --}}
# {{ $nomeSerie }} foi criada com sucesso.
{{-- -Série 1
    -Temporadas: #
    -Episódios: # --}}
A série {{ $nomeSerie }} com {{ $qtdTemporadas }} temporadas e {{ $epsPorTemporada }} episódios por temporada foi criada.

Acesse aqui:
    @component('mail::button', ['url' => route('seasons.index', $idSerie)])
        Ver série
    @endcomponent
@endcomponent
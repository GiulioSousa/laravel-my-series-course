<x-layout title="Temporadas de {!! $series->nome !!}">
{{-- <x-layout title="Temporadas"> --}}
    <ul class="list-group">
        @foreach ($seasons as $season)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <a href="{{ route('episodes.index', $season->id) }}">
                Temporada {{ $season->number }}
            </a>
            <span class="badge bg-secondary">
                {{-- Episódios: {{ $season->episodes->count() }} --}}
                {{-- {{ $season->episodes()->watched()->count() }} / {{ $season->episodes->count() }} --}}
                {{-- {{ $season->episodes->filter(fn ($episode) => $episode->watched) --}}
                            {{-- ->count() }} / {{ $season->episodes->count() }} --}}
                {{ $season->numberWatchedEpisodes() }} / {{ $season->episodes->count() }}
            </span>
        </li>
        @endforeach
        {{-- {{ dd($seasons) }} --}}
    </ul>
</x-layout>
<?php

//MEU CÓDIGO
namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Season;
use Illuminate\Http\Request;

class EpisodesController
{
    public function index(Season $season)
    {
        return view('episodes.index', [
            'episodes' => $season->episodes,
            'mensagemSucesso' => session('mensagem.sucesso')
        ]);
    }

    public function update(Request $request, Season $season)
    {
        dd($request->all());
        $watchedEpisodes = $request->episodes;
        $season->episodes->each(function (Episode $episode) use ($watchedEpisodes) {
            $episode->watched = in_array($episode->id, $watchedEpisodes);
        });
        $season->push();

        return to_route('episodes.index', $season->id)
            ->with('mensagem.sucesso', 'Episódios marcados com sucesso');
    }
}

//CÓDIGO DO HERLON
/* namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Season;
use illuminate\Http\Request;

class EpisodesController {

    public function index(Season $season) 
    {
        return view('episodes.index', [
            'episodes' => $season->episodes,
            'mensagemSucesso' => session('mensagem.sucesso')
        ]);
    }

    public function update(Request $request, Season $season) 
    {
        dd($request->all());
        // dd(Episode::get());
        // dd($request->method());
        $watchedEpisodes = $request->episodes;
        $season->episodes->each(function (Episode $episode) use ($watchedEpisodes) {
            // dd($watchedEpisodes);
            $episode->watched = in_array($episode->id, $watchedEpisodes);
        });
        $season->push();//salva as alterações da model atual e seus relacionamentos

        return to_route('episodes.index', $season->id)->with('mensagem.sucesso', 'Episódios marcados como assistidos');    
    }
} */
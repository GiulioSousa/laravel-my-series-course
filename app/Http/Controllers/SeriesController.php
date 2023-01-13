<?php

namespace App\Http\Controllers;

use App\Events\SeriesCreated;
use App\Http\Middleware\Autenticador;
use App\Http\Requests\SeriesFormRequest;
// use App\Mail\SeriesCreated;
// use App\Models\Episode;
// use App\Models\Season;
use App\Models\Series;
// use App\Models\User;
// use App\Repositories\EloquentSeriesRepository;
use App\Repositories\SeriesRepository;
// use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Mail;

// use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $repository)
    {
        $this->middleware(Autenticador::class)->except('index');
    }

    public function index(Request $request)
    {
        // $series = DB::select('SELECT nome FROM series');
        // dd($series);

        /* if (!Auth::check()) {
            throw new AuthenticationException();
        } */

        $series = Series::all();
        // $series = Serie::with(['temporadas'])->get();
        // $series = Serie::active();
        // $series = Serie::query()->orderBy('nome')->get();
        // dd($series);

        /* return view('listar-series', [
            'series' => $series
        ]); */

        // return view('listar-series', compact('series'));

        // $mensagemSucesso = $request->session()->get('mensagem.sucesso');
        $mensagemSucesso = session('mensagem.sucesso');
        // $request->session()->forget('mensagem.sucesso');

        return view('series.index')
            ->with('series', $series)
            ->with('mensagemSucesso', $mensagemSucesso);
    }

    public function create()
    {
        return view('series.create');
    }

    // public function store(Request $request)
    // public function store(SeriesFormRequest $request, SeriesRepository $repository)
    public function store(SeriesFormRequest $request)
    {
        // dd($request->file('cover')); //Acesso à requisição de arquivos/imagens.
        // $serie = $repository->add($request);

        // $request->file('cover')->storeAs('series_cover', 'nome-arquivo');
        $coverPath = $request->file('cover')->store('series_cover', 'public');
        $request->coverPath = $coverPath;

        $serie = $this->repository->add($request);
        $seriesCreatedEvent = new SeriesCreated(
            $serie->nome,
            $serie->id,
            $request->seasonsQty,
            $request->episodesQty
        );

        /* SeriesCreated::dispatch(
            $serie->nome,
            $serie->id,
            $request->seasonsQty,
            $request->episodesQty
        ); */
        // $seriesCreatedEvent->dispatch();
        event($seriesCreatedEvent);

        /* $request->validate([
            'nome' => ['required', 'min:3']
        ]); */

        // $nomeSerie = $request->input('nome');
        // dd($request->all());
        // $nomeSerie = $request->nome;
        // $serie = new Serie();
        // $serie->nome = $nomeSerie;
        // Serie::create(['nome' => 'Teste']);
        // Serie::create($request->all());

        // DB::beginTransaction();

        // $serie = null;
        // DB::transaction(function () use ($request, &$serie) {
        // $serie = DB::transaction(function () use ($request, &$serie) {
        /* $serie = DB::transaction(function () use ($request) {
            $serie = Series::create($request->all());
            $seasons = [];
            for ($i = 1; $i <= $request->seasonQty; $i++) {
                $seasons[] = [
                    'series_id' => $serie->id,
                    'number' => $i
                ];
            }
            Season::insert($seasons);

            $episodes = [];
            foreach ($serie->seasons as $season) {
                for ($j = 1; $j <= $request->episodesQty; $j++) {
                    $episodes[] = [
                        'season_id' => $season->id,
                        'number' => $j
                    ];
                }
            }
            Episode::insert($episodes);

            return $serie;
            // }, 5);
        }); */

        // DB::commit();
        // DB::rollBack();

        /* $serie = Series::create($request->all());
        $seasons = [];

        for ($i = 1; $i <= $request->seasonsQty; $i++) {
            // $temporada = $serie->temporadas()->create([
            $seasons[] = [
                'series_id' => $serie->id,
                'number' => $i,
            ];
        }

        Season::insert($seasons);
        
        $episodes = [];
        foreach ($serie->seasons as $season) {
            for ($j = 1; $j <= $request->episodesQty; $j++) {
                $episodes[] = [
                    'season_id' => $season->id,
                    'number' => $j
                ];
            }
        }
        
        Episode::insert($episodes); */
        // dd($serie);

        // session(['mensagem.sucesso' => 'Série adicionada com sucesso']);
        // $request->session()->flash('mensagem.sucesso', "Série '{$serie->nome}' adicionada com sucesso");

        // DB::insert('INSERT INTO series (nome) VALUES (?)', [$nomeSerie]);

        // $serie->save();

        // return redirect('/series');
        // return redirect(route('series.index'));
        // return redirect()->route('series.index');
        // return to_route('series.index');

        /*  $email = new SeriesCreated(
            $serie->nome,
            $serie->id,
            $request->seasonsQty,
            $request->episodesQty
        ); */

        /* $userList = User::all();
        // foreach ($userList as $user) {
        foreach ($userList as $index => $user) {
            $email = new SeriesCreated(
                $serie->nome,
                $serie->id,
                $request->seasonsQty,
                $request->episodesQty
            );
            // Mail::to($user)->send($email);
            // Mail::to($user)->queue($email);
            // $when = new \DateTime();
            // $when->modify($index * 2 . ' seconds');
            $when = now()->addSeconds($index * 5);

            Mail::to($user)->later($when, $email);
            // sleep(2);
        } // Bloco de código movido para o listener */

        // Mail::to(Auth::user()->send($email));
        // Mail::to($request->user())->send($email);

        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$serie->nome}' adicionada com sucesso");
    }

    // public function destroy(Request $request)
    // public function destroy(Serie $series, Request $request)
    public function destroy(Series $series)
    {
        // dd($request->idSerie);
        // dd($request->route());
        // Serie::destroy($request->idSerie); //Para os métodos 1 e 2
        $series->delete();

        // $serie = Serie::find($request->series);
        // $nomeSerie = $serie->nome;
        // Serie::destroy($request->series); // Para o método 3
        // $request->session()->put('mensagem.sucesso', 'Série removida com sucesso');
        // $request->session()->flash('mensagem.sucesso', "Série '{$nomeSerie}' removida com sucesso");
        // $request->session()->flash('mensagem.sucesso', "Série '{$series->nome}' removida com sucesso");

        // return to_route('series.index');
        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$series->nome}' removida com sucesso");
    }

    public function edit(Series $series)
    {
        // dd($series->temporadas());
        // dd($series->temporadas);
        return view('series.edit')->with('serie', $series);
    }

    // public function update(Serie $series, Request $request)
    public function update(Series $series, SeriesFormRequest $request)
    {
        // $series->nome = $request->nome;
        $series->fill($request->all());
        $series->save();

        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$series->nome}' atualizada com sucesso");
    }
}

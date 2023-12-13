<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Watch;

class WatchController extends Controller
{
    public function index()
    {

        //recupero tutti gli orologi dal db
        $watches = Watch::all();

        return view('dashboard', [
            'watches' => $watches
        ]);
    }

    public function show($slug)
    {

        $watch = Watch::where('slug', $slug)->first();

        return view('watches.show', [
            'watch' => $watch
        ]);
    }

    public function create()
    {
        return view('watches.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $data['images'] = json_encode(explode(",", $data['images']));

        $labels = [
            'Reference',
            'Condition',
            'Watch Strap',
            'Dial',
            'Size',
            'Style',
            'Scope of delivery',
            'Construction year',
            'Material of the casing'
        ];

        $data['labels'] = json_encode($labels);

        //aggiungi lo slug
        $data['slug'] = $this->generateSlug($data['brand'] . ' ' . $data['model']);

        $newWatch = new Watch();
        $newWatch->fill($data);
        $newWatch->save();

        return redirect()->route('dashboard');
    }

    public function edit($slug)
    {
        $watch = Watch::where('slug', $slug)->firstOrFail();

        return view('watches.edit', [
            'watch' => $watch
        ]);
    }


    public function update(Request $request, $slug)
    {
        //recupero dal db l'orologio che voglio modificare
        $watchToEdit = Watch::where('slug', $slug)->firstOrFail();

        $data = $request->all();

        $data['images'] = json_encode(explode(",", $data['images']));

        
        $labels = [
            'Reference',
            'Condition',
            'Watch Strap',
            'Dial',
            'Size',
            'Style',
            'Scope of delivery',
            'Construction year',
            'Material of the casing'
        ];
        //se è null il campo delle etichette dell'orologio da modificare allora lo inizializzo
        if (is_null($watchToEdit->labels)) {
            $watchToEdit->labels = json_encode($labels);
        }

        if ($data['brand'] == $watchToEdit->brand && $data['model'] == $watchToEdit->model) {
            $data['slug'] = $watchToEdit->slug;
        } else { //se è cambiato il modello o la marca dell'orologio modifico lo slug
            $data['slug'] = $this->generateSlug($data['brand'] . ' ' . $data['model']);
        }

        $watchToEdit->update($data);

        return redirect()->route('watches.show', $watchToEdit->slug);
    }


    public function destroy($slug) {
        $watchToDelete = Watch::where('slug', $slug)->firstOrFail();

        $watchToDelete->delete();

        return redirect()->route('dashboard');
    }






    protected function generateSlug($title)
    {
        $counter = 0;

        do {
            $slug = Str::slug($title, '-') . ($counter > 0 ? '-' . $counter : '');

            $alreadyExists = Watch::where('slug', $slug)->first();

            $counter++;
        } while ($alreadyExists);

        return $slug;
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

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
        $labels = [
            'Brand',
            'Model',
            'Ref. No.',
            'Case Size',
            'Case Material',
            'Bezel',
            'Bracelet Material',
            'Box',
            'Cards/Papers',
            'Condition'
        ];

        $watch = Watch::where('slug', $slug)->first();

        return view('watches.show', [
            'watch' => $watch,
            'labels' => $labels
        ]);
    }

    public function create()
    {
        return view('watches.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $labels = [
            'Brand',
            'Model',
            'Ref. No.',
            'Case Size',
            'Case Material',
            'Bezel',
            'Bracelet Material',
            'Box',
            'Cards/Papers',
            'Condition'
        ];

        $data['labels'] = json_encode($labels);

        //aggiungi lo slug
        $data['slug'] = $this->generateSlug($data['brand'] . ' ' . $data['model']);

        //array che conterrà la lista dei path delle immagini caricate
        $imagesList = [];
        $folder = $data['model'] . 'folder' . time() . rand(); //sempre diversa ad ogni chiamata di store() in base alla funzione time()
        //gestione delle immagini
        if ($request->has('images')) {
            //ciclo sull'array di istanze di file che mi viene passato nella request
            foreach ($request->file('images') as $imageFile) {
                $image_name = $data['model'] . '-image-' . time() . rand(1, 1000) . '.' . $imageFile->getClientOriginalExtension();
                //ora spostiamo l'immagine dentro lo storage dentro la cartella creata sopra
                $image_path = $imageFile->storeAs($folder, $image_name, 'public');

                array_push($imagesList, $image_path);
            }
        }

        $data['images'] = json_encode($imagesList);

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
        
        //se non vengono passate immagini vuol dire che non si vogliono modificare le
        //immagini associate all'orologio e quindi rimangono quelle vecchie
        if ($request->has('images')) {
            //recupero i path delle vecchie immagini dell'orologio che voglio modificare
            $old_images = json_decode($watchToEdit->images);
            dd($old_images);
            dd($request->file('images'));
        }
        dd($request->file('images'));

        $labels = [
            'Brand',
            'Model',
            'Ref. No.',
            'Case Size',
            'Case Material',
            'Bezel',
            'Bracelet Material',
            'Box',
            'Cards/Papers',
            'Condition'
        ];
        //se è null il campo delle etichette dell'orologio da modificare allora lo inizializzo
        if (is_null($watchToEdit->labels)) {
            $watchToEdit->labels = json_encode($labels);
        } else if (json_decode($watchToEdit->labels) !== $labels) {
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


    public function destroy($slug)
    {
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

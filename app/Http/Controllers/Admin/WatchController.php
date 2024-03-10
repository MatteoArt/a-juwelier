<?php

namespace App\Http\Controllers\Admin;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\StoreWatchRequest;
use App\Http\Requests\UpdateWatchRequest;

use App\Models\Watch;
use Illuminate\Support\Facades\Storage;

class WatchController extends Controller
{
    public function index(Request $request)
    {

        $filter = $request->query('search');
        $query = Watch::query();

        if ($filter) {
            $watches = $query->where('brand', 'like', '%' . $filter . '%')
                ->orWhere('model', 'like', '%' . $filter . '%')
                ->orWhere('ref', 'like', '%' . $filter . '%')->get();
        } else {
            //recupero tutti gli orologi dal db
            $watches = Watch::all();
        }

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
            'Year of production',
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
        $labels = [
            'Brand',
            'Model',
            'Ref. No.',
            'Year of production',
            'Case Size',
            'Case Material',
            'Bezel',
            'Bracelet Material',
            'Box',
            'Cards/Papers',
            'Condition'
        ];

        return view('watches.create', [
            'labels' => $labels
        ]);
    }

    public function store(StoreWatchRequest $request)
    {
        $data = $request->validated();

        $labels = [
            'Brand',
            'Model',
            'Ref. No.',
            'Year of production',
            'Case Size',
            'Case Material',
            'Bezel',
            'Bracelet Material',
            'Box',
            'Cards/Papers',
            'Condition'
        ];

        $characteristics = $data['characteristics'];

        $data['characteristics'] = json_encode($characteristics);

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

        //faccio reverse perchè altrimenti mi carica prima le ultime selezionate
        $data['images'] = json_encode(array_reverse($imagesList));

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


    public function update(UpdateWatchRequest $request, $slug)
    {
        //recupero dal db l'orologio che voglio modificare
        $watchToEdit = Watch::where('slug', $slug)->firstOrFail();

        $data = $request->validated();

        //recupero i path delle vecchie immagini dell'orologio che voglio modificare
        $old_images = json_decode($watchToEdit->images);

        //recupero il nome della cartella dove si trovano le immagini dell'orologio da modificare
        $directory_name = dirname($old_images[0]);

        $newImagesList = [];
        //se non vengono passate immagini vuol dire che non si vogliono modificare le
        //immagini associate all'orologio e quindi rimangono quelle vecchie
        if ($request->has('images')) {
            //se mi vengono passate meno immagini di quelle presenti in precedenza allora prima di
            //caricare le nuove pulisco la cartella da tutte le immagini vecchie 
            if (count($request->file('images')) < count($old_images)) {
                $files = Storage::files($directory_name);
                Storage::delete($files);
            }
            foreach ($request->file('images') as $index => $image) {
                $newImageName = $data['model'] . '-image-' . time() . rand(1, 1000) . '.' . $image->getClientOriginalExtension();

                //ora recupera vecchia immagine e poi cancellala solo se quella chiave esiste nell'array
                //originario delle vecchie immagini (l'utente potrebbe passarmi più immagini di quelle
                //memorizzate in precedenza)
                if (array_key_exists($index, $old_images)) {
                    $old_img = $old_images[$index];

                    if (Storage::exists($old_img)) {
                        Storage::delete($old_img); //elimino immagine vecchia
                    }
                }

                //memorizzo la nuova immagine
                $new_image_path = $image->storeAs($directory_name, $newImageName, 'public');

                array_push($newImagesList, $new_image_path);
            }

            //faccio reverse perchè altrimenti mi carica prima le ultime selezionate
            $data['images'] = json_encode(array_reverse($newImagesList));
        } else { //significa che non si vogliono modificare le foto e quindi rimangono invariate
            $data['images'] = $old_images;
        }

        $labels = [
            'Brand',
            'Model',
            'Ref. No.',
            'Year of production',
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

        if ($watchToDelete->images) {
            $images = json_decode($watchToDelete->images);
            $directory = dirname($images[0]);

            Storage::deleteDirectory($directory);
        }

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

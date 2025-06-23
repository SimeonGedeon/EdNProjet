<?php

namespace App\Http\Controllers;

use App\Models\Pensee;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class PenseeController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'verset' => 'required|string|max:255',
            'contenu' => 'required|string',
            'hashtags' => 'nullable|string|max:255',
            'exhortation' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'est_publie' => 'sometimes|boolean'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('pensees', 'public');
        }

        $pensee = Pensee::create([
            'titre' => $validated['titre'],
            'verset' => $validated['verset'],
            'contenu' => $validated['contenu'],
            'hashtags' => $validated['hashtags'],
            'exhortation' => $validated['exhortation'],
            'image_path' => $imagePath,
            'est_publie' => $request->has('est_publie') ? (bool)$request->est_publie : false,
            'date_publication' => $request->has('est_publie') && $request->est_publie ? now() : null
        ]);

        // Si la pensée est publiée, on peut déclencher des actions supplémentaires
        if ($pensee->est_publie) {
            $this->publierPensee($pensee);
        }

        return response()->json([
            'message' => 'Pensée enregistrée avec succès',
            'publiee' => $pensee->est_publie,
            'pensee' => $pensee
        ], 201);
    }

    protected function publierPensee(Pensee $pensee)
    {
        // Envoyer une notification aux abonnés
        // $pensee->notify(new NouvellePenseeNotification());

        // Mettre à jour les flux RSS
        // $this->updateRssFeed();

        // Autres actions liées à la publication...
    }

    public function index()
    {
        $pensees = Pensee::pensees()->paginate(8);
        $today = Carbon::now();
        return view('pensees.index', compact('pensees', 'today'));
    }

    public function show($id)
    {
        $pensee = Pensee::findOrFail($id);

        return view('pensees.show', compact('pensee'));
    }

    /* public function search(Request $request)
    {
        $query = $request->input('q');

        $pensees = Pensee::where('contenu', 'like', "%$query%")
            ->orWhere('exhortation', 'like', "%$query%")
            ->orWhere('verset', 'like', "%$query%")
            ->get();

        return response()->json($pensees);
    } */
}

<?php

namespace App\Http\Controllers;

use App\Models\Enseignement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class EnseignementController extends Controller
{

    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'categorie' => 'required|string|in:Doctrine,Vie pratique,Étude biblique',
            'contenu' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'hashtags' => 'nullable|string|max:255',
            'est_publie' => 'sometimes|boolean'
        ]);

        // Gestion de l'image
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('enseignements', 'public');
        }

        // Création de l'enseignement
        $enseignement = Enseignement::create([
            'titre' => $validated['titre'],
            'categorie' => $validated['categorie'],
            'contenu' => $validated['contenu'],
            'image_path' => $imagePath,
            'hashtags' => $validated['hashtags'],
            'est_publie' => $request->boolean('est_publie'),
            'date_publication' => $request->boolean('est_publie') ? now() : null,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('enseignement.show', $enseignement->id)
            ->with('success', 'Enseignement enregistré avec succès!');
    }
}

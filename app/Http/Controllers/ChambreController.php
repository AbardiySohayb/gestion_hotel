<?php

namespace App\Http\Controllers;

use App\Models\Chambre;
use App\Models\ChambreType;
use Illuminate\Http\Request;

class ChambreController extends Controller
{
    public function index()
    {
        $chambres = Chambre::with('chambreType')->get();
        return view('chambres.index', compact('chambres'));
    }

    public function create()
    {
        $chambreTypes = ChambreType::all();
        return view('chambres.create', compact('chambreTypes'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'numero' => 'required|string|max:255',
            'chambre_type_id' => 'required|exists:chambre_types,id',
            'disponible' => 'required|boolean',
        ]);

        Chambre::create($validatedData);

        return redirect()->route('chambres.index')->with('success', 'Chambre créée avec succès.');
    }

    public function show(Chambre $chambre)
    {
        return view('chambres.show', compact('chambre'));
    }

    public function edit(Chambre $chambre)
    {
        $chambreTypes = ChambreType::all();
        return view('chambres.edit', compact('chambre', 'chambreTypes'));
    }

    public function update(Request $request, Chambre $chambre)
    {
        $validatedData = $request->validate([
            'numero' => 'required|string|max:255',
            'chambre_type_id' => 'required|exists:chambre_types,id',
            'disponible' => 'required|boolean',
        ]);

        $chambre->update($validatedData);

        return redirect()->route('chambres.index')->with('success', 'Chambre mise à jour avec succès.');
    }

    public function destroy(Chambre $chambre)
    {
        $chambre->delete();

        return redirect()->route('chambres.index')->with('success', 'Chambre supprimée avec succès.');
    }
    public function getBookedRooms(Request $request)
    {
        $reservation_id = $request->query('reservation_id');
        if (!$reservation_id) {
            return response()->json(['error' => 'reservation_id is required'], 400);
        }

        $reservation = Reservation::find($reservation_id);
        if (!$reservation) {
            return response()->json(['error' => 'Reservation not found'], 404);
        }

        $bookedRooms = $reservation->chambres()->get(['numero']);
        return response()->json($bookedRooms);
    }

    public function showBookedRooms(Request $request)
    {
        $reservation_id = $request->query('reservation_id');
        if (!$reservation_id) {
            return response()->json(['error' => 'reservation_id is required'], 400);
        }

        $reservation = Reservation::find($reservation_id);
        if (!$reservation) {
            return response()->json(['error' => 'Reservation not found'], 404);
        }

        $bookedRooms = $reservation->chambres()->get();
        return response()->json(['data' => $bookedRooms]);
    }
}

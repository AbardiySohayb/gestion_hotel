<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\ChambreMaintenance;
use App\Models\Chambre; 
use App\Models\ChambreType; 
use App\Models\Invoice;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;


class DashController extends Controller
{
    public function index()
    {
        // Retrieve all invoices
        $invoices = Invoice::with('reservation.user')->get();

        // Total reservations
        $totalReservations = Reservation::count();
        $reservationData = Reservation::selectRaw('DATE(created_at) as date, COUNT(*) as count')
        ->groupBy('date')
        ->get();
        // Total revenue
        $totalRevenue = Invoice::sum('total_amount');
        $roomTypeReservations = ChambreType::withCount('chambres')
        ->get()
        ->map(function ($type) {
             return [
                 'type' => $type->type,
                 'reservations' => $type->chambres->sum(function ($chambre) {
                     return $chambre->reservations->count();
                 })
             ];
        });
        // Today's reservations count
        $todaysReservations = Reservation::whereDate('created_at', now()->toDateString())->count();

        // Today's chambre maintenance count
        $todaysMaintenance = ChambreMaintenance::whereDate('date_debut', '<=', now()->toDateString())
        ->whereDate('date_fin', '>=', now()->toDateString())
        ->count();
        return view('hotel_dash.index', compact(
            'invoices', 'totalReservations', 'totalRevenue',  'reservationData', 'roomTypeReservations','todaysReservations', 'todaysMaintenance'
        ));
    }

    public function storeChambre(Request $request)
    {
        $validated = $request->validate([
            'chambre_id' => 'required|exists:chambres,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'description' => 'nullable|string',
        ]);

        $chambreMaintenance = ChambreMaintenance::create($validated);
        $chambreMaintenance->load('chambre');

        return response()->json($chambreMaintenance);
    }

    public function updateChambre(Request $request, $id)
    {
        $validated = $request->validate([
            'chambre_id' => 'required|exists:chambres,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'description' => 'nullable|string',
        ]);
    
        $chambreMaintenance = ChambreMaintenance::findOrFail($id);
        $chambreMaintenance->update($validated);
        $chambreMaintenance->load('chambre');
    
        return response()->json($chambreMaintenance);
    }
    
    public function chambreMaintenanceDetails($id)
    {
        $chambre = ChambreMaintenance::find($id);

        if (!$chambre) {
            return response()->json(['error' => 'Chambre not found'], 404);
        }

        return response()->json($chambre);
    }

    public function deleteChambre($id)
    {
        $chambreMaintenance = ChambreMaintenance::findOrFail($id);
        $chambreMaintenance->delete();

        return response()->json(['message' => 'Chambre en maintenance supprimée avec succès', 'id' => $id]);
    }

    public function chambreMaintenance()
    {
        $chambres = ChambreMaintenance::with('chambre')->get();
        return view('hotel_dash.chambre_maintenance', compact('chambres'));
    }

    public function form()
    {
        return view('hotel_dash.form');
    }

    public function table()
    {
        return view('hotel_dash.table');
    }

    public function chart()
    {
        return view('hotel_dash.chart');
    }

    public function downloadInvoice($id)
    {
        $invoice = Invoice::findOrFail($id);

        // Vérifiez si la facture contient des données binaires
        if (!$invoice->invoice_pdf) {
            return redirect()->back()->with('error', 'Invoice not found');
        }

        // Créez une réponse avec le contenu binaire du PDF
        return Response::make($invoice->invoice_pdf, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="invoice_' . $id . '.pdf"',
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout(); // Déconnecte l'utilisateur

        $request->session()->invalidate(); // Invalide la session
        $request->session()->regenerateToken(); // Régénère le token pour prévenir les attaques CSRF

        return redirect('/home'); // Redirige vers la page d'accueil
    }

}

<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChambreType;
use App\Models\Reservation;
use App\Models\ChambreMaintenance;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        // Récupérer les dates du formulaire
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Convertir les dates en format Y-m-d pour une comparaison correcte
        $startDate = date('Y-m-d', strtotime($startDate));
        $endDate = date('Y-m-d', strtotime($endDate));

        // Nombre de colonnes et de rangées pour les chambres
        $columns = 6;
        $rows = 10;

        // Rechercher les réservations qui chevauchent la période sélectionnée
        $bookedRooms = Reservation::join('chambre_reservation', 'reservations.id', '=', 'chambre_reservation.reservation_id')
            ->join('chambres', 'chambre_reservation.chambre_id', '=', 'chambres.id')
            ->where(function($query) use ($startDate, $endDate) {
                $query->where('reservations.date_debut', '<=', $endDate)
                      ->where('reservations.date_fin', '>=', $startDate);
            })
            ->pluck('chambres.numero')
            ->map(function ($roomNumber) use ($columns, $rows) {
                $floor = ceil($roomNumber / $columns);
                $roomOnFloor = $roomNumber % $columns;
                if ($roomOnFloor == 0) {
                    $roomOnFloor = $columns;
                } else {
                    $roomOnFloor = $columns - $roomOnFloor + 1;
                }
                $floor = $rows - $floor + 1;
                return $floor . '_' . $roomOnFloor;
            })
            ->toArray();

        // Rechercher les chambres en maintenance qui chevauchent la période sélectionnée
        $maintenanceRooms = ChambreMaintenance::join('chambres', 'chambre_maintenance.chambre_id', '=', 'chambres.id')
            ->where(function($query) use ($startDate, $endDate) {
                $query->where('chambre_maintenance.date_debut', '<=', $endDate)
                      ->where('chambre_maintenance.date_fin', '>=', $startDate);
            })
            ->pluck('chambres.numero')
            ->map(function ($roomNumber) use ($columns, $rows) {
                $floor = ceil($roomNumber / $columns);
                $roomOnFloor = $roomNumber % $columns;
                if ($roomOnFloor == 0) {
                    $roomOnFloor = $columns;
                } else {
                    $roomOnFloor = $columns - $roomOnFloor + 1;
                }
                $floor = $rows - $floor + 1;
                return $floor . '_' . $roomOnFloor;
            })
            ->toArray();

        // Combiner les chambres réservées et les chambres en maintenance
        $blockedRooms = array_merge($bookedRooms, $maintenanceRooms);

        if ($request->ajax()) {
            return response()->json($blockedRooms);
        } else {
            // Obtenir tous les types de chambres
            $roomTypes = ChambreType::all();

            // Configuration de Stripe
            Stripe::setApiKey(env('STRIPE_SECRET'));

            // Créer une PaymentIntent
            $amount = 1099; // Montant en centimes (1099 = 10,99 €)
            $intent = PaymentIntent::create([
                'amount' => $amount,
                'currency' => 'eur',
                'payment_method_types' => ['card'],
            ]);

            return view('reservation.index', compact('roomTypes', 'blockedRooms', 'intent','startDate','endDate'));
        }
    }
}

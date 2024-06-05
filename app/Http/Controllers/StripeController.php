<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Models\Reservation;
use App\Models\Chambre;
use Stripe\Stripe;
use Stripe\Checkout\Session as CheckoutSession;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\InvoiceMail;
use App\Models\Invoice;


class StripeController extends Controller
{
    public function createCheckoutSession(Request $request)
    {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            // Enregistrer les détails de la réservation dans la session
            session([
                'reservationDetails' => $request->reservationDetails,
                'totalAmount' => $request->amount,
                'startDate' => $request->start_date,
                'endDate' => $request->end_date
            ]);

            // Créer une session de paiement avec Stripe
            $session = CheckoutSession::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Room Reservation',
                            'description' => $request->reservationDetails,
                        ],
                        'unit_amount' => $request->amount,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('checkout.success'),
                'cancel_url' => route('checkout.cancel'),
            ]);

            return response()->json(['id' => $session->id]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function success(Request $request)
    {
        // Récupérer les détails de la réservation depuis la session
        $reservationDetails = session('reservationDetails');
        $totalAmount = session('totalAmount');
        $startDate = session('startDate');
        $endDate = session('endDate');
    
        // Enregistrer la réservation dans la base de données
        $reservation = Reservation::create([
            'user_id' => Auth::id(),
            'date_debut' => $startDate,
            'date_fin' => $endDate
        ]);
    
        // ... Code pour associer les chambres à la réservation ...
        preg_match_all('/Siège N° (\d+):/', $reservationDetails, $matches);

        if ($matches && isset($matches[1])) {
            foreach ($matches[1] as $chambreNumero) {
                $chambre = Chambre::where('numero', $chambreNumero)->first();
                if ($chambre) {
                    // Associer la chambre à la réservation
                    $reservation->chambres()->attach($chambre->id);
                } else {
                    Log::warning('Chambre with Numero ' . $chambreNumero . ' not found.');
                    return redirect()->route('debug.view', ['numero' => $chambreNumero, 'error' => 'Chambre not found']);
                }
            }
        }
        // Générer la facture en PDF
        $pdf = Pdf::loadView('invoice', compact('reservationDetails', 'totalAmount', 'startDate', 'endDate'));
    
        // Enregistrer le PDF et vérifier si le fichier est bien généré
        $invoicePath = 'invoices/invoice_' . $reservation->id . '.pdf';
        try {
            $pdf->save(storage_path('app/public/' . $invoicePath));
            Log::info('Invoice generated: ' . $invoicePath);
        } catch (\Exception $e) {
            Log::error('Failed to generate invoice: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to generate invoice'], 500);
        }
    
        // Lire le contenu du fichier PDF
        $invoicePdf = file_get_contents(storage_path('app/public/' . $invoicePath));
    
        // Enregistrer les détails de la facture dans la base de données
        Invoice::create([
            'reservation_id' => $reservation->id,
            'invoice_pdf' => $invoicePdf,
            'total_amount' => $totalAmount,
        ]);
    
        // Envoyer l'email avec la facture en pièce jointe
       // Mail::to(Auth::user()->email)->send(new InvoiceMail($reservation, $invoicePath));
    
        return view('checkout.success', compact('reservation', 'totalAmount', 'reservationDetails','startDate','endDate'));
    }
    public function downloadInvoice($id)
{
    $invoice = Invoice::where('reservation_id', $id)->firstOrFail();
    $invoicePath = storage_path('app/public/invoices/invoice_' . $id . '.pdf');

    if (!file_exists($invoicePath)) {
        abort(404, 'Invoice not found');
    }

    return response()->download($invoicePath, 'invoice_' . $id . '.pdf', [
        'Content-Type' => 'application/pdf',
    ]);
}


    public function cancel()
    {
        return view('checkout.cancel');
    }
}

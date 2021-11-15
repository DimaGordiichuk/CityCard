<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketStoreRequest;
use App\Models\Card;
use App\Models\Ticket;
use App\Models\Transport;
use App\Models\User;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Show all tickets.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $tickets = Ticket::orderByDesc('created_at')
            ->simplePaginate(10);

        $users = User::all();
        $transports = Transport::all();

        return view('front.tickets.index', compact('tickets','users','transports'));
    }

    /**
     * Save new ticket.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TicketStoreRequest $request)
    {
        $transport = Transport::findOrFail($request->transport_id);

        $ticket = Ticket::create([
            'price' => $transport->price,
            'user_id' => $request->user_id,
            'card_id' => $request->card_id,
            'transport_id' => $request->transport_id,
            'created_at' => now(),
        ]);

        return redirect()->back()
            ->with('success', trans('notifications.store.success'));
    }

    /**
     * Return cards for user.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function selectCard(Request $request){

        if($request->ajax()){
            $cards = Card::where('user_id',$request->user_id)->get();
            $html = view('front.tickets.inc.selectcard',['cards' => $cards])->render();
            return response()->json(['options'=>$html]);
        }
    }
}

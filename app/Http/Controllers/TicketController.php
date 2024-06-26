<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketStoreRequest;
use App\Models\Card;
use App\Models\Ticket;
use App\Models\Transport;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
//use Google\Service\Sheets\ValueRange;

class TicketController extends Controller
{
    /**
     * Show all tickets.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request): View
    {

         //motto
//        $sheets = app('google')->make('sheets');
//        $name = $sheets->spreadsheets_values->get(config('google.spreadsheet.id'),'M3:B147');
//        $gaz = $sheets->spreadsheets_values->get(config('google.spreadsheet.id'),'B3:M147');
//        $values = $sheets->spreadsheets_values->getValues();
//        dd($name);


//        upg
        $client = new \Goutte\Client();
        $crawler = $client->request('GET', 'https://upg.ua/merezha_azs/');

        $html = $crawler->html();

        $stringData = stristr(stristr(stristr($html, 'var objmap ='), 'var map', true), '{');
        $stringData = html_entity_decode(trim($stringData));
        $stringData = substr($stringData, 0, -1);

        json_decode($stringData, true);

        $tickets = Ticket::orderByDesc('created_at')
            ->simplePaginate(10);

        $users = User::all();
        $transports = Transport::all();

        return view('front.tickets.index', compact('tickets', 'users', 'transports'));
    }

    /**
     * Save new ticket.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TicketStoreRequest $request): RedirectResponse
    {
        $transport = Transport::findOrFail($request->transport_id);

        Ticket::create([
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
    public function selectCard(Request $request): JsonResponse
    {
        if ($request->ajax()) {
            $cards = Card::where('user_id', $request->user_id)->get();
            $html = view('front.tickets.inc.selectcard', ['cards' => $cards])->render();

            return response()->json(['options'=>$html]);
        }
    }
}

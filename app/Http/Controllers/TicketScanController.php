<?php

namespace App\Http\Controllers;

use App\Ai\Agents\TicketScanner;
use App\Models\Budget;
use Illuminate\Http\Request;
use Laravel\Ai\Files;

class TicketScanController extends Controller
{
    public function store(Request $request, Budget $budget)
    {
        $request->validate([
            'image' => ['required', 'image', 'max:1240']
        ]);

        set_time_limit(120);

        /** @var \Laravel\Ai\Responses\StructuredAgentResponse $response */
        $response = (new TicketScanner)->prompt(
            'Lee este ticket de venta y extrae la informacion',
            attachments: [Files\Image::fromUpload($request->file('image'))],
            provider: 'openrouter',
            model: 'nvidia/nemotron-nano-12b-v2-vl:free',
            timeout: 120
        );

        if(empty($response['items'])) {
            return response()->json([
                'success' => false,
                'message' => 'No se pudieron extraer los productos del ticket'
            ]);
        }
    }
}

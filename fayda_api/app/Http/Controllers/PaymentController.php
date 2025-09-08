<?php

namespace App\Http\Controllers;

use App\Services\Contracts\PaymentServiceInterface;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentServiceInterface $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function store(Request $request)
    {

        $payment = $this->paymentService->create($request->all());
        return response()->json($payment);
    }
}

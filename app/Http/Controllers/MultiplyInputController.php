<?php

declare(strict_types=1);

namespace App\Http\Controllers;

class MultiplyInputController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function form()
    {
        return view('multiply-input.form');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function submit()
    {
        $customerName  = request('customer_name');
        $customerEmail = request('customer_email');
        $orderProducts = request('orderProducts');

        return view('multiply-input.submit', compact('customerName', 'customerEmail', 'orderProducts'));
    }
}

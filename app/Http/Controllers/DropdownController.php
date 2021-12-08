<?php

declare(strict_types=1);

namespace App\Http\Controllers;

class DropdownController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function form()
    {
        return view('dropdown.form');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function submit()
    {
        $country = request()->get('country');
        $city    = request()->get('city');

        return view('dropdown.submit', compact('country', 'city'));
    }
}

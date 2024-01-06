<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alcohol;
use App\Models\Image;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class AlcoholController extends Controller
{
    public function index()
    {
        $alcohols = Alcohol::paginate(10);

        return view('alcohols.index', compact('alcohols'));
    }

    public function create()
    {

        return view('alcohols.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

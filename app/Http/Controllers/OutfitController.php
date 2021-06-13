<?php

namespace App\Http\Controllers;

use App\Models\Outfit;
use Illuminate\Http\Request;
use App\Models\Master;
use Validator;
use PDF;

class OutfitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $masters = Master::all();

        if($request->master_id) {
            $outfits = Outfit::where('master_id', $request->master_id)->get();
            $master_id = $request-> master_id;
        }
        else {
            $outfits = Outfit::all();
            $master_id = 0;
        }


        if ($request->sort) {
          if('asc' == $request->order) {
            if ('size' == $request->sort) {
            $outfits = $outfits->sortBy('size');
            $order = 'asc';
            $sort = 'size';
            }
            elseif ('outfit' == $request->sort) {
                $outfits = $outfits->sortBy('type');
                $order = 'asc';
                $sort = 'outfit';
            }
        }
        if ($request->sort) {
            if('dsc' == $request->order) {
              if ('size' == $request->sort) {
              $outfits = $outfits->sortByDesc('size');
              $order = 'desc';
              $sort = 'size';
              }
              elseif ('outfit' == $request->sort) {
                  $outfits = $outfits->sortByDesc('type');
                  $order = 'desc';
                  $sort = 'outfit';
              }
          }
        }
    }
        return view('outfit.index', 
        [
            'outfits' => $outfits,
            'masters' => $masters,
            'order' => $order ?? '',
            'sort' => $sort ?? '',
            'master_id' => $master_id,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $masters = Master::all();
        return view('outfit.create', ['masters' => $masters]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'outfit_type' => ['required', 'min:3', 'max:50'],
            'outfit_color' => ['required', 'min:2', 'max:20'],
            'outfit_size' => ['required', 'integer','min:3', 'max:100'],
            'outfit_about' => ['required'],
            'master_id' => ['required', 'integer', 'min:1'],
        ],

       );

       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
       }

        $outfit = new Outfit;
        $outfit->type = $request->outfit_type;
        $outfit->color = $request->outfit_color;
        $outfit->size = $request->outfit_size;
        $outfit->about = $request->outfit_about;
        $outfit->master_id = $request->master_id;
        $outfit->save();
        return redirect()->route('outfit.index')->with('success_message', 'Sekmingai įrašytas.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Outfit  $outfit
     * @return \Illuminate\Http\Response
     */
    public function show(Outfit $outfit)

    {
        return view('outfit.show', ['outfit' => $outfit]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Outfit  $outfit
     * @return \Illuminate\Http\Response
     */
    public function edit(Outfit $outfit)
    {
        $masters = Master::all();
        return view('outfit.edit', ['outfit' => $outfit, 'masters' => $masters]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Outfit  $outfit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Outfit $outfit)
    {
        $validator = Validator::make($request->all(),
        [
            'outfit_type' => ['required', 'min:3', 'max:50'],
            'outfit_color' => ['required', 'min:2', 'max:20'],
            'outfit_size' => ['required', 'integer','min:3', 'max:100'],
            'outfit_about' => ['required'],
        ],
        );

        if ($validator->fails()) {
        $request->flash();
        return redirect()->back()->withErrors($validator);
        }

        $outfit->type = $request->outfit_type;
        $outfit->color = $request->outfit_color;
        $outfit->size = $request->outfit_size;
        $outfit->about = $request->outfit_about;
        $outfit->master_id = $request->master_id;
        $outfit->save();
        return redirect()->route('outfit.index')->with('success_message', 'Sėkmingai pakeistas.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Outfit  $outfit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Outfit $outfit)
    {
        $outfit->delete();
        return redirect()->route('outfit.index')->with('success_message', 'Sekmingai ištrintas.');
        
    }

    public function pdf(Outfit $outfit)
    {
        $pdf = PDF::loadView('outfit.pdf', ['outfit' => $outfit]);
        return $pdf->download('outfit-id'.$outfit->id.'.pdf');
    }
}

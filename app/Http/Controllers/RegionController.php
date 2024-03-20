<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\State;
use App\Models\City;
use Illuminate\Http\Request;

/**
 * Class RegionController
 * @package App\Http\Controllers
 */
class RegionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regions = Region::join('cities','cities.id','regions.city_id')->join('states','states.id','regions.state_id')->select('regions.*','cities.name_fr as city_name','states.name_fr as state_name')->get();

        return view('region.index', compact('regions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $region = new Region();
        $states = State::all();
        $cities = City::all();
        return view('region.create', compact('region','states','cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Region::$rules);

        $region = Region::create($request->all());

        return redirect()->route('regions.index')
            ->with('success', 'Region created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $region = Region::join('cities','cities.id','regions.city_id')->join('states','states.id','regions.state_id')->select('regions.*','cities.name_fr as city','states.name_fr as state')->where('regions.id',$id)->first();

        return view('region.show', compact('region'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $region = Region::find($id);
        $states = State::all();
        $cities = City::all();
        return view('region.edit', compact('region','states','cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Region $region
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Region $region)
    {
        request()->validate(Region::$rules);

        $region->update($request->all());

        return redirect()->route('regions.index')
            ->with('success', 'Region updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $region = Region::find($id)->delete();

        return redirect()->route('regions.index')
            ->with('success', 'Region deleted successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\ManagerRegion;
use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * Class ManagerRegionController
 * @package App\Http\Controllers
 */
class ManagerRegionController extends Controller
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
        $managerRegions = ManagerRegion::join('users','users.id','manager_regions.user_id')->join('regions','regions.id','manager_regions.region_id')->select('regions.name_fr as region_namme','users.*')->get();

        return view('manager-region.index', compact('managerRegions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $managerRegion = new ManagerRegion();
        $regions = Region::all();
        $users = User::where('user_type','manager')->get();
        return view('manager-region.create', compact('managerRegion','users','regions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(ManagerRegion::$rules);

        $managerRegion = ManagerRegion::create($request->all());

        return redirect()->route('manager-regions.index')
            ->with('success', 'ManagerRegion created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $managerRegion = ManagerRegion::join('users','users.id','manager_regions.user_id')->join('regions','regions.id','manager_regions.region_id')->select('regions.name_fr as region_namme','users.*')->where('manager_regions.user_id',$id)->first();

        return view('manager-region.show', compact('managerRegion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $managerRegion = ManagerRegion::join('users','users.id','manager_regions.user_id')->join('regions','regions.id','manager_regions.region_id')->select('regions.name_fr as region_namme','users.*')->where('users.id',$id)->first();
        $regions = Region::all();
        $users = User::where('user_type','manager')->get();

        return view('manager-region.edit', compact('managerRegion','users','regions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ManagerRegion $managerRegion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ManagerRegion $managerRegion)
    {
        request()->validate(ManagerRegion::$rules);

        $managerRegion->update($request->all());

        return redirect()->route('manager-regions.index')
            ->with('success', 'ManagerRegion updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $managerRegion = ManagerRegion::find($id)->delete();

        return redirect()->route('manager-regions.index')
            ->with('success', 'ManagerRegion deleted successfully');
    }
}

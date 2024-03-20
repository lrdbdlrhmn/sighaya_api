<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Region;
use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;

/**
 * Class ReportController
 * @package App\Http\Controllers
 */
class ReportController extends Controller
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
        $reports = Report::join('states','states.id','reports.state_id')->join('cities','cities.id','reports.city_id')->join('regions','regions.id','reports.region_id')->join('users','users.id','reports.user_id')->select('reports.*','cities.name_fr  as city','regions.name_fr  as region','states.name_fr as state','users.phone as user')->get();
        foreach ($reports as $key => $value) {
            # code...
            switch ($value->report_type) {
                case 'reason1':
                    $value->report_type = "Manque d'eau";
                    break;
                case 'reason2':
                    $value->report_type = "Fuite d'eau";
                    break;
                case 'reason3':
                    $value->report_type = "Facture non distribuée";
                    break;
                case 'reason4':
                    $value->report_type = "Erreur de relevé (réclamation sur la fact)";
                    break;
                case 'reason5':
                    $value->report_type = "Fraude signalée";
                break;
                case 'reason6':
                    $value->report_type = "Autre";
                break;
                default:
                    $value->report_type = "Autre"; 
                    break;
            }
        }
        //dd($reports);
        return view('report.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $report = new Report();
        $regions = Region::all();
        $cities = City::all();
        $states = State::all();
        return view('report.create', compact('report','regions','cities','states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd(request()->validate(Report::$rules));
        //request()->validate(Report::$rules);
        
        $report = Report::create($request->all());

        return redirect()->route('reports.index')
            ->with('success', 'Report created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $report = Report::find($id);

        return view('report.show', compact('report'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $regions = Region::all();
        $cities = City::all();
        $states = State::all();
        $report = Report::find($id);

        return view('report.edit', compact('report','states','cities','regions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Report $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        request()->validate(Report::$rules);

        $report->update($request->all());

        return redirect()->route('reports.index')
            ->with('success', 'Report updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $report = Report::find($id)->delete();

        return redirect()->route('reports.index')
            ->with('success', 'Report deleted successfully');
    }
}

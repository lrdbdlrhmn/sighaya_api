<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Report;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->user_type == 'admin') {
            $user_count = User::count();
            $tech_count = User::where('user_type','technical')->count();
            $manager_count = User::where('user_type','manager')->count();
            $report_count = Report::count();
            $report_resolue_count = Report::where('status','solved')->count();
            $report_encours_count = Report::where('status','technical')->count();
            $not_new = Report::where('status','!=','new')->count();

            $taux = intval(($report_count == 0) ? 0 : (($not_new*100)/$report_count));
            //$reports = Report::groupBy('status','id')->get();
            $report_types = ['reason1','reason2','reason3','reason4','reason5','reason6'];
            $reports = DB::table('reports')->select('report_type',DB::raw('COUNT(*) as total'))->groupBy('report_type')->whereIn('report_type',$report_types)->get();
            $values = array();
            $keys = array();
            $i =  0;
            foreach ($reports as $key => $value) {
                # code...
                switch ($value->report_type) {
                    case 'reason1':
                        $keys[$i] = "Manque d'eau";
                        break;
                    case 'reason2':
                        $keys[$i] = "Fuite d'eau";
                        break;
                    case 'reason3':
                        $keys[$i] = "Facture non distribuée";
                        break;
                    case 'reason4':
                        $keys[$i] = "Erreur de relevé (réclamation sur la fact)";
                        break;
                    case 'reason5':
                        $keys[$i] = "Fraude signalée";
                    break;
                    case 'reason6':
                        $keys[$i] = "Autre";
                    break;
                    default:
                        $keys[$i] = "Autre";
                        break;
                }
                
                $values[$i] = $value->total;
                $i++;
            }
            //dd($values);
            return view('home',['values' => $values,'keys' => $keys,'taux' => $taux,'report_resolue_count' => $report_resolue_count,'report_encours_count'=> $report_encours_count,'report_count' => $report_count,'user_count' => $user_count,'tech_count' => $tech_count,'manager_count' => $manager_count]);
        }

        return redirect()->to( '/' );
        
    }
}

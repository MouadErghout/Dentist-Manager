<?php

namespace App\Http\Controllers;

use App\Models\rdv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class RdvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        RdvController::MAJ();

        $rdvs=rdv::all()->where('week','=',date("W"))->sortByDesc('time');
        $times=array();
        $days=array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
        $months=array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

        for($j=strtotime("9:00");$j<strtotime("18:00");$j+=30 * 60)
            array_push($times,date("H:i", $j));

        return view('RDV.index', ['rdvs'=>$rdvs
            ,'week'=>date('W'),'days'=>$days,'times'=>$times,'months'=>$months
        ]);
    }

    public function switch2($week)
    {
        RdvController::MAJ();

        $rdvs=(rdv::all()->where('week','=',$week))->sortByDesc('time');

        $times=array();
        $days=array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
        $months=array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

        for($j=strtotime("9:00");$j<strtotime("18:00");$j+=30 * 60)
            array_push($times,date("H:i", $j));


        return view('RDV.index', ['rdvs'=>$rdvs,'week'=>$week,
            'days'=>$days,'times'=>$times,'months'=>$months
        ]);
    }

    public function switch1($week)
    {
        RdvController::MAJ();
        return view('RDV.create', ['times'=>$this->filtre($week),'week'=>$week]);
    }

    private function filtre($week)
    {
        $times=array();
        $RDVs=rdv::all()->where('week','=',$week);

        for($i=0;$i<6;$i++)
        {
            $day=array();
            $rdvsday=$RDVs->where('day','=',$i);

            for($j=strtotime("9:00");$j<strtotime("18:00");$j+=30 * 60)
                array_push($day,date("H:i", $j));


            foreach ($rdvsday as $rdv)
                unset($day[$rdv->time]);

            array_push($times,$day);
        }
        return $times;
    }

    static public function MAJ()
    {
        $rdvs1=(rdv::all()->where('week','=',date("W"))
            ->where('day','<',getdate()['wday']-1));
        foreach ($rdvs1 as $rdv1)
            $rdv1->delete();

        $rdvs2=((rdv::all()->where('week','=',date("W"))
            ->where('day','=',getdate()['wday']-1))->where('etat','=','pris'));

        $times=array();
        for($j=strtotime("9:00");$j<strtotime("18:00");$j+=30 * 60)
            array_push($times,date("H:i", $j));

        date_default_timezone_set("Africa/Casablanca");
        foreach ($rdvs2 as $rdv2)
        {
            if(strtotime($times[$rdv2->time])+60 * 60<=strtotime(date("H:i")))
                $rdv2->etat="raté";
            $rdv2->save();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('RDV.create', ['times'=>$this->filtre(date("W")),'week'=>date("W")]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request,$week)
    {
        if(!Auth::guard('admin')->check() || $request->uniquenumber=='true')
        {
            $request->validate([
                'name' => ['required', 'string', 'max:255','unique:rdvs'],
                'telephone' => ['required', 'digits:10','unique:rdvs'],
            ]);
        }
        $times=array();
        for($j=strtotime("9:00");$j<strtotime("18:00");$j+=30 * 60)
            array_push($times,date("H:i", $j));

        if($request->day==getdate()['wday']-1 && strtotime($times[$request->time])<strtotime(date("H:i")))
            return Redirect('/RDV/create')->with('error',"L'heure est invalide, saisissez une heure au delas de l'heure actuelle ");


        $year = date("Y");
        $month = date("m", strtotime("{$year}-W{$week}"));
        $rdv = new rdv();
        $rdv->year=$year;
        $rdv->month = $month-1;
        $rdv->week = $week;
        foreach ($request->request as $key=>$value)
        {
            if($key!="_token" && $key!="uniquenumber")
                $rdv->$key=$value;
        }
        $rdv->etat = 'pris';
        $rdv->save();
        $days=array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');


        return Redirect('/RDV/create')->with('success','Rendez-vous created successfully: '.date("Y-m-d", mktime(0, 0, 0, 1, ($rdv->week - 1) * 7 + $rdv->day+2, $rdv->year)).'('.$days[$rdv->day].') '.$times[$rdv->time]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\rdv  $rdv
     * @return \Illuminate\Http\Response
     */
    public function show(rdv $rdv)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\rdv  $rdv
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $rdv=rdv::find($id);
        $times=array();
        $days=array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');

        for($j=strtotime("9:00");$j<strtotime("18:00");$j+=30 * 60)
            array_push($times,date("H:i", $j));

        return view('RDV.edit', ['rdv'=>rdv::find($id)
            ,'day'=>$days[$rdv->day],'time'=>$times[$rdv->time]
            ,'times'=>$this->filtre($rdv->week)
            ,'week'=>$rdv->week
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\rdv  $rdv
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $week, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255',Rule::unique('rdvs')->ignore($id)],
            'telephone' => ['required', 'digits:10',Rule::unique('rdvs')->ignore($id)],
        ]);

        $year = date("Y");
        $month = date("m", strtotime("{$year}-W{$week}"));
        $rdv = rdv::find($id);
        $rdv->id=$id;
        $rdv->year=$year;
        $rdv->month = $month;
        $rdv->week = $week;
        foreach ($request->request as $key=>$value)
        {
            if($key!="_token" && $key!="uniquenumber" && $key!="_method")
                $rdv->$key=$value;

        }
        $rdv->etat = 'pris';
        $rdv->save();
        return Redirect('/RDV')->with('success','rendez-vous modified successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\rdv  $rdv
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        rdv::find($id)->delete();
        return Redirect('/RDV')->with('success','rendez-vous deleted successfully');
    }
}

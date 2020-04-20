<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePeriodRequest;

use Yajra\Datatables\Datatables;
use Carbon\Carbon;


use App\Period;

class PeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('period.index');
    }

    //return datatables object
    public function datatables(Request $request)
    {
        \DB::statement(\DB::raw('set @rownum=0'));
        $period = Period::select([
            \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'periods.*'
        ]);

        return DataTables::of($period)
            ->addColumn('rownum', function($period){
                return $period->rownum;
            })
            ->addColumn('action', function($period){
                $action = '';
                $action.= '<a href="'.url('period/'.$period->id.'/edit').'" class="btn btn-secondary btn-xs" title="Edit">';
                $action.=   '<i class="fa fa-edit"></i>';
                $action.= '</a> &nbsp;';
                $action.= '<a href="#" class="btn btn-danger btn-xs btn-delete" data-id="'.$period->id.'" title="Hapus">';
                $action.=   '<i class="fa fa-trash"></i>';
                $action.= '</a>';
                return $action;
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('period.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePeriodRequest $request)
    {

        
        $period = new Period;
        $period->name = $request->name;
        $period->start_date = Carbon::parse($request->start_date)->format('Y-m-d');
        $period->end_date = Carbon::parse($request->end_date)->format('Y-m-d');
        $period->save();
        
        return redirect('period')
            ->with('successMessage', "Period has been saved");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

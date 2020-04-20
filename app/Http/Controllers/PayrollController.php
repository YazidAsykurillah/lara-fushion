<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;
use Carbon\Carbon;

use App\Payroll;
use App\Period;
use App\User;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('payroll.index');
    }

    //return datatables object
    public function datatables(Request $request)
    {
        \DB::statement(\DB::raw('set @rownum=0'));
        $payroll = Payroll::with(['user', 'period'])->select([
            \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'payrolls.*'
        ]);

        return DataTables::of($payroll)
            ->addColumn('rownum', function($payroll){
                return $payroll->rownum;
            })
            ->editColumn('gross_salary', function($payroll){
                return rupiah_format($payroll->gross_salary);
            })
            ->editColumn('total_addition', function($payroll){
                return rupiah_format($payroll->total_addition);
            })
            ->editColumn('total_deduction', function($payroll){
                return rupiah_format($payroll->total_deduction);
            })
            ->editColumn('net_pay', function($payroll){
                return rupiah_format($payroll->net_pay);
            })
            ->addColumn('action', function($payroll){
                $action = '';
                $action.= '<a href="'.url('payroll/'.$payroll->id.'').'" class="btn btn-primary btn-xs" title="Detail">';
                $action.=   '<i class="fa fa-link"></i>';
                $action.= '</a> &nbsp;';
                $action.= '<a href="'.url('payroll/'.$payroll->id.'/edit').'" class="btn btn-secondary btn-xs" title="Edit">';
                $action.=   '<i class="fa fa-edit"></i>';
                $action.= '</a> &nbsp;';
                $action.= '<a href="#" class="btn btn-danger btn-xs btn-delete" data-id="'.$payroll->id.'" title="Delete">';
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
        return view('payroll.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payroll = Payroll::findOrFail($id);
        return view('payroll.show')
            ->with('payroll', $payroll);
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

    public function select2Period(Request $request)
    {
        $data = [];
        if($request->has('q')){
            $search = $request->q;
            $data = Period::where('name', 'LIKE', "%$search%")
                    ->get();
        }
        else{
            $data = Period::get();
        }
        return response()->json($data);
    }

    public function select2User(Request $request)
    {
        $period = Period::findOrFail($request->period_id);

        //initiate user who has payroll in the period
        $payrolled_user_ids =[];

        //Payrolls on period
        $payrolls = Payroll::select('user_id')->where('period_id', '=', $period->id)->get();
        if($payrolls->count()){
            foreach($payrolls as $payroll){
                $payrolled_user_ids[] = $payroll->user_id;
            }
        }

        $data = [];
        if($request->has('q')){
            $search = $request->q;
            $data = User::with('rate')
                    ->whereNotIn('id', $payrolled_user_ids)
                    ->where('name', 'LIKE', "%$search%")
                    ->get();
        }
        else{
            $data = User::with('rate')
                ->whereNotIn('id', $payrolled_user_ids)
                ->get();
        }
        return response()->json($data);
    }
}

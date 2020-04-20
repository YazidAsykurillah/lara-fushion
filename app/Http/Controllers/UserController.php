<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

use App\User;
use App\Rate;
use App\Role;

use Event;
use App\Events\UserIsDeleted;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.index');
    }

    //return datatables object
    public function datatables(Request $request)
    {
        \DB::statement(\DB::raw('set @rownum=0'));
        $user = User::with(['roles'])->select([
            \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'users.*'
        ]);

        return DataTables::of($user)
            ->addColumn('rownum', function($user){
                return $user->rownum;
            })
            ->addColumn('roles', function (User $user) {
                return $user->roles->map(function($role) {
                    return str_limit($role->name, 30, '...');
                })->implode('<br>');
            })
            ->addColumn('action', function($user){
                $action = '';
                $action.= '<a href="'.url('user/'.$user->id.'/edit').'" class="btn btn-secondary btn-xs" title="Edit">';
                $action.=   '<i class="fa fa-edit"></i>';
                $action.= '</a> &nbsp;';
                $action.= '<a href="#" class="btn btn-danger btn-xs btn-delete" data-id="'.$user->id.'" title="Hapus">';
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
        $roles = Role::all();
        return view('user.create')
            ->with('roles', $roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = \Hash::make('12345');
        $user->date_of_birth = Carbon::parse($request->date_of_birth)->format('Y-m-d');
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
        $user->save();

        //attach the role
        $user->roles()->attach($request->role_id);

        //Save Rate
        $rate = new Rate;
        $rate->user_id = $user->id;
        $rate->daily_rate = $request->has('daily_rate') ? preg_replace('#[^0-9]#', '', $request->daily_rate) : 0;
        $rate->monthly_rate =$request->has('monthly_rate') ? preg_replace('#[^0-9]#', '', $request->monthly_rate) : 0;
        $rate->save();
        return redirect('user/'.$user->id)
            ->with('successMessage', 'User has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('user.show')
            ->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        //return $user->roles->contains('name','Administrator');
        $roles = Role::all();
        return view('user.edit')
            ->with('roles', $roles)
            ->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->date_of_birth = Carbon::parse($request->date_of_birth)->format('Y-m-d');
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
        $user->save();

        //attach & detach the role
        $user->roles()->detach();
        $user->roles()->attach($request->role_id);


        //Update or create Rate
        $rate = Rate::updateOrCreate(
            ['user_id'=>$user->id],
            [
                'daily_rate'=>preg_replace('#[^0-9]#', '', $request->daily_rate),
                'monthly_rate'=>preg_replace('#[^0-9]#', '', $request->monthly_rate),
            ]
        );

        return redirect('user/'.$id)
            ->with('successMessage', 'User has been updated');
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

    public function delete(Request $request)
    {
        $response = [];

        $user = User::findOrFail($request->id);
        if($user->delete()){
            Event::fire(new UserIsDeleted($user));

            $response['status'] = TRUE;
            $response['message'] = "User has been deleted";
            $response['data'] = NULL;
        }



        
        return response()->json($response);
    }
}

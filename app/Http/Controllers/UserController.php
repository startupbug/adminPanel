<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $user;

    public function __construct(){
        $this->user = new User();
    }

    public function index()
    {   
        $data['users'] = $this->user->getAllUsers();
        return view('admin.user.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $data['roles'] = Role::all();   
        return view('admin.user.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       try{
            //Creating new User
            $user = $this->user;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));

            if($user->save()){
                //Assigning Role to User
                $role = Role::find($request->input('user_role'));
                $user->roles()->attach($role);

                $this->set_session('User Successfully Added.', true);
            }else{
                $this->set_session('User couldnot be added.', false);
            }

            return redirect()->route('users.create');

        }catch(\Exception $e){
            $this->set_session('User Couldnot be Added.'.$e->getMessage(), false);
            return redirect()->route('users.create'); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['user'] = $this->user->getSingleUserDetail($id);
        return view('admin.user.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['roles'] = Role::all();
        $data['user'] = $this->user->getSingleUsers($id);
        return view('admin.user.edit')->with($data);
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
       try{
            //Creating new User
            $user = $this->user::find($id);
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));

            if($user->save()){
                //Assigning Role to User
                $role = \DB::table('role_user')->where('user_id',$id)->update(['role_id'=>$request->input('user_role')]);
                //$user->roles()->attach($role);

                $this->set_session('User Successfully Edited.', true);
            }else{
                $this->set_session('User couldnot be edited.', false);
            }

            return redirect()->route('users.edit', ['id'=> $id]);

        }catch(\Exception $e){
            $this->set_session('User Couldnot be Edited.'.$e->getMessage(), false);
            return redirect()->route('users.edit', ['id'=> $id]); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       //Deleting User
       try{
            $user = $this->user::find($id);
            $user = $user->delete();
            
            if($user){
                $this->set_session('User Deleted.', true);
            }else{
                $this->set_session('User Couldnot be Deleted.', false);
            }

            return redirect()->route('users.index');

        }catch(\Exception $e){
            $this->set_session('User Couldnot be Deleted.'.$e->getMessage(), false);
            return redirect()->route('users.index'); 
        }
    }
}

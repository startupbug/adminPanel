<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;
use DB;

class PermissionController extends Controller
{

    protected $permission;

    public function __construct(){
        $this->permission = new Permission();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['permissions'] = $this->permission->getAllPermissions();
        return view('admin.permission.index')->with($data); 
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permission.create');
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
            //Creating new Permission
            $permission = $this->permission;
            $permission->name = $request->input('name');
            $permission->display_name = $request->input('display_name');
            $permission->description = $request->input('description');

            if($permission->save()){

                $this->set_session('Permission Successfully Added.', true);
            }else{
                $this->set_session('Permission couldnot be added.', false);
            }

            return redirect()->route('roles.create');

        }catch(\Exception $e){
            $this->set_session('Permission Couldnot be Added.'.$e->getMessage(), false);
            return redirect()->route('roles.create'); 
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
        $data['permission'] = $this->permission->getSinglePermission($id);
        return view('admin.permission.edit')->with($data);
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
            $permission = $this->permission::find($id);
            $permission->name = $request->input('name');
            $permission->display_name = $request->input('display_name');
            $permission->description = $request->input('description');

            if($permission->save()){
                $this->set_session('Permission Successfully Edited.', true);
            }else{
                $this->set_session('Permission couldnot be edited.', false);
            }

            return redirect()->route('permissions.edit', ['id'=> $id]);

        }catch(\Exception $e){
            $this->set_session('Permission Couldnot be Edited.'.$e->getMessage(), false);
            return redirect()->route('permissions.edit', ['id'=> $id]); 
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
        //deleting Permissions
       try{
            //deleting permission role assignment 
            $permission_role_delete = DB::table('permission_role')->where('permission_id', $id);

            //deleting permission itself
            $permission_delete = Permission::find($id);

            $permission_delete = $permission_delete->delete();
            $permission_role_delete = $permission_role_delete->delete(); 

            if($permission_delete){
                $this->set_session('Permission Deleted.', true);
            }else{
                $this->set_session('Permission Couldnot be Deleted.', false);
            }

            return redirect()->route('permissions.index');

        }catch(\Exception $e){
            $this->set_session('Permission Couldnot be Deleted.'.$e->getMessage(), false);
            return redirect()->route('permissions.index'); 
        }
    }

    //Assigning user Permission
    public function assign_permission(){
        return view('admin.permission.assignment');
    }
}

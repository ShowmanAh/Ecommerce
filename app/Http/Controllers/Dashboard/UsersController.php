<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');//check authentication
        // chech permission for user
        $this->middleware(['permission:read_users'])->only('index');
        $this->middleware(['permission:create_users'])->only('create');
        $this->middleware(['permission:update_users'])->only('update');
        $this->middleware(['permission:delete_users'])->only('destroy');
    }
    public function index(Request $request)
    {
       // $user = User::whereRoleIs('admin')->get();

        $users = User::when($request->search, function($query) use($request){
            return $query->where('name', 'like', '%' . $request->search . '%')
            ->orWhere('email', 'like', '%' . $request->search . '%');
        })->latest()->paginate(2);

       // dd($users);
        return view('dashboard.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('dashboard.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|unique:users',
            'password'=> 'required',
            'image' => 'required',
            'permissions'=> 'required'

         ]);
        // dd($request);
        $request_data = $request->except(['password', 'password_confirmation', 'permissions', 'image']);
        $request_data['password'] = bcrypt($request->password);
       if ($request->image) {
           Image::make($request->image)->resize(300, null, function($constraint){
               $constraint->aspectRatio();
           })->save(public_path('uploads/user_images/' . $request->image->hashName(), 60));

       }
       $request_data['image'] = $request->image->hashName();
        $user = User::create($request_data);
        $user->attachRole('admin');
        $user->syncPermissions($request->permissions);
       //dd($user);
       session()->flash('success', __('User Added Successfully'));

       return redirect()->route('users.index');
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
       $user = User::find($id);
       return view('dashboard.users.edit', compact('user'));
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
       $user = User::find($id);
       $request->validate([
        'name'=>'required',
        'email'=>'required',
        'email' => ['required', Rule::unique('users')->ignore($user->id)],
        'password'=> 'required',
        'image'=> 'required',
        'permissions'=> 'required|min:1'

     ]);
     $request_data = $request->except(['password', 'password_confirmation', 'permissions', 'image']);
     $request_data['password'] = bcrypt('password');
     if ($request->image) {
        if($user->image != 'default.jpg')
        {
              Storage::disk('public_uploads')->delete('/user_images/' . $user->image);
        }
        Image::make($request->image)->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();// keep relation between width and height
            //hashname get image name and make encrypt for name return unique name
        })->save(public_path('uploads/user_images/' . $request->image->hashName()));
        $request_data['image'] = $request->image->hashName();
     }
       $user->update($request_data);
       $user->syncPermissions($request->permissions);
       session()->flash('success', __('User Edited Successfully'));
       return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $user = User::find($id);
      if($user->image != 'default.jpg')
      {
            Storage::disk('public_uploads')->delete('/user_images/' . $user->image);
      }
      $user->delete();
      session()->flash('success', __('User Deleted Successfully'));

      return redirect()->route('users.index');
    }

}

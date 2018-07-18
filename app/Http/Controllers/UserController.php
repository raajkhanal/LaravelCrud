<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function addUser(Request $request)
    {
        if ($request->isMethod('get')) {
            return redirect()->route('index');
        }
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'name' => 'required|min:3',
                'email' => 'required|unique:users,email',
                'password' => 'required|min:4',
                'description' => 'required',
                'image' => 'mimes:jpg,png,jpeg',
            ]);
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['password'] = $request->password;
            $data['description'] = $request->description;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $ext = $image->getClientOriginalExtension();
                $imagename = md5(microtime()) . '.' . $ext;
                if (!file_exists('images')) {
                    mkdir('images');
                }
                $uploadpath = public_path('images/');
                if ($image->move($uploadpath, $imagename)) {
                    $data['image'] = $imagename;
                }
                if (User::create($data)) {
                    return redirect()->route('index')->with('success', 'user was inserted');
                } else {
                    return redirect()->back();
                }
            }
        }
    }

    public function viewUser()
    {
        $userdata = User::orderBy('id', 'desc')->paginate(5);
        $data['usersdata'] = $userdata;
        return view('viewUser', $data);
    }

    public function deleteWithImage($id)
    {
        $userid = $id;
        $findUser = User::find($userid);
        $UserImage = $findUser->image;
        $ImagePath = public_path('images/' . $UserImage);
        if (file_exists($ImagePath) && is_file($ImagePath)) {
            return unlink($ImagePath);
        }
        return true;
    }

    public function deleteUser(Request $request)
    {
        $userid = $request->id;
        $findUser = User::find($userid);
        if ($this->deleteWithImage($userid) && $findUser::where('id', $userid)->delete()) {
            return redirect()->route('viewUser')->with('success', 'user was deleted');
        }

    }

    public function editUser(Request $request)
    {
        $userid = $request->id;
        $findUser = User::find($userid);
        $data['usersdata'] = $findUser;
        return view('edit', $data);
    }

    public function editUserAction(Request $request)
    {
        $userid = $request->id;
        $usersdata = User::find($userid);
        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|', [
                Rule::unique('users', 'email')->ignore($userid),
            ],
            'description' => 'required',
            'image' => 'mimes:jpg,png,jpeg',
        ]);
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['description'] = $request->description;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $imagename = md5(microtime()) . '.' . $ext;
            $uploadpath = public_path('images/');
            if ( $this->deleteWithImage($userid) && $image->move($uploadpath, $imagename)) {
                $data['image'] = $imagename;
            }
        }
        if($usersdata::where('id', $userid)->update($data)) {
            return redirect()->route('index')->with('success', 'user was updated');
        } else {
            return redirect()->back();
        }
    }
}

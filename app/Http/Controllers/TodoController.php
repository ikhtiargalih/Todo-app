<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\carbon;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('dashboard.login'); 
    }
    public function logout()
    {
            Auth::logout();
            return redirect('/')->with('SuccessLogout', 'anda sudah berhasil logout');
    }
    public function auth(Request $request){
        $request->validate([
        'username' => 'required|exists:users,username',
        'password' => 'required'
        ]);
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            // $request->session()->regenerate();
            return redirect('/todo')->with('Yeay', 'anda sudah berhasil login');
        }
        return back()->withErrors([
            'password' => 'Username atau Password Salah',
        ]);

    }
    public function inputRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|min:4|max:50',
            'username' => 'required|min:4|max:8',
            'email' => 'required',
            'password' => 'required',
        ]);
        User::create([
            'name' => $request->name,
            'username' => 
            $request->username,
            'email' => 
            $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect('/')->with('SuccessRegister', 'berhasil membuat akun');
    }
    public function index()
    {
        //menampilkan halaman awal, smua data
        // cari data todo yang punya user_id sama dengan id orang yang login. kalau ketemu datanya diambil
        $todos = Todo::where([
            ['user_id','=', Auth::user()->id],
            ['status', '=', 0],
        ])->get();
        //tampilkan file index di folder dashboard dan bawa data dari variable yang namanya todos ke file tersebut   
        
        return view('dashboard.index', compact('todos'));
    }
    public function complated()
    {
        $todos = Todo::where([
            ['user_id','=', Auth::user()->id],
            ['status', '=', 1],
        ])->get();

        return view('dashboard.complated', compact('todos'));

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateComplated($id)
    {
        //$id pada parameter mengambil data dari path dinamis {id}
        //cari data yang memiliki value column id sama dengan data id yang dikirim ke route, maka update baris data tersebut
        Todo::where('id', $id)->update([
            'status' => 1,
            'done_time' => Carbon::now(),
        ]);
        //kalua berhasil bakal diarahin ke halaman list todo yang complated dengan pemberitahuan
        return redirect()->route('todo.complated')->with('done', 'Todo sudah selesai dikerjakan!');
        
    }

    public function create()
    {
        return view('dashboard.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //mengirim data ke database (data baru) / menambahkan data baru ke db
        $request->validate([
            'title' => 'required|min:3',
            'date' => 'required',
            'description' => 'required|min:8',  
        ]);
        //tambah data ke DB
        Todo::create([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'status' => 0,
            'user_id' => Auth::user()->id,
        ]);
        //redirect apabila berhasil bersama dengan alert-nya
        return redirect()->route('todo.index')->with('successAdd','berhasil menambahkan data ke Todo!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //menampilkan satu data 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //menampilkan form edit data 
        //ambil data dari db yang id nya sama dengan id yang dikirim di route
        $todo = Todo::where('id',$id)->first();
        //lalu tampilkan halaman dari view 
        return view('dashboard.edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //mengubah data di database
        $request->validate([
            'title' => 'required|min:3',
            'date' => 'required',
            'description' => 'required|min:8', 
        ]);

        Todo::where('id', $id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'status' => 0,
            'user_id' => Auth::user()->id,
        ]);
        //kalau berhasil bakal diarahin ke halaman awal todo dengan pemberitahuan berhasil
        return redirect('/todo/')->with('successUpdate', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //parameter $id akan mengambil data dari path dinamis {id}
        //cari data yang isian column id nya sama dengan $id yang dikirim ke path dinamis
        //kalau ada, ambil terus hapus datanya
        Todo::where('id', '=', $id)->delete();
        //kalau berhasil, bakal dibalikin ke halaman list todo dengan pemberitahuan
        return redirect()->route('todo.index')->with('successDelete', 'Berhasil menghapus data ToDo!');
    }
}

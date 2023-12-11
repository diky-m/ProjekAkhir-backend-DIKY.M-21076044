<?php

namespace App\Http\Controllers;

use App\Models\Modul;
use App\Models\Referensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ModulController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Modul::all();
        return view('modul.index',[
        'data'=> $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modul.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'file'     => 'required|mimes:pdf',
            'judul'     => 'required|min:5',
            'hari'   => 'required',
        ]);

        $image = $request->file('file');
        $image->storeAs('public/modul', $image->hashName());

        //create post
        $modul = Modul::create([
            'file'     => $image->hashName(),
            'judul'     => $request->judul,
            'hari'   => $request->hari
        ]);

        if ($request->referensi){
            Referensi::create([
                'id_modul'=> $modul->id,
                'referensi'=>$request->referensi,
            ]);
        }

        //redirect to index
        return redirect()->route('modul.index')->with(['success' => 'Data Berhasil Disimpan!']);
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

        $data =  Modul::find($id);

        $referensi = Referensi::where('id_modul',$id)->first();
        return view('modul.edit',[
            'data'=>$data,
            'referensi'=> $referensi
        ]);
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
        $this->validate($request, [
            'file'     => 'mimes:pdf',
            'judul'     => 'required|min:5',
            'hari'   => 'required',
        ]);

        $modul = Modul::find($id);
        $referensi = Referensi::where('id_modul',$id)->first();
        $image = $request->file('file');

        if($image){
            $image->storeAs('public/modul', $image->hashName());
            Storage::delete('public/modul/'.$modul->file);

            //create post
            $modul->update([
                'file'     => $image->hashName(),
                'judul'     => $request->judul,
                'hari'   => $request->hari
            ]);
    
            if ($referensi){
                $referensi->update([
                    'referensi'=>$request->referensi,
                ]);
            }else {
                if ($request->referensi){
                    Referensi::create([
                        'id_modul'=> $modul->id,
                        'referensi'=>$request->referensi,
                    ]);
                }
            }
           
        }else{
             //create post
             $modul->update([
                'judul'     => $request->judul,
                'hari'   => $request->hari
            ]);
            
            if ($referensi){
                $referensi->update([
                    'referensi'=>$request->referensi,
                ]);
            }else {
                if ($request->referensi){
                    Referensi::create([
                        'id_modul'=> $modul->id,
                        'referensi'=>$request->referensi,
                    ]);
                }
            }    
            
        }
      
        //redirect to index
        return redirect()->route('modul.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $modul = Modul::find($id);
        Storage::delete('public/modul/'.$modul->file);
        $referensi = Referensi::where('id_modul',$id)->first();
        $modul->delete();
        $referensi->delete();
          //redirect to index
          return redirect()->route('modul.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
}

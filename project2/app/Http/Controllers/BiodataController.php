<?php

namespace App\Http\Controllers;
use App\Models\Biodata;
use App\Models\Prov;
use App\Models\Kabkota;
use App\Models\Kec;

use Illuminate\Http\Request;

class BiodataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prov = Prov::all();
        $biodatas = Biodata::all();
        return view('biodata.index', compact('biodatas', 'prov'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prov = Prov::all();
        return view('biodata.create', compact('prov'));
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
            'nama_lengkap' => 'required|max:40',
            'prov_id' => 'required',
            'kabkota_id' => 'required',
            'kec_id' => 'required',
            'avatar' => 'mimes:jpeg,png,jpg'
        ]);

        $imgname = $request->avatar->getClientOriginalName() . '-' . time() . '.' . $request->avatar->extension();
        $request->avatar->move(public_path('image'), $imgname);

        $biodata = Biodata::create([
            'nama_lengkap' => $request->nama_lengkap,
            'prov_id' => $request->prov_id,
            'kabkota_id' => $request->kabkota_id,
            'kec_id' => $request->kec_id,
            'avatar' => $imgname
        ]);
        return redirect('/biodata');
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
        $biodata = Biodata::find($id);
        $prov = Prov::all();
        return view('biodata.edit', compact('biodata','prov'));
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
        $request->validate([
            'nama_lengkap' => 'required|max:40',
            'prov_id' => 'required',
            'kabkota_id' => 'required',
            'kec_id' => 'required',
            'avatar' => 'mimes:jpeg,png,jpg'
        ]);
        $biodata = Biodata::find($id);
        $imgname = $request->avatar->getClientOriginalName() . '-' . time() . '.' . $request->avatar->extension();
        $request->avatar->move(public_path('image'), $imgname);
        $biodata->update([
            'nama_lengkap' => $request->nama_lengkap,
            'prov_id' => $request->prov_id,
            'kabkota_id' => $request->kabkota_id,
            'kec_id' => $request->kec_id,
            'avatar' => $imgname
        ]);
        return redirect('/biodata');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $biodata = Biodata::find($id);
        $biodata->delete();
        return redirect('/biodata');
    }

    public function findkabkotaname(Request $request)
    {
        $data = Kabkota::select('nama_kabkota','id')->where('prov_id',$request->id)->take(100)->get();
        return response()->json($data);
    }

    public function findkecname(Request $request)
    {
        $data = Kec::select('nama_kec','id')->where('kabkota_id',$request->id)->take(100)->get();
        return response()->json($data);
    }
}

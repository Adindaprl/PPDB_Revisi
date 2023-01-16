<?php

namespace App\Http\Controllers;
use App\Models\Payment;
use App\Models\Ppdb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PaymentController extends Controller
{

    public function dashboard()
    {
        $user= Auth::user();
        return view('finance.dashboard', compact('user'));
    }
    
    public function createPayment()
    {
        $bayar= Payment::where('ppdb_id', Auth::user()->ppdb_id)->first();
        return view('finance.pembayaran', compact('bayar'));
    } 

    public function admindash()
    {
        return view('admin.admindash');
    }

    public function verifikasi(){
        $payment = Payment::all();
        return view('admin.verifikasi', compact('payment'));
    }

    public function bukti($id){
        $payment = Payment::find($id);
        return view('admin.bukti', compact('payment'));
    }

    public function detail($id){
        $ppdb = Ppdb::find($id);
        return view('admin.detail', compact('ppdb'));
    }

    public function rejected($id){
        Payment::where('id', '=', $id)->update([
            'status' => 'Ditolak',
        ]);
        Ppdb::where('ppdb_id', '=', $id)->update([
            'status' => 'Ditolak',
        ]);
        return redirect()->back();
    }

    public function accepted($id){
        Payment::where('id', '=', $id)->update([
            'status' => 'Diterima',
        ]);
        Ppdb::where('ppdb_id', '=', $id)->update([
            'status' => 'Diterima'
        ]);
        return redirect();
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nm_bank' => 'required',
            'nm_rek' => 'required',
            'nominal' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg,gif,svg',
        ]);

        $image = $request->file('image');
        $imgName = time().rand().'.'.$image->extension();

        if(!file_exists(public_path('/assets/img/bukti/'.$image->getClientOriginalName()))){
            //set untuk menyimpan file nya
            $dPath = public_path('/assets/img/bukti/');
            //memindahkan file yang diupload ke directory yang telah ditentukan
            $image->move($dPath, $imgName);
            $uploaded = $imgName;
        }else{
            $uploaded = $image->getClientOriginalName();
        }
        Payment::create([
            'nm_bank' => $request->nm_bank,
            'nm_rek' => $request->nm_rek,
            'nominal' => $request->nominal,
            'image' => $uploaded,
            'status' => 'Diproses',
            'ppdb_id' => Auth::user()->ppdb_id,
         ]);
         return redirect()->route('createPayment');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'nm_bank' => 'required',
            'nm_rek' => 'required',
            'nominal' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg,gif,svg',
        ]);

        $image = $request->file('image');
        $imgName = time().rand().'.'.$image->extension();

        if(!file_exists(public_path('/assets/img/bukti/'.$image->getClientOriginalName()))){
            //set untuk menyimpan file nya
            $dPath = public_path('/assets/img/bukti/');
            //memindahkan file yang diupload ke directory yang telah ditentukan
            $image->move($dPath, $imgName);
            $uploaded = $imgName;
        }else{
            $uploaded = $image->getClientOriginalName();
        }
        Payment::create([
            'nm_bank' => $request->nm_bank,
            'nm_rek' => $request->nm_rek,
            'nominal' => $request->nominal,
            'image' => $uploaded,
            'status' => 'Ditolak',
            'ppdb_id' => Auth::user()->ppdb_id,
         ]);
         return redirect()->route('updatePayment');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(payment $payment)
    {
        //
    }
}

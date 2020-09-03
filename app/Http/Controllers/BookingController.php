<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $booking = (array) $request->session()->get('booking'); /* Array */
        foreach($booking as $k => $v) {
            $v['date'] = date('M d Y', strtotime($v['date']));
            $v['time'] = date('g:i A', strtotime($v['time']));
            $bookingData[$k] = $v;
         }
        return response()->json($bookingData);
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

    public function messages()
    {
        return [
            'name.required' => 'A name is required',
        ];
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'date' => 'required',
            'time' => 'required',
            'message' => 'required',
        ]);

        $storeData = $request->all();

        /* Use session for now, due to time - demo only */
        $booking = (array) $request->session()->get('booking'); /* Array */
        $booking[] = $storeData;
        $request->session()->put('booking', $booking);
        return response()->json($booking);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
}

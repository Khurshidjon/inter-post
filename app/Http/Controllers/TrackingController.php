<?php

namespace App\Http\Controllers;

use App\Classes\Tracking;

use Illuminate\Http\Request;


class TrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $track = new Tracking();
        $track = $track->getCarrierList();
        return $track;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        return view('get_track');
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
    public function show_track()
    {
        return view('get_track');
    }
    public function detectCarrier(Request $request)
    {
        $request->validate([
            'number' => 'required|string|max:20'
        ]);

        /*Bitta track haqida*/
//        $track = new Tracking();
//        $track = $track->getSingleTrackingResult('china-post', $request->input("number"),'en');
//        return response()->json($track);

                $track = new Tracking();
                $trackingNumber = $request->input('number');
                $track = $track->detectCarrier($trackingNumber);
                return response()->json($track);

        /*Bir nechta track haqida*/

//        $track = new Tracking();
//        $numbers =  $request->input('number');
//        $orders = '#123';
//        $page = 1;
//        $limit = 50;
//        $createdAtMin = time() - 7*24*60*60;
//        $createdAtMax = time();
//        $update_time_min = time() - 7*24*60*60;
//        $update_time_max = time();
//        $order_created_time_min = time() - 7*24*60*60;
//        $order_created_time_max = time();
//        $lang = 'en';
//        $track = $track->getTrackingsList($numbers,$orders,$page,$limit,$createdAtMin,$createdAtMax,$update_time_min,$update_time_max,$order_created_time_min,$order_created_time_max,$lang);
//        return response()->json($track);

    }
}

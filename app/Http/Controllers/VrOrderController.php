<?php namespace App\Http\Controllers;

use App\Models\VrOrder;
use App\Models\VrPages;
use App\Models\VrReservations;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Routing\Controller;

class VrOrderController extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /vrorder
	 *
	 * @return Response
	 */
	public function index()
	{

//        $dataFromModel = new VrOrder;
//        $config = $this->listBladeData();
//        $config['tableName'] = $dataFromModel->getTableName();
//        $config['list'] = $dataFromModel->with(['experiences'])->get()->toArray();
//
//		return view('admin.listView', $config);

        $carbonForm = Carbon::createFromDate(2000, 04, 11, 'Europe/Vilnius');
        echo $carbonForm;

        $dates = [];

        for($date = Carbon::now('Europe/Vilnius')->addHours(2)->minute(10)->second(0); $date->lte(Carbon::createFromTime(22, 00, 00, 'Europe/Vilnius')); $date->addMinutes(10)) {
            $dates[] = $date->format('Y/m/d H:i:s');
        }

        dd($dates);
	}


	/**
	 * Show the form for creating a new resource.
	 * GET /vrorder/create
	 *
	 * @return Response
	 */
	public function create()
	{

		$config = [];

//        $dates = [];
//        for($date = Carbon::now('Europe/Vilnius')->addHours(2)->minute(10)->second(0); $date->lte(Carbon::createFromDate(22, 00, 00, 'Europe/Vilnius')); $date->addMinutes(10)) {
//            $time[] = $date->format('Y/m/d');
//        }
//        $config['time'] = $dates;

        $array = VrReservations::select('time', 'experience_id')->get()->toArray();
        $time = [];
        for($date = Carbon::now('Europe/Vilnius')->addHours(2)->minute(10)->second(0);
            $date->lte(Carbon::createFromTime(22, 00, 00, 'Europe/Vilnius'));
            $date->addMinutes(10)) {
                $time[] = $date->format('Y/m/d H:i:s');
            }

        $config['time'] = $time;
		$config['rooms'] = VrPages::with(['translation'])->where('category_id', '=', 'virtual-rooms')->pluck('id', 'id');
		return view ('frontEnd.createOrder', $config);

	}

	/**
	 * Store a newly created resource in storage.
	 * POST /vrorder
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = request()->all();

		$experience = [];
		foreach($data['room'] as $key => $room){
		    $key = [];
		    foreach($data[$room.'time'] as $time) {
		        array_push($key, $time);
            }
		    $experience[$room] = $key;
        }

        if(sizeOf($experience) > 0) {
            $record = VrOrder::create([
                'status' => 1,
            ]);

            $reservationTable = new VrReservationsController();
            $reservationTable->storeFromOrder($experience, $record);
        }

    }

	/**
	 * Display the specified resource.
	 * GET /vrorder/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /vrorder/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /vrorder/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /vrorder/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    private function listBladeData()
    {
        $config = [];
        $config['show'] = 'app.orders.show';
        $config['create'] = 'app.orders.create';
        $config['delete'] = 'app.orders.destroy';
        $config['edit'] = 'app.orders.edit';
        return $config;
    }
}
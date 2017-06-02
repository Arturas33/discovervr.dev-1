<?php namespace App\Http\Controllers;

use App\Models\VrOrder;
use App\Models\VrPages;
use App\Models\VrReservations;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;

class VrOrderController extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /vrorder
	 *
	 * @return Response
	 */
	public function index()
	{
        $dataFromModel = new VrOrder();
        $config = $this->listBladeData();
        $config['tableName'] = $dataFromModel->getTableName();
        $config['list'] = $dataFromModel->with(['experiences'])->get()->toArray();
        $config['ignore'] = ['experience_id', 'order_id'];
        return view('admin.listView', $config);
	    //return VrOrder::with(['user', 'experiences'])->get()->toArray();
        dd($config);
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

        $time = [];
        for($hours = Carbon::createFromTime(11, 00, 00, 'Europe/Vilnius')->addHours(0)->minute(10)->second(0);
            $hours->lte(Carbon::createFromTime(12, 00, 00, 'Europe/Vilnius'));
            $hours->addMinutes(10)) {
                $time[] = $hours->format('H:i');
        }

        $date = [];
        for($days = Carbon::createFromDate();
            $days->lte(Carbon::createFromDate()->addDays(14));
            $days->addDay()) {
                $date[] = $days->format('Y-m-d');
        }

        // may not be useful, returns array of dates as keys and hours arrays as values assoc with keys
        $dateTimeArray = [];
        foreach ($date as $key => $day) {
            $key = [];
            foreach($time as $hour) {
                array_push($key, $hour);
            }
            $dateTimeArray[$day] = $key;
        }

        $config['dateTimeArray'] = $dateTimeArray;
        $config['date'] = array_combine($date, $date);
        $config['time'] = $time;
		$config['rooms'] = VrPages::with(['translation'])->where('category_id', '=', 'virtual-rooms')->pluck('id', 'id');
		$reservations = VrReservations::select('experience_id', 'time')->get()->toArray();

		$newArr = [];
        foreach ($reservations as $key => $reservation) {
            if(!in_array($reservation['experience_id'], $newArr)) {
                array_push($newArr, $reservation['experience_id']);
                }
            }
        $newArrKeys = array_flip($newArr);

        foreach ($newArrKeys as $key1 => $item) {
            $item = [];
            foreach ($reservations as $key2 => $reservation) {
                if($key1 == $reservation['experience_id']) {
                    array_push($item, $reservation['time']);
                }
            }
            $newArrKeys[$key1] = $item;
        }

        $config['checkRoomTimes'] = $newArrKeys;


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
        $dataFromModel = new VrOrder();
        $config = $this->listBladeData();
        $config['tableName'] = $dataFromModel->getTableName();
        $config['list'] = $dataFromModel->with(['experiences'])->find($id)->toArray();
        $config['ignore'] = ['experience_id', 'order_id'];
        return view('admin.orders.ordersSingle', $config);
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
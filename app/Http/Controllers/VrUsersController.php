<?php namespace App\Http\Controllers;

use App\Models\VrUsers;
use Illuminate\Routing\Controller;
use Ramsey\Uuid\Uuid;

class VrUsersController extends Controller
{

    /**
     * Display a listing of the resource.
     * GET /vrusers
     *
     * @return Response
     */
    public function index()
    {
        $dataFromModel = new VrUsers();
        $config = $this->listBladeData();
        $config['tableName'] = $dataFromModel->getTableName();
        $config['list'] = VrUsers::with(['orders'])->get()->toArray();
//        if($config['list'] == null)
//        {
//            return redirect()->route('app.users.', $config);
//        }
        return view('admin.listView', $config);
    }

    /**
     * Show the form for creating a new resource.
     * GET /vrusers/create
     *
     * @return Response
     */
    public function create()
    {
        $config['users'] = VrUsers::get()->toArray();
        $config['route'] = 'app.users.create';
        return view('admin.userEdit', $config);
    }

    /**
     * Store a newly created resource in storage.
     * POST /vrusers
     *
     * @return Response
     */
    public function store()
    {
        $data = request()->all();
        VrUsers::create([
            'id' => Uuid::uuid4(),
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'phone' => $data['phone'],
        ]);

        return view('admin.userEdit');
    }

    /**
     * Display the specified resource.
     * GET /vrusers/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * GET /vrusers/{id}/edit
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $config = [];
        $config['route'] = 'app.users.edit';
        $config['id'] = $id;


    }

    /**
     * Update the specified resource in storage.
     * PUT /vrusers/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /vrusers/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
    private function listBladeData()
    {
        $config = [];
        $config['show'] = 'app.users.show';
        $config['create'] = 'app.users.create';
        $config['delete'] = 'app.users.destroy';
        $config['edit'] = 'app.users.edit';
        return $config;
    }

}
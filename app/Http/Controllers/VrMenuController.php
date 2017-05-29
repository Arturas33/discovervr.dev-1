<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\VrMenu;
use Session;


class VrMenuController extends Controller
{

    /**
     * Display a listing of the resource.
     * GET /vrmenu
     *
     * @return Response
     */
    public function index()
    {
        $dataFromModel = new VrMenu;
        $config = $this->listBladeData();
        $config['tableName'] = $dataFromModel->getTableName();
		$config['list'] = VrMenu::orderBy('sequence', 'asc')->get()->toArray();
		return view('admin.listView', $config);
    }

    /**
     * Show the form for creating a new resource.
     * GET /vrmenu/create
     *
     * @return Response
     */
    public function create()
    {
        $config['menu'] = VrMenu::get()->toArray();
        $config['route'] = 'app.menu.create';
        $config['listParentIdNull'] = VrMenu::where('vr_parent_id', '=', null)->pluck('name','id')->toArray();
    dd($config);
        return view('admin.menu.create', $config);
    }

    /**
     * Store a newly created resource in storage.
     * POST /vrmenu
     *
     * @return Response
     */


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:vr_menu',
            'url' => 'required|string|max:255|unique:vr_menu',
            'sequence' => 'required|digits:1',
        ]);

        $config['menu'] = VrMenu::all();
        $data = request()->all();

        VrMenu::create(array(
            'name' => $data['name'],
            'url' => $data['url'],
            'sequence' => $data['sequence'],
            'vr_parent_id' => $data['listParent']

        ));

        Session::flash('success', 'Was successfully save!');

        return redirect()->route('app.menu.index', $config);

    }

    /**
     * Display the specified resource.
     * GET /vrmenu/{id}
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
     * GET /vrmenu/{id}/edit
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $config['route'] = route('app.menu.edit', $id);
        $config['listParentIdNull'] = VrMenu::where('vr_parent_id', '=', null)->pluck('name','id')->toArray();
        $config['menu'] = VrMenu::find($id)->toArray();

        return view('admin.menu.edit', $config);
    }

    /**
     * Update the specified resource in storage.
     * PUT /vrmenu/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $config = VrMenu::find($id);

        $this->validate($request, [
            'name' => 'required|string|max:255|unique:vr_menu',
            'url' => 'required|string|max:255|unique:vr_menu',
            'sequence' => 'required|digits:1|unique:vr_menu',
        ]);

        $data = request()->all();

        $config->update(array(
            'name' => $data['name'],
            'url' => $data['url'],
            'sequence' => $data['sequence'],
            'vr_parent_id' => $data['listParent']
        ));

        Session::flash('success', 'Was successfully save!');

        return redirect()->route('app.menu.index', $config);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /vrmenu/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {

        if (VrMenu::destroy($id)) {
            return ["success" => true, "id" => $id];
        }
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
<?php namespace App\Http\Controllers;

use App\Models\VrCategories;
use Illuminate\Routing\Controller;
use Ramsey\Uuid\Uuid;

class VrCategoriesController extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /vrcategories
	 *
	 * @return Response
	 */
	public function index()
	{

        $dataFromModel = new VrCategories;
        $config = $this->listBladeData();
        $config['tableName'] = $dataFromModel->getTableName();
        $config['list'] = VrCategories::with(['translation'])->get()->toArray();
        $config['ignore'] = ['category_id', 'id'];
        return view('admin.listView', $config);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /vrcategories/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return view ('admin.createCategory');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /vrcategories
	 *
	 * @return Response
	 */
	public function store()
	{
	    $data = request()->all();
        $record = VrCategories::create([
            'id' => Uuid::uuid4(),
        ]);

        $translations = new VrCategoriesTranslationsController();
        $translations->storeFromVrCategoriesController($data, $record);

        return redirect()->route('app.categories.index');
	}

	/**
	 * Display the specified resource.
	 * GET /vrcategories/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $config = [];
        $config['item'] = VrCategories::with(['translation'])->find($id)->toArray();

        return view('admin.categoriesSingle', $config);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /vrcategories/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $config = [];
        $config['route'] = 'app.categories.edit';
        $config['id'] = $id;
        $config['item'] = VrCategories::with(['translation'])->find($id)->toArray();
        return view('admin.categoriesEdit', $config);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /vrcategories/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $data = request()->all();
        $record = VrCategories::find($id);
        $record->update([]);
        $translations = new VrCategoriesTranslationsController();
        $translations->updateFromVrCategoriesController($data, $record);

        return redirect()->route('app.categories.index');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /vrcategories/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        if (VrCategories::destroy($id)){
            return ["success" => true, "id" => $id];
        }
	}

    private function listBladeData()
    {
        $config = [];
        $config['show'] = 'app.categories.show';
        $config['create'] = 'app.categories.create';
        $config['delete'] = 'app.categories.destroy';
        $config['edit'] = 'app.categories.edit';
        return $config;
    }
}
<?php namespace App\Http\Controllers;

use App\Models\VrCategories;
use App\Models\VrCategoriesTranslations;
use App\Models\VrPages;
use Illuminate\Routing\Controller;

class VrPagesController extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /vrpages
	 *
	 * @return Response
	 */
	public function index()
	{
	    return VrPages::with(['pagesTranslation'])->get()->toArray();
//        $dataFromModel = new VrPages;
//        $config = $this->listBladeData();
//        $config['tableName'] = $dataFromModel->getTableName();
//        $config['list'] = $dataFromModel->get()->toArray();
//
//        $config['pages'] = VrPages::get()->toArray();
//
//        return view('admin.pagesList', $config);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /vrpages/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$config['categories'] = VrCategoriesTranslations::where('language_code', '=', 'en')->pluck('name', 'category_id');

		return view ('admin.createPage', $config);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /vrpages
	 *
	 * @return Response
	 */
	public function store()
	{
        $resource = request()->file('image');
        $uploadController = new VrResourcesController();
        $data = request()->all();
        $article = VrPages::create([
            'category_id' => $data['categories'],
            'cover_id' => $uploadController->upload($resource)
        ]);
        $record = new VrPagesTranslationsController();
        $record->storeFromVrPagesController($data, $article);

        return redirect()->route('app.pages.index');
    }

	/**
	 * Display the specified resource.
	 * GET /vrpages/{id}
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
	 * GET /vrpages/{id}/edit
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
	 * PUT /vrpages/{id}
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
	 * DELETE /vrpages/{id}
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
        $config['show'] = 'app.pages.show';
        $config['create'] = 'app.pages.create';
        $config['delete'] = 'app.pages.destroy';
        $config['edit'] = 'app.pages.edit';
        return $config;
    }
}
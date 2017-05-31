<?php namespace App\Http\Controllers;

use App\Models\VrCategoriesTranslations;
use Illuminate\Routing\Controller;

class VrCategoriesTranslationsController extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /vrcategoriestranslations
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /vrcategoriestranslations/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /vrcategoriestranslations
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

    /**
     * Store a newly created resource in storage.
     * POST /vrcategoriestranslations
     *
     * @return Response
     */
    public function storeFromVrCategoriesController($data, $record)
    {
        if(isset($data['name_lt'])) {
            VrCategoriesTranslations::create([
                'category_id' => $record->id,
                'language_code' => 'lt',
                'name' => $data['name_lt']
            ]);
        }

        if(isset($data['name_en'])) {
            VrCategoriesTranslations::create([
                'category_id' => $record->id,
                'language_code' => 'en',
                'name' => $data['name_en']
            ]);
        }

    }

	/**
	 * Display the specified resource.
	 * GET /vrcategoriestranslations/{id}
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
	 * GET /vrcategoriestranslations/{id}/edit
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
	 * PUT /vrcategoriestranslations/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

    public function updateFromVrCategoriesController($data, $record)
    {
        if(isset($data['name_lt'])) {
            VrCategoriesTranslations::where('category_id', '=', $record->id)
                ->where('language_code', '=', 'lt')->update([
                'name' => $data['name_lt']
            ]);
        }

        if(isset($data['name_en'])) {
            VrCategoriesTranslations::where('category_id', '=', $record->id)
                ->where('language_code', '=', 'en')->update([
                'name' => $data['name_en']
            ]);
        }
    }

	/**
	 * Remove the specified resource from storage.
	 * DELETE /vrcategoriestranslations/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(VrPages::destory($id)) {

        }
	}

}
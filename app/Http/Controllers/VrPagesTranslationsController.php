<?php namespace App\Http\Controllers;

use App\Models\VrPagesTranslations;
use Illuminate\Routing\Controller;

class VrPagesTranslationsController extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /vrpagestranslations
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /vrpagestranslations/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /vrpagestranslations
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

    public function storeFromVrPagesController($data, $article)
    {
        if (isset($data['title_en']) && isset($data['slug_en']) && isset($data['description_short_en']) && isset($data['description_long_en'])) {

            VrPagesTranslations::create([
                'page_id' => $article->id,
                'title' => $data['title_en'],
                'language_code' => 'en',
                'slug' => $data['slug_en'],
                'description_short' => $data['description_short_en'],
                'description_long' => $data['description_long_en']
            ]);
        }

        if (isset($data['title_lt']) && isset($data['slug_lt']) && isset($data['description_short_lt']) && isset($data['description_long_lt'])) {
            VrPagesTranslations::create([
                'page_id' => $article->id,
                'title' => $data['title_lt'],
                'language_code' => 'lt',
                'slug' => $data['slug_lt'],
                'description_short' => $data['description_short_lt'],
                'description_long' => $data['description_long_lt']
            ]);
        }
     }

	/**
	 * Display the specified resource.
	 * GET /vrpagestranslations/{id}
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
	 * GET /vrpagestranslations/{id}/edit
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
	 * PUT /vrpagestranslations/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	public function updateFromVrPagesController($data, $id)
    {

        if (isset($data['title_en']) && isset($data['slug_en']) && isset($data['description_short_en']) && isset($data['description_long_en'])) {

            VrPagesTranslations::where('page_id', '=', $id)->where('language_code', '=', 'en')->update([
                'title' => $data['title_en'],
                'language_code' => 'en',
                'slug' => $data['slug_en'],
                'description_short' => $data['description_short_en'],
                'description_long' => $data['description_long_en']
            ]);
        }

        if (isset($data['title_lt']) && isset($data['slug_lt']) && isset($data['description_short_lt']) && isset($data['description_long_lt'])) {
            VrPagesTranslations::where('page_id', '=', $id)->where('language_code', '=', 'lt')->update([
                'title' => $data['title_lt'],
                'language_code' => 'lt',
                'slug' => $data['slug_lt'],
                'description_short' => $data['description_short_lt'],
                'description_long' => $data['description_long_lt']
            ]);
        }
    }
	/**
	 * Remove the specified resource from storage.
	 * DELETE /vrpagestranslations/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
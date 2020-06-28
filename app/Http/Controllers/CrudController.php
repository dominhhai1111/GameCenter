<?php

namespace App\Http\Controllers;

use App\Crud;
use Faker\Generator;
use Illuminate\Http\Request;

class CrudController extends Controller
{
    public function app()
    {
        return view('crud.index');
    }

    public function index()
    {
        return response(Crud::all()->jsonSerialize(), HTTP_OK);
    }

    public function create(Generator $faker)
    {
        $crud = new Crud();
        $crud->name = $faker->lexify('????????');
        $crud->color = $faker->boolean ? 'red' : 'green';
        $crud->save();

        return response($crud->jsonSerialize(), HTTP_CREATE);
    }

    public function update(Request $request, $id)
    {
        $crud = Crud::findOrFail($id);
        $crud->color = $request->color;
        $crud->save();

        return response(null, HTTP_OK);
    }

    public function destroy($id)
    {
        Crud::destroy($id);

        return response(null, HTTP_OK);
    }
}

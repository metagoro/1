<?php

namespace sis_ventas\Http\Controllers;

use Illuminate\Http\Request;

use sis_ventas\Http\Requests;
use sis_ventas\Articulo;
use sis_ventas\categoria;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sis_ventas\Http\Requests\ArticuloFormRequest;
use DB;


class ArticuloController extends Controller
{
  public function __constructor()
	{

	}
	public function index(Request $request)
	{
		if ($request)
		{
			$query=trim($request->get('searchText'));
			$articulos=DB::table('articulo as ar')
			->join('categoria as ca','ar.idcategoria','=','ca.idcategoria')
			->select('ar.idarticulo','ar.nombre','ar.codigo','ar.stock','ca.nombre as categoria','ar.descripcion','ar.imagen','ar.estado')


			->where('ar.nombre','LIKE','%'.$query.'%')
			->orwhere('ar.codigo','LIKE','%'.$query.'%')

			
			->orderBy('idarticulo','desc')
			->paginate(7);

			return view('almacen.articulo.index',["articulos"=>$articulos,"searchText"=>$query]);

		}
	}
	public function create()
	{
		$categorias=DB::table('categoria')->where('condicion','=','1')->get();
		return view("almacen.articulo.create",["categorias"=>$categorias]);

	}
	public function store(ArticuloFormRequest $request)
	{
			$articulo= new Articulo;
			$articulo->idcategoria=$request->get('idcategoria');

			$articulo->codigo=$request->get('codigo');
			$articulo->nombre=$request->get('nombre');
			$articulo->stock=$request->get('stock');
			$articulo->descripcion=$request->get('descripcion');
			$articulo->estado='activo';

			if (Input::hasFile('imagen')){
				$file=Input::file('imagen');
				$file->move(public_path().'/imagenes/articulos/',$file->getClientOriginalName());
				$articulo->imagen=$file->getClientOriginalName();

			}
			$articulo->save();
			return Redirect::to('almacen/articulo');
	}
	public function show($id)
	{
			return view("almacen.articulo.show",["articulo"=>Articulo::findOrFail($id)]);

	}
	public function edit($id)
	{
			$articulo=Articulo::findOrFail($id);
			$categorias=DB::table('categoria')->where('condicion','=','1')->get();

			return view("almacen.articulo.edit",["articulo"=>$articulo,"categorias"=>$categorias]);
	}
	public function update(ArticuloFormRequest $request, $id)
	{
			$articulo=Articulo::findOrFail($id);

			$articulo->idcategoria=$request->get('idcategoria');

			$articulo->codigo=$request->get('codigo');
			$articulo->nombre=$request->get('nombre');
			$articulo->stock=$request->get('stock');
			$articulo->descripcion=$request->get('descripcion');
				

			if (Input::hasFile('imagen')){
				$file=Input::file('imagen');
				$file->move(public_path().'/imagenes/articulos/',$file->getClientOriginalName());
				$articulo->imagen=$file->getClientOriginalName();

			}

			
			$articulo->update();
			return Redirect::to('almacen/articulo');


	}
	public function destroy($id)
	{
		$articulo=Articulo::findOrFail($id);
		$articulo->estado='inactivo';
		$articulo->update();
		return Redirect::to('almacen/articulo');
	}
}

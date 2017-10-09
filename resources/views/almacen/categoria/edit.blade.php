@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3> editar categoria:{{$categoria->nombre}}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
				</div>
				@endif
				{!!Form::model($categoria,['method'=>'PATCH','route'=>['almacen.categoria.update',$categoria->idcategoria]])!!}

				{{Form::token()}}

					<div class="form-group">
						<label for="nombre">nombre</label>
						<input type="text" name="nombre" class="form-control" value="{{$categoria->nombre}}" placeholder="nombre...">
					</div>
					<div class="form-group">
						<label for="descripcion">descripcion</label>
						<input type="text" name="descripcion" class="form-control" value="{{$categoria->descripcion}}" placeholder="descripcion">
					</div>
					<div class="form-group">
						<button class="btn btn-primary" type="submit">guardar</button>
						<button class="btn btn-danger" type="reset"> cancelar</button>
					</div>
				{!!Form::close()!!}
		</div>
	</div>
@endsection
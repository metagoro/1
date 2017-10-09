@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3> nuevo cliente</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
				@endif
		</div>
	</div>
			{!!Form::open(array('url'=>'ventas/cliente','method'=>'POST','autocomplete'=>'off'))!!}

{{form::token()}}

			<div class="row">

				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<div class="form-group">
						<label for="nombre">nombre</label>
						<input type="text" name="nombre" required value="{{old('nombre')}}" class="form-control" placeholder="nombre...">
					</div>
				</div>


	

				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<div class="form-group">
						<label for="nombre">direccion</label>
						<input type="text" name="direccion" value="{{old('direcion')}}" class="form-control" placeholder="direccion...">
					</div>
				</div>




				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<div class="form-group">
						<label>Documento</label>
						<select name="tipo_documento" class="form-control"> 			
							<option value="dni">DNI</option>
							<option value="ruc">RUC</option>
							<option value="pas">PAS</option>						
						</select>
					</div>					
				</div>



			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
						<div class="form-group">
						<label for="codigo">numero documento</label>
						<input type="text" name="num_documento" value="{{old('num_documento')}}" class="form-control" placeholder="numero de documento...">
					</div>
				</div>

				


				

				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

					<div class="form-group">
						<label for="stock">telefono</label>
						<input type="text" name="telefono" value="{{old('telefono')}}" class="form-control" placeholder="telefono...">
					</div>				
				</div>

				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

					<div class="form-group">
						<label for="email">email</label>
						<input type="email" name="email" value="{{old('email')}}" class="form-control" placeholder="email...">
					</div>				
				</div>

				
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<div class="form-group">
						<button class="btn btn-primary" type="submit">guardar</button>
						<button class="btn btn-danger" type="reset"> cancelar</button>
					</div>
				</div>
		</div>			

					
					
				{!!Form::close()!!}
		
@endsection
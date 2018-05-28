<!--Desarrollado por Yeisy Flames 01/07/2016-->
@extends('/layouts/master')

@section('header') 
<link rel="stylesheet" href="{!! asset('css/jquery-ui.min.css') !!}"> 
@endsection 
 @section('script')
	<script type="text/javascript" src="{!! URL::asset('/js/jquery-ui.min.js') !!}"></script> 
	<script type="text/javascript" src="{!! URL::asset('js/Orinoco/webserviceswu.js') !!}"></script>
	<script type="text/javascript" src="{!! URL::asset('js/Orinoco/webservicefichacliente.js') !!}"></script>
	<script type="text/javascript" src="{!! URL::asset('js/Orinoco/ciudades.js') !!}"></script>
	<script type="text/javascript" src="{!! URL::asset('js/Orinoco/funciones.js') !!}"></script>
	<script type="text/javascript" src="{!! URL::asset('js/Orinoco/funcioneswu.js') !!}"></script>
	<script type="text/javascript" src="{!! URL::asset('js/Orinoco/funciones_formaspago.js') !!}"></script>
 @endsection
@section('content') 

<script type="text/javascript">
 document.oncontextmenu = function(){return false;}
</script>				
<script>

/*$(document).ready(function()  // validacion del HeartBeat
{	alert('si');
	var webservice= 'HeartBeat';
	var pagina= 'wu/';
	var method= 'Get';
	var url= $("#cedula").data('url');
	var arrcampos= [''];
	var arrvar= [''];
	//alert(url);
	var data={webservice:webservice,pagina:pagina,method:method,campos:arrcampos,valores:arrvar};
	$.ajax({
	   type: 'GET',
		url: url,
		data:data,
		datatype: 'JSON',
		success: function(data)
		{
			if(data.entityResponse!='Good')
			{
				var msj= '<span>El Servicio de WU no se encuentra activo en este momento, disculpe las molestias ocasionadas.\nPor favor espere unos minutos, si la falla persiste, comuníquese con la Gerencia de Sistemas</span>';
				$("#mensaje").html(msj);
				$("#mensajemod").modal("show");
			}else if (data.entityResponse=='Good')
			{
				var usuario= $("#usuarioid").val();
				var oficina = $("#oficinaid").val();
				var webservice= 'DasServiceWs';
				var pagina= 'wu/';
				var method= 'Get';
				var url= $("#cedula").data('url');
				var arrcampos= ['counter_id','nomservicio','coduser','codoficina'];
				var arrvar= ['VE027AT0001A','GetWUAgentBannerMsgs',usuario,oficina];
				var data={webservice:webservice,pagina:pagina,method:method,campos:arrcampos,valores:arrvar};
				$.ajax({
			   type: 'GET',
				url: url,
				data:data,
				datatype: 'JSON',
				success: function(banners) 
				{
					alert(JSON.stringify(banners));
				}
			});	
		}
	});
	
	function getRandValue(){
		var webservice= 'HeartBeat';
		var pagina= 'wu/';
		var method= 'Get';
		var url= $("#cedula").data('url');
		var arrcampos= [''];
		var arrvar= [''];
		var data={webservice:webservice,pagina:pagina,method:method,campos:arrcampos,valores:arrvar};
		$.ajax({
		   type: 'GET',
			url: url,
			data:data,
			datatype: 'JSON',
			success: function(data) 
			{
				if(data.entityResponse!='Good')
				{
					var msj= '<span>El Servicio de WU no se encuentra activo en este momento, disculpe las molestias ocasionadas.\nPor favor espere unos minutos, si la falla persiste, comuníquese con la Gerencia de Sistemas</span>';
					$("#mensaje").html(msj);
					$("#mensajemod").modal("show");
				}
			}
		});
	}
	 setInterval(getRandValue, 300000);
});
*/


$(document).ready(function(){ 
/*$('#btnsubmit').click(function(){
		//$('input[type=checkbox]:checked').length === 0)
		if(($('.seleccionarbenef:checked').length === 0))//$(".seleccionarbenef").not(':checked')
		{
			var msj= '<span>Por favor seleccione un Beneficiario</span>';
			$("#mensaje").html(msj);
			$("#mensajemod").modal("show");	
			$(".seleccionarbenef" ).focus();
			return false;
		}
	});	*/
});
</script>
<style>
.modal-body{
    max-height: calc(100vh - 200px);
    overflow-y: auto;
}
</style>
<?php $rutaSession=Session::get('conexion');?>
<div id="banners-message" class="col-sm-10 col-sm-offset-1" style="display:none" ></div><br>

<form role="form" action="{{ url($rutaSession.'/'.'postFormapago') }}" id="FichaclienteForm"  method="POST">
<br><div class="col-sm-10 col-sm-offset-1 container validate">
	<div class="panel panel-primary">
		<div class="panel-heading text-left ">
			<strong><small>Paso 1) Datos del Cliente</small></strong>
		</div>
		<div class="panel-body">
			<div class="col-md-2">
				<?php $conttipodoc=count($tipodocli['entidadRespuesta']);?>
			<label for="inputtipodoc" class="control-label"><small>Tipo Doc.</small></label>
				<select class="form-control input-sm" name="tipodoc1" id="tipodoc1" >
					<option value='' selected>..</option>
						<?php 
						for($i=0;$i<$conttipodoc;$i++)
						{
							if($tipodocli['entidadRespuesta'][$i]['inactivo']=='0')
							{
							 ?>
								<option value="<?php echo $tipodocli['entidadRespuesta'][$i]['codtipodocwu'];?>"><?php echo $tipodocli['entidadRespuesta'][$i]['siglas'];?></option>
							<?}
						}?>
				</select><? //print $conttipodoc;?>
			</div>
			<div class="col-md-2">
			<label for="inputtipodoc" class="control-label"><small>Identificacion</small></label>
				<input type="text" class="form-control input-sm" name="cedula" id="cedula" maxlength="10" onkeyup="return chequear(this.form.cedula)" onblur="funbuscacliente(this.form,1),webservicewu(this.form,1)"  data-url='<?php echo  route("getConsumirAjax")?>'>
				<input type="hidden" name="siglass" id="siglass">
				<input type="hidden" name="codcell" id="codcell">
				<input type="hidden" name="paisnacnom" id="paisnacnom">
				<input type="hidden" id="tipodoc" name="tipodoc"/>
				<input type="hidden" name="usuarioid" id="usuarioid" value="<?php print \Session('entidadRespuesta.codusuario')?>">
				<input type="hidden" name="oficinaid" id="oficinaid" value="<?php print \Session('entidadRespuesta.codoficina')?>">
			</div>
			
			<div class="col-md-4">
				<label for="inputtipodoc" class="control-label"><small>Nombre</small></label>
				<input type="text" class="form-control input-sm"  name="nombre" disabled id="nombre" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" ONKEYPRESS="return keyToUpperCase(this, event)" >
				<input type="hidden" id="cmbtipo"  name="cmbtipo" value="6" >
			</div>
			<div class="form-group col-sm-2">
				<label for="inputnombres" class="control-label"><small>Cod.</small> </label>
				<select  class="form-control input-sm" id="codcel" name="codcel" disabled></select>
			</div>
			<div class="col-md-2">
				<label for="inputtipodoc" class="control-label"><small>Tlf. Celular</small></label>
				<input type="text" class="form-control input-sm" name="telefonocel" id="telefonocel" readonly onkeyup="return chequear(this.form.telefonocel)">
			</div>
		</div><!--fin panel-body-->
	</div><!-- /.panel panel-default -->
</div><!--fin col-sm-6 col-sm-offset-3-->
<!--<div class="col-md-10 col-md-offset-1 alert alert-info" align=center style="display:none" id="resultado"></div>-->

<div class="alert alert-danger col-md-8 col-md-offset-2 text-center" id="resultado" role="alert" style="display:none">
	<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
	<span class="sr-only text-center" >Error:</span>
</div>


<div id='pasa' style="display:none">

		
		<div id="biometria" class="col-md-10 col-md-offset-1" align=center style="display:none">
		  <div class="col-md-4 container">
			<div class="thumbnail" id="huella" style="width:250px; height:200px;" data-toggle="modal" data-target="#modalhuella"></div>
		  </div>
		   <div class="col-md-4 container">
			<div class="thumbnail" id="rostro" style="width:250px; height:200px;" data-toggle="modal" data-target="#modalrostro"></div>
		  </div>
		   <div class="col-md-4 container">
			<div class="thumbnail" id="documento" style="width:250px; height:200px;" data-toggle="modal" data-target="#modaldocumento"></div>
		  </div>
		</div>

		
		<div class="col-md-10 col-md-offset-1" id="cargando" style="display:none"><center><img src="{!! URL::asset('img/orinoco/cargando3.gif') !!}" width="40" height="40" border="0" alt=""></center></div>
		<div class="col-md-10 col-md-offset-1">
		<div class="panel panel-primary">
			<div class="panel-heading text-left">
				<strong><small>Paso 2) Verifique y Complete la ficha del Cliente</small></strong>
			</div>
			
		<!--</div>
	</div>
	<div class="col-md-10 col-md-offset-1">-->
		<div class="tabbable">
			<nav class="navbar navbar-default" id="fichacli">
				<div class="col-md-12 ">
					<ul class="nav nav-tabs " id="tabs">
						<li role="presentation" class="col-md-2 active text-center"><a href="#datospersonales" data-toggle="tab"><small>Datos Personales</small></a></li>
						<li role="presentation" class="col-md-2 text-center"><a href="#datosocupacionales" data-toggle="tab"><small>Información Ocupacional</small></a></li>
						<li role="presentation" class="col-md-3 text-center"><a href="#declaracion" data-toggle="tab"><small>Orígen y Destino de fondos</small></a></li>
						<li role="presentation" class="col-md-1 text-center"><a href="#datospep" data-toggle="tab"><small>PEP</small></a></li>
						<li role="presentation" class="col-md-2 text-center"><a href="#documentos" data-toggle="tab"><small>Documentos</small></a></li>
						<li role="presentation" class="col-md-2 text-center"><a href="#referencias" data-toggle="tab"><small>Referencias</small></a></li>
					</ul>
				</div>
		
				<!--Formulario de los Datos personales-->
				<div class="tab-content validate">
						<div class="tab-pane active text-center errorInput" id="datospersonales">
							<div class="col-md-12 ">
								<div class="panel panel-info">
									<div class="panel-heading  ">
										<strong ><small>Datos Personales</small></strong>
									</div>
								</div>
								
									<div class="form-group col-md-3">
										<label for="inputtipodoc" class="control-label"><small>Primer Nombre</small></label>
										<input type="text" class="form-control input-sm margen-inputb " readonly id="nombre1" name="nombre1"  />
									</div>
									<div class="form-group col-md-3">
										<label for="inputnombres" class="control-label"><small>Segundo Nombre</small></label>
										<input type="text" class="form-control input-sm margen-inputb" readonly id="nombre2" name="nombre2"/>
									</div>
									<div class="form-group col-md-3">
										<label for="inputnombres" class="control-label"><small>Primer Apellido</small></label>
										<input type="text" class="form-control input-sm margen-inputb " readonly id="apellido1" name="apellido1"    />
									</div>
									<div class="form-group col-md-3">
										<label for="inputnombres" class="control-label"><small>Segundo Apellido</small></label>
										<input type="text" class="form-control input-sm margen-inputb" readonly id="apellido2" name="apellido2"    />
									</div>
									<div class="form-group col-md-3">
										<label for="inputemail" class="control-label"><small>Correo Electrónico</small></label>
										<input type= "email" readonly class="form-control input-sm margen-inputb " id="email" name="email"   />
									</div>
									<div class="form-group col-md-3">
										<label for="inputgenero" class="control-label"><small>Genero</small></label>
										<select disabled class="form-control input-sm margen-inputb" id="genero" name="genero" ></select>
										<input type="hidden" name="genero1" id="genero1">
									</div>
									<div class="form-group col-md-3">
										<label for="inputtipodoc" class="control-label"><small>Pais de Nacimiento</small></label>
										<select  disabled class="form-control input-sm margen-inputb"  id="paisnac" name="paisnac" ></select>
									</div>
									<div class="form-group col-md-3">
										<label for="inputnombres" class="control-label"><small>Lugar de Nacimiento</small></label>
										<input type="text" readonly class="form-control input-sm margen-inputb" id="lugarnac" name="lugarnac" />
									</div>
									<div class="form-group col-md-4">
										<label for="inputgenero" class="control-label"><small>Fecha de Nacimiento</small></label>
										<div style="margin-bottom: 15px" class="input-group date col-xs-12 col-md-12 col-sm-12 ">
											<span class="input-group-addon"><i class="glyphicon glyphicon-calendar" data-toggle="tooltip" data-placement="top" title='Fecha de Nacimiento'></i></span>
											<input type="text" readonly class="form-control input-sm margen-inputb " name="fechanac" id="fechanac" name="fechanac" placeholder="Ingrese Fecha de Nacimiento" required data-placement="bottom">
										</div>
									</div>
									<div class="form-group col-md-4">
										<label for="inputestadocivil" class="control-label"><small>Estado Civil</small></label>
											<select disabled class="form-control input-sm margen-inputb"  id="estadocivil" name="estadocivil">
												<option  value="" >..</option>
												<option value="SOLTERO">SOLTERO(A)</option>
												<option value="CASADO">CASADO(A)</option>
												<option value="VIUDO">VIUDO(A)</option>
												<option value="DIVORCIADO">DIVORCIADO(A)</option>
											</select>
									</div>
									<div class="form-group col-md-4">
										<label for="inputnacionalidad" class="control-label"><small>Nacionalidad</small></label>
										<input type="text" readonly class="form-control input-sm margen-inputb " id="nacionalidad" name="nacionalidad" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" />
									</div>
									<div class="panel-heading col-md-12 ">
										<div class="panel panel-info">
											<div class="panel-heading ">
												<strong><small>Dirección de Residencia (Debe coincidir con la dirección cargada en el RIF)</small></strong>
											</div>
										</div>
									</div>
									<div class="form-group col-md-3">
										<label for="inputtipodoc" class="control-label"><small>Ciudad</small></label>
										<input type="text" readonly class="form-control input-sm autocomplete margen-inputb" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" id="ciudad" name="ciudad" />
										<input type="hidden"  id="codciudad" name="codciudad" />
										<input type="hidden"  id="nombreestado" name="nombreestado" />
										
									</div>
									<div class="form-group col-md-3">
										<label for="inputnombres" class="control-label"><small>Estado</small></label>
										<select  disabled class="form-control input-sm margen-inputb" id="estado" name="estado" ></select>
										
									</div>
									
									<div class="form-group col-md-3">
										<label for="inputgenero" class="control-label"><small>Municipio</small></label>
										<select type="text" disabled class="form-control input-sm margen-inputb" id="municipio" name="municipio"></select>
										
									</div>
									
									<div class="form-group col-md-3">
										<label for="inputgenero" class="control-label"><small>Parroquia</small></label>
										<select disabled class="form-control input-sm margen-inputb" id="parroquia" name="parroquia" ></select>
										
									</div>
									<div class="form-group col-md-3">
										<label for="inputgenero" class="control-label"><small>Codigo Postal</small></label>
										<input type="text" readonly class="form-control input-sm margen-inputb" id="codpostal" name="codpostal" />
									</div>
									<div class="form-group col-md-3">
										<label for="inputtelefonoresid" class="control-label"><small>Telefono</small></label>
										<input type="text" readonly class="form-control input-sm margen-inputb" id="telefonoresd" name="telefonoresd" onkeyup="mascara(telefonoresd,'-',patrontelefono,true)" />
									</div>
									<!--<div class="form-group col-md-3">
										<label for="inputgenero" class="control-label"><small>Cod.</small></label>
										<select class="form-control input-sm" id="codcel1" disabled ></select>
									</div>
									<div class="form-group col-md-4">
										<label for="inputgenero" class="control-label"><small>Telefono Movil</small></label>
										<input type="text" class="form-control input-sm" id="telefonocel1" disabled  />
									</div>-->
									<div class="form-group col-md-6">
										<label for="inputdireccion" class="control-label"><small>Direccion</small></label>
										<textarea type="text" readonly class="form-control input-sm margen-inputb" id="direccion" name="direccion" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" ></textarea>
									</div>
							</div>	
						</div><!--</div>--><!--Fin Formulario de Datos Personales-->
					
					<!--Formulario de los Datos Ocupacionales-->
					<div class="tab-pane text-center validate errorInput" id="datosocupacionales">
						<div class="col-sm-12 ">
							<div class="panel panel-info">
								<div class="panel-heading ">
									<strong><small>Datos Ocupacionales</small></strong>
								</div>
							</div>
							
							<div class="form-group  col-md-3">
								<label for="inputactividadeconomica" class="control-label "><small>Actividad Economica</small></label>
								<select disabled class="form-control input-sm margen-inputb"  id="actividadeconomica" name="actividadeconomica" ></select>
							</div>
							<div class="form-group  col-md-3">
								<label for="inputnombres" class="control-label "><small>Seleccione el Detalle</small></label>
								<select disabled class="form-control input-sm margen-inputb" id="detactividadeconomica" name="detactividadeconomica"></select>
							</div>
							<div class="form-group  col-md-3">
								<label for="inputgenero" class="control-label "><small>Profesion</small></label>
								<select disabled class="form-control input-sm margen-inputb" id="profesion" name="profesion"></select>
							</div>
							  
							<div class="form-group  col-md-3">
								<label for="inputtipodoc" class="control-label"><small>Ocupacion</small></label>
								<select  disabled class="form-control input-sm margen-inputb"  id="ocupacion" name="ocupacion"  ></select>
							</div>
							 <input type="hidden" name="nomocupacion" id="nomocupacion">
							<div class="panel-heading col-md-12">
								<div class="panel panel-info">
									<div class="panel-heading ">
										<strong><small>Dirección donde trabaja</small></strong>
									</div>
								</div>
							</div>
							<div class="form-group col-sm-3">
								<label for="inputtipodoc" class="control-label"><small>Nombre de la Empresa</small></label>
								<input type="text" readonly class="form-control input-sm margen-inputb"  id="empresa" name="empresa"/>
							</div>
							<div class="form-group col-sm-3">
								<label for="inputnombres" class="control-label"><small>Telefono</small></label>
								<input type="text" readonly class="form-control input-sm margen-inputb" id="telefonoofic" name="telefonoofic" onkeyup="mascara(telefonoofic,'-',patrontelefono,true)" />
							</div>
							<div class="form-group col-sm-3">
								<label for="inputtipodoc" class="control-label"><small>Ciudad</small></label>
								<input type="text" readonly class="form-control input-sm autocomplete margen-inputb"  id="ciudadofi" name="ciudadofi"  />
								<input type="hidden"  id="codciudadofi" name="codciudadofi" />
							</div>
							<div class="form-group col-sm-3">
								<label for="inputnombres" class="control-label"><small>Estado</small></label>
								<select  disabled class="form-control input-sm margen-inputb" id="estadoofi" name="estadoofi" ></select>
							</div>
							<div class="form-group col-sm-4">
								<label for="inputgenero" class="control-label"><small>Municipio</small></label>
								<select disabled type="text" class="form-control input-sm margen-inputb" id="municipioofic" name="municipioofic" ></select>
							</div>
							<div class="form-group col-sm-4">
								<label for="inputgenero" class="control-label"><small>Parroquia</small></label>
								<select disabled class="form-control input-sm margen-inputb" id="parroquiaofi" name="parroquiaofi"></select>
							</div>
							<div class="form-group col-sm-4">
								<label for="inputgenero" class="control-label"><small>Codigo Postal</small></label>
								<input  readonly class="form-control input-sm margen-inputb" id="codpostalofi" name="codpostalofi" />
							</div>
							<div class="form-group col-sm-4">
								<label for="inputdireccion" class="control-label"><small>Direccion</small></label>
								<textarea readonly class="form-control input-sm margen-inputb" id="direccionofic" name="direccionofic" ></textarea>
							</div>
							  
							<div class="form-group col-sm-4">
								<label for="inputnombres" class="control-label"><small>Salario Mensual(Bsf.) </small></label>
								<select disabled class="form-control input-sm margen-inputb" id="salario" name="salario"  > </select>
							</div>
							<div class="form-group col-sm-4">
								<label for="inputgenero" class="control-label"><small>Otros Ingresos Mensuales(Bsf.)</small></label>
								<input type="text" readonly class="form-control margen-inputb" id="otrosingresos" name="otrosingresos" onkeyup=chequear(this.form.otrosingresos)  />
							</div>
						</div>
					</div><!--fin formulario de datos ocupacionales-->
					
					<!--Formulario de Origen y destino de fondos-->
					<div class="tab-pane text-center validate errorInput" id="declaracion">
						<div class="col-sm-12 ">
							<div class="panel panel-info">
								<div class="panel-heading ">
									<strong><small>Declaración Jurada de Origen y Destino de Fondos</small></strong>
								</div>
							</div>
							<div class="form-group col-sm-4">
								<label for="inputtipodoc" class="control-label"><small>País de Encomienda</small></label>
								<select disabled class="form-control input-sm margen-inputb "  id="paisenc" name="paisenc"></select>
							</div>
							<div class="form-group col-sm-4">
								<label for="inputnombres" class="control-label"><small>Frecuencia</small></label>
								<select disabled class="form-control input-sm margen-inputb "  id="frecuencia" name="frecuencia"></select>
							</div>
							<div class="form-group col-sm-4">
								<label for="inputemail" class="control-label"><small>Monto Promedio (Bsf.)</small></label>
								<select disabled class="form-control input-sm margen-inputb " id="montopromedioenc" name="montopromedioenc" ></select>
							</div>
							<div class="form-group col-sm-4">
								<label for="inputgenero" class="control-label"><small>Origen de los Fondos</small></label>
								<select disabled class="form-control input-sm margen-inputb " id="origenfondos" name="origenfondos"></select>
								<input type="hidden" id="origenfondoswu" name="origenfondoswu"/>
							</div>
							<div class="form-group col-sm-4">
								<label for="inputtipodoc" class="control-label"><small>Uso de los Fondos</small></label>
								<select disabled class="form-control input-sm margen-inputb "  id="usofondos" name="usofondos" ></select>
							</div>
							 
							<div class="form-group col-sm-4">
								<label for="inputtelefonoresid" class="control-label"><small>Motivo o Nec.</small></label>
								<select disabled class="form-control input-sm margen-inputb " id="motivoserv" name="motivoserv"></select>
								
							</div>
							
						</div>
					</div> <!--Fin de formulario origen y destino de fondos-->
					
					<!--Formulario de Persona expuesta politicamente-->
					<div class="tab-pane text-center validate errorInput" id="datospep">
						<div class="col-sm-12 ">
							<div class="panel panel-info">
								<div class="panel-heading ">
									<strong><small>Persona Expuesta Políticamente (PEP)</small></strong>
									<span class="glyphicon glyphicon-question-sign " data-toggle="tooltip" title="Una Persona Expuesta Políticamente, es aquella que desempeña o ha desempeñado funciones públicas destacadas en un determinado país." id="pepimg"></span> 
								</div>
							</div>
								<div class="form-group  col-md-12 text-left">
									<strong><small >1.- ¿Es usted una Persona Expuesta Políticamente?</small></strong><br>
									<label class="radio-inline">
										<input class="margen-inputb" name="esudpep" id="esudpepsi" value="t" type="radio"> SI
									</label>
									<label class="radio-inline">
										<input readonly class="margen-inputb" name="esudpep" id="esudpepno" value="f"  type="radio"> NO
									</label>
								</div>
								<div class="form-group  col-md-12 text-left">
									<strong><small>2.- ¿Fué usted una Persona Expuesta Políticamente?</small></strong><br>
									<label class="radio-inline">
										<input readonly class="margen-inputb" name="fueudpep" id="fueudpepsi" value="t" type="radio"> SI
									</label>
									
									
									<label class="radio-inline">
										<input readonly class="margen-inputb" name="fueudpep" id="fueudpepno" value="f"  type="radio"> NO
									</label>
								</div>
								<div class="form-group  col-md-12 text-left">
									<strong><small>3.- ¿Alguna de estas personas: Padre, madre, hermano, hermana, cónyuge, concubino, hija, hijo, suegro, suegra, nuera, yerno, cuñada, cuñado;   Es una Persona Expuesta Políticamente?</small></strong><br>
									<label class="radio-inline">
										<input readonly class="margen-inputb"  id="idsifepep" name="rfepep"  class="rfepep " type="radio" value="t" > SI
									</label>
									<label class="radio-inline">
										<input readonly class="margen-inputb"  id="idnofepep" name="rfepep" class="rfepep" type="radio" value="f"> NO
									</label>
								</div>
								<div id="sifam"></div>
										
									
								<div class="form-group  col-md-12 text-left">
									<strong> <small>4.- ¿Alguna de estas personas: Padre, madre, hermano, hermana, cónyuge, concubino, hija, hijo, suegro, suegra, nuera, yerno, cuñada, cuñado;   Fué una Persona Expuesta Políticamente?</small></strong><br>
									<label class="radio-inline">
										<input readonly name="rffpep" class="rffpep chk margen-inputb" id="idsiffpep" value="t" type="radio"> SI
									</label>
									<label class="radio-inline">
										<input readonly name="rffpep" class="rffpep margen-inputb" id="idnoffpep" value="f" type="radio"> NO
									</label>
								</div>
								<div id="sifuefam"></div>
								
							
						</div>
					</div> <!--fin persona expuesta politicamente-->
					
					<!--Formulario de Documentos-->
					<div class="tab-pane text-center validate errorInput" id="documentos">
						<div class="col-sm-12 ">
							<div class="panel panel-info">
								<div class="panel-heading ">
									<strong><small>Documentos</small></strong>
								</div>
							</div>
							
							<div class="form-group col-sm-6 campodoc">
								<label for="inputnombredoc" class="control-label"><small>Documento</small></label>
								<input class="form-control input-sm margen-inputb" readOnly id="nombredocumento_1" name="nombredocumento" value="CEDULA DE IDENTIDAD">
								<br><input class="form-control input-sm margen-inputb" readOnly id="nombredocumento_2" name="nombredocumento" value="REGISTRO DE INFORMACION FISCAL">
							</div>
							<div class="form-group col-sm-3 campofechaem">
								<label for="inputtipodoc" class="control-label"><small>Fecha Venc</small></label>
								<input type="text"  class="fecha form-control input-sm margen-inputb center doc documentoremove date-pick" readOnly id="fechavencdoc1" name="fechavencdoc[]" required data-placement="bottom" /><br>
								<input type="text"  class="fecha form-control input-sm margen-inputb center doc documentoremove date-pick" readOnly id="fechavencdoc2" name="fechavencdoc[]" required data-placement="bottom" />
							</div>
							
							<div class="form-group col-sm-3 campofechavenc" id="fecha">
								<label for="inputtipodoc" class="control-label"><small>Vence en:</small></label>
								<input type="text" class="form-control input-sm margen-inputb center documentoremove" readOnly id="vence_1" name="vence"/><br>
								<input type="text" class="form-control input-sm margen-inputb center documentoremove" readOnly id="vence_2" name="vence"/>
							</div>
							
							<div id="agregardocu" class="adddocumentos col-md-8 col-md-offset-2"" data-url='<?php echo route("getConsumirAjax")?>'">
							</div>
							
						</div>
					</div>
					<input type="hidden" name="fechaexpdoc" id="fechaexpdoc">
					<!--Formulario de Referencias-->
					<div class="tab-pane text-center validate errorInput" id="referencias">
						<div class="col-sm-12 ">
							<div class="panel panel-info">
								<div class="panel-heading ">
									<strong><small>Referencias Bancarias</small></strong>
								</div>
							</div>
							
								<div class="form-group col-md-4 campo1 ">
									<label for="inputtipodoc" class="control-label"><small>Nro de Cuenta</small></label>
									<input type="text" readOnly required class="form-control input-sm margen-inputb"  id="nrocuenta" name="nrocuenta"  maxlength="20"     onkeypress="return justNumbers(event);" /><!--onkeyup="validarSiNumero(this.value)" return chequear(this.form.nrocuenta)-->
									<!--<label for="inputtipodoc" class="control-label"><small>Nro de Cuenta</small></label>-->
								</div>
								<div class="form-group col-md-4 campo2">
									<label for="inputnombres" class="control-label"><small>Tipo de Cuenta</small></label>
									<input type="text" readOnly required class="form-control input-sm margen-inputb" id="tipocuenta" name= "tipocuenta" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" onkeypress="return soloLetras(event)" />
									
								</div>
								<div class="form-group col-md-4 campo3">
									<label for="inputemail" class="control-label"><small>Banco</small></label>
									<select  required disabled class="form-control input-sm margen-inputb" id="nombrebanco" name="nombrebanco"></select>
								</div>
								<!--<div class="form-group col-md-3 campos4">
									<label for="inputgenero" class="control-label"><small>Lugar</small></label>
									
								</div>-->
								<div class="panel-heading col-md-12  ">
									<div class="panel panel-info">
										<div class="panel-heading ">
											<strong><small>Referencias Personales y/o comerciales</small></strong>
										</div>
									</div>
								</div>
									
								<div class="form-group col-md-6 campos1">
									<label for="inputtipodoc" class="control-label"><small>Nombre y Apellido</small></label>
									<input type="text" readOnly required="true" class="form-control input-sm  margen-inputb "  id="nombreref" name="nombreref" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" onkeypress="return soloLetras(event)"/>
									
								</div>
								 
								<div class="form-group col-md-6 campos2">
									<label for="inputtelefonoresid" class="control-label"><small>Nro. de teléfono</small></label>
									<input type="text" readOnly required="true" class="form-control input-sm margen-inputb" id="telefonoref" name="telefonoref" onkeyup="mascara(telefonoref,'-',patrontelefono,true)" />
									
								</div>
						</div>
					</div><!--Fin de formulario de Referencias-->
				</div><!--fin tab-content!-->
			</nav></div>
		</div><!-- fin div tabbable-->
	</div><!--fin div col-md-8 col-md-offset-2!-->
	
	
	
	
	<!-- Beneficiarios del Cliente  -->
	<div class="col-md-10 col-md-offset-1">
		<div class="panel panel-primary">
			<div class="panel-heading text-left ">
				<strong><small>Paso 3) Beneficiarios del Cliente:</small></strong>
			</div>
		<!--</div>-->
			<div class="panel panel-info">
				<div class="panel-heading ">
				<strong><small>Beneficiarios del Cliente</small></strong>
			</div>
			<div class="panel-body table-responsive">
				<div class="col-md-10 col-md-offset-1">
					<table class="beneficiario table table-hover table-bordered table-condensed" id="beneficiarioremove">
						<tr class=" info"  style="border:1px solid #000000;">
							<td>Seleccione</td>
							<td>Primer Nombre</td>
							<td>Segundo Nombre</td>
							<td>Primer Apellido</td>
							<td>Segundo Apellido</td>
							<td>Acción</td>
						</tr>
					</table>
					
					<div class="col-md-10 col-md-offset-1" style="display:none" id="modificarbenef">
						<table id="removebenef" class="table  table-bordered table-condensed">
							<tr class="benef" id="benef'+ultid+'">
							<tr class=" info"  style="border:1px solid #000000;">
								<td><B><small>* Primer Nombre</small></B></td>
								<td><B><small>Segundo Nombre</small></B></td>
								<td ><B><small>* Primer Apellido</small></B></td>
								<td><B><small>Segundo Apellido</small></B></td>
								<td colspan="2"><B><small></small></B></td>
							</tr>
							<tr>
								<td width="95"><INPUT TYPE="text" size="15"  name="primernombrebenef" id="primernombrebenef"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" ></TD>
								<TD width="95"><INPUT TYPE="text" size="15"  name="segundonombrebenef" id="segundonombrebenef"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" ></td>
								
								<td width="95"><INPUT TYPE="text" size="15"  name="primerapellidobenef" id="primerapellidobenef" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"  ></td>
								<td width="95"><INPUT TYPE="text" size="15" name="segundoapellidobenef" id="segundoapellidobenef"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"></td>
								
								<input type="hidden" name="id_benef" id="id_benef">
								<td><button type="button" class="btn btn-primary btn-xs guardar" data-toggle="tooltip" title="Pulse para guardar el Beneficiario" id="guardarmodif" aria-label="Left Align"  onclick="modificarbenef(this.form) ">
								<span class="glyphicon glyphicon-ok" aria-hidden="true"  id="guardar"></span></button></td>&nbsp;
								
								<td><button type="button" class="btn btn-primary btn-xs" remove id="remove" aria-label="Left Align">
								<span class="glyphicon glyphicon-remove" aria-hidden="true" id="removeben"></span></button>
								</td>
							</tr>
						</table>
					</div>
					<table width="100%">
						<tr>
							<td style="padding-left:3px;padding-right:3px;padding-top:3px;padding-bottom:3px"><button type="button" class="btn btn-primary btn-xs" id="addben" aria-label="Left Align" >
								<span class="glyphicon glyphicon-plus" aria-hidden="true" id="addben"></span><B>&nbsp;&nbsp;Agregar Beneficiario</B></button>
							</td>
						</tr>
					</table>
				</div>
				<div id="agregarbenef" class="addbeneficiario col-md-10 col-md-offset-1" data-url='<?php echo route("getConsumirAjax")?>'></div>
			</div>
		</div>
	</div>
	</div><!--Fin beneficiarios-->
	

	<!--Paso 3: Observaciones-->
	<div class="col-md-10 col-md-offset-1">
		<div class="panel panel-primary">
			<div class="panel-heading text-left ">
				<strong><small>Paso 4) Verifique las notas y ESTATUS ingresados para el Cliente:</small></strong>
			</div>
		<!--</div>-->
		<div class="panel panel-info">
			<div class="panel-heading ">
				<strong><small>NOTAS</small></strong>
			</div>
			
			<table class="table table-hover table-bordered observ">
				<tr class="active">
					<td><strong>#</strong></td>
					<td><strong>Observaciones</strong></td>
					<td><strong>Fecha</strong></td>
					<td><strong>Hora</strong></td>
					<td><strong>Usuario</strong></td>
					<td><strong>Oficina</strong></td>
				</tr>
			</table>
			<table class="table table-hover table-bordered noobserv" style="display:none">
				
			</table>
			<button type="button" style="display:none" class="btn btn-primary btn-xs alternar-todo">Ver menos...</button>
			<table class="table table-hover table-bordered observ1" style="display:none">
				<tr  class="active">
					<td><strong>#</strong></td>
					<td><strong>Observaciones</strong></td>
					<td><strong>Fecha</strong></td>
					<td><strong>Hora</strong></td>
					<td><strong>Usuario</strong></td>
					<td><strong>Oficina</strong></td>
				</tr>
			</table>
			<button type="button" class="btn btn-primary btn-xs alternar-todo">Ver más...</button>
			<button type="button" style="display:none" class="btn btn-primary btn-xs alternar-todo">Ver menos...</button>
		</div>
		</div>
	</div>
	
	<!--Paso 3: ESTATUS-->
	<div class="col-md-10 col-md-offset-1">
		<div class="panel panel-info">
			<div class="panel-heading ">
				<strong><small>ESTATUS DEL CLIENTE</small></strong>
			</div>
			<!-- Table -->
			<table >
			<tr>
			<td style="padding-left:3px;padding-right:3px;padding-top:3px;padding-bottom:3px">
				<button type="button" class="btn btn-default btn-xs" aria-label="Left Align" id="mas-estatus">
					<span class="glyphicon glyphicon-plus" aria-hidden="true" id="mas-estatus"></span>
				</button>
				<button type="button" class="btn btn-default btn-xs" aria-label="Left Align" id="menos-estatus" style="display:none">
					<span class="glyphicon glyphicon-minus" aria-hidden="true" id="menos-estatus"></span>
				</button>
			</td>
			<td id="nombrecliente"></td>
			</table>
			<table id="nombrecliente"></table>
			<table class="table table-hover table-bordered estatus" style="display:none">
				<tr class="active">
					<td><strong>#</strong></td>
					<td><strong>Estatus</strong></td>
					<td><strong>Fecha</strong></td>
					<td><strong>Hora</strong></td>
					<td><strong>Usuario</strong></td>
					<td><strong>Oficina</strong></td>
				</tr>
			
			</table>
			<table class="table table-hover table-bordered noestatus" >
			</table>
		</div>
	</div><!--Fin de Estatus-->
	
	
	
	<!--Paso 3: datos del envío-->
	<div class="col-md-10 col-md-offset-1">
		<div class="panel panel-primary">
			<div class="panel-heading text-left ">
				<strong><small>Paso 5) Datos del Envío</small></strong>
			</div>
		
		<div class="panel panel-info">
			<div class="panel-heading ">
				<strong><small>Ingrese datos del Envío:</small></strong>
			</div>
			<div class=" panel-body ">
				<div class="form-group col-md-3">
					<label for="inputtipotrans" class="control-label"><small>Tipo Transaccion</small></label>
					<select class="form-control input-sm margen-inputb" required id="tipotrans" name="tipotrans" onchange="tipodetransaccion(this.form)"><!--, monedapais(this.form)"-->
					<option value='' selected>..</option>
					<option value='WMN'>Monto Fijo a Enviar</option>
					<option value='WMF'>Monto Fijo a Recibir</option>
					</select><!--funciudad(this.value),funfeeiquiry(this.form), funmontototal(this.form)-->
				</div>
				<input type="hidden" name="nomtipotrans" id="nomtipotrans">
				<div class="form-group col-md-3">
					<label for="inputprincipal" class="control-label"><small>Principal Dolares</small></label>
					<input class="form-control input-sm margen-inputb" readOnly required id="txtmontodolar" name="txtmontodolar"  onkeyup="return funmontototal(this.form), chequear(this.form.txtmontodolar)"/>
					<input type="hidden" name="txtdolar" id="txtdolar">
				</div>
				<div class="form-group col-md-3">
					<label for="inputpaisdestino" class="control-label"><small>País Destino</small></label>
					<select class="form-control input-sm margen-inputb" required id="paisdestino" name="paisdestino" onchange="funciudad(this.value), monedapais(this.form)" ></select><!--funciudad(this.value),funfeeiquiry(this.form), funmontototal(this.form)-->
				</div> 
				
				
				<div class="form-group col-md-3" id="monedaciudadd" name="monedaciudadd" >
					<label for="inputnombres" class="control-label"><small>Moneda</small> </label>
					<select  class="form-control input-sm" required id="monedaciudad" name="monedaciudad"  onblur="funmontototal(this.form)" onchange="funservicio(this.form)"></select><!--,funfeeiquiry(this.form,1)  onchange="funfeeiquiry(this.form)"   onchange="funmontototal(this.form)"-->
				</div>
				<input type="hidden" name="monedanom" id="monedanom">
				<div class="form-group col-md-3">
					<label for="inputserviciodelivery" class="control-label"><small>Servicio</small></label>
					<select class="form-control input-sm margen-inputb" required id="serviciodelivery" name="serviciodelivery" onchange="serviciotlf(this.value),funfeeiquiry(this.form,1)"></select><!--funciudad(this.value),funfeeiquiry(this.form), funmontototal(this.form)-->
				</div>
				<input type="hidden" name="nomservicio" id="nomservicio">
				<div class="form-group col-md-3" id="simsj-benef" style="display:none">
					<label for="inputtlfbeneficiario" class="control-label"><small>Tlf.Beneficiario</small></label>
					<input type="text" maxlength="10" class="form-control input-sm margen-inputb"  id="tlfbeneficiario" name="tlfbeneficiario" onkeyup="return chequear(this.form.tlfbeneficiario)"/>
				</div>
				<div class="form-group col-md-3 " disabled id="existeciudad" name="existeciudad">
					<label for="inputpaisdestino" class="control-label"><small>Ciudad</small></label>
					<select class="form-control input-sm margen-inputb" required disabled id="ciudadsiwu" name="ciudadsiwu" onchange="funcestado(this.value)"></select>
					<input class="form-control input-sm margen-inputb" required  type="text" name="ciudaduuee" id="ciudaduuee" style="display:none" disabled style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"/>
				</div>
				<div class="form-group col-md-3"  id="existeestado" name="existeestado">
					<label for="inputpaisdestino"  class="control-label"><small>Estado</small></label>
					<select class="form-control input-sm margen-inputb" required disabled id="estadowu" name="estadowu"></select>
				</div>
				<div class="form-group col-md-3">
					<label for="inputtasaventa" class="control-label"><small>Motivo BCV</small></label>
					<select class="form-control input-sm margen-inputb" required id="cmbmotivobcv" name="cmbmotivobcv"></select>
				</div>
				<div class="form-group col-md-12">
					<label for="inputtasaventa" class="control-label"><small>Ver informacion del Pais</small> <button type="button" class="btn btn-primary btn-xs " onclick="countryinfo(this.form)">Más detalle...</button></label>
					<!--<select class="form-control input-sm margen-inputb" required id="cmbmotivobcv" name="cmbmotivobcv"></select>-->
				</div>
				<div class="form-group col-md-3">
					<label for="inputtasaventa" class="control-label"><small>Tasa de Venta</small></label>
					<input type="text" readonly class="form-control input-sm margen-inputb" required id="hdtasa" name="hdtasa"/>
				</div>
				<div class="form-group col-md-3">
					<label for="inputcomisionccz" class="control-label"><small>Comisión CCZ Bs. </small></label>
					<input type="text" readonly class="form-control input-sm margen-inputb" required id="txtmontocomccz" name="txtmontocomccz"/>
				</div>
				<div class="form-group col-md-3">
					<label for="inputcomisionccz" class="control-label"><small>Comisión  Gastos Adm Bs. </small></label>
					<input type="text" readonly class="form-control input-sm margen-inputb" required id="txtmontocomadm" name="txtmontocomadm"/>
				</div>
				<div class="form-group col-md-3">
					<label for="inputprincipalbs" class="control-label"><small>Principal en Bs</small></label>
					<input readonly class="form-control input-sm margen-inputb" required id="txtmontoenvbs" name="txtmontoenvbs"/>
				</div>
				<div class="form-group col-md-3">
					<label for="inputtipocampais" class="control-label"><small>Tipo de cambio país destino</small></label>
					<input type="text" readOnly class="form-control input-sm margen-inputb" required id="tipocampais" name="tipocampais"/>
				</div>
				<div class="form-group col-md-3">
					<label for="inputcomisionwu" class="control-label"><small>Comisión Wu Bs.</small></label>
					<input type="text" readonly class="form-control input-sm margen-inputb" required  id="txtmontocom" name="txtmontocom" onkeyup="return funmontototal(this.form)"/>
				</div>
				<div class="form-group col-md-3">
					<label for="inputmontorecdest" class="control-label"><small>Monto a recibir en destino</small></label>
					<input readOnly type="text" class="form-control input-sm margen-inputb" required id="montorecdest" name="montorecdest"  onkeyup="puntos(this.value), chequear(this.form.montorecdest)" onblur="funfeeiquiry(this.form,2)"  /><!-- chequear(this.form.montorecdest),   onkeyup="puntos(this.value)"   onkeyup="chequear(this.form.montorecdest)"    onchange="funfeeiquiry(this.form)"-->
				</div>
				<div class="form-group col-md-3" >
					<label for="inputmontocobrar" class="control-label"><small>Monto a Cobrar</small></label>
					<input type="text" readonly class="form-control input-sm margen-inputb" required id="txtmontototalbs" name="txtmontototalbs" style="background-color:#DAEFDA;"/>
				</div>
				
				<div class="form-group col-md-12" >
					<label for="inputmsgbeneficiario" class="control-label"><small>Mensaje a Beneficiario</small></label>
					<textarea type="" maxlength="966"  class="form-control input-sm margen-inputb" id="msgbeneficiario" name="msgbeneficiario" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()" onkeydown="limpiaTexto(this.value,this.id)" onkeypress="return soloLetras(event)"></textarea>
				</div>
				<input type="hidden" name="motivobcv" id="motivobcv"/>

				
			</div>
		</div>
		</div>
	</div><!--Fin datos de envío-->
	
	<div class="progress" style="display:none">
		<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="100" aria-valuemax="100" style="width: 100%">
		</div>
	</div>
	
	<!--Formulario Pregunta y Respuesta-->
	<div class="col-md-10 col-md-offset-1" id="si-pregunta" style="display:none">
		<div class="panel panel-primary">
			<div class="panel-heading text-left ">
				<strong><small>PREGUNTA PRUEBA</small></strong>
			</div>
			<div class="panel panel-info">
				<div class="panel-heading">
					<strong><small>Por favor ingresar pregunta y respuesta prueba que desea enviar :</small></strong>
				</div>
				<div class=" panel-body">
					<div class="form-group col-md-6">
						<label for="inputpreunta" class="control-label"><small>Pregunta</small></label>
						<input class="form-control input-sm margen-inputb" maxlength="20" id="pregunta" name="pregunta" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()" onkeypress="return soloLetras(event)" onkeydown="limpiaTexto(event,this.value,this.id)"/>
					</div>
					<div class="form-group col-md-6">
						<label for="inputrespuesta" class="control-label"><small>Respuesta</small></label>
						<textarea type="" class="form-control input-sm margen-inputb" maxlength="19" id="respuesta" name="respuesta" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()";onkeypress="return soloLetras(event)" onkeydown="limpiaTexto(event,this.value,this.id)"></textarea><!--,limpiaTexto(this.form)  funciudad(this.value),funfeeiquiry(this.form), funmontototal(this.form)-->
					</div>
				</div>
			</div>
		</div>
	</div><!--Fin datos de envío-->
	
	
	<INPUT TYPE="hidden" name="tipotransaccion" id="tipotransaccion">
	
	
	
	
</div><!--fin div display:none!-->

<!--Mostrar ESTATUS es caso de que el cliente este inactivo-->
<div id="si-inactivo" style="display:none">


<!--Paso 3: Observaciones-->
	<div class="col-md-10 col-md-offset-1">
		<!--<div class="panel panel-primary">-->
			
		<!--</div>-->
		<div class="panel panel-info">
			<div class="panel-heading ">
				<strong><small>NOTAS</small></strong>
			</div>
			
			<table class="table table-hover table-bordered observ">
				<tr  class="active">
					<td><strong>#</strong></td>
					<td><strong>Observaciones</strong></td>
					<td><strong>Fecha</strong></td>
					<td><strong>Hora</strong></td>
					<td><strong>Usuario</strong></td>
					<td><strong>Oficina</strong></td>
				</tr>
			</table>
			<table class="table table-hover table-bordered noobserv" style="display:none">
				
			</table>
			<button type="button" style="display:none" class="btn btn-primary btn-xs alternar-todo">Ver menos...</button>
			<table class="table table-hover table-bordered observ1" style="display:none">
				<tr  class="active">
					<td><strong>#</strong></td>
					<td><strong>Observaciones</strong></td>
					<td><strong>Fecha</strong></td>
					<td><strong>Hora</strong></td>
					<td><strong>Usuario</strong></td>
					<td><strong>Oficina</strong></td>
				</tr>
			</table>
			<button type="button" class="btn btn-primary btn-xs alternar-todo">Ver más...</button>
			<button type="button" style="display:none" class="btn btn-primary btn-xs alternar-todo">Ver menos...</button>
		</div>
		<!--</div>-->
	</div>
<div class="col-md-10 col-md-offset-1" >
	<div class="panel panel-info">
		<div class="panel-heading ">
			<strong><small>ESTATUS DEL CLIENTE</small></strong>
		</div>
		<!-- Table -->
		<table >
		<tr>
		<td style="padding-left:3px;padding-right:3px;padding-top:3px;padding-bottom:3px">
			<button type="button" class="btn btn-default btn-xs" aria-label="Left Align" id="mas-estatus1">
				<span class="glyphicon glyphicon-plus" aria-hidden="true" id="mas-estatus"></span>
			</button>
			<button type="button" class="btn btn-default btn-xs" aria-label="Left Align" id="menos-estatus1" style="display:none">
				<span class="glyphicon glyphicon-minus" aria-hidden="true" id="menos-estatus"></span>
			</button>
		</td>
		<td id="nombrecliente" name="nombrecliente" class="nombrecliente"></td>
		</table>
		<table id="nombrecliente"></table>
		<table class="table table-hover table-bordered estatus" style="display:none">
			<tr class="active">
				<td><strong>#</strong></td>
				<td><strong>Estatus</strong></td>
				<td><strong>Fecha</strong></td>
				<td><strong>Hora</strong></td>
				<td><strong>Usuario</strong></td>
				<td><strong>Oficina</strong></td>
			</tr>
		
		</table>
		<table class="table table-hover table-bordered noestatus" >
		</table>
	</div>
</div><!--Fin de Estatus-->
</div>	
<!-- Mensaje en caso de que el cliente no exista-->
<div id="no-paso" style="display:none" class="text-center">
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-danger">
			<div class="panel-heading ">
				<strong>El Cliente debe tener huellas tomadas, Foto de Rostro y Foto de Documento Identidad,
por favor haga click AQUI, para completar los tres procesos y luego regrese a realizar la transacción</strong>
			</div>
		</div>
	</div>
</div>


<div class="alert alert-danger col-md-8 col-md-offset-2 text-center" id="nosolicitud" role="alert" style="display:none" >
  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  <span class="sr-only text-center" >Error:</span>
 El Cliente NO posee Solicitud Aprobada
</div>

<div class="alert alert-danger col-md-8 col-md-offset-2 text-center" id="msj-cliente" role="alert" style="display:none" >
  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  <span class="sr-only text-center" >Error:</span>
 
</div>

<!--<div id="nosolicitud" style="display:none" class="text-center">
	<div class="col-md-8 col-md-offset-2" >
		<div class="panel panel-danger">
			<div class="panel-heading ">
				<strong>El Cliente NO posee Solicitud Aprobada</strong>
			</div>
		</div>
	</div>
</div>-->

<div class="text-center col-md-8 col-md-offset-2" id="botonsubmit">
	<button type="submit" class="btn btn-primary btn-sm " id="btnsubmit" name="btnsubmit" disabled >Solicite autorización del BCV para transacción</button>
	<!--<input type="button" name="btnsubmit" class="btn btn-primary btn-sm "  value="Solicite autorización del BCV para transacción" id="btnsubmit" data-toggle="modal" data-target="#confirm-submit" />-->
</div>
<input type="hidden" name="nrosolicitud" id="nrosolicitud">
</form>

<div class="modal fade" style="margin-top:5%;"  id="modalrostro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> 
      </div>
      <div class="modal-body" align="center" id="modrostro"></div>
    </div>
  </div>
</div>

<div class="modal fade" style="margin-top:5%;"  id="modaldocumento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> 
      </div>
      <div class="modal-body" align="center" id="moddocumento">
	  </div>
    </div>
  </div>
</div>

<!-- Modal para mostrar los msjs del sistema -->
<div class="modal fade" style="margin-top:5%;" id="mensajemod" role="dialog">
	<div class="modal-dialog" >
		<!-- Modal content-->
	  <div class="modal-content" >
			<div class="modal-header text-center">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <span ><b>ATENCIÓN</b></span>
			</div>
			<div class="modal-body" align="left" id="mensaje"><br><br></div>
		</div>
	</div>
</div>

<div class="modal fade" style="margin-top:5%;" id="cargandoinfo" role="dialog">
	<div class="modal-dialog" role="document" >
		<!-- Modal content-->
	    <div class="modal-content" >
			<div class="modal-header text-center">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <span ><b>CARGANDO. POR FAVOR ESPERE</b></span>
			</div>
			<div class="modal-body" align="left" id="cargainfo"><br></div>
		</div>
	</div>
</div>

@endsection
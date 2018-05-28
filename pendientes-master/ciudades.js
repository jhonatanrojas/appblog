/*
 * Desarrollado por Yeisy Flames 17/08/2016
 */

//Funcion para autocompletar la Ciudad
$(function() {
	
	var est= $('#estado');
	var mun= $('#municipio');
	var parr= $('#parroquia');
	var cpos= $('#codpostal');
	var estofi= $('#estadoofi');
	var munofi= $('#municipioofic');
	var parrofi= $('#parroquiaofi');
	var cposofi= $('#codpostalofi');
	
    function split( val ) {
        return val.split( /,\s*/ );
    }
    function extractLast( term ) {
        return split( term ).pop();
	}
	
var aux, ciudadenvariosestados;


	$( "#ciudad" )
	//$( "#ciudadofi" )
	// don't navigate away from the field on tab when selecting an item
		.bind( "keydown", function( event ) {
			est.html('<option value="0">SELECCIONE CIUDAD</option>');
			 mun.html('<option value="0">SELECCIONE ESTADO</option>');
			parr.html('<option value="0">SELECCIONE MUNICIPIO</option>');
			cpos.val('');
			if ( event.keyCode === $.ui.keyCode.TAB &&
				$( this ).autocomplete( "instance" ).menu.active ) {
				event.preventDefault();
			}
		})
		.autocomplete({
			source: function( request, response) {
				//alert(JSON.stringify(request));
					var webservice= 'getCiudadWs';
					var pagina= 'orinoco/';
					var method= 'Get';
					var url= $("#cedula").data('url');
					var arrcampos= ['nbciudad'];
					var arrvar= [extractLast( request.term )];
					var data={webservice:webservice,pagina:pagina,method:method,campos:arrcampos,valores:arrvar};
					//alert(url);
					
					//alert(JSON.stringify(extractLast( request.term )));
					//var data={webservice:webservice,pagina:pagina,method:method,campos:arrcampos,valores:arrvar};
					$.ajax({
						 // url: "http://10.0.10.13/baaszoom/public/getCiudadWs",
						  dataType: "json",
						  type:'GET',
						  //data: {nbciudad: extractLast( request.term )},
						  url:url,
						  data:data,
						  success: function(ui) {
							// alert(JSON.stringify(ui)); //hacer alert de un json
							var datos= ui.entidadRespuesta;
							var unicaciudad = '';
							var array = new Array();
							$.each(ui.entidadRespuesta, function(i,ciu) {
								if(ciu.listc_nombre != unicaciudad){
								array[array.length] = { data: ui[i], 
											value : ciu.listc_nombre,
											codciudadzoom : ciu.listc_codigozoom,
											listc_nombre: ciu.listc_nombre,
											liste_codigo:  ciu.liste_codigo,
											liste_nombre:  ciu.liste_nombre,
											codp_municipio:  ciu.codp_municipio,
											listm_nombre:  ciu.listm_nombre,
											listprr_codigo:  ciu.listprr_codigo,
											listprr_nombre:  ciu.listprr_nombre,
											codp_codigo:  ciu.codp_codigo
										  };
								unicaciudad = ciu.listc_nombre;
								}
							});				
								//alert(JSON.stringify(array));
								//alert(JSON.stringify(ui.entidadRespuesta));
								if(array.length == 0)
								{
									array[0] = {
										value : 'No hay resultados',
										codciudadzoom : 0,
										listc_nombre: 'No hay resultados'
									};	
								}
							response( array );
							aux = datos;
						  }
						});
			
			},
			search: function() {
				// custom minLength
				//alert(this.value);
				var term = extractLast( this.value );
				//alert(term);
				if ( term.length < 2 ) {
					$('#codciudad').val("");
					return false;
				}
			},
            focus: function() {
                // prevent value inserted on focus
                return false;
            },
            select: function( event, ui ) {
                var terms = split( this.value );
				//alert(JSON.stringify(ui));
				// remove the current input
                terms.pop();//alert(terms);
                // add the selected item
                terms.push( ui.item.codciudadzoom);
				//alert(ui.item.codciudadzoom );
                // add placeholder to get the comma-and-space at the end
                terms.push( "" );
                //this.value = terms.join( ", " );

                if(ui.item.value != 'No hay resultados')
                {
                    this.value = ui.item.listc_nombre;
                    $('#codciudad').val(ui.item.codciudadzoom);
					//$('#codciudad1').val(ui.item.codciudadzoom);

                    unicaciudad = '';
                    var array = new Array(),ciudadregada = '';
                    ciudadenvariosestados = '';
                    $.each(aux, function(i,ciu) {
                        if(ciu.listc_nombre == ui.item.listc_nombre){
                            if (ciudadregada != ciu.listc_codigozoom)
                            {
                                ciudadregada = ciu.listc_codigozoom;

                                ciudadenvariosestados = ciudadenvariosestados + ciu.listc_codigozoom + ',';
                            }
                            unicaciudad = ciu.listc_nombre;
                        }
                    });

                    ciudadenvariosestados = ciudadenvariosestados.replace(/,\s*$/, "");
                    varest = ciudadenvariosestados.split(",").length == 0 ? false : ciudadenvariosestados.split(",");


					estados(aux,ui.item.codciudadzoom,ui.item.liste_codigo, ui.item.codp_municipio, ui.item.listprr_codigo, ui.item.codp_codigo, varest,valor=0 );
				}
                else
                {
					$('#codciudad').val('');
                }//estados(ui);
                return false;
			}
		});
		
		
		//$( "#ciudad" )
	$( "#ciudadofi" )
	// don't navigate away from the field on tab when selecting an item
		.bind( "keydown", function( event ) {
			estofi.html('<option value="0">SELECCIONE CIUDAD</option>');
			 munofi.html('<option value="0">SELECCIONE ESTADO</option>');
			parrofi.html('<option value="0">SELECCIONE MUNICIPIO</option>');
			cposofi.val('');
			if ( event.keyCode === $.ui.keyCode.TAB &&
				$( this ).autocomplete( "instance" ).menu.active ) {
				event.preventDefault();
			}
		})
		.autocomplete({
			source: function( request, response) {
					var webservice= 'getCiudadWs';
					var pagina= 'orinoco/';
					var method= 'Get';
					var url= $("#cedula").data('url');
					var arrcampos= ['nbciudad'];
					var arrvar= [extractLast( request.term )];
					//alert(arrvar);
					var data={webservice:webservice,pagina:pagina,method:method,campos:arrcampos,valores:arrvar};
				
					$.ajax( {
						 // url: "http://10.0.10.13/baaszoom/public/getCiudadWs",
						  dataType: "json",
						  type:'GET',
						  url:url,
						  data:data,
						  //data: {nbciudad: extractLast( request.term )},
						  success: function( ui ) {
							// alert(JSON.stringify(ui));
							var datos= ui.entidadRespuesta;
							var unicaciudad = '';
							var array = new Array();
							
							$.each(ui.entidadRespuesta, function(i,ciu) {
								if(ciu.listc_nombre != unicaciudad){
									array[array.length] = { data: ui[i], 
											value : ciu.listc_nombre,
											codciudadzoom : ciu.listc_codigozoom,
											listc_nombre: ciu.listc_nombre,
											liste_codigo:  ciu.liste_codigo,
											liste_nombre:  ciu.liste_nombre,
											codp_municipio:  ciu.codp_municipio,
											listm_nombre:  ciu.listm_nombre,
											listprr_codigo:  ciu.listprr_codigo,
											listprr_nombre:  ciu.listprr_nombre,
											codp_codigo:  ciu.codp_codigo,
										  };
									unicaciudad = ciu.listc_nombre;
								}
							});				
								//alert(JSON.stringify(array));
								//alert(JSON.stringify(ui.entidadRespuesta));
								if(array.length == 0)
								{
									array[0] = {
										value : 'No hay resultados',
										codciudadzoom : 0,
										listc_nombre: 'No hay resultados'
									};	
								}
							response( array );
							aux = datos;
						  }
						});
			
			},
			search: function() {
				// custom minLength
				//alert(this.value);
				var term = extractLast( this.value );
				//alert(term);
				if ( term.length < 2 ) {
					$('#codciudad').val("");
					return false;
				}
			},
            focus: function() {
                // prevent value inserted on focus
                return false;
            },
            select: function( event, ui ) {
                var terms = split( this.value );
				//alert(JSON.stringify(ui));
				// remove the current input
                terms.pop();//alert(terms);
                // add the selected item
                terms.push( ui.item.codciudadzoom);
				//alert(ui.item.codciudadzoom );
                // add placeholder to get the comma-and-space at the end
                terms.push( "" );
                //this.value = terms.join( ", " );

                if(ui.item.value != 'No hay resultados')
                {
					
                    this.value = ui.item.listc_nombre;
                   // alert(  $('#codciudad').val(ui.item.codciudadzoom));
					$('#codciudadofi').val(ui.item.codciudadzoom);
					unicaciudad = '';
                    var array = new Array(),ciudadregada = '';
                    ciudadenvariosestados = '';
                    $.each(aux, function(i,ciu) {
                        if(ciu.listc_nombre == ui.item.listc_nombre){
                            if (ciudadregada != ciu.listc_codigozoom)
                            {
                                ciudadregada = ciu.listc_codigozoom;

                                ciudadenvariosestados = ciudadenvariosestados + ciu.listc_codigozoom + ',';
                            }
                            unicaciudad = ciu.listc_nombre;
                        }
                    });

                    ciudadenvariosestados = ciudadenvariosestados.replace(/,\s*$/, "");
                    varest = ciudadenvariosestados.split(",").length == 0 ? false : ciudadenvariosestados.split(",");


					estados(aux,ui.item.codciudadzoom,ui.item.liste_codigo, ui.item.codp_municipio, ui.item.listprr_codigo, ui.item.codp_codigo, varest, valor=1);
				}
                else
                {
					$('#codciudad').val('');
                }//estados(ui);
                return false;
			}
		});
		
		
		function estados(datos,idciu, idest,idmun, idparr,idcodpostal, varest, valor)
		{
		//alert(valor);
			var $count =datos.length;
			var estadored = $("#estado");
			var municipiored = $("#municipio");
			var parroquiared = $("#parroquia");
			var codpostalred = $("#codpostal");
			
			var estadoofic = $("#estadoofi");
			var municipioofic = $("#municipioofi");
			var parroquiaofic = $("#parroquiaofi");
			var codpostalofic = $("#codpostalofi");
			
			
			//alert(JSON.stringify(datos));
			var unicoestado='', unicomunicipio='', unicaparroquia= '', estados= '', municipios='', parroquias='', codigopostal='', contestados=0, contest=0;

			$.each(datos, function(i,ciu)
			{
				if(ciu.liste_nombre != unicoestado && inArray(ciu.listc_codigozoom,varest) )//ciu.listc_codigozoom == idciu
				{ 
					unicoestado = ciu.liste_nombre;
					estados+= '<option value="'+ ciu.liste_codigo +'">'+ ciu.liste_nombre +'</option>';
					++contestados;
				}
				
				if(ciu.listm_nombre != unicomunicipio && ciu.liste_codigo == idest  )//&& ciu.liste_codigo == idest
				{  //alert('si');
					unicomunicipio = ciu.listm_nombre;
					municipios+= '<option value="'+ ciu.codp_municipio +'">'+ ciu.listm_nombre +'</option>';
				}

				if(ciu.listprr_nombre != unicaparroquia && ciu.codp_municipio == idmun )//&& ciu.codp_municipio == idmun
				{
					unicaparroquia = ciu.listprr_nombre;
					parroquias+= '<option value="'+ ciu.listprr_codigo +'">'+ ciu.listprr_nombre +'</option>';
					
				}
				
				if (ciu.codp_codigo != codigopostal && ciu.codp_codigo == idcodpostal  )// && ciu.codp_codigo == idcodpostal
				{	codigopostal = ciu.codp_codigo;
					cp= ciu.codp_codigo;
					//++contcodpostal;
				}
				
			});
			if (valor==0)
			{
				estadored.html(estados);

			}
			if (valor==1)
			{
				estadoofic.html(estados);
			}
			//$('#municipio').html(municipios);
			
			$('#codpostal').val('');
			
			//$('#codpostal').val('');
			//$('#municipio').html('<option value="0">SELECCIONE ESTADO</option>');
			//$('#parroquia').html('<option value="0">SELECCIONE MUNICIPIO</option>');
			if (valor==0)
			{
				//alert(contestados);
				if (contestados == 1 )
				{
					
					$('#estado').change()
					
					$('#municipio').html(municipios);
					$('#parroquia').html(parroquias);
					$('#codpostal').val(cp);
				}
				if (contestados > 1 )
				{
				
				$('#municipio').html(municipios);
				$('#parroquia').html('<option value="0">SELECCIONE MUNICIPIO</option>');
				$('#codpostal').val('');
				
				}
			}
			
			if (valor==1)
			{
				if (contestados == 1 )
				{
					$('#estadoofi').change()
					$('#municipioofic').html(municipios);
					$('#parroquiaofi').html(parroquias);
					$('#codpostalofi').val(cp);
				}
				if (contestados > 1 )
				{
				
				$('#municipioofic').html(municipios);
				$('#parroquiaofi').html('<option value="0">SELECCIONE MUNICIPIO</option>');
				$('#codpostalofi').val('');
				
				}
			}
		//}
		
			$('#estado').change(function(){
			
			var estado = $(this).val();
			var datos = aux, munis='', unicomunicipio='';
			var contmunicipio=0;
			$.each(datos, function(i,ciu) 
			{
				if (ciu.listm_nombre != unicomunicipio )
				{	unicomunicipio = ciu.listm_nombre;
					if(ciu.liste_codigo==estado )//&& ciu.listc_codigozoom==$('#codciudad').val()
					{
						munis+='<option value="' + ciu.codp_municipio + '">' + ciu.listm_nombre + '</option>';
						++contmunicipio;
					}
				}
			});
			
			$('#municipio').html('<option value="0">SELECCIONE MUNICIPIO</option>');
			$('#parroquia').html('<option value="0">SELECCIONE MUNICIPIO</option>');
			$('#codpostal').val('');
			//alert(contmunicipio);
			if (valor==0)
			{
				if (contmunicipio == 1)
				{ 
					$('#municipio').append(munis);
					$('#parroquia').html(parroquias);
					$('#parroquia').html('<option value="0">SELECCIONE MUNICIPIO</option>');
					$('#codpostal').val();
				}
				
				if (contmunicipio > 1)
				{
					$('#municipio').html(munis);
					$('#parroquia').html('<option value="0">SELECCIONE MUNICIPIO</option>');
					$('#codpostal').val('');
				}
			}
			});
			
			$('#estadoofi').change(function(){
			
				var estado = $(this).val();
				var datos = aux, munis='', unicomunicipio='';
				var contmunicipio=0;
				$.each(datos, function(i,ciu) 
				{
					if (ciu.listm_nombre != unicomunicipio )
					{	unicomunicipio = ciu.listm_nombre;
						if(ciu.liste_codigo==estado )//&& ciu.listc_codigozoom==$('#codciudad').val()
						{
							munis+='<option value="' + ciu.codp_municipio + '">' + ciu.listm_nombre + '</option>';
							++contmunicipio;
						}
						
					}
				});
				
				if (valor==1)
				{ 
					if (contmunicipio == 1)
					{ //alert(JSON.stringify(munis));//alert(contmunicipio);
						$('#municipioofic').html('<option value="0">SELECCIONE ESTADO</option>'+ munis);
						$('#parroquiaofi').html(parroquias);
						$('#parroquiaofi').html('<option value="0">SELECCIONE MUNICIPIO</option>');
						$('#codpostalofi').val();
					}
					
					if (contmunicipio > 1)
					{ //alert('es mayor a 1');
						$('#municipioofic').html(munis);
						$('#parroquiaofi').html('<option value="0">SELECCIONE MUNICIPIO</option>');
						$('#codpostalofi').val('');
					}
				}
			});
			
			$('#municipio').change(function(){
				var municipio = $(this).val();
				//alert(municipio);
				unicaparroquia= '';
				var contparroquia=0;
				var datos = aux, parro='';
				$.each(datos, function(i,ciu)
				{
					if (ciu.listprr_nombre != unicaparroquia )
					{	unicaparroquia = ciu.listprr_nombre;
						if(ciu.codp_municipio==municipio)
						{
							parro+= '<option value="' + ciu.listprr_codigo + '">' + ciu.listprr_nombre + '</option>';
							++contparroquia;
						}
					}
				});
				$('#parroquia').html(parro);
				
				//$('#parroquia').html('<option value="0">SELECCIONE MUNICIPIO</option>');
				$('#codpostal').val('');
					
				if (valor==0)
				{
					if (contparroquia == 1)
					{
						$('#parroquia').change()
					}
					if (contparroquia > 1)
					{
						$('#parroquia').html(parro);
						$('#codpostal').val('');
					}
				}
			});
			
			$('#municipioofic').change(function(){
				var municipio = $(this).val();
				//alert(municipio);
				unicaparroquia= '';
				var contparroquia=0;
				var datos = aux, parro='';
				$.each(datos, function(i,ciu)
				{
					if (ciu.listprr_nombre != unicaparroquia )
					{	unicaparroquia = ciu.listprr_nombre;
						if(ciu.codp_municipio==municipio)
						{
							parro+= '<option value="' + ciu.listprr_codigo + '">' + ciu.listprr_nombre + '</option>';
							++contparroquia;
	
						}
					}
				});
				$('#parroquiaofi').html(parro);
				
				if (valor==1)
				{
					if (contparroquia == 1)
					{
						$('#parroquiaofi').change()
						//Z$('#codpostal').val();
					}
					if (contparroquia > 1)
					{
						$('#parroquiaofi').html(parro);
						$('#codpostalofi').val('');
					}
				}
			});
		
			$('#parroquia').change(function(){
				var parroquia = $(this).val();
				var datos= aux, codigopostal='', contcodpostal=0;
				$.each(datos, function(i,ciu) 
				{
					if (ciu.codp_codigo != codigopostal )
					{	codigopostal = ciu.codp_codigo;
						if(ciu.listprr_codigo==parroquia)
						{
							copost= ciu.codp_codigo;
							++contcodpostal;
						}
					}
				});
				cpos.val(copost);
				
				if (valor==0)
				{
					if (contcodpostal == 1)
					{
						$('#codpostal').change()
						//$('#codpostal').val(copost)
					}
				}
			});
			
			$('#parroquiaofi').change(function(){
				var parroquia = $(this).val();
				var datos= aux, codigopostal='', contcodpostal=0;
				$.each(datos, function(i,ciu) 
				{
					if (ciu.codp_codigo != codigopostal )
					{	codigopostal = ciu.codp_codigo;
						if(ciu.listprr_codigo==parroquia)
						{
							copost= ciu.codp_codigo;
							++contcodpostal;
						}
					}
				});
				cposofi.val(copost);
				if (valor==1)
				{
				
					if (contcodpostal == 1)
					{
						$('#codpostalofi').change()
						$('#codpostalofi').val(copost)
					}
				}
			});
		}

    function inArray(needle, haystack) {
        var length = haystack.length;
        for(var i = 0; i < length; i++) {
            if(haystack[i] == needle) return true;
        }
        return false;
    }
});

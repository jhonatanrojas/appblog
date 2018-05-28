@php

    function listSelect2($arr,$val1,$val2,$selected=false,$sel=false,$alt=false){

            $seleccione='';
            if($sel) $seleccione='<option value="0">SELECCIONE</option>';
            $opt=false;
            foreach($arr as $key=>$val){
                if(!empty($val[$val1])){
                    $opt.='<option value="'.$val[$val1].'"';
                    if($selected==$val[$val1]) $opt.=' selected';
                    if($alt !== false) $opt.= ' title="'.$val[$val2].'"';

                    $opt.='>'.$val[$val2].'</option>';
                }
            }
            if($opt&&$seleccione) $opt = $seleccione.$opt;
            return $opt;
        }

    function getEstadocivil($estciv=false){
    $estadocivil = array(1 =>array("estcivil"=>"SOLTERO"),
    2 =>array("estcivil"=>"CASADO"),
    3 =>array("estcivil"=>"VIUDO"),
    4 =>array("estcivil"=>"DIVORCIADO")
    );//print_r($estadocivil);
    $estadocivil = listSelect2($estadocivil,'estcivil','estcivil',$estciv,1);
    return $estadocivil;
    }
@endphp
@extends('layouts.PortalCcz.masterCcz2')
@section('content')




    <div class="row">
        <div class="col-sm-12 col-sm-12 container">
            <div class="col-sm-12 col-md-2">
                <div style="margin-top: 50px;" class="btn-group-vertical">
                    <a data-toggle="tab" href="#home" style="text-align: left;" type="button" class="btn btn-default">Ficha de Cliente</a>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            Compra de Divisas <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Solicitudes</a></li>
                            <li><a href="#">Historial de Solicitudes</a></li>
                        </ul>
                    </div>
                    {{--<button style="text-align: left;" type="button" class="btn btn-default">Compra de Divisas</button>--}}

                    <a data-toggle="tab" href="#menu4" style="text-align: left;" type="button" class="btn btn-default">Modificar Datos</a>
                    <a href="{{ route('PortalCcz.logout') }}" style="text-align: left;" type="button" class="btn btn-default">Cerrar Sessión</a>
                </div>

            </div>
            <div class="col-sm-12 col-md-10">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home">Inicio</a></li>
                    <li><a data-toggle="tab" href="#menu1">Paso 1</a></li>
                    <li><a data-toggle="tab" href="#menu2">Paso 2</a></li>
                    <li><a data-toggle="tab" href="#menu3">Paso 3</a></li>
                    <li><a data-toggle="tab" href="#menu4">Paso 4</a></li>
                    <li><a data-toggle="tab" href="#menu5">RESUMEN</a></li>
                </ul>

                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        {{--<h3>INICIO</h3>
                        <p>Some content.</p>--}}
                        @include('layouts.PortalCcz.masterCcz-inicio')
                    </div>
                    <div id="menu1" class="tab-pane fade">
                        @include('layouts.PortalCcz.masterCcz-paso1')
                    </div>
                    <div id="menu2" class="tab-pane fade">
                        <h3>Menu 2</h3>
                        <p>Some content in menu 2.</p>
                    </div>
                    <div id="menu3" class="tab-pane fade">
                        <h3>Menu 3</h3>
                        <p>Some content in menu 3.</p>
                    </div>
                    <div id="menu4" class="tab-pane fade">
                        <h3>Menu 4</h3>
                        <p>Some content in menu 4.</p>
                    </div>
                    <div id="menu5" class="tab-pane fade">
                        <h3>RESUMEN</h3>
                        <p>Some content in menu 5.</p>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <div class="modal fade" id="pleaseWaitDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true" style="margin-top: 150px;">
        <div class="vertical-alignment-helper">
            <div class="modal-dialog vertical-align-center">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Por favor espere...</h4>
                    </div>
                    <div class="modal-body">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40"
                                 aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                <span class="sr-only">40% Complete (success)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        function formato(texto){
            return texto.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');
        }

        function getInfotipodocwuWs(){
            var ws_getInfoClientewuWs= 'getInfotipodocwuWs';
            var url= '<?php print  route("getConsumirAjax");?>';
            var codtipodocwu="{{Session::get('LoginPR.0.tipodocumento')}}";
            var arrcampospag= ['codtipodocwu'];
            var arrvarpag= [codtipodocwu];
            var pagina= 'orinoco/';
            var method= 'Get';
            var data={webservice:ws_getInfoClientewuWs,pagina:pagina,method:method,campos:arrcampospag,valores:arrvarpag};
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url:url,
                data:data,
                async:false,
                success: function(data)
                {
                    if(data.codrespuesta=="COD_000"){
                        var datos=JSON.parse(JSON.stringify(data.entidadRespuesta));
                            //document.getElementById("cmbpaisnac").innerHTML += "<option value='"+datos[i].codpais+"'>"+datos[i].nombre+"</option>";
                        //alert(datos[0].siglas);
                            $('#identificacion').val(datos[0].siglas+'-{{Session::get('LoginPR.0.rifci')}}');

                    }
                }
            });//Fin web service
        }

        function getPaisWs(){
            var ws_getInfoClientewuWs= 'getPaisWs';
            var url= '<?php print  route("getConsumirAjax");?>';
            var codpais="ALL";
            var arrcampospag= ['codpais'];
            var arrvarpag= [codpais];
            var pagina= 'orinoco/';
            var method= 'Get';
            var data={webservice:ws_getInfoClientewuWs,pagina:pagina,method:method,campos:arrcampospag,valores:arrvarpag};
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url:url,
                data:data,
                async:false,
                success: function(data)
                {
                    if(data.codrespuesta=="COD_000"){
                       var datos=JSON.parse(JSON.stringify(data.entidadRespuesta));
                        for(var i in datos)
                        {
                            document.getElementById("cmbpaisnac").innerHTML += "<option value='"+datos[i].codpais+"'>"+datos[i].nombre+"</option>";
                        }
                    }
                }
            });//Fin web service
        }
 
        function getGeneroWs(){
            var ws_getInfoClientewuWs= 'getGeneroWs';
            var url= '<?php print  route("getConsumirAjax");?>';
            var codgenero="ALL";
            var arrcampospag= ['codgenero'];
            var arrvarpag= [codgenero];
            var pagina= 'orinoco/';
            var method= 'Get';
            var data={webservice:ws_getInfoClientewuWs,pagina:pagina,method:method,campos:arrcampospag,valores:arrvarpag};
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url:url,
                data:data,
                async:false,
                success: function(data)
                {
                    if(data.codrespuesta=="COD_000"){
                        var datos=JSON.parse(JSON.stringify(data.entidadRespuesta));
                        for(var i in datos)
                        {
                            document.getElementById("cmbgenero").innerHTML += "<option value='"+datos[i].codgenero+"'>"+datos[i].nombre+"</option>";
                        }
                    }
                }
            });//Fin web service
        }

        function getGentiliciowuWs(){
            var ws_getInfoClientewuWs= 'getGentiliciowuWs';
            var url= '<?php print  route("getConsumirAjax");?>';
            var codgentilicio="ALL";
            var arrcampospag= ['codgentilicio'];
            var arrvarpag= [codgentilicio];
            var pagina= 'orinoco/';
            var method= 'Get';
            var data={webservice:ws_getInfoClientewuWs,pagina:pagina,method:method,campos:arrcampospag,valores:arrvarpag};
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url:url,
                data:data,
                async:false,
                success: function(data)
                {
                    if(data.codrespuesta=="COD_000"){
                        var datos=JSON.parse(JSON.stringify(data.entidadRespuesta));
                        for(var i in datos)
                        {
                            document.getElementById("cmbgentilicio").innerHTML += "<option value='"+datos[i].codgentilicio+"'>"+datos[i].nombre+"</option>";
                        }
                    }
                }
            });//Fin web service
        }



   //Elegir ciudad
    	///////////////////////////////////////////////////////////////////////////////////
	//                      Funcion Elegir Ciudad Jhonatan Rojas 21.05.2018    //
	///////////////////////////////////////////////////////////////////////////////////
function elegirciudad()
{
  var ciudad = $('#cmbciudad').val();
//  alert(codestado);
  var webservice = "getCiudadesws";
  var pagina = 'orinoco/';
  var method = 'Get';
  var url = '{{route("getConsumirAjax")}}';
  var arrcampos = ['filtro'];
  var arrvar = ["origen"];

  //alert(selectconsultar);
  var data = {webservice: webservice, pagina: pagina, method: method, campos: arrcampos, valores: arrvar};
console.log(data);

    
         
        $.ajax({
                    type: "GET",
                    //headers: {'X-CSRF-TOKEN': token},
                    url: url,
                    data: data,
                    datatype: 'JSON',
                    success: function (data) {
                
               


 
                        var datos=JSON.parse(JSON.stringify(data.entidadRespuesta));
                        console.log(datos);
                        for(var i in datos)
                        {
                            document.getElementById("ciudad").innerHTML += "<option   value='"+datos[i].nombre_ciudad+"'>"+datos[i].nombre_ciudad+"</option>";

                                            } 





                                                }

                });

            }//Fin web service

       
 	///////////////////////////////////////////////////////////////////////////////////
	//                      Funcion Elegir Estado Jhonatan Rojas 21.05.2018    //
	///////////////////////////////////////////////////////////////////////////////////

 //Elegir Estado
 
 function selectciudad(ciudadre)
{
  //Elegir Estado
        var ciudadnoes = "SANTA BARBARA DEL ZULIA";
        var nciudad;
        if(ciudadre===""){
         
        nciudad= $('#cmbciudad').val();
        if(nciudad=="undefined"){  nciudad="ALL";}

        
        }else{ nciudad= ciudadre;}
       
        if(codedo=="undefined"){

        codedo= "ALL";

}
        if(nciudad === ciudadnoes)  {nciudad="MARACAIBO"; } 
                              

//  alert(codestado);
 // var webservice = "getInfoCiudadWs";
   var webservice = "getCiudadWs";
  var pagina = 'orinoco/';
  var method = 'Get';
  var url = '{{route("getConsumirAjax")}}';

   //  var arrcampos = ['codestado','codciudad','nbciudad'];
    //var arrvar = [codedo,'ALL',nciudad];
 var arrcampos = ['nbciudad'];
var arrvar = [nciudad];
  //alert(selectconsultar);
  var data = {webservice: webservice, pagina: pagina, method: method, campos: arrcampos, valores: arrvar};
  //console.log(data);

         
     
        $.ajax({
                    type: "GET",
                    //headers: {'X-CSRF-TOKEN': token},
                    url: url,
                    data: data,
                    datatype: 'JSON',
                    success: function (data) {
                      
                      var datos=JSON.parse(JSON.stringify(data.entidadRespuesta));
                      
                      if(data.codrespuesta=="COD_000"){         
                        var sel = document.getElementById("x_est");
                            console.log(data);
                        //se eliman los select
                        $('#x_est option').each(function() {
   
                                 $(this).remove();

                                  });
                        
                $('#x_mun option').each(function() {
   
                     $(this).remove();

                                });

  
    
                      
                                    var ciudad =datos[0].listc_nombre;
                            var estado =  datos[0].liste_nombre; 
                            var codestado = datos[0].liste_codigo;
                            var codmun = datos[0].codp_municipio;
                            $('#codestado').val(codestado);
                            
                       
                     //      console.log(datos);

                          //   if(codestado !== '15'|| codestado !== '2' ){
                               
                               // document.getElementById("x_est").innerHTML += "<option  value='"+codestado+"'>"+estado+"</option>";

                                                      document.getElementById("x_est").innerHTML += "<option value='"+datos[0].liste_codigo+"'>"+datos[0].liste_nombre+"</option>";

                                for(var i in datos)
                        {
                        //    document.getElementById("x_mun").innerHTML += "<option value='"+datos[i].listprr_codigo+"'>"+datos[i].listm_nombre+"</option>";


                        }
                             
                              

                        
          
             elegirmunicipio(codestado);
             getInfoMunicipioWs(codestado, codmun );
                    $('#x_est').change(function(){

                    var codedo = $('#x_est').val();
                    console.log(codedo);
                    $('#x_mun option').each(function() {

                    $(this).remove();

                    });
                    elegirmunicipio(codestado);

             }) 





                                            }

                                            }


                                            });


           
            //Elegir Estado

                 }//Fin web service */


   	///////////////////////////////////////////////////////////////////////////////////
	//                      Funcion Elegir Municipio Jhonatan Rojas 21.05.2018    //
	///////////////////////////////////////////////////////////////////////////////////
 function elegirmunicipio(codestado)
{
  /*
    var personas = [
        {name: "paco", edad:23},
        {name: "paco", edad:23},
  
    ];

    var persona = {};
    var unicos = personas.filter(function (e) { 
        return persona[e.name] ? false : (persona[e.name] = true);
    });

    console.log(unicos);
*/

 //Elegir Municipio
                       
                        var nciudad= $('#cmbciudad').val();
        

                //  alert(codestado);
            var webservice = "getInfoMunicipioWs";
            var pagina = 'orinoco/';
            //var webservice = "getCiudadWs";

            var method = 'Get';
            //headers: {'X-CSRF-TOKEN': token},
            var url = '{{route("getConsumirAjax")}}';
            //var arrcampos = ['nbciudad'];
            //var arrvar = [nciudad];
            var arrcampos = ['codestado','codciudad','codmunicipio'];
            var arrvar = [codestado,'ALL','ALL'];
            //alert(selectconsultar);
            var data = {webservice: webservice, pagina: pagina, method: method, campos: arrcampos, valores: arrvar};

            
        $.ajax({
                    type: "GET",
                    //  headers: {'X-CSRF-TOKEN': token},
                    url: url,
                    data: data,
                    datatype: 'JSON',
                    beforeSend: function(data){
                    $("#x_mun").html("<option>Cargando...<option>");
                    },


                    success: function (data) {
                 // console.log(data);
                    var datos=JSON.parse(JSON.stringify(data.entidadRespuesta));
                    if(data.codrespuesta=="COD_000"){         
                    $('#x_mun option').each(function() {

                    $(this).remove();

                    });
                    for(var i in datos)
                    {

                    var municipio =  datos[i].listm_nombre; 
                    var codmunicipio = datos[i].codp_municipio;

                             
                              
                            document.getElementById("x_mun").innerHTML += "<option value='"+codmunicipio+"'>"+municipio+"</option>";

                        }
            
                             }                      
                                    }
 

                                     });
                                        //Elegir Municipio

 
                                            }//Fin web service


    ///////////////////////////////////////////////////////////////////////////////////
	//                      Funcion Elegir Parroquia Jhonatan Rojas 22.05.2018    //
	///////////////////////////////////////////////////////////////////////////////////
        function elegirParroquia()
{

        $('#x_par option').each(function() {

        $(this).remove();

                 });
  //alert(selectconsultar);
        
          
            var nombciudad=$('#cmbciudad').val();  
            var codestado=$('#x_est').val();   
            var idmucinipio=$('#x_mun').val(); 


                //Se consulta la parroquia segun la Ciudad y el Municipio

                //----------------------------------------------------------------

            var webservice = "getCiudadWs";
            var arrcampos = ['nbciudad'];
            var arrvar = [nombciudad];
               // var webservice = "getInfoParroquiaWs";
                var pagina = 'orinoco/';
                var method = 'Get';
                //headers: {'X-CSRF-TOKEN': token},
                var url = '{{route("getConsumirAjax")}}';
               // var arrcampos = ['codciudad','codmunicipio','codparroquia'];
                //var arrvar = [codciudad,idmucinipio,'0'];

                //alert(selectconsultar);
                var data = {webservice: webservice, pagina: pagina, method: method, campos: arrcampos, valores: arrvar};
               // console.log(data);

        $.ajax({
                type: "GET",
                //  headers: {'X-CSRF-TOKEN': token},
                url: url,
                data: data,
                datatype: 'JSON',
                beforeSend: function(data){
                    $("#x_par").html("<option>Cargando...<option>");
                    },
                success: function (data) {
             //  console.log(data);
                var datos=JSON.parse(JSON.stringify(data.entidadRespuesta));

                if(data.codrespuesta=="COD_000"){         

                $('#x_par option').each(function() {$(this).remove();});

                for(var i in datos)
                {

                var codigoparr =  datos[i].listprr_codigo; 
                var nomparroquia = datos[i].listprr_nombre;

                //Se asigna el Valor al Selec

                    document.getElementById("x_par").innerHTML += "<option value='"+codigoparr+"'>"+nomparroquia+"</option>";

                    }

                    }else{   $('#x_par option').each(function() {$(this).remove();});  document.getElementById("x_par").innerHTML += "<option value='0'>Seleccione un Municipio</option>";
                    }
                                                               
                         }
 
    });




 

}// Fin Elegir Parroquia
//----------------------------------------------------------------



function getInfoMunicipioWs(codestado,idmucinipio){
 

 var webservice = "getInfoMunicipioWs";
 var pagina = 'orinoco/';
 var method = 'Get';
 //headers: {'X-CSRF-TOKEN': token},
 var url = '{{route("getConsumirAjax")}}';
 var arrcampos = ['codestado','codciudad','codmunicipio'];
 var arrvar = [codestado,'ALL',idmucinipio];
 var data = {webservice: webservice, pagina: pagina, method: method, campos: arrcampos, valores: arrvar};
 //console.log(data);
 $.ajax({
         type: "GET",
       //  headers: {'X-CSRF-TOKEN': token},
         url: url,
         data: data,
         datatype: 'JSON',
 
         
 
         success: function (data) {
       //  console.log(data);
           var datos=JSON.parse(JSON.stringify(data.entidadRespuesta));
           
           if(data.codrespuesta=="COD_000"){ 
 
 
    
 
         }
                     }
                     
 });
 
 }








        ///////////////////////////////////////////////////////////////////////////////////
	//                      Funcion Consultar Codigo Telefono Jhonatan Rojas 22.05.2018    //
	///////////////////////////////////////////////////////////////////////////////////
    function codigoTelefono(codpais){


            var webservice = "getInfoTipoTelefonicaWs";
            var pagina = 'canguroazul/';
            var method = 'Get';
            //headers: {'X-CSRF-TOKEN': token},
            var url = '{{route("getConsumirAjax")}}';

            var arrcampos = ['codpais'];
            var arrvar = [codpais];
            var data = {webservice: webservice, pagina: pagina, method: method, campos: arrcampos, valores: arrvar};
           // console.log(data);
 $.ajax({
                    type: "GET",
                  //  headers: {'X-CSRF-TOKEN': token},
                    url: url,
                    data: data,
                    datatype: 'JSON',
       
                    

                    success: function (data) {
                  //  console.log(data);
                      var datos=JSON.parse(JSON.stringify(data.entidadRespuesta));
                      if(data.codrespuesta=="COD_000"){ 


                                 for(var i in datos)
                {

                   
                   document.getElementById("cmbsms").innerHTML += "<option value='"+datos[i].codigouno+"'>"+datos[i].codigouno+"</option>";
                   document.getElementById("cmbsms").innerHTML += "<option value='"+datos[i].codigodos+"'>"+datos[i].codigodos+"</option>";

                           /*      $('#cmbsms').append("<option   value='"+datos[i].codigouno+"'>"+datos[i].codigouno+"<option>");
                                    $('#cmbsms').append("<option   value='"+datos[i].codigodos+"'>"+datos[i].codigodos+"<option>");


                     
                            */  
                            //    $('#cmbsms').append("<option  selected='selected' value='"+codigodos+"'>"+codigodos+"<option>");         
                //Se asigna el Valor al Selec
                               
                        }

                    }
                                }
                                
 });

 }

   

        
        
 


        $(document).ready(function(){


      

                   

                       


            var pleaseWait = $('#pleaseWaitDialog');

            showPleaseWait = function () {
                pleaseWait.modal({
                    backdrop: 'static',
                    keyboard: false,
                    option: 'show'  
                });
            };

            hidePleaseWait = function () {
                pleaseWait.modal('hide');
            };

            showPleaseWait();
            elegirciudad();
           
           // codestado = $('#x_est').val();
           elegirParroquia();
            getInfotipodocwuWs();
            getPaisWs();
            getGeneroWs();
            getGentiliciowuWs();
            elegirParroquia();
        $('#x_mun').change(function(){
            elegirParroquia();
        });
        
        $('#x_est').change(function(){
            elegirParroquia();
        });
            $('#cmbciudad').change(function(){
                var nc="";
               // elegirestado(nc);
                elegirParroquia();

                var estadon=  $('#cmbciudad').val();
               
if(estadon === ""){
    $('#x_par option').each(function() {

$(this).remove();

         });

$('#x_est option').each(function() {
   
        $(this).remove();
    
});
$('#x_mun option').each(function() {
   
   $(this).remove();

});


}


            });
            var ws_getInfoClientewuWs= 'getInfoClientewuWs';
            var url= '<?php print  route("getConsumirAjax");?>';
            var codtipocli="{{Session::get('LoginPR.0.tipodocumento')}}";
            var rifcicli="{{Session::get('LoginPR.0.rifci')}}";

            var arrcampospag= ['codtipoidcli','rifcicli'];
            var arrvarpag= [codtipocli,rifcicli];
            var pagina= 'orinoco/';
            var method= 'Get';
            var data={webservice:ws_getInfoClientewuWs,pagina:pagina,method:method,campos:arrcampospag,valores:arrvarpag};

            $.ajax({
                type: 'GET',
                dataType: 'json',
                url:url,
                data:data,
                success: function(data)
                {
                    hidePleaseWait();
                    if(data.codrespuesta=="COD_000"){
                        var datos=JSON.parse(JSON.stringify(data.entidadRespuesta));
                 //  console.log(JSON.stringify(data.entidadRespuesta));
                        $('#txtdireccionresd').val(datos.direccion);
                      //  $('#cmbciudad').val(datos.ciudadresd);
                        var datosdireccion =  datos.codestmunparcop.split(',');
                       
                        var codciudad= datos.ciudadresd;
                        //var codedo=datosdireccion[0];

                      //  elegirestado(codciudad);
                        //elegirmunicipio(codedo);
     
                       
                        codigoTelefono(datos.codpaisnac);
                        $('#txtfechanac').val(formato(datos.fechanac));
                        $('#cmbpaisnac').val(datos.codpaisnac);
                        $('#txtlugarnac').val(datos.lugarnac);
                        $('#cmbgenero').val(datos.codgenero);
                        $("#cmbgentilicio").find('option:contains("'+datos.nacionalidad+'")').prop('selected', true);
                        $("#cmbedocivil").find('option:contains("'+datos.estadocivil+'")').prop('selected', true);
                    }
                }
            });//Fin web service

         

        });


    </script>

@endsection
@extends('admin.template.main');

@section('title')
Articulos

@endsection



@section('contect')


<div class="row">
	<div class="col-md-12" style=" -webkit-border-radius: 0 0 6px 6px;-moz-border-radius: 0 0 6px 6px;border-radius: 0 0 6px 6px;-webkit-box-shadow: 0 1px 2px rgba(0,0,0,.15);-moz-box-shadow: 0 1px 2px rgba(0,0,0,.15);box-shadow: 0 1px 2px rgba(0,0,0,.15);">
        <div class="row">
            <div class="col-md-12 page-header well" >
                <h5  style="text-align:center"><b>DATOS PERSONALES</b></h5 >
            </div>
         </div>
        <form name="frmdp" id="frmdp" method="post" class="cmxform">
        

        <div class="row">
            <br>
            <div class="col-md-12  well" >
                <h5  style="text-align:center"><b>DIRECCIÓN DE RESIDENCIA</b><br><small>(Debe coincidir con la direcci&oacute;n cargada en el RIF)</small></h5 >
              
            </div>
                   <!-- <span class="help-block">Direcci&oacute;n de Residencia (Debe coincidir con la direcci&oacute;n cargada en el RIF)</span> -->
            
        </div>
        <div class="row">
                <div class="col-md-12 " >
                      
                        <div class="alert alert-info" style=" padding-bottom: 5px !important;">

                        <span class="help-block" style=""> <b>*</b> En el campo "Ciudad" deber&aacute; escribir su ciudad de residencia, se desplegar&aacute; un listado para seleccionar la ciudad que corresponda, haga clic o presione la tecla Enter.</span>
                    </div>
                    </div>
                
            </div>
         

          
        <div class="row"  ><!-- row identificación 4 -->
            <div class="col-md-3">
                    
                    <div class="form-group">
                   
                            <label >Ciudad: </label>
        
                            <input type="text" class="form-control mayus requerido" 
                            value=""  name="cmbciudad"
                            id="cmbciudad"
                            tabindex="7" 
                            list="ciudad"
                            data-type=''
                            >
                          </div>
                          <input type="hidden" name="codciudadresd" id="codciudadresd" />
                          <input type="hidden"  id="codciudadofi" name="codciudadofi" />

                          <datalist id="ciudad"> 
                           

                          </datalist>
                         
                          </div>
                        
         
         
            <div class="col-md-3">
                     <div class="form-group">
                        <label for="">Estado:</label>
       

                        <select class="form-control requerido" name="listm_relacion" id="estado"    tabindex="8"  >
                            @foreach($estados as $estado)
                        <option value="{{$estado->liste_codigo}}" data-type=''>{{$estado->liste_nombre}} </option>

                                       @endforeach
          
                      
                         </select>
                         <input type="hidden" name="codestadi" id="codestado" />

                      </div>
                      
         
            </div>
           
         
                     <div class="col-md-3">
                     <div class="form-group">
                        <label for="">Municipio:</label>
                        <select class="form-control requerido" name="x_mun" id="x_mun"   
                       tabindex="9" >
                       <option value="0">Seleccione Estado</option>

                         </select>
                        
                      </div>
                     </div>
         

                     <div class="col-md-3">
                        <div class="form-group">
                           <label for="">Parroquia:</label>
                           <select class="form-control requerido" name="x_par" id="x_par"   
                          tabindex="10" >
                          <option value="0">Seleccione Municipio</option>

                            </select>
                           
                         </div>
                        </div>
         </div><!-- /row identificación 4-->
        

         <div class="row"  ><!-- row identificación 5 -->
            <div class="col-md-3 ">
                <div class="form-group">
                    <label >Código Postal</label>

                    <input type="text" class="form-control numero requerido "
                  
                    value=""  name="codpostal"
                    id="codpostal"
                    maxlength="4" tabindex="11" >


                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="Genero">Teléfono:</label>

                    <input type="text" class="form-control requerido  minimus"
                  
                    value=""  name="txttelefonoresd"
                    id="txttelefonoresd"
                    maxlength="12" tabindex="12" 
                    onkeyup="mascara(this,'-',patrontelefono,true)" 
                    >


                </div>
            </div>
           
           <!-- <div class="col-md-1"  style="padding-right:0 !important;margin-right:0 !important;">
                    <label >Cod</label>
                    <div class="input-group" >

                            <select class="  requerido form-control"  name="cmbsms" id="cmbsms" style="padding-right:0 !important; padding-left:0 !important; width:100  !important%;" >
                                    
                            </select>
                          </div>
                </div> -->
            <div class="col-md-3" style="">

                    <div class="form-group">
                            <label >Teléfono móvil:</label>

                            <div class="input-group" >

                                    <select class="  requerido form-control"  name="cmbsms" id="cmbsms" style="padding-right:0 !important; padding-left:0 ; width:30% !important ;" >
                                            
                                    </select>
                                    <input  style="width:70% !important ;"  type="text" class="form-control"  class=" form-control requerido numero" NAME="txtsms" id="txtsms" maxlength="7" >

                                  </div>
                         
                               
                             
                          
                        </div>
     
            </div>
      


    
         </div><!-- /row identificación 5-->
         <div class="row"  ><!-- row identificación 6 -->
            <div class="col-md-12 ">


                    <div class="input-group">
                            <span class="input-group-addon">Dirección</span>
                            <textarea class="form-control" rows="1"
                            NAME="txtdireccionresd" id="txtdireccionresd" class="requerido mayus" tabindex="11" 
                            maxlength=100 
                            ONKEYPRESS="return enterUppercaseBig(this, event)"
                            ></textarea>

                          </div>
                </div>
            
            </div><!-- /row identificación 6 -->
            <br>
    <script>
   	///////////////////////////////////////////////////////////////////////////////////
	//                      Funcion Elegir Municipio Jhonatan Rojas 21.05.2018    //
	///////////////////////////////////////////////////////////////////////////////////
 function elegirmunicipio(codestado)
{

                       
                        var nciudad= $('#cmbciudad').val();
        

                //  alert(codestado);
            var webservice = "getInfoMunicipioWs";
            var pagina = 'orinoco/';
            //var webservice = "getCiudadWs";

            var method = 'Get';
            //headers: {'X-CSRF-TOKEN': token},
            var url = '{{route("municipios")}}';
            //var arrcampos = ['nbciudad'];
            //var arrvar = [nciudad];
            var arrcampos = ['listm_relacion'];
            var arrvar = [codestado];
            //alert(selectconsultar);
            var data = {'listm_relacion': codestado};

            
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
                  //console.log(data);
                    var datos=JSON.parse(JSON.stringify(data));
                       
                 $('#x_mun option').each(function() {

                    $(this).remove();

                    });


                    for(var i in datos)
                    {

            

                             
                              
                            document.getElementById("x_mun").innerHTML += "<option    value='"+datos[i].listm_codigo+"'>"+datos[i].listm_nombre+"</option>";

                        }
                 

            
                                                   
                                    }
 

                                     });
                                        //Elegir Municipio

 
                                            }//Fin web service



function elegirparroquia(codparroquia)
{

                       
                        var nciudad= $('#cmbciudad').val();
        

                //  alert(codestado);
            var webservice = "getParroquias";
            var pagina = 'orinoco/';
            //var webservice = "getCiudadWs";

            var method = 'Get';
            //headers: {'X-CSRF-TOKEN': token},
            var url = '{{route("getParroquias")}}';
            //var arrcampos = ['nbciudad'];
            //var arrvar = [nciudad];
            var arrcampos = ['listm_relacion'];
            var arrvar = [codestado];
            //alert(selectconsultar);
            var data = {'x_mun': codparroquia};

            
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
                  console.log(data);
                    var datos=JSON.parse(JSON.stringify(data));

                 $('#x_par option').each(function() {

                    $(this).remove();

                    });

                    for(var i in datos)
                    {

            

                             
                              
                            document.getElementById("x_par").innerHTML += "<option   value='"+datos[i].listprr_codigo+"'>"+datos[i].listprr_nombre+"</option>";

                        }
            
                                                   
                                    }
 

                                     });
                                        //Elegir Municipio

 
                                            }//Fin web service
function elegircodpostal(codpostal,codmun,codestado)
{

                       
                        var nciudad= $('#cmbciudad').val();
        

                //  alert(codestado);
            var webservice = "getInfoMunicipioWs";
            var pagina = 'orinoco/';
            //var webservice = "getCiudadWs";

            var method = 'Get';
            //headers: {'X-CSRF-TOKEN': token},
            var url = '{{route("getCodPostal")}}';
            //var arrcampos = ['nbciudad'];
            //var arrvar = [nciudad];
            var arrcampos = ['listm_relacion'];
            var arrvar = [codestado];
            //alert(selectconsultar);
            var data = {'codpostal': codpostal, 'codmun':codmun, 'codestado':codestado};

            
        $.ajax({
                    type: "GET",
                    //  headers: {'X-CSRF-TOKEN': token},
                    url: url,
                    data: data,
                    datatype: 'JSON',
                   

                    success: function (data) {
                  //console.log(data);
                    var datos=JSON.parse(JSON.stringify(data));
                       
             console.log(data);


                   
            

                         $('#codpostal').val(datos[0].codp_codigo);
                              

                        
            
                                                   
                                    }
 

                                     });
                                        //Elegir Municipio

 
                                            }//Fin web service


   
    $(document).ready(function(){
      
        $('#estado').change(function(){
             $('#x_par option').each(function() {

                    $(this).remove();

                    });

     document.getElementById("x_par").innerHTML += "<option   value='0'>Seleccione un Municipio</option>";

            var nciudad= $('#estado').val();
           elegirmunicipio(nciudad);
        
          window.setTimeout(function() {
      var codparroquia= $('#x_mun').val();
      var codpostal= $('#x_par').val();
          
                              var codedo= $('#estado').val();
           elegircodpostal(codpostal,codparroquia,codedo);

            elegirparroquia(codparroquia);
}, 3000);
  
  
        });


        $('#x_mun').change(function(){
            var codparroquia= $('#x_mun').val();
            elegirparroquia(codparroquia);

           
        });

            $('#x_par').change(function(){
            var codpostal= $('#x_par').val();
               var codmun= $('#x_mun').val();
                              var codedo= $('#estado').val();

                         console.log(codpostal);

     elegircodpostal(codpostal,codmun,codedo);
           
        });

    
      });

          </script>
@endsection
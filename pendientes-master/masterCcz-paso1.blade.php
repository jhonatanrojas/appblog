

<div class="row">
	<div class="col-md-12" style=" -webkit-border-radius: 0 0 6px 6px;-moz-border-radius: 0 0 6px 6px;border-radius: 0 0 6px 6px;-webkit-box-shadow: 0 1px 2px rgba(0,0,0,.15);-moz-box-shadow: 0 1px 2px rgba(0,0,0,.15);box-shadow: 0 1px 2px rgba(0,0,0,.15);">
        <div class="row">
            <div class="col-md-12 page-header well" >
                <h5  style="text-align:center"><b>DATOS PERSONALES</b></h5 >
            </div>
         </div>
        <form name="frmdp" id="frmdp" method="post" class="cmxform">
        <div class="row"><!-- row identificación -->
    		<div class="col-md-4">
	    		 <div class="form-group">
                     <label for="identificación">Nº Identificación:</label>
					<input id="identificacion" type="text" class="form-control"	value="" disabled>
                 </div>
			</div>
			<div class="col-md-4">
				 <div class="form-group">
					<label for="Nombre">Nombre(s) y Apellido(s):</label>
					<input type="text" class="form-control"	value="{{Session::get('LoginPR.0.nombre').' '.Session::get('LoginPR.0.apellido')}}" disabled>
				 </div>
			</div>
			<div class="col-md-4">
				 <div class="form-group">
					<label for="Nombre">Correo Electrónico:</label>
					<input type="text" class="form-control"	value="{{Session::get('LoginPR.0.email')}}" disabled>
				 </div>
			</div>
		</div><!-- /row identificación -->
        <div class="row"  ><!-- row identificación 2 -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="identificación">Pais de Nacimiento:</label>
                    <select class="form-control" name="cmbpaisnac" id="cmbpaisnac"  class="requerido"   tabindex="1" onKeyPress="return shiftHighlight(event.keyCode, this);"></select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="Nombre">Lugar de Nacimiento:</label>
                    <input type="text" class="form-control" value=""  name="txtlugarnac" id="txtlugarnac"  maxlength="20" tabindex="2" class="mayus requerido" data-rule-required="true" data-msg-required="Por favor complete este campo es obligatorio.">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                   <label for="Nacionalidad">Nacionalidad:</label>
                   <select class="form-control" name="cmbgentilicio" id="cmbgentilicio"  class="requerido" onKeyPress="return shiftHighlight(event.keyCode, this);" tabindex="3" >                    </select>
                 </div>
            </div>

        </div><!-- /row identificación 2-->

        <div class="row"  ><!-- row identificación 3 -->

          
                    <div class="col-md-4" >
                            <label >Fecha de Nacimiento	:</label>
                        <div class="form-group">
                            <div class='input-group date' id='datetimepicker10'>
                               
                    <input type="text" class="form-control  requerido fecha"
                    
                    value=""  name="txtfechanac"
                    id="txtfechanac"
                    maxlength="10" tabindex="4" >
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar">
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">
                        $(function () {
                            $('#datetimepicker10').datetimepicker({
                             
                                format: 'DD/MM/YYYY'
                            });
                        });
                    </script>
                
    

           

            
            <div class="col-md-4">
                <div class="form-group">
                    <label for="Genero">Genero	:</label>

                    <select class="form-control" name="cmbgenero" id="cmbgenero"  class="requerido"
                    onKeyPress="return shiftHighlight(event.keyCode, this);" tabindex="5"

                    onKeyPress="return shiftHighlight(event.keyCode, this);">
                     </select>

                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="Estado Civil">Estado Civil:</label>
                    <select class="form-control" name="cmbedocivil" id="cmbedocivil"  class="requerido" onKeyPress="return shiftHighlight(event.keyCode, this);" tabindex="3" >
                        <?php echo getEstadocivil();?>
                    </select>
                </div>
            </div>
         </div><!-- /row identificación 3-->

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
         
                        <select class="form-control requerido" name="x_est" id="estado"    tabindex="8"  >
                        <option value="0" data-type=''>Seleccione Ciudad</option>

                                             
                      
                         </select>
                         <input type="hidden" name="codestadi" id="codestado" />

                      </div>
                      
         
            </div>
           
         
                     <div class="col-md-3">
                     <div class="form-group">
                        <label for="">Municipio:</label>
                        <select class="form-control requerido" name="x_mun" id="municipio"   
                       tabindex="9" >
                       <option value="0">Seleccione Estado</option>

                         </select>
                        
                      </div>
                     </div>
         

                     <div class="col-md-3">
                        <div class="form-group">
                           <label for="">Parroquia:</label>
                           <select class="form-control requerido" name="x_par" id="parroquia"   
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
                  
                    value=""  name="x_cop"
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
         



     
      
                          
                  

<div class="row"  ><!-- row identificación 6 -->
    <div class="col-md-2   col-md-offset-10">

            <input type="button" class="btn btn-success btn-sm" id="btndp" tabindex="15" value="Guardar y Continuar" style="width:auto;">

        </div>
        <br>
        <br>
<input type="hidden" name="tdp" id="tdp"/>
<input name="savedp" id="savedp" type="hidden" />
    </div><!-- /row identificación 6 -->
    </div><!-- col 12 -->
</form>
</div> <!-- row principal-->

<br>
<br>
<br>




<script>
    var frm = $('#frmdp');
    var savedp = $('#savedp');
    var nrif = $('#nrorif')
    nrif.keydown(function(event){
        if(!isNumberKey(event))
            return false;
    });

    $('#btndp').click(function(e){

        var este = $(this);
        if(valida($('#frmdp'))){
            este.attr('disabled','true').val('Guardando...');
            saveData(1,$('#frmdp').serialize(),1);
            este.removeAttr('disabled').val('Guardar y Continuar');
            savedp.val(1);
        }
    });

    $('#txtultcr').qtip({
        content: 'Ingrese la fecha de su carta de residencia',
        show: 'mouseover',
        hide: 'mouseout'
    });
    $('#cmbciudad').qtip({
        content: 'Escriba el nombre de su ciudad de residencia,<br>luego seleccione la que corresponda<br>haciendo "clic" &oacute; "enter".',
        show: 'mouseover',
        hide: 'mouseout'
    });

    frm.find(':input').bind('change keyup',function(){
        savedp.val(0);
    });

</script>


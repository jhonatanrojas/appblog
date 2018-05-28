<?php namespace App\Http\Controllers\Wsorinoco\PortalRegistro;


use Curl;
use Auth;
use Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ConsumirWS;
use \Milon\Barcode\DNS1D;


class ClienteWuController extends Controller {

    /**
     * POST Show the application login form.
     *
     * @return Response
     */
    var $consumirws;

    public function  __construct(){ 
        $this->consumirws=new ConsumirWS();
    }

    public function datoscliente(Request $request){
        //Consulta al tipo de documento
        $webservice= 'getInfotipodocwuWs';
        $parametros=array( 'codtipodocwu' => 'ALL' );
        $tipodocli=$this->consumirws->consumirPorGet($webservice,$parametros,$url='customs.url_baaszoom',$pagina='orinoco/');

        $webservice2= 'getCompatelefwuWs';
        $parametros2=array( 'codcomptelefwu' => 'ALL' );
        $tipotelefono=$this->consumirws->consumirPorGet($webservice2,$parametros2,$url='customs.url_baaszoom',$pagina='orinoco/');

       //dd($tipotelefono);
        return view('Wsorinoco/PortalRegistro/registro',compact('tipodocli','tipotelefono'));

    }

    public function prueba(Request $request)
    {
        return view('Wsorinoco/Cliente/pruebaficha');
    }

    public function reciboliqui(Request $request)
    {
        $datos= array(//'txtmtcn' => $upd['telefonoresd'],
            //'nroaprobacion'=> $upd['telefonoresd'],
            'txtnomcliente'=> $_POST['nombre1'].' '.$_POST['nombre2'].' '.$_POST['apellido1'].' '.$_POST['apellido2'],
            'cmbpaisnac'=> $_POST['paisnacnom'],
            //'txtnroconfirmbcv'=> $_POST['telefonoresd'],
            'txttelefonoresd'=> $_POST['codcell'].$_POST['telefonocel'],
            //'cmbtipodocwu'=> $_POST['telefonoresd'],
            //'nombreofi'=> $_POST['telefonoresd'],
            'txtcodusu'=> '999',
            'txtdireccion'=> $_POST['direccion'],
            'x_est' => $_POST['nombreestado'],
            'cmbciudad'=> $_POST['ciudad'],
            'txtfechanac'=> $_POST['fechanac'],
            'txtnroident'=> $_POST['cedula'],
            'siglascli'=> $_POST['siglass'],
            'cmbservicio'=> $_POST['tipotransaccion'],
            //'monedaExterna1'=> $_POST['telefonoresd'],
            'txtmontodolar'=> $_POST['txtmontodolar'],
            'hdtasa'=> $_POST['hdtasa'],
            'txtmontoenvbs'=> $_POST['txtmontoenvbs'],
            'txtmontocom'=> $_POST['txtmontocom'],
            'txtmontototalbs'=> $_POST['txtmontototalbs'],
            //'cmbtipo'=> $_POST['telefonoresd'],
            'txtmontocomccz'=> $_POST['txtmontocomccz'],
            //'txtfecha_Orin2'=> $_POST['telefonoresd'],
            //'txtpaislocal_Orin2'=> $_POST['telefonoresd'],
            //'hdnombretransaccion'=> $_POST['telefonoresd'],
            //	'txtmontotarj'=> $_POST['telefonoresd'],
            //'txtnrocuenta1'=> $_POST['telefonoresd'],
            //'txtbanco1'=> $_POST['telefonoresd'],
            //'txttipocuenta1'=> $_POST['telefonoresd'],
            'cmbgentilicio'=> $_POST['nacionalidad'],
            //'txtciudadresd'=> $_POST['telefonoresd'],
            //'cmbmotivo'=> $_POST['telefonoresd']
        );
        $date = date('d/m/Y');
        //$invoice = "2222";
        $view =  \View::make('Wsorinoco.Cliente.imprireciboliqui', compact('datos', 'date', 'genero','ciudad','ciudadofi','referenciaban','referenciapersonal', 'biometria', 'rack','docwun'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $customPaper = array(0,0,720,1440);
        //$customPaper= array(0,0,1190.56,841.88)
        $pdf->loadHTML($view);
        $pdf->setPaper($customPaper);
        //$pdf->setWarnings(false);
        //file_put_contents('reciboliqui.pdf',$pdf->output());
        return $pdf->stream('reciboliqui.pdf');
        //PDF::loadHTML($html)->setPaper('a4', 'landscape')->setWarnings(false)->save('myfile.pdf')
    }

    // modificar la ficha del cliente
    public function modificarficha(Request $request)
    {
        $webservice= 'getInfotipodocwuWs';
        $parametros=array( 'codtipodocwu' => 'ALL' );
        $tipodocli=$this->consumirws->consumirPorGet($webservice,$parametros,$url='customs.url_baaszoom',$pagina='orinoco/');
        //dump($tipodocli);
        return view('Wsorinoco/Cliente/modificarfichacliente',compact('tipodocli'));
    }

    public function pdfFicha(Request $request)
    {

        if((isset($_POST['imprimir']) && $_POST['imprimir']==1))
        {
            $est['codpais'] = '124';
            $est['codestado'] = 'ALL';//$request->get('estado');

            $mun['codestado'] = 'ALL';//$request->get('estado');
            $mun['codciudad'] = 'ALL';//$request->get('codciudad');
            $mun['codmunicipio'] = 'ALL';

            $parr['codciudad'] = 'ALL';//$request->get('codciudad');
            $parr['codmunicipio'] = 'ALL'; //$request->get('ALL');
            $parr['codparroquia'] = 'ALL';
            $a['codtipoidcli']=$request->get('tipodoc');
            $a['rifcicli']=$request->get('cedula');
            $b['rifci']=$request->get('cedula');
            $c['cmbtipodocwu']=$request->get('tipodoc');
            $c['txtnroident']=$request->get('cedula');
            $gen['codgenero']=$request->get('genero');
            $ciu['codestado']= $request->get('codestadobcv');
            $ciu['codciudad']= str_replace(' ', '',$request->get('codigociudad'));
            $ciu['nbciudad']= $request->get('ciudad');
            //dd(str_replace(' ', '',$request->get('codigociudad')));
            $ciuofi['codciudad']= $request->get('codigociudadofi');
            $ciuofi['nbciudad']= $request->get('ciudadofi');
            $data = $this->getData($a);
            //dd($data);
            $genero = $this->getGenero($gen);
            $ciudad = $this->getCiudad($ciu);
            $ciudadofi = $this->getCiudadofi($ciuofi);

            $estado = $this->getInfoEstado($est);

            $municipio = $this->getInfoMunicipio($mun);
            $parroquia = $this->getInfoParroquia($parr);

            $referenciaban = $this->getRefBan($a);
            $referenciapersonal = $this->getRefPer($a);
            $biometria = $this->getBiometria($b);
            $rack = $this->getRack($c);
            $docwun = $this->getDocumentoWu($a);
            //dd($ciudad);
            $date = date('d/m/Y');
            //$invoice = "2222";
            $view =  \View::make('Wsorinoco.Cliente.fichaclientepdf', compact('data', 'date', 'genero','ciudad','ciudadofi','referenciaban','referenciapersonal', 'biometria', 'rack','docwun','estado','municipio','parroquia'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $customPaper = array(0,0,700,900);
            $pdf->loadHTML($view);
            $pdf->setPaper($customPaper);
            return $pdf->stream('pdfFicha.pdf');
        }
        if((isset($_POST['guardar'])) && $_POST['guardar']==2)
        {
            $guardar['direccion']=$request->get('direccion');
            $guardar['telefonoresd']=$request->get('telefonoresd');
            $guardar['codciudadresd']= $request->get('codciudad');
            //str_replace(' ', '',$request->get('codigociudadzoom'));
            $guardar['lugarnac']=$request->get('lugarnac');
            $guardar['codpaisnac']=$request->get('paisnac');
            $fechaold= str_replace("/","-",(explode("/",$request->get('fechanac'))));
            $fechanew= $fechaold[2]."-".$fechaold[1]."-".$fechaold[0];
            $guardar['fechanac']=$fechanew;
            $guardar['estadocivil']=$request->get('estadocivil');
            $guardar['empresa']=$request->get('empresa');
            $guardar['telefonoofic']=$request->get('telefonoofic');
            //$guardar['codciudadofic']=$request->get('codciudadofizoom');
            $guardar['codciudadofic']= $request->get('codciudadofi');
            //$request->get('codciudadoficina');
            $guardar['otrosingresos']=$request->get('otrosingresos');
            $guardar['codpaisenc']=$request->get('paisenc');

            $guardar['montopromedioenc']=$request->get('montopromedioenc');
            if($request->get('clienteprein')==0)
            {
                $guardar['frecuencia']=$request->get('frecuencia');
                $guardar['motivoserv'] =$request->get('origenfondos');/*pendiente*/
                $guardar['usofondos']=$request->get('usofondos');
                //$guardar['origenfondos']=$request->get('motivoserv');
                $guardar['necesidadserv']=$request->get('motivoserv');
                $guardar['profesion']=$request->get('profesion');
                $guardar['ocupacion']=$request->get('ocupacion');
                $guardar['nacionalidad']=$request->get('codnacionalidad');

            }
            if($request->get('clienteprein')==1)
            {
                $guardar['frecuencia']=$request->get('frecuenciawu');
                $guardar['motivoserv'] =$request->get('origenfondoswu');/*pendiente*/
                $guardar['usofondos']=$request->get('usofondoswu');
                //$guardar['origenfondos']=$request->get('motivoservwu');
                $guardar['necesidadserv']=$request->get('motivoservwu');
                $guardar['profesion']=$request->get('profesionwu');
                $guardar['ocupacion']=$request->get('ocupacionwu');
                $guardar['nacionalidad']=$request->get('nacionalidad');

            }
            $guardar['direccionofic']=$request->get('direccionofic');
            $guardar['codsalario']=$request->get('salario');
            $guardar['telefonocel']=$request->get('codigooperadora').$request->get('telefonocel');
            $guardar['email']=$request->get('email');
            /*pendiente*/
            $guardar['codgenero']=$request->get('genero');
            $guardar['actividadeconomica']=$request->get('actividadeconomica');
            $guardar['codusuario']=$request->get('usuarioid');
            $guardar['codestmunparcop']=$request->get('codestadobcv').','.$request->get('municipio').','.$request->get('parroquia').','.$request->get('codpostal');
            $guardar['codestmunparcopofic']=$request->get('codestadoofibcv').','.$request->get('municipioofic').','.$request->get('parroquiaofi').','.$request->get('codpostalofi');
            $guardar['esudpep']=$request->get('esudpep');
            $guardar['fueudpep']=$request->get('fueudpep');
            $guardar['esfampep']=$request->get('rfepep');
            $guardar['fuefampep']=$request->get('rffpep');
            $guardar['detacteconomica']=$request->get('detactividadeconomica');
            $guardar['otrodetactecon']=$request->get('otrodetactecon');/*pendiente*/
            $guardar['otroorigenfondos']=$request->get('otroorigenfondos');/*pendiente*/
            $guardar['otrousofondos']=$request->get('otrousofondos');/*pendiente*/
            $guardar['otromotivonecesidad']=$request->get('otromotivonecesidad');/*pendiente*/
            $guardar['codtipoidrif']=$request->get('tipod_2');/*tipod_2 en el formulario es el codtipoidrif*/
            $guardar['rifci']=$request->get('cedula');
            $guardar['numrif']=$request->get('numdoc2');/*numdoc2: en el formulario es el numero de rif*/
            $guardar['nombres']=$request->get('nombre1').' '.$request->get('nombre2');/*pendiente*/
            $guardar['apellidos']=$request->get('apellido1').' '.$request->get('apellido2');
            $guardar['codtipoid']=$request->get('tipodoc');
            $guardar['verifica']=$request->get('clienteprein');


            $update = $this->getUpdate($guardar);// Se llama a la función getUpdate y se realiza la actualización


            //referencias bancarias
            $ref['codtipoid'] = $request->get('tipodoc');
            $ref['rifci']=$request->get('cedula');
            $ref['nrocuenta']=$request->get('nrocuenta');
            $ref['banco']=$request->get('nbbanco');
            $ref['tipocuenta']=$request->get('tipocuenta');
            $ref['fecha']=$request->get('fecharefban');
            //$ref['fecha']$request->get('clienteprein');
            $ref['codreferencia']=$request->get('codrefban');
            $ref['tipo']=$request->get('tiporef');

            $refper['codtipoid']=$request->get('tipodoc');
            $refper['rifci']=$request->get('cedula');
            $refper['nombrereferencia']=$request->get('nombreref');
            $refper['telefonoreferencia']=$request->get('telefonoref');
            $refper['codreferencia']=$request->get('codrefper');
            $refper['tipo']=$request->get('tiporefper');

            $docu['codtipodocumento']=$request->get('idtipodoc');
            $docu['fechadoc']= $request->get('fechadoc');
            //$docu['fechadoc'][1]='2014-04-01';
            $docu['codtipoidcli']=$request->get('tipodoc');
            $docu['rifcicli']=$request->get('cedula');
            $docu['codtipoidben'][0]= 0;
            $docu['codtipoidben'][1]= 0;
            $docu['rifciben'][0]= '';
            $docu['rifciben'][1]= '';
            $docu['fechaing'][0]=date('Y-m-d');
            $docu['fechaing'][1]=date('Y-m-d');
            $docu['codusuario']=$request->get('usuarioid');
            $docu['codguia']='';
            //$docu['fecharec'][0]='';
            //$docu['fecharec'][1]='';
            $docu['codoficina']=$request->get('oficinaid');
            $fechavencdoc= $request->get('fechavencdoc');
            $fechavenc0= $fechavencdoc[0];
            $fechavenc0= explode("/",$fechavencdoc[0]);
            $fechavenc0 = $fechavenc0[2]."-".$fechavenc0[1]."-".$fechavenc0[0];

            $fechavenc1= $fechavencdoc[1];
            $fechavenc1= explode("/",$fechavencdoc[1]);
            $fechavenc1 = $fechavenc1[2]."-".$fechavenc1[1]."-".$fechavenc1[0];

            $docu['fechavencdoc'][0]= $fechavenc0;
            $docu['fechavencdoc'][1]= $fechavenc1;
            $docu['opcion']=$request->get('opcion');
            $docu['observacion'][0]='';
            $docu['observacion'][1]='';

            $putrefban = $this->putRefBan($ref);
            $putrefpers = $this->putRefPers($refper);
            $putdocument = $this->putDocumentos($docu);

            $a['codtipoidcli']=$request->get('tipodoc');
            $a['rifcicli']=$request->get('cedula');
            $b['rifci']=$request->get('cedula');
            $c['cmbtipodocwu']=$request->get('tipodoc');
            $c['txtnroident']=$request->get('cedula');
            $gen['codgenero']=$request->get('genero');
            $ciu['codestado']= $request->get('codestadobcv');
            $ciu['codciudad']= str_replace(' ', '',$request->get('codigociudad'));
            $ciu['nbciudad']= $request->get('ciudad');
            //dd(str_replace(' ', '',$request->get('codigociudad')));
            $ciuofi['codciudad']= $request->get('codigociudadofi');
            $ciuofi['nbciudad']= $request->get('ciudadofi');


            $est['codpais'] = '124';
            $est['codestado'] = 'ALL';//$request->get('estado');

            $mun['codestado'] = 'ALL';//$request->get('estado');
            $mun['codciudad'] = 'ALL';//$request->get('codciudad');
            $mun['codmunicipio'] = 'ALL';

            $parr['codciudad'] = 'ALL';//$request->get('codciudad');
            $parr['codmunicipio'] = 'ALL'; //$request->get('ALL');
            $parr['codparroquia'] = 'ALL';

            //dd($ciu['nbciudad']);
            //dd($ciu['nbciudad']);
            $data = $this->getData($a);
            $genero = $this->getGenero($gen);
            $ciudad = $this->getCiudad($ciu);
            $ciudadofi = $this->getCiudadofi($ciuofi);
            $estado = $this->getInfoEstado($est);
            $municipio = $this->getInfoMunicipio($mun);
            $parroquia = $this->getInfoParroquia($parr);

            $referenciaban = $this->getRefBan($a);
            $referenciapersonal = $this->getRefPer($a);
            $biometria = $this->getBiometria($b);
            $rack = $this->getRack($c);
            $docwun = $this->getDocumentoWu($a);
            //dd($rack);

            $date = date('d/m/Y');





            $date = date('d/m/Y');
            //$invoice = "2222";
            $view =  \View::make('Wsorinoco.Cliente.fichaclientepdf', compact('data','date', 'genero','ciudad','estado','municipio','parroquia','ciudadofi','referenciaban','referenciapersonal', 'biometria', 'rack','docwun'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
            return $pdf->stream('pdfFicha.pdf');
        }
    }

    public function getUpdate($upd)
    {

        $webservice= 'putClientewuWS';
        $parametros= array('direccion' => $upd['direccion'],
            'telefonoresd' => $upd['telefonoresd'],
            'codciudadresd' => $upd['codciudadresd'],
            'lugarnac' => $upd['lugarnac'],
            'codpaisnac'=> $upd['codpaisnac'],
            'fechanac'=> $upd['fechanac'],
            'estadocivil'=> $upd['estadocivil'],
            'nacionalidad'=> $upd['nacionalidad'],
            'profesion'=> $upd['profesion'],
            'ocupacion'=> $upd['ocupacion'],
            'empresa'=> $upd['empresa'],
            'telefonoofic'=> $upd['telefonoofic'],
            'codciudadofic'=> $upd['codciudadofic'],
            'otrosingresos'=> $upd['otrosingresos'],
            'codpaisenc'=> $upd['codpaisenc'],
            'frecuencia'=> $upd['frecuencia'],
            'montopromedioenc'=> $upd['montopromedioenc'],
            'motivoserv' => $upd['motivoserv'], /*pendiente*/
            'usofondos'=> $upd['usofondos'],
            'necesidadserv'=> $upd['necesidadserv'],/*pendiente*/
            'direccionofic'=> $upd['direccionofic'],
            'codsalario'=> $upd['codsalario'],
            'telefonocel'=> $upd['telefonocel'],
            'email'=> $upd['email'],
            'codgenero'=> $upd['codgenero'],
            'actividadeconomica'=> $upd['actividadeconomica'],
            'codusuario'=> $upd['codusuario'],
            'codestmunparcop'=> $upd['codestmunparcop'],
            'codestmunparcopofic'=> $upd['codestmunparcopofic'],
            'esudpep'=> $upd['esudpep'],
            'fueudpep'=> $upd['fueudpep'],
            'esfampep'=> $upd['esfampep'],
            'fuefampep'=> $upd['fuefampep'],
            'detacteconomica'=> $upd['detacteconomica'],
            'otrodetactecon'=> $upd['otrodetactecon'],/*pendiente*/
            'otroorigenfondos'=> $upd['otroorigenfondos'],/*pendiente*/
            'otrousofondos'=> $upd['otrousofondos'],/*pendiente*/
            'otromotivonecesidad'=> $upd['otromotivonecesidad'],/*pendiente*/
            'codtipoidrif'=> $upd['codtipoidrif'],/*pendiente*/
            'rifci'=> $upd['rifci'],
            'numrif'=> $upd['numrif'],
            'nombres'=> $upd['nombres'],
            'codtipoid'=> $upd['codtipoid'],
            'apellidos'=> $upd['apellidos'],
            'verifica'=> $upd['verifica']
        );
        //dd($upd['codtipoidrif']);
        //dd($parametros);
        $response=$this->consumirws->consumirPorGet($webservice,$parametros,$url='customs.url_baaszoom',$pagina='orinoco/');
        //dd($response);
        //return $response;

        //Update o Insert de las referencias bancarias
        /*$webservicerefban= 'putClientewuWS';
        $parametros= array('direccion' => $upd['direccion'],
        'telefonoresd' => $upd['telefonoresd'],
        'codciudadresd' => $upd['codciudadresd'],
        'lugarnac' => $upd['lugarnac'],
        'codpaisnac'=> $upd['codpaisnac'],
        'fechanac'=> $upd['fechanac'],

        'verifica'=> $upd['verifica']
        );
        //dd($upd['codtipoidrif']);
        //dd ($parametros);
        $response=$this->consumirws->consumirPorGet($webservice,$parametros,$url='customs.url_baaszoom',$pagina='orinoco/');*/

    }
    //Función para consultar el web service getExistsClienteWs (generar el pdf)
    public function getData($rif)
    {
        $webservice= 'getExistsClienteWs';
        $parametros=array( 'codtipoidcli' => $rif['codtipoidcli'] ,'rifcicli' => $rif['rifcicli']);
        $response=$this->consumirws->consumirPorGet($webservice,$parametros,$url='customs.url_baaszoom',$pagina='orinoco/');
        //dd($response);
        return $response;
    }
    //Función para consultar la ciudad (generar pdf)
    public function getCiudad($ciudad)
    {
        $webservice= 'getCiudadWs';
        $parametros=array('codciudad' => $ciudad['codciudad'], 'nbciudad' => $ciudad['nbciudad'] );
        $response=$this->consumirws->consumirPorGet($webservice,$parametros,$url='customs.url_baaszoom',$pagina='orinoco/');
        //dd($response);
        return $response;
    }
    public function getCiudadofi($ciudadofi)
    {
        $webservice= 'getCiudadWs';
        $parametros=array('codciudad' => $ciudadofi['codciudad'], 'nbciudad' => $ciudadofi['nbciudad'] );
        $response=$this->consumirws->consumirPorGet($webservice,$parametros,$url='customs.url_baaszoom',$pagina='orinoco/');
        return $response;
    }



    public function getInfoEstado($est)
    {
        $webservice= 'getInfoEstadoWs';
        $parametros=array('codpais' => $est['codpais'], 'codestado' => $est['codestado'] );
        $response=$this->consumirws->consumirPorGet($webservice,$parametros,$url='customs.url_baaszoom',$pagina='orinoco/');
        //dd($parametros);
        return $response;
    }

    public function getInfoMunicipio($mun)
    {
        $webservice= 'getInfoMunicipioWs';
        $parametros=array('codestado' => $mun['codestado'], 'codciudad' => $mun['codciudad'], 'codmunicipio' => $mun['codmunicipio'] );
        $response=$this->consumirws->consumirPorGet($webservice,$parametros,$url='customs.url_baaszoom',$pagina='orinoco/');
        return $response;
    }

    public function getInfoParroquia($parr)
    {
        $webservice= 'getInfoParroquiaWs';
        $parametros=array('codciudad' => $parr['codciudad'], 'codmunicipio' => $parr['codmunicipio'], 'codparroquia' => $parr['codparroquia'] );
        $response=$this->consumirws->consumirPorGet($webservice,$parametros,$url='customs.url_baaszoom',$pagina='orinoco/');
        return $response;
    }



    public function getGenero($genero)
    {
        $webservice= 'getGeneroWs';
        $parametros=array( 'codgenero' => $genero['codgenero']);
        $response=$this->consumirws->consumirPorGet($webservice,$parametros,$url='customs.url_baaszoom',$pagina='orinoco/');
        return $response;
    }
    public function getRefBan($a)
    {
        $webservice= 'getInfoRefbancwucliListWs';
        $parametros=array( 'codtipoidcli' => $a['codtipoidcli'] ,'rifcicli' => $a['rifcicli']);
        $response=$this->consumirws->consumirPorGet($webservice,$parametros,$url='customs.url_baaszoom',$pagina='orinoco/');
        //dd($response);
        return $response;
    }
    public function getRefPer($a)
    {
        $webservice= 'getRefperWs';
        $parametros=array( 'codtipoidcli' => $a['codtipoidcli'] ,'rifcicli' => $a['rifcicli']);
        $response=$this->consumirws->consumirPorGet($webservice,$parametros,$url='customs.url_baaszoom',$pagina='orinoco/');
        return $response;
    }
    //consultar al web service DatSimobi (biometria)
    public function getBiometria($b)
    {
        $webservice= 'DatSimobi';
        $parametros=array('rifci' => $b['rifci']);
        $response=$this->consumirws->consumirPorGet($webservice,$parametros,$url='customs.url_baaszoom',$pagina='orinoco/');
        //dd($response);
        return $response;
    }
    //Consultar Tracking
    public function getRack($c)
    {
        $webservice= 'getRackWs';
        $parametros=array('cmbtipodocwu' => $c['cmbtipodocwu'] ,'txtnroident' => $c['txtnroident']);
        $response=$this->consumirws->consumirPorGet($webservice,$parametros,$url='customs.url_baaszoom',$pagina='orinoco/');
        //dd($response);
        return $response;
    }
    public function getDocumentoWu($a)
    {
        $webservice= 'getExistsDocumentoWs';
        $parametros=array( 'codtipoidcli' => $a['codtipoidcli'] ,'rifcicli' => $a['rifcicli']);
        $response=$this->consumirws->consumirPorGet($webservice,$parametros,$url='customs.url_baaszoom',$pagina='orinoco/');
        return $response;
    }

    //Funcion para insertar la referencia bancarias
    public function putRefBan($ref)
    {
        $webservice= 'putInfoRefbancwucliWs';
        $parametros=array('codtipoid' =>$ref['codtipoid'],'rifci' => $ref['rifci'], 'nrocuenta' => $ref['nrocuenta'],'banco' => $ref['banco'],'tipocuenta' => $ref['tipocuenta'],'fecha' => $ref['fecha'],'fecha' => $ref['fecha'], 'codreferencia' => $ref['codreferencia'], 'tipo' =>$ref['tipo']);
        $response=$this->consumirws->consumirPorGet($webservice,$parametros,$url='customs.url_baaszoom',$pagina='orinoco/');
        //dd($response);
        return $response;
    }
    public function putRefPers($refper)
    {
        $webservice= 'putRefperWs';
        $parametros=array('codtipoid' =>$refper['codtipoid'],'rifci' => $refper['rifci'], 'nombrereferencia' => $refper['nombrereferencia'],'telefonoreferencia' => $refper['telefonoreferencia'],'tipo' => $refper['tipo'],'codreferencia' => $refper['codreferencia']);
        $response=$this->consumirws->consumirPorGet($webservice,$parametros,$url='customs.url_baaszoom',$pagina='orinoco/');
        //dd($response);
        return $response;
    }
    public function putDocumentos($docu)
    {
        $webservice= 'putDocumentosWS';
        $parametros=array('codtipodocumento' =>$docu['codtipodocumento'],'fechadoc' => $docu['fechadoc'], 'codtipoidcli' => $docu['codtipoidcli'],'rifcicli' => $docu['rifcicli'],'codtipoidben' => $docu['codtipoidben'],'rifciben' => $docu['rifciben'],'fechaing' => $docu['fechaing'],'codusuario' => $docu['codusuario'],'codguia' => $docu['codguia'],'codoficina' => $docu['codoficina'],'fechavencdoc' => $docu['fechavencdoc'],'opcion' => $docu['opcion'],'observacion' => $docu['observacion']);
        $responsedoc=$this->consumirws->consumirPorGet($webservice,$parametros,$url='customs.url_baaszoom',$pagina='orinoco/');
        dd($responsedoc);
        //return $response;
    }



}

<?php namespace App\Http\Controllers\Wsorinoco;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Wsorinoco\Model\Ciudad;

use App\Wsorinoco\Dal\CiudadDAL;

use App\Wsgeneric\Model\EntityResponse;

use App\Wsgeneric\Dal\GenericDAL;




class CiudadController extends Controller
{
    
	var $GenericDal;
    
    var $Ciudad;
    
    var $CiudadDAL;
    
    public function  __construct(){
        $this->GenericDAL=new GenericDAL();
        $this->EntityResponse = new EntityResponse(); 
        $this->Ciudad= new Ciudad();
        $this->CiudadDAL=new CiudadDAL();
    
    
    }
    
    
    public function getInfoCiudadList($codestado,$codciudad,$nbciudad){
        
         
        $dbResult=$this->CiudadDAL->getInfoCiudad($codestado,$codciudad,$nbciudad);                
      	$Ciudad = null;
        $CiudadList = Array();
        $IndexControl = 0;
        
        if(isset($dbResult) && count($dbResult) != 0){
            foreach($dbResult as $item){
                $Ciudad = new Ciudad();
                $Ciudad = $item;
                $CiudadList[$IndexControl] = $Ciudad;
                $IndexControl++;
            }
        }
      //  var_dump($dbResult);
       return $CiudadList;       
    }
    /**
	 * Ws de busqueda los estados
	 *
	 * @param  int  $codestado   int $codciudad
	 * @return Response json
	 */    
    public function getInfoCiudadWs(Request $request)
	{

       $codestado=$request->get('codestado');
       $codciudad=$request->get('codciudad');
       $nbciudad=$request->get('nbciudad');
       
       if ($nbciudad<>''){
            $dbResult= CiudadController::getInfoCiudadList($codestado,$codciudad,$nbciudad);
            
            if (isset($dbResult) && count ($dbResult)!=0){
                $dbResultMess=$this->GenericDAL->getMessage("COD_000","cczdesarrollo");  
                $this->EntityResponse=$dbResultMess[0];
                $this->Ciudad=$dbResult;
            }
            else{
                $dbResultMess=$this->GenericDAL->getMessage("CODE_000","cczdesarrollo");    
                $this->EntityResponse = $dbResultMess[0];
                $this->Ciudad=$dbResult;
            }  
       }
       else if ($nbciudad==''){
        
        if (($codestado=='ALL' || $codestado>0) && ($codciudad=='ALL' || $codciudad>0)){
           if ($codestado=='ALL' || $codciudad=='ALL'){ 
            
                $dbResult= CiudadController::getInfoCiudadList($codestado,$codciudad,$nbciudad);  
            }
            else if ($codestado>0 || $codciudad>0){
                $dbResult=$this->CiudadDAL->getInfoCiudad($codestado,$codciudad,$nbciudad);
            }
    
	        if (isset($dbResult) && count ($dbResult)!=0){
                $dbResultMess=$this->GenericDAL->getMessage("COD_000","cczdesarrollo");  
                $this->EntityResponse=$dbResultMess[0];
                $this->Ciudad=$dbResult;
            }
            else{
                $dbResultMess=$this->GenericDAL->getMessage("CODE_000","cczdesarrollo");    
                $this->EntityResponse = $dbResultMess[0];
                $this->Ciudad=$dbResult;
            }
         }
         else{
                $dbResultMess=$this->GenericDAL->getMessage("CODE_005","cczdesarrollo");  
                $this->EntityResponse=$dbResultMess[0];
                $this->Ciudad="";  
            
        }
         
       }
        else{
                $dbResultMess=$this->GenericDAL->getMessage("CODE_005","cczdesarrollo");  
                $this->EntityResponse=$dbResultMess[0];
                $this->Ciudad="";  
            
        }
          
        $this->EntityResponse->entidadRespuesta=$this->Ciudad;
        return response()->json($this->EntityResponse);     
        
        
    }
    
    
    
    public function getInfoCiudadList_2($nbciudad){
        
         
        $dbResult=$this->CiudadDAL->getInfoCiudad_2($nbciudad);                
      	$Ciudad = null;
        $CiudadList = Array();
        $IndexControl = 0;
        
        if(isset($dbResult) && count($dbResult) != 0){
            foreach($dbResult as $item){
                $Ciudad = new Ciudad();
                $Ciudad = $item;
                $CiudadList[$IndexControl] = $Ciudad;
                $IndexControl++;
            }
        }
      //  var_dump($dbResult);
       return $CiudadList;       
    }
    /**
	 * Ws de busqueda los estados
	 *
	 * @param  int  $codestado   int $codciudad
	 * @return Response json
	 */    
    public function getCiudadWs(Request $request)
	{

       $nbciudad=$request->get('nbciudad');
       
       if ($nbciudad<>''){
            $dbResult= CiudadController::getInfoCiudadList_2($nbciudad);
            
            if (isset($dbResult) && count ($dbResult)!=0){
                $dbResultMess=$this->GenericDAL->getMessage("COD_000","cczdesarrollo");  
                $this->EntityResponse=$dbResultMess[0];
                $this->Ciudad=$dbResult;
            }
            else{
                $dbResultMess=$this->GenericDAL->getMessage("CODE_000","cczdesarrollo");    
                $this->EntityResponse = $dbResultMess[0];
                $this->Ciudad=$dbResult;
            }  
       }

        else{
                $dbResultMess=$this->GenericDAL->getMessage("CODE_005","cczdesarrollo");  
                $this->EntityResponse=$dbResultMess[0];
                $this->Ciudad="";  
            
        }
          
        $this->EntityResponse->entidadRespuesta=$this->Ciudad;
        return response()->json($this->EntityResponse);     
        
        
    }



    public function getCiudadesws(Request $request) {
        $filtro = $request->get('filtro');


       
            $result = $this->CiudadDAL->getCiudades();
            if(!empty($result) && isset($result) && count($result) != 0){
                $dbResultMess=$this->GenericDAL->getMessage("COD_000","cczdesarrollo");
                $this->EntityResponse = $dbResultMess[0];
                $this->EntityResponse->entidadRespuesta=$result;
            }
            else
            {
                $dbResultMess=$this->GenericDAL->getMessage("CODE_000","cczdesarrollo");
                $this->EntityResponse = $dbResultMess[0];
            }

            /*if (count($result)>0) {
                $this->setMensaje("COD_000");
            } else {
                $result = 'NO HAY CIUDADES PARA MOSTRAR';
            }*/


       

        return response()->json($this->EntityResponse);
        //return response()->json($result);
    }

    
} // END CLASS CiudadController
?>
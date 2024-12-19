<?php.   
   
namespace App\Api;

class ApiTemplate  
{

    private const TEMPLATE_SUCCESS = [
        "success" => true,
        "code" => null,
        "data" => []
    ];
    private const TEMPLATE_FAIL = [
        "success" => false,
        "code" => null,
        "errors" => []
    ];




    public const FAIL_ADD = "Impossible d'ajouter l'élément";
    public const FAIL_DEL = "Impossible de supprimer l'élément";
    public const FAIL_UPDATE ="Impossible de modifier l'élément";
    public const REQUIRED_NAME = "Le nom est requis";
    public const REQUIRED_NEW_NAME = "Le nouveau nom est requis";
    public const REQUIRED_DIFFERENT_NAME = "Le nouveau nom doit être différent";
    public const NOT_FOUND = "L'élément est introuvable";
    public const REQUIRED_DESC = "La description est requise";
    public const REQUIRED_TITLE = "Le titre est requis";
    public const REQUIRED_GENDER = "Le genre est requis";
    public const CURRENT_PASSWORD_FAIL = "Le mot de passe actuel ne correspond pas";
    public const CONFIRM_NEW_PASSWORD_DIFFERENT = "Le nouveau mot de passe ne correspond pas";
    public const NEW_PASSWORD_MUST_BE_DIFFERENT = "Le mot de passe doit être différent";



    private array $currentTemplate;
    private array $headers;
    private bool $init;
    private bool $isSuccess;

    public function __construct(array $headers = [])
    {
        $this->headers = $headers;
        $this->init = false;
    }
    public function getSuccessTemplate(mixed $data=null, int $code=200, array $headers=[] ) : array 
    {

        if (!$this->checkingValidity(true)) {
            dd("FUCK");
        }
        if (!$this->init) {
            $this->initSuccessTemplate($code, $headers);
        }
        if (isset($data)) {
            array_push($this->currentTemplate["data"], $data);
        }
        return $this->currentTemplate;
    }

    public function getFailTemplate(string $error=null, $code=500, array $headers=[]) : array 
    {
        if (!$this->checkingValidity(false)) {
            dd("ERROR");
        }
        if (!$this->init) { 
            $this->initFailTemplate($code, $headers);
        } 
        if ($error) {
            array_push($this->currentTemplate["errors"], ['message' => $error]);
        }
        return $this->currentTemplate;
    }

    public function setError(string $error, int $code=500) 
    {
        if (!$this->checkingValidity(false)) {
            dd("ERROR");
        }
        if (!isset($this->currentTemplate)){
            
            $this->currentTemplate  = self::TEMPLATE_FAIL;
        }
        if (!$this->init) {
             $this->initFailTemplate();
        }
        $this->setCode($code);
        array_push($this->currentTemplate["errors"], ['message' => $error]);
    }

    public function initFailTemplate(int $code=500, array $headers=[]) {

        $this->currentTemplate  = self::TEMPLATE_FAIL;
        $this->currentTemplate["code"] = $code;
        $this->headers = $headers;
        $this->init = true;
        $this->isSuccess = false;

    }

    public function getTemplate() : array
    {
        return $this->currentTemplate;
    }
    public function initSuccessTemplate(int $code=200,  array $headers=[])
    {
        $this->currentTemplate  = self::TEMPLATE_SUCCESS;
        $this->currentTemplate["code"] = $code;
        $this->headers = $headers;
        $this->isSuccess = true;
        $this->init = true;
    }
    public function setHeaders(array $headers) : void
    {
            $this->headers = $headers;
         
    }
    public function setCode(int $code) : void 
    {
            $this->currentTemplate["code"] = $code;
    }
    public function getCode() : int
    {
        return $this->currentTemplate["code"];

    }
    public function getHeaders() : array
    {
        return $this->headers;
    }
    public function setData(mixed $data)  : void
    {
        if (!$this->checkingValidity(true)) {
            dd("ERROR");
        }
        if (!$this->init) {
            $this->initSuccessTemplate();
        }
        array_push($this->currentTemplate["data"], $data);

    }

    private function checkingValidity(bool $success) : bool
    {
        return !isset($this->isSuccess) || $this->isSuccess == $success;
    }


}

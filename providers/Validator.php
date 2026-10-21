<?php
namespace App\Providers;

class Validator {

    private $errors = array();
    private string $key;
    private string $value;
    private string $name;

    public function field(string $key, string $value, $name = null){
        $this->key = $key;
        $this->value = $value;
        if($name == null){
            $this->name = ucfirst($key);
        }else{
            $this->name = ucfirst($name);
        }
        return $this;
    }


    //regles

    public function required($message = null){
        if(empty($this->value)){
            $this->errors[$this->key] = $message ?? "$this->name is required";
        }
        return $this;
    }

    public function min(int $length){
        if(strlen($this->value) < $length){
            $this->errors[$this->key]="$this->name must be equal or greatter than $length characters";
        }
        return $this;
    }

      public function max(int $length){
        if(strlen($this->value) > $length){
            $this->errors[$this->key]="$this->name must be equal or less than $length characters";
        }
        return $this;
    }

    public function int($message = null){
        if(filter_var($this->value, FILTER_VALIDATE_INT) === false){
            $this->errors[$this->key] = $message ?? "$this->name must be an integer";
        }
        return $this;
    }

    public function email(){
        if(!empty($this->value) && !filter_var($this->value, FILTER_VALIDATE_EMAIL)){
             $this->errors[$this->key]="Invalid $this->name format";
        }
        return $this;
    }

    public function numeric(){
        if(!is_numeric($this->value)){
            $this->errors[$this->key]="$this->name must be a number";
        }
        return $this;
    }

    //-- regles fin

    public function isSuccess(){
        if(empty($this->errors)) return true;
    }

    public function getErrors(){
        if(!$this->isSuccess()) return $this->errors;
    }
}


<?php

class NI_request{
    public static $data = [];
    
    public static function FromatPostData($str){
        $arr = explode('&',$str);
        $newarr = [];
        foreach ($arr as $temp) {
            $temparr = explode('=',$temp);
            $key = $temparr[0];
            $value = is_numeric($temparr[1]) ? (int)$temparr[1] : str_replace('%40','@',(string)$temparr[1]);
            $newarr[$key] = $value;
        }
        return $newarr;
    }
    public static function all(){
        foreach ($_POST as $key => $value) {
            if (is_array($_POST[$key])) {
                $var =implode(',', $_POST[$key]);
                $_POST[$key] = is_numeric(NI_security::check($var)) ? (int)NI_security::check($var) : NI_security::check($var);
            }else{
                $_POST[$key] = is_numeric(NI_security::check($value)) ? (int)NI_security::check($value) : NI_security::check($value);
            }
           
        }
        return $_POST;
    }
    
    public static function validate($data = array()){
        $TempErrorCheck = [];
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                if (is_array($value)) {
                    $data[$key] = NI_security::PoolFilterus($value, self::all()[$key] ?? false)[1] ?? false ;
                    if ($data[$key] == false) $TempErrorCheck[] =  $key.' not valid';
                }else{
                    $data[$key] = NI_security::Filterus($value, self::all()[$key] ?? false)[1] ?? false ;
                    if ($data[$key] == false) $TempErrorCheck[] =  $key.' not valid';
                }
            }
        }
        if (empty($TempErrorCheck)) {
            return $data;
        }else {

            if (DEV == true) {
                throw new Exception(implode(', ',$TempErrorCheck), 1);
            }else{
                echo '<pre>';
                var_dump($TempErrorCheck);
                exit();
            }
        }
        
    }

    public static function APiall(array $arr){
        foreach ($arr as $key => $value) {
            if (is_array($arr[$key])) {
                $var =implode(',', $arr[$key]);
                $arr[$key] = is_numeric(NI_security::check($var)) ? (int)NI_security::check($var) : NI_security::check($var);
            }else{
                $arr[$key] = is_numeric(NI_security::check($value)) ? (int)NI_security::check($value) : NI_security::check($value);
            }
           
        }
        return $arr;
    }

    public static function API_validate(array $post_data,$data = array()){
        $TempErrorCheck = [];
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                if (is_array($value)) {
                    $data[$key] = NI_security::PoolFilterus($value, $post_data[$key] ?? false)[1] ?? false ;
                    if ($data[$key] == false) $TempErrorCheck[] =  $key.' not valid';
                }else{
                    $data[$key] = NI_security::Filterus($value, $post_data[$key] ?? false)[1] ?? false ;
                    if ($data[$key] == false) $TempErrorCheck[] =  $key.' not valid';
                }
            }
        }
        if (empty($TempErrorCheck)) {
            return self::APiall($data);
        }else {

            if (DEV == true) {
                throw new Exception(implode(', ',$TempErrorCheck), 1);
            }else{
                echo '<pre>';
                var_dump($TempErrorCheck);
                exit();
            }
        }
        
    }

    public static function validate_obj(object $object, array $data) : bool
    {
        $arr = self::validate($data);
        foreach ($arr as $key => $value) {
            $object->$key = $value;
        }
        if($object->save()){
            return true;
        }else{
            return false;
        }

    }



}

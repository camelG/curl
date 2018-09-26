# curlData    
## Description    
* curlData  
## Config  
* $url  
* $data  
* $data_type ['json','string']  
* $type ['POST','GET']  
## Code  

class Curl{  
    public function curlData($url, $data,$data_type = 'json', $type = 'POST')  
    {  
  
        $ch = curl_init();  
        curl_setopt($ch, CURLOPT_URL, $url);  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);  
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data'));  
  
        if(! $result = curl_exec($ch) ){  
           echo curl_error($ch);  
        }  
        curl_close($ch);  
  
        if($data_type == 'json'){  
            $res = json_decode($result);  
        }  
  
        if($data_type == 'string'){  
            parse_str($result, $res);   
        }  
  
        return $res;  
    }  
  
}  
  
## Licence    
[MIT](https://github.com/tcnksm/tool/blob/master/LICENCE)    
    
## Author    
[camelG](https://github.com/camelG)  
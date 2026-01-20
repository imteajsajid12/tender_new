<?php
/**
 * generate file name of tender application's submitted files
 * @param mixed $applicant_name
 * @param mixed $fileTitle label of submitted file input filed from Form.php
 * @param int $primaryMax maxIdOf table primary key
 * @param mixed $fileExtension file extension name
 * @return string
 */
function makeFileName($applicant_name, $fileTitle,$fileExtension='pdf'){
    $publicPathLength = strlen(public_path());
    $__name = Str::
    of(uniqid("",true)." ".time()." ".
    
    Str::limit($fileTitle,150 - $publicPathLength,'_')
    
    )
    ->slug("_",null,[
        '@' => 'ok'
        ])
    
    ->limit(200,'')
    ;
    return Str::limit($__name->value()."@".\Str::limit($applicant_name,80,'' ).".{$fileExtension}",250,'' );
}

/**
 * search tender application's submitted file if name mismatch issue occur
 * @param mixed $file file basename only
 * @return mixed
 */
function uploadFileSearch($file){
    if(!file_exists(public_path(('upload/' .$file))) || preg_match("/\t/", $file)){
        $parts = explode('_',$file);

        if(isset($parts[0], $parts[1])){
            $initName = $parts[0].'_'.$parts[1].'_';
            $searchFile = glob(public_path(('upload/'.$initName.'*.*')));
            if(count($searchFile)){
                $file = str_replace("\t",'%09',basename($searchFile[0]));
            }
        }else{
            return $file;
        }
    }
    return $file;
}

?>

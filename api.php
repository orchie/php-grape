<?php
server();
function server(){
    $data =[];
    if(!isset($_GET['action'])){
        return;
    }
    switch($_GET['action']){
        case 'upload':
            $data = ['data'=>[]];
            $files = $_FILES['files'];
            if(!is_array($files) || empty($files)){
                return;
            }
            foreach($files['tmp_name'] as $k=>$v){
                $path = "/uploads/{$files['name'][$k]}";
                move_uploaded_file($v,".".$path);
                $data['data'][] = "http://{$_SERVER['HTTP_HOST']}{$path}";
            }
            break;
    }
    echo json_encode($data);
}

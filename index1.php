<?
    session_start();
    require "vendor/autoload.php";
    use Aws\S3\S3Client;
    use Aws\S3\Exception\S3Exception;

    if(isset($_FILES['file'])){
        s3_upload_put_object($_Files['file']);
    }

    function s3_upload_put_object($file){
        $options = [
            'region' => 'us-east-1',
            'version' => '2.3.0',
            'credentials' => [
                'key' => 'AKIA5ZOXQKRL5TR3F3VO',
                'secret' => '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'
                ]
            ];
            $file_name = $file['name'];
            $file_path = $file['tmp_name'];
            try{
                $s3Client = new S3Client($options);
                $resut = $s3Client->putObject([
                    'Bucket' => 'documentos-umg',
                    'key' => $file_name,
                    'sourceFile' => $file_path,
                ]);
                echo "<pre>".print_r($resut,true)."</pre>";
            }catch(S3Exception $e){
                echo $e->getMessage() . "\n";
            }
    }

?>
<!DOCTYPE html>
<html>
<head>
<title>Subir Archivos a S3</title>
</head>
<body>

<h1>Suba el archivo</h1>
<form action="" method="post" enctype="multipart/form-data">
    <label for="file">subir archivos</label>
    <input type="file" name="file" id="file"/>
    <button type="submit">Subir o cargar</button>
</body>
</html>
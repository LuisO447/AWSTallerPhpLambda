<?

    define(ACCESS_KEY, "AKIA5ZOXQKRL5TR3F3VO"); 
    define(SECRET_KEY, "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");

    session_start();
    require "vendor/autoload.php";

    use Aws\S3\S3Client;


    try {
        

        // dispara excessão caso não tenha dados enviados
        if (!isset($_FILES['file'])) {
            throw new Exception("File not uploaded", 1);
        }

        // crea el objeto para el cliente de s3
        $clientS3 = S3Client::factory(array(
            'key'    => ACCESS_KEY,
            'secret' => SECRET_KEY
        ));

        // envia los datos al bucket seleccionado
        $response = $clientS3->putObject(array(
            'Bucket' => "documentos-umg",
            'Key'    => $_FILES['file']['name'],
            'SourceFile' => $_FILES['file']['tmp_name'],
        ));

        $_SESSION['msg'] = "Objeto subido correctamente, direccion del objeto subido <a href='{$response['ObjectURL']}'>{$response['ObjectURL']}</a>";

        header("location: index.php");

    } catch(Exception $e) {
        echo "Error > {$e->getMessage()}";
    }

?>
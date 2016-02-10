<?php namespace App\Clusters\AuthCluster\Repositories\Seeds;

abstract class SeedRepository
{

    protected $_tableName = '';


    protected function seedFilesIterator( $subdirectory = '' )
    {
        $sp = DIRECTORY_SEPARATOR;
        $seedFilesBase = base_path() . $sp . 'app' . $sp . 'Clusters' . $sp . 'AuthCluster' . $sp . 'Resources' . $sp . 'Database' . $sp . 'Seeds' . $sp . 'src' . $sp;

        if ( $this->_tableName == '' ) {
            throw new \Exception( 'Property _tableName is not set!' );
        }

        $directory = $seedFilesBase . $this->_tableName . $subdirectory;
        $directoryIterator = new \RecursiveDirectoryIterator( $directory );
        $iterator = new \RecursiveIteratorIterator( $directoryIterator );

        foreach ( $iterator as $filePath => $fileObject ) {
            $path = $fileObject->getPath();
            $folderName = trim( substr( $path, strripos( $path, '/' ) ), '/' );

            if ( $fileObject->isFile() ) {
                $file = fopen( $filePath, 'r' );
                while ( !feof( $file ) ) {
                    yield [ 'content' => fgets( $file ), 'object' => $fileObject, 'folder' => $folderName ];
                }
                fclose( $file );
            }
        }
    }

    protected function seedDataComposer( $jsonData, array $extraData = [ ] )
    {
        $data = [ ];
        $content = json_decode( $jsonData['content'], TRUE );

        foreach ( $content as $key => $val ) {
            $data[$key] = $val;
        }

        foreach ( $extraData as $key => $val ) {
            $data[$key] = $val;
        }

        return $data;
    }

}
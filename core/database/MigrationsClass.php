<?php
namespace core\database;

use core\app\Application;
use PDO;
class MigrationsClass 
{
        public $pdo;
        public function __construct()
        {
            $this->pdo = Application::$app->db->pdo;
        }
        /*
        scenario
        i have files in migrations folder like m0001.php and m0002.php
        each file is class have two method up to make or add changes indb 
        and down do delete records from db
        like user table in m0001_user.php 
        when run method php -f migrations.pho
        it will run method apply migrations which get all migrations that happened 
        in database and return doffrent migration that is not applied yet 
        then
        make new instance of this migrations then run method up

    */
    public function createTableMigrations()
    {
        $this->pdo->exec("
            CREATE TABLE IF NOT EXISTS migrations (
                id INT(11) AUTO_INCREMENT PRIMARY KEY ,
                migration VARCHAR(255) ,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                ) ;
        ");
    }

    public function apllyMigration()
    {
        $appliedMigrations = [];
        $this->createTableMigrations();
        //saved mirations
        $allMigraionsFromDatabase  = $this->getAppliedMigrations();

        

        //all migrations files

        $files = scandir(APP_PATH."migrations");   
        
        $toAppliedMigrations  = array_diff($files , $allMigraionsFromDatabase);

        // loop through all migrations files

        foreach($toAppliedMigrations as $migrationFiles)
        {
            if($migrationFiles == "." || $migrationFiles == "..")
            {
                continue;
            }
            $migrationWithoutEtenstion = pathinfo($migrationFiles , PATHINFO_FILENAME);
            
            $appliedMigrations [] = $migrationFiles;

            require_once MIGRATIONS_PATH.$migrationFiles;
            $this->logs( " $migrationFiles applied "); 
            $migrationFilesClass = new $migrationWithoutEtenstion;
            $migrationFilesClass->up();
        }
        if(!empty($appliedMigrations))
        {
            $savAppliedMigrations = array_map(function($m){
                return  " ( '".$m."' ) ";
           }, $appliedMigrations);
         //  pre($savAppliedMigrations); 
         $this->saveMigratins($savAppliedMigrations);
        }else
        {
            echo " all migrations applied".PHP_EOL;
        }
    }   

    public function getAppliedMigrations()
    {
        $stmt = $this->pdo->prepare(" SELECT migration FROM migrations ");
        $stmt->execute();
       return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function saveMigratins(array $migrations)
    {
        if(!empty($migrations))
        {
                    $migrations = implode(" , " , $migrations);
        $stmt = $this->pdo->prepare( " INSERT INTO migrations ( migration ) VALUES  $migrations ");
        $stmt->execute();
        }else
        {
            echo " no applied migrations ".PHP_EOL;
        }

    }

    public function logs($message)
    {
        echo  date(" [ d-m-y H:i:s "). $message . " ]".PHP_EOL ;
    }

    public function dropMirations($migraiotn)
    {
        require_once MIGRATIONS_PATH.$migraiotn.".php";
        $this->logs( " Drop Function $migraiotn is being applling "); 
        $migrationFilesClass = new $migraiotn;
        $migrationFilesClass->drop();
        $this->logs( "Drop Function $migraiotn is applied  "); 
    }
}
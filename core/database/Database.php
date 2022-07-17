<?php
namespace core\database;

use PDO;

class Database 
{
    public $pdo;
    public $tableName = null;
    public $sql = null;
    public $bindings = [];
    public $select = null;
    public $where = null;
    public $stmt = null;
    public function __construct(array $config)
    {
        
        try {
            $dsn = $config['dsn'] ?? '';
            $username = $config['username'] ?? '';
            $password = $config['password'] ?? '';
            $this->pdo = new PDO($dsn , $username , $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
        } catch (\Exception $e) {
          echo  $e->getMessage();
        }
    }


    public function from($tableName)
    {
        $this->tableName = $tableName;
        return $this;
    }
    public function table($tableName)
    {
        $this->tableName = $tableName;
        return $this;
    }
        /*$this->from("users")->data([
         " name" => hasan
         "age   => 32  
     ])->insert();
    */
    public function data(array $data)
    {
        $sql = " SET ";
        foreach($data as $key => $value)
        {
            $sql .=  " $key = ? , ";
            $this->addToBindings($value);
        }
        $this->sql = trim($sql , ", ");

        return $this;
    }

    public function addToBindings($bindings)
    {
        
        if(!empty($this->bindings) AND is_array($bindings))
        {
            $this->bindings = array_merge($this->bindings , $bindings);
        }
        
        $this->bindings[] = $bindings;  


    }

   // $this->where("id = ?  and name =  ? " , [1 , 2])
    // 1 
    public function where(...$wheres)
    {
        $sql = " WHERE ";  
        $sql .= array_shift($wheres);   
        if(is_array($wheres[0]))
        {
            foreach($wheres[0] as $key => $value)
            {
                $this->addToBindings($value);
            }
        }else
        {
            $this->addToBindings($wheres[0]);
        }

        $this->where = $sql;
        return $this;

    }
    public function query($sql, $bindings)
    {
        // pre($bindings);die;
        $stmt = $this->pdo->prepare($sql);
    
        foreach($bindings as $key => $value)
        {
            $stmt->bindValue($key + 1 , $value);
        }
        try {
            $stmt->execute();
        } catch (\Exception $e) {
            echo $e->getMessage();
            pre($bindings);
            pre($sql);
        }
        return $stmt;
    }

    // insert into 
    public function insert($tableName = null)
    {
        if($tableName != null)
        {
            $this->tableName = $tableName;
        }
        $sql = " INSERT INTO ".$this->tableName." ";
        
        $sql .= $this->sql;
        
        $stmt = $this->query($sql, $this->bindings) ;
        $this->reset();
        return true;

    }


    // $this->select()->from()->where( id = ? , 1 )
    // $this->select()->from()->where([ id = ? and name = ? , 1,21])
    /**
     * 
     * @var string default null
     * @return Database object
     */
    public function select($select = " * ")
    {
        $sql = " SELECT ";
        if($this->select == null)
        {
            $sql .= $select;
        }else
        {
            $sql .= $this->select;
        }
        if($this->tableName)
        {

            $sql .= " FROM $this->tableName ";
        }
        if($this->where)
        {
            $sql .= $this->where;
        }
        
        $this->stmt = $this->query($sql, $this->bindings) ;
        return $this; 
    }

    public function fetch()
    {
     
      $results = $this->stmt->fetchAll(PDO::FETCH_CLASS);
      $result = array_shift($results);
      $this->reset();
      return $result;

    }
    public function fetchAll()
    {
        $this->reset();
        return $this->stmt->fetchAll(PDO::FETCH_CLASS);
    }


    // update  
    public function update($tableName = null)
    {
        if($tableName != null)
        {
            $this->tableName = $tableName;
        }
        $sql = " UPDATE  ".$this->tableName." ";
        
        $sql .= $this->sql;
        if($this->where)
        {
            $sql .= $this->where;
        }
        
        $stmt = $this->query($sql, $this->bindings) ;
        $this->reset();
        return $stmt->rowCount();

    }



        // insert into 
    public function delete($tableName = null)
        {
            if($tableName != null)
            {
                $this->tableName = $tableName;
            }
            $sql = " DELETE FROM   ".$this->tableName." ";
            
            $sql .= $this->sql;
            if($this->where)
            {
                $sql .= $this->where;
            }
            
            $stmt = $this->query($sql, $this->bindings) ;
            $this->reset();
            return $stmt->rowCount();
    
        }

    public function byQuery($sql , $bindings = [])
        {
            // pre($bindings);die;
            $stmt = $this->pdo->prepare($sql);
            
            if(! empty($bindings))
            {
                foreach($bindings as $key => $value)
                {
                    $stmt->bindValue($key + 1 , $value);
                } 
            }

            try {
                $stmt->execute();
            } catch (\Exception $e) {
                echo $e->getMessage();
                pre($bindings);
                pre($sql);
            }
            return $stmt;
    }

    public function reset()
    {
        $this->bindings = null;
        $this->stmt = null ;
        $this->where =null ;
        $this->select = null;
        $this->sql = null;
    }


 




}

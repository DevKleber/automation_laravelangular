<?php
class Conf_db extends DB{
    //função que pega a primary key
    public function getPk($table){
        if(DB_DRIVER == 'mysql'){

            $stmt = DB::prepare("DESCRIBE $table");
            $stmt->execute();
            
            foreach ($stmt->fetchAll() as $key => $c) {
                if (!empty($c->Key)) {
                    return $c->Field;
                }
            };
        }else{    
            $stmt = DB::prepare("SELECT a.attname, format_type(a.atttypid, a.atttypmod) AS data_type
            FROM   pg_index i
            JOIN   pg_attribute a ON a.attrelid = i.indrelid
                                AND a.attnum = ANY(i.indkey)
            WHERE  i.indrelid = '".$table."'::regclass
            AND    i.indisprimary;");
            $stmt->execute();
            $ar = current($stmt->fetchAll());
            return $ar->attname;
        }
    }
    //função que pega a primary key
    public function getInfoTable($table){
        if(DB_DRIVER == 'mysql'){
            $stmt = DB::prepare("DESCRIBE $table");
            $stmt->execute();
            return $stmt->fetchAll();
        }else if(DB_DRIVER == 'pgsql'){            

            $tableschema = explode(".",$table);
            $schema = $tableschema[0];
            $table = $tableschema[1];
            $stmt = DB::prepare("SELECT *
            FROM information_schema.columns
            WHERE table_schema = '$schema'
            AND table_name   = '$table'");
            $stmt->execute();
            return $stmt->fetchAll();            
        }
    }
    //função que pega as colunas de uma tabela    
    public function getColumns($table){
        if(DB_DRIVER == 'mysql'){

            $stmt = DB::prepare("DESCRIBE $table");
            $stmt->execute();
            
            foreach ($stmt->fetchAll() as $key => $c) {
                $colunas[$c->Field] = $c->Field;
            };
            return $colunas;
        }else if(DB_DRIVER == 'pgsql'){            

            $tableschema = explode(".",$table);
            $schema = $tableschema[0];
            $table = $tableschema[1];
            $stmt = DB::prepare("SELECT *
            FROM information_schema.columns
            WHERE table_schema = '$schema'
            AND table_name   = '$table'");
            $stmt->execute();
            $result = $stmt->fetchAll();
            
            // percorrendo as colunas da tabela
            foreach ($result as $key => $c) {
                $colunas[$c->column_name] = $c->column_name;
            };
            return $colunas;
        }
     }
    //função para pegar as tabelas de um banco de dados
    public function getTables(){
        if(DB_DRIVER == 'mysql'){
            $stmt = DB::prepare("SHOW TABLES");
            $stmt->execute();
            
            foreach ($stmt->fetchAll(PDO::FETCH_COLUMN) as $key => $t){
                $tables[] = $t;
            };
            return $tables;
        }else if(DB_DRIVER == 'pgsql'){
            $stmt = DB::prepare("SELECT * FROM pg_catalog.pg_tables order by schemaname");
            $stmt->execute();
            $result = $stmt->fetchAll();
            foreach ($result as $key => $value) {
                $colunas[$value->schemaname.'.'.$value->tablename] = $value->schemaname.'.'.$value->tablename;
            }
            return $colunas;

        }
     }
     //pegando colunas
    

}
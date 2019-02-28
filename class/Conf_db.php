<?php
class Conf_db extends DB{
    //função que pega a primary key
    public function getPk($table){
        $stmt = DB::prepare("DESCRIBE $table");
        $stmt->execute();

        foreach ($stmt->fetchAll() as $key => $c) {
            if (!empty($c->Key)) {
                return $c->Field;
            }
        };
    }
    //função que pega a primary key
    public function getInfoTable($table){
        $stmt = DB::prepare("DESCRIBE $table");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    //função que pega as colunas de uma tabela    
    public function getColumns($table){
        $stmt = DB::prepare("DESCRIBE $table");
        $stmt->execute();

        foreach ($stmt->fetchAll() as $key => $c) {
             $colunas[$c->Field] = $c->Field;
        };
        return $colunas;
     }
    //função para pegar as tabelas de um banco de dados
    public function getTables(){
        $stmt = DB::prepare("SHOW TABLES");
        $stmt->execute();
    
        foreach ($stmt->fetchAll(PDO::FETCH_COLUMN) as $key => $t){
             $tables[] = $t;
        };
        return $tables;
     }

}
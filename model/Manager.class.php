<?php

class Manager extends Conexao
{

    public function insertClient($table, $data)
    {
        $pdo = parent::get_instance();
        $fields = implode(", ", array_keys($data));
        $values = ":".implode(", :", array_keys($data));
        $dados = str_replace(",",".", $data);
        $sql = "INSERT INTO $table ($fields) VALUES ($values)";
        $statement = $pdo->prepare($sql);
        foreach($dados as $key => $value) {
            $statement->bindValue(":$key", $value, PDO::PARAM_STR);
        }
        $statement->execute();
    }

    public function insertLogs($table, $valor)
    {
        $pdo = parent::get_instance();
        $fields = implode(",", array_keys($valor));
        $values = ":".implode(", :", array_keys($valor));
        $sql = "INSERT INTO $table ($fields) VALUES ($values)";
        $statement = $pdo->prepare($sql);
        foreach($valor as $key => $value) {
            $statement->bindValue(":$key", $value, PDO::PARAM_STR);
        }

        $statement->execute();
    }

    public function listClient($table)
    {
        $pdo = parent::get_instance();
        $sql = "SELECT * FROM $table ORDER BY origem ASC";
        $statement = $pdo->query($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function listViagensMes($table, $mes, $id)
    {
        $pdo = parent::get_instance();
//        $sql = "SELECT * FROM $table WHERE MONTH(data_cadastro) = $mes AND YEAR AND motorista_id = $id ORDER BY data_cadastro ASC";
        $sql = "SELECT * FROM $table WHERE MONTH(data_cadastro) = $mes AND YEAR(data_cadastro) = YEAR(CURRENT_DATE()) AND motorista_id = $id ORDER BY data_cadastro ASC";
        $statement = $pdo->query($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function listViagensMesAdmin($table, $mes)
    {
        $pdo = parent::get_instance();
        $sql = "SELECT * FROM $table WHERE MONTH(data_cadastro) = $mes";
        $statement = $pdo->query($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function listar($table)
    {
        $pdo = parent::get_instance();
        $sql = "SELECT * FROM $table";
        $statement = $pdo->query($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function listar_mes($table, $mes)
    {
        $pdo = parent::get_instance();
        $ano_atual = date("Y");
        $sql = "SELECT * FROM $table WHERE YEAR(data_cadastro) = $ano_atual AND MONTH(data_cadastro) = $mes";;
        $statement = $pdo->query($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function listar_frota($table, $motorista_id)
    {
        $pdo = parent::get_instance();
        $sql = "SELECT * FROM $table where motorista_id = $motorista_id";
        $statement = $pdo->query($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function listViagensMes1($table, $id)
    {
        $pdo = parent::get_instance();
        $sql = "SELECT * FROM $table WHERE DATE(data_cadastro) < CONCAT(DATE_FORMAT(NOW(),'%Y-%m'), '-01') AND motorista_id = $id ORDER BY data_cadastro DESC";
        $statement = $pdo->query($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        // Agrupa por mês
        foreach ($result as $item) {
            $listaRelatorios[date('M Y', strtotime($item['data_cadastro']))][] = $item;
        }
        return $listaRelatorios;
    }

    public function listRelatorioAdmin($table)
    {
        $pdo = parent::get_instance();
        $sql = "SELECT * FROM $table WHERE DATE(data_cadastro) < CONCAT(DATE_FORMAT(NOW(),'%Y-%m'), '-01') ORDER BY data_cadastro DESC";
        $statement = $pdo->query($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        // Agrupa por mês
        foreach ($result as $item) {
            $listaRelatorios[date('M Y', strtotime($item['data_cadastro']))][] = $item;
        }
        return $listaRelatorios;
    }

    public function SomaMesAtual($table, $campo)
    {
        $pdo = parent::get_instance();
        $sql = "SELECT sum($campo) AS 'total' FROM $table WHERE MONTH(data_cadastro) = 1";
        $statement = $pdo->query($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function deleteClient($table, $id)
    {
        $pdo = parent::get_instance();
        $sql = "DELETE FROM $table WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(":id", $id);
        $statement->execute();
    }

    public function getInfo($table, $id)
    {
        $pdo = parent::get_instance();
        $sql = "SELECT * FROM $table WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(":id", $id);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function updateClient($table, $data, $id)
    {
        $pdo = parent::get_instance();
        $new_values = "";
        foreach ($data as $key => $value) {
            $new_values .= "$key=:$key, ";
        }
        $new_values = substr($new_values, 0, -2);
        $sql = "UPDATE $table SET $new_values WHERE id = :id";
        $statement = $pdo->prepare($sql);

        foreach ($data as $key => $value) {
            $statement->bindValue(":$key", $value, PDO::PARAM_STR);
        }
        $statement->execute();
    }

    public function totalMes($table, $mes, $valor, $id)
    {
        $pdo = parent::get_instance();
        $sql = "SELECT sum($valor) AS 'total' FROM $table WHERE MONTH(data_cadastro) = $mes AND YEAR(data_cadastro) = YEAR(CURRENT_DATE()) AND motorista_id = $id";
        $statement = $pdo->query($sql);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function totalDespesas($table, $mes, $id)
    {
        $pdo = parent::get_instance();
        $sql = "SELECT (sum(valor_frete) - sum(gasto_combustivel) - sum(gasto_pedagio) - sum(descarga)) AS 'total' FROM $table WHERE MONTH(data_cadastro) = $mes AND YEAR(data_cadastro) = YEAR(CURRENT_DATE()) AND motorista_id = $id";
        $statement = $pdo->query($sql);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function TotalContas($table, $mes)
    {
        $pdo = parent::get_instance();
        $sql = "SELECT (sum(valor)) AS 'total' FROM $table WHERE MONTH(data_cadastro) = $mes";
        $statement = $pdo->query($sql);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function TotalFGTS($table, $mes)
    {
        $pdo = parent::get_instance();
        $sql = "SELECT (sum(valor)) AS 'total' FROM $table WHERE categoria = 'FGTS' AND MONTH(data_cadastro) = $mes";
        $statement = $pdo->query($sql);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function TotalCOMBUSTIVEL($table, $mes)
    {
        $pdo = parent::get_instance();
        $sql = "SELECT (sum(valor)) AS 'total' FROM $table WHERE categoria = 'Combustivel' AND MONTH(data_cadastro) = $mes";
        $statement = $pdo->query($sql);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function TotalPedagio($table, $mes)
    {
        $pdo = parent::get_instance();
        $sql = "SELECT (sum(valor)) AS 'total' FROM $table WHERE categoria = 'Pedágio' AND MONTH(data_cadastro) = $mes";
        $statement = $pdo->query($sql);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function TotalPecas($table, $mes)
    {
        $pdo = parent::get_instance();
        $sql = "SELECT (sum(valor)) AS 'total' FROM $table WHERE categoria = 'Peças' AND MONTH(data_cadastro) = $mes";
        $statement = $pdo->query($sql);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function TotalSeguro($table, $mes)
    {
        $pdo = parent::get_instance();
        $sql = "SELECT (sum(valor)) AS 'total' FROM $table WHERE categoria = 'Seguro' AND MONTH(data_cadastro) = $mes";
        $statement = $pdo->query($sql);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function TotalRastreador($table, $mes)
    {
        $pdo = parent::get_instance();
        $sql = "SELECT (sum(valor)) AS 'total' FROM $table WHERE categoria = 'Rastreador' AND MONTH(data_cadastro) = $mes";
        $statement = $pdo->query($sql);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function TotalTudoAdmin($table, $mes)
    {
        $pdo = parent::get_instance();
        $sql = "SELECT (sum(valor)) AS 'total' FROM $table WHERE MONTH(data_cadastro) = $mes";
        $statement = $pdo->query($sql);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

//    public function totalAdmin($table, $mes, $id)
//    {
//        $pdo = parent::get_instance();
//        $sql = "SELECT (sum(mecanico) + sum(cte) + sum(pecas) + sum(rastreador) + sum(pedagio) + + sum(seguro) + sum(estacionamento) + sum(gasto_diverso)) AS 'total' FROM $table WHERE MONTH(data_cadastro) = $mes AND motorista_id = $id";
//        $statement = $pdo->query($sql);
//        $statement->execute();
//        return $statement->fetch(PDO::FETCH_ASSOC);
//    }

}

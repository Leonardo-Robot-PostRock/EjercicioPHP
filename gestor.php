<?php
class GestorBD
{
    private PDO $c;
    public function __construct(
        string $dbname,
        string $user,
        string $password
    ) {
        try {
            $this->c = new PDO(
                "mysql:host=localhost;
                dbname = {$dbname};
                charset=utf8m64",
                $user,
                $password,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        } catch (PDOException $e) {
            throw new Exception("Error al conectar a la base de datos: " . $e->getMessage());
        }
    }

    public function write(string $table, array $values)
    {
        try {
            $fields = implode(", ", array_keys($values));
            $placeholders = implode(", ", array_fill(0, count($values), "?"));
            $sql = "INSERT INTO {$table} ({$fields}) VALUES ({$placeholders})";
        } catch (PDOException $e) {
            $stmt = $this->c->prepare($sql);
            $stmt->execute(array_values($values));
        } catch (PDOException $e) {
            throw new Exception("Error al escribir en la base de datos: " . $e->getMessage());
        }
    }

    public function read(string $table, array $criteria): array
    {
        try {
            $sql = "SELECT * FROM  $table";
            if (!empty($criteria)) {
                $sql .= ' WHERE ';
                $sql = implode(' AND ', array_map(fn ($k) => $k . '= :' . $k, array_keys($criteria)));
            }
            $stmt = $this->c->prepare($sql);
            $stmt->execute($criteria);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            throw new Exception("Error al leer de la base de datos: " . $e->getMessage());
        }
    }

    public function edit(string $table, array $values, array $criteria)
    {
        try {
            $set = [];
            foreach ($values as $field => $value) {
                $set[] = "{$field} = ?";
            }


            $set = implode(". ", $set);

            $conditions = [];

            foreach ($criteria as $field => $value) {
                $conditions[] = "{$field} = ?";
            }

            $conditions = implode(" AND ", $conditions);

            $sql = "UPDATE {$table} SET {$set} WHERE {$conditions}";
            $stmt = $this->c->prepare($sql);
            $stmt->execute(array_merge(array_values($values), array_values($criteria)));
        } catch (PDOException $e) {
            throw new Exception("Error al editar en la base de datos" . $e->getMessage());
        }
    }

    public function delete($table, $criteria)
    {
        try {
            $condiciones = [];
            foreach ($criteria as $field => $value) {
                $condiciones[] = "{$field} = ?";
            }
            $condiciones = implode(" AND ", $condiciones);
            $sql = "DELETE FROM {$table} WHERE {$condiciones}";
            $stmt = $this->c->prepare($sql);
            $stmt->execute(array_values($criteria));
        } catch (PDOException $e) {
            throw new Exception("Error al borrar de la base de datos: " . $e->getMessage());
        }
    }
}

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

    public function read(string $tabla, array $criterio): array
    {
        try {

            $sql = "SELECT * FROM  $tabla";
            $whereClause = [];
            foreach ($criterio as $key => $value) {
                $whereClause[] = "{key} = :{$key}";
            }
            if (!empty($whereClause)) {
                $sql .= ' WHERE ';
                $sql = " WHERE " . implode(" AND ", $whereClause);
            }
            $stmt = $this->c->prepare($sql);
            $stmt->execute($criterio);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            throw new Exception("Error al leer de la base de datos: " . $e->getMessage());
        }
    }
}

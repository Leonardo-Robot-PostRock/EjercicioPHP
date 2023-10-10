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

    public function leer(string $tabla, array $criterio): array
    {
        try {

            $sql = "SELECT * FROM  $tabla";
            $whereClause = [];
            if (!empty($criterio)) {
                $sql .= ' WHERE ';
                $sql = implode(' AND ', array_map(fn ($k) => $k . '= :' . $k, array_keys($criterio)));
            }
            $s = $this->c->prepare($sql);
            $s->execute($criterio);
            $r = $s->fetchAll(PDO::FETCH_ASSOC);
            return $r;
        } catch (PDOException $e) {
            throw new Exception("Error al leer de la base de datos: " . $e->getMessage());
        }
    }
}

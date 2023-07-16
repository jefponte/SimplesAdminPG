# SimplesAdminPG
Simple tool for postgres database management.


**Simple way:**
```php
use SimplesAdminPG\AdminPG;
include_once "SimplesAdminPG/AdminPG.php";

$conexao = new PDO( 'pgsql:host=localhost port=5432 dbname=ocorrencias user=postgres password=postgres');
AdminPG::main($conexao);
```

**Practical way:**
docker compose up -d


Nothing more to say. Just enjoy yourself!
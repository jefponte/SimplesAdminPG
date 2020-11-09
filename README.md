# SimplesAdminPG
Ferramenta simples para gerenciamento de banco postgrs. 

**Como usar:**

```php
use SimplesAdminPG\AdminPG;
include_once "SimplesAdminPG/AdminPG.php";

$conexao = new PDO( 'pgsql:host=localhost port=5432 dbname=ocorrencias user=postgres password=postgres');
AdminPG::main($conexao);
```
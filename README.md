# SimplesAdminPG
Ferramenta simples para gerenciamento de banco postgrs. 


**Simple way:**
```php
use SimplesAdminPG\AdminPG;
include_once "SimplesAdminPG/AdminPG.php";

$conexao = new PDO( 'pgsql:host=localhost port=5432 dbname=ocorrencias user=postgres password=postgres');
AdminPG::main($conexao);
```

<img src="https://kinsta.com/pt/wp-content/uploads/sites/3/2019/08/configurando-formulario-google.png">
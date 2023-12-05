### Executar containers:

```bash
docker compose up -d
```

### Instalar dependências:

```bash
docker compose exec app composer install
```

### Executar crawler:

```bash
    docker compose exec app php src/answer.php
```
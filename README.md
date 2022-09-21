# blogCeisc

Um sistema para gerenciar a criação, leitura, atualização e exclusão de postagens.


## Tecnologias

- **PHP com framework Laravel**


## Execução

Para iniciar é necessário clonar o projeto do GitHub num diretório de sua preferência:

```bash
  git clone https://github.com/williamsilva95/blogCeisc.git
```

#### Faça uma copia do arquivo .env.example e deixe apenas como .env na mesma pasta do projeto

Com o terminal aberto na pasta do projeto, instale as dependências do projeto 

```bash
  composer install
```

Rode as migrations

```bash
  php artisan migrate
```

Crie um link simbólico de onde ficaram armazenado as imagens

```bash
  php artisan storage:link
```

Utilize o comando abaixo para gerar o link de inicialização do projeto

```bash
  php artisan serve
```


## Utilizando o sistema

Com o sistema já aberto, crie um usuário para poder ter acesso às funções

O sistema permite:

- Criação, leitura, atualização e exclusão de postagens
- Exportar para uma planilha do Excel as postagens feitas no sistema
- O sistema permite vc curtir ou não uma determinada postagem
- Fazer upload de imagens

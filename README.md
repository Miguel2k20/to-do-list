# To do list Do Miguel

## Siga a documentação abaixo para rodar o projeto em sua maquina! 

### Requisitos para rodar o projeto:
- Docker
- Node versão v18.13
- Yarn

# Backend
1 - Duplicar o arquivo [Env Example](backend-laravel/.env.example) para .env para inserir as informacoes de acesos ao banco de dados, esses dados estão no arquivo [Docker compose.](backend-laravel/.env.example)

2 - Dentro da pasta [Backend Laravel](backend-laravel/) ligue um terminal, de preferência de um sistema linux 

3 - Ative todos os os containers.

```bash
$ docker-compose --env-file=.env.docker up -d
```
4 - Entre no container aonde está rodando nossa api

```bash
$ docker-compose --env-file=.env.docker exec app bash 
```
5 - Dentro do container, deve rodar o comando para gerar a chave de criptografia do Laravel

```bash
$ php artisan key:generate
```
6 - Rode o artisan para ele criar seu banco de dados

```bash
$ php artisan migrate
```   

# FrontEnd

Dentro da pasta [Frontend Vue](frontend-vue/) ligue um terminal, de preferência de um sistema linux

1 - Instale os pacotes do projeto
```bash
$ yarn install
```

2 - Rode o seguinte comando.
```bash
$ yarn dev
```

## Com isso você terá o backend e o frontend rodando



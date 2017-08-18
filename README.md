# Shop Challenge Bundle - Pagar.me

Autor: Leonam Pereira Dias <leonam.pd@gmail.com>

### Requisitos

-  PHP 7.1

### Rodando a aplicação (com Built-in server)

- No diretório `application` instale/atualize o projeto e suas dependências:
```
composer install
``` 

- Ainda no diretório `application` rode o comando:
```
php bin/console server:run
```

- Acesse a aplicação em seu navegador através do endereço:
```
http://localhost:8000
```

### Rodando a aplicação (utilizando o Docker for Mac)

1 - crie uma nova máquina virtual para o projeto
```
docker-machine create pagarme
```

2 - Obtenha o IP da máquina virtual criada:
```
eval $(docker-machine env pagarme)
```

3 - Provisione os containers
```
docker-compose up -d
```

5 - Adicione o endereço (`pagarme.dev`) da aplicação no seu arquivo `/etc/hosts`

5.1 - Obtenha o IP da máquina com `docker-machine env pagarme`

5.2 - Adicione a entrada no arquivo
```
<IP fornecido no passo 5.1> pagarme.dev
```

6 - Acesse a aplicação em seu navegador pelo endereço: `http://pagarme.dev`



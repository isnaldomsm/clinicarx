# Avaliação de conhecimentos em PHP

Este projeto busca avaliar conhecimentos de candidatos à vagas para trabalhar no
clinicarx.

O desafio é fazer com que todos os testes do PHPUnit sejam bem sucedidos.

## Instalação via `docker`

Pré-requisitos:

* [git](https://git-scm.com/)
* [docker](https://docs.docker.com/install/#server)
* [docker-compose](https://docs.docker.com/compose/install/)

O candidato deverá clonar o repositório e, na pasta do projeto, gerar a build do docker:

```bash
git clone https://clinicarx.dev/challenge/php.git
cd avaliacao-php
docker-compose run install
```

Para que os testes envolvendo models e controllers funcionem, é necessário que o
o banco de dados esteja configurado corretamente. O banco de dados escolhido 
para este projeto é o Sqlite3, devido à simplicidade dele.

Leia e edite o arquivo `config/app.php` e defina a propriedade `'Datasources'` 
e qualquer outra configuração relevante para a realização das tarefas.  
Todos os commits podem ser feitos diretamente no branch `master`

## Executando os testes

Na pasta do projeto, execute o comando:

```
docker-compose run phpunit
```

## Tarefas

Lista de correções e melhorias necessárias.

**\Rx\Controller\Articles**:

- Filtrar os resultados da paginação de Artigos para que não sejam retornados 
artigos não publicados.


**\Rx\Auth\AccessControl**:

- Implementar todas as funções de desabilitar atributos.

      $access->disableAdminRead();
      $access->disableAdminWrite();
      $access->disableAdminExecute();
      $access->disableUserRead();
      $access->disableUserWrite();
      $access->disableUserExecute();
      $access->disableGuestRead();
      $access->disableGuestWrite();
      $access->disableGuestExecute();

**\Rx\Parser\Csv**:  

- Converter um CSV usando `;` como separador de colunas
- Converter um CSV ignorando linhas vazias
- Converter um CSV retirando espaços no final de cada célula


**\Rx\Parser\Collection**:  

- Fazer com que a classe fique iterável

## Conclusão

Durante a realização das tarefas, as alterações devem ser commitadas, para criar
uma linha do tempo compreensível no histórico do git.

Quando todos os 14 testes estiverem passando pelo PHPUnit, o repositório deve
ser encapsulado num arquivo bundle.

```
git bundle create rx_avaliacao.bundle master
```

O arquivo gerado (`rx_avaliacao.bundle`) deve ser enviado para o email: 
[alysson@clinicarx.com.br](mailto:alysson@clinicarx.com.br)

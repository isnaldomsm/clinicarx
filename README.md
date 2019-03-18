# Avaliação de conhecimentos em PHP

[![Build Status](https://img.shields.io/travis/rxsaude/avaliacao/master.svg?style=flat-square)](https://travis-ci.org/rxsaude/avaliacao)

Este projeto busca avaliar conhecimentos de candidatos à vagas para trabalhar no
clinicarx.

O desafio é fazer com que todos os testes do PHPUnit sejam bem sucedidos.

## Instalação

Requisitos:

* [Git](https://git-scm.com/)
* [PHP 7.2](http://php.net/)
* [Composer](https://getcomposer.org/doc/00-intro.md)

Para instalar as dependências no linux, use os comandos abaixo:

```bash
sudo apt-get install git php7.2-cli php7.2-intl php7.2-json \
                     php7.2-mbstring php7.2-sqlite3 php7.2-xml \
                     php7.2-zip php-xdebug composer
```

O candidato deverá clonar o repositório e, na pasta do projeto, executar o 
comando:

```bash
git clone https://bitbucket.org/rxsaude/avaliacao.git
cd avaliacao
composer install
```

Para que os testes envolvendo models e controllers funcionem, é necessário que o
o banco de dados esteja configurado corretamente. O banco de dados escolhido 
para este projeto é o Sqlite3, devido à simplicidade dele.

Leia e edite o arquivo `config/app.php` e defina a propriedade `'Datasources'` 
e qualquer outra configuração relevante para a realização das tarefas.

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

## Executando os testes

Na pasta do projeto, execute o comando:

```
vendor/bin/phpunit --testdox tests
```

## Conclusão

Durante a realização das tarefas, as alterações devem ser commitadas, para criar
uma linha do tempo compreensível no histórico do git.

Quando todos os 14 testes estiverem passando pelo PHPUnit, o repositório deve
ser encapsulado num arquivo bundle.

```
git bundle create avaliacao.bundle master
```

O arquivo gerado (`rx_avaliacao.bundle`) deve ser enviado para o email: 
[alysson@rxsaude.com.br](mailto:alysson@rxsaude.com.br)

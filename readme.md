# Avaliação de conhecimentos em PHP

Este projeto busca avaliar conhecimentos de candidatos à vagas para trabalhar no
clinicarx.

O desafio é fazer com que todos os testes do PHPUnit sejam bem sucedidos.

## Instalação

Requisitos:

* Git
* PHP 7.2 ou mais recente
* Composer

O candidato deverá clonar o repositório e, na pasta do projeto, executar o 
comando:

```
composer install
```

## Tarefas

Lista de correções e melhorias necessárias.

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
git bundle create rx_avaliacao.bundle master
```

O arquivo gerado (`rx_avaliacao.bundle`) deve ser enviado para o email: 
[alysson@rxsaude.com.br](mailto:alysson@rxsaude.com.br)

## Lumen TDD

Esse repositório tem como proposito servir como base para iniciar no mundo do TDD.
A ideia do projeto em si acredito que não seja tão importante mas procuro utilizar exemplos
que tenham haver com algo que gosto para tornar o aprendizado menos maçante. Nesse caso, essa é uma simples
API que faz crawling de modelos na Web e retorna o JSON com as informações.

Esse repositório foi ideia do grande Augusto Pascutti. Obrigado!
Quem pude ou quiser contribuir de qualquer forma sinta-se livre.

## Simples setup

O setup desse projeto é simples:
```
composer update
```

configurar o arquivo .env que terá informações de ambiente como bd e etc, ter uma base de dados
com o nome "girls" e rodar as migrations para criar as tabelas no banco:

```
php artisan migrate
```
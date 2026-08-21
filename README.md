# Bronze Podcast — tema WordPress + WooCommerce

Tema personalizado para reconstruir `bronzepodcast.com` em código, com o catálogo, carrinho e checkout geridos pelo WooCommerce e pagamentos processados pelo Stripe.

## Estado atual

- Identidade visual e tipografia do Bronze Podcast.
- Cabeçalho responsivo e navegação móvel.
- Página inicial com hero, episódios e produtos recentes.
- Templates de páginas, artigos, arquivo, pesquisa e erro 404.
- Integração base com WooCommerce.
- Preparado para traduções e para um tema-filho no futuro.

## Instalação

1. Criar um novo site WordPress na Hostinger.
2. Instalar e ativar WooCommerce.
3. Instalar o plugin oficial **WooCommerce Stripe Payment Gateway**.
4. Copiar `wp-content/themes/bronzepodcast` para o WordPress.
5. Ativar **Bronze Podcast** em `Aparência → Temas`.
6. Criar e atribuir o menu principal à localização **Menu principal**.
7. Em `Definições → Leitura`, escolher uma página estática como página inicial.

## Próximas etapas

- Importar os produtos, imagens e artigos do site atual.
- Configurar portes, impostos, emails e Stripe em modo de teste.
- Substituir os recursos visuais remotos por cópias locais otimizadas.
- Fazer validação visual em desktop e telemóvel.
- Preparar a transição do domínio sem interromper a loja atual.

## Estrutura

O repositório guarda apenas código e configuração versionável. Produtos, encomendas, clientes e conteúdos permanecem na base de dados WordPress e nunca devem ser enviados para o GitHub.


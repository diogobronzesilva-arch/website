# Diogo Silva — diogobronzesilva.com

HTML e CSS estáticos. Sem build, sem dependências, sem framework, sem JavaScript. Um ficheiro CSS. Carrega-se para qualquer alojamento e funciona.

Domínio definitivo: **diogobronzesilva.com**. Email público: **hello@diogobronzesilva.com**.

## 1. Estrutura de ficheiros

```
index.html                 → /
notes/index.html           → /notes/
notes/<slug>/index.html    → /notes/<slug>/   (um por artigo)
notes/_template.html       → não publicado, é o molde para artigos novos
contact/index.html         → /contact/
404.html                   → página de erro, fica na raiz
feed.xml                   → /feed.xml (RSS)
sitemap.xml, robots.txt, .htaccess
assets/css/site.css        → toda a folha de estilos
assets/img/                → imagens, incluindo assets/img/notes/ (as vinhetas dos artigos)
```

Cada pasta de conteúdo (`notes/`, `contact/`, `notes/<slug>/`) tem um `index.html` lá dentro. É assim que se conseguem URLs limpas (`/notes/` em vez de `/notes.html`) sem servidor de aplicações nem rewrite complicado: o Apache serve `index.html` automaticamente quando alguém pede a pasta.

## 2. Colocar online no Hostinger

1. hPanel → **Websites** → o domínio → **File Manager**.
2. Entra em `public_html` e apaga tudo o que lá estiver.
3. Faz upload do `.zip` e usa **Extract** dentro do File Manager.
4. Arrasta o conteúdo da pasta extraída (não a pasta em si) para a raiz de `public_html`. No fim, `public_html` deve ter directamente `index.html`, `notes/`, `contact/`, `404.html`, `.htaccess`, `feed.xml`, `sitemap.xml`, `robots.txt`, `assets/`.
5. Confirma que o `.htaccess` veio no upload: **Settings → Show hidden files**, porque começa por ponto.
6. Liga o domínio `diogobronzesilva.com` em **Connect domain** e activa o SSL gratuito.
7. Depois do SSL activo, abre o `.htaccess` e descomenta o bloco *Force HTTPS* no fim do ficheiro.

### Se estavas antes no domínio temporário Hostinger

O `.htaccess` já vem preparado com um bloco comentado que reencaminha automaticamente qualquer visita ao subdomínio `hostingersite.com` para `diogobronzesilva.com`, página a página, com 301. Descomenta esse bloco quando o domínio definitivo estiver activo. Enquanto isso, o subdomínio temporário já está marcado com `noindex`, para não ser indexado pelo Google.

## 3. URLs antigas (o site já usou `.html`)

Se este site já esteve online com URLs do tipo `/notes.html` ou `/notes/algum-artigo.html`, o `.htaccess` já traz redirects 301 permanentes de cada uma dessas URLs para a versão limpa correspondente. Não precisas de fazer nada, e nenhuma partilha ou marcador antigo fica quebrado.

## 4. Publicar uma nota nova

1. Cria uma pasta nova dentro de `notes/`, com o nome do artigo em minúsculas e hífenes: `notes/o-que-aprendi-em-2026/`.
2. Copia `notes/_template.html` para dentro dessa pasta, com o nome `index.html`.
3. Muda: `<title>`, `<meta name="description">`, o `canonical`, o `og:url`, o JSON-LD (`mainEntityOfPage`, `description`, `datePublished`, `inLanguage`), as duas datas na `<time>`, o `<h1>`, o standfirst (ou apaga-o, é opcional), a vinheta em `<figure class="device">` (reutiliza uma de `assets/img/notes/` ou apaga o bloco todo), e o texto dentro de `<div class="prose">`.
4. Abre `notes/index.html`. Se esta for a primeira nota escrita depois de 2022, cria um cabeçalho novo, por exemplo `<h2 class="notes-section">2026</h2>`, antes do cabeçalho `Archive`, e cola lá o bloco `<a class="entry">`. Se for mais uma nota recente, cola-a no topo dessa secção nova.
5. Acrescenta uma linha em `sitemap.xml` e um `<item>` no topo de `feed.xml` (datas em formato RFC 822, o Python sabe gerar isto: `date -R` na consola também serve).
6. A secção na home chama-se agora **Selected Notes** (desde 20 de Agosto de 2026) e mostra três peças escolhidas a dedo, não as três mais recentes por data — ver secção 12. Não a actualizes automaticamente a cada nota nova. Quando publicares a primeira nota de 2026, troca a secção de volta para **Latest Notes**, mostra aí as três mais recentes por data (a partir dessa nota nova), e passa a actualizá-la normalmente, substituindo a entrada mais antiga das três a cada nota nova, como antes.

Dentro do texto usa `<p>`, `<blockquote>`, `<ul><li>`, `<hr>` e links com `<a class="link" href="...">`. Evita `<h2>`/`<h3>` dentro dos artigos a não ser que o texto tenha secções genuinamente distintas: o estilo do site é o de um ensaio corrido, não o de um artigo de blog com subtítulos a cada parágrafo.

## 5. Newsletter

O formulário é HTML puro, aponta para o Buttondown, e existe em quatro sítios: na home, no índice das notas, e no fim de cada artigo. Todos partilham o mesmo `action`, já com a conta real: `buttondown.com/api/emails/embed-subscribe/bronze_da_silva`. Cada formulário tem também um campo escondido `<input type="hidden" name="embed" value="1">`, que é o que a Buttondown recomenda nos seus próprios exemplos para devolver a página de confirmação bonita em vez da resposta em bruto da API.

Se um dia mudares de conta ou de serviço, o find & replace é por `buttondown.com/api/emails/embed-subscribe/bronze_da_silva`.

**Por testar manualmente:**
- Submete o formulário com um email real e confirma que o Buttondown abre a página de confirmação num separador novo (o `target="_blank"` já está preparado para isso).
- Confirma que chega um email de confirmação (o Buttondown usa double opt-in por definição) e que o link de confirmação funciona.
- Confirma que o link de unsubscribe, presente em qualquer email que o Buttondown envie, funciona.
- Testa também o estado de erro: submete sem preencher o campo, ou com um email inválido. A validação é feita pelo browser (`type="email"` e `required`), portanto não devias precisar de nada mais, mas vale a pena confirmar em Chrome, Safari e no teclado do telemóvel.

Não escrevi nem testei nenhum destes passos por não ter acesso à tua conta do fornecedor. É a única peça do site que depende de um serviço fora do teu controlo directo.

## 6. SEO, Open Graph e dados estruturados

- Todas as páginas têm `title`, `meta description`, `canonical`, Open Graph completo (`title`, `description` na home, `url`, `image`, `site_name`) e `twitter:card`.
- Cada página tem o seu próprio cartão de partilha em `assets/img/og/<slug>.jpg`, 1200×630, gerado na mesma linguagem visual do site: papel, Newsreader, filete a bronze. O `og.jpg` único deixou de existir. Para uma nota nova, gera um cartão com o mesmo molde e aponta-lhe todas as tags `og:image` e `twitter:image`; enquanto não o gerares, `assets/img/og/notes.jpg` serve de reserva.
- As tags de imagem vêm sempre em conjunto: `og:image`, `og:image:secure_url`, `og:image:type`, `og:image:width`, `og:image:height`, `og:image:alt`, `twitter:image` e `twitter:image:alt`. A largura e a altura declaradas são o que faz o LinkedIn, o Slack e o WhatsApp mostrarem o cartão grande em vez de uma miniatura quadrada.
- JSON-LD: `Person` na home (nome, email, imagem, cargo, `sameAs` para LinkedIn, Instagram e Bronze Art; sem telefone, sem morada exacta), `Blog` no índice das notas, `BlogPosting` em cada artigo (título, descrição, data, língua, autor).
- `sitemap.xml` e `robots.txt` apontam para `diogobronzesilva.com`, com URLs limpas.
- Favicon em SVG (`assets/favicon.svg`, o monograma "D" a bronze) com `apple-touch-icon.png` (180×180) como alternativa para iOS.
- Feed RSS em `/feed.xml`, referenciado com `<link rel="alternate">` em todas as páginas, para quem preferir seguir por leitor de feeds.

## 7. Analytics e privacidade

Não há nenhuma ferramenta de analytics instalada, nem tracking de nenhum tipo: nada de cookies, nada de scripts que sigam visitantes entre páginas ou entre sites.

Isto não é, no entanto, um site com zero pedidos a terceiros. Todas as páginas carregam Newsreader e Instrument Sans a partir de `fonts.googleapis.com` e `fonts.gstatic.com`, o que significa que o browser de quem visita faz mesmo um pedido de rede à Google a cada visita, com o IP e o user-agent a ir até lá, mesmo que a Google não plante um cookie de tracking nesse pedido. Não é a mesma coisa que analytics, mas também não é rigorosamente "zero terceiros" — corrigido aqui para não afirmar mais do que é verdade. Se um dia quiseres eliminar por completo qualquer pedido a servidores externos, a opção é fazer self-host dos ficheiros de fonte (`.woff2`) dentro de `assets/fonts/` e trocar os `<link>` da Google por `@font-face` locais no `site.css`. Não foi feito nesta revisão, fica como decisão tua.

O único outro serviço externo é a newsletter (Buttondown), que só recebe dados de quem preenche o formulário e clica em subscrever.

Se um dia quiseres saber quantas pessoas visitam o site, a opção mais alinhada com o espírito do projecto é uma ferramenta simples e sem cookies (Plausible ou Fathom, por exemplo), nunca Google Analytics. Isso não está instalado, e a decisão de o instalar ou não é tua.

## 8. Notas de design

- **Paleta:** papel `#FBFAF7`, tinta `#191814`, bronze `#8A6A3C`. Está tudo em variáveis CSS no topo do `site.css`.
- **Tipografia:** Newsreader (serifa editorial) para tudo o que se lê; Instrument Sans só em datas, legendas e navegação, em maiúsculas pequenas.
- **Fotografia:** não há página própria. O menu diz "Photography ↗" e leva directamente a `bronzeart.pt`, em separador novo. Na home, a sala chama-se "Bronze Art" e descreve o projecto numa frase.
- **Notes:** cinco artigos de 2021–2022, editorialmente revistos (ver secção 9), agrupados sob "Archive". Quando houver notas novas, ganham uma secção própria acima, e o "Archive" passa a ser só o arquivo, tal como o nome sugere.
- **Colofão:** rodapé com "Diogo Silva · diogobronzesilva.com" à esquerda e "Written by hand, between bedtimes." à direita, repetido em todas as páginas. Muda-se com find & replace.
- **Zero JavaScript.** O site inteiro é HTML e CSS. A validação do formulário de newsletter é feita pelo browser.

## 9. Revisão editorial dos artigos antigos

Os cinco artigos, originalmente escritos entre Novembro de 2021 e Julho de 2022, foram reescritos por inteiro nesta revisão. As datas de publicação mantiveram-se as originais, porque são verdadeiras e mostram continuidade em vez de a esconderem.

O que mudou não foram as ideias, foi a forma de as defender: menos hipérbole, menos generalizações frágeis, mais nuance onde a nuance é devida, parágrafos corridos em vez de estruturas numeradas. Onde havia uma afirmação factual que não conseguia confirmar a partir do material existente, deixei a afirmação (quando fazia sentido manter) mas marquei-a com um comentário `<!-- VERIFY: ... -->` no código-fonte, invisível no site, para saberes exactamente o que vale a pena confirmar antes de te citares com números.

Retirei também, do artigo sobre a escassez de trabalhadores qualificados, uma expressão que usava uma condição médica como insulto. Não tinha relação nenhuma com o argumento e não é uma posição que valha a pena defender por defeito; o resto do argumento fica exactamente tão forte sem ela.

Lista de comentários `VERIFY` deixados no código, por artigo:

- **The Reign of Quantities:** afirmação genérica sobre a qualidade nutricional e agrícola ter piorado geração após geração.
- **Bitcoin | The Fairy Tale:** caracterização das posições de Yuval Harari sobre transhumanismo (mantive como referência a explorar, não como citação atribuída).
- **Escassez de trabalhadores qualificados:** a taxa de natalidade e de reprodução em Portugal desde 1990, incluindo o valor de referência de 1,3 filhos por casal; e a alegação sobre uma mudança na metodologia oficial de contabilização da fecundidade.

## 10. O que ainda falta de decisão tua

- **Newsletter:** falta o username real do Buttondown (ou outro serviço). Ver secção 5.
- **Domínio `.pt`:** o `diogosilva.pt` está reservado na DNS.PT até Março de 2027. Não fiz nada quanto a isso; o site está todo preparado para `diogobronzesilva.com`, que já tens.
- **Analytics:** nenhum instalado. Ver secção 7.

## 11. Segunda passagem (polimento)

Revisão visual completa, sem mudar domínio, email, conceito ou páginas. O que mudou:

- Legenda "Lisbon" removida do retrato na home; toda a menção pública a Lisboa (enquanto localização pessoal) foi trocada por "Portugal", incluindo o JSON-LD.
- Instagram e Bronze Art deixaram de ser duas linhas na Contact. Agora é uma só: "Bronze Art" com "Photography · Website ↗ · Instagram ↗".
- Texto de boas-vindas da home reescrito, com a primeira frase a funcionar como uma abertura visualmente distinta das restantes três.
- **Dois bugs reais de quebra de linha corrigidos**: o email de contacto partia a meio da palavra a 320px de largura; "Bronze Art" partia a meio do nome nessa mesma largura. Ambos confirmados por medição directa, não só por olho.
- **Contraste corrigido**: `--ink-faint` (usado em datas, legendas e rótulos pequenos por todo o site) estava a 3.39:1 contra o papel, abaixo do mínimo AA (4.5:1). Passou a `#746E63`, a 4.84:1.
- **Letter-spacing unificado**: as etiquetas pequenas em maiúsculas (datas, rótulos de contacto, rodapé) usavam três valores diferentes (0.12em, 0.14em, 0.16em) sem razão aparente. Ficaram todas a 0.16em.
- "From Notes" na home deixou de ter o seu próprio sistema tipográfico e passou a reutilizar exactamente as classes `.entry`/`.entry__date`/`.entry__title`/`.entry__dek` do índice de Notes, garantindo paridade visual total.
- A newsletter tinha a linha "No schedule, no marketing. Unsubscribe whenever." em falta nos cinco artigos e no template; só existia na home e no índice de Notes. Corrigido em todos.

## 12. Terceira passagem (correcções confirmadas em 20 de Agosto de 2026)

Esta revisão nasceu de uma auditoria externa (ChatGPT) que depois foi confirmada ponto a ponto directamente no site ao vivo, em `diogobronzesilva.com`, antes de qualquer alteração. O que mudou:

- **"From Notes" passou a "Selected Notes"**: mostra agora Efficiency, The Reign of Quantities e Escassez de trabalhadores qualificados, em vez das três mais recentes por data (Escassez, Bitcoin, Panem). Ver secção 4, ponto 6, para quando reverter isto.
- **Cartão social da home (`assets/img/og/home.jpg`) regenerado**: o slogan mudou de "Sales · Photography · Faith · Notes" para "Work · Family · Faith · Photography". Composição, tipografia e cor mantidas exactamente iguais; só o texto foi trocado. `og:image:alt` e `twitter:image:alt` em `index.html` foram actualizados a condizer.
- **`.htaccess` criado**: não existia, apesar de o README já o descrever desde a secção 2. Agora existe, com os redirects 301 de URLs antigas, o bloco comentado do subdomínio temporário da Hostinger, o bloco comentado de Force HTTPS, e um bloqueio real (`Require all denied`) a `README.md` e a `notes/_template.html`, que antes estavam publicamente acessíveis apesar do `Disallow` no `robots.txt` (Disallow só pede a crawlers para não indexar, não impede acesso directo).
- **`feed.xml`**: o `<author>` de cada `<item>` passou de `Diogo Silva` para `hello@diogobronzesilva.com (Diogo Silva)`, o formato convencional de RSS 2.0. O `managingEditor` já estava certo.
- **`llms.txt`**: acentos repostos onde tinham sido cortados ("Em portugues" → "Em português", "mao de obra" → "mão de obra").
- **Nota de revisão visível nos cinco artigos antigos**: cada um passou a mostrar "· revised Aug 2026" a seguir à data e ao nome, no cabeçalho do artigo. O `dateModified` já estava certo no JSON-LD de cada um; faltava mostrar isto a quem lê a página, não só aos motores de busca.
- **"Efficiency, the One Ring to rule them all"**: o parágrafo sobre os Elfos e os anéis foi reescrito. Dizia que os Elfos "recusaram" os anéis; na lore do Tolkien, os Elfos retiraram-nos de uso quando perceberam o que Sauron tinha feito ao One Ring, não os recusaram desde o início.
- **"Escassez de trabalhadores qualificados"**: "profissões livres" trocado por "ofícios" nos dois sítios onde aparecia. Em português de Portugal, "profissão liberal/livre" tende a significar advogado, médico, engenheiro, o oposto do que o texto queria dizer.
- **Secção 7 (Analytics e privacidade) corrigida**: já não afirma "zero third-party" sem qualificação, dado o carregamento do Google Fonts. Ver secção 7 acima.


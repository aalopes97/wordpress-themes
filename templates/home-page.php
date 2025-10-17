<?php

    $camposBanner = bireme_get_lilacs_hero_meta(get_the_ID());
    

?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.2.2/echarts.min.js"></script>
<!-- LILACS HERO -->
<section class="lilacs-hero" aria-label="Busca Lilacs" style="background-image:url('<?=$camposBanner['img_url']?>')">
  <div class="lilacs-hero__overlay" aria-hidden="true"></div>

  <div class="lilacs-hero__inner container">
    <div class="lilacs-hero__content">
      <h1 class="lilacs-hero__title"><?=$camposBanner['title'];?></h1>
      <p class="lilacs-hero__subtitle"><?=$camposBanner['desc'];?></p>

      <form class="lilacs-search" role="search" method="get" action="<?php echo esc_url( home_url('/') ); ?>">
        <label class="screen-reader-text" for="lilacs-search-input">Pesquisar</label>

        <div class="lilacs-search__row">
          <input id="lilacs-search-input"
                 class="lilacs-search__input"
                 name="s"
                 type="search"
                 placeholder="Insira sua pesquisa aqui"
                 aria-label="Pesquisar"
                 autocomplete="off">

          <button type="button" class="lilacs-search__mic" title="Ativar ditado" aria-label="Ativar ditado">
            <span class="sr-only">microfone</span>
            <!-- SVG mic icon -->
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 14a3 3 0 0 0 3-3V5a3 3 0 0 0-6 0v6a3 3 0 0 0 3 3z" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M19 11v1a7 7 0 0 1-14 0v-1" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M12 21v-3" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </button>

          <button type="submit" class="lilacs-search__btn" aria-label="Buscar">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M21 21l-4.35-4.35" stroke="#fff" stroke-width="1.8" stroke-linecap="round"/></svg>
          </button>
        </div>

        <div class="lilacs-search__actions">
          <a href="#busca-avancada" class="btn-pill">Busca avançada</a>
          <a href="#decs" class="btn-pill">Busca com DeCS / MeSH</a>
          <a href="#como-pesquisar" class="btn-pill">Como pesquisar</a>
        </div>
      </form>
    </div>
  </div>
</section>
<section id="raiox-lilacs" aria-label="Raio-X da LILACS">
  <style>
    /* ===== Layout geral ===== */
    #raiox-lilacs{
      position: relative;
      padding: 28px 20px 10px;
      background: #F3F4F6;
      padding-left: 0 !important;
      padding-right: 0 !important;
    }
    #raiox-lilacs .rx-title{
      max-width: 1380px;
      margin: 0 auto 12px;
      font: 800 28px/1.2 "Poppins", system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
      color: #082a53;
      letter-spacing:.2px;
    }
    #raiox-lilacs .rx-wrap{
      max-width: 100%;
      margin: 0 auto;
      padding: 12px 0 8px;
      display: grid;
      grid-template-columns: 220px 1fr 140px 1fr 220px; /* esquerda | azul | “40 anos” | laranja | direita */
      gap: 24px;
      align-items: end; /* tudo encosta no “chão” */
    }
    
    /* ===== Sidebars ===== */
    #raiox-lilacs .rx-side{
      align-self: stretch;                /* ocupa a coluna toda */
      display: flex;
      flex-direction: column;
      justify-content: space-between;     /* cola o box no chão */
      padding-bottom: 8px;                /* leve respiro do chão */
    }
    .rx-card{
        padding-left: 0;
        padding-right: 0;
    }
    .rx-side.right .rx-card{
        text-align: left !important;
    }
    #raiox-lilacs .rx-card{
    border-radius: 12px;
    text-align: right;
    }
    #raiox-lilacs .rx-card h3{
margin: 0 0 6px;
    font: 700 16px / 1.3 "Poppins";
    color: #082a53;
    border-bottom: 1px solid #082a53;
    }
    #raiox-lilacs .rx-card p{
      margin:0;
      font: 400 13px/1.5 "Poppins";
      color:#3b4a5c;
    }
    /* Badge simples (ex.: “34 bases de dados”) */
    #raiox-lilacs .rx-badge{
         margin-top: 10px;
    font: 400 23px / 1 "Poppins";
    color: #a3470a;
    padding: 8px 12px;
    display: inline-block;
    position: absolute;
    top: 150px;
    right: 161px;
    }

    /* ===== Gráficos ===== */
    #raiox-lilacs .rx-chart{
      height: 650px;          /* Aumente se quiser mais impacto */
      min-width: 600px;
      overflow:hidden;
    }

    /* ===== Coluna do meio (40 anos) ===== */
    #raiox-lilacs .rx-mid{
      height: 650px; /* mesma altura dos gráficos */
      display: flex;
      align-items: flex-end;   /* gruda no rodapé */
      justify-content: center;
    }
    #raiox-lilacs .mid-label{
      font: 400 28px / 1 "Poppins";
    color: #072a53;
    margin-bottom: 12px;
    text-shadow: 0 2px 0 rgba(0, 0, 0, .06);
    user-select: none;
    white-space: nowrap;
    }
    .rx-side.left{
        align-self: stretch;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding-bottom: 8px;
    }
    #raiox-lilacs .rx-side{
            justify-content: flex-end;
    }
    /* ===== Responsivo ===== */
    @media (max-width: 1200px){
      #raiox-lilacs .rx-wrap{
        grid-template-columns: 200px 1fr 120px 1fr 200px;
      }
    }
    @media (max-width: 980px){
      #raiox-lilacs .rx-wrap{
        grid-template-columns: 1fr; /* empilha tudo */
        gap: 18px;
      }
      #raiox-lilacs .rx-side{order:1}
      #raiox-lilacs #chart-blue{order:2}
      #raiox-lilacs .rx-mid{order:3; height:auto; align-items:center}
      #raiox-lilacs #chart-orange{order:4}
      #raiox-lilacs .rx-side.right{order:5}
      #raiox-lilacs .mid-label{font-size:44px; margin:0 auto}
      #raiox-lilacs .rx-chart{height: 420px}
    }
    @media (max-width: 640px){
      #raiox-lilacs .rx-chart{height: 360px}
      #raiox-lilacs .mid-label{font-size: 36px}
    }
  </style>

  <h2 class="rx-title">Raio-X da LILACS</h2>

  <div class="rx-wrap">
    <!-- Coluna ESQUERDA (LILACS) -->
    <aside class="rx-side left" aria-label="Resumo LILACS">
      <div class="rx-card">
        <h3>LILACS</h3>
        <p>A ciência em saúde com identidade latino-americana.</p>
      </div>
    </aside>

    <!-- Gráfico ESQUERDO (tons de azul) -->
    <div id="chart-blue" class="rx-chart" role="img" aria-label="Gráfico LILACS (Azul)"></div>

    <!-- Texto do meio alinhado ao chão -->
    <div class="rx-mid" aria-hidden="true">
      <div class="mid-label">40 anos</div>
    </div>

    <!-- Gráfico DIREITO (tons de laranja) -->
    <div id="chart-orange" class="rx-chart" role="img" aria-label="Gráfico LILACS Plus (Laranja)"></div>

    <!-- Coluna DIREITA (LILACS Plus) -->
    <aside class="rx-side right" aria-label="Resumo LILACS Plus">
      <div class="rx-card">
        <h3>LILACS Plus</h3>
        <p>A ciência latino-americana no cenário global.</p>
        <span class="rx-badge">34 bases de dados</span>
      </div>
    </aside>
  </div>

  <!-- Se já existir o import do ECharts na página, pode remover esta linha -->
  <script src="https://cdn.jsdelivr.net/npm/echarts@5/dist/echarts.min.js"></script>
  <script>
    /* ===== Dados base (exemplo) ===== */
    const dataBlue = [
      { name: '+1.130 milhão registros', value: 180, area: 400 },
      { name: '+707 mil textos completos', value: 120, area: 2000 },
      { name: '+1800 revistas', value: 200, area: 600 },
      { name: '30 países', value: 150, area: 800 },
      { name: '9 idiomas', value: 100, area: 1000 }
    ];
    const dataOrange = [
      { name: '+2.800 milhões registros', value: 220, area: 400 },
      { name: '+1.500 milhão textos completos', value: 160, area: 2000 },
      { name: '934 periódicos', value: 140, area: 600 },
      { name: '146 países', value: 130, area: 800 },
      { name: '44 idiomas', value: 110, area: 1000 }
    ];

    // Paletas
    const colorsBlue   = ['#8FBDD4','#799DB3','#3073A0','#085696','#00205B'];
    const colorsOrange = ['#FFD7B5','#FFBC80','#FF9E4D','#F97A1E','#B34F00'];

    // Quebra de linha inteligente nos rótulos
    function wrapText(text, maxCharsPerLine) {
      const words = text.split(' ');
      const lines = [];
      let line = '';
      for (const w of words) {
        if ((line + ' ' + w).trim().length <= maxCharsPerLine) {
          line = (line ? line + ' ' : '') + w;
        } else {
          if (line) lines.push(line);
          line = w;
        }
      }
      if (line) lines.push(line);
      return lines.join('\n');
    }

    function createNightingaleChart(roseType, elId, palette, seriesData) {
      const options = {
        backgroundColor: 'transparent',
        tooltip: {
          trigger: 'item',
          formatter: ({ name, value, percent }) => `${name}<br/>Valor: ${value} (${percent}%)`
        },
        series: [{
          name: 'LILACS',
          type: 'pie',
          radius: ['8%', '92%'],       // bem grande
          roseType,
          minAngle: 5,
          avoidLabelOverlap: true,
          stillShowZeroSum: false,
          itemStyle: {
            borderRadius: 0,
            borderWidth: 0,
            shadowBlur: 18,
            shadowColor: 'rgba(0,0,0,0.18)'
          },
          label: {
            show: true,
            position: 'inside',
            formatter: (params) => {
              const maxChars =
                params.percent >= 30 ? 20 :
                params.percent >= 18 ? 16 :
                params.percent >= 12 ? 14 : 12;
              const nameWrapped = wrapText(params.name, maxChars);
              return `{name|${nameWrapped}}\n{val|${params.value.toLocaleString('pt-BR')}}`;
            },
            rich: {
              name: {
                fontSize: 16,
                fontWeight: 700,
                lineHeight: 20,
                color: '#fff',
                textBorderColor: 'rgba(0,0,0,0.45)',
                textBorderWidth: 3,
                align: 'center',
                width: 160
              },
              val: {
                fontSize: 12,
                fontWeight: 600,
                lineHeight: 16,
                color: '#fff',
                textBorderColor: 'rgba(0,0,0,0.45)',
                textBorderWidth: 3,
                align: 'center',
                width: 160
              }
            }
          },
          labelLine: { show: false },
          labelLayout: () => ({ moveOverlap: 'shiftY' }),
          data: seriesData.map((item, i) => ({
            ...item,
            itemStyle: { color: palette[i % palette.length] }
          }))
        }]
      };

      const chart = echarts.init(document.getElementById(elId));
      chart.setOption(options);
      window.addEventListener('resize', () => chart.resize());
    }

    // Renderiza
    createNightingaleChart('area',   'chart-blue',   colorsBlue,   dataBlue);
    createNightingaleChart('radius', 'chart-orange', colorsOrange, dataOrange);
  </script>
</section>




<section id="lilacs-audiences" aria-label="Acesso rápido por público">
  <style>
    /* ===== Fundo e container ===== */
    #lilacs-audiences{
      position: relative;
      padding: 48px 20px 56px;
      background: radial-gradient(140% 85% at 0% 0%, #0c3a73 0%, #072a53 60%, #062248 100%);
      overflow: hidden;
    }
    /* texturas/geometrias leves no fundo */
    #lilacs-audiences::before, #lilacs-audiences::after{
      content:"";
      position:absolute; inset:auto auto -18% -18%;
      width: 60vw; height: 60vw; border-radius: 50%;
      background: radial-gradient(closest-side, rgba(255,255,255,.06), transparent 70%);
      transform: rotate(-12deg);
      pointer-events: none;
    }
    #lilacs-audiences::after{
      inset: -22% -22% auto auto;
      transform: rotate(18deg);
    }

    #lilacs-audiences .aud-wrap{
      max-width: 1280px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 24px;
    }

    /* ===== Card ===== */
    #lilacs-audiences .aud-card{
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 12px 28px rgba(3,10,24,.20);
      padding: 18px 18px 16px;
      display: grid;
      grid-template-rows: auto auto 1fr auto;
      min-height: 220px;
      transition: transform .18s ease, box-shadow .18s ease;
    }
    #lilacs-audiences .aud-card:hover{
      transform: translateY(-2px);
      box-shadow: 0 16px 34px rgba(3,10,24,.25);
    }

    /* Ícone topo */
    #lilacs-audiences .aud-icon{
      width: 44px; height: 44px;
      margin-bottom: 10px;
      color: #072a53; /* azul escuro */
      flex: 0 0 auto;
    }
    #lilacs-audiences .aud-icon svg{
      width: 100%; height: 100%; display: block;
    }

    /* Títulos */
    #lilacs-audiences .aud-kicker{
      font: 700 14px/1 "Poppins", system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
      color: #0a5fa1; /* azul mais claro */
      margin-bottom: 2px;
    }
    #lilacs-audiences .aud-title{
      font: 800 22px/1.2 "Poppins", system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
      color: #082a53;
      margin: 0 0 12px;
    }

    /* Lista com “triangulinhos” */
    #lilacs-audiences .aud-list{
      list-style: none;
      margin: 0 0 8px;
      padding: 0;
      color: #1c2b3d;
      font: 500 14px/1.55 "Poppins", system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
    }
    #lilacs-audiences .aud-list li{
      position: relative;
      padding-left: 14px;
      margin: 6px 0;
    }
    #lilacs-audiences .aud-list li::before{
      content:"";
      position:absolute; left:0; top:.58em;
      width: 0; height: 0;
      border-left: 6px solid #0e315b;   /* triângulo azul */
      border-top: 4px solid transparent;
      border-bottom: 4px solid transparent;
    }

    /* Link “Outras informações” */
    #lilacs-audiences .aud-more{
      margin-top: 6px;
      font: 700 14px/1 "Poppins", system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
      color: #f96a1e;                 /* laranja */
      text-decoration: none;
      display: inline-block;
    }
    #lilacs-audiences .aud-more:hover{ text-decoration: underline; }

    /* Responsivo */
    @media (max-width: 1024px){
      #lilacs-audiences .aud-wrap{ gap: 18px; }
    }
    @media (max-width: 880px){
      #lilacs-audiences .aud-wrap{ grid-template-columns: 1fr; }
    }
  </style>

  <div class="aud-wrap">
    <!-- Card 1: Usuário -->
    <article class="aud-card">
      <div class="aud-icon" aria-hidden="true">
        <!-- Ícone: gráfico -->
        <svg viewBox="0 0 24 24" fill="none">
          <path d="M4 19V5M10 19V9M16 19V3M22 19H2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
        </svg>
      </div>
      <div class="aud-kicker">Para você</div>
      <h3 class="aud-title">Usuário</h3>

      <ul class="aud-list">
        <li>Pesquise na LILACS</li>
        <li>Use o DeCS para refinar sua busca</li>
        <li>Acesse guias de pesquisas</li>
        <li>Salve e compartilhe resultados</li>
        <li>Explore recursos adicionais da BVS</li>
      </ul>

      <a class="aud-more" href="#usuario-mais" aria-label="Outras informações para Usuário">Outras informações</a>
    </article>

    <!-- Card 2: Revista -->
    <article class="aud-card">
      <div class="aud-icon" aria-hidden="true">
        <!-- Ícone: lápis -->
        <svg viewBox="0 0 24 24" fill="none">
          <path d="M4 20l4.5-1 10.5-10.5a2.12 2.12 0 0 0-3-3L5.5 16 4 20Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
          <path d="M13.5 6.5l3 3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
        </svg>
      </div>
      <div class="aud-kicker">Para sua</div>
      <h3 class="aud-title">Revista</h3>

      <ul class="aud-list">
        <li>Indexe sua revista</li>
        <li>Acompanhe o status de atualização</li>
        <li>Consulte o seu código de editor</li>
        <li>Acesse guias e orientações para editores</li>
      </ul>

      <a class="aud-more" href="#revista-mais" aria-label="Outras informações para Revista">Outras informações</a>
    </article>

    <!-- Card 3: Instituição -->
    <article class="aud-card">
      <div class="aud-icon" aria-hidden="true">
        <!-- Ícone: pessoas -->
        <svg viewBox="0 0 24 24" fill="none">
          <path d="M16 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" stroke="currentColor" stroke-width="2"/>
          <path d="M8 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" stroke="currentColor" stroke-width="2"/>
          <path d="M2 20a6 6 0 0 1 12 0M10 20a6 6 0 0 1 12 0" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
        </svg>
      </div>
      <div class="aud-kicker">Para sua</div>
      <h3 class="aud-title">Instituição</h3>

      <ul class="aud-list">
        <li>Quero me tornar um Centro Cooperante</li>
        <li>Estatísticas de contribuição da sua instituição</li>
        <li>Atualização de dados cadastrais</li>
        <li>Diretório da rede LILACS</li>
      </ul>

      <a class="aud-more" href="#instituicao-mais" aria-label="Outras informações para Instituição">Outras informações</a>
    </article>
  </div>
</section>


<?php
$jr = function_exists('bireme_get_lilacs_journals_meta') ? bireme_get_lilacs_journals_meta(get_the_ID()) : null;
if ($jr && (!empty($jr['items']))) :
?>
<section id="lilacs-journals" aria-label="Revistas indexadas na LILACS">
  <style>
    #lilacs-journals{padding:28px 20px 40px;background:#fff}
    #lilacs-journals .jr-wrap{max-width:1280px;margin:0 auto}
    #lilacs-journals .jr-title{font:800 26px/1.25 "Poppins";color:#082a53;margin:0 0 6px}
    #lilacs-journals .jr-sub{font:500 14px/1.5 "Poppins";color:#38506b;opacity:.95;margin:0 0 16px}
    #lilacs-journals .jr-grid{
      display:grid;grid-template-columns:repeat(5,1fr);gap:14px
    }
    @media (max-width:1100px){#lilacs-journals .jr-grid{grid-template-columns:repeat(3,1fr)}}
    @media (max-width:720px){#lilacs-journals .jr-grid{grid-template-columns:repeat(2,1fr)}}
    @media (max-width:460px){#lilacs-journals .jr-grid{grid-template-columns:1fr}}

    #lilacs-journals .jr-pill{
      display:flex;flex-direction:column;justify-content:center;min-height:74px;
      background:linear-gradient(180deg,#0a4b86 0%, #0a3f73 100%);
      color:#fff;border-radius:10px;padding:14px 16px;position:relative;
      box-shadow:0 8px 20px rgba(3,10,24,.16);text-decoration:none
    }
    #lilacs-journals .jr-pill:hover{filter:brightness(1.03)}
    #lilacs-journals .jr-pill h4{margin:0 0 2px;font:800 16px/1.2 "Poppins"}
    #lilacs-journals .jr-pill small{opacity:.95;font:600 13px/1.3 "Poppins"}
    #lilacs-journals .jr-arrow{
      position:absolute;right:10px;top:50%;transform:translateY(-50%);
      width:26px;height:26px;border-radius:999px;background:rgba(255,255,255,.18);
      display:flex;align-items:center;justify-content:center
    }
    #lilacs-journals .jr-arrow svg{width:14px;height:14px;stroke:#fff}

    /* pílula laranja (destaque) */
    #lilacs-journals .jr-pill.is-accent{
      background:linear-gradient(180deg,#ff8a3a 0%, #e8650a 100%);
    }
  </style>

  <div class="jr-wrap">
    <?php if(!empty($jr['title'])): ?>
      <h2 class="jr-title"><?php echo esc_html($jr['title']); ?></h2>
    <?php endif; ?>
    <?php if(!empty($jr['subtitle'])): ?>
      <p class="jr-sub"><?php echo esc_html($jr['subtitle']); ?></p>
    <?php endif; ?>

    <div class="jr-grid">
      <?php foreach($jr['items'] as $it): 
        $label = trim($it['label'] ?? '');
        $total = trim($it['total'] ?? '');
        $url   = esc_url($it['url'] ?? '#');
        $accent= !empty($it['accent']);
        if($label==='') continue;
      ?>
        <a class="jr-pill <?php echo $accent?'is-accent':''; ?>" href="<?php echo $url; ?>">
          <h4><?php echo esc_html($label); ?></h4>
          <?php if($total!==''): ?><small>Total: <?php echo esc_html($total); ?></small><?php endif; ?>
          <span class="jr-arrow" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none"><path d="M9 18l6-6-6-6" stroke-width="2" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </span>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>


<?php
$sl = function_exists('bireme_get_lilacs_slider_meta') ? bireme_get_lilacs_slider_meta(get_the_ID()) : null;
if ($sl && !empty($sl['slides'])):
?>
<section id="lilacs-slider" aria-label="Banner">
  <style>
    #lilacs-slider{position:relative;background:#0b2a4f}
    #lilacs-slider .wrap{max-width:1920px;margin:0 auto}
    /* Altura do banner: ajuste se quiser */
    #lilacs-slider .viewport{width:100%;overflow:hidden; height:min(60vw,520px); position:relative}
    #lilacs-slider .track{display:flex;height:100%;transition:transform .6s ease-in-out;will-change:transform}
    #lilacs-slider .slide{flex:0 0 100%;height:100%;position:relative}
    #lilacs-slider .slide .ph{position:absolute;inset:0;background-size:cover;background-position:center}
    /* Dots */
    #lilacs-slider .dots{position:absolute;left:50%;bottom:12px;transform:translateX(-50%);z-index:2;display:flex;gap:8px}
    #lilacs-slider .dot{width:10px;height:10px;border-radius:999px;background:rgba(255,255,255,.45);border:none;cursor:pointer}
    #lilacs-slider .dot[aria-current="true"]{background:#fff;transform:scale(1.1)}
    @media (max-width:640px){#lilacs-slider .viewport{height:min(70vw,420px)}}
  </style>

  <div class="wrap">
    <div class="viewport" data-autoplay="6000">
      <div class="track" role="list" aria-live="polite">
        <?php foreach($sl['slides'] as $s): 
          $url = $s['url'] ?? '';
          $img = $s['img_url'] ?? '';
          if(!$img) continue; ?>
          <div class="slide" role="listitem">
            <?php if($url): ?><a href="<?php echo esc_url($url); ?>" aria-label="Abrir banner"><?php endif; ?>
              <span class="ph" style="background-image:url('<?php echo esc_url($img); ?>')"></span>
            <?php if($url): ?></a><?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="dots" aria-label="Navegação de slides"></div>
    </div>
  </div>

  <script>
    (function(){
      const root  = document.querySelector('#lilacs-slider .viewport');
      if(!root) return;
      const track = root.querySelector('.track');
      const slides= Array.from(track.children);
      const dotsC = root.querySelector('.dots');
      let idx = 0, timer = null, delay = parseInt(root.getAttribute('data-autoplay')||'0',10);

      function go(i){
        idx = (i+slides.length)%slides.length;
        track.style.transform = 'translateX(' + (-idx*100) + '%)';
        dotsC.querySelectorAll('.dot').forEach((d,n)=>d.setAttribute('aria-current', n===idx ? 'true':'false'));
      }
      // dots
      slides.forEach((_,i)=>{
        const b = document.createElement('button');
        b.className='dot';
        b.setAttribute('aria-label','Ir ao slide '+(i+1));
        b.addEventListener('click',()=>{ go(i); restart(); });
        dotsC.appendChild(b);
      });
      go(0);

      function next(){ go(idx+1); }
      function restart(){
        if(timer) clearInterval(timer);
        if(delay>0) timer = setInterval(next, delay);
      }
      root.addEventListener('mouseenter', ()=> timer && clearInterval(timer));
      root.addEventListener('mouseleave', restart);
      restart();
      window.addEventListener('visibilitychange', ()=> document.hidden ? (timer&&clearInterval(timer)) : restart());
      window.addEventListener('resize', ()=> track.style.transition='none'); // previne “pulo” no resize
      setTimeout(()=> track.style.transition='', 0);
    })();
  </script>
</section>
<?php endif; ?>



<?php $sl = function_exists('bireme_get_lilacs_slider_meta') ? bireme_get_lilacs_slider_meta(get_the_ID()) : null; ?>
<?php if ($sl && !empty($sl['items'])): ?>
<section id="lilacs-banner" aria-label="Destaques">
  <style>
    #lilacs-banner{position:relative;background:#0b2a4f}
    #lilacs-banner .bnr-inner{max-width:1920px;margin:0 auto}
    #lilacs-banner .slider{position:relative;width:100%;overflow:hidden;height:min(60vw,520px)}
    #lilacs-banner .slides{display:flex;width:100%;height:100%;transition:transform .6s ease-in-out;will-change:transform}
    #lilacs-banner .slide{flex:0 0 100%;height:100%;display:flex;align-items:center;justify-content:center;background:#000}
    #lilacs-banner .slide img{width:100%;height:100%;object-fit:cover;display:block}
    #lilacs-banner .dots{position:absolute;left:50%;bottom:12px;transform:translateX(-50%);z-index:3;display:flex;gap:8px}
    #lilacs-banner .dot{width:10px;height:10px;border-radius:999px;background:rgba(255,255,255,.45);border:none;cursor:pointer;transition:transform .15s, background .2s}
    #lilacs-banner .dot[aria-current="true"]{background:#fff;transform:scale(1.15)}
    @media (max-width:640px){#lilacs-banner .slider{height:min(70vw,420px)}}
  </style>

  <div class="bnr-inner">
    <div class="slider" data-autoplay="6000">
      <div class="slides" role="list" aria-live="polite">
        <?php foreach ($sl['items'] as $it): 
          if (empty($it['img_url'])) continue;
          $img = esc_url($it['img_url']);
          $alt = esc_attr($it['alt'] ?? '');
          $url = !empty($it['url']) ? esc_url($it['url']) : '';
        ?>
          <figure class="slide" role="listitem">
            <?php if ($url): ?><a href="<?php echo $url; ?>"><?php endif; ?>
              <img src="<?php echo $img; ?>" alt="<?php echo $alt; ?>">
            <?php if ($url): ?></a><?php endif; ?>
          </figure>
        <?php endforeach; ?>
      </div>
      <div class="dots" aria-label="Navegação de slides"></div>
    </div>
  </div>

  <script>
    (function(){
      const root = document.querySelector('#lilacs-banner .slider');
      if(!root) return;
      const track = root.querySelector('.slides');
      const slides = Array.from(track.children);
      const dotsWrap = root.querySelector('.dots');

      if(slides.length <= 1){
        // sem dots/autoplay quando só há 1 slide
        return;
      }

      // cria dots
      slides.forEach((_,i)=>{
        const b = document.createElement('button');
        b.className = 'dot';
        b.type = 'button';
        b.setAttribute('aria-label','Ir para o slide '+(i+1));
        if(i===0) b.setAttribute('aria-current','true');
        dotsWrap.appendChild(b);
      });

      const dots = Array.from(dotsWrap.children);
      let idx = 0, timer = null, delay = parseInt(root.dataset.autoplay || '6000', 10);

      function go(i){
        idx = (i+slides.length)%slides.length;
        track.style.transform = 'translateX('+(-100*idx)+'%)';
        dots.forEach((d,k)=> d.toggleAttribute('aria-current', k===idx));
      }
      dots.forEach((d,i)=> d.addEventListener('click', ()=>{ go(i); restart(); }));

      function start(){ timer = setInterval(()=> go(idx+1), delay); }
      function stop(){ if(timer){ clearInterval(timer); timer=null; } }
      function restart(){ stop(); start(); }

      root.addEventListener('mouseenter', stop);
      root.addEventListener('mouseleave', start);

      start();
    })();
  </script>
</section>
<?php endif; ?>


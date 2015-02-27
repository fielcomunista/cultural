<?php
/**
 * Template Name: Events
 * For listing events
 *
 * @package cultural
 */
?>

<?php get_header(); the_post(); ?>

    <div class="content  content--full" ng-controller="eventsController">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="hentry-wrap">
                <div class="entry-content">
                    <?php the_content(); ?>
                    <?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'cultural' ) . '&after=</div>') ?>
                </div>
            </div>
        </article>

        <div class="filter-bar  cf">
            <form method="get" class="filter  filter-date" action="<?php echo home_url( '/' ); ?>">
                <div class="event__date  event__date--start">
                    <label for="event__start-date">De</label>
                    <input type="text" id="event__start-date" class="date ng-valid hasDatepicker ng-dirty" ng-model="data.event.from" ui-date="dateOptions" ui-date-format="yy-mm-dd" placeholder="00/00/0000" readonly>
                </div>
                <div class="event__date">
                    <label for="event__start-date">A</label>
                    <input type="text" id="event__end-date" class="date ng-valid hasDatepicker ng-dirty" ng-model="data.event.to" ui-date="dateOptions" ui-date-format="yy-mm-dd" placeholder="00/00/0000" readonly>
                </div>
            </form>

            <div class="filter">
                <span class="label">Linguagem</span>
                <div class="dropdown">
                    <div class="placeholder">Selecione as linguagens</div>
                    <div class="submenu-dropdown">
                        <ul class="lista-de-filtro select">
                            <li ng-repeat="linguagem in linguagens" ng-class="{'selected':isSelected(data.event.linguagens, linguagem.id)}" ng-click="toggleSelection(data.event.linguagens, linguagem.id)" class="ng-scope">
                                <span>{{linguagem}}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="filter">
                <span class="label">Classificação</span>
                <div id="classificacao" class="dropdown">
                    <div class="placeholder">Selecione a classificação</div>
                    <div class="submenu-dropdown">
                        <ul class="lista-de-filtro select">
                            <li ng-repeat="classificacao in classificacoes" ng-class="{'selected':isSelected(data.event.classificacaoEtaria, classificacao.id)}" ng-click="toggleSelection(data.event.classificacaoEtaria, classificacao.id)" class="ng-scope">
                                <span class="ng-binding">{{classificacao}}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="events-list  grid  js-masonry" data-masonry-options='{ "columnWidth": ".grid-sizer", "gutter": ".gutter-sizer", "itemSelector": ".event" }'>
            <div class="grid-sizer"></div>
            <div class="gutter-sizer"></div>

            <div class="event  event-container" ng-repeat="event in events" repeat-done="updateMasonry()">
                <figure class="event__image" style="background-image: url(http://spcultura.prefeitura.sp.gov.br//files/event/13336/file/13654/irene_tanabe_2-1ce17e06cfa675e53a04217c87df3226.jpg);">
                    <img src="http://spcultura.prefeitura.sp.gov.br//files/event/13336/file/13654/irene_tanabe_2-1ce17e06cfa675e53a04217c87df3226.jpg" alt="Histórias Contadas com Origamis" />
                </figure>
                <div class="event-data">
                    <h1 class="event__title">Histórias Contadas com Origamis <span class="event__subtitle">Com Irene Tanabe</span></h1>
                    <div class="event__occurrences">
                        <div class="event__venue">Biblioteca Pública Marcos Rey</div>
                        <div class="event__time">13 de Outubro de 2014 às 14:00</div>
                        <a href="#" class="js-more-occurrences"><i class="fa fa-plus-circle"></i></a>
                    </div>
                    <span class="event__classification">Livre</span>
                    <div class="event__price">
                        <span class="fa-stack">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-usd fa-stack-1x fa-inverse"></i>
                        </span>
                        Grátis
                    </div>
                    <a href="#" class="event__info">Mais informações</a>
                </div>
            </div>

        </div>

        <?php comments_template('', true); ?>
    </div>

<?php get_footer(); ?>

<?php get_header(); ?>
<main>
<section class="hero"><div><p class="eyebrow">Промышленный холод под ключ</p><h1>Сервис, ремонт и проектирование холодильных систем</h1><p>SEO-готовая экспертная платформа для заявок из Яндекса и Google: услуги, бренды, оборудование, проекты и база знаний.</p><a class="btn btn-accent" href="#lead">Заказать диагностику</a></div></section>
<?php grs_breadcrumbs(); ?>
<section class="grid"><h2>Основные услуги</h2><?php echo do_shortcode('[grs_cooling_power_calculator]'); ?><article><h3>Ремонт компрессоров</h3><p>Диагностика, дефектация, восстановление винтовых и поршневых компрессоров.</p></article><article><h3>Монтаж систем</h3><p>Проектирование, монтаж, пусконаладка и сервис промышленного холода.</p></article><article><h3>Запасные части</h3><p>Подбор оригинальных и совместимых комплектующих для ведущих брендов.</p></article></section>
<section><h2>Почему выбирают нас</h2><ul class="trust"><li>Экспертные SEO-страницы под услуги, бренды и неисправности</li><li>Каталог оборудования без тяжелой e-commerce логики</li><li>Проекты, отзывы, FAQ и документация для доверия</li></ul></section>
<section id="lead"><h2>Получить консультацию инженера</h2><?php echo grs_lead_form('consultation'); ?></section>
</main><?php get_footer(); ?>

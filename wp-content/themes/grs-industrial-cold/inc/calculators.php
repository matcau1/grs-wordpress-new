<?php
/** Engineer calculators shortcodes. */
declare(strict_types=1);
if (! defined('ABSPATH')) { exit; }
add_shortcode('grs_cooling_power_calculator', fn(): string => '<div class="calculator" data-calculator="cooling-power"><h3>Калькулятор мощности холодильной установки</h3><label>Объем, м³<input type="number" data-volume></label><label>ΔT, °C<input type="number" data-delta></label><output>0 кВт</output></div>');
add_shortcode('grs_pressure_converter', fn(): string => '<div class="calculator" data-calculator="pressure"><h3>Конвертер давления</h3><label>bar<input type="number" data-bar></label><output>0 МПа</output></div>');

<?php

add_action('init', function() {
  if (function_exists('pll_current_language') === true && function_exists('pll_the_languages') === true) {
    pll_register_string('Home', 'Home', 'Biomerieux');
    pll_register_string('Back to homepage', 'Back to homepage', 'Biomerieux');
    pll_register_string('Page not found', 'Page not found', 'Biomerieux');
    pll_register_string('Sorry, no results were found', 'Sorry, no results were found', 'Biomerieux');
    pll_register_string('Share', 'Share', 'Biomerieux');
  }
});

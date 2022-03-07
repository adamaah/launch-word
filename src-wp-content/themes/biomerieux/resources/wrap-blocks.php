<?php
add_filter('render_block', 'wrap_core_blocks', 10, 2);
add_filter('render_block_data', 'block_data_pre_render', 10, 2);

function wrap_core_blocks($block_content, $block)
{
    $core_blocks = [
        'core/image',
        'core/paragraph',
        'core/list',
        'core-embed/youtube',
        'core/embed',
        'core/title',
        'core/quote',
        'core/pullquote',
        'core/heading',
        'core/group',
        'core/columns'
    ];

    if (
        in_array($block['blockName'], $core_blocks, true) &&
        !is_admin() &&
        !wp_is_json_request() &&
        !isset($block['attrs']['hasParent'])
    ) {
        $html = '<div class="default__content">';
        $html .= '<div class="container"><div class="row"><div class="col-md-22 offset-md-1">' . "\n";
        $html .= $block_content;
        $html .= '</div></div></div>' . "\n";
        $html .= '</div>';

        return $html;
    }

    return $block_content;
}

function block_data_pre_render($parsed_block, $source_block)
{
    $core_blocks = [
        'core/group',
        'core/column',
        'core/columns'
    ];

    if (
        in_array($source_block['blockName'], $core_blocks, true) &&
        !is_admin() &&
        !wp_is_json_request()
    ) {
        $parsed_block['attrs']['hasChild'] = 1;
        array_walk($parsed_block['innerBlocks'], 'inner_block_looper');
    }

    return $parsed_block;
}

function inner_block_looper(&$itm, $key)
{
    if ($key === 'attrs') {
        $itm['hasParent'] = 1;
    }
    if (is_array($itm)) {
        array_walk($itm, 'inner_block_looper');
    }
}

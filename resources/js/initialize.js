$(function () {

    /**
     * Add anchors for deep nesting in documentation.
     * @type {{visible: string, placement: string, truncate: number}}
     */
    anchors.options = {
        visible: 'hover',
        placement: 'right',
        truncate: 64
    };

    anchors.add('#documentation .page h2, #documentation .page h3, #documentation .page h4, #documentation .page h5');

    /**
     * Code Content Highlighter
     */
    $('pre > code').each(function () {
        Prism.highlightElement($(this)[0]);
    });
});

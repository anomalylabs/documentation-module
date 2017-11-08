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

    anchors.add('#documentation h2, #documentation h3, #documentation h4, #documentation h5');

    /**
     * Code Content Highlighter
     */
    $('pre > code').each(function () {
        Prism.highlightElement($(this)[0]);
    });
});

$(function () {

    /**
     * Add copy to clipboard icons
     * to all the code blocks.
     */
    $('code').each(function () {
        $(this).after('<span class="copy-to-clipboard" title="Copied to clipboard!" />');
    });

    /**
     * Handle the clipboard actions.
     * @type {Clipboard}
     */
    let clipboard = new Clipboard('.copy-to-clipboard', {
        text: function (trigger) {
            return $(trigger).prev('code').text().replace(/^\$\s/gm, '');
        }
    });

    /**
     * Show tooltips when the clipboard
     * succeeds in copying to clipboard.
     */
    clipboard.on('success', function (e) {

        $(e.trigger)
            .attr('data-placement', 'left')
            .tooltip('enable')
            .tooltip('show');

        $(e.trigger).on('mouseleave', function () {
            $(this)
                .tooltip('hide')
                .tooltip('disable')
        });

        setTimeout(function () {
            $(e.trigger)
                .tooltip('hide')
                .tooltip('disable');
        }, 1000);
    });

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

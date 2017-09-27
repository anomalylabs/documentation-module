$(function () {

    // Add copy buttons.
    $('code').each(function () {
        $(this).after('<span class="copy-to-clipboard" title="Copied to clipboard!" />');
    });

    // Copy to clipboard.
    var clipboard = new Clipboard('.copy-to-clipboard', {
        text: function (trigger) {
            return $(trigger).prev('code').text().replace(/^\$\s/gm, '');
        }
    });

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

    anchors.options = {
        visible: 'hover',
        placement: 'right',
        truncate: 64
    };

    anchors.add('#documentation h2, #documentation h3, #documentation h4, #documentation h5');

    $('pre > code').each(function () {
        Prism.highlightElement($(this)[0]);
    });
});

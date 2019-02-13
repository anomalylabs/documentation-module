(function (window, document) {

    /**
     * Add anchors for deep nesting in documentation.
     * @type {{visible: string, placement: string, truncate: number}}
     */
    anchors.options = {
        visible: 'hover',
        placement: 'right',
        truncate: 64
    };

    anchors.add('.documentation__content h2, .documentation__content h3, .documentation__content h4');

    /**
     * Initialize our TOC sidebar.
     */
    tocbot.init({
        tocSelector: '.documentation__toc',
        contentSelector: '.documentation__content',
        positionFixedSelector: '.documentation__toc',
        headingSelector: 'h2, h3',
        collapseDepth: 6
    });

    /**
     * Setup the code examples
     */
    let examples = Array.prototype.slice.call(
        document.querySelectorAll('pre > code')
    );

    examples.forEach(function (code, index) {

        code.setAttribute('id', 'code-' + (index + 1));

        Prism.highlightElement(code);

        var copy = document.createElement('button');

        copy.textContent = 'copy';
        copy.setAttribute('data-clipboard-target', '#code-' + (index + 1));
        copy.classList.add('copy-to-clipboard');

        code.parentNode.insertBefore(copy, code.nextSibling);

        let clipboard = new ClipboardJS('.copy-to-clipboard');

        clipboard.on('success', function (event) {
            event.trigger.classList.add('copied');
        });
    });

})(window, document);

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
     * Initialize our sidebar TOC.
     */
    tocbot.init({
        positionFixedSelector: '.documentation__sidebar .documentation__toc',
        tocSelector: '.documentation__sidebar .documentation__toc',
        contentSelector: '.documentation__content',
        positionFixedClass: 'position-fixed',
        headingSelector: 'h2, h3',
        collapseDepth: 2
    });
    
    /**
     * Initialize our body TOC.
     */
    tocbot.init({
        tocSelector: '.documentation__content .documentation__toc',
        contentSelector: '.documentation__content',
        //positionFixedSelector: '.documentation__content',
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

        let copy = document.createElement('button');

        copy.textContent = 'copy';
        copy.setAttribute('data-clipboard-target', '#code-' + (index + 1));
        copy.classList.add('copy-to-clipboard');

        code.parentNode.insertBefore(copy, code.nextSibling);

        let clipboard = new ClipboardJS('.copy-to-clipboard');

        clipboard.on('success', function (event) {
            event.trigger.classList.add('copied');
        });
    });

    let tables = Array.prototype.slice.call(
        document.querySelectorAll('.documentation__content table')
    );

    tables.forEach(function (table) {
        table.classList.add('table');
        table.classList.add('table-striped');
        table.classList.add('table-bordered');
    });

})(window, document);

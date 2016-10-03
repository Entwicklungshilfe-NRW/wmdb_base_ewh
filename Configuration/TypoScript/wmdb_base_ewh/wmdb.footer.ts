wmdb.footer = COA
wmdb.footer {

    10 = TEXT
    10.value (
        <h4>Know how sources</h4>
        <ul>
            <li><a href="https://github.com/Entwicklungshilfe-NRW" target="_blank" title="PHP-Schulung Github Repository" data-htmlarea-external="1">Entwicklungshilfe GitHub</a></li>
            <li><a href="http://presentations.entwicklungshilfe.nrw/" target="_blank" title="PHP-Schulung Präsentationen" data-htmlarea-external="1">Präsentationen</a></li>
            <li><a href="http://www.rogoit.de/webdesign-typo3-blog-duisburg/" target="_blank" title="Webdevelopment Blog" data-htmlarea-external="1">Rogoit Blog</a></li>
        </ul>
    )
    10.wrap = <div class="col-md-3 col-sm-3">|</div>

    20 = COA
    20 {

        10 = TEXT
        10.value (
            <h4>Anschrift</h4>
            <ul>
                <li>webvisum GmbH</li>
                <li>Vitalisstr. 96</li>
                <li>D-50827 Köln/Germany</li>
            </ul>
        )

        20 = COA
        20 {

            10 = TEXT
            10.value = Impressum
            10.typolink.parameter = 12

            20 = TEXT
            20.value = &nbsp;|&nbsp;

            // 30 = TEXT
            // 30.value = AGB
            // 30.typolink.parameter = 11

        }

        wrap = <div class="col-md-3 col-sm-3">|</div>
    }

    30 = TEXT
    30.value (
        <h4>Kooperationen</h4>
        <ul>
            <li><a href="http://www.rogoit.de/" target="_blank" title="TYPO3 Full Service Agentur aus Duisburg" data-htmlarea-external="1">Rogoit</a></li>
            <li><a href="http://webvisum.de/" target="_blank" title="Magento und eCommerce Full Service Agentur aus Köln" data-htmlarea-external="1">Webvisum</a></li>
            <li><a href="http://www.wmdb.de/" target="_blank" title="TYPO3 Full Service Agentur aus Düsseldorf" data-htmlarea-external="1">WMDB Systems</a></li>
        </ul>
    )
    30.wrap = <div class="col-md-3 col-sm-3">|</div>

    40 = TEXT
    40.value (
        <h4>Follow us</h4>
        <ul id="follow_us">
            <li><a href="https://www.facebook.com/entwicklungshilfe.nrw" target="_blank" title="PHP-Schulungen Entwicklungshilfe auf Facebook" data-htmlarea-external="1"><i class="icon-facebook"></i></a></li>
            <li><a href="https://twitter.com/help_for_devs" target="_blank" title="PHP-Schulungen Entwicklungshilfe auf Twitter" data-htmlarea-external="1"><i class="icon-twitter"></i></a></li>
        </ul>
        <ul>
            <li><strong class="phone">+49 (0)221 677 834 832</strong><br /><small>Mon - Fri / 9.00AM - 06.00PM</small></li>
            <li>Fragen? <a href="mailto:kontakt@entwicklungshilfe.nrw">kontakt@entwicklungshilfe.nrw</a></li>
        </ul>
    )
    40.wrap = <div class="col-md-3 col-sm-3">|</div>
}



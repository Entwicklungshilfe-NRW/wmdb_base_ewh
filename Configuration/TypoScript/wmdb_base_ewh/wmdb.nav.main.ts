wmdb.nav.main < framework.nav.main
wmdb.nav.main {
    5 = TEXT
    5.value (
        <div id="mobnav-btn"></div>
    )

    10.wrap >

    10.1.wrap = <ul class="sf-menu">|</ul>
    10.1.NO.wrapItemAndSub = <li>|</li>

    10.1.IFSUB.wrapItemAndSub = <li class="normal_drop_down">|</li>

    10.1.ACTIFSUB.wrapItemAndSub = <li class="normal_drop_down active"><div class="mobnav-subarrow"></div>|</li>

    10.1.ACT.wrapItemAndSub = <li>|</li>

    10.2.wrap = <ul>|</ul>
    10.2.NO.wrapItemAndSub = <li>|</li>
}
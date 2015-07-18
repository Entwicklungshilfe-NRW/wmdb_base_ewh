wmdb.rootline = COA
wmdb.rootline {
    10 = HMENU
    10 {
        special = rootline
        special.range = 0|3
        entryLevel = 0
        wrap =  <ol class="breadcrumb">|</ol>
        1 = TMENU
        1 {
            noBlur = 1
            NO {
                allWrap = <li>|</li>
                stdWrap.htmlSpecialChars = 1
            }
            ACT {
                allWrap = <li class="active">|</li>
                stdWrap.htmlSpecialChars =
            }
        }
    }

}
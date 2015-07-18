#########################
# Pathes
#########################
path {
    rel {
        js = EXT:wmdb_base_ewh/Resources/Public/Js/
        css = EXT:wmdb_base_ewh/Resources/Public/Css/
        img = EXT:wmdb_base_ewh/Resources/Public/Img/
        html = EXT:wmdb_base_ewh/Resources/Private/Templates/
        forms = EXT:wmdb_base_ewh/Resources/Private/Forms/
        utilities = EXT:wmdb_base_ewh/Classes/Utilities/
    }

    full {
        js = typo3conf/ext/wmdb_base_ewh/Resources/Public/Js/
        css = typo3conf/ext/wmdb_base_ewh/Resources/Public/Css/
        img = typo3conf/ext/wmdb_base_ewh/Resources/Public/Img/
        html = typo3conf/ext/wmdb_base_ewh/Resources/Private/Templates/
        forms = typo3conf/ext/wmdb_base_ewh/Resources/Private/Forms/
        utilities = typo3conf/ext/wmdb_base_ewh/Classes/Utilities/
    }
}

# Typoscript Konstants for Fancybox
styles.content.imgtext.linkWrap {
    lightboxEnabled = 1
    lightboxRelAttribute = WmdbLightbox{field:uid}
    lightboxCssClass = WmdbLightbox
}

# Google Analytics account stuff
ga {
    account =
    domain =
}


# Base Stuff
wmdb {
    base {
        homePid = 2
        metaPid = 15
        footerPid = 16
        logo = {$path.full.img}logo.png
    }
}
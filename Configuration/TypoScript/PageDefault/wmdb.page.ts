page {

    10 = FLUIDTEMPLATE
    10 {
        file = {$framework.path.full.html}Page.html
        partialRootPath = {$path.full.html}Partials/
        layoutRootPath = {$path.full.html}Layouts/
        variables {
            layout = TEXT
            layout.data = page:backend_layout
        }
    }

}

config {
    baseURL = http://ewh.local/
}

[globalString = ENV:HTTPS=on]
    config.baseURL = https://ewh.local/
[global]


plugin.tx_wmdbbaseewh_pi {
    conf {
        # HTML Template Rootfolder
        templateRoot = EXT:wmdb_base_ewh/Resources/Private/Templates/Content/
        # Resources like JS and CSS Rootfolder
        publicResourceRoot = EXT:wmdb_base_ewh/Resources/Public/
        # Content element definitions
        contentElements {
            TestCE {
                template =
                cssFiles =
                jsFiles =
                additionalClasses =
            }
        }
        speakerProfilePid = 24
    }
}
# - !!! DO NOT TOUCH !!! -
# - Without those 2 lines you must declare every single TS twice, one for Uncached and one for Cached CE
plugin.tx_wmdbbaseewh_uncached.conf < plugin.tx_wmdbbaseewh_pi.conf
plugin.tx_wmdbbaseewh_cached.conf < plugin.tx_wmdbbaseewh_pi.conf
# - !!!!!!!!!!!!!!!!!!!! -

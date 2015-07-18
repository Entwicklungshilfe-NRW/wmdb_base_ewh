page.headerData.111111 = TEXT 
page.headerData.111111.value (
	<!-- build:css css/app.min.css-->
	<!-- bower:css -->
	<!-- endbower -->
		<link rel="stylesheet" href="../../../wmdb_framework/Resources/Private/bower_components/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="../../../wmdb_framework/Resources/Private/bower_components/slick.js/slick/slick.css" />
		<link rel="stylesheet" href="../../../wmdb_framework/Resources/Private/bower_components/fancybox/source/jquery.fancybox.css"></script>
		<link rel="stylesheet" href="css/app.css">
	<!-- endbuild -->
)

# In der Produktionsumgebung die nichtminifizierte CSS Datei laden,
# leider nötig aufgrund der zwei-extensions Struktur
[globalString = IENV:HTTP_HOST= *.local.wmdb.de]
	page.headerData.111111 >
	page.includeCSS {
		file1 = typo3conf/ext/wmdb_base_ewh/Resources/Private/Css/app.css
		file2 = typo3conf/ext/wmdb_framework/Resources/Private/bower_components/slick.js/slick/slick.css
		file3 = typo3conf/ext/wmdb_framework/Resources/Private/bower_components/fancybox/source/jquery.fancybox.css
		file4 = typo3conf/ext/wmdb_framework/Resources/Private/bower_components/font-awesome/css/font-awesome.css
	}
[global]


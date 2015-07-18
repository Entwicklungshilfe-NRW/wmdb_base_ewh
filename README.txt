

To initialize a new project, you have to do the following:

0. Prerequisites
	0.1 If you don't have installed nodejs get it at http://nodejs.org/
	0.2 If you don't have installed Grunt yet, do it with npm install -g grunt-cli further information can be found here: http://gruntjs.com/getting-started
	0.3 If you want the liverelaod feature, get te chrome extension here https://chrome.google.com/webstore/detail/livereload/

1. In your shell navigate to typo3conf/ext and
	1.1 "git clone https://git.wmdb.de/scm/wbe/wmdb_framework.git"
	1.2 "git clone https://git.wmdb.de/scm/wbe/wmdb_base_ewh.git"

2 Please replace the following string with your new extension name:
	- wmdb_base_ewh
	- wmdbbaseewh
	- WmdbBaseEwh
	- wmdb_ewh
	- Wmdb Base: Entwicklungshilfe

	Note: It is important that your replacement is case sensitive!

	You also have to change the following foldername with the corresponding extension name:
	- Configuration/TypoScript-> wmdb_base_ewh


	Replace the following string with your base url:
	- baseUrl
	Note: you not have to add http:// or https://, just replace it with your URL! (www.wmdb.de, not http://www.wmdb.de)

4 Install this extensions via the TYPO3 extension manager in this order, first wmdb_framework then wmdb_base_ewh

5 Add to your roots page resources (in TYPO3)
"<INCLUDE_TYPOSCRIPT: source="FILE:EXT:wmdb_framework/Configuration/TSConfig/foundation5.tsConfig.ts">
<INCLUDE_TYPOSCRIPT: source="FILE:EXT:wmdb_framework/Configuration/TSConfig/foundation5.tsConfig.gridElements.ts">"

6 In your shell navigate to typo3conf/ext/wmdb_base_YOUREXTNAME/Resources/, then:
	1.5.1 Install project dependencies with "npm install"
	1.5.2 Run "grunt bower-install" to wire your project dependencies to the needed files
	1.5.3 Run "grunt publish" once. This is just temporary and will not be necessary in the future

Your done. Run "grunt watch" to start the watcher process and liverelaod server. 

ToDo:
Make Private folder useable for development
Include Fancybox Css in Sass an replace Images with font awesome
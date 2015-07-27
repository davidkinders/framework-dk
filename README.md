Currently in development

This framework is based on the Simple MVC frame work from David Carr and the AdminLTE Theme.
Build in RBAC system.


## Installation

1. Download the framework
2. Unzip the package.
3. To run composer, navigate to your project on a terminal/command prompt then run 'composer install' that will update the vendor folder. Or use the vendor folder as is (composer is not required for this step)
Upload the framework files to your server. Normally the index.php file will be at your root.
4. Open the index.php file with a text editor, setup your routes.
5. Open app/Core/Config.example.php and set your base URL and database credentials (if a database is needed). Set the default theme. When you are done, rename the file to Core/Config.php
6. Edit .htaccess file and save the base path. (if the framework is installed in a folder the base path should reflect the folder path /path/to/folder/ otherwise a single / will do.

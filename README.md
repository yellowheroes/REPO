# repo
A small application that offers file upload and downloading/viewing right from your browser.
The application is password protected using .htpasswd (Apache) and .htaccess.

#### usage
When you enter the application, you're presented with an uploader and a list view of all available titles in your repository.
You can upload a file, after which, the list with uploaded files is updated and shown immediately in the browser.
_(all uploads are currently stored in folder: app/repo/uploads)_

To view the contents of a file (e.g. pdf or text), just click the title and a new browser tab is opened showing the document contents.
If the title is a file that needs an application to run(e.g. Excel), the file will be downloaded automatically.
A pop-up window will ask you to select an application to run the file with - the file should open automatically in the selected app.







#DB Copier
Copy your data from one MySQL database table to another by columns, that has different names or structure

One time I faced with problem to transfer data from one MySQL database to another that has absolutely different structures, but not data.
It was need to do it manually controlled, so I wrote this script to do it a bit easier.

####How to use
1. Copy `config.php`, `copy.php`, `index.php`, `query.php` to any folder on your site (Eg: yoursite.com/copier)
2. Edit config.php with credential of DB user, that has privileges for both databases.
3. Run script *http://yoursite.com/copier*
4. Choose source and destination DBs.
5. Choose source and destination tables.
6. Choose columns in tables you would like to transfer from one table to another. You should add the same quantity of rows with similar types.
7. Click Copy button. If data copied successfully you will get a message about how many records inserted, otherwise error description with SQL statement.
8. After copying data remove folder /copier from the site to avoid vulnerability.

####Disclaimer
Script doesn't care about your input errors, SQL-injections or something like that, also you have to understand what you do and why. It's just simple interface for "copy-paste" data from one table to another, that encapsulates ordinary INSERT SELECT query.

####Screenshots
<img src="screenshot-1.jpg" /><br><br>
<img src="screenshot-2.jpg" />

notes in general:

- it works. finally. If something isn't self evident, it's probably commented. I've left prototype definitions at the top of each file for you to copy-pasta.

- sql server connections are established within the functions where they require them. If a function has "$conn, $uSql" in it's parameters, just leave them as "$conn, $uSql" when you do the call and it should work.

- edit the variable values in dataAccess.php for your database info

- when including these files, use "include_once" instead of "include". This prevents compile time errors due to duplicate definitions, which will happen when I get the Groups stuff working. For now, you'll only need  to include Users.php, the other 2 are already inclued in that file.

- if there is a problem after that, it might be because I've got $conn defined outside of the Users class. Either change the references within to something other than $conn or make the appropriate changes in your own code (probably easier to do a search/replace in Users.php. Just don't name it to $db.)

- if your aren't sure what the row results are from a SELECT * FROM Users, I've noted them in the userSQL.php file. Row numbers tend to be more reliable than row names, unfortunatley.
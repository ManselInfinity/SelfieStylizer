# SelfieStylizer

$mail->Username = 'selfiestyliser@gmail.com';

//Password to use for SMTP authentication
$mail->Password = 'yysuvfraiqvccedb';

install https://getcomposer.org/download/
run following commmand inside proect directory 

```
composer require phpmailer/phpmailer
```

ER Diagram :
Entities:

    Users:
        Attributes:
            Email (Primary Key)
            Password
            Credits

    Images:
        Attributes:
            Email (Foreign Key referencing Users)
            Image (LONGBLOB)

Relationship:

    Users - Images Relationship:
        One User can have multiple Images.
        Each Image is associated with exactly one User.


```
+-----------------+          +-----------------+
|      Users      |          |      Images     |
+-----------------+          +-----------------+
| Email (PK)      |          | Email (FK)      |
| Password        |          | Image           |
| Credits         |          +-----------------+
+-----------------+
       | 1
       |
       |
       | N
+---------------------+
| Users - Images Relationship |
+---------------------+
| One User can have      |
| multiple Images.       |
| Each Image is associated |
| with exactly one User.   |
+---------------------+

```
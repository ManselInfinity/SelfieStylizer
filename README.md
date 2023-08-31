# SelfieStylizer

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
+-----------------------------+
| Users - Images Relationship |
+-----------------------------+
| One User can have           |
| multiple Images.            |
| Each Image is associated    |
| with exactly one User.      |
+-----------------------------+

```
## References
  Title: JoJoGAN: One Shot Face Stylization<br>
  Author: Chong, Min Jin and Forsyth, David<br>
  Journal: arXiv preprint arXiv:2112.11641<br>
  Year: 2021<br>
  Link: https://github.com/mchong6/JoJoGAN.git <br><br>



# SelfieStylizer

# Before Running:
Download model files from: https://drive.google.com/drive/folders/1qXMrNJgsv7NxLWoN9gSI82k43EmXT8vM?usp=sharing  
Paste them in stylise/models folder.   
     
ER Diagram :    
Entities:   
    
Users:   
        Attributes:    
            Email (Primary Key)    
            Password   
            Credits    
            userName    

Images:    
        Attributes:    
            Email (Foreign Key referencing Users)    
            Image (LONGBLOB)    
            id     
            parentID    
 
S Gallery:    
        Attributes:    
            Email (Foreign Key referencing Users)    
            Image (LONGBLOB)    
            userName     
            Style    
      
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
      
# Stuff to change for larger image files :      
Navigate to C:\xampp\mysql\bin\my.ini and set:      
     
```
max_allowed_packet=100M
```
      


## References
  Title: JoJoGAN: One Shot Face Stylization<br>
  Author: Chong, Min Jin and Forsyth, David<br>
  Journal: arXiv preprint arXiv:2112.11641<br>
  Year: 2021<br>
  Link: https://github.com/mchong6/JoJoGAN.git <br><br>



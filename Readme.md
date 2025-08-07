# MMS
## Maintenance Management System

##### MMS dikembangkan dengan framework Codeigniter 3. 
##### Berjalan pada PHP 5.6 ++.
##### Database: Mysql.
##### CSS Framework: Bootstrap.
##### Template BS: Admiinlte 3.
##### Dukungan JQuery untuk ajax dan interaktif UI.
### PENTING: Tambahkan parameter pada "my.ini" atau "my.cnf" di dalam folder Mysql
    
    [mysqld]
    sql_mode = "STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION"

    Parameter diatas dibutuhan untuk query "GROUP BY" agar bisa mode "FULL GROUP"

###### Diperlukan banyak penyempurnaan baik dari segi arsitektur database dan algoritma. 
###### Perlu dilakukan refactoring meningkatkan kualitas, keterbacaan, dan kemudahan pemeliharaan kode tanpa mengubah fungsionalitasnya.

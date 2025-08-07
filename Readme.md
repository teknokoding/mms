1. Tambahkan parameter pada "my.ini" atau "my.cnf" di dalam folder Mysql
    
    [mysqld]
    sql_mode = "STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION"

    Parameter diatas dibutuhan untuk query "GROUP BY" agar bisa mode "FULL GROUP"

2. Edit struktur tabel "tag_release"
    Field
    "Pelaksana2"
    "Pelaksana3"
    "Pelaksana4"
    "Pelaksana5"
    "Pelaksana6"
    Ubah "Default" dari "None" menjadi "NULL"

3. Penambahan Tabel "sidebar"

4. Update

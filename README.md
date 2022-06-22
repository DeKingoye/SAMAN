# SAMAN
Description du projet

# pour demarrer le projet:

# etape 1: 

installer Docker si tu ne l'as pas encore (https://www.docker.com/products/docker-desktop/),

# etape 2:

1- dans le repertoire du projet taper la cmd : `docker-compose up`

2- acceder aux services :
    - site: http://localhost:3000
    - phpmyadmin: http://localhost:3001

3- dump database (export base de données) : 
docker 
    -   `docker container list`

    -   `docker exec -i CONTAINER_SQL_ID mysqldump -u root --password=1234 saman > backup_saman.sql`

4- import database (import base de données) : 

    -   `docker container list`

    -   `docker exec -i CONTAINER_SQL_ID mysqldump -u root --password=1234 saman < backup_saman.sql`

# etape 3:

1- pour mettre à jour le projet: `sh pull.sh` (ou `./pull.sh`)

2- pour envoyer le projet sur git: `sh push.sh "ma_branche" "mon message"` (ou `./push.sh "ma_branche" "mon message"`)


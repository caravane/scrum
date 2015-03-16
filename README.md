# scrum
Simple Symfony2 Scrum project management


#setup
    composer install


Doctrine DB Schema:
    php app/console doctrine:schema:update --force


Create admin user:
    php app/console fos:user:create
    php app/console fos:user:promote to add ROLE_ADMIN


Set up app:
    php app/console app:setup


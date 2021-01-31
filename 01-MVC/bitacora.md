# Bitácora

## 2021-01-31

Se habilita el módulo rewrite en apache con estos comandos

    sudo a2enmod rewrite
    sudo systemctl restart apache

Aún hay un error al mostrar los errores 404 desde apache, también sería bueno tener una página de error 500 en vez de que se muera la aplicacion

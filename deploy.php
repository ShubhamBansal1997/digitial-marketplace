<?php
namespace Deployer;
require 'recipe/laravel.php';

// Configuration

set('ssh_type', 'native');
set('ssh_multiplexing', true);

set('repository', 'git@bitbucket.org:ShubhamBansal/designminister.git');

add('shared_files', []);
add('shared_dirs', []);

add('writable_dirs', []);

// Servers
set('clear_use_sudo', true);
set('composer_action', false);
set('writable_use_sudo', true);

server('production', '184.72.109.212')
    ->user('ubuntu')
    ->identityFile('~/.ssh/id_rsa')
    ->set('deploy_path', '/var/www/designminister')
    ->pty(true);


// Tasks

desc('Restart PHP-FPM service');
task('php-fpm:restart', function () {
    // The user must have rights for restart service
    // /etc/sudoers: username ALL=NOPASSWD:/bin/systemctl restart php-fpm.service
    run('sudo systemctl restart php-fpm.service');
});
after('deploy:symlink', 'php-fpm:restart');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');

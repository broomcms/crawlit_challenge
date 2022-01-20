<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'crawlit');
set('ssh_multiplexing', true);

// Project repository
set('repository', 'git@github.com:broomcms/crawlit_challenge.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
add('shared_dirs', [
    'storage',
]);
add('shared_files', [
    '.env'
]);

// Writable dirs by web server 
add('writable_dirs', [
    'bootstrap/cache',
    'storage',
]);

// Hosts   
host('prod')
    ->user('root')
    ->port (22)
    ->hostname('crawlit.webiummedia.com')
    ->stage('prod')
    ->set('deploy_path', '/home/crawlit/public_html');
    
// Tasks
task('deploy', [
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:vendors',
    'artisan:storage:link',
    'artisan:view:clear',
    'artisan:cache:clear',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'success'
]);

task('deploy:owner', function () {

    $stage = null;
    if (input()->hasArgument('stage')) {
        $stage = input()->getArgument('stage');
    }

    if ($stage=="prod"){
        run('chown -R crawlit:crawlit /home/crawlit/public_html');
    }
});

task('reload:php-fpm', function () {
    run('/scripts/restartsrv_apache_php_fpm');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
after('deploy:unlock', 'deploy:owner');
after('deploy', 'reload:php-fpm');


<?php
namespace Deployer;

require 'recipe/laravel.php';
require 'contrib/npm.php';

set('bin/php', function () {
    return '/usr/local/bin/php'; // change
});

// HARUS DIGANTI SESUAI KEBUTUHAN ANDA
set('application', 'Resong Hotel'); 
set('repository', 'git@github.com:elandramaulana/resong-hotel.git'); // Git Repository contoh set('repository', 'git@github.com:yogameleniawan/laravel-cicd-deployer.git');
// HARUS DIGANTI SESUAI KEBUTUHAN ANDA

set('git_tty', true);
set('git_ssh_command', 'ssh -o StrictHostKeyChecking=no');

set('keep_releases', 5);

set('writable_mode', 'chmod'); // shared hosting

// Shared files/dirs between deploys
add('shared_files', ['.env']);
add('shared_dirs', ['storage']);

// Writable dirs by web server
add('writable_dirs', [
    "bootstrap/cache",
    "storage",
    "storage/app",
    "storage/framework",
    "storage/logs",
]);

set('composer_options', '--verbose --prefer-dist --no-progress --no-interaction --no-dev --optimize-autoloader');

// Hosts

// HARUS DIGANTI SESUAI KEBUTUHAN ANDA

host('Metro_Software') // Nama remote host server ssh anda | contoh host('NAMA_REMOTE_HOST')
->setHostname('109.106.253.117') // Hostname atau IP address server anda | contoh  ->setHostname('10.10.10.1') 
->set('remote_user', 'n1577433') // SSH user server anda | contoh ->set('remote_user', 'u1234567')
->set('port', 65002) // SSH port server anda, untuk kasus ini server yang saya gunakan menggunakan port custom | contoh ->set('remote_user', 65002)
->set('branch', 'staging') // Git branch anda
->set('deploy_path', '~/repositories/resong-hotel'); // Lokasi untuk menyimpan projek laravel pada server | contoh ->set('deploy_path', '~/public_html/api-deploy');

// HARUS DIGANTI SESUAI KEBUTUHAN ANDA

// Tasks

task('deploy:secrets', function () {
    file_put_contents(__DIR__ . '/.env', getenv('DOT_ENV'));
    upload('.env', get('deploy_path') . '/shared');
});

desc('Build assets');
task('deploy:build', [
    'npm:install',
]);

task('deploy', [
    'deploy:prepare',
    'deploy:secrets',       // Deploy secrets
    'deploy:vendors',
    'deploy:shared',
    'artisan:storage:link',
    'artisan:queue:restart',
    'deploy:publish',
    'deploy:unlock',
]);

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release. Uncomment below code if you want to migrate after deploy

// before('deploy:symlink', 'artisan:migrate');
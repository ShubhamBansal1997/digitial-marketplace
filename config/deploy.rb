# config valid only for current version of Capistrano
lock "3.8.0"
# Which roles to consider as laravel roles
set :laravel_roles, :all

# The artisan flags to include on artisan commands by default
set :laravel_artisan_flags, "--env=#{fetch(:stage)}"

# Which roles to use for running migrations
set :laravel_migration_roles, :all

# The artisan flags to include on artisan commands by default when running migrations
set :laravel_migration_artisan_flags, "--force --env=#{fetch(:stage)}"

# The version of laravel being deployed
set :laravel_version, 5.4

# Whether to upload the dotenv file on deploy
set :laravel_upload_dotenv_file_on_deploy, true

# Which dotenv file to transfer to the server
set :laravel_dotenv_file, './.env'

# The user that the server is running under (used for ACLs)
set :laravel_server_user, 'www-data'

# Ensure the dirs in :linked_dirs exist?
set :laravel_ensure_linked_dirs_exist, true

# Link the directores in laravel_linked_dirs?
set :laravel_set_linked_dirs, true

# Linked directories for a standard Laravel 4 application
set :laravel_4_linked_dirs, [
  'app/storage'
]

# Linked directories for a standard Laravel 5 application
set :laravel_5_linked_dirs, [
  'storage'
]

# Ensure the paths in :file_permissions_paths exist?
set :laravel_ensure_acl_paths_exist, true

# Set ACLs for the paths in laravel_acl_paths?
set :laravel_set_acl_paths, true

# Paths that should have ACLs set for a standard Laravel 4 application
set :laravel_4_acl_paths, [
  'app/storage',
  'app/storage/public',
  'app/storage/cache',
  'app/storage/logs',
  'app/storage/meta',
  'app/storage/sessions',
  'app/storage/views'
]

# Paths that should have ACLs set for a standard Laravel 5 application
set :laravel_5_acl_paths, [
  'bootstrap/cache',
  'storage',
  'storage/app',
  'storage/app/public',
  'storage/framework',
  'storage/framework/cache',
  'storage/framework/sessions',
  'storage/framework/views',
  'storage/logs'
]


set :application, "Designminister"
set :repo_url, "git@bitbucket.org:ShubhamBansal/designminister.git"
set :user, 'deploy'
set :branch, 'master'

# set :application, "Your app name"  # EDIT your app name
# set :repo_url,  "https://github.com/laravel/laravel.git" # EDIT your git repository
set :deploy_to, "/var/www/designminister" 
set :use_sudo, true
# EDIT folder where files should be deployed to
 
namespace :environment do

    desc "Copy Environment Variables"
    task :sync do
        on roles(:app), in: :sequence, wait: 5 do
            execute :echo, "-n /etc/environment", raise_on_non_zero_exit: false
            fetch(:default_env).each do |key, value|
                execute :echo, "'#{key}=\"#{value}\"' >> /etc/environment"
            end
            execute :service, "nginx reload"
        end
    end

end

namespace :composer do

    desc "Running Composer Self-Update"
    task :update do
        on roles(:app), in: :sequence, wait: 5 do
            execute :composer, "self-update"
        end
    end

    desc "Running Composer Install"
    task :install do
        on roles(:app), in: :sequence, wait: 5 do
            within release_path  do
                execute :composer, "install --no-dev --quiet"
            end
        end
    end

end

namespace :laravel do

    desc "Setup Laravel folder permissions"
    task :permissions do
        on roles(:app), in: :sequence, wait: 5 do
            within release_path  do
                execute :chmod, "-R 777 storage/framework/cache"
                execute :chmod, "-R 777 storage/framework/sessions"
                execute :chmod, "-R 777 storage/framework/views"
                execute :chmod, "-R 777 storage/logs"
            end
        end
    end

    desc "Run Laravel Artisan migrate task."
    task :migrate do
        on roles(:app), in: :sequence, wait: 5 do
            within release_path  do
                execute :php, "artisan migrate"
            end
        end
    end

    desc "Run Laravel Artisan seed task."
    task :seed do
        on roles(:app), in: :sequence, wait: 5 do
            within release_path  do
                execute :php, "artisan db:seed"
            end
        end
    end

    desc "Optimize Laravel Class Loader"
    task :optimize do
        on roles(:app), in: :sequence, wait: 5 do
            within release_path  do
                execute :php, "artisan clear-compiled"
                execute :php, "artisan optimize"
            end
        end
    end

end

namespace :deploy do

    after :published, "composer:update"
    after :published, "composer:install"
    after :published, "environment:sync"
    after :published, "laravel:permissions"
    after :published, "laravel:optimize"
    after :published, "laravel:migrate"
    # after :published, "laravel:seed"

end

# namespace :deploy do
#     after :finishing, 'deploy:cleanup', "deploy:update_code"
#     desc "Build"
#     after :updated, :build do
#         on roles(:app) do
#             within release_path  do
#                 execute :composer, "install --no-dev --quiet" # install dependencies
#                 execute :chmod, "u+x artisan" # make artisan executable
#                 execute :php, "artisan view:clear" # run migrations
#                 execute :php, "artisan cache:clear" # run migrations
#             end
#         end
#     end
 
#     desc "Restart"
#     task :restart do
#         on roles(:app) do
#             within release_path  do
#                 execute :chmod, "-R 777 storage"
#                 execute :chmod, "-R 777 bootstrap/cache"
#             end
#         end
#     end
 
# end

# Default branch is :master
# ask :branch, `git rev-parse --abbrev-ref HEAD`.chomp

# Default deploy_to directory is /var/www/my_app_name
# set :deploy_to, "/var/www/my_app_name"

# Default value for :format is :airbrussh.
# set :format, :airbrussh

# You can configure the Airbrussh format using :format_options.
# These are the defaults.
# set :format_options, command_output: true, log_file: "log/capistrano.log", color: :auto, truncate: :auto

# Default value for :pty is false
# set :pty, true

# Default value for :linked_files is []
# append :linked_files, "config/database.yml", "config/secrets.yml"

# Default value for linked_dirs is []
# append :linked_dirs, "log", "tmp/pids", "tmp/cache", "tmp/sockets", "public/system"

# Default value for default_env is {}
# set :default_env, { path: "/opt/ruby/bin:$PATH" }

# Default value for keep_releases is 5
# set :keep_releases, 5

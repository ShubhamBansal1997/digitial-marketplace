# config valid only for current version of Capistrano
lock "3.8.0"

set :application, "Designminister"
set :repo_url, "git@bitbucket.org:ShubhamBansal/designminister.git"

# set :application, "Your app name"  # EDIT your app name
# set :repo_url,  "https://github.com/laravel/laravel.git" # EDIT your git repository
set :deploy_to, "/var/www/designminister" # EDIT folder where files should be deployed to
 
namespace :deploy do
     
    desc "Build"
    after :updated, :build do
        on roles(:app) do
            within release_path  do
                execute :composer, "install --no-dev --quiet" # install dependencies
                execute :chmod, "u+x artisan" # make artisan executable
            end
        end
    end
 
    desc "Restart"
    task :restart do
        on roles(:app) do
            within release_path  do
                execute :chmod, "-R 777 storage"
                execute :chmod, "-R 777 bootstrap/cache"
            end
        end
    end
 
end

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
